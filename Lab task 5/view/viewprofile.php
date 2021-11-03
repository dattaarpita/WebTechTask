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
            'gender'=>$_POST['gender'],
            'dob'=>$_POST['dob'],
            'nid'=>$_POST['nid'],
            

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
        $dobErr=$error["dobError"];
        $nidErr=$error["nidError"];
    
        $Name = $_SESSION['Name'];
        $Gender = $_SESSION['Gender'];
        $Email = $_SESSION['Email'];
        $Password = $_SESSION['Password'];
        $Image = $_SESSION['Image'];
        $DOB= $_SESSION['DOB'];
        $NID= $_SESSION['NID'];
        
        
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
    <div style="position: fixed;bottom:580px ;right:15px ;">
        
        <br>
    <?php  
    
    
    echo "Logged in as , ".$Name;

    ?>

    
    <br>
    <a href="logout.php" target="_self" >Log out</a>
    

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
                    	<<li><a href="renterdashboard.php">Dashboard</a></li>
                
                
               
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
                       
                        
                        <?php
                        echo "<img src= ".$Image." height='130px' width='150px'><br>";
                        ?>
                         
                        <label><b> Name</b></label>
                        <?php
                        echo $Name;
                        ?>
                         <?php 

                    if ($nameErr != "") 
                    {
                        echo "* ";
                        echo $nameErr;
                    }
                    ?>
                    <br><br>

                 <label><b>Email:</b>&nbsp; </label>
               
                  <?php
                        echo $Email;
                        ?>
                         <?php 
                   
                    if ($emailErr != "") 
                        {
                        echo "*";
                        echo $emailErr;
                    }
                    ?>
                    
                    <br></br>
                    <label><b>NID:</b>&nbsp; </label>
                    <?php
                        echo $NID;
                        ?>
                         

                
                    <?php 
                    if ($nidErr != "") 
                        {
                        echo "*";
                        echo $nidErr;
                    }
                    ?>
                    
                    <br></br>
                        
                        
                        <label><b>Gender:</b>&nbsp;</label>
                         
               
                        <?php
                       if($Gender=="Male")
                        {echo $Gender;
                        }
                       else if($Gender=="Female")
                        {echo $Gender;
                        }

                        ?>
                <?php 
               if($genderErr)
               {  
                echo "* ";
                echo $genderErr;

                    }
                ?><br></br>
                <label><b>Date of birth:</b>&nbsp;</label>
                    
                  <?php
                        if(empty($dob))
                            {echo $_SESSION['DOB'];
                    }
                    else{echo $dob;}
                        ?>
                         
                    <?php 
               if($dobErr)
               {  
                echo "* ";
                echo $dobErr;

                    }
                ?>
                <br>
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

