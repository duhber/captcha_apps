<?php 
    session_start();
    $imId=$_SESSION['fId'];
    $x=$_GET['x'];
    $y=$_GET['y'];
    
    $servername="localhost";
    $username="root";
    $password="dewey0921";
    $dbname="user_survey";

    $con=new mysqli($servername, $username, $password, $dbname);

    if($con->connect_error){
        die("connection failed ".$con->connect_error);
    }
    //echo "connected successfully";
    
    $sql="SELECT x,y FROM ground_truth WHERE frame_id='$imId'";

    $result=$con->query($sql);

    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        //echo "x:".$row["x"]."<br>"."y:".$row["y"];
        $gx=$row["x"];
        $gy=$row["y"];
        //$x=$x*(4/3);
        //$y=$y*(2);
        
        //echo $gx.":".$gy."<br>".$x.":".$y;

        //echo $x.$y;
        if(($gx-25<=$x && $x<=$gx+25)&&($gy-25<=$y && $y<=$gy+25)){
            echo "Congrats! you are a human";
            $ishuman=1;
        }
        else{
            echo "Eh! you are not a human";
            $ishuman=0;
        }

        //insert user response data

        $sql2="INSERT INTO user_stat (im_id,x_truth,y_truth,x_user,y_user,ishuman)
               VALUES ('$imId','$gx','$gy','$x','$y','$ishuman')";
        if($con->query($sql2)===TRUE){
            //echo "new record created successfully";
        }
        else{
            //echo "ERROR:" . $sql . " <br>" . $con->error;
        }



    }
    else{
        //echo "0 results";
    }

    $con->close();
?>
