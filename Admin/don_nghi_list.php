<?php
require_once('admin_validate.php');
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
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Nhân viên</a>
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
                <li class="nav-item active">
                    <a class="nav-link" href="don_nghi_list.php">Đơn nghỉ <span class="sr-only">(current)</span></a>
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
            <h3 class="font-weight-bold">Danh Sách Nhiệm Vụ</h3>
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
                    <option value="3">Waiting</option>
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
                    <th scope="col">Nhân viên gửi</th>
                    <th scope="col">Số ngày</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Tác vụ</th>
                </tr>
                </thead>
                <tbody id="table-body">
                <tr>
                    <td>Vợ em đẻ sếp ạ</td>
                    <td>NV01 - Mark</td>
                    <td>3</td>
                    <td><span class="badge badge-warning p-2">Waiting</span></td>
                    <td><a href="don_nghi.php" style="text-decoration: none">Xem chi tiết</a></td>
                </tr>
                <tr>
                    <td>Vợ bạn em đẻ sếp ạ</td>
                    <td>NV02 - Mike</td>
                    <td>12</td>
                    <td><span class="badge badge-secondary p-2">Refused</span></td>
                    <td><a href="don_nghi.php" style="text-decoration: none">Xem chi tiết</a></td>
                </tr>
                <tr>
                    <td>Đi party</td>
                    <td>NV02 - Johnny</td>
                    <td>2</td>
                    <td><span class="badge badge-success p-2">Approved</span></td>
                    <td><a href="don_nghi.php" style="text-decoration: none">Xem chi tiết</a></td>
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
</body>

<script type="application/javascript">
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>
</html>
