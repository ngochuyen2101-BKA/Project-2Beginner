<?php
session_start();
if (!isset($_SESSION["Admin"])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';
$sql = "select HoTen from admin where Email ='".$_SESSION["Username"]."'";
$rs = $mysqli->query($sql);
$row = $rs->fetch_row();
$name = $row[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>2Beginner</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/md5.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #555555;
            box-shadow: 0px 0px 0px 0px #555555;
        }

        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width: auto;
            padding: 0 10px;
            border-bottom: none;
        }

        .well {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<?php include "head.php" ?>
<div class="container-fluid main-container">
    <div class="row">
        <div class="col-sm-6 col-sm-push-3 well">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">My Infomation</legend>
                <p>Name: <?php echo $name?></p>
                <p>Email: <?php echo $_SESSION["Username"]?></p>
            </fieldset>
            <h4>Change password</h4>
            <div class="control-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="oldpass" type="password" class="form-control" placeholder="Old password">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="newpass" type="password" class="form-control" placeholder="New password">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="retype" type="password" class="form-control" placeholder="Retype password">
                </div>
                <br>
                <div class="text-center">
                    <button class="btn btn-primary" onclick="changepwd()">Change</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php"; ?>
    </div>
</div>
</body>
</html>

<script>
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

    function savechange(newpass, oldpass) {
        $.ajax({
            url: 'changepwd.php',
            dataType: "json",
            data: {"old": CryptoJS.MD5(oldpass).toString(), "new": CryptoJS.MD5(newpass).toString()},
            type: 'post',
            success: function (output) {
                if (output == "success") {
                    alert("Successfully!\nYou changed your password!");
                    $('#retype').val('');
                    $('#oldpass').val('');
                    $('#newpass').val('');
                }
                else {
                    alert(output);
                }
            }
        });
    }
</script>