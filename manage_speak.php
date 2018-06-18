<?php
session_start();
if (!isset($_SESSION["Admin"])) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/twbsPagination.min.js"></script>
    <script src="js/validator.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <link href="css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/item-ajax.js"></script>
    <style>
        .modal {
            margin-top: 50px;
        }
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
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="10%" class="title">Title</th>
                    <th width="2%" class="title">Level</th>
                    <th width="30%" class="title">Transcript</th>
                    <th width="2%" class="title">Standard score</th>
                    <th width="41%" class="title">Content</th>
                    <th class="title">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
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

<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="addItem">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addItem">Add new level</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label" for="TieuDe">Title:</label>
                    <input type="text" name="TieuDe" id="TieuDe" class="form-control" data-error="Nhập tiêu đề."
                           required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="Transcript">Transcript:</label>
                    <textarea name="Transcript" id="Transcript" class="form-control" data-error="Nhập transcript."
                              required></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="TieuChuan">Standard score:</label>
                    <input type="text" name="TieuChuan" id="TieuChuan" class="form-control"
                           data-error="Nhập tiêu chuẩn."
                           required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="NoiDung">Content:</label>
                    <textarea name="NoiDung" id="NoiDung" class="form-control" data-error="Nhập nội dung."
                              required></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group text-center">
                    <input type="button" id="button" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Level</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" class="edit-id">
                <div class="form-group">
                    <label class="control-label" for="TieuDe">Title:</label>
                    <input type="text" id="TieuDe1" name="TieuDe" class="form-control" data-error="Nhập tiêu đề."
                           required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="Muc">Level:</label>
                    <input type="text" id="Muc1" name="Muc" class="form-control" data-error="Nhập mức." readonly/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="Transcript">Transcript:</label>
                    <textarea id="Transcript1" name="Transcript" class="form-control" data-error="Nhập transcript."
                              required></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="TieuChuan">Standard score:</label>
                    <input type="text" id="TieuChuan1" name="TieuChuan" class="form-control"
                           data-error="Nhập tiêu chuẩn."
                           required/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="NoiDung">Content:</label>
                    <textarea id="NoiDung1" name="NoiDung" class="form-control" data-error="Nhập nội dung."
                              required></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" onclick="change()">Submit
                    </button>
                </div>
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
