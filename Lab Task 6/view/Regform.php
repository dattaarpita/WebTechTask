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
<?php

 include '../Head.php';

   ?>
<html>
    <title>Renter Registration</title>
    <body style="background-color:lightgreen;">
    <h1>Registration Form</h1>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label><b>Enter Your Name:</b></label>
    <input type="text" id="name" name="name"  placeholder="Your name" size="10" value="<?php echo $name;?>">
               <span style="color:red">
                    <?php 
                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    </span>
                    <br></br>
                    <label><b>Enter National Id:</b></label>
                     <input type="text" name = "nid" value="<?php echo $nid;?>" placeholder="NID" ><span style="color:red">
                     <?php if ($nidErr != "") 
                        {
                        echo "*";
                        echo $nidErr;
                    }
                    ?>
                </span>
                <br></br>
                
                 <label><b>Enter your email:</b>&nbsp; </label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="Your email">
                <span style="color:red">
                    <?php if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
             </span>
                    <br></br>
                    <label><b>Enter Password:</b></label>
                     <input type="password" name = "pass" id="pass" value="<?php echo $pass;?>" placeholder="Password" >
                             <span style="color:red">
                     <?php if ($passErr != "") 
                        {
                        echo "*";
                        echo $passErr;
                    }
                    ?>
                </span>
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
               <input type="checkbox" onclick="myFunction()"> Show Password 
               <br></br>
                    
                     

                     <label><b>Re-enter Password:</b></label>
                     <input type="password" name = "Cpass" id="Cpass" value="<?php echo $Cpass;?>"placeholder="Confirm Password"><span style="color:red">
                     <?php if ($CpassErr != "") 
                        {
                        echo "*";
                        echo $CpassErr;
                    }
                    ?>
                </span>
                    <br>
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
    <input type="checkbox" onclick="myFunction1()"> Show Password 
                    



                     <br></br>
                     <label><b>Enter Your Gender:</b>&nbsp;</label>
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">
                <label for="">Male</label> 

                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="Female") echo "checked";?> value="Female"> 
                <label for=" ">Female</label> 
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="other") echo "checked";?> value="other"> 
                <label for="">Other</label> 
                <span style="color:red">
                <?php 
               if($genderErr)
               {  
                echo "* ";
                echo $genderErr;

                    }
                ?>
            </span>
                
                <br></br>
                <label><b>Enter date of birth:</b>&nbsp;</label>
                    <input type="date" name="dob" value="<?php echo $dob;?>">
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
                
                <input type="submit" name="submit" value="Submit">
                <br></br>
    <?php
            if (isset($text)) {
                echo "<span style='color:green'><b>" . $text . "</b></span><br>";
            }
    ?>
    </form>
    <?php
                      include "../Footer.php";
                    ?>
    </body>
</html>
         


