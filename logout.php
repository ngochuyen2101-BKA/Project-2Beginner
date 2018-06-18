<?php
session_start();
if (!isset($_SESSION["Username"])) {
    header('Location: index.php');
    exit;
}
?>
<?php
if (isset($_SESSION["MaNH"])) {
    require 'db_config.php';
    $sql = "Update nguoihoc set DangXuatCuoi = now() where MaNH =".$_SESSION['MaNH'];
    $rs = $mysqli->query($sql);
    if ($rs) {
        session_destroy();
        header('Location: index.php');
    }
    else header('Location: home.php');;
}
else {
    session_destroy();
    header('Location: index.php');
}
?>