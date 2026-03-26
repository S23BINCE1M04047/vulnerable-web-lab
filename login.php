<?php
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0){
    session_start();
    $_SESSION['user']=$username;
    header("Location: dashboard.php");
}
else{
    echo "Login Failed";
}
?>