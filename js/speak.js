var mylevel = 1;
var mabai = 4;
var doing = 1;

function saveWord(word) {
    console.log(word);
    $.ajax({
        url: 'saveword.php',
        dataType: "json",
        data: {"word": word},
        type: 'post',
        success: function (output) {
            alert(output);
        }
    });
}

function findWord(word) {
    var newword = word.toLowerCase().trim();
    var url = "http://api.wordnik.com:80/v4/word.json/" + newword + "/definitions?limit=200&includeRelated=true&useCanonical=false&includeTags=false&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5"
    console.log(url);
    $.ajax({
        url: url,
        type: 'get',
        success: function (output) {
            if (output.length != 0) {
                var tmp = "";
                var mean = "";
                for (i = 0; i < output.length; i++) {
                    if (output[i].partOfSpeech != tmp) {
                        tmp = output[i].partOfSpeech;
                        mean += "<b>" + output[i].partOfSpeech + "</b><br>";
                    }
                    mean += "- " + output[i].text + "<br>";
                }
                $('#word').text(newword);
                $('#meaning').html(mean);
                $('#ModalWord').modal();
            }
            else {
                $('#listenword').hide();
                $('#word').text(newword);
                $('#meaning').text('Sorry, our dictionary haven\'t updated this word.');
                $('#saveWord').hide();
                $('#ModalWord').modal();
            }
        }
    });
}

function start_listen(content) {
    var msg = new SpeechSynthesisUtterance();
    var voices = speechSynthesis.getVoices();
    msg.voice = voices[1]; // giọng người đọc
    msg.voiceURI = 'native';
    msg.volume = 1; // 0 đến 1
    msg.rate = 1; // 0.1 đến 10
    msg.pitch = 2; // 0 đến 2
    msg.text = content;
    msg.lang = 'en-US'
    speechSynthesis.speak(msg);
}

function check() {
    var s1 = $("#final_span").text().toLowerCase();
    if (s1 != "") {
        var s2 = $("#nd").text().toLowerCase();
        s2 = s2.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, "")
        s2 = s2.replace(/\s{2,}/g, ' ');
        $.ajax({
            url: "checkspeak.php",
            dataType: "json",
            data: {"action": "check", "s1": s1, "s2": s2, "level": mylevel, "mabai": mabai},
            type: 'post',
            success: function (output) {
                console.log(output);
                if (output.done) {
                    $('.modal-confirm .btn').css('background', '#82ce34');
                    $('.modal-confirm .icon-box').css('background', '#82ce34');
                    $('.material-icons').html('&#xE876;');
                    $('.modal-title').html('Awesome!');
                    $('#modal-btn').text('Go to next level');
                    $('#modal-mark').html(output.percent + "/100");
                    $('#modal-btn').attr("href", "speak.php?level=" + output.next);
                    $('#modal-msg').html('Congratulations! You have finished level ' + mylevel + '.');
                    //show button next + change tag in list-group if modal is closed
                }
                else {
                    $('.modal-confirm .btn').css('background', '#ef513a');
                    $('.modal-confirm .icon-box').css('background', '#ef513a');
                    $('.material-icons').html('&#xE5CD;');
                    $('.modal-title').html('Sorry!');
                    $('#modal-msg').html('Please go back and do again. Try your best.');
                    $('#modal-btn').text('OK');
                    $('#modal-mark').html(output.percent + "/100");
                    $('#modal-btn').attr("href", "speak.php?level=" + output.next);
                    //clear input
                }
                $('#myModal').modal('show');
            }
        });
    }
    else alert("You can't submit empty content.")
}

