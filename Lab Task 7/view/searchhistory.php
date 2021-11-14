<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:Homepage.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";
$searched_history ="";



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
	<title>Search history</title>

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
       <?php if(!empty($searched_history))
       foreach ($searched_history as $payment): ?>
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

   </div>
  
   </div>
                   <?php
                      include "footer.php";
                    ?>

</body>
</html>
