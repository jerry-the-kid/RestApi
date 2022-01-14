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
            <span class="badge badge-success px-3 py-2">New</span>
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
                    <a href="#" class="btn btn-primary btn-sm link-download">Download</a>
                </li>
            </ul>
        </div>
        <div class="mt-4 col-md-4 col-lg-6 d-flex justify-content-end align-items-end">
            <button class="btn btn-success ml-2" data-toggle="modal" data-target="#startTaskModal">Start task</button>
        </div>
    </div>
</div>

<!-- Modal Start task -->
<div class="modal fade" id="startTaskModal" tabindex="-1" role="dialog" aria-labelledby="startTaskModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="startTaskModalLabel">Bắt đầu task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bắt đầu task ? Trạng thái task sẽ chuyển sang in progress.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success start_task_btn">Start task</button>
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

    const createDateFormat = function (date, options) {
        const locale = navigator.language;
        return new Intl.DateTimeFormat(
            locale,
            options
        ).format(new Date(date));
    }


    function loadProduct() {
        $.post("http://localhost/final/api/get_new_task_detail.php", {id: taskId}, function (data) {
            let task = data.data[0];
            const tieude = document.getElementById('tieude');
            tieude.innerHTML = task.TIEU_DE;
            const hoten = document.getElementById('hoten');
            hoten.innerHTML = task.HO_TEN;
            const datecreate = document.getElementById('datecreate');
            datecreate.innerHTML = createDateFormat(task.DATE_CREATE, {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            const deadline = document.getElementById('deadline');
            deadline.innerHTML = createDateFormat(task.DEADLINE, {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
            });
            const mota = document.getElementById('mota');
            mota.innerHTML = task.MO_TA;
            const supportfile = document.getElementById('supportfile');
            supportfile.innerHTML = shortcut(task.SUPPORT_FOLDER_PATH);
            $('.link-download').attr('href', `../api/download.php?file=${task.SUPPORT_FOLDER_PATH}`);
        }, "json");
    }

    function shortcut(file) {
        if (file == null) {
            return "Empty File";
        } else {
            let text = file;
            const myArray = text.split("/");
            return myArray[3];
        }
    }

    $(document).ready(function () {
        loadProduct();
        $('.start_task_btn').on('click', function (){
            $.post('../api/change_to_in_progress.php', {id : taskId}).done(function (response){
                $('#startTaskModal').modal('hide');
                window.location = `./inprogress_task.php?task=${taskId}`;
            });
        });
    });


</script>

</html>
