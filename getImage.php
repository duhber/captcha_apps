<?php
    session_start();
    header('Content-type: image/jpeg');
    $fId = $_SESSION["fId"];

    $side = $_GET["side"];
    $servername="localhost";
    $username="root";
    $password="dewey0921";
    $dbname="user_survey";

    $con=new mysqli($servername, $username, $password, $dbname);

    if($con->connect_error){
        die("connection failed ".$con->connect_error);
    }

    $sql = "";
    if($side=="right"){
        $sql = "select img  from rightImageRepo where fid=".$fId;
    }
    else{
        $sql = "select img  from leftImageRepo where fid=".$fId;
    }
    $result=$con->query($sql);

    if($result->num_rows>0){
        $row = $result->fetch_array();
        $img = $row[0];
        echo $img;
    }
    else{
        die("No image in database ");
    }
    $result->close();
    $con->close();
?>

