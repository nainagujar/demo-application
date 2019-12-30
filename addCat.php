<?php
session_start();
include("connection.php");


if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $email= $_SESSION['email'];
    $cat_name =  isset($_POST['cat_name']) ? $_POST['cat_name'] : "";
        $insert = "INSERT INTO category(cat_name) VALUES('$cat_name')";
        $result = mysqli_query($conn, $insert);
        if ($result) {
            echo "Cateogry inserted successfully!";
            header('Location: category.php');
            exit();
        } else {
            echo "";
        }
    } 
?>
<head>
    <link rel="stylesheet" href="includes/parsley.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
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
    <div>
        <?php 
        if(!empty($_SESSION['email'])){
        ?>
    <button type="button" onclick="history.back();">Back</button>
    <span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
        <h3>Add category</h3>
        <div class="card-body register-card-body">
            <form action="" method="post" role="form" enctype="multipart/form-data" data-parsley-validate>
                <div class="form-group">
                  Category name<input type="text" name="cat_name" class="form-control" required data-parsley-pattern="^[a-zA-Z ]+$" placeholder="Name">
                <div class="row">
                        <button type="submit" name="submit" value="submit" >Add</button>
                    </div>
                </div>
            </form>
        </div>
        <?php } else{header('location: login.php');} ?>
    </div>
