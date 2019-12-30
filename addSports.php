<?php 
session_start();
include('connection.php');

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {

    if(isset($_POST['submit'])){
        $email = $_SESSION['email'];
        $category = isset($_POST['category']) ? $_POST['category'] : "";
        $sports = isset($_POST['sports']) ? $_POST['sports'] : "";
        $query = "INSERT INTO sports(cat_id,sports_name) VALUES($category,'$sports')";
        $result = mysqli_query($conn,$query);
        
        if ($result) {
            echo "Cateogry inserted successfully!";
            header('Location: sportsList.php');
            exit();
        } else {
            echo "";
        }
    }
}
?>
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
    <button type="button" onclick="history.back();">Back</button>
    <span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
    <form method="post" action="" role="form" data-parsley-validate=" ">
    <label for="Category">Category</label>
    <select name="category" id="category">
    <option value="">Select</option>
    <?php 
        $categoryData = "SELECT * FROM category";
        $result = mysqli_query($conn,$categoryData);
        foreach($result as $row)
    {?>
    <option value="<?php echo $row['id']?>"><?php echo $row['cat_name'] ?></option>
    <?php } ?>
    </select>
 </br>
    Sports Name
    <input type="text" id="sports" name="sports" required  class="form-control" placeholder="Sports Name">
</br>
<button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
</br>
<button><a class="btn btn-primary btn-sm" href="sportsList.php">View List</a></button>
    </form>
    <?php } else {header('location: login.php');}?>   
</body>