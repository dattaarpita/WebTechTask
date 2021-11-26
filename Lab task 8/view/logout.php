<?php

session_start();

if(isset($_SESSION["NID"])){
    session_destroy();
    header("location:renterlogin.php");
}
else {
    header("location:renterlogin.php");
}


?>