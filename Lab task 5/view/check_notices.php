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

}



?>
 <?php

 include '../header.php';

   ?>


<!DOCTYPE html>
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
        <table border=1 style="width:800px; border-style: none;border-collapse: collapse;">
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
                    <label><b>&nbsp; Notice!</b></label><br>
                    <br>
                    <table style="border: 1px solid black; border-collapse: collapse;">
                    <tr>
                <th style="border: 1px solid black; border-collapse: collapse;" >Notice ID &nbsp; &nbsp;</th>
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;House Owner ID&nbsp; &nbsp;</th> 
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;Message &nbsp; &nbsp;</th>
               </tr>
               <tr>

    <td style="border: 1px solid black; border-collapse: collapse;" >234</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >123</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >Check out the new add</td>
    
</tr>
 <tr>

    <td style="border: 1px solid black; border-collapse: collapse;" >235</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >123</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >New add posted here</td>
    
</tr>
</form>
              </td>

                 </table>
        </tr>

    </table>
</div>
  <br>
  <?php
                      include "../Footer.php";
                    ?>
                
 </body>
</html>