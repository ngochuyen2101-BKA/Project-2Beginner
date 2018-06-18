<?php
session_start();
if (!isset($_SESSION["MaNH"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Begin</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <!-- Bootstrap CSS + jQuery library -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/listen.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        #list-level {
            min-height: 150px;
        }
        .card {
            margin: 50px;
            margin-top: 30px;
            text-align: center;
            border: 1px solid lightgray;
            border-radius: 15px;
            width: 260px;
            background-color: whitesmoke
            height: 200px;
            -webkit-box-shadow: 0 0 5px 5px rgba(0, 181, 169, 0.20);
            -moz-box-shadow: 0 0 5px 5px rgba(0, 181, 169, 0.20);
            box-shadow: 0 0 5px 5px rgba(0, 181, 169, 0.20);
        }
        .card-head {
            border-radius: 15px 15px 0px 0px;
            background-color: #00b5a9;
            height: 50px;
            font-weight: bold;
            color: white;
            padding: 20px;
            font-size: larger;
        }
        .card img {
            margin: 0 auto;
        }
        table {
            margin: 0 auto;
        }
        table caption {
            text-align: center;
            font-size: larger;
            font-weight: bolder;
        }
    </style>
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
                <div class="content">
                    <table>
                        <caption>Level <?php echo $level?>: Choose the mode you want to do</caption>
                        <tr>
                            <td>
                                <div class="card" onclick="clickMode1()">
                                    <div class="card-head">
                                        1. Blank Mode
                                    </div>
                                    <div class="card-body">
                                        <h4>Fill in the blanks</h4>
                                        <img src="Image/mode1.PNG" class="img-responsive">
                                        <br>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card" onclick="clickMode2()">
                                    <div class="card-head">
                                        2. Full Mode
                                    </div>
                                    <div class="card-body">
                                        <h4>Type full what you heard</h4>
                                        <img src="Image/mode2.PNG" class="img-responsive">
                                        <br>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="announce"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php"; ?>
    </div>
</div>

<?php include "ModalWord.php"?>

<script type="text/javascript">
    function clickMode1() {
        window.location = "listenMode1.php?inputLevel="+level;
    }

    function clickMode2() {
        window.location = "listenMode2.php?inputLevel="+level;
    }

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
</body>
</html>