<?php 
session_start();
include('connection.php');
$id = $_SESSION['id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$sql = "SELECT * FROM users WHERE  id= $id";

$id = '';
$first_name = '';
$last_name ='';
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    //print_r($result); die();
    echo "<br>";
    while ($row = mysqli_fetch_assoc($result)) {
        //print_r($row);
        $id = $row["id"];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
    }
}
?>
 <div >
 <?php
if (!empty($_SESSION['email'])) {
    ?>
    <p>Welcome <?php echo $first_name. $last_name; ?>
    <span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
</p>
</br>
    <button><a class="btn btn-primary btn-sm" href="userDetails.php">View profile</a></button>
    <button><a class="btn btn-primary btn-sm" href="category.php"> View category</a></button>
    <button><a class="btn btn-primary btn-sm" href="addSports.php?id=<?php echo $id; ?>"> Add by category</a></button>
</br>
   
    <?php } else {header('location: login.php');}?>
</div>