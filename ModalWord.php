<div class="modal fade" id="ModalWord" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span class="modal-title" id="word"></span>
                <img src="Image/audio1.png" alt="" onclick="start_listen($('#word').text())" id="listenword">
            </div>
            <div class="modal-body">
                <p id="meaning"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveWord" onclick="saveWord($('#word').text())">Save as my words</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>