<?php 
session_start();
include('connection.php');

if(isset($_POST['login'])){
    $email = isset($_POST['email'])? $_POST['email'] : "";
    $user_password = isset($_POST['user_password'])? $_POST['user_password'] : "";

    $select = "SELECT * FROM users WHERE email='$email' AND user_password='$user_password'";
    $result = mysqli_query($conn,$select);
    if ($count = $result->num_rows) {
        while( $rows = $result->fetch_object()){
            $_SESSION['id'] = $rows->id; 
            $_SESSION['first_name'] = $rows->first_name; 
            $_SESSION['last_name'] = $rows->last_name;
            $_SESSION['email'] = $rows->email;
        }
        echo '<i style="color:blue;font-size:15px;font-family:calibri ;">You are now logged In! </i> ';
        header("Refresh:2; url= dashboard.php");
} else {
  echo '<i style="color:red;font-size:15px;font-family:calibri ;">Invalid email/password, Please check it!</i>';
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
    Email
    <input type="email" name="email"  required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" placeholder="Email">
 </br>
    Password
    <input type="password" id="password" name="user_password" required  data-parsley-pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$" data-parsley-trigger="keyup" class="form-control" placeholder="Password">
</br>
<button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
    </br>
    <li><a href="registration.php">Registration</a></li>
    </form>
</body>