<?php
session_start();
if (!isset($_SESSION["MaNH"])) {
    header("Location: index.php");
    exit();
}
if ($_POST['action'] == 'check') {
    similar_text($_POST['s1'], $_POST['s2'], $percent);
    require 'db_config.php';
    $sql = 'Select TieuChuan from bainoi where Muc = ' . $_POST['level'];
    $rs = $mysqli->query($sql);
    $data = $rs->fetch_row();
    if ($data[0] <= $percent) {
        $sql = 'Insert into lichsunoi(MaNH,MaBai,Diem,ThoiGian,KetQua) values ('.$_SESSION["MaNH"].','.$_POST['mabai'].','.round($percent).',now(),\'true\')';
        $rs = $mysqli->query($sql);
        $sql = "select min(MaBai) from lichsunoi where ketqua = 'false' and ThoiGian in (select max(ThoiGian) from lichsunoi where MaNH = ".$_SESSION["MaNH"]." group by MaNH, MaBai)";
        $rs = $mysqli->query($sql);
        $tmp = $rs->fetch_row();
        $ma = $tmp[0];
        if ($ma == null) {
            $sql = 'select max(MaBai) from lichsunoi where ketqua = \'true\' and ThoiGian in (select max(ThoiGian) from lichsunoi where MaNH =  '.$_SESSION["MaNH"].' group by MaNH, MaBai)';
            $rs = $mysqli->query($sql);
            $tmp = $rs->fetch_row();
            $ma = $tmp[0];
        }
        $sql = 'select Muc from bainoi where MaBai = '.$ma;
        $rs = $mysqli->query($sql);
        $tmp = $rs->fetch_row();
        $levelspeak = (int) $tmp[0] + 1;
        $sql ='Update nguoihoc set levelspeak = '.$levelspeak.' where MaNH = '.$_SESSION["MaNH"];
        $rs = $mysqli->query($sql);
        $result = array(
            'percent' => round($percent),
            'done' => true,
            'next' => $levelspeak

        );
    } else {
        $sql = 'Insert into lichsunoi(MaNH,MaBai,Diem,ThoiGian,KetQua) values ('.$_SESSION["MaNH"].','.$_POST['mabai'].','.round($percent).',now(),\'false\')';
        $rs = $mysqli->query($sql);
        $sql ='Update nguoihoc set levelspeak = '.$_POST['level'].' where MaNH = '.$_SESSION["MaNH"];
        $rs = $mysqli->query($sql);
        $result = array(
            'percent' => round($percent),
            'done' => false,
            'next' => $_POST['level']
        );
    }
    echo json_encode($result);
    die;
}
?>