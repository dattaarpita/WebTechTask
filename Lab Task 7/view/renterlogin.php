<?php
session_start();
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

     
        $_SESSION['NID']=$NIDNo;
       if(isset($_POST["remember"])){
        setcookie('nid',$_POST['nid'],time()+50);
        setcookie('password',$_POST['pass'],time()+50);

        if($message!=""){
            $_SESSION['NID']=$NIDNo;
            header("location:renterdashboard.php");
        }
        else{
            $ErrorLogin=$err_msg;
        }
    }
    else{
        if($message!=""){
            $_SESSION['NID']=$NIDNo;
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
<!DOCTYPE html>
<html>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../css/login_styles.css">
<div class="center">
    <h1>Renter Login</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="text-field">
            <label>NID No.</label><br>
            <input type="text" name="nid" id="nid" value="<?php if (isset($_COOKIE['nid'])) { echo $_COOKIE['nid']; } ?>"><br>
        </div>
        <div class="text-field">
            <span style="color:red">
                <?php
                if ($nidErr != "") {
                    echo $nidErr;
                }
                ?>
            </span><br><br>
            <label>Password</label><br>
            <input type="password" name="pass" id="pass" value="<?php if (isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>"><br>
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
        </div>
        <span style="color:red">
            <?php
            if ($passErr != "") {
                echo $passErr;
            }
            ?>
        </span><br><br>
        <div>
            <input type="checkbox" onclick="myFunction()"> Show Password <br><br>
            <input type="checkbox" name="remember"> Remember Me
        </div> <br><br>
        <input type="submit" id="login" value="Login" name="login"><br><br>
        <?php
        if ($ErrorLogin != "") {
            echo "<span style='color:red'>" . $ErrorLogin . "</span>";
        }
        ?>
        <div class="sign-up">Not a Member Yet? <a href="Regform.php">Sign Up</a></div>
    </form>
</div>
</html>


 


