var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

function initial() {
    manageData();
}


/* manage data list */
function manageData() {
    $.ajax({
        dataType: 'json',
        url: 'api/getData.php',
        data: {page: page}
    }).done(function (data) {
        console.log(data)
        total_page = Math.ceil(data.total / 5);
        current_page = page;
        $('#pagination').twbsPagination({
            totalPages: total_page,
            visiblePages: current_page,
            onPageClick: function (event, pageL) {
                page = pageL;
                if (is_ajax_fire != 0) {
                    getPageData();
                }
            }
        });
        manageRow(data.data);
        is_ajax_fire = 1;
    });
}


/* Get Page Data*/
function getPageData() {
    $.ajax({
        dataType: 'json',
        url: 'api/getData.php',
        data: {page: page}
    }).done(function (data) {
        manageRow(data.data);
    });
}


/* Add new Item table row */
function manageRow(data) {
    var rows = '';
    $.each(data, function (key, value) {
        rows = rows + '<tr >';
        rows = rows + '<td>' + value.TieuDe + '</td>';
        rows = rows + '<td>' + value.Muc + '</td>';
        rows = rows + '<td>' + value.Transcript + '</td>';
        rows = rows + '<td>' + value.TieuChuan + '</td>';
        rows = rows + '<td>' + value.NoiDung + '</td>';
        rows = rows + '<td data-id="' + value.MaBai + '">';
        rows = rows + '<button class="btn btn-primary" onclick="showData(' + value.MaBai + ')"><span class="glyphicon glyphicon-pencil" title="Edit"></span></button>';
        rows = rows + ' <button class="remove-item btn btn-danger" onclick="remove(' + value.MaBai + ')"><span class="glyphicon glyphicon-trash" title="Delete"></span></button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("tbody").html(rows);
}


/* Create new Item */

$(document).ready(function () {
    $("#button").click(function () {

        var TieuDe = $("#create-item").find("input[name='TieuDe']").val();
        var Muc = $("#create-item").find("input[name='Muc']").val();
        var Transcript = $("#create-item").find("textarea[name='Transcript']").val();
        var TieuChuan = $("#create-item").find("input[name='TieuChuan']").val();
        var NoiDung = $("#create-item").find("textarea[name='NoiDung']").val();
        $.ajax({
            url: 'api/create.php',
            method: 'POST',
            data: {
                TieuDe: TieuDe,
                Muc: Muc,
                Transcript: Transcript,
                TieuChuan: TieuChuan,
                NoiDung: NoiDung
            },
            success: function (data) {
                getPageData();
                $('#TieuDe').val('');
                $('#Muc').val('');
                $('#Transcript').val('');
                $('#TieuChuan').val('');
                $('#NoiDung').val('');
                $(".modal").modal('hide');
                toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000})
            }
        });
    });
});

function showData(MaBai) {
    $('#id').val(MaBai);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: 'api/getbai1.php',
        data: {MaBai: MaBai},
        success: function (data) {
            $('#TieuDe1').val(data.TieuDe);
            $('#Muc1').val(data.Muc);
            $('#Transcript1').val(data.Transcript);
            $('#TieuChuan1').val(data.TieuChuan);
            $('#NoiDung1').val(data.NoiDung);
            $('#edit-item').modal();
        }
    });
}

/* Remove Item */
function remove(MaBai) {
    var c_obj = $(this).parents("tr");
    if (confirm("Are you sure you want to delete this row?")) {
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'api/delete.php',
            data: {MaBai: MaBai}
        }).done(function (data) {
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getPageData();
        });
    }
}

/* Updated new Item */
function change() {
    //e.preventDefault();
    var TieuDe = $("#edit-item").find("input[name='TieuDe']").val();
    var Muc = $("#edit-item").find("input[name='Muc']").val();
    var Transcript = $("#edit-item").find("textarea[name='Transcript']").val();
    var TieuChuan = $("#edit-item").find("input[name='TieuChuan']").val();
    var NoiDung = $("#edit-item").find("textarea[name='NoiDung']").val();
    var MaBai = $("#id").val();

    var data = {
        TieuDe: TieuDe,
        Muc: Muc,
        Transcript: Transcript,
        TieuChuan: TieuChuan,
        NoiDung: NoiDung,
        MaBai: MaBai
    }
    if (TieuDe != '' && Muc != '' && Transcript != '' && TieuChuan != '' && NoiDung != '') {
        console.log(data)
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: 'api/update.php',
            data: data,
            success: function (data) {

                getPageData();
                $(".modal").modal('hide');
                if (data[0] == true) {
                    toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
                }
                else {
                    toastr.success('Item Updated Fail.', 'Fail Alert', {timeOut: 5000});
                }
            }
        });
    } else {
        alert('You are missing any field.')
    }
}