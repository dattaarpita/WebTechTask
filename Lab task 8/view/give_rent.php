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

   
                 <form onsubmit="return rentvalidation()" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <label><b>Rent No:</b></label><br>
            
           <input type="text" name="rNo" id="rNo" value="<?php echo $rno;?>"><br>
           <span id="rNoError" style="color: red;">
       </span>
        <br></br>
          
            <label><b>AD No:</b></label><br>
                    
           <input type="text" name="adNo" id="adNo" value="<?php echo $adNo;?>"><br>
             <span id="adNoError" style="color: red;">
        </span>
        <br></br>
           <label><b>Renter ID</b></label><br>
           <input type="text" name="rid" id="rid" value="<?php echo $rid;?>"><br>
           <span id="ridError" style="color: red;">
        </span>
        <br></br>
           <label><b>Rent Amount</b></label><br>
           <input type="text" name="r_amount" id="r_amount"value="<?php echo $r_amount;?>"><br>
            <span id="r_amountError" style="color: red;">
        
    </span>
        <br></br>
           <label><b>Which month do you want to give rent</b></label><br>
           
          <select id="r_month"  name="r_month">
            <option value="" disabled selected hidden>Select a month</option>
            <option value="Jan">Jan</option>
            <option value="Feb">Feb</option>
            <option value="March">March</option>
              <option value="April">April</option>
              <option value="May">May</option>
              <option value="June">June</option>
              <option value="July">July</option>
              <option value="Aug">Aug</option>
              <option value="Sep">Sep</option>
              <option value="Oct">Oct</option>
              <option value="Nov">Nov</option>
              <option value="Dec">Dec</option>

          </select>
          <br>
            <span id="r_monthError" style="color: red;">
        
    </span>



    <br></br>




           <label><b>Payment System:</b></label>
                <input type="radio" id="m" name="payment"value="Cash"<?php if (isset($payment) && $payment=="Cash") echo "checked";?>>
                <label for="">Cash</label> 

                <input type="radio" id="f" name="payment" value="Bkash" <?php if (isset($payment) && $payment=="Bkash") echo "checked";?>> 
                <label for=" ">Bkash</label> 
                <input type="radio" id="p" name="payment" value="Credit card"<?php if (isset($payment) && $payment=="Credit card") echo "checked";?>> 
                <label for="">Credit Card</label> 
                <br>
                <span id="paymentError" style="color: red;">
               </span>
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
                    <script >
                    function rentvalidation()
                        {
                            var rNoError="";

                            var adNoError="";
                            var ridError="";
                            var r_amountError="";
                            var r_monthError="";
                           var paymentError="";

    var y=document.getElementById("rNo").value;
    if(y=="")
    {
        document.getElementById("rNoError").innerHTML="Renter no is required";
        rNoError="Error";
    }
    else{
            rNoError="";
            document.getElementById("rNoError").innerHTML="";
        }

  var x=document.getElementById("adNo").value;
    if(x=="")
    {
        document.getElementById("adNoError").innerHTML="Ad no is required";
        adNoError="Error";
    }
    else{
            adNoError="";
            document.getElementById("adNoError").innerHTML="";
        }

        var z=document.getElementById("rid").value;
    if(z=="")
    {
        document.getElementById("ridError").innerHTML="Renter Id is required";
        ridError="Error";
    }
    else{
            ridError="";
            document.getElementById("ridError").innerHTML="";
        }

        var r=document.getElementById("r_amount").value;
    if(r=="")
    {
        document.getElementById("r_amountError").innerHTML="Rent amount is required";
        r_amountError="Error";
    }
    else{
            r_amountError="";
            document.getElementById("r_amountError").innerHTML="";
        }
        
         var p=document.getElementById("r_month").value;
    if(p=="")
    {
        document.getElementById("r_monthError").innerHTML="Rent month is required";
        r_monthError="Error";
    }
    else{
            r_monthError="";
            document.getElementById("r_monthError").innerHTML="";
        }

         if(document.getElementById("m").checked==false && document.getElementById("f").checked==false && 
            document.getElementById("p").checked==false)
    {
        document.getElementById("paymentError").innerHTML="Payment System is required";
        paymentError="Error";
    }
    else{
        paymentError="";
        document.getElementById("paymentError").innerHTML="";
    }
 
    
    if(rNoError!="" || adNoError!="" || ridError!=""||r_amountError!=""||r_monthError!=""||paymentError!=""){
        return false;
    }else if(rNoError==""&& adNoError==""&&ridError==""&&r_amountError==""&&r_monthError==""&&paymentError==""){
        return true;
    }
}
</script>

</body>
</html>