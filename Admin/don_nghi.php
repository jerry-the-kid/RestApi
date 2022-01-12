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

        <title>Đơn Nghỉ</title>
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
                <h2 class="font-weight-bold text-left" id="tieu_de"></h2>
            </div>
            <div class="col-md-6 col-12 mb-4 d-flex justify-content-end">
                <button class="btn btn-light">Trở về danh sách</button>
            </div>
        </div>
        <div class="row p-4 bg-light rounded">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <p class="mb-0">NV<span id="ma_nv"></span> - <span id="ho_ten"></span> • <span id="date_create"></span></p>
                <span id="trang_thai"></span>
            </div>
            <div style="margin : 30px 16px; border-bottom: 1px solid black; width: 100%"></div>
            <div class="col-12">
                Số ngày nghỉ đề cập : <span id="so_ngay_nghi"></span></p>
            </div>
            <div class="mt-4 col-md-8 col-lg-6 ml-auto">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center" id="minh_chung">
                    </li>
                </ul>
            </div>
            <div class="mt-4 col-12 ml-auto d-flex justify-content-end">
                <button class="btn-success btn" data-toggle="modal" data-target="#approvedModal">Approved</button>
                <button class="btn-danger btn ml-2" data-toggle="modal" data-target="#refusedModal">Refused</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="approvedModal" tabindex="-1" role="dialog" aria-labelledby="approvedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approvedModalLabel">Duyệt đơn nghỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <p>Bạn đồng ý duyệt đơn nghỉ này ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Duyệt đơn</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="refusedModal" tabindex="-1" role="dialog" aria-labelledby="refusedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="refusedModalLabel">Từ chối đơn nghỉ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn đồng ý từ chối đơn nghỉ này ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger">Từ chối</button>
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

    <script>
        const idnghi = <?php echo $_GET['madonnghi'] ?>;

        const createDateFormat = function (date, options) {
            const locale = navigator.language;
            return new Intl.DateTimeFormat(
                locale,
                options
            ).format(new Date(date));
        }

        const renderStatus = function (status) {
            if (status === 'waiting') return "<span class = 'badge badge-warning p-2'>waiting</span>";
            if (status === 'refused') return "<span class = 'badge badge-secondary p-2'>refused</span>";
            if (status === 'approved') return "<span class = 'badge badge-success p-2'>approved</span>";
        }

        $(document).ready(function () {
            $.get('http://localhost/final/api/get_chi_tiet_don_nghi_tlead.php', {id: idnghi}).done(function (response) {
                console.log(response);
                const task = response.data[0];
                $('#tieu_de').text(task.NOI_DUNG);
                $('#ma_nv').text(task.MA_NV);
                $('#ho_ten').text(task.HO_TEN);
                $('#date_create').text(createDateFormat(task.NGAY_LAM_DON, {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }));
                $('#trang_thai').append(renderStatus(task.TRANG_THAI));
                $('#so_ngay_nghi').text(task.SO_NGAY);
                $('#minh_chung').append(`<p class="p-2 badge badge-secondary card-text mb-0">${task.MINH_CHUNG?.split('/').slice(-1)}</p>
            <a href="../api/download.php?file=${task.MINH_CHUNG}" class="btn btn-primary btn-sm">Download</a>`);
            });
        });

    </script>

    </body>


    </html>
