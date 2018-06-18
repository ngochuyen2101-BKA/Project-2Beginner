<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["MaNH"])) {
    header("Location: index.php");
    exit();
}
if (!isset($_POST['Submit'])) {
    header("Location: chooseLevelListen.php");
    exit();
}
if (isset($_POST['total-words'])) {
    $totalWords = $_POST['total-words'];
} else {
    $totalWords = 0;
}

if (isset($_POST['listen-result'])) {
    $listenResult = $_POST['listen-result'];
} else {
    $listenResult = 0;
}

if (isset($_POST['standard-pass'])) {
    $standard = $_POST['standard-pass'];
} else {
    $standard = 100;
}

if (isset($_POST['level-next'])) {
    $level = $_POST['level-next'];
} else {
    $level = 0;
}

$point = ($listenResult / $totalWords) * 100;
$point = round($point);
if ($point < $standard) {
    $next = $level;
    $isPass = "F";
} else {
    $next = $level + 1;
    $isPass = "T";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Begin</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <!-- Bootstrap CSS + jQuery library -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleShowResult.css">
    <script src="js/jquery.js"></script>
    <script src="js/listen.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include "head.php" ?>
<div class="container-fluid main-container">
    <div class="row">
        <div class="col-md-3">
            <div class="listpanel">
                <div class="title-list">List listening levels</div>
                <div class="list-group list-group-flush" id="list-level">

                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nd">
                <div class="text-center">
                    <img src="<?php if ($isPass == "T") echo "Image/congrat.png"; else echo "Image/sad.png" ?>"
                         class="img-responsive">
                    <br>
                    <?php
                    if ($isPass == "F") echo "<span class='rs'>Better luck next time!!</span>";
                    else echo "<span class='rs'>Congratulations! You pass this level!</span>>";
                    ?>
                    <br>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                             aria-valuenow="<?php echo $point ?>" aria-valuemin="0" aria-valuemax="100"
                             style="width:<?php echo $point ?>%">
                            <?php echo $point ?>% Complete
                        </div>
                    </div>
                    <?php
                    if ($isPass == "F") echo "<a class=\"btn btn-primary\" href='chooseMode.php?level=" . $level . "'>Retry</a>
                        <a href=\"chooseLevelListen.php\" class=\"btn btn-default\">Exit</a>";
                    else {
                        echo "
                        <a class=\"btn btn-default\" href='chooseMode.php?level=" . $level . "'>Retry</a>
                        <a class='btn btn-primary' href=\"chooseMode.php?level=".$next."\">Go to next level</a>
                        <button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#ModalTranscipt\">See transcipt</button>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php"; ?>
    </div>
</div>

<div id="ModalTranscipt" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Transcript</h4>
            </div>
            <div class="modal-body">
                <p style="text-align: justify"><?php echo $_POST["transcript"]?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include "ModalWord.php" ?>

<?php
$MaBai = "";
$connect = mysqli_connect("localhost", "root", "")
or die("Khong ket noi duoc mysql");
mysqli_query($connect, "set name 'utf-8'");
mysqli_select_db($connect, "hoctienganh");
mysqli_set_charset($connect, "utf8");

/*Lay ma bai cua bai nghe vua thuc hien qua level */
$sql = "select * from bainghe where Muc='" . $level . "'";
$result = mysqli_query($connect, $sql);
if (mysqli_affected_rows($connect) > 0) {
    $row = mysqli_fetch_array($result);
    $MaBai = $row['MaBai'];
} else {
    mysqli_error($connect);
}
/*Lay thoi gian hien tai*/
date_default_timezone_set('Asia/Calcutta');
$date1 = date("Y-m-d H:i:s");
$MaNH = $_SESSION["MaNH"];
/*Ghi lai ket qua lam bai vao CSDL voi MaNH = 1 */
$sql = "insert into lichsunghe (MaNH, MaBai, Diem, ThoiGian, isPassed) ";
$sql .= "values(".$MaNH.", '" . $MaBai . "', '" . $point . "','" . $date1 . "', '" . $isPass . "')";
mysqli_query($connect, $sql);
/*Thay doi level nghe cua nguoi hoc dua theo ket qua lam bai */
$sql = "update nguoihoc set LevelListen='" . $next . "' where MaNH='" . $MaNH . "'";
$result = mysqli_query($connect, $sql);
if (mysqli_affected_rows($connect) <= 0) {
    mysqli_error($connect);
}
?>

</body>
</html>

<script>
    window.onload = function () {
        getListLevels();
    }

    $(document).contextmenu(function () {
        return false;
    });

    $("body").mousedown(function (event) {
        if (event.which == 3) {
            var s = window.getSelection();
            s.modify('extend', 'backward', 'word');
            var b = s.toString();
            s.modify('extend', 'forward', 'word');
            var a = s.toString();
            s.modify('move', 'forward', 'character');
            if (b == '') findWord(a);
            else alert("If you want to search dictionary, you can't choose more than one word.");
        }
    });
</script>
