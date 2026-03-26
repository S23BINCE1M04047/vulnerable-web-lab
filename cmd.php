<?php

if(isset($_GET['ip'])){

$ip = $_GET['ip'];

$output = shell_exec("ping -c 2 ".$ip);

echo "<pre>$output</pre>";

}

?>

<form>
Ping IP:
<input type="text" name="ip">
<input type="submit">
</form>