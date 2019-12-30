<?php
session_start();
include 'connection.php';

//Get ID from Database
if(isset($_POST['update'])){
    $email = $_SESSION['email'];
$id = $_GET['id'];
    $categoryData = "SELECT sports.cat_id,sports.id,sports.sports_name,category.cat_name FROM category 
    JOIN sports
    ON category.id = sports.cat_id WHERE sports.id = $id";

    $resultQuery = mysqli_query($conn,$categoryData);
if (mysqli_num_rows($resultQuery) > 0) {
    while ($row = mysqli_fetch_assoc($resultQuery)) {
    }
}
}
?>
    <?php         
    //Update Information
    $id = $_GET['id'];
    $categoryName = isset($_POST['category']) ? $_POST['category'] : '';
    $sportsName = isset($_POST['sports']) ? $_POST['sports'] : '';

    $update = "UPDATE sports SET cat_id='$categoryName',sports_name='$sportsName' WHERE id= $id";
    $sql = mysqli_query($conn, $update);
    if($sql){
        echo "Record update successfully";
        header('Location:sportsList.php');
    }else{
        // echo "Could not update data";
    }
?>
<!--Create Edit form -->
<!doctype html>
<html>
<body>
    <?php
if (!empty($_SESSION['email'])) {
?>
<form method="post">
<button type="button" onclick="history.back();">Back</button>
<span class="nav-item">
        <a href="logout.php" style="float:right"> Logout</a>
    </span>
    <form method="post" action="" role="form" data-parsley-validate=" ">
    <label>Update Selected Record</label>
                    <select list="category" class="form-control" id="category" name="category" value="
                    <?php echo $catName; ?>" required="">
                        <option value="">Select</option>
                        <?php
                        //select data from user_type table(from master data) 
                        $category = "SELECT * FROM category";
                        $result = mysqli_query($conn, $category);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $categoryDis = $row['cat_name'];
                        ?>
                                <option value="<?php echo $id ?>">
                                    <?php echo $categoryDis ?>
                                </option>;
                        <?php
                            }
                        } else {
                            echo "0 result";
                        }
                        ?>
                    </select>
    </select>
 </br>
    Sports Name
    <input type="text" id="sports" name="sports" value="<?php echo $row['sports_name'];?>" required  class="form-control" placeholder="Sports Name">
</br>
<button type="submit" class="btn btn-primary btn-block" name="update">Update</button>
    </form>
    <?php } else {header('location: login.php');}?>
</body>
</html>