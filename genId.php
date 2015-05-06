<?php
    session_start();
    $randId = mt_rand();
    $servername="localhost";
    $username="root";
    $password="dewey0921";
    $dbname="user_survey";

    $con=new mysqli($servername, $username, $password, $dbname);

    if($con->connect_error){
        echo("i am dying");
        die("connection failed ".$con->connect_error);
    }


    $sql="SELECT COUNT(*) FROM ground_truth";
    
    $result=$con->query($sql);

    $numimg = 0;

    if($result->num_rows>0){
        $row = $result->fetch_array();
        $numimg = $row[0];
    }
    $result->close();

    if($numimg==0){
        die("No image in database ");
    }

    $randnum = $randId % $numimg ;
    
    $sql = "select frame_id from ground_truth limit ".$randnum.", 1";
    
    $result=$con->query($sql);
    $fId = 0;

    if($result->num_rows>0){
        $row = $result->fetch_array();
        $fId = $row[0];
    }
    else{
        die("No image in database ");
    }
    $result->close();
    $con->close();
    echo $fId;
    $_SESSION["fId"] = $fId;
?>
