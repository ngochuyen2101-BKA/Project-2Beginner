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
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/speak.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .list-group {
            max-height: 300px;
            overflow: auto;
        }
        #title {
            font-size: larger;
            font-weight: bolder;
            color: #1b6d85;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include "head.php" ?>
<div class="container-fluid main-container">
    <div class="row">
        <div class="col-md-3">
            <div class="listpanel">
                <div class="title-list">List speaking levels</div>
                <div class="list-group list-group-flush" id="list-level">

                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nd">
                <div class="content">
                    <div id="ndhoc">
                        <p id="title">Content</p>
                        <br>
                        <div id="needtolearn"></div>
                    </div>
                    <p>Let practice with this exercise. Try your best.</p>
                    <div id="speaker">
                        <button id="start_listen" onclick="start_listen($('#nd').text())"><img src="Image/audio.png">
                        </button>
                    </div>
                    <div id="ndcandoc">
                        <p id="nd"><p>
                    </div>
                    <br>
                    <div id="ktra">
                        <div id="info">
                            <p id="info_start">
                                Click on the microphone icon and begin speaking for as long as you like.
                            </p>
                            <p id="info_speak_now" style="display:none">
                                Speak now.
                            </p>
                            <p id="info_no_speech" style="display:none">
                                No speech was detected. You may need to adjust your
                                <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">microphone
                                    settings</a>.
                            </p>
                            <p id="info_no_microphone" style="display:none">
                                No microphone was found. Ensure that a microphone is installed and that
                                <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
                                    microphone settings</a> are configured correctly.
                            </p>
                            <p id="info_allow" style="display:none">
                                Click the "Allow" button above to enable your microphone.
                            </p>
                            <p id="info_denied" style="display:none">
                                Permission to use microphone was denied.
                            </p>
                            <p id="info_blocked" style="display:none">
                                Permission to use microphone is blocked. To change, go to
                                chrome://settings/contentExceptions#media-stream
                            </p>
                            <p id="info_upgrade" style="display:none">
                                Web Speech API is not supported by this browser. Upgrade to <a href=
                                                                                               "//www.google.com/chrome">Chrome</a>
                                version 25 or later.
                            </p>
                        </div>
                        <div id="div_start">
                            <button id="start_button" onclick="startButton(event)"><img id="start_img"
                                                                                        src="Image/mic.png">
                            </button>
                        </div>
                        <div id="results">
                            <span class="final" id="final_span"></span>
                            <span class="interim" id="interim_span"></span>
                        </div>
                        <br>
                        <div class="btncontroll">
                            <button name="checkspeak" id="check" class="btn btn-primary" onclick="check()">Check your
                                test
                            </button>
                        </div>
                    </div>
                    <div id="announce">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php" ?>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title">Awesome!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center" id="modal-mark"></p>
                <p class="text-center" id="modal-msg">Congratulations! You have finished this level.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success btn-block" id="modal-btn" href="">Go to next level</a>
            </div>
        </div>
    </div>
</div>

<?php include "ModalWord.php"?>
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

    showInfo('info_start');
    var final_transcript = '';
    var recognizing = false;
    var ignore_onend;
    var start_timestamp;
    if (!('webkitSpeechRecognition' in window)) {
        upgrade();
    } else {
        start_button.style.display = 'inline-block';
        var recognition = new webkitSpeechRecognition();
        recognition.continuous = true;
        recognition.interimResults = true;
        recognition.onstart = function () {
            recognizing = true;
            showInfo('info_speak_now');
            start_img.src = 'Image/mic-animate.gif';
        };
        recognition.onerror = function (event) {
            if (event.error == 'no-speech') {
                start_img.src = 'Image/mic.gif';
                showInfo('info_no_speech');
                ignore_onend = true;
            }
            if (event.error == 'audio-capture') {
                start_img.src = 'Image/mic.gif';
                showInfo('info_no_microphone');
                ignore_onend = true;
            }
            if (event.error == 'not-allowed') {
                if (event.timeStamp - start_timestamp < 100) {
                    showInfo('info_blocked');
                } else {
                    showInfo('info_denied');
                }
                ignore_onend = true;
            }
        };
        recognition.onend = function () {
            recognizing = false;
            if (ignore_onend) {
                return;
            }
            start_img.src = 'Image/mic.gif';
            if (!final_transcript) {
                showInfo('info_start');
                return;
            }
            showInfo('');
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
                var range = document.createRange();
                range.selectNode(document.getElementById('final_span'));
                window.getSelection().addRange(range);
            }
        };
        recognition.onresult = function (event) {
            var interim_transcript = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    final_transcript += event.results[i][0].transcript;
                } else {
                    interim_transcript += event.results[i][0].transcript;
                }
            }
            final_transcript = capitalize(final_transcript);
            final_span.innerHTML = linebreak(final_transcript);
            interim_span.innerHTML = linebreak(interim_transcript);
        };
    }

    function upgrade() {
        start_button.style.visibility = 'hidden';
        showInfo('info_upgrade');
    }

    var two_line = /\n\n/g;
    var one_line = /\n/g;

    function linebreak(s) {
        return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
    }

    var first_char = /\S/;

    function capitalize(s) {
        return s.replace(first_char, function (m) {
            return m.toUpperCase();
        });
    }

    function startButton(event) {
        if (recognizing) {
            recognition.stop();
            return;
        }
        final_transcript = '';
        recognition.lang = 'en-US';
        recognition.start();
        ignore_onend = false;
        final_span.innerHTML = '';
        interim_span.innerHTML = '';
        start_img.src = 'Image/mic-slash.gif';
        showInfo('info_allow');
        start_timestamp = event.timeStamp;
    }

    function showInfo(s) {
        if (s) {
            for (var child = info.firstChild; child; child = child.nextSibling) {
                if (child.style) {
                    child.style.display = child.id == s ? 'inline' : 'none';
                }
            }
            info.style.visibility = 'visible';
        } else {
            info.style.visibility = 'hidden';
        }
    }
</script>