<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Danh Sách Nhân Viên</title>
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
                    <a class="nav-link" href="task_list.html">Task<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cancel_task_list.html">Canceled Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="completed_task_list.html">Completed Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Đơn nghỉ</a>
                </li>
            </ul>
            <div class="dropdown show ml-auto ">
                <a class="btn text-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Giám đốc
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Thông tin</a>
                    <a class="dropdown-item text-danger" href="#">Đăng xuất</a>
                </div>
            </div>

        </div>
    </div>
</nav>

<!--Container-->
<div class="container">
    <div class="row mb-2 flex-column-reverse flex-md-row">
        <div class="col-md-6 col-12 mb-4 align-items-center justify-content-end pr-3">
            <h2 class="font-weight-bold text-left" id="tieu-de">Testing sản phẩm</h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end align-items-center">
            <button class="btn btn-light">Trở về danh sách</button>
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
                <li class="list-group-item text-center">
                    <a href="">Download All <i class="ml-2 fas fa-download"></i></a>
                </li>
            </ul>
        </div>
        <div class="mt-4 col-md-4 col-lg-6 d-flex justify-content-end align-items-end">
            <button class="btn btn-secondary">Hủy task</button>
            <button class="btn btn-success ml-2">Cập nhật</button>
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

    $(document).ready(function () {
        const renderData = function (data) {
            const fileHtmlMarkup = `<li class="list-group-item d-flex justify-content-between align-items-center">${data.SUPPORT_FOLDER_PATH.split('/').slice(-1)}
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
            $('#download-container').prepend(fileHtmlMarkup);
        }

        $.get('../api/get-task.php', {id: taskId}).done(function (response) {
            const data = response.data[0];
            console.log(data);
            renderData(data);
        });
    });
</script>

</html>
