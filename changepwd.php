<?php
session_start();
if (!isset($_SESSION["Username"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';
if (isset($_POST["old"]) && isset($_POST["new"])) {
    $sql = "select Password from dangnhap where Password = '".$_POST["old"]."' and Username = '".$_SESSION["Username"]."'";
    $rs = $mysqli->query($sql);
    $tmp = $rs->num_rows;
    if ($tmp == 0) $result = "Your old password is incorrect!";
    else {
        $sql = "update dangnhap set Password = '".$_POST["new"]."' where Username = '".$_SESSION["Username"]."'";
        $rs = $mysqli->query($sql);
        if ($rs) $result = "success";
        else $result = "Can't change password. Try again!";
    }
    echo json_encode($result);
}
?>