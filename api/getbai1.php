<?php
session_start();
if (!isset($_SESSION["Admin"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';


$MaBai  = $_POST["MaBai"];


$sql = "select * from bainoi where MaBai = ".$MaBai;

$result = $mysqli->query($sql) or die($conn->error);

while($row = $result->fetch_assoc()) {
    $TieuDe = $row["TieuDe"];
    $Muc = $row["Muc"];
    $Transcript = $row["Transcript"];
    $TieuChuan = $row["TieuChuan"];
    $NoiDung = $row["NoiDung"];
}
$data = array(
    'TieuDe'      => $TieuDe,
    'Muc'    => $Muc,
    'Transcript'       => $Transcript,
    'TieuChuan' => $TieuChuan,
    'NoiDung'      => $NoiDung
);
echo json_encode($data);;
?>


