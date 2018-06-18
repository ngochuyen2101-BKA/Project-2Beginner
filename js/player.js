//su dung cac bien lay tu ben ngoai: audioPath - duong dan den audio

var trackTitle = document.getElementById('trackTitle');
var trackSlider = document.getElementById('trackSlider');
var currentTime = document.getElementById('currentTime');
var duration = document.getElementById('duration');
var volumeSlider = document.getElementById('volumeSlider');
var nextTrackTitle = document.getElementById('nextTrackTitle');
var playBtn = document.getElementById('playBtn');

var track = new Audio();
loadTrack();
setInterval(updateTrackSlider, 1000);

function loadTrack(){
	track.src = audioLink;
	track.addEventListener('loadedmetadata', showDuration);											//su dung event loadedmetadata de su dung duoc audio.duration

	//nextTrackTitle.innerHTML = "<b>Next Track: </b>" + tracks[currentTrack + 1 % tracks.length];	//lay ten cua track tiep theo cho nextTrackTitle
	track.volume = volumeSlider.value;																//gia tri cua volume lay tu 0.0 (silent) den 1.0 (max)
	track.playbackRate = 1;																			//thiet lap toc do chay cua audio - 1.0 la toc do binh thuong
	
}

function updateTrackSlider(){
	var time = Math.round(track.currentTime);
	trackSlider.value = time;
	currentTime.textContent = convertTime(time);
	//if (track.ended)
	//	next();
}

/*
function next() {
	currentTrack ++;
	loadTrack();
} */

//thiet lap gia tri max cho trackSlider va thay doi noi dung cua duration
function showDuration() {
	//lam tron do dai cua audio den giay
	//roi set lai gia tri max cua trackSlider va thay doi nhan
	
	var length = Math.floor(track.duration);
	trackSlider.setAttribute("max", length.toString());
	duration.textContent = convertTime(length);
}

function convertTime (seconds) {
	var minute = Math.floor(seconds/60);
	var second = seconds % 60;
	minute = (minute < 10) ? "0" + minute : minute;
	second = (second < 10) ? "0" + second : second;
	return (minute + ":" + second);
}

function playOrPause() {

	if(track.paused){
		track.play();
        $('#playBtn').attr('src','Image/pause1.png');
	}
	else
	{
		track.pause();
        $('#playBtn').attr('src','Image/play1.png');
	}
}

function seekTrack () {
	track.currentTime = trackSlider.value;
	currentTime.textContent = convertTime(track.currentTime);
}

function adjustVolume () {
	track.volume = volumeSlider.value;
}

function showVolume() {
	if ($('#volumeSlider').is(":visible")) $('#volumeSlider').hide();
	else $('#volumeSlider').show();
}