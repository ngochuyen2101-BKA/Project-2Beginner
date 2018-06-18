<?php
session_start();
if (!isset($_SESSION["MaNH"])) {
    header("Location: index.php");
    exit();
}
header('Content-Type: application/json');
require 'db_config.php';
$query = sprintf("SELECT ThoiGian,Diem,Muc FROM lichsunoi,bainoi where lichsunoi.MaBai = bainoi.MaBai and MaNH = ".$_SESSION["MaNH"]." ORDER BY ThoiGian");
$result = $mysqli->query($query);
$data1 = array();
foreach ($result as $row) {
    $data1[] = $row;
}
$query = sprintf("SELECT ThoiGian,Diem,Muc FROM lichsunghe,bainghe where lichsunghe.MaBai = bainghe.MaBai and MaNH = ".$_SESSION["MaNH"]." ORDER BY ThoiGian");
$result = $mysqli->query($query);
$data2 = array();
foreach ($result as $row) {
    $data2[] = $row;
}
$query = "SELECT HoTen, levelspeak, levellisten from nguoihoc where MaNH = ".$_SESSION["MaNH"];
$result = $mysqli->query($query);
$learner = array();
foreach ($result as $row) {
    $learner[] = $row;
}
$result->close();
$mysqli->close();
$data = array('speak' => $data1, 'listen' => $data2, 'learner' => $learner[0]);
print json_encode($data);