<?php
include "config.php";

$id = $_GET['id'];

$query="SELECT * FROM users WHERE id=$id";

$result=mysqli_query($conn,$query);

$row=mysqli_fetch_assoc($result);

echo "Username: ".$row['username']."<br>";
echo "Role: ".$row['role'];
?>