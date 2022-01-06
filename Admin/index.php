<?php
require_once ('admin_validate.php');
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

    <title>Danh Sách Nhân Viên</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Nhân viên<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="phong_ban_list.php">Phòng ban</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="truong_phong.php">Trưởng phòng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="taikhoan.php">Tài khoản</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Đơn nghỉ</a>
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
    <div class="container col-12" id="alert-container"></div>

    <div class="row">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <h3 class="font-weight-bold">Danh Sách Nhân Viên</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 mb-md-0 mb-2">
            <form onsubmit="return false" class="form-group mb-0 d-flex flex-sm-row flex-column">
                <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm theo tên nhân viên" aria-label="Search" id="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <a class="btn btn-success" href="them_nhanvien.php"> Thêm nhân viên</a>
        </div>
    </div>
    <div class="row mt-5">

        <div class="col-12 table-responsive">
            <table class="table rounded" style="min-width: 700px;">
                <thead>
                <tr>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Chức vụ</th>
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


<!-- Delete Modal-->
<div class="modal fade px-0" id="deletedModal" tabindex="-1" role="dialog" aria-labelledby="deletedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletedModalLabel">Xóa nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <p>Bạn có chắc muốn xóa nhân viên tên <span class="font-weight-bold" id="employeeName">Văn A</span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-danger" id="deleteConfirm">Xóa</button>
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
    let employeeList = [];

    function removeVietnameseTones(str) {
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
        str = str.replace(/đ/g,"d");
        str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
        str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
        str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
        str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
        str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
        str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
        str = str.replace(/Đ/g, "D");
        // Some system encode vietnamese combining accent as individual utf-8 characters
        // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
        str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
        str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
        // Remove extra spaces
        // Bỏ các khoảng trắng liền nhau
        str = str.replace(/ + /g," ");
        str = str.trim();
        // Remove punctuations
        // Bỏ dấu câu, kí tự đặc biệt
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
        return str;
    }

    const alertSuccess = function (message) {
        const alert = `<div class="alert alert-success" role="alert">
         ${message}
         </div>`;
        $('#alert-container').append(alert);
        $('.alert-success').fadeOut(3500);
    }

    const alertDanger = function (message) {
        const alert = `<div class="alert alert-danger" role="alert">
         ${message}
         </div>`;
        $('#alert-container').append(alert);
        $('.alert-danger').fadeOut(3500);
    }

    const loadData = function () {
        $.get('http://localhost/final/API/get-all-employees.php').done(function (respone) {
            const {data} = respone;
            employeeList = data;
            $('#table-body').html('');
            data.forEach((info) => {
                $('#table-body').append(
                    `<tr>
                        <td>NV${info.MA_NV}</td>
                        <td>${info.HO_TEN}</td>
                        <td>${info.TEN_PB}</td>
                        <td>${info.CHUC_VU}</td>
                        <td>
                            <a href="#" class="text-primary" style="text-decoration: none" id="detail"
                            employeeId="${info.MA_NV}" role="${info.CHUC_VU} ${info.TEN_PB}">Chi tiết</a>
                            |
                            <a href="#" class="text-primary" style="text-decoration: none" id="update"
                            employeeId="${info.MA_NV}">Cập nhật</a>
                            |
                            <button href="#" class="text-primary"
                                    type="button" data-toggle="modal" data-target="#deletedModal"
                                    style="border: none; background-color: inherit; cursor: pointer"
                                    employeeId="${info.MA_NV}" employeeName="${info.HO_TEN}" id="btn-delete">Xóa
                            </button>
                        </td>
                    </tr>`
                );
            });
        });
    }

    const deleteEmployee = function(){
        $(document).on ("click", "#btn-delete", function () {
            const id = $(this).attr('employeeId');
            const name = $(this).attr('employeeName');

            $("#employeeName").text(name);

            $(document).on ("click", "#deleteConfirm", function () {
                $.post('http://localhost/final/API/delete-employee.php', {id: id}).done(function (response) {
                    if (response.code == 0) {
                        alertSuccess(response.message);
                        $('.modal').modal('hide');
                        loadData();
                    } 
                    else {
                        alertDanger(response.message);
                        $('.modal').modal('hide');
                    }
                });
            });
        });
    }

    const employeeDetail = function(){
        $(document).on ("click", "#detail", function () {
            window.location.href = "thongtin_nhan_vien.php?id=" + $(this).attr('employeeId') + "&role=" + $(this).attr('role');
        });
    }

    const updateEmployee = function(){
        $(document).on ("click", "#update", function () {
            window.location.href = "chinhsua_nhanvien.php?id=" + $(this).attr('employeeId');
        });
    }

    const searchNV = function(){
        $("#search").on('input', function (e){
            console.log(e.target.value);
            const value = removeVietnameseTones(e.target.value);
            const foundData = employeeList.filter(function (el){
                return removeVietnameseTones(el.HO_TEN.toLowerCase()).includes(value.toLowerCase());
            });
            $('#table-body').html('');
            foundData.forEach((info) => {
                $('#table-body').append(
                    `<tr>
                        <td>NV${info.MA_NV}</td>
                        <td>${info.HO_TEN}</td>
                        <td>${info.TEN_PB}</td>
                        <td>${info.CHUC_VU}</td>
                        <td>
                            <a href="#" class="text-primary" style="text-decoration: none" id="detail"
                            employeeId="${info.MA_NV}" role="${info.CHUC_VU} ${info.TEN_PB}">Chi tiết</a>
                            |
                            <a href="#" class="text-primary" style="text-decoration: none" id="update"
                            employeeId="${info.MA_NV}">Cập nhật</a>
                            |
                            <button href="#" class="text-primary"
                                    type="button" data-toggle="modal" data-target="#deletedModal"
                                    style="border: none; background-color: inherit; cursor: pointer"
                                    employeeId="${info.MA_NV}" employeeName="${info.HO_TEN}" id="btn-delete">Xóa
                            </button>
                        </td>
                    </tr>`
                );
            });
        });
    }

    $(document).ready(function () {
        loadData();
        deleteEmployee();
        employeeDetail();
        updateEmployee();
        searchNV();
    });
</script>

</html>
