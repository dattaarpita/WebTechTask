

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile picture</title>
</head>
<body>
	<?php
	$pictureErr= "";
    $ImgErr = $UploadConfirmation = "";
    $target_file="";

    if(isset($_POST['submit'])){
        $target_dir = "pictures/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
       
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";    
        if($_FILES['fileToUpload']['name'] != "")
        {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                
                $uploaded = 1;
            } else {
                $ImgErr = "File is not an image.";
                $uploaded = 0;
            }
        
            if (file_exists($target_file)) {
                $ImgErr = "Sorry, file already exists.";
                $uploaded = 0;
            }
        
            if ($_FILES["fileToUpload"]["size"] > 40000000000) {
                $ImgErr = "Sorry, this file is too large.";
                $uploaded = 0;
            }
        
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $ImgErr= "Only JPG, JPEG, PNG  files can be uploaded.";
                $uploaded = 0;
            }
        
            if ($uploadOk == 0) {
                $ImgErr = "Sorry, your file was not uploaded.";
            } 
            else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $UploadConfirmation = "File has been uploaded Successfully";
                    $filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                } else {
                    $ImgErr = "Sorry, there was an error uploading your file.";
                }
            }
        }else{
            $ImgErr="Select an image!";
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <h2>Change profile picture</h2>
          <img src="<?php if(!empty($filepath)){echo $filepath;}else{ echo "pictures/default.jpg";} ?>" alt="" width="300px" height="300px"><br>
          <?php
                    if ($ImgErr) {
                        echo ($ImgErr);
                    }
                    ?>
                    
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <hr>
                
                	
                    
                <input type="submit" name="submit"  value="Submit">
                
            </form>



</body>
</html>