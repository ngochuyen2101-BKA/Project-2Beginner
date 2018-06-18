<?php
session_start();
if (!isset($_SESSION["MaNH"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';
if ($_POST["action"] == "getlist") {
    $arr = [];
    $count = 0;
    $sql = 'select Muc, isPassed from lichsunghe,bainghe where bainghe.MaBai = lichsunghe.MaBai and  ThoiGian in (select max(ThoiGian) from lichsunghe where MaNH = ' . $_SESSION["MaNH"] . ' group by MaNH, MaBai)';
    $rs = $mysqli->query($sql);
    if ($rs->num_rows != 0) {
        while ($row = $rs->fetch_row()) {
            $arr[$row[0]] = $row[1];
            $count++;
        }
    }
    $highlevel = $count;
    $sql = 'select Muc from bainghe where Muc > ' . $highlevel;
    $rs = $mysqli->query($sql);
    if ($rs->num_rows > 0)
        while ($row = $rs->fetch_row()) {
            $arr[$row[0]] = 'F';
            $count++;
        }
    $sql = 'select levellisten from nguoihoc where MaNH = ' . $_SESSION["MaNH"];
    $rs = $mysqli->query($sql);
    $row = $rs->fetch_row();
    $level = $row[0];
    if (!isset($_POST["level"])) $type = 1;
    else {
        $sql = 'select MaBai from bainghe where Muc = ' . $_POST["level"];
        $rs = $mysqli->query($sql);
        $row = $rs->num_rows;
        if ($row == 0) $type = 1;
        else {
            if ($level < $_POST["level"]) $type = 2;
            else
                if ($level > $_POST["level"]) $type = 3;
                else $type = 4;
        }
    }
    $result = array(
        "type" => $type,
        "levellisten" => $level,
        "levels" => $arr,
        "count" => $count
    );
    echo json_encode($result);
} else
    if ($_POST["action"] == "getcontenttype3") {
        $sql = 'select MaBai from bainghe where Muc = ' . $_POST["level"];
        $rs = $mysqli->query($sql);
        $row = $rs->fetch_row();
        $MaBai = $row[0];
        $sql = 'select Diem,ThoiGian from lichsunghe where ThoiGian in (select max(ThoiGian) from lichsunghe where MaNH = ' . $_SESSION["MaNH"] . ' and MaBai = ' . $MaBai . '  group by MaNH, MaBai)';
        $rs = $mysqli->query($sql);
        $row = $rs->fetch_row();
        $obj = array(
            "Diem" => $row[0],
            "Time" => $row[1]
        );
        echo json_encode($obj);
    }
?>