<?php
include 'connection.php';
 $id=$_GET['id']; 
$query = "DELETE FROM sports WHERE id=$id";
$result = mysqli_query($conn,$query);
header("Location: sportsList.php");
?>