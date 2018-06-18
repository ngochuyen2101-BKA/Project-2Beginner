<?php
session_start();
if (!isset($_SESSION["MaNH"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';
if ($_POST["action"] == "getlistword") {
    $arr = [];
    $count = 0;
    $sql = 'select Tu from TuVung where MaNH = '.$_SESSION["MaNH"];
    $rs = $mysqli->query($sql);
    while ($row = $rs->fetch_row()) {
        $arr[$count] = $row[0];
        $count++;
    }
    echo json_encode($arr);
}
else
    if ($_POST["action"] == "delword") {
        $sql = "delete from TuVung where Tu = '".$_POST["word"]."' and MaNH = ".$_SESSION["MaNH"];
        $rs = $mysqli->query($sql);
        if ($rs) echo json_encode("success");
        else echo json_encode("failed");
    }
?>