function getListLevels() {
    var level = getUrlParameter('level');
    $.ajax({
        url: "inispeak.php",
        dataType: "json",
        data: {action: "getlist", level: level},
        type: 'post',
        success: function (output) {
            console.log(output.type);
            var arr = output.levels;
            var count = output.count;
            doing = output.levelspeak;
            for (i = 1; i <= count; i++) {
                if (i == doing)
                    $('#list-level').append('<a href="speak.php?level=' + i + '" class="list-group-item list-group-item-action">\n' +
                        '                            Level ' + i + '\n' +
                        '                            <span class="label label-primary pull-right">Doing</span>\n' +
                        '                        </a>');
                else if (arr[i] == "false") $('#list-level').append('<a href="speak.php?level=' + i + '" class="list-group-item list-group-item-action disabled">Level ' + i + '</a>');
                else
                    $('#list-level').append('<a href="speak.php?level=' + i + '" class="list-group-item list-group-item-action">\n' +
                        '                            Level ' + i + '\n' +
                        '                            <span class="label pull-right"><img src="Image/checked.png" class="img-responsive"></span>\n' +
                        '                        </a>');
            }
            if (output.type == 1) getContent1();
            else if (output.type == 2) getContent2(level);
            else if (output.type == 3) getContent3(level);
            else getContent4(level);
        }
    });
}

function getContent1() {
    $('.content').replaceWith('<div class="content">' +
        '<table><tr>' +
        '<td><img src="Image/sorry.gif" alt="">' +
        '</td>' +
        '<td><div style="font-size: larger; font-style: italic; font-weight: bold; font-family:\'Courier New\'">' +
        'Sorry!<br>Our system doesn\'t have this lesson. We will update soon. Let keep supporting us.<br>Thank you!' +
        '</div></td></tr></table></div>');
}

function getContent2(level) {
    $.ajax({
        url: "inispeak.php",
        dataType: "json",
        data: {action: "getcontenttype2", level: level},
        type: 'post',
        success: function (output) {
            var title = "Level " + level + " - " + output.TieuDe;
            $('#title').html(title);
            $('#needtolearn').replaceWith('<div id = "needtolearn">'+output.NoiDung+'</div>');
            $('#nd').text(output.Transcript);
            $('#ktra').hide();
            $('#announce').replaceWith('<div id="announce"><div class="alert alert-warning" role="alert">' +
                '<img src="Image/Warning.png" style="float: left">' +
                '<div style="font-size: larger; color: red; font-weight: bold">You just can do this exercise if you finish all of your previous levels.</div>' +
                '</div></div>');
        }
    });
}

function getContent3(level) {
    $.ajax({
        url: "inispeak.php",
        dataType: "json",
        data: {action: "getcontenttype3", level: level},
        type: 'post',
        success: function (output) {
            var title = "Level " + level + " - " + output.TieuDe;
            $('#title').html(title);
            $('#needtolearn').replaceWith('<div id = "needtolearn">'+output.NoiDung+'</div>');
            $('#nd').text(output.Transcript);
            $('#ktra').hide();
            $('#announce').replaceWith('<div id="announce" class="alert alert-success"><table width="100%"><tr>' +
                '<td rowspan="2"><img src="Image/badge" class="img-responsive"></td>' +
                '<td class="text-center" style="font-size: larger">Congrat! You have passed this level at ' + output.Time + '</td>' +
                '</tr><tr><td>' +
                '<div class="progress" style="width: 100%">\n' +
                '<div class="progress-bar progress-bar-striped active" role="progressbar"\n' +
                '  aria-valuenow="' + output.Diem + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + output.Diem + '%">\n' +
                output.Diem + '%\n' +
                '  </div></div></td></tr></table></div><button name="doagain" id="redo" class="btn" onclick="redo()">Redo</button>');
            mabai = output.MaBai;
            mylevel = level;
        }
    });
}

function getContent4(level) {
    $.ajax({
        url: "inispeak.php",
        dataType: "json",
        data: {action: "getcontenttype4", level: level},
        type: 'post',
        success: function (output) {
            var title = "Level " + level + " - " + output.TieuDe;
            $('#title').html(title);
            $('#needtolearn').replaceWith('<div id = "needtolearn">'+output.NoiDung+'</div>');
            $('#nd').text(output.Transcript);
            mabai = output.MaBai;
            mylevel = level;
        }
    });
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function redo() {
    $('#ktra').show();
    $('#announce').hide();
    $('#redo').hide();
}