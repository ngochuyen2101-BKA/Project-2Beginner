<?php
require 'db_config.php';
echo $_POST["HiddenWords"];
echo "<pre>";
print_r($_FILES);
echo "</pre>";
$target_dir = "Audio/";
$target_file = $target_dir.basename($_FILES['LinkAudio']['name']);
$path_file = "api/".$target_file;
move_uploaded_file($_FILES['LinkAudio']['tmp_name'], $target_file);  

$sql = "INSERT INTO bainghe (MaBai,TieuDe,Muc,LinkAudio,Transcript,TieuChuan,HiddenWords)

	VALUES (" . $_POST["MaBai"] . ",'" . $_POST["TieuDe"] . "'," . $_POST["Muc"] . ",'" . $path_file. "','" . $_POST["Transcript"] . "','" . $_POST["TieuChuan"] . "', '" . $_POST["HiddenWords"] . "')";

$result = $mysqli->query($sql);
echo $result."i";
header("Location: ../manage_listen.php");


?>