<?php
require_once ('employee_validate.php');
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

    <title>Inprogress Task</title>
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
            <h2 class="font-weight-bold text-left"><span id="tieude"></span></h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end align-items-center">
            <a class="btn btn-light" href="index.php">Trở về danh sách</a>
        </div>
    </div>
    <div class="row p-4 bg-light rounded">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <p class="mb-0"><span id="hoten"></span> • <span id="datecreate"></p>
            <span class="badge badge-primary px-3 py-2">In progress</span>
        </div>
        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
            <p class="mb-0">Đánh giá ___</p>
            <p class="mb-0">Hạn nộp <span id="deadline"></span></p>
        </div>
        <div style="margin : 30px 16px; border-bottom: 1px solid black; width: 100%"></div>
        <div class="col-12">
            Mô tả : <span id="mota"></span>
        </div>
        <div class="mt-4 col-md-8 col-lg-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center"><span
                            id="supportfile"></span>
                    <a id="link-download" href="#" class="btn btn-primary btn-sm">Download</a>
                </li>
            </ul>
        </div>
        <div class="mt-4 col-md-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Phần nộp công việc</h5>

                    <div class="work-container mb-4">
                        <!--                        <p class="card-text">Mô tả Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam-->
                        <!--                            assumenda at aut consectetur culpa cupiditate debitis-->
                        <!--                            vero voluptatem.</p>-->
                        <!--                        <div class="d-flex justify-content-between">-->
                        <!--                            <p class="card-text mb-0">Note.pdf</p>-->
                        <!--                            <button class="btn btn-primary btn-sm">Download</button>-->
                        <!--                        </div>-->
                    </div>
                    <div class="btn-container d-flex justify-content-end align-items-end">
                        <button class="btn btn-primary mr-2 btn_file" data-toggle="modal" data-target="#fileModal">Thêm file
                        </button>
                        <button class="btn btn-success btn_submit" disabled>Nộp</button>
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
                <form id="form_submit">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Nội dung:</label>
                        <textarea name="message" class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="file_input">
                            <label class="custom-file-label" for="file_input">Choose file</label>
                        </div>
                    </div>
                    <div class="alert-modal-container">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-file-btn">Thêm file</button>
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
    const task_id = <?php echo $_GET['task']?>;
    const alertFormDanger = function (container, message) {
        $(container).html('');
        $(container).append(`<div class="alert alert-danger alert-dismissible fade show" role="alert" id="modal-alert">
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`);
    }


    $(document).ready(function () {
        const content = {
            fileName: '',
            message: '',
        };
        const message = $('#message-text');
        const file = $('#file_input');
        message.val('');
        file.val('');
        loadProduct();

        $('.add-file-btn').on('click', function () {
            if (!message.val()) {
                alertFormDanger('.alert-modal-container', 'Lời nhắn còn thiếu vui lòng nhập.');
                message.focus;
            } else if (file.get(0).files.length === 0) {
                alertFormDanger('.alert-modal-container', 'File nộp còn thiếu vui lòng thêm file.');
            } else {
                content.fileName = file.val().replace(/C:\\fakepath\\/i, '');
                content.message = message.val();
                $('.work-container').html('');
                $('.work-container').append(`<p class="card-text">Lời nhắn : ${content.message}</p>
                        <div class="d-flex justify-content-between">
                        <p class="badge badge-secondary card-text mb-0">${content.fileName}</p>
                </div>`);
                $('#fileModal').modal('hide');
                $('.btn_file').text('Cập nhật file nộp');
                $('.btn_submit').attr('disabled', false);

            }
        });

        $('.btn_submit').on('click', function (){
            $('.btn_submit').attr('disabled', true);
            const form =  $('#form_submit')[0];
            const data = new FormData(form);
            data.append('id_task', task_id);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "../api/submit_file.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    window.location = `http://localhost/final/Employee/waiting_task.php?task=${task_id}`;
                },
            });

        });

        [message, file].forEach(el => {
            el.on('input', function () {
                $('.alert-modal-container').html('');
            });
        });
    });

    function loadProduct() {
        $.post("http://localhost/final/api/get_inprogress_task_detail.php", {id: task_id}, function (data, status) {
            data.data.forEach((task) => {
                const tieude = document.getElementById('tieude');
                tieude.innerHTML = task.TIEU_DE;
                const hoten = document.getElementById('hoten');
                hoten.innerHTML = task.HO_TEN;
                const datecreate = document.getElementById('datecreate');
                datecreate.innerHTML = task.DATE_CREATE;
                const deadline = document.getElementById('deadline');
                deadline.innerHTML = task.DEADLINE;
                const mota = document.getElementById('mota');
                mota.innerHTML = task.MO_TA;
                const supportfile = document.getElementById('supportfile');
                supportfile.innerHTML = shortcut(task.SUPPORT_FOLDER_PATH);
                $('#link-download').attr('href', `../api/download.php?file=${task.SUPPORT_FOLDER_PATH}`);
            })
        }, "json");
    }

    function convert(time) {
        if (time == null) {
            return null;
        } else {
            const date = time;
            const readable_date = new Date(date).toLocaleDateString();
            return readable_date;
        }
    }

    function shortcut(file) {
        if (file == null) {
            return "";
        } else {
            let text = file;
            const myArray = text.split("/");
            return myArray[3];
        }
    }
</script>

</html>
