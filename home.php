<?php
session_start();
if (!isset($_SESSION["MaNH"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>2Beginner</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/md5.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style4.css">
    <script src="js/line-db-php.js"></script>
    <link href="css/default.css" rel="stylesheet">
    <style>
        .well {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<?php include "head.php" ?>
<div class="container-fluid main-container">
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <br>
                <img src="Image/user.png" class="img-responsive" style="margin: 0 auto">
                <h2 id="learner"></h2>
                <br>
                <table>
                    <tr>
                        <td class="left">Level speaking</td>
                        <td>Level listening</td>
                    </tr>
                    <tr>
                        <td class="left" id="speaklevel">></td>
                        <td id="listenlevel"></td>
                    </tr>
                </table>
                <br>
                <button type="button" onclick="changeclick()">Change password</button>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="well">
                <div class="chartWrapper">
                    <div class="chartAreaWrapper">
                        <div class="chartAreaWrapper2">
                            <canvas id="line-chartcanvas1"></canvas>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
            <div class="well">
                <div class="chartWrapper">
                    <div class="chartAreaWrapper">
                        <div class="chartAreaWrapper2">
                            <canvas id="line-chartcanvas2"></canvas>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php"; ?>
    </div>
</div>

<div id="password_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="oldpass">Current password:</label>
                    <input type="password" class="form-control" id="oldpass">
                </div>
                <div class="form-group">
                    <label for="newpass">New password:</label>
                    <input type="password" class="form-control" id="newpass">
                </div>
                <div class="form-group">
                    <label for="retype">Retype password:</label>
                    <input type="password" class="form-control" id="retype">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="password_modal_save" onclick="changepwd()">Save changes</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    function changeclick() {
        $('#password_modal').modal();
    }

    function changepwd() {
        var retype = $('#retype').val();
        var oldpass = $('#oldpass').val();
        var newpass = $('#newpass').val();
        if (retype == "" || oldpass == "" || newpass == "") alert("Don't let inputs empty!");
        else {
            if (retype != newpass) alert("Retype password is wrong!");
            else {
                if (newpass == oldpass) alert("New password is the same as old password. Please change!");
                else savechange(newpass, oldpass);
            }
        }
    }
</script>