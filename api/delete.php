<?php
session_start();
if (!isset($_SESSION["Admin"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';


$MaBai = $_POST["MaBai"];

$sql = "DELETE FROM bainoi WHERE MaBai = '" . $MaBai . "'";

$sql1 = "select Muc, MaBai from bainoi where Muc > Muc=" . $MaBai;

$result1 = mysqli_query($mysqli, $sql1);

while ($row = mysqli_fetch_assoc($result1)) {
    $sql = "DELETE FROM bainoi WHERE MaBai = '" . $MaBai . "'";
    $result1 = mysqli_query($mysqli, $sql1);
    $tmp = $row[Muc] - 1;
    $sql2 ="update bainoi set Muc=".$tmp." where MaBai = ".$row["MaBai"]." ";
}

$result = $mysqli->query($sql) or die($conn->error);

echo json_encode([$MaBai]);
?>