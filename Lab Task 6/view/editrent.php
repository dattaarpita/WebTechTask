<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:Homepage.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";

$ramount="";
$rmonth="";


if(isset($_SESSION["NID"])){
    $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );
    require_once '../controller/getuserData.php';

    $renterdashboard=new getDataFromFile($data);

    $renterdashboard->checkFromFiles($data);

    $Name=$_SESSION['Name'];
    $Gender=$_SESSION['Gender'];
    $Email=$_SESSION['Email'];
    $Password=$_SESSION['Password'];
    $Image=$_SESSION['Image'];

     require_once '../controller/edit_rent.php';
    $RNo=$_GET["id"];
    $showpayment=new getrent($RNo);
    $payment=$showpayment->fetchrent($RNo);

    $ramount=$payment["RAmount"];
    $rmonth=$payment['RMonth'];
    if(isset($_POST["edit"])){


        $data_p=array(
              'RNo'=>$_POST["id"], 

              'RAmount'=>$_POST["ramount"],
              'RMonth'=>$_POST["rmonth"],
      );

        require_once '../controller/updatepayment.php';
            $editrent=new editpayment($data_p);
            $editrent->editpay($data_p);
           
            $message=$editrent->get_message();
            
            
    }

}



?>


 <?php

 include '../header.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../Dashboard.css">
</head>
<body style="background-color:lightgreen;">
    <br>
    <div class="intro">

        <br>
        <?php


        echo "Logged in as , " . $Name;

        ?>


        <br>
        <a href="logout.php" target="_self">Log out</a>
        <img class="intro2" src="<?php echo $Image ?>" width="120px" height="120px"><br><br>

    </div>

  <br></br>

    <div>
        <table border=1 style="width:1000px; border-style: none;border-collapse: collapse;">
          
            <tr> 
                
            <td style="width:250px">
                    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account
                        <hr>
                    </legend>
                    <ul>
                        
                 
                <li><a href="renterdashboard.php">Dashboard</a></li>
                 <li><a href="viewprofile.php">View Profile</a></li>
                <li><a href="Editprofile.php">Edit Profile</a></li>
                  <li><a href="profilepic.php">Change Profile Picture</a></li>
                  <li><a href="give_rent.php">Give Rent</a></li>
                   <li><a href="renthistory.php">Rent History</a></li>
                   <li><a href="editrent.php">Edit Rent History</a></li>
                
                <li><a href="searchhistory.php">Search Payment History</a></li>

                <li><a href="see_add.php">See Add</a></li>
             
                <li><a href="chat.php">Chat</a></li>
                
                <li><a href="check_notices.php">Check Notices</a></li>
                <li><a href="logout.php">Log out</a></li>
                <li><a href="deleteprofile.php">Delete Account</a></li>
               
               
            </ul>
            </td>
            <td style="width:550px; vertical-align:top;">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <label><b>Rent Amount</b></label><br>
                        <input type="text" name="ramount" id="ramount" placeholder="Rent Amount" value="<?php echo $ramount;?>">
                        
                    <br><br>

                 <label><b>Rent Month:</b>&nbsp; </label><br>
                <input type="text" id="rmonth" name="rmonth" value="<?php echo $rmonth;?>" placeholder="Rent Month">
                    
                    <br></br>

                
                         <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                        <input type="submit" name="edit" value="Submit"><br>
                        <?php
                        if (isset($message)) {
                            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                        }
                        ?>
                        </form>
                </td>
            </tr>
        </table>
    </div>
                    <?php
                      include "../Footer.php";
                    ?>

</body>
</html>