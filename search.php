<?php
include "config.php";
?>

<form method="GET">
Search User:
<input type="text" name="q">
<input type="submit">
</form>

<?php

if(isset($_GET['q'])){

$q = $_GET['q'];

$query="SELECT * FROM users WHERE username LIKE '%$q%'";

$result=mysqli_query($conn,$query);

echo "Results for: ".$q."<br>";

while($row=mysqli_fetch_assoc($result)){
    echo $row['username']."<br>";
}

}
?>