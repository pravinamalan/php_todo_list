<?php 
$conn = new mysqli('localhost','root','','bootstrap_crud');

if(!$conn){
    die(mysqli_error($conn));
}
?>