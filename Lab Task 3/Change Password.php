<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Change Password</title>
</head>
<body>
	<?php
	$currpass=$newpass=$rnewpass="";
	$currpassErr=$newpassErr=$rnewpassErr="";


	 if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
          
          if (empty($_POST["currpass"])) 
    {
    $currpassErr = "Password is required";
    } 
    else 
    {
    $currpass = test_input($_POST["currpass"]);

      if (strlen($_POST["currpass"]) < 8) {
        $currpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["currpass"])) {
        $currpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["currpass"])) {
        $currpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["currpass"])) {
        $currpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["currpass"])) {
        $currpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }

        }

     
     
    if (empty($_POST["newpass"])) 
    
    {
    $newpassErr = " New password is required";
    } 


    else
    {
    $newpass = test_input($_POST["newpass"]);

       if($currpass!=$newpass)
       {

      if (strlen($_POST["newpass"]) < 8) 
      {
        $newpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["newpass"])) {
        $newpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["newpass"])) {
        $newpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["newpass"])) {
        $newpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["newpass"])) 
    {
        $newpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }

        }
        else 
        {
            $newpassErr="New Password should not be same as the Current Password";

        }
    }


    
      if (empty($_POST["rnewpass"])) 
    {
    $rnewpassErr = "Please re-type new password";
    } 
    else 
    {
    $rnewpass = test_input($_POST["rnewpass"]);
       

      if (strlen($_POST["rnewpass"]) < 8)

      {
        $rnewpassErr = "Your Password Must Contain At Least 8 Digits !"."<br>";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["rnewpass"])) {
        $rnewpassErr = "Your Password Must Contain At Least 1 Number !"."<br>";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["rnewpass"])) {
        $rnewpassErr= "Your Password Must Contain At Least 1 Capital Letter !"."<br>";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["rnewpass"])) {
        $rnewpassErr= "Your Password Must Contain At Least 1 Lowercase Letter !"."<br>";
    }
    elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["rnewpass"])) 
    {
        $rnewpassErr= "Your Password Must Contain At Least 1 Special Character !"."<br>";
    }

        

          elseif( $newpass !=$rnewpass)
          {
            $rnewpassErr="Current password must be matched with new password";
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
                    <legend style="color: brown;"><b>Change Password</b></legend>
                      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                         
                     <label><b>Enter Current Password:</b></label>
                     <input type="text" name = "currpass" value="<?php echo $currpass;?>" >
                     <?php if ($currpassErr != "") 
                        {
                        echo "*";
                        echo $currpassErr;
                    }
                    ?>
                    <br></br>


                     <label><b style="color: green;">Enter New Password:</b></label>
                     <input type="text" name = "newpass" value="<?php echo $newpass;?>" >
                     <?php if ($newpassErr != "") 
                        {
                        echo "*";
                        echo $newpassErr;
                    }
                    ?>
                    <br></br>
                        <label><b style="color: red;">Retype New Password:</b></label>
                     <input type="text" name = "rnewpass" value="<?php echo $rnewpass;?>" >
                     <?php if ($rnewpassErr != "") 
                        {
                        echo "*";
                        echo $rnewpassErr;
                    }
                    ?>
                       <hr>
                       <br>
                             <input type="submit" value="Submit">

                       </fieldset>
                           




                      </form>
                  

</body>
</html>