<?php
include_once "config.php";
//$mysqli = new mysqli("127.0.0.1", DB_USER, DB_PASSWORD, DB_NAME, 3306);

//echo $mysqli->host_info . "\n";
?>

<form action="file-upload.php" method="post" enctype="multipart/form-data">
    <input name="file" type="file" accept=".csv" /><br />
    <input type="submit" value="Отправить" />
</form>