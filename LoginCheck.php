<?php
session_start();
unset($_SESSION['badPass']);

$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

require_once 'DatabaseConnection.php';

$myusername = mysql_fix_string($con, $myusername);
$mypassword = mysql_fix_string($con, $mypassword);

$Hashed = hash("ripemd128", $mypassword);

$sql = "SELECT * FROM login Where username ='" . $myusername  . "' and password='"  . $Hashed  . "'";
$result = $con->query($sql);

if (!$result){
    $message = "Whole query" . $sql;
    echo $message;
    die('Invalid query: ' . mysqli_error($sql));
}

$count = $result->num_rows;


if($count == 1){
    $_SESSION["something"] = "Yeah stuff";
    $_SESSION['user'] = $myusername;
    $_SESSION['password'] = $mypassword;

    header("Location:LoginSuccess.php");
}else{
    header("Location:Loginform.php");
    $_SESSION['badPass']++;
}