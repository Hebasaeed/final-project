<?php 

require '../helpers/dbConnection.php';

$id = $_GET['id'];

// $sql = "select * from new_patient where id = $id";
// $op  = mysqli_query($con,$sql);
// $userData = mysqli_fetch_assoc($op);


$sql = "delete from new_patient where id = $id"; 
$op = mysqli_query($con,$sql);

if($op){

    $message = ["Raw Removed"];
}else{
    $message = ["Error Try Again"];
}

   $_SESSION['Message'] = $message;

   header("location: index.php"); 


?>