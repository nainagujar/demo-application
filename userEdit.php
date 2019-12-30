<?php 
session_start();
include('connection.php');

//Get ID from Database
$email = $_SESSION['email'];
$id = $_GET['id'];
$sql = "SELECT first_name,last_name FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
           $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        }
    }   

//Update Information
if(isset($_POST['edit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $update = "UPDATE users SET first_name='$first_name',last_name='$last_name' WHERE id= $id";
    $sql = mysqli_query($conn, $update);
    if(!isset($sql)){
        die ("Error $sql" .mysqli_connect_error());
    }
    else
    {
        header("location: userDetails.php");
    }
}

?>
<!--Create Edit form -->
<!doctype html>
<html>
<?php
if (!empty($_SESSION['email'])) {
?>
<body>
<form method="post">
<button type="button" onclick="history.back();">Back</button>
<span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
    <h1>Edit profile details-</h1>
    <input type="text" id="first_name" name="first_name" required value="<?php echo $first_name ; ?>" placeholder="First Name" class="form-control" autofocus>
   <br/><br/>
    <input type="text" id="last_name" name="last_name" required value="<?php echo $last_name ; ?>" placeholder="Last Name" class="form-control" autofocus>
    <br/><br/>
    <button type="submit" name="edit" id="btn-update"><strong>Update</strong></button>
<!--    <a href="disp.php"><button type="button" value="Update" name="edit">Cancel</button></a>-->
</form>
<!-- Alert for Updating -->
<script>
    function update(){
        var x;
        if(confirm("Updated data Sucessfully") == true){
            x= "update";
        }
    }
</script>
</body>
<?php } else {header('location: login.php');}?>
</html>


