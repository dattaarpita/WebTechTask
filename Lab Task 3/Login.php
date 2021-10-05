<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log-in Page</title>
</head>
<body>
	<?php
      $un=$pass="";
      $unErr=$passErr="";
      if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
         
         $username_count=$_POST["un"];

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

     if (empty($_POST["pass"])) 
    {
    $passErr = "Password is required";
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
                    <legend style="color: brown;"><b>Login Form</b></legend>
                      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         


                          <label><b>User Name</b></label>
                     <input type="text" name = "un" value="<?php echo $un;?>"placeholder="Username">
                         <?php if ($unErr != "") 
                        {
                        echo "*";
                        echo $unErr;
                    }
                    ?>
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
                    
                    <input type="checkbox" id="type1" name="type1" value="Checkbox">
                    <label>Remember me</label>
                    <br></br>

                      <input type="submit" value="Submit">
             <a href=" " target="_blank">Forgot password?</a>
                     
                     </fieldset>
                     <br>
                     

                </form>




	

</body>
</html>