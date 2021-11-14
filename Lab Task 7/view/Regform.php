<?php
$name = $email =$un=$gender=$pass=$Cpass=$dob=$nid="";
    
    $UploadConfirmation = "";
    $target_file="";
$nameErr =$emailErr=$unErr=$genderErr=$passErr=$CpassErr=$dobErr=$pictureErr=$ImgErr=$nidErr="";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST["submit"]))
{
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $nid =  test_input($_POST["nid"]);
    $pass = $_POST["pass"];
    $Cpass = $_POST["Cpass"];
    if(!empty($_POST["gender"]))
    {
        $gender=$_POST["gender"];
    }
    else{
        $gender="";
    }
    if(!empty($_POST["dob"])){
        $dob=$_POST["dob"];
    }
     $data= array(
        'name'=> $name,
        'email'=>$email,
        'nid'=>$nid,
        'pass'=>$pass,
        'Cpass'=>$Cpass,
        'dob'=>$dob,
        'gender'=>$gender
    );
     require_once "../controller/renterform.php";
    $renterhome= new renters($data);

    $renterhome->addData($data);

    $error=$renterhome->get_error();
    $text=$renterhome->get_text();

    $nameErr=$error["nameError"];
    $emailErr=$error["emailError"];
    $nidErr=$error["nidError"];
    $passErr=$error["passError"];
    $CpassErr=$error["cpassError"];
    $genderErr=$error["genderError"];
    $dobErr=$error["dobError"];

}

?>

<!DOCTYPE html>
<html>
<title>Renter Registration</title>
<!--Importing bootstrap 5-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/registration_styles.css">

<body class="bd">
<div class="container-sm mb-6 mt-3 bg-light shadow">
    <div>
    <h1><b>Renter Registration Form</b></h1>
    <h4 style="color:red">Please Fill it with correct informations</h4>
</div>

    <div class="form-group">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="name" id="name" value="<?php echo $name;?>" placeholder="Full Name" class="form-control">
        <span style="color: red;"><br>
            <?php
        if ($nameErr != "") {
        echo "* - " . $nameErr;
        }
        ?></span><br>
        <label>National ID</label>
        <input type="text" name="nid" id="nid" value="<?php echo $nid;?>" placeholder="NID No." class="form-control"><span style="color: red;"><?php
        if ($nidErr != "") {
        echo "* - " . $nidErr;
        }
        ?></span><br>
        <label>Password</label>
        <input type="password" name="pass" id="pass" placeholder="Password" value="<?php echo $pass;?>" class="form-control"><span style="color: red;"><?php
        if ($passErr != "") {
        echo "* - " . $passErr;
        }
        ?></span>
        <br>
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
        <label>Confirm Password</label>
        <input type="password" name="Cpass" id="Cpass" value="<?php echo $Cpass;?>" placeholder="Confirm Password" class="form-control"><span style="color: red;">
        <?php
         if ($CpassErr != "") {
         echo "* - " . $CpassErr;
         }
        ?></span><br>
        <script>
            function myFunction1() {
                var x = document.getElementById("Cpass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <input type="checkbox" onclick="myFunction1()"> Show Password <br><br>
        <label>Email</label>
        <input type="text" name="email" id="email" value="<?php echo $email;?>" placeholder="Email" class="form-control"><span style="color: red;"><?php
         if ($emailErr != "") {
         echo "* - " . $emailErr;
         }
        ?></span><br><br>
        <label>Gender</label>&nbsp;
        <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">
                <label for="">Male</label> 

                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="Female") echo "checked";?> value="Female"> 
                <label for=" ">Female</label> 
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="other") echo "checked";?> value="other"> 
                <label for="">Other</label> <span style="color:red">
        <?php
        if ($genderErr != "") {
        echo "* - " . $genderErr;
        }
        ?>
            
        </span><br><br>
        <label><b>Date of birth:</b>&nbsp;</label>
                    <input type="date" name="dob" class="form-control"value="<?php echo $dob;?>">
                      <span style="color:red">
                    <?php 
               if($dobErr)
               {  
                echo "* ";
                echo $dobErr;

                    }
                ?>
            </span>
                <br></br>
        <input type="submit" name="submit" value="Submit" class="btn btn-success">&nbsp; <a href="Homepage.php" class="btn btn-outline-dark" target="_self" class="button1"> Go to Homepage</a><br>
        <?php
        if (isset($message)) {
            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
        }
        ?>
    </form>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
         


