<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:Homepage.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";
$adNo=$rid=$r_amount=$r_month=$payment=$rno="";

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
                <label><b>Rent No:</b></label><br>
            
           <input type="text" name="rNo" id="rNo" value="<?php echo $rno;?>"><br></br>
          
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
           
    </div>    
    </div>
                    <?php
                      include "footer.php";
                    ?>

</body>
</html>