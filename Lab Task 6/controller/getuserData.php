<?php
include_once '../model/Model.php';

class getDataFromFile{

    public $message="";
    public $error="";

    function checkFromFiles($data){
        if(getUserInfo($data)){
            $this->message="";
        }
    }

    function get_error(){
        return $this -> error;
    }

    function get_message(){
        return $this -> message;
    }

}

?>