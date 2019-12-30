<?php
include 'connection.php';

echo $id=$_GET['id']; 
$query = "DELETE FROM category WHERE id=$id";
$result = mysqli_query($conn,$query);
header("Location: category.php");
?>