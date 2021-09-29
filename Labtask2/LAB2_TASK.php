<!DOCTYPE html>
<html ang="en" class="notranslate" translate="no">
<head>
    
    
    <meta name="google" content="notranslate" />
    
    <title>PHP SCRIPT</title>
</head>
<body style="background-color:lightblue;">

    <?php

    $name = $email = $gender = $degree1=$degree2 = $degree3=$degree4=$blood_grp = $doB = "";
    $dobday = $dobmonth = $dobyear = 0;
    $nameErr = $emailErr = $dobErr = $genderErr = $degreeErr = $blood_group_err = "";
    if (($_SERVER["REQUEST_METHOD"] == "POST"))
    {
         $name_count = $_POST["name"];
         $dobday = $_POST["day"];
        $dobmonth = $_POST["month"];
        $dobyear = $_POST["year"];
        $deg_num= 4;


        if(empty($_POST["degree1"])){

            $deg_num=$deg_num-1;
    
          }
    
          else{
    
              $degree1=test_input($_POST["degree1"]);
    
          }
          if(empty($_POST["degree2"])){

            $deg_num=$deg_num-1;
    
          }
    
          else{
    
              $degree2=test_input($_POST["degree2"]);
    
          }
          if(empty($_POST["degree3"])){

            $deg_num=$deg_num-1;
    
          }
    
          else{
    
              $degree3=test_input($_POST["degree3"]);
            }
    
              if(empty($_POST["degree4"])){

                $deg_num=$deg_num-1;
        
              }
        
              else{
        
                  $degree4=test_input($_POST["degree4"]);
        
              }
    
          
         if ( $deg_num==0) 
            {
                 $degreeErr="Degree is required";


            }
            elseif($deg_num==1)
            {   
                $degreeErr="At least two degree's has to be selected";


            }
            else{
                $degreeErr="";
            }


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
    if ((empty($_POST["day"])) or (empty($_POST["month"])) or (empty($_POST["year"])))
        {
            $dobErr = "Fill in the gaps!";
        }
        else
        {
            if(($dobday >= 1 and $dobday <= 31) and ($dobmonth >= 1 and $dobmonth <= 12) and ($dobyear >= 1953 and $dobyear <= 1998)) 

        {
            $DoB = strval($dobday) . "-" . strval($dobmonth) . "-" . strval($dobyear);
        } 

        else {
            $dobErr = " Date must be valid in - dd - (1-31) mm - (1-12) yy - (1953-1998) ";
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
  if (empty($_POST["blood_group"])) 
             {
            $blood_group_err = "Minimum one blood group has to be selected ";
        } 
        else 
        {
            $Blood_grp =  test_input($_POST["blood_group"]);
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

             <h1 style="color: blueviolet;">Fill up the registration form</h1>
              <p style="color: brown;font-size: 20px;">Please enter correct information</p>
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <fieldset>
                <legend>NAME</legend>
                <label ><b>Enter Your Name</b>&nbsp;</label>
                <input type="text" id="name" name="name"  placeholder="Your name" size="10" value="<?php echo $name;?>">
                <span style="color: red;">
                    <?php 
                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                </span>
                <hr>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>EMAIL</legend>
                <label><b>Enter your email</b>&nbsp; </label>
                <input type="text" id="email" name="email" value="<?php echo $email;?>" placeholder="Your email"><span style="color: red;">
                    <?php if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                </span>
                <hr>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>DATE OF BIRTH</legend>
                <label><b>Enter dob</b>&nbsp;</label>
                <input type="text" id="day" name="day" value="<?php if($dobday==0){}else{echo $dobday;}?>" placeholder="dd"size="2"> -
                <input type="text" id="month" name="month" value="<?php if($dobmonth==0){}else{echo $dobmonth;}?>" placeholder="mm"   size="2"> -
                <input type="text" id="year" name="year" value="<?php if($dobyear==0){}else{echo $dobyear;}?>" placeholder="yyyy" size="4"><span style="color: red;">
                    <?php if ($dobErr != "")
                     {
                        echo "* ";
                        echo $dobErr;
                    }
                    ?>
                </span> 
                <hr>  
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>GENDER</legend>
                <label><b>Enter your gender</b>&nbsp;</label>
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">
                <label for="">Male</label> 

                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="female") echo "checked";?> value="female"> 
                <label for=" ">Female</label> 
                <input type="radio" id="gender" name="gender"<?php if (isset($gender) && $gender=="other") echo "checked";?> value="other"> 
                <label for="">Other</label> <span style="color: red;">
                <?php 
               if($genderErr)
               {  
                echo "* ";
                echo $genderErr;

                    }
                ?>


                </span>
               <hr>
            </fieldset>
        </div>
              <div>
            <fieldset>
                <legend>DEGREE</legend>
                <label><b>Enter your degree</b>&nbsp;</label>
                <input type="checkbox" id="ssc" name="degree1" <?php if (isset($degree1) && $degree1=="ssc") echo "checked";?> value="ssc">SSC
                <input type="checkbox" id="hsc" name="degree2" <?php if (isset($degree2) && $degree2=="hsc") echo "checked";?> value="hsc">HSC
                <input type="checkbox" id="bsc" name="degree3" <?php if (isset($degree3) && $degree3=="bsc") echo "checked";?> value="bsc">BSC

                        
                <input type="checkbox" id="ssc" name="degree4" <?php if (isset($degree4) && $degree4=="msc") echo "checked";?> value="msc">MSC

                <span style="color: red;"> 
                <?php
                    if ($degreeErr != "") {
                        echo "* - ";
                        echo $degreeErr;
                    }
                    ?>
                </span>
                <hr>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend>BLOOD GROUP</legend>
                <label><b>Enter your blood group</b>&nbsp;</label>
                <select name="blood_group">
                    <option value="" disabled selected hidden>Select your blood group</option>
                    
                     <option <?php if (isset($Blood_grp) && $Blood_grp=="a+") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="a+") { echo ' selected="selected"'; } ?> value="a+">A+</option>
                        
                     <option <?php if (isset($Blood_grp) && $Blood_grp=="a-") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="a-") { echo ' selected="selected"'; } ?> value="a-" >A-</option>
                     <option <?php if (isset($Blood_grp) && $Blood_grp=="b+") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="b+") { echo ' selected="selected"'; } ?> value="b+">B+</option>
                    <option <?php if (isset($Blood_grp) && $Blood_grp=="b-") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="b-") { echo ' selected="selected"'; } ?> value="b-" >B-</option>
                   <option <?php if (isset($Blood_grp) && $Blood_grp=="ab+") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="ab+") { echo ' selected="selected"'; } ?> value="ab+">AB+</option>
                   <option <?php if (isset($Blood_grp) && $Blood_grp=="ab-") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="ab-") { echo ' selected="selected"'; } ?> value="ab-">AB-</option>
                   <option <?php if (isset($Blood_grp) && $Blood_grp=="o+") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="o+") { echo ' selected="selected"'; } ?> value="o+" >O+</option>
                   <option <?php if (isset($Blood_grp) && $Blood_grp=="o-") { echo ' selected="selected"'; } ?><?php if (isset($Blood_grp) && $Blood_grp=="o-") { echo ' selected="selected"'; } ?> value="">O-</option>
                </select>
                <span style="color: red;">
                    <?php
                    if ($blood_group_err != "")
                     {
                        echo "*";
                        echo $blood_group_err;
                    }
                    ?>
                </span>
                <hr>
            </fieldset>
        </div>

              <div>
            <input type="submit" value="Submit">
            </div>

                </form>


</body>
</html>
