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
    <title>2Beginner</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/word.js"></script>
    <script src="js/speak.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .content {
            min-height: 200px;
        }

        .borderless {
            border-top: 0 none;
            border-right: 0 none;
            border-left: 0 none;
            border-color: rgba(0, 81, 191, 0.59);
        }

        .list-group-item {
            background-color: transparent;
        }

        .well {
            opacity: 0.8;
        }

        #myInput {
            background-image: url('Image/find.png');
            background-position: 5px 5px;
            background-repeat: no-repeat;
            width: 100%;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
        }

        .listword {
            overflow: auto;
            max-height: 1000px;
        }

        a {
            color: rgba(0, 0, 0, 0.76);
            font-size: larger;
        }

        .word {
            font-size: larger;
        }

        #word {
            font-size: larger;
            color: #1b6d85;
        }

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include "head.php" ?>
<div class="container-fluid main-container">
    <div class="row">
        <div class="content">
            <div class="col-md-6 col-md-push-3 ">
                <div class="well">
                    <input type="text" id="myInput" class="form-control"
                           placeholder="Search word...">
                    <br>
                    <div class="listword">
                        <ul class="list-group" id="word-list">
                        </ul>
                        <div class="nors alert alert-info" style="font-size: larger">
                            No result matching. Do you want to search in our dictionary?
                            <button class="btn" onclick="yesclick()">Yes</button>
                            <button class="btn" onclick="noclick()">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php" ?>
    </div>
</div>

<div class="modal fade" id="ModalWord" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" id="word"></span>
                <img src="Image/audio1.png" alt="" onclick="start_listen($('#word').text())" id="listenword">
            </div>
            <div class="modal-body">
                <p id="meaning"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveWord" onclick="saveWord1($('#word').text())">Save as my words</button>
                <button type="button" class="btn btn-default" onclick="closeclick()">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    window.onload = function () {
        getListWords();
        $('.nors').hide();
    }
</script>