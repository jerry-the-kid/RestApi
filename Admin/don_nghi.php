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
        <div class="row mb-2 flex-column-reverse flex-md-row">
            <div class="col-md-6 col-12 mb-4 align-items-center justify-content-end">
                <h2 class="font-weight-bold text-left">Testing sản phẩm</h2>
            </div>
            <div class="col-md-6 col-12 mb-4 d-flex justify-content-end">
                <button class="btn btn-light">Trở về danh sách</button>
            </div>
        </div>
        <div class="row p-4 bg-light rounded">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <p class="mb-0">NV1 - Người gửi • 18/12</p>
                <span class="badge badge-secondary px-3 py-2">Cancel</span>
            </div>
            <div style="margin : 30px 16px; border-bottom: 1px solid black; width: 100%"></div>
            <div class="col-12">
                Số ngày nghỉ đề cập : 3 ngày</p>
            </div>
            <div class="col-12">
                Nội dung: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur deserunt magni maxime numquam
                quae soluta suscipit tenetur vero. Commodi debitis dolor nam. Aut distinctio hic neque quaerat quam
                voluptates! Distinctio nisi omnis recusandae. Aperiam atque ea, eius est minus molestiae, nobis officiis
                praesentium provident quas qui quisquam, ratione suscipit vitae.
            </div>
            <div class="mt-4 col-md-8 col-lg-6 ml-auto">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="badge badge-secondary p-2">minhchung.ppt</span>
                        <button class="btn btn-primary btn-sm">Download</button>
                    </li>
                </ul>
            </div>
            <div class="mt-4 col-12 ml-auto d-flex justify-content-end">
                <button class="btn-success btn">Approved</button>
                <button class="btn-danger btn ml-2">Refused</button>
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


    </html>
<?php
