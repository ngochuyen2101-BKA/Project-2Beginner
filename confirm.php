<?php
$url =  $_SERVER['REQUEST_URI'];
$url =  urldecode($url);
$parts = parse_url($url);
parse_str($parts['query'], $query);
$manh = $query['manh'];
if ($manh == '') {
    header('Location: index.php');
    exit();
}
else {
    require 'db_config.php';
    $sql = "select kichhoat from nguoihoc where MaNH = ".$manh;
    $rs = $mysqli->query($sql);
    $rows = $rs->num_rows;
    if ($rows == 0) {
        header('Location: index.php');
        exit();
    }
    else {
        $row = $rs->fetch_row();
        if ($row[0] == 1) {
            header('Location: home.php');
            exit();
        }
        else {
            $sql = "update nguoihoc set kichhoat = 1 where MaNH = ".$manh;
            $rs = $mysqli->query($sql);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>2Beginner</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        p {
            font-size: larger;
        }
        img {
            vertical-align: middle;
            display: table-cell;
            margin-left: auto;
            margin-right: auto;
        }
        .well {
            opacity: 0.7;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include "head.php" ?>
<div class="container-fluid main-container">
    <div class="row">
        <div class="col-xs-8 col-xs-push-2">
            <div class="well">
                <img src="Image/newmembers.png" alt="">
                <p class="text-center">Congratulations. You have officially become a learner at 2Beginner.<br>
                    Wish you have a good time when learning at our website.<br>Please login to continue.</p>
            </div>
            <br>
            <div class="text-center">
                <a href="index.php" class="btn btn-success">Log in</a>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php" ?>
    </div>
</div>
</body>
</html>