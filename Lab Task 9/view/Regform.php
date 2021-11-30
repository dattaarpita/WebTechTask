<?php
$name = $email =$un=$gender=$pass=$Cpass=$dob=$nid="";
    
    $UploadConfirmation = "";
    $target_file="";
$nameErr =$emailErr=$unErr=$genderErr=$passErr=$CpassErr=$dobErr=$pictureErr=$ImgErr=$nidErr="";
$nameError = $nidError= $passError=$cpassError= $emailError=$genderError=$dobError="";
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

<!DOCTYPE html>
<html>
<title>Renter Registration</title>
<!--Importing bootstrap 5-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/registration_styles.css">

<body class="bd">
<div class="container-sm mb-6 mt-3 bg-light shadow">
    <div>
    <h1><b>Renter Registration Form</b></h1>
    <h4 style="color:red">Please Fill it with correct informations</h4>
</div>

    <div class="form-group">
    <form onsubmit="return formvalidation()" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="name" id="name" value="<?php echo $name;?>" placeholder="Full Name"onkeyup="return nameverification()" onblur="return nameverification()"  class="form-control" data-toggle="tooltip" data-placement="top" title="">
        <span id="nameError" style="color: red;"><?php
        if ($nameError != "") {
        echo "* - " . $nameError;
        }
        ?>
        </span><br>


        <label>National ID</label>
        <input type="text" name="nid" id="nid" value="<?php echo $nid;?>" placeholder="NID No." class="form-control"onkeyup="return nidVerification()" onblur="return nidVerification()" 
         data-toggle="tooltip" data-placement="top" title=""><span id="nidError" style="color: red;">
            <?php
        if ($nidError != "") {
        echo "* - " . $nidError;
        }
        ?>
        </span><br>

        <label>Password</label>
        <input type="password" name="pass" id="pas" onkeyup="return passVerification()" 
        onblur="return passVerification()"  placeholder="Password" value="<?php echo $pass;?>" class="form-control" data-toggle="tooltip" data-placement="top" title="" >
        <span id="passError" style="color: red;">
            <?php
        if ($passError != "") {
        echo "* - " . $passError;
        }
        ?></span>
        <br>
        <script>
            function myFunction() {
                var x = document.getElementById("pas");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
        <input type="checkbox" onclick="myFunction()"> Show Password <br><br>


        <label>Confirm Password</label>
        <input type="password" name="Cpass" id="Cpass" onkeyup="return cpassVerification()" 
        onblur="return cpassVerification()"value="<?php echo $Cpass;?>" placeholder="Confirm Password" class="form-control"  data-toggle="tooltip" data-placement="top" 
        title="">
         <span id="cpassError" style="color: red;">
        <?php
         if ($cpassError != "") {
         echo "* - " . $cpassError;
         }
        ?></span><br>
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



        <label>Email</label>
        <input type="text" name="email" id="email"onkeyup="return emailVerification()" onblur="return emailVerification()" value="<?php echo $email;?>" placeholder="Email" class="form-control"
         data-toggle="tooltip" data-placement="top" title=""><span id="emailError" style="color: red;"><?php
         if ($emailError != "") {
         echo "* - " . $emailError;
         }
        ?></span>
             <br><br>
        <label>Gender</label>&nbsp;
        <input type="radio" id="m" name="gender" onclick="return genderVerification()"  <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male"> Male&nbsp;
        <input type="radio" id="f" name="gender" onclick="return genderVerification()"<?php if (isset($gender) && $gender=="Female") echo "checked";?> value="Female"> Female&nbsp;
        <input type="radio" id="p" name="gender" onclick="return genderVerification()"<?php if (isset($gender) && $gender=="Others") echo "checked";?>value="Others"> Others&nbsp;<br>
        <span id="genderError" style="color: red;">
        <?php
        if ($genderError != "") {
        echo "* - " . $genderError;
        }
        ?></span>
        <br><br>
        <label>Date of birth&nbsp;</label>
                    <input type="date" name="dob" onclick=" return dobverification()" onchange=" return dobverification()" id="dob"class="form-control"value="<?php echo $dob;?>">
                    <span id="dobError" style="color: red;"><?php
         if ($dobError != "") {
         echo "* - " . $dobError;
         }
        ?></span>
        <br></br>
        <input type="submit" name="submit" value="Submit" class="btn btn-success">&nbsp; <a href="Homepage.php" class="btn btn-outline-dark" target="_self" class="button1"> Go to Homepage</a><br>
        <?php
        if (isset($message)) {
            echo "<span style='color:green'><b>" . $message . "</b></span><br>";
        }
        ?>
    </form>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
    <script >
        
function formvalidation(){
    
    var x=document.getElementById("name").value;
    x= x.replace(/(^\s*)|(\s*$)/gi,"");
    x = x.replace(/[ ]{2,}/gi," ");
    x = x.replace(/\n /,"\n");
    var z=x.split(" ").length;
    var nameError="";
     var nidError="";
      var passError="";
      var cpassError="";
      var emailError="";
      var genderError="";
      var dobError="";
    if(x==""){
        document.getElementById("nameError").innerHTML="Name is required";
        nameError="Error";
    }
    else{
        if((/[A-Za-z]/.test(x[0]))==false){
            document.getElementById("nameError").innerHTML="Name must start with a letter";
            nameError="Error";
        }
        else if(z<2){
            document.getElementById("nameError").innerHTML="Name must contain at least two words";
            nameError="Error";
        }
         
        else{
            nameError="";
            document.getElementById("nameError").innerHTML="";
        }
    }
    
    var y=document.getElementById("nid").value;
    if(y==""){
        document.getElementById("nidError").innerHTML="NID is required";
        nidError="Error";
    }
    else{
        if(isNaN(y)==true){
            document.getElementById("nidError").innerHTML="NID can have numbers only";
            nidError="Error";
        }
        else if(y.length!=10){
            document.getElementById("nidError").innerHTML="NID must consist 10 digits only";
            nidError="Error";
        }
        else{
            nidError="";
            document.getElementById("nidError").innerHTML="";
        }
    }
    var pass=document.getElementById("pas").value;
    if(pass==""){
        document.getElementById("passError").innerHTML="Password is required";
        passError="Error";
    }
    else{
        if((/[a-z]+/.test(pass))==false){
        document.getElementById("passError").innerHTML="Password must contain at least one small letter";
        passError="Error";
        }
        
        else if((/[0-9]+/.test(pass))==false){
            document.getElementById("passError").innerHTML="Password must contain at least one number";
            passError="Error";
        }
        else if(pass.length<8){
            document.getElementById("passError").innerHTML="Password should contain at least 8 characters";
            passError="Error";
        }
        else{
            passError="";
            document.getElementById("passError").innerHTML="";
        }
    }

    var Cpass = document.getElementById("Cpass").value;
    if(Cpass==""){
        document.getElementById("cpassError").innerHTML="Confirm Password is required";
        cpassError="Error";
    }
    else{
        if(Cpass!=pass){
        document.getElementById("cpassError").innerHTML="Re-type password must be matched with password";
        cpassError="Error";
        }
        else{
            cpassError="";
            document.getElementById("cpassError").innerHTML="";
        }
    }

    email=document.getElementById("email").value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

    if(email==""){
        document.getElementById("emailError").innerHTML="Email is required";
        document.getElementById("email").focus();
        emailError="Error";

    }else{
        if (!document.getElementById("email").value.match(validRegex)){  
            document.getElementById("emailError").innerHTML="This is not a valid e-mail address"; 
            document.getElementById("email").focus();
            emailError="Error"; 
        }
        
        else if (email != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        if (this.responseText == "true") {
          emailErr = "Email Already Exists.";
          document.getElementById("emailError").innerHTML = emailErr;
        } else if (this.responseText == "false") {
          emailErr = "";
          document.getElementById("emailError").innerHTML = emailErr;
        }
      };
      xhttp.open("GET", "../controller/check_dup_email.php?mail=" + email);
      xhttp.send();
    }
        else{
            emailError="";
            document.getElementById("emailError").innerHTML="";
        }
    }


    if(document.getElementById("m").checked==false && document.getElementById("f").checked==false && document.getElementById("p").checked==false)
    {
        document.getElementById("genderError").innerHTML="Gender is required";
        genderError="Error";
    }
    else{
        genderError="";
        document.getElementById("genderError").innerHTML="";
    }

     

        var error="";
    var dob=document.getElementById("dob").value;

     if (dob == "") {
        error = "Date of Birth is required.";
        document.getElementById("dobError").innerHTML = error;
        document.getElementById("dob");
       
    } else {
        error = "";
        document.getElementById("dobError").innerHTML = error;
        document.getElementById("dob");
      
    }
    

    if(nameError!="" || nidError!="" ||passError!="" || cpassError!="" || genderError!="" || emailError!=""
        ||error!=""){
        return false;
    }else if(nameError=="" && nidError=="" && passError=="" && cpassError==""  && genderError=="" && emailError==""&& error==""){
        return true;
    }
}





