
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

    $renter=$renterdashboard->checkFromFiles($data);

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];

}



?>
 <?php

 include '../header.php';

   ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>See add</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body  class="bd">
	<br><br><br>
    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account<hr></legend>

       <div style="display: flex;">

        <div>

            <?php
         include "menu.php";

         ?>
        </div>

    <div style="display: inline-block; padding-left: 40px;">
        
            	 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            	
            		
            		<input type="text" name="name" id="name" placeholder="Search" value="">
            		<input type="submit" name="submit" value="Submit">
            		<br>
                        </br>
            		<table style="border: 1px solid black; border-collapse: collapse;">
            		
            		  <tr>
                <th style="border: 1px solid black; border-collapse: collapse;" >AD No. &nbsp; &nbsp;</th>
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;AD Rent&nbsp; &nbsp;</th> 
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;AD Area&nbsp; &nbsp;</th>
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;AD Address&nbsp; &nbsp;</th> 
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp;Picture 1</th>
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;Picture 2 &nbsp;</th>
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;Picture 3&nbsp;</th>

                 </tr>
                  <tr>
    <td style="border: 1px solid black; border-collapse: collapse;" >101</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >30000</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >Shantinagar</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >Road 115,House no-1 </td>
    <td style="border: 1px solid black; border-collapse: collapse;" ><img src="https://cdn.discordapp.com/attachments/845912072105492510/901767473374830652/Pink-GIrls-Bedroom-Jennifer-ALlwood-Magic-BRush-3.png" width="90%" height="80%"></td>
    <td style="border: 1px solid black; border-collapse: collapse;" ><img src="https://cdn.discordapp.com/attachments/845912072105492510/901768059298136074/010-modern-apartment-by-hi-light-architects.png" width="90%" height="80%"></td>
   <td style="border: 1px solid black; border-collapse: collapse;" ><img src="https://cdn.discordapp.com/attachments/845912072105492510/901769326787428372/maxresdefault.png" width="90%" height="90%"></td>



    
  </tr>
  <tr>
    <td style="border: 1px solid black; border-collapse: collapse;" >102</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >40000</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >Uttara</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >Sector 5,House no-32 </td>
    <td style="border: 1px solid black; border-collapse: collapse;" ><img src="https://cdn.discordapp.com/attachments/845912072105492510/901766407035969537/1414372530905.png" width="90%" height="80%"></td>
    <td style="border: 1px solid black; border-collapse: collapse;" ><img src="https://cdn.discordapp.com/attachments/845912072105492510/901768727966650378/Purple-and-Yellow-Teen-Bedroom.png" width="90%" height="80%"></td>
   <td style="border: 1px solid black; border-collapse: collapse;" ><img src="https://cdn.discordapp.com/attachments/845912072105492510/901766876357623838/Purple-tufted-ottoman.png" width="90%" height="90%"></td>

    </tr>
    </table>
                  </form>
             </div>
  
   </div>
                   <?php
                      include "footer.php";
                    ?>

</body>
</html>
