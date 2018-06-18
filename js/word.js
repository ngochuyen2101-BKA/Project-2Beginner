function getListWords() {
    $.ajax({
        url: "iniword.php",
        dataType: "json",
        data: {action: "getlistword"},
        type: 'post',
        success: function (output) {
            for (i = 0; i < output.length; i++) {
                $('#word-list').append(addWord(output[i], i));
            }
        }
    });
}

function addWord(word, i) {
    return '<li class="list-group-item borderless" id="w'+i+'"><span class="word">' + word + '</span>' +
        '<div class="pull-right">' +
        '<a onclick="see(\'' + word + '\')"><span class="glyphicon glyphicon-eye-open"></span></a>' +
        '&emsp;<a onclick="del(\'' + word + '\', \'w'+i+'\')"><span class="glyphicon glyphicon-trash"></span></a>' +
        '</div></li>';
}

$(document).ready(function () {
    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#word-list li").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $('.nors').show();
    });
});

function see(word) {
    findWord(word);
    $('#saveWord').hide();
}

function del(word, id) {
    $.ajax({
        url: "iniword.php",
        dataType: "json",
        data: {action: "delword", word: word},
        type: 'post',
        success: function (output) {
            if (output == "success") {
                alert("Delete successfully!");
                $('#'+id).remove();
            }
            else {
                alert("Can not delete this word!");
            }
        }
    });
}

function yesclick() {
    var word = $('#myInput').val();
    findWord(word);
}

function noclick() {
    location.reload();
}

function saveWord1(word) {
    $.ajax({
        url: 'saveword.php',
        dataType: "json",
        data: {"word": word},
        type: 'post',
        success: function (output) {
            alert(output);
            getListWords();
            $('.nors').hide();
            $('#myInput').val('')
        }
    });
}

function closeclick() {
    location.reload();
}