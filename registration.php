<?php 
include('connection.php');

if(isset($_POST['submit'])){
 
    $first_name = isset($_POST['first_name']) && !empty($_POST['first_name'])? $_POST['first_name'] : "";
    $last_name = isset($_POST['last_name']) && !empty($_POST['last_name'])? $_POST['last_name'] : "";
    $email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : "";
    $user_password = isset($_POST['user_password'])  && !empty($_POST['user_password']) ? $_POST['user_password'] : "";
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";
    $select = "SELECT email FROM users WHERE  email='$email'";
    $result = mysqli_query($conn,$select);
    if (mysqli_num_rows($result) > 0) {
       echo '<i style="color:red;font-size:15px;">Email already exists</i> ';
    } else {
        $insert = "INSERT INTO users(first_name,last_name,email,user_password) VALUES('$first_name','$last_name','$email','$user_password')";
        $result = mysqli_query($conn, $insert);
        if ($result) {
            echo '<i style="color:green;font-size:15px;font-family:calibri ;">You have registered successfully!</i> ';
            header("Refresh:2; url=login.php");
            exit();
        } else {
            echo "Sorry! not registered, please try again!";
        }
        if ($user_password != $confirm_password) {
            die("");
        } elseif (!$result && $user_password != $confirm_password) {
            echo "Failed to insert data";
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
    
    <form method="post" action="" role="form" data-parsley-validate=" ">
    First name
    <input type="text" name="first_name" class="form-control" required data-parsley-pattern="^[a-zA-Z ]+$" placeholder="First name">
    </br>
    Last name 
    <input type="text" name="last_name" class="form-control" required data-parsley-pattern="^[a-zA-Z ]+$" placeholder="Last name">
</br>
    Email
    <input type="email" name="email"  required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" placeholder="Email">
 </br>
    Password
    <input type="password" id="password" name="user_password" required  data-parsley-pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$" data-parsley-trigger="keyup" class="form-control" placeholder="Password">
</br>
   Confirm password
 <input type="password" name="confirm_password"  required data-parsley-pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$" data-parsley-trigger="keyup" class="form-control" placeholder="Retype password" data-parsley-equalto="#password">
    </br> 
 <button type="submit" name="submit" value="submit" >Register</button>
    </br>
    <ul><li><a href="login.php">login</a></li>
    </form>
</body>