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

    <title>Thông tin phòng ban</title>
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
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Nhân viên</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="phong_ban_list.php">Phòng ban<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="truong_phong.php">Trưởng phòng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="taikhoan.php">Tài khoản</a>
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
            <h2 class="font-weight-bold text-left">Thông tin phòng ban</h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end">
            <a class="btn btn-light" href="phong_ban_list.php">Trở về danh sách</a>
        </div>
    </div>
    <div class="row bg-light rounded p-4">
        <div class="col-12 mb-4"><h3><span id="dpName"></span></h3></div>
        <div class="col-6"><p><span class="font-weight-bold">Số phòng :</span> <span id="dpNumber"></span> </p></div>
        <div class="col-6"><p><span class="font-weight-bold">Mã phòng ban : </span><span id="dpId"></span></p></div>
        <div class="col-6"><p><span class="font-weight-bold">Mã tổ trưởng : </span><span id="tleadId"></span></p></div>
        <div class="col-6"><p><span class="font-weight-bold">Tên tổ trưởng : </span><span id="tleadName"></span></p></div>
        <div class="col-md-9">
            <p>
                <span class="font-weight-bold">Mô tả : </span><span id="desc"></span>
            </p>
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
    };

    const fillData = function(){
        let id = getUrlParameter("id");

        $.post('../API/get_dp_info.php', {pb: id}).done(function (respone) {
            dpInfo = respone['data'][0];

            $("#dpName").text(dpInfo.TEN_PB);
            $("#dpNumber").text(dpInfo.SO_PHONG);
            $("#dpId").text(dpInfo.MA_PHONG_BAN);
            $("#tleadId").text("NV" + dpInfo.MA_NV);
            $("#tleadName").text(dpInfo.HO_TEN);
            $("#desc").text(dpInfo.MO_TA);
        })
    }

    $(document).ready(function () {
        fillData();
    })
</script>

</html>