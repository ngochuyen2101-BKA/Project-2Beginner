<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<style>
    .navbar-default {
        background-color: #555555;
        border-color: #555555;
    }

    .dotcom {
        color: #00b5a9;
    }

    .logo {
        font-family: Verdana;
        line-height: 1;
        font-weight: bold;
        font-size: 38px;
        letter-spacing: 3px;
        color: #555555;
        display: block;
        position: relative;
        padding-bottom: 15px;
        padding-top: 25px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .slogan {
        color: #4b4b4b;
        font-size: 20px;
        padding-top: 30px;
        font-weight: lighter;
        font-family: "Courier New";
    }

    .navbar-default .navbar-brand {
        color: white;
    }

    .navbar-default .navbar-nav > li > a {
        font-size: x-large;
        font-family: "Courier New";
        color: white;
    }

    .navbar-default .navbar-brand:hover {
        opacity: 0.6;
    }

    .navbar-default .navbar-nav > li > a:hover {
        opacity: 0.6;
    }

    .affix {
        top: 0;
        width: 100%;
        z-index: 9999 !important;
    }

    .affix + .main-container {
        padding-top: 80px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="logo">2Beginner<span class="dotcom">.com</span></div>
        </div>
        <div class="col-md-6 col-xs-12 text-right">
            <div class="slogan">Let us help you make your future</div>
        </div>
    </div>
</div>
<nav class="navbar navbar-default navbar-inverse" id="myHeader" data-spy="affix" data-offset-top="197">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
    </div>
    <div class="collapse navbar-collapse navbar-default" id="myNavbar">
        <ul class="nav navbar-nav navbar-left">
            <?php
            if (isset($_SESSION["MaNH"])) {
                echo '<li><a href="chooseLevelListen.php">Listening</a></li>
                    <li><a href="start_speaking.php">Speaking</a></li>
                    <li><a href="mywords.php">Vocabulary</a></li>
                    <li><a href="home.php">MyHome</a></li>';
            } else {
                if (isset($_SESSION["Admin"])) {
                    echo '<li><a href="manage_speak.php">Manage_Speaking_Levels</a></li>
                    <li><a href="manage_listen.php">Manage_Listening_Levels</a></li>
                    <li><a href="Admin.php">MyInfo</a></li>';
                }
            }
            ?>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
                if (isset($_SESSION["Username"])) {
                    echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" title="Log out"></span></a></li>';
                }
            ?>
        </ul>
    </div>
</nav>

