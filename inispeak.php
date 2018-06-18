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
    $sql = 'select Muc, ketqua from lichsunoi,bainoi where bainoi.MaBai = lichsunoi.MaBai and  ThoiGian in (select max(ThoiGian) from lichsunoi where MaNH = ' . $_SESSION["MaNH"] . ' group by MaNH, MaBai)';
    $rs = $mysqli->query($sql);
    if ($rs->num_rows != 0) {
        while ($row = $rs->fetch_row()) {
            $arr[$row[0]] = $row[1];
            $count++;
        }
    }
    $highlevel = $count;
    $sql = 'select Muc from bainoi where Muc > ' . $highlevel;
    $rs = $mysqli->query($sql);
    if ($rs->num_rows > 0)
        while ($row = $rs->fetch_row()) {
            $arr[$row[0]] = 'false';
            $count++;
        }
    $sql = 'select levelspeak from nguoihoc where MaNH = ' . $_SESSION["MaNH"];
    $rs = $mysqli->query($sql);
    $row = $rs->fetch_row();
    $level = $row[0];
    if (!isset($_POST["level"])) $type = 1;
    else {
        $sql = 'select MaBai from bainoi where Muc = ' . $_POST["level"];
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
        "levelspeak" => $level,
        "levels" => $arr,
        "count" => $count
    );
    echo json_encode($result);
} else
    if ($_POST["action"] == "getcontenttype2") {
        $sql = 'select TieuDe,Transcript,NoiDung from bainoi where Muc = ' . $_POST["level"];
        $rs = $mysqli->query($sql);
        $row = $rs->fetch_row();
        $obj = array(
            "TieuDe" => $row[0],
            "Transcript" => $row[1],
            "NoiDung" => $row[2]
        );
        echo json_encode($obj);
    } else
        if ($_POST["action"] == "getcontenttype4") {
            $sql = 'select TieuDe,Transcript,NoiDung,MaBai from bainoi where Muc = ' . $_POST["level"];
            $rs = $mysqli->query($sql);
            $row = $rs->fetch_row();
            $obj = array(
                "TieuDe" => $row[0],
                "Transcript" => $row[1],
                "NoiDung" => $row[2],
                "MaBai" => $row[3]
            );
            echo json_encode($obj);
        } else
            if ($_POST["action"] == "getcontenttype3") {
                $sql = 'select TieuDe,Transcript,NoiDung,MaBai from bainoi where Muc = ' . $_POST["level"];
                $rs = $mysqli->query($sql);
                $row = $rs->fetch_row();

                $TieuDe = $row[0];
                $Transcript = $row[1];
                $NoiDung = $row[2];
                $MaBai = $row[3];
                $sql = 'select Diem,ThoiGian from lichsunoi where ThoiGian in (select max(ThoiGian) from lichsunoi where MaNH = ' . $_SESSION["MaNH"] . ' and MaBai = ' . $MaBai . '  group by MaNH, MaBai)';
                $rs = $mysqli->query($sql);
                $row = $rs->fetch_row();
                $obj = array(
                    "TieuDe" => $TieuDe,
                    "Transcript" => $Transcript,
                    "NoiDung" => $NoiDung,
                    "Diem" => $row[0],
                    "Time" => $row[1]
                );
                echo json_encode($obj);
            }
?>