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

    <title>Thông tin nhân viên</title>
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
                <li class="nav-item ">
                    <a class="nav-link" href="phong_ban_info.php">Phòng ban</a>
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
    <div class="row mb-2 flex-column-reverse flex-md-row">
        <div class="col-md-6 col-12 mb-4 align-items-center justify-content-end">
            <h2 class="font-weight-bold text-left">Thông tin nhân viên</h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end">
            <a href="index.php" class="btn btn-light d-flex align-items-center justify-content-center">Trở về danh sách</a>
        </div>
    </div>
    <div class="row rounded p-4">
        <div class="col-4 bg-light py-4 rounded d-flex align-items-center justify-content-center flex-column">
            <img id="avatar" src="" alt="Không nhận được avatar xin hãy cập nhật avatar" width="150px" style="display: block; height: 150px; border-radius: 50%;">
            <h5 class="font-weight-bold mt-4" id="name"></h5>
            <p class="font-weight-light" id="role"></p>
        </div>

        <div class="col-8 border-left bg-light py-4 rounded">
            <table class="table table-bordered">
                <tbody>

                <tr>
                    <td class="font-weight-bold">Username</td>
                    <td colspan="4" id="username"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Mã NV</td>
                    <td id="manv"></td>
                    <td class="font-weight-bold">Mã PB</td>
                    <td id="mapb"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Ngày sinh</td>
                    <td id="ngaySinh"></td>
                    <td class="font-weight-bold">Giới tính</td>
                    <td id="gender"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Email</td>
                    <td id="email"></td>
                    <td class="font-weight-bold" >SĐT</td>
                    <td id="phone"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Địa chỉ</td>
                    <td colspan="4" id="address"></td>
                </tr>
                </tbody>
            </table>
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

<script>
    const fillData = function(){
        let id = getUrlParameter('id');
        let role = getUrlParameter('role');

        $.get('http://localhost/final/API/get-employee-detail.php', {id: id}).done(function (respone) {
            const employee = respone['data'][0];

            $('#avatar').attr('src', employee.AVATAR_PATH);
            $("#name").text(employee.HO_TEN);
            $("#role").text(role);
            $("#username").text((employee.USER_NAME));
            $("#manv").text("NV" + id)
            $("#mapb").text("PB" + employee.MA_PHONG_BAN);
            $("#ngaySinh").text(dateFormat(employee.ngay_sinh));

            if(employee.gioi_tinh == 0){
                $("#gender").text("Nữ");
            }
            else $("#gender").text("Nam");

            $("#email").text(employee.email);
            $("#phone").text(employee.PHONE);
            $("#address").text(employee.ADDRESS);
        });
    }

    function dateFormat(date){
        let dateObj = new Date(date);
        let month = dateObj.getUTCMonth() + 1;
        let day = dateObj.getUTCDate();
        let year = dateObj.getUTCFullYear();

        newdate = day + "/" + month + "/" + year;
        return newdate;
    }

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
    };

    $(document).ready(function () {
        fillData();
    });


</script>
</body>
</html>