<?php 

require '../helpers/dbConnection.php';
require '../helpers/checkLogin.php';
require '../helpers/functions.php';

$id = $_GET['id'];

$sql = "select * from users where id = $id";
$op  = mysqli_query($con,$sql);
$userData = mysqli_fetch_assoc($op);


$sql = "delete from users where id = $id"; 
$op = mysqli_query($con,$sql);

if($op){

    $message = ["Raw Removed"];
}else{
    $message = ["Error Try Again"];
}

   $_SESSION['Message'] = $message;

   header("location: index.php"); 


?>