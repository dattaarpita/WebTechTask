<!DOCTYPE html>
<html ang="en" class="notranslate" translate="no">
<head>
    
    
    <meta name="google" content="notranslate" />
    
    <title>Do Registration first!</title>
</head>
<body style="background-color:skyblue;">

    <?php

    $name = $email =$un=$gender=$pass=$Cpass=$dob="";
    
    $nameErr =$emailErr=$unErr=$genderErr=$passErr=$CpassErr=$dobErr="";
    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
         $name_count = $_POST["name"];
         $username_count=$_POST["un"];
         
         


        
     if (empty($_POST["name"])) 
        {
            $nameErr = "Name is required";
        } 
        else {
            $name = test_Input($_POST["name"]);
            if ((!preg_match("/^[a-zA-Z-'. ]*$/", $name)) or (str_word_count($name_count) < 2)) {
                $nameErr = "At least two words and Alphabets only";
            }
        }

         if (empty($_POST["email"])) 
        {
            $emailErr = "Email is required";
        } 


        else 
        {
            $email = test_Input($_POST["email"]);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
         {
            $emailErr= "Invalid Email !";
        }
    }
    if (empty($_POST["gender"])) 
    {
    $genderErr = "Gender is required";
    } 
    else 
    {
    $gender = test_input($_POST["gender"]);
     }
     
     if (empty($_POST["pass"])) 
    {
    $passErr = "Please enter password";
    } 
    else 
    {
    $pass = test_input($_POST["pass"]);

      if (strlen($_POST["pass"]) < 8) {
        $passErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["pass"])) {
        $passErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["pass"])) {
        $passErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["pass"])) {
        $passErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["pass"])) {
        $passErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }





      }


      if (empty($_POST["Cpass"])) 
    {
    $CpassErr = "Please re-enter password";
    } 
    
    else 
    {
    $Cpass = test_input($_POST["Cpass"]);
       

      if (strlen($_POST["Cpass"]) < 8)

      {
        $CpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["Cpass"])) {
        $CpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["Cpass"])) {
        $CpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["Cpass"])) {
        $CpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["Cpass"])) 
    {
        $CpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }

        

          elseif( $pass !=$Cpass)
          {
            $CpassErr="Re-type password must be matched with password";
          }
       }




      if (empty($_POST["un"])) 
    {
    $unErr = "Enter user name";
    }

    else 
    {
    $un = test_input($_POST["un"]);


         if ( (str_word_count($username_count) < 2)) 
         {
                $unErr = "At least two characters and Alphabets only";
            }


          elseif (!preg_match('/^[A-Za-z0-9\s.-._]+$/', $un))
          {
            $unErr= "User Name must contain alpha numeric characters, period, dash or underscore only!";
          }

       }
       if (empty($_POST["dob"])) 
    {
    $dobErr = "dob is required";
    } 
    else 
    {
    $dob = test_input($_POST["dob"]);
     }
   $insertion = "";
   if($nameErr =="" && $emailErr==""&&$unErr==""&&$genderErr==""&&$passErr==""&&$CpassErr==""&&$dobErr=="")
     {
        if (file_exists("info.json"))
             {
            $current_content = file_get_contents("info.json");
            $array_content = json_decode($current_content, true);
            $new_content = array(
                'Name' => $_POST["name"],
                'Email' => $_POST["email"],
                'Username' => $_POST["un"],
                'Password' => $_POST["pass"],
                'Gender' => $_POST["gender"],
                'DOB' => $dob
                );
            $array_content[] = $new_content;
            $final_content = json_encode($array_content, JSON_UNESCAPED_SLASHES);
            if (file_put_contents("info.json", $final_content)) {
                $insertion = "Registration done successfully!";
            }
        }
        else 
        {
            $insertion = "JSon File Does not Exist";
        }
    } 



 }




    function test_Input($data)
    {
        $information = trim($data);
        $information = stripslashes($data);
        $information = htmlspecialchars($data);
        return $data;
    }

?>
            <fieldset>
                    <legend style="color: brown;"><b>Registration Form</b></legend>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        
            
               
                <label ><b>Enter Your Name</b>&nbsp;</label>
                <input type="text" id="name" name="name"  placeholder="Your name" size="10" value="<?php echo $name;?>">
               
                    <?php 
                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    <hr>
                    <br></br>
                
                 <label><b>Enter your email</b>&nbsp; </label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="Your email">
                    <?php if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                    <hr>
                    <br></br>

                    <label><b>Enter User Name</b></label>
                     <input type="text" name = "un" value="<?php echo $un;?>"placeholder="Your username">
                         <?php if ($unErr != "") 
                        {
                        echo "*";
                        echo $unErr;
                    }
                    ?>

                       <hr>

                     <br></br>

                    <label><b>Enter Password</b></label>
                     <input type="text" name = "pass" value="<?php echo $pass;?>" >
                     <?php if ($passErr != "") 
                        {
                        echo "*";
                        echo $passErr;
                    }
                    ?>
                    <hr>
                     <br><br /> 

                     <label><b>Re-enter Password</b></label>
                     <input type="text" name = "Cpass" value="<?php echo $Cpass;?>">
                     <?php if ($CpassErr != "") 
                        {
                        echo "*";
                        echo $CpassErr;
                    }
                    ?>
                    <hr>



                     <br> <br /> 




                    <label><b>Enter your gender</b>&nbsp;</label>
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">
                <label for="">Male</label> 

                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="female") echo "checked";?> value="female"> 
                <label for=" ">Female</label> 
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="other") echo "checked";?> value="other"> 
                <label for="">Other</label> 
                <?php 
               if($genderErr)
               {  
                echo "* ";
                echo $genderErr;

                    }
                ?>
                <hr>
                <br></br>


                    <label><b>Enter date of birth</b>&nbsp;</label>
                    <input type="date" name="dob" value="<?php echo $dob;?>">

                    <?php 
               if($dobErr)
               {  
                echo "* ";
                echo $dobErr;

                    }
                ?>
                <hr>

                    </fieldset>
            <br>
        
          <div>
            
            <input type="submit" value="Submit">
             <input type="reset" value="Reset">
            </div>

            <?php
            if (isset($insertion)) {
                echo "<span style='color:brown'><b>" . $insertion . "</b></span><br>";
            }
            ?>

                </form>


</body>
</html>