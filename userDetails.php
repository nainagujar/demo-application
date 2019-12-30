<?php
session_start();
include 'connection.php';

$id='';
$first_name = '';
$last_name = '';
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $query = "SELECT first_name,last_name FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // print_r($row);die();
            // $id = $row['id']; 
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        }
    }
}

?>
<div class="wrapper">
<?php
if (!empty($_SESSION['email'])) {
    ?>
<html>
<body>
<span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
<button type="button" onclick="history.back();">Back</button>
<h1>Your details-</h1>
<span><strong>First name:</strong></span> <?php echo $first_name; ?></br>
<span><strong>Last name:</strong></span> <?php echo $last_name; ?></br>
<button><a class="btn btn-primary btn-sm" href="userEdit.php?id=<?php echo $id ; ?>">update details-</a></button>
</body>
</html>
<?php } else {header('location: login.php');}?>
</div>
