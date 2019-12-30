<?php
session_start();
include 'connection.php';

//Get ID from Database
$id = $_GET['id'];
$email = $_SESSION['email'];
$sql = "SELECT cat_name FROM category WHERE id=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cat_name = $row['cat_name'];
    }
}

//Update Information
$id = $_GET['id'];
if (isset($_POST['edit'])) {
    $cat_name = $_POST['cat_name'] ? $_POST['cat_name'] : '';

    $update = "UPDATE category SET cat_name='$cat_name' WHERE id= $id";
    $sql = mysqli_query($conn, $update);
    if (!isset($sql)) {
        die("Error $sql" . mysqli_connect_error());
    } else {
         header("location: category.php");
    }
}

?>
<!--Create Edit form -->
<!doctype html>
<html>
    <head>
    <link rel="stylesheet" href="includes/parsley.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="includes/parsley.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').parsley();
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });

    </script>

    </head>
<body>
<?php
if (!empty($_SESSION['email'])) {
    ?>
<form method="post">
<button type="button" onclick="history.back();">Back</button>
<span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
    <h1>Edit category-</h1>
    Name<input type="text" id="name" name="cat_name" required value="<?php echo $cat_name; ?>" placeholder="category name" class="form-control" autofocus>
   <button type="submit" name="edit" id="btn-update"><strong>Update</strong></button>

</form>
<?php } else {header('location: login.php');}?>
</body>
</html>