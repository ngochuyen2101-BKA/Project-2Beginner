<?php
session_start();
if (!isset($_SESSION["Admin"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';

$post = $_POST;
$MaBai  = $_POST["MaBai"];

$sql = "UPDATE bainoi SET TieuDe ='".$post['TieuDe']."', Muc = ".$post['Muc'].", Transcript = '".$post['Transcript']."', 
TieuChuan = ".$post['TieuChuan'].", NoiDung = '".$post['NoiDung']."' 
    WHERE MaBai = '".$MaBai."'";


$result = $mysqli->query($sql);

echo json_encode([$result]);
?>
