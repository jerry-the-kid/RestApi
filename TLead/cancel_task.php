<?php
require_once ('tlead_validate.php');
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

    <title>Cancel Task</title>
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
                    <a class="nav-link" href="cancel_task_list.php">Canceled Task<span class="sr-only">(current)</span></a>
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
                    <a class="dropdown-item" href="#">Thông tin</a>
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
            <h2 class="font-weight-bold text-left" id="title">Title</h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end align-items-center">
            <a class="btn btn-light" href="cancel_task_list.php">Trở về danh sách</a>
        </div>
    </div>
    <div class="row p-4 bg-light rounded">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <p class="mb-0" id="tleadName">Nguyễn Thái Duy</p>
            <span class="badge badge-secondary px-3 py-2">Cancel</span>
        </div>
        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
            <p class="mb-0" id="dateCreate">Ngày tạo</p>
            <p class="mb-0" id="deadline">Deadline</p>
        </div>
        <div style="margin : 30px 16px; border-bottom: 1px solid black; width: 100%"></div>
        <div class="col-12" id="description">
            Mô tả : 
        </div>
        <div class="mt-4 col-md-8 col-lg-6">
            <ul class="list-group list-group-flush" id="supportFolderList">
                <!-- <li class="list-group-item d-flex justify-content-between align-items-center">File 1
                    <button class="btn btn-primary btn-sm">Download</button>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">File 2
                    <button class="btn btn-primary btn-sm">Download</button>
                </li> -->
            </ul>
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
    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    }

    function dateFormatForDeadLine(date){
        let dateObj = new Date(date);
        let month = dateObj.getMonth() + 1;
        let day = dateObj.getDate();
        let hours = dateObj.getHours();
        let minute = dateObj.getMinutes();

        newdate = day + "/" + month + " - " + hours + ":" + minute;
        return newdate;
    }

    function dateFormatForCreate(date){
        let dateObj = new Date(date);
        let month = dateObj.getMonth() + 1;
        let day = dateObj.getDate();

        newdate = day + "/" + month;
        return newdate;
    }

    function addDotToPathIfNeeded(path){
        if(path.substring(0, 3) != '../'){
            return "../" + path;
        }
        else return path;
    }

    const fillData = function(){
        let taskId = getUrlParameter('task');

        $.get('http://localhost/final/API/get-task.php', {id: taskId}).done(function (respone) {
            let taskInfo = respone.data[0];

            $("#title").text(taskInfo.TIEU_DE);
            $("#tleadName").text(taskInfo.HO_TEN);
            $("#dateCreate").text("Ngày tạo: " + dateFormatForCreate(taskInfo.DATE_CREATE));
            $("#deadline").text("Hạn nộp: " + dateFormatForDeadLine(taskInfo.DEADLINE));
            $("#description").append(taskInfo.MO_TA);

            $('#supportFolderList').html('');

            let supportFileList = taskInfo.SUPPORT_FOLDER_PATH.split("+");

            console.log(supportFileList);

            $.each(supportFileList, function( index, value ) {
                let fileNameIndex = value.lastIndexOf("/") + 1;
                let filename = value.substr(fileNameIndex);

                $('#supportFolderList').append(
                    `<li class="list-group-item d-flex justify-content-between align-items-center">${filename}
                        <a href="${addDotToPathIfNeeded(value)}" class="text-light btn btn-primary btn-sm" download>Download</a>
                    </li>`);
            });
        });
    }

    $(document).ready(function () {
        fillData();
    });
</script>

</html>
