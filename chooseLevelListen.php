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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/listen.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/stylePlayer.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/chooseLevelListen.css">
    <style>
        #list-level {
            min-height: 150px;
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
                <div class="guide">
                    <div class="title-guide">
                        How to learn speaking
                    </div>
                    <p class="step">STEP 1: CHOOSE A LEVEL</p>
                    <p>Please look to your left, you will the a list of levels. The levels which you passed are ticked a
                        green tick
                        <span class="glyphicon glyphicon-ok" style="color: #4cae4c"></span>.The level with <span
                                class="label label-primary">Doing</span>
                        tag is your current level. You must learn it. You cant't learn a new level if you haven't
                        finished previous levels.
                        So these levels will be hidden.</p>
                    <br>
                    <p class="step">STEP 2: CHOOSE MODE</p>
                    <p>In this step, you must choose mode. We have two mode. Mode 1 requires you fill in the blank.
                        Mode 2 is more difficult than Mode1. You must write all.</p>
                    <img src="Image/guide1.PNG" class="img-responsive">
                    <br>
                    <br>
                    <p class="step">STEP 3: LISTEN AND WRITE</p>
                    <p>After you choose a mode, you start listening and writing into the form. You can listen again. Click "Check your test"
                        to submit and see result. If you pass, you can see the transcript of the audio.</p>
                    <br>
                    <table width="100%">
                        <tr>
                            <td>
                                <p class="step">NOTICE</p>
                                <p class="notice">In the lesson if there are words you don't understand, our website support a
                                    dictionary.To use dictionary, please drag to <span style="background-color: grey">highlight</span> and click the right of mouse. You can save this word
                                    to your list.</p>
                            </td>
                            <td>
                                <img id="mouse" src="Image/mouse.png">
                            </td>
                        </tr>
                    </table>
                </div>
                <br>
                <div style="text-align:center;">
                    <button class="btn btn-primary" onclick="goto()">Go to my level</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php"; ?>
    </div>
</div>

<?php include "ModalWord.php"?>
</body>
</html>

<script>
    window.onload = function () {
        getListLevels();
    }

    function goto() {
        window.location.href = "chooseMode.php?level=" + doing;
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