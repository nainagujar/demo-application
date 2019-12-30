<?php 
session_start();
include('connection.php');

$id = $_SESSION['id'];
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];
$query = "SELECT id, cat_name FROM category";
$result = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html>

<head>
<title>Category list</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
</head>


<body> 
<?php
if (!empty($_SESSION['email'])) {
    ?> 
<div class="container">

<button type="button" onclick="history.back();">Back</button>
<span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
<h3>Category list</h3> <br />
<div class="table-responsive">
<table id="employee_data" class="table table-striped table-bordered">
<thead>
<tr>
<td>Category ID</td>
<td>Category Name</td>
<td colspan="2">Action</td>
</tr>
</thead>

<?php
while ($row = mysqli_fetch_assoc($result)) {
  $cat_id =  $row["id"];
  $cat_name = $row["cat_name"];
?>

<tr id="<?php echo $row["id"] ?>">
<td> <?php echo $cat_id ?></td>
<td> <?php echo $cat_name ?></td>
<td><a class="btn btn-primary btn-sm" href="editCat.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
<td><a class="btn btn-danger btn-sm remove" onclick='javascript:confirmationDelete($(this));return false;' href="catDelete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
</tr>
<?php }
?>
</table>
<button><a class="btn btn-primary btn-sm" href="addCat.php?id=<?php echo $id ?>">Add</a></button>
</div>
</div>
<script>
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>
<?php } else {header('location: login.php');}?>
</body>
</html>
<script>
$(document).ready(function() {
$('#employee_data').DataTable();
});
</script>