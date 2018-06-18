<?php
require 'db_config.php';
$sql = "select count(MaBai) as sl from bainoi";
$rs = $mysqli->query($sql);
$row = $rs->fetch_row();
$speak = $row[0];
$sql = "select count(MaBai) as sl from bainghe";
$rs = $mysqli->query($sql);
$row = $rs->fetch_row();
$listen = $row[0];
$arr = array('speak' => $speak, 'listen' => $listen);
echo json_encode($arr);
?>