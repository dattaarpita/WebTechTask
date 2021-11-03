<?php
$NIDNo=$Password="";
$nidErr=$passErr="";
$ErrorLogin="";


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST["login"])){

    $NIDNo=test_input($_POST["nid"]);
    $Password=test_input($_POST["pass"]);

    $data=array(
        'NID'=>$NIDNo,
        'Password'=>$Password,
        'Message'=>""
    );

    require_once '../controller/loginvalidate.php';

    $login=new login($data);

    $login->check_login($data);
    $error=$login->get_error();
    $message=$login->get_message();
    $err_msg=$login->error_message();

     $nidErr=$error["nidErr"];
    $passErr=$error["passwordErr"];

     

       if(isset($_POST["remember"])){
        setcookie('nid',$_POST['nid'],time()+50);
        setcookie('password',$_POST['pass'],time()+50);
        if($message!=""){
            header("location:renterdashboard.php");
        }
        else{
            $ErrorLogin=$err_msg;
        }
    }
    else{
        if($message!=""){
            header("location:renterdashboard.php");
        }
        else{
            $ErrorLogin=$err_msg;
        }
    }

    /*if ((empty($_POST["NID"]))&& (empty($_POST["Password"])))
    {
        echo "l";
    }*/

}
?>
<?php

 include '../Head.php';

   ?>
   <br><br>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <h1 > &nbsp;&nbsp; &nbsp;Renter Login</h1>
    </head>
    <body style="background-color:lightgreen;text-align: center;">
   
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>NID No.</label><br>
    <input type="text" name="nid" id="nid" placeholder="NID" value="<?php if(isset($_COOKIE['nid'])) {echo $_COOKIE['nid'];} ?>"><br>
    <?php
    if($nidErr!=""){
        echo $nidErr;
    }
    ?>
    
    <br><br>
    <label>Password</label><br>
    <input type="password" name="pass" id="pass" placeholder="Password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];} ?>"><br>
        <?php
    if($passErr!=""){
        echo $passErr;
    }
    ?>
   <br><br>
    <script>
            function myFunction() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
            }
    </script>
    <input type="checkbox" onclick="myFunction()"> Show Password <br><br>
    <input type="checkbox" name="remember"> Remember Me <br><br>
    <input type="submit" id="login" value="Login" name="login"><br><br>
    
    <p>Not a member yet? <a href="Regform.php">Sign-up</a></p>

    <?php
    if($ErrorLogin!=""){
        echo "<span style='color:red'>Invalid NID or Password!"."</span>";
    }
    ?>
    </form>
    <?php
                      include "../Footer.php";
                    ?>
                    </body>
</html>