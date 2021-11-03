<?php
require_once 'db_connect.php';
error_reporting(0);
session_start();


function addrenters($data){
    $conn = db_conn();
    $selectQuery = "INSERT into info (name, email, nid, password,gender,dob,Image)
VALUES (:name, :email,:nid, :password,:gender,:dob,:Image)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':name' => $data["name"],
            ':email' => $data["email"],
            ':nid' => $data["nid"],
            ':password' => $data["pass"],
            ':gender' => $data["gender"],
            ':dob' => $data["dob"],
            ':Image' => "../Pictures/default.jpg"
        ]);
    }catch(PDOException $e)
    {
        echo $e->getMessage();
         $conn = null;
        return false ;
    }
    
    $conn = null;
    return true ;

    
}
function dupEmail($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `info` where `Email`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["email"]]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}
function dupNID($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `info` where `NID`= BINARY ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$data["nid"]]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (!empty($row)) {
        return true;
    } else {
        return false;
    }
}




function checkLogin($data){

     $conn = db_conn();
        $selectQuery = "SELECT * FROM `info` where nid = ? AND password= BINARY ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$data["NID"],$data["Password"]]);
        }

        catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        
        if(!empty($row)){
            $_SESSION["NID"]=$data["NID"]; 
           return true;

        }
        else{
            return false;
       }

    
    }

    function getUserInfo($data){
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `info` where nid = ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$data["NID"]]);
        }

        catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if(!empty($row)){

            $_SESSION['Name']=$row['name'];
            $_SESSION['Email']=$row['email'];
            $_SESSION['Image']=$row['Image']; 
            $_SESSION['Gender']=$row['gender'];
            $_SESSION['Password']=$row['password'];
            $_SESSION['DOB']=$row['dob'];
            $_SESSION['NID']=$row['nid'];
           return true;

        }
        else{
            return false;
       }

        
    }



    function updateImage($data){
        
         $dp_updated=false;
         $conn = db_conn();
        $selectQuery = "UPDATE info set Image = ? where nid = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data['FilePath'], $_SESSION['NID']

            ]);
            $_SESSION['Image'] = $data['FilePath'];
            $dp_updated=true;
        }catch(PDOException $e){
            echo "change profile picture  ".$e->getMessage();
        }
        $conn = null;
           if($dp_updated){
                return true;
            }
            else{
                return false;
            }
     }
    function editUserInfo($data){
        $isUpdated=false;
        $conn = db_conn();
        $selectQuery = "UPDATE info set name = ?, email = ?,password=?,gender=? where NID = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data['name'], $data['email'], $data['pass'], $data['gender'] ,$_SESSION["NID"]
            ]);
            
            $isUpdated=true;
        }
        catch(PDOException $e)
        {
            echo "Update ".$e->getMessage();
        }
        $conn = null;
            $_SESSION["Name"]=$data['name'];
            $_SESSION["Email"]=$data['email'];
            
            $_SESSION["Gender"]=$data['gender'];
            $_SESSION["Password"]=$data['pass'];
            
            

        if($isUpdated){
        return true;
    }
    else{
        return false;
    }
    }
         function delete_info($id){
        $conn = db_conn();
        $selectQuery = "DELETE FROM `info` WHERE `nid` = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        }catch(PDOException $e){
            echo "Deleted ".$e->getMessage();
        }
        $conn = null;
       }



        
         function give_rent($data){
            $conn = db_conn();
    $selectQuery = "INSERT into payment (RNo,RID,ADNo,RAmount,RMonth,PaymentSystem)
VALUES (:RNo,:RID,:ADNo,:RAmount,:RMonth,:PaymentSystem)";
    try{
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':RNo' => $data["rentno"],
            ':RID' => $data["Renter_ID"],
            ':ADNo' => $data["Adno"],
            ':RAmount' => $data["ramount"],
            ':RMonth' => $data["rmonth"],
            ':PaymentSystem' => $data["payment"],
            
        ]);
    }catch(PDOException $e)
    {
        echo $e->getMessage();
         $conn = null;
        return false ;
    }
    
    $conn = null;
    return true ;


        
    }


    function managerent($id){
        
        $id = $_SESSION["NID"];
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `payment` WHERE RID LIKE '%$id%' ";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
    }

    function fetchpayment($id)
    {
        $conn = db_conn();
    $selectQuery = "SELECT * FROM `payment` where RNo = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

  

    return $row;
    }
    function deletepayment($id)
{
    $conn = db_conn();
    $selectQuery = "DELETE FROM `payment` WHERE `RNo` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;

    return true;
}

    function search_payment($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM `payment` WHERE PaymentSystem LIKE '%$id%'";
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


function updatepay($data)
{
        
        $conn = db_conn();
        $selectQuery = "UPDATE payment set  RAmount='".$data['RAmount']."', RMonth='".$data['RMonth']."'  WHERE RNo='".$data['RNo']."'";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $conn = null;
        echo "Done";
        return true;
    }


?>