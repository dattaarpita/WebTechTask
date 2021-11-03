<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:Homepage.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";

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

    if(isset($_POST["submit"])){

        $data=array(
        'Renter_ID'=>$_SESSION["NID"],
        'Adno'=>$_POST["adNo"],
        'ramount' =>$_POST["r_amount"],
        'rmonth'=>$_POST["r_month"],
        'payment'=>$_POST["payment"],
        'rentno'=>$_POST["rNo"],
        
        );

        require_once '../controller/giverent.php';

        $give_notice=new giveNotice($data);

        $give_notice->g_notice($data);

        $message=$give_notice->get_message();


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
                
                <li><a href="searchhistory.php">Search Payment History</a></li>

                <li><a href="see_add.php">See Add</a></li>
             
                <li><a href="chat.php">Chat</a></li>
                
                <li><a href="check_notices.php">Check Notices</a></li>
                <li><a href="logout.php">Log out</a></li>
                <li><a href="deleteprofile.php">Delete Account</a></li>
               
               
            </ul>
            </td>

            <td  style="width:550px; vertical-align:top;">
                 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <label><b>Rent No:</b></label><br>
            
           <input type="text" name="rNo" id="rNo" value=""><br></br>
          
            <label><b>AD No:</b></label><br>

           <input type="text" name="adNo" id="adNo" value="<?php echo $adNo;?>"><br></br>
           <label><b>Renter ID</b></label><br>
           <input type="text" name="rid" id="rid" value="<?php echo $rid;?>"><br></br>
           <label><b>Rent Amount</b></label><br>
           <input type="text" name="r_amount" id="r_amount"value="<?php echo $r_amount;?>"><br></br>
           <label><b>Which month do you want to give rent</b></label><br>
           <input type="month" name="r_month" id="r_month"value="<?php echo $r_month;?>"><br></br>
           <label><b>Payment System:</b></label>
                <input type="radio" id="payment" name="payment"value="Cash"<?php if (isset($payment) && $payment=="Cash") echo "checked";?>>
                <label for="">Cash</label> 

                <input type="radio" id="payment" name="payment" value="Bkash" <?php if (isset($payment) && $payment=="Bkash") echo "checked";?>> 
                <label for=" ">Bkash</label> 
                <input type="radio" id="payment" name="payment" value="Credit card"<?php if (isset($payment) && $payment=="Credit card") echo "checked";?>> 
                <label for="">Credit Card</label> 
        <br></br>
           <input type="submit" name="submit" id="pn" value="Pay"><br><br>
           <?php
           if(isset($message)){
               echo $message;
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