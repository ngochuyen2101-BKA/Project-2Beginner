$(document).ready(function () {
    $.ajax({
        url: "./chart.php",
        type: "GET",
        success: function (data) {
            console.log(data);
            $('#speaklevel').html(data.learner.levelspeak);
            $('#listenlevel').html(data.learner.levellisten);
            $('#learner').html(data.learner.HoTen);
            var score1 = {
                Speak: []
            };
            var score2 = {
                Listen: []
            };
            var len1 = data.speak.length;
            var len2 = data.listen.length;
            var titles = [];
            for (var i = 0; i < len1; i++) {
                titles[i] = "Level "+ data.speak[i].Muc + " : " + data.speak[i].ThoiGian;
                score1.Speak.push(data.speak[i].Diem);
            }
            for (var i = 0; i < len2; i++) {
                score2.Listen.push(data.listen[i].Diem);
            }

            //get canvas
            var ctx1 = $("#line-chartcanvas1");
            var ctx2 = $("#line-chartcanvas2");

            var data1 = {
                labels: titles,
                datasets: [
                    {
                        label: "Speaking score",
                        data: score1.Speak,
                        backgroundColor: "blue",
                        borderColor: "lightblue",
                        fill: false,
                        lineTension: 0,
                        pointRadius: 7
                    }
                ]
            };

            var data2 = {
                labels: titles,
                datasets: [
                    {
                        label: "Listening score",
                        data: score2.Listen,
                        backgroundColor: "green",
                        borderColor: "lightgreen",
                        fill: false,
                        lineTension: 0,
                        pointRadius: 5
                    }
                ]
            };

            var options1 = {
                title: {
                    display: true,
                    position: "top",
                    text: "Speaking Result",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom"
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            display: false
                        }
                    }]
                }
            };

            var options2 = {
                title: {
                    display: true,
                    position: "top",
                    text: "Listening Result",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom"
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            display: false
                        }
                    }]
                }
            };

            var chart1 = new Chart(ctx1, {
                type: "line",
                data: data1,
                options: options1
            })
            var chart2 = new Chart(ctx2, {
                type: "line",
                data: data2,
                options: options2
            })
        },
        error: function (data) {
            console.log(data);
        }
    });
});

function savechange(newpass, oldpass) {
    $.ajax({
        url: 'changepwd.php',
        dataType: "json",
        data: {"old": CryptoJS.MD5(oldpass).toString(), "new": CryptoJS.MD5(newpass).toString()},
        type: 'post',
        success: function (output) {
            if (output == "success") {
                alert("Successfully!\nYou changed your password!");
                $('#password_modal').modal('hide');
            }
            else {
                alert(output);
            }
        }
    });
}