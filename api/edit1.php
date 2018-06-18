<?php
require 'db_config.php';


$MaBai = $_POST["MaBai"];
$post = $_POST;

echo "<pre>";
print_r($_FILES);
echo "</pre>";
$target_dir = "Audio/";
$target_file = $target_dir.basename($_FILES['LinkAudio']['name']);
echo $target_file;
move_uploaded_file($_FILES['LinkAudio']['tmp_name'], $target_file);  
$sql = "UPDATE bainghe SET TieuDe = '".$post['TieuDe']."',Muc = '".$post['Muc']."',LinkAudio = '" . $target_file. "',Transcript = '".$post['Transcript']."',TieuChuan = '".$post['TieuChuan']."' ,HiddenWords = '".$post['HiddenWords']."'
    WHERE  MaBai = '".$MaBai."'";


$result = $mysqli->query($sql);


$sql = "SELECT * FROM bainghe WHERE MaBai = '".$MaBai."'";


$result = $mysqli->query($sql);


$data = $result->fetch_assoc();


echo json_encode($data);

header("Location: ../manage_listen.php");
?>