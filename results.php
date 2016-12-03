<?php

require_once "DatabaseConnection.php";

$userName = $_POST['UserName'];
$password = $_POST['Password'];

        $insert = "INSERT INTO login ( UserName, Password) VALUES ('" . mysql_fix_string($con, $userName) . "',
              '" . hash("ripemd128", $_POST['Password']) . "')";

        $result = $con->query($insert);

        if (!$result){
            echo "Something went wrong while creating new record, please try again";
            echo $insert;
        }else{
            echo "Record successfully registered.";
        }
mysqli_close($con);



