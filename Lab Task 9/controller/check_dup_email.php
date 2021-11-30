<?php
require_once '../model/Model.php';

$mail=$_REQUEST['mail'];

if(checkDupEmail($mail)){

    echo "true";
}

else{
    echo "false";
}



?>