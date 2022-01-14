<?php
require_once('employee_validate.php');
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Complete Task</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<!--Nav bar-->


<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <button class="ml-auto navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Task</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="completed_task_list.php">Completed Task<span
                                class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="don_nghi_list.php">Đơn nghỉ</a>
                </li>
            </ul>
            <div class="dropdown show ml-auto">
                <a class="btn text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['ho_ten'] ?>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="user_info.php">Thông tin</a>
                    <a class="dropdown-item" href="change_pwd.php">Đổi mật khẩu</a>
                    <a class="dropdown-item text-danger" href="../logout.php">Đăng xuất</a>
                </div>
            </div>

        </div>
    </div>
</nav>

<!--Container-->
<div class="container">
    <div class="row mb-2 flex-column-reverse flex-md-row">
        <div class="col-md-6 col-12 mb-4 align-items-center justify-content-end">
            <h2 class="font-weight-bold text-left" id="tieu_de"></h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end align-items-center">
            <a class="btn btn-light" href="completed_task_list.php">Trở về danh sách</a>
        </div>
    </div>
    <div class="row p-4 bg-light rounded">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <p class="mb-0"><span id="ho_ten"></span> • <span id="datecreate"></p>
            <span class="badge badge-primary px-3 py-2">Completed</span>
        </div>
        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
            <p class="mb-0">Đánh giá : <span id="danh_gia"></span></p>
            <p class="mb-0">Hạn nộp : <span id="deadline"></span></p>
        </div>
        <div style="margin : 30px 16px; border-bottom: 1px solid black; width: 100%"></div>
        <div class="col-12">
            Mô tả : <span id="mota"></span>
        </div>
        <div class="col-12  mt-2" id="reject_message">
        </div>
        <div class="mt-4 col-md-8 col-lg-6">
            <ul class="list-group list-group-flush" id="support_file">
            </ul>
        </div>
        <div class="mt-4 col-md-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Phần nộp công việc</h5>

                    <div class="work-container mb-4">
                        <p class="card-text"><span id="message_employee"></span></p>
                        <div class="d-flex justify-content-between align-items-center" id="submited-file">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Thêm file-->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">Thêm file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Nội dung:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

<script type="application/javascript">
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>

<script>
    const idTask = <?php echo $_GET['task'] ?>;

    const createDateFormat = function (date, options) {
        const locale = navigator.language;
        return new Intl.DateTimeFormat(
            locale,
            options
        ).format(new Date(date));
    }

    const renderSupportFiles = function (suportFolderArray) {
        $('#support_file').html('');
        if (suportFolderArray[0] === '' || !suportFolderArray) return;
        suportFolderArray.forEach(el => {
            $('#support_file').append(`<li class="list-group-item d-flex justify-content-between align-items-center">
                     ${el.split('/').slice(-1)}
                    <a href= "../api/download.php?file=${el}" class="btn btn-primary btn-sm">Download</a>
                </li>`);
        });
    }

    const renderStatus = function (status) {
        if (status === 'Bad') return "<span class = 'badge badge-danger p-2'>Bad</span>";
        if (status === 'Ok') return "<span class = 'badge badge-warning p-2'>Ok</span>";
        if (status === 'Good') return "<span class = 'badge badge-success p-2'>Good</span>";
    }


    $(document).ready(function () {
        $.get('../api/get-task.php', {id: idTask}).done(function (response) {
            console.log(response);
            const task = response.data[0];
            $('#tieu_de').text(task.TIEU_DE);
            $('#ho_ten').text(task.HO_TEN);
            $('#datecreate').text(createDateFormat(task.DATE_CREATE, {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }));
            $('#danh_gia').append(renderStatus(task.COMPLETE_STATUS));
            $('#deadline').text(createDateFormat(task.DATE_CREATE, {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
            }));
            $('#mota').text(task.MO_TA);
            if (task.message_tlead) {
                $('#reject_message').append(`Message sau khi nộp : <span >${task.message_tlead}</span>`);
            }
            $('#message_employee').text(task.message_employee);
            renderSupportFiles(task.SUPPORT_FOLDER_PATH.split('+'));
            $('#submited-file').append(`<p class="p-2 badge badge-secondary card-text mb-0">${task.SUBMIT_FOLDER_PATH?.split('/').slice(-1)}</p>
            <a href="../api/download.php?file=${task.SUBMIT_FOLDER_PATH}" class="btn btn-primary btn-sm">Download</a>`);
        });
    });
</script>

</html>
