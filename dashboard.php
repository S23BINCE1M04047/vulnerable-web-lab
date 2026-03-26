<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location:index.php");
}
?>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<a href="search.php">Search User</a><br>
<a href="upload.php">Upload File</a><br>
<a href="cmd.php">Command Tool</a><br>
<a href="profile.php?id=1">View Profile</a><br>
<a href="logout.php">Logout</a>