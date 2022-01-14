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

    <title>Danh Sách Tài Khoản</title>
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
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Nhân viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="phong_ban_list.php">Phòng ban</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="truong_phong.php">Trưởng phòng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="taikhoan.php">Tài khoản<span class="sr-only">(current)</span></a>
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
    <div class="row">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <h3 class="font-weight-bold">Danh Sách Tài Khoản</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 mb-md-0 mb-2">
            <form class="form-group mb-0 d-flex flex-sm-row flex-column">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row mt-5">

        <div class="col-md-8 col-12 table-responsive">
            <table class="table rounded">
                <thead>
                <tr>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Username</th>
                    <th scope="col">Tác vụ</th>
                </tr>
                </thead>
                <tbody id="table-body">
                    <!-- data goes here -->
                <!-- <tr>
                    <td>NV1</td>
                    <td>Đức Việt</td>
                    <td>vietlatui</td>
                    <td>
                        <button href="#" class="text-primary"
                                type="button" data-toggle="modal" data-target="#resetModal"
                                style="border: none; background-color: inherit; cursor: pointer">Reset mật khẩu
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>NV2</td>
                    <td>Đức Việt</td>
                    <td>vietlatui</td>
                    <td>
                        <button href="#" class="text-primary"
                                type="button" data-toggle="modal" data-target="#resetModal"
                                style="border: none; background-color: inherit; cursor: pointer">Reset mật khẩu
                        </button>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>NV3</td>
                    <td>Đức Việt</td>
                    <td>vietlatui</td>
                    <td>
                        <button href="#" class="text-primary"
                                type="button" data-toggle="modal" data-target="#resetModal"
                                style="border: none; background-color: inherit; cursor: pointer">Reset mật khẩu
                        </button>
                    </td>
                </tr> -->
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade px-0" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Xóa nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn reset mật khẩu của <span class="font-weight-bold">Văn A</span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-success">Reset</button>
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
    const loadData = function () {
        $.get('../API/get-all-accounts.php').done(function (respone) {
            const {data} = respone;
            $('#table-body').html('');
            data.forEach((info) => {
                $('#table-body').append(
                    `<tr>
                        <td>NV${info.MA_NV}</td>
                        <td>${info.HO_TEN}</td>
                        <td>${info.USER_NAME}</td>
                        <td>
                            <button href="#" class="text-primary"
                                    type="button" data-toggle="modal" data-target="#resetModal"
                                    style="border: none; background-color: inherit; cursor: pointer">Reset mật khẩu
                            </button>
                        </td>
                    </tr>`
                );
            });
        });
    }

    $(document).ready(function () {
        loadData();
    });
</script>

</html>