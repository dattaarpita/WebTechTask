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


     $payment="";
    $payment_error="";
    $not_match="";
    if(isset($_POST["search"])){
        $payment=$_POST["keyword"];
        if(!empty($payment)){
        require_once '../controller/search_history.php';
        $searchhistory=new Search($payment);
        $searched_history=$searchhistory->searchpay($payment);
             
        if(empty($searched_history)){
            $not_match="No Such rent history Found";
        }
        }
        else if(empty($payment)){
         $payment_error="Field Cannot Be Empty";
      }

}
}



?>

<?php

 include '../header.php';

   ?>

<html>
<head>
	<meta charset="utf-8">
	<title>Rent History</title>
	<link rel="stylesheet"  href="../Dashboard.css">
</head>
<body style="background-color: lightgreen;">
    
      <br>
	<div class="intro">
        
        <br>
    <?php  
    
    
    echo "Logged in as , ".$Name;
     
    ?>

    
    <br>
    <a href="logout.php" target="_self" >Log out</a>
    <img class="intro2" src="<?php echo $Image ?>" width="120px" height="120px"><br><br>

    </div>

    

  <div>
    <br></br>
   <table border=1 style="width:800px; border-style: none;border-collapse: collapse; ">
            
          <tr>
            
        <td  style="width:250px">
            <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account<hr style="color: blue;"></legend>
            <ul >
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
             <label>Search by Payment System</label><br>
       <input type="text" name="keyword" id="keyword" value="" style="width: 25%;"><span style="color:red">
       <?php
       if($payment_error!=""){
           echo " ".$payment_error;
       }
       ?>
       </span><br>
       <span>
           <?php
            if($not_match!=""){
            echo " ".$not_match;
            }
           ?>
       </span>
       <br>
       <input type="submit" name="search"><br><br>
       <table style="border: 2px solid black; width: 900px; text-align:center; border-collapse: collapse;">
       <thead style="border: 2px solid black">
           <tr style="border: 2px solid black">
               <th style="border: 2px solid black">Renter ID</th>
               <th style="border: 2px solid black">AD No</th>
               <th style="border: 2px solid black">Rent Amount</th>
               <th style="border: 2px solid black">Rent Month</th>
               <th style="border: 2px solid black">Payment System</th>
              
           </tr>
       </thead>
       <tbody style="border: 2px solid black">
       <?php foreach ($searched_history as $payment): ?>
            <tr>
                <td style="border: 2px solid black"><?php echo $payment['RID'] ?></td>
                <td style="border: 2px solid black"><?php echo $payment['ADNo'] ?></td>
                <td style="border: 2px solid black"><?php echo $payment['RAmount'] ?></td>
                <td style="border: 2px solid black"><?php echo $payment['RMonth'] ?></td>
                <td style="border: 2px solid black"><?php echo $payment['PaymentSystem'] ?></td>
                
            </tr>
        <?php endforeach; ?>
       </tbody>
   </table>
       </form>

        </td>

        </tr>
       
    </table>
   </div>
   <div>
   </div>
   <?php
   include "../Footer.php";
    ?>
</body>
</html>