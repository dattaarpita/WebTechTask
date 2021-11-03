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

    $editprofile->checkFromFiles($data);

    $Name = $_SESSION['Name'];
    $Gender = $_SESSION['Gender'];
    $Email = $_SESSION['Email'];
    $Password = $_SESSION['Password'];
    $Image = $_SESSION['Image'];
  
   if(isset($_POST["edit"])){
       
        $data_s= array(
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
       
    
        $Name = $_SESSION['Name'];
        $Gender = $_SESSION['Gender'];
        $Email = $_SESSION['Email'];
        $Password = $_SESSION['Password'];
        $Image = $_SESSION['Image'];
       
        
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
    <link rel="stylesheet" href="../Dashboard.css">
</head>

<body style="background-color:lightgreen;">

    <br>
    <div class="intro">

        <br>
        <?php


        echo "Logged in as , " . $Name;

        ?>


        <br>
        <a href="logout.php" target="_self">Log out</a>
        <img class="intro2" src="<?php echo $Image ?>" width="120px" height="120px"><br><br>

    </div>

    <br></br>

    <div>
        <table border=1 style="width:800px; border-style: none;border-collapse: collapse;">

            <tr>
            <td style="width:250px">
                    <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account
                        <hr>
                    </legend>
                    <ul>
                    	<li><a href="renterdashboard.php">Dashboard</a></li>
                 <li><a href="viewprofile.php">View Profile</a></li>
                <li><a href="Editprofile.php">Edit Profile</a></li>
                  <li><a href="profilepic.php">Change Profile Picture</a></li>
                  <li><a href="give_rent.php">Give Rent</a></li>
                   <li><a href="renthistory.php">Rent History</a></li>
                
                <li><a href="searchhistory.php">Search Payment History</a></li>

                <li><a href="see_add.php">See Add</a></li>
             
                <li><a href="chat.php">Chat</a></li>
                
                <li><a href="check_notices.php">Check Notices</a></li>
                <li><a href="logout.php">Log out</a></li>
                <li><a href="deleteprofile.php">Delete Account</a></li>
               
               

            </ul>
            </td>
                <td style="width:550px; vertical-align:top;">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <label><b>Your Name</b></label><br>
                        <input type="text" name="name" id="name" placeholder="Full Name" value="<?php echo $Name;?>">
                        <?php 
                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    <br><br>

                 <label><b>Your email:</b>&nbsp; </label><br>
                <input type="text" id="email" name="email" value="<?php echo $Email;?>" placeholder="Your email">
                    <?php if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                    
                    <br></br>
                        <label><b>Password</b></label><br>
                        <input type="password" name="pass" id="pass" placeholder="Password" value="<?php echo $Password; ?>">
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
                              <label><b>Confirm Password<b></label><br>

                         <input type="password" name="Cpass" id="Cpass" placeholder="Confirm Password" value="<?php echo $Password; ?>">
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
                        <label><b> Your gender:</b>&nbsp;</label>
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
                
             
                        <input type="submit" name="edit" value="Submit"><br>
                        <?php
                        if (isset($message)) {
                            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
                        }
                        ?>
                        </form>
                </td>
            </tr>
        </table>
    </div>
                    <?php
                      include "../Footer.php";
                    ?>

</body>
</html>

