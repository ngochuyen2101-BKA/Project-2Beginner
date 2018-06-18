<?php
if (isset($_POST["submit"])) {
    require 'db_config.php';
    $sql = "update dangnhap set Password = '" . md5($_POST["new"]) . "' where Username = '" . $_POST["email"] . "'";
    $rs = $mysqli->query($sql);
    if ($rs) $result = "T";
    else {
        $result = "F";
        echo "<script> alert('Failed. Please retry!')</script>";
    }
} else {
    $result = "F";
    $url = $_SERVER['REQUEST_URI'];
    $url = urldecode($url);
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $email = $query['email'];
    if ($email == '') {
        header('Location: index.php');
        exit();
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
    <script src="js/md5.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
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
            <?php
            if ($result == "T") {
                echo '<div class="well text-center">Reset password successfully! Log in to continue.<br><a href="index.php" class="btn btn-success">Log in</a></div>';
            } else { ?>
            <div class="well">
                <h4>Please set new password for your account</h4>
                <form action="resetpassword.php" onsubmit="return validateForm()" method="post">
                <div class="control-group">
                    <input type="text" name="email" value="<?php echo $email?>" hidden>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input name="new" id="newpass" type="password" class="form-control" placeholder="New password">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input name = "retype" id="retype" type="password" class="form-control" placeholder="Retype password">
                    </div>
                    <br>
                    <div class="text-center">
                        <input type="submit" name="submit" value="Save" class="btn btn-success">
                    </div>
                </div>
                </form>
            </div>
            <?php } ?>
            <br>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php" ?>
    </div>
</div>
</body>
</html>

<script>
    function validateForm() {
        var retype = $('#retype').val();
        var newpass = $('#newpass').val();
        if (retype == "" || newpass == "") {
            alert("Don't let inputs empty!");
            return false;
        }
        else {
            if (retype != newpass) {
                alert("Retype password is wrong!");
                return false;
            }
            else {
                return true;
            }
        }
    }
</script>