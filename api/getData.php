<?php
session_start();
if (!isset($_SESSION["Admin"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';


$num_rec_per_page = 5;


if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };


$start_from = ($page-1) * $num_rec_per_page;


$sqlTotal = "SELECT * FROM bainoi";

$sql = "SELECT * FROM bainoi Order By MaBai desc LIMIT $start_from, $num_rec_per_page";


$result = $mysqli->query($sql);


while($row = $result->fetch_assoc()){


    $json[] = $row;
}
$data['data'] = $json;


$result1 =  mysqli_query($mysqli,$sqlTotal);


$data['total'] = mysqli_num_rows($result1);


echo json_encode($data);


?>