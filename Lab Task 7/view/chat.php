
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
	<title>chat</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body class="bd">
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
            	
            		
            		<br>
            		<table style="border: 1px solid black; border-collapse: collapse;">
            		
            		  <tr>
                <th style="border: 1px solid black; border-collapse: collapse;" >House Owner ID &nbsp; &nbsp;</th>
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;Renter ID&nbsp; &nbsp;</th> 
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;Message ID&nbsp; &nbsp;</th>
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;AD No&nbsp; &nbsp;</th> 
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp;Message &nbsp; &nbsp;</th>
                
                <th style="border: 1px solid black; border-collapse: collapse;">&nbsp; &nbsp;Reply &nbsp;</th>
                <th style="border: 1px solid black; border-collapse: collapse;">Action&nbsp; &nbsp;</th>

                 </tr>
                  <tr>

    <td style="border: 1px solid black; border-collapse: collapse;" >123</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >101</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >M101</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >AD1 </td>
    <td style="border: 1px solid black; border-collapse: collapse;" >Hi,I want to book a house</td>
    <td style="border: 1px solid black; border-collapse: collapse;" >Ok,please inform us your preferable house. </td>
   <td style="border: 1px solid black; border-collapse: collapse;" ><a href=""> Reply</a> <a href=""> New Message</a></td>

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
