var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

function initial() {
    manageData();
}

// Bắt sự kiện khi click vào nút tạo
$('#create').on('click', function() {
    // Gán các giá trị trong form tạo note vào các biến
    $MaBai = $('#MaBai').val();
    $TieuDe = $('#TieuDe').val();
    $Muc = $('#Muc').val();
    $LinkAudio = $('#LinkAudio').val();
    $Transcript = $('#Transcript').val();
    $TieuChuan = $('#TieuChuan').val();	
    $HiddenWords = $('#HiddenWords').val();

 
    // Nếu một trong các biến này rỗng
    if ($MaBai == '' || $TieuDe == '' || $Muc == '' || $LinkAudio == '' || $Transcript == '' || $TieuChuan == ''|| $HiddenWords == '')
    {
        // Hiển thị thông báo lỗi
        $('#FormCreate .alert').removeClass('hidden');
        $('#FormCreate .alert').html('Vui lòng điền đầy đủ thông tin bên trên.');
    }
    // Ngược lại
    else
    {
        // Thực thi gửi dữ liệu bằng Ajax
        $.ajax({
            url : 'api/create1.php', // Đường dẫn file nhận dữ liệu
            type : 'POST', // Phương thức gửi dữ liệu
            // Các dữ liệu
            data : {
                MaBai     : $MaBai,
                TieuDe    : $TieuDe,
                Muc       : $Muc,
                LinkAudio : $LinkAudio,
                Transcript: $Transcript,
                TieuChuan : $TieuChuan,
				HiddenWords: $HiddenWords
            // Thực thi khi gửi dữ liệu thành công
            }, success : function(data) {
                $('#FormCreate .alert').removeClass('hidden');
                $('#FormCreate .alert').html(data);
            }
        });
    }
});
// Bắt sự kiện khi click vào nút Sửa
$('#edit').on('click', function() {
    // Gán các giá trị trong form tạo note vào các biến
    $MaBai = $('#MaBai').val();
    $TieuDe = $('#TieuDe').val();
    $Muc = $('#Muc').val();
    $LinkAudio = $('#LinkAudio').val();
    $Transcript = $('#Transcript').val();
    $TieuChuan = $('#TieuChuan').val();
    $HiddenWords = $('#HiddenWords').val();
 
    // Nếu một trong các biến này rỗng
    if ($MaBai == '' || $TieuDe == '' || $Muc == '' || $LinkAudio == '' || $Transcript == '' || $TieuChuan == ''|| $HiddenWords == '')
    {
        // Hiển thị thông báo lỗi
        $('#FormEdit .alert').removeClass('hidden');
        $('#FormEdit .alert').html('Vui lòng điền đầy đủ thông tin bên trên.');
    }
    // Ngược lại
    else
    {
        // Thực thi gửi dữ liệu bằng Ajax
        $.ajax({
            url : 'api/edit1.php', // Đường dẫn file nhận dữ liệu
            type : 'POST', // Phương thức gửi dữ liệu
            // Các dữ liệu
            data : {
                 MaBai     : $MaBai,
                TieuDe    : $TieuDe,
                Muc       : $Muc,
                LinkAudio : $LinkAudio,
                Transcript: $Transcript,
                TieuChuan : $TieuChuan,
				HiddenWords: $HiddenWords
            // Thực thi khi gửi dữ liệu thành công
            }, success : function(data) {
                $('#FormEdit .alert').html(data);
            }
        });
    }
});
// Bắt sự kiện khi click vào nút Xoá
$('#delete').on('click', function() {
    $MaBai = $('#MaBai').val();
 
    // Thực thi gửi dữ liệu bằng Ajax
    $.ajax({
        url : 'api/delete1.php', // Đường dẫn file nhận dữ liệu
        type : 'POST', // Phương thức gửi dữ liệu
        // Các dữ liệu
        data : {
            MaBai : $MaBai
        // Thực thi khi gửi dữ liệu thành công
        }, success : function(data) {
            $('#FormDelete .alert').html(data);
        }
    });
});

/* manage data list */
function manageData() {
    $.ajax({
        dataType: 'json',
        url: 'api/getData1.php',
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

/* Add new Item table row */
function manageRow(data) {
    var rows = '';
    $.each(data, function (key, value) {
        rows = rows + '<tr >';
        rows = rows + '<td>' + value.MaBai + '</td>';
        rows = rows + '<td>' + value.TieuDe + '</td>';
        rows = rows + '<td>' + value.Muc + '</td>';
        rows = rows + '<td>' + value.LinkAudio + '</td>';
        rows = rows + '<td>' + value.Transcript + '</td>';
        rows = rows + '<td>' + value.TieuChuan + '</td>';
        rows = rows + '<td>' + value.HiddenWords + '</td>';
        rows = rows + '</tr>';
    });


    $("tbody").html(rows);
}


/* Get Page Data*/
function getPageData() {
    $.ajax({
        dataType: 'json',
        url: 'api/getData1.php',
        data: {page: page}
    }).done(function (data) {
        manageRow(data.data);
    });
}