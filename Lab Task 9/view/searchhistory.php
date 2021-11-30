<?php
session_start();
if (!isset($_SESSION['NID'])) {
        session_destroy();
        header("location:Homepage.php");
    }
$NID="";
$Name=$Email=$Gender=$Password=$Image="";
$searched_history ="";



if(isset($_SESSION["NID"])){
    $NID=$_SESSION["NID"];

    $data=array(
        'NID'=>$NID
    );

    require_once '../controller/getuserData.php';

    $renterdashboard=new getDataFromFile($data);

    $renter=$renterdashboard->checkFromFiles($data);

    $Name=$renter['name'];
    $Gender=$renter['gender'];
    $Email=$renter['email'];
    $Password=$renter['password'];
    $Image=$renter['Image'];


     $payment="";
    $payment_error="";
    $not_match="";
    if(isset($_POST["search"])){
        $payment=$_POST["keyword"];
        if(!empty($payment)){
        require_once '../controller/search_history.php';
        $searchhistory=new Search($payment);
        $searched_history=$searchhistory->searchpay($payment);
             
        if(empty($searched_history)){
            $not_match="No Such rent history Found";
        }
        }
        else if(empty($payment)){
         $payment_error="Search history is required ";
      }

}
}
?>

<?php

 include '../header.php';

   ?>

<html>

<head>
    <meta charset="utf-8">
    <title>Search Ad</title>
    <!--Importing bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
</head>

<body class="bd">

    <br>
    <legend style="padding-left:15px; font-family: 'Overpass', sans-serif;">Account<hr></legend>
    <div style="display:flex">
    <div>
    <?php include 'menu.php'; ?>
    </div>
    <div style="display:inline-block; padding-left:40px">
            <div class="form-group">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <h3><b>Search Ads by area</b></h3><br>
                    <input type="text" name="keyword" placeholder="Type something" id="keyword" value="" onkeyup="search_data(this.value)" style="width:55%;" class="form-control">
                    </form>
                    <div class="container" id="showD"></div>
                </div>
    </div>
    </div><br>
    <?php
    include 'footer.php';
    ?>
    <script>
        function search_data(key) {
            let id;
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                id=this.responseText;
                console.log(id);
                document.getElementById("showD").innerHTML=this.responseText;
            }
            xhttp.open("GET", "../controller/test.php?key=" + key);
            xhttp.send();
        }
    </script>
</body>
</html>
