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

    require_once '../controller/managerent.php';

    $manage_notices=new getNotices($data);

    $notices=$manage_notices->getTheNotices($data);

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
                   <li><a href="editrent.php">Edit Rent History</a></li>
                
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
            <h3>Rent History</h3>
        
        <table style="border: 2px solid black; width: 100%; text-align:center; border-collapse: collapse;">
       
               <tr style="border: 2px solid black">
           
               <th style="border: 2px solid black">Rent No:</th>
               <th style="border: 2px solid black">Renter ID</th>
               <th style="border: 2px solid black">AD No</th>
               <th style="border: 2px solid black">Rent Amount</th>
                <th style="border: 2px solid black">Rent Month </th>

               <th style="border: 2px solid black">Payment System</th>
               
           </tr>
      
       
       <?php foreach ($notices as $notice): ?>
            <tr>
                <td style="border: 2px solid black"><a href="viewpayment.php?id=<?php echo $notice['RNo'] ?>" class="button1">View</a></td>
                <td style="border: 2px solid black"><?php echo $notice['RID'] ?></td>
                <td style="border: 2px solid black"><?php echo $notice['ADNo'] ?></td>
                <td style="border: 2px solid black"><?php echo $notice['RAmount'] ?></td>
                <td style="border: 2px solid black"><?php echo $notice['RMonth'] ?></td>
                <td style="border: 2px solid black"><?php echo $notice['PaymentSystem'] ?></td>
                
             <td><a href="editrent.php?id=<?php echo $notice['RNo'] ?>" class="button1">Edit</a>&nbsp<a href="deleterent.php?id=<?php echo $notice['RNo'] ?>" class="button1")>Delete</a></td>
            </tr>
        <?php endforeach; ?>
    
   </table>
  
        </tr>

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