function nameverification(){
    var x=document.getElementById("name").value;
    x= x.replace(/(^\s*)|(\s*$)/gi,"");
    x = x.replace(/[ ]{2,}/gi," ");
    x = x.replace(/\n /,"\n");
    var z=x.split(" ").length;
    var form_ok=0;
    if(x==""){
        document.getElementById("nameError").innerHTML="Name is required";
        document.getElementById("name").focus();
        form_ok=1;
    }
    else{
        if((/[A-Za-z]/.test(x[0]))==false){
            document.getElementById("nameError").innerHTML="Name must have start with a letter";
            document.getElementById("name").focus();
            form_ok=1;
        }
        else if(z<2){
            document.getElementById("nameError").innerHTML=" At least two words  needed";
            document.getElementById("name").focus();
            form_ok=1;
        }
          /*else if ((/[A-Za-z]/.test(name)) == false) {
            document.getElementById("nameError").innerHTML=" bnbnbnb";
            document.getElementById("name").focus();
            form_ok=1;
     }*/

        else{
            form_ok=0;
            document.getElementById("nameError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
}
    
    function nidVerification(){
    var form_ok=0;
    var y=document.getElementById("nid").value;
    if(y==""){
        document.getElementById("nidError").innerHTML="NID is required";
        document.getElementById("nid").focus();
        form_ok=1;
    }
    else{
        if(isNaN(y)==true){
            document.getElementById("nidError").innerHTML="NID can have numbers only";
            document.getElementById("nid").focus();
            form_ok=1;
        }
        else if(y.length!=10){
            document.getElementById("nidError").innerHTML="NID must consist of 10 digits only";
            document.getElementById("nid").focus();
            form_ok=1;
        }
        else{
            form_ok=0;
            document.getElementById("nidError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
}

function passVerification(){
     var form_ok=0;
    var pass=document.getElementById("pas").value;
    if(pass==""){
        document.getElementById("passError").innerHTML="Password is required";
        form_ok=1;
    }
    else{
        if((/[a-z]+/.test(pass))==false){
        document.getElementById("passError").innerHTML=" Password must contain at least one small letter";
        document.getElementById("pas").focus();
        form_ok=1;
        }
        else if((/['^£$%&*()}{@#~?><>,|=+¬-]/.test(pass))==false){
        document.getElementById("passError").innerHTML=" Password must contain at least one special character";
        document.getElementById("pas").focus();
        form_ok=1;
        }
        else if((/[0-9]+/.test(pass))==false){
            document.getElementById("passError").innerHTML="Password must contain at least one number";
            document.getElementById("pas").focus();
            form_ok=1;
        }
        else if(pass.length<8){
            document.getElementById("passError").innerHTML="Password must contain at least 8 characters";
            document.getElementById("pas").focus();
            form_ok=1;
        }
        else{
            form_ok=0;
            document.getElementById("passError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
}
function cpassVerification(){

    var form_ok=0;

    var pass=document.getElementById("pas").value;

    var Cpass = document.getElementById("Cpass").value;

    if(Cpass==""){
        document.getElementById("cpassError").innerHTML="Confirm password is required";
        document.getElementById("Cpass").focus();
        form_ok=1;
    }
    else{
        if(Cpass!=pass){
        document.getElementById("cpassError").innerHTML="Re-type password must be matched with password";
        document.getElementById("Cpass").focus();
        form_ok=1;
        }
        else{
            form_ok=0;
            document.getElementById("cpassError").innerHTML="";
        }
    }
    if(form_ok==1){
        return false;
    }else if(form_ok==0){
        return true;
    }
    

}
function emailVerification(){

    var emailError="";

    email=document.getElementById("email").value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)$/;

    if(email==""){
        document.getElementById("emailError").innerHTML="Email is required";
        document.getElementById("email").focus();
        emailError="Error";

    }else{
        if (!document.getElementById("email").value.match(validRegex)){  
            document.getElementById("emailError").innerHTML="This is not a valid e-mail address"; 
            document.getElementById("email").focus();
            emailError="Error"; 
        }  
        else if (email != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
        if (this.responseText == "true") {
          emailErr = "Email Already Exists.";
          document.getElementById("emailError").innerHTML = emailErr;
        } else if (this.responseText == "false") {
          emailErr = "";
          document.getElementById("emailError").innerHTML = emailErr;
        }
      };
      xhttp.open("GET", "../controller/check_dup_email.php?mail=" + email);
      xhttp.send();
    } 
        else{
            emailError="";
            document.getElementById("emailError").innerHTML="";
        }
    }
    if(emailError!=""){
        return false;
    }
    else if(emailError==""){
        return true;
    }
}
function genderVerification(){


if(document.getElementById("m").checked==false && document.getElementById("f").checked==false && document.getElementById("p").checked==false)
    {
        document.getElementById("genderError").innerHTML="Gender is required";
        genderError="Error";
        return false;

    }
    else{
        genderError="";
        document.getElementById("genderError").innerHTML="";
         return true;
    }
}

    function dobverification(){
    var error="";
    var dob=document.getElementById("dob").value;

     if (dob == "") {
        error = "Date of Birth is required.";
        document.getElementById("dobError").innerHTML = error;
        document.getElementById("dob");
        return false;
    } else {
        error = "";
        document.getElementById("dobError").innerHTML = error;
        document.getElementById("dob");
        return true;
    }


    }


    
</script>
</body>
</html>
         


