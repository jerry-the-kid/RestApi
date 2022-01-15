<?php
require_once('tlead_validate.php');
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>New Task</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Task<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cancel_task_list.php">Canceled Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="completed_task_list.php">Completed Task</a>
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
<div class="container" id="alert-container">

</div>
<div class="container">
    <div class="row mb-2 flex-column-reverse flex-md-row">
        <div class="col-md-6 col-12 mb-4 align-items-center justify-content-end pr-3">
            <h2 class="font-weight-bold text-left" id="tieu-de">Testing sản phẩm</h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end align-items-center">
            <a class="btn btn-light" href="index.php">Trở về danh sách</a>
        </div>
    </div>
    <div class="row p-4 bg-light rounded">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <p class="mb-0"><span id="name">Nguyễn Thái Duy</span> • <span id="date-created">18/12</span></p>
            <span class="badge badge-success px-3 py-2">New</span>
        </div>
        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
            <p class="mb-0">Đánh giá ___</p>
            <p class="mb-0">Hạn nộp : <span id="deadline">25/12</span></p>
        </div>
        <div style="margin : 30px 16px; border-bottom: 1px solid black; width: 100%"></div>
        <div class="col-12">
            Mô tả : <span id="describe"></span>
        </div>
        <div class="mt-4 col-md-8 col-lg-6">
            <ul class="list-group list-group-flush" id="download-container">
                
            </ul>
        </div>
        <div class="mt-4 col-md-4 col-lg-6 d-flex justify-content-end align-items-end">
            <button class="btn btn-secondary" data-toggle="modal" data-target="#cancelModal">Hủy task</button>
            <button class="btn btn-success ml-2 btn_update" data-toggle="modal" data-target="#updateTaskModal">Cập
                nhật
            </button>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Hủy task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn chắc sẽ muốn hủy task này chứ ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger cancel_btn">Cancel task</button>
            </div>
        </div>
    </div>
</div>

<!--Update Modal-->
<div class="modal fade" id="updateTaskModal" tabindex="-1" role="dialog" aria-labelledby="updateTaskModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTaskModalLabel">Cập nhật task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateTaskForm">
                    <div class="form-group">
                        <label for="task-name" class="col-form-label">Tiêu đề</label>
                        <input name="task" type="text" class="form-control" id="task-name">
                    </div>
                    <div class="form-group">
                        <label for="deadline" class="col-form-label">Deadline:</label>
                        <input name="deadline" type="datetime-local" id="deadline_form" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="createTaskNVien">Nhân viên nhận :</label>
                        <select name="nhanvien" class="form-control" id="createTaskNVien">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="describe-text" class="col-form-label">Mô tả</label>
                        <textarea name="describe" class="form-control" id="describe-text"></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">File thay đổi</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="alert-modal-container">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-update-task">Cập nhật</button>
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

<script>
    const taskId = <?php echo $_GET['task']?>;
    const user_id = <?php echo $_SESSION['user_id'] ?>;
    let dataStored;

    const alertSuccess = function (message) {
        const alert = `<div class="alert alert-success" role="alert">
         ${message}
         </div>`;
        $('#alert-container').append(alert);
        $('.alert-success').fadeOut(3500);
    }

    const createDateFormat = function (date, options) {
        const locale = navigator.language;
        return new Intl.DateTimeFormat(
            locale,
            options
        ).format(new Date(date));
    }

    const alertFormDanger = function (container, message) {
        $(container).html('');
        $(container).append(`<div class="alert alert-danger alert-dismissible fade show" role="alert" id="modal-alert">
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`);
    }

    const renderModalInput = function (data) {
        $('#task-name').val(data.TIEU_DE);
        const dateControl = document.querySelector('#deadline_form');
        dateControl.value = data.DEADLINE;

        $('#describe-text').val(data.MO_TA);

    }

    const renderData = function (data) {
        const fileHtmlMarkup = `<li class="list-group-item d-flex justify-content-between align-items-center">${data.SUPPORT_FOLDER_PATH?.split('/').slice(-1)}
                    <a href= "../api/download.php?file=${data.SUPPORT_FOLDER_PATH}" class="btn btn-primary btn-sm">Download</a>
                </li>`;
        $('#tieu-de').text(`${data.TIEU_DE}`);
        $('#name').html(data.HO_TEN);
        $('#date-created').html(createDateFormat(data.DATE_CREATE, {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        }));
        $('#deadline').html(createDateFormat(data.DEADLINE, {
            day: 'numeric',
            month: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
        }));
        $('#describe').html(data.MO_TA);
        $('#download-container').html('');
        if (data.SUPPORT_FOLDER_PATH) {
            $('#download-container').prepend(fileHtmlMarkup);
        }

    }
    const loadData = function () {
        $.get('../api/get-task.php', {id: taskId}).done(function (response) {
            const data = response.data[0];
            dataStored = data;
            renderData(data);
        });
    }

    $(document).ready(function () {
        loadData();
        const taskName = $('#task-name');
        const deadLine = $('#deadline_form');
        const nhanVien = $('#createTaskNVien');
        const describeText = $('#describe-text');
        const file = $('#inputGroupFile01');

        $('.cancel_btn').on('click', function (e) {
            $.post('../api/cancel_task.php', {id: taskId}).done(function (response) {
                console.log(response);
                $('#cancelModal').modal('hide');
                document.location.href = 'index.php';
            });
        });

        $('.btn_update').on('click', function (e) {
            renderModalInput(dataStored);
            const selector = $('#createTaskNVien');
            $.post('../API/get_employee_by_Tlead.php', {id: user_id}).done(function (data) {
                const nhanVien = data.data;
                if (!nhanVien) {
                    selector.append('')
                    selector.attr('disabled', true);
                    return;
                }
                selector.attr('disabled', false);
                selector.html('');
                nhanVien.forEach(function (el) {
                    $('#createTaskNVien').append(`<option value="${el.MA_NV}">${el.HO_TEN} - ${el.MA_NV}</option>`);
                });
            });
        })

        $('.btn-update-task').on('click', function (e) {
            if (!taskName.val()) {
                alertFormDanger('.alert-modal-container', 'Tiêu đề còn thiếu. Vui lòng nhập');
                taskName.focus();
            } else if (!deadLine.val()) {
                alertFormDanger('.alert-modal-container', 'Hạn nộp còn thiếu. Vui lòng nhập');
                deadLine.focus();
            } else if (!nhanVien.val()) {
                alertFormDanger('.alert-modal-container', 'Phòng ban không có nhân viên. Vui lòng thêm');
            } else if (!describeText.val()) {
                alertFormDanger('.alert-modal-container', 'Vui lòng nhập mô tả task.');
                describeText.focus();
            } else {
                const form = $('#updateTaskForm')[0];
                const formData = new FormData(form);
                formData.append("task_id", taskId);
                formData.append('old_file_path', dataStored.SUPPORT_FOLDER_PATH);
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "../api/update_new_task.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                        console.log("SUCCESS : ", data);
                        $('#updateTaskModal').modal('hide');
                        alertSuccess(data.message);
                        loadData();
                    },
                    error: function (e) {
                        console.log("ERROR : ", e);
                        $('#updateTaskModal').modal('hide');
                        alertDanger(e);
                    }
                });

            }
        });

        [taskName, deadLine, nhanVien, describeText].forEach(el => {
            el.on('input', function () {
                $('.alert-modal-container').html('');
            });
        });

    });

    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>

</html>
