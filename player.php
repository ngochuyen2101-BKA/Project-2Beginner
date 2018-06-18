<p class="title">Level <?php echo $level ?> - <?php echo $audioName ?></p>
<br>
<div class="player-back">
    <div id="playerCont">
        <table>
            <tr>
                <td>
                    <img src="Image/play1.png" class="img-responsive" id="playBtn" onClick="playOrPause()">
                </td>
                <td>
                    <div class="display current-time"><label id="currentTime">00:00</label></div>
                </td>
                <td><input id="trackSlider" type="range" min="0" step="1" onchange="seekTrack()"></td>
                <td>
                    <div class="display duration"><label id="duration">00:00</label></div>
                </td>
                <td>
                    <img id="volume2" src="Image/volume-up.png" onclick="showVolume()"/>
                </td>
            </tr>
        </table>
        <div class="second-part">
            <input id="volumeSlider" class="volume-slider" type="range" min="0" max="1" step="0.01"
                   onchange="adjustVolume()"/>
        </div>
    </div>
</div>
