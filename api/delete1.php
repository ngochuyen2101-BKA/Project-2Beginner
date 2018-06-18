<?php
require 'db_config.php';
echo $_POST["MaBai"];
$sql = "DELETE FROM bainghe WHERE  MaBai = ". $_POST["MaBai"] ."";


$result = $mysqli->query($sql);
header("Location: ../manage_listen.php");

?>