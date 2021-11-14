<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:Homepage.php");
    }
$NID = "";

$name = $email =$un=$gender=$pass=$Cpass=$dob=$nid="";
    
    $UploadConfirmation = "";
    $target_file="";
$nameErr =$emailErr=$unErr=$genderErr=$passErr=$CpassErr=$dobErr=$pictureErr=$ImgErr=$nidErr="";
$Name = $Email = $Gender = $Password = $Image = "";


    
if (isset($_SESSION["NID"])) {
    $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $_SESSION["NID"],
    );
    require_once '../controller/getuserData.php';

    $editprofile=new getDataFromFile($data);

    $renter=$editprofile->checkFromFiles($data);

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];
  }
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       
        $data_s= array(
            'NID'=> $_SESSION['NID'],

            'name'=> $_POST['name'],
            'email'=>$_POST['email'],
            'pass'=>$_POST['pass'],
            'Cpass'=>$_POST['Cpass'],
            'gender'=>$_POST['gender']
            

        );
   require_once "../controller/editprofile.php";
        $editprofile= new editData($data_s);
    
        $editprofile->edit($data_s);
    
        $error=$editprofile->get_error();
        $message=$editprofile->get_message();


        $nameErr=$error["nameError"];
        $emailErr=$error["emailError"];
        $passErr=$error["passError"];
        $CpassErr=$error["cpasswordError"];
        $genderErr=$error["genderError"];
       
     $NID = $_SESSION["NID"];

    $data = array(
        'NID' => $_SESSION["NID"],
    );
    require_once '../controller/getuserData.php';

    $editprofile=new getDataFromFile($data);

    $renter=$editprofile->checkFromFiles($data);

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];
        
       
        
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
                        <label><b>Your Name</b></label><br>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="<?php echo $renter['name'];?>">
                        <?php 
                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    <br><br>

                 <label><b>Your email:</b>&nbsp; </label><br>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $Email;?>" placeholder="Your email">
                    <?php if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                    
                    <br></br>
                        <label><b>Password</b></label><br>
                        <input type="password" name="pass" class="form-control" id="pass" placeholder="Password" value="<?php echo $Password; ?>">
                        <?php if ($passErr != "") 
                        {
                        echo "*";
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
                              <label><b>Confirm Password</b></label><br>

                         <input type="password" name="Cpass" class="form-control" id="Cpass" placeholder="Confirm Password" value="<?php echo $Password; ?>">
                         	<?php if ($CpassErr != "") 
                        {
                        echo "*";
                        echo $CpassErr;
                    }
                    ?>
                            	
                            <br><br>
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
                        <label><b> Gender:</b>&nbsp;</label>
                <input type="radio" id="gender" name="gender" value="Male" <?php if($Gender=="Male"){echo "checked";} ?>>Male&nbsp;
                        <input type="radio" id="gender" name="gender" value="Female" <?php if($Gender=="Female"){echo "checked";} ?>>Female&nbsp;
                        <input type="radio" id="gender" name="gender" value="other" <?php if($Gender=="Other"){echo "checked";} ?>>Other&nbsp;
                <?php 
               if($genderErr)
               {  
                echo "* ";
                echo $genderErr;

                    }
                ?><br></br>
                
             
                        <input type="submit" class="btn btn-outline-success"name="edit" value="Submit"><br>
                        <?php
                        if (isset($message)) {
                            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
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

