<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:Homepage.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";
$imageError="";
if(isset($_SESSION["NID"])){
    $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );

    require_once '../controller/getuserData.php';

    $propic=new getDataFromFile($data);

    $propic->checkFromFiles($data);

    $Name=$_SESSION['Name'];
    $Gender=$_SESSION['Gender'];
    $Email=$_SESSION['Email'];
    $Password=$_SESSION['Password'];
    $Image=$_SESSION['Image'];

    if(isset($_POST["update_dp"])){
        if(!empty($_FILES["fileToUpload"]["name"])){

        $target_dir = "../Pictures/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $Temp=$_FILES["fileToUpload"]["tmp_name"];
        $img_size=$_FILES["fileToUpload"]["size"];
        $filename=$_FILES['fileToUpload']['name']; 

        $data_img=array(
        'Image'=>$Image,
        'Directory'=>$target_dir,
        'Target_File'=>$target_file,
        'ImageType'=>$imageFileType,
        'Image_Size'=>$check,
        'Img_Size'=>$img_size,
        'File_Name'=>$filename,
        'FilePath'=>"",
        'Temporary'=>$Temp
        );

        require_once '../controller/profilepicture.php';

        $propic=new changePicture($data_img);

        $propic->change_picture($data_img);

        $error=$propic->get_error();
        $message=$propic->get_message();

        $imageError=$error["ImageErr"];

        $Image = $_SESSION['Image'];

    }
    else{
            $imageError="Choose a photo ";
        }
}


}




?>
<?php

 include '../header.php';

   ?>

<br></br>


<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet"  href="../Dashboard.css">
</head>
<body style="background-color:lightgreen;">
    
      <br>
	<div class="intro">
        
        <br>
    <?php  
    
    
    echo "Logged in as , ".$Name;

    ?>

    
    <br>
    <a href="logout.php" target="_self" >Log out</a>
    <img class="intro2" src="<?php echo $Image ?>" width="120px" height="120px"><br><br>

    </div>

    

  <div>
   <table border=1 style="width:800px; border-style: none;border-collapse: collapse;">
            
          <tr>
            
        <td  style="width:250px">
            <legend>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Account<hr></legend>
            <ul >
            
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
        <td  style="width:550px; vertical-align:top;">
            <fieldset class="fieldsetAdjust">
                <legend style="color: black; font-family:Footlight MT">Update Profile Picture</legend>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <img src="<?php echo $Image ?>" alt="" width="150px" height="150px"><br><br>
                <input type="file" name="fileToUpload" id="fileToUpload" style="color: black;"><br><br>
                <?php
                if($imageError!=""){
                    echo $imageError;
                }
                ?>
                
                <input type="submit" value="Change Profile Picture" name="update_dp" class="button" ><br></br>
                <?php
                if(isset($message)){
                    echo $message;
                }
                ?>
                </form>
            </fieldset>
           </td>
        
        </tr>
    </table> 
   </div>
   <?php
                      include "../Footer.php";
                    ?>

</body>
</html>