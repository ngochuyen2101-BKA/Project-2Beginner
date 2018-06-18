<?php
session_start();
if (!isset($_SESSION["Admin"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>2Beginner</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/twbsPagination.min.js"></script>
    <script src="js/validator.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <link href="css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/crud.js"></script>
    <style>
        table {
            background-color: rgba(227, 227, 227, 0.5);
            border-collapse: collapse;
        }

        table.table-bordered{
            border:1px solid black;
        }
        table.table-bordered > thead > tr > th{
            border:1px solid black;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid black;
        }

        #pagination {
            margin: 0 auto;
        }

        .title {
            text-align: center;
        }
    </style>
</head>
<body>
<?php include "head.php" ?>
<div class="container-fluid main-container">
    <div class="row">
        <br>
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
                    Add new level
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit-item">
                    Edit level
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#delete-item">
                    Delete level
                </button>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="title">ID</th>
                    <th class="title">Title</th>
                    <th class="title">Level</th>
                    <th class="title">Link Audio</th>
                    <th class="title">Transcript</th>
                    <th class="title">Standard score</th>
                    <th class="title">Hidden Words</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="text-center">
                <ul id="pagination" class="pagination-md"></ul>
            </div>
            <br>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php"; ?>
    </div>
</div>

<!-- Create Item Modal -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="addItem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addItem">Create Level</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" action="api/create1.php" method="POST" id="FormCreate"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label" for="TieuDe">ID:</label>
                        <input type="text" id="MaBai" name="MaBai" class="form-control"
                               data-error="Nhập mã bài." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Muc">Title:</label>
                        <input type="text" id="TieuDe" name="TieuDe" class="form-control"
                               data-error="Nhập tiêu đề." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Transcript">Level:</label>
                        <input type="text" id="Muc" name="Muc" class="form-control" data-error="Nhập mức."
                               required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="TieuChuan">Link audio:</label>
                        <input type="file" id="LinkAudio" name="LinkAudio" class="form-control"
                               data-error="Nhập Link Audio." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Transcript">Transcript:</label>
                        <textarea name="Transcript" id="Transcript" class="form-control"
                                  data-error="Nhập transcript." required></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="TieuChuan">Standard score:</label>
                        <input type="text" id="TieuChuan" name="TieuChuan" class="form-control"
                               data-error="Nhập tiêu chuẩn." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="HiddenWords">Hidden words:</label>
                        <input type="text" id="HiddenWords" name="HiddenWords" class="form-control"
                               data-error="Nhập từ ẩn." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn crud-submit btn-success" id="create">Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Level</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" action="api/edit1.php" method="post" id="FormEdit">
                    <input type="hidden" name="id" class="edit-id">
                    <div class="form-group">
                        <label class="control-label" for="TieuDe">ID:</label>
                        <input type="text" id="MaBai" name="MaBai" class="form-control"
                               data-error="Nhập mã bài." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Muc">Title:</label>
                        <input type="text" id="TieuDe" name="TieuDe" class="form-control"
                               data-error="Nhập tiêu đề." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Transcript">Level:</label>
                        <input type="text" id="Muc" name="Muc" class="form-control" data-error="Nhập mức."
                               required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="TieuChuan">Link audio:</label>
                        <input type="file" id="LinkAudio" name="LinkAudio" class="form-control"
                               data-error="Nhập Link Audio." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Transcript">Transcript:</label>
                        <textarea name="Transcript" id="Transcript" class="form-control"
                                  data-error="Nhập transcript." required></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="TieuChuan">Standard score:</label>
                        <input type="text" id="TieuChuan" name="TieuChuan" class="form-control"
                               data-error="Nhập tiêu chuẩn." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="HiddenWords">Hidden words:</label>
                        <input type="text" id="HiddenWords" name="HiddenWords" class="form-control"
                               data-error="Nhập từ ẩn." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success crud-submit-edit" id="edit">Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!--Delete Item Modal -->
<div class="modal fade" id="delete-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Level</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" action="api/delete1.php" method="post" id="FormDelete">
                    <input type="hidden" name="id" class="delete-id">
                    <div class="form-group">
                        <label class="control-label" for="TieuDe">ID:</label>
                        <input type="text" id="MaBai" name="MaBai" class="form-control"
                               data-error="Nhập mã bài." required/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success crud-submit-edit" id="delete">Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    window.onload = function () {
        initial();
    }
</script>

