<?php 

require '../helpers/dbConnection.php';

$id = $_GET['id'];

$sql = "select * from review_doc where id = $id";
$op  = mysqli_query($con,$sql);
$userData = mysqli_fetch_assoc($op);


$sql = "delete from review_doc where id = $id"; 
$op = mysqli_query($con,$sql);

if($op){

    $message = ["Raw Removed"];
}else{
    $message = ["Error Try Again"];
}

   $_SESSION['Message'] = $message;

   header("location: index.php"); 


?>