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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Danh Sách Đơn Nghỉ</title>
    <link rel="stylesheet" href="../styles.css">
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
                <li class="nav-item">
                    <a class="nav-link" href="completed_task_list.php">Completed Task</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="don_nghi_list.php">Đơn nghỉ<span class="sr-only">(current)</span></a>
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
    <div class="row">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <h3 class="font-weight-bold">Danh Sách Đơn Nghỉ</h3>
        </div>
    </div>

    <div class="row">
        <div class="jumbotron jumbotron-fluid col-12 rounded" style="padding: 2rem">
            <div class="container d-flex justify-content-between">
                <p class="lead mb-0"><b>Tổng ngày nghỉ :</b> 12 ngày </p>
                <p class="lead mb-0"><b>Số ngày đã sử dụng :</b> <span id="soNgayDaDung">0</span> ngày </p>
                <p class="lead mb-0"><b>Còn lại :</b> <span id="soNgayConLai"></span> ngày </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8 mb-md-0 mb-2">
            <form class="form-group mb-0 d-flex flex-sm-row flex-column">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <button class="btn btn-success btn-add" data-toggle="modal" data-target="#createTaskModal">Tạo đơn nghỉ
            </button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Trạng thái</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01">
                    <option>All</option>
                    <option value="3">Approved</option>
                    <option value="2">Refused</option>
                    <option value="1">Waiting</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 table-responsive">
            <table class="table rounded" style="min-width: 800px;">
                <thead>
                <tr>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Trưởng phòng</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Số ngày</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tác vụ</th>
                </tr>
                </thead>
                <tbody id="table-body">
                    <!-- data goes here -->
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Create Task Modal-->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Tạo Đơn Nghỉ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createTaskForm">
                    <div class="form-group">
                        <label for="task-name" class="col-form-label">Tiêu đề</label>
                        <input name="task" type="text" class="form-control" id="task-name">
                    </div>
                    <div class="form-group">
                        <label for="createTaskNVien">Số ngày :</label>
                        <select name="nhanvien" class="form-control" id="createTaskNVien">
                            <option value="1">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">File đính kèm</span>
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
                <button type="button" class="btn btn-success btn-create-task">Tạo</button>
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

    const user_id = <?php echo $_SESSION['user_id'] ?>;
    $(document).ready(function () {
        ngayNghiDaDung();
        loadDonNghiList();
    });

    function getStatusBadge(status){
        if(status == 'waiting'){
            return "badge badge-warning p-2";
        }
        else if(status == 'refused'){
            return "badge badge-secondary p-2";
        }
        else if(status == 'approved'){
            return "badge badge-success p-2"
        }
        else return "hey something went wrong";
    }

    function dateFormat(date){
        let dateObj = new Date(date);
        let month = dateObj.getMonth() + 1;
        let day = dateObj.getDate();
        let year = dateObj.getFullYear();
        newdate = day + "/" + month + "/" + year;
        return newdate;
    }

    const loadDonNghiList = function(){
        $.get('http://localhost/final/API/get-employee-self-don-nghi.php', {id: user_id}).done(function (respone) {
            let donNghiList = respone['data'];

            $('#table-body').html('');
            donNghiList.forEach((info) => {
                let status = info.TRANG_THAI.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });

                $('#table-body').append(
                    `<tr>
                        <td>${info.TIEU_DE}</td>
                        <td>NV${info.tleadID} - ${info.tleadName}</td>
                        <td>${dateFormat(info.NGAY_LAM_DON)}</td>
                        <td>${info.SO_NGAY}</td>
                        <td><span class="${getStatusBadge(info.TRANG_THAI)}">${status}</span></td>
                        <td><a href="don_nghi.php?DN=${info.MA_NGHI}" style="text-decoration: none">Xem chi tiết</a></td>
                    </tr>`
                );
            });
        });
    }

    function soNgayConLai(soNgayDaDung){
        return (12 - soNgayDaDung >= 0) ? 12 - soNgayDaDung : 0;
    }

    const ngayNghiDaDung = function(){
        $.get('http://localhost/final/API/get-employee-used-day-off.php', {id: user_id}).done(function (respone) {
            let soNgayDaDung = respone['data'][0]['SO_NGAY'];
            let remain = soNgayConLai(soNgayDaDung);

            $("#soNgayDaDung").text(soNgayDaDung);
            $("#soNgayConLai").text(remain);

            
        });
    }

</script>
</html>
