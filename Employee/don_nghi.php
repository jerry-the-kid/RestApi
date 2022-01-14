<?php
require_once ('employee_validate.php');
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
        <div class="row mb-2 flex-column-reverse flex-md-row">
            <div class="col-md-6 col-12 mb-4 align-items-center justify-content-end">
                <h2 class="font-weight-bold text-left" id="tieu_de">Tiêu đề</h2>
            </div>
            <div class="col-md-6 col-12 mb-4 d-flex justify-content-end">
                <a class="btn btn-light" href="don_nghi_list.php">Trở về danh sách</a>
            </div>
        </div>
        <div class="row p-4 bg-light rounded">
            <div class="col-12 d-flex align-items-center justify-content-between badge__container">
                <p class="mb-0"><span id="info_sender"></span></p>
            </div>
            <div style="margin : 30px 16px; border-bottom: 1px solid black; width: 100%"></div>
            <div class="col-12">
                Số ngày nghỉ đề cập : <span id="day"></span> ngày</p>
            </div>
            <div class="col-12">
                Nội dung: <span id="des"></span>
            </div>
            <div class="mt-4 col-md-8 col-lg-6 ml-auto">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span id="ten_file" class="badge badge-secondary p-2">minhchung.ppt</span>
                        <a id="download_link" href="#" class="btn btn-primary btn-sm">Download</a>
                    </li>
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
        const dn = <?php  echo $_GET['DN']  ?>;

        const createDateFormat = function (date, options) {
            const locale = navigator.language;
            return new Intl.DateTimeFormat(
                locale,
                options
            ).format(new Date(date));
        }

        const statusBadge = function (status){
            if(status === 'waiting'){
                return '<span class="badge badge-warning p-2">Waiting</span>';
            } else if(status === 'approved') {
                return '<span class="badge badge-success p-2">Approved</span>';
            } else if(status === 'refused'){
                return '<span class="badge badge-secondary p-2">Refused</span>';
            }
        }


        $(document).ready(function () {
            const tieu_de = $('#tieu_de');
            const sender = $('#info_sender');
            const date = $('#day');
            const description = $('#des');

            $('.btn-ok').on('click', function (){
                $.post('../api/update_don_nghi_status.php', {status : 'approved', dn : dn}).done(function (res){
                    location.reload();
                });
            });

            $('.btn-not-ok').on('click', function (){
                $.post('../api/update_don_nghi_status.php', {status : 'refused', dn : dn}).done(function (res){
                    location.reload();
                });
            });

           $.getJSON('../api/get_details_don_nghi.php', {dn : dn}).done(function (res){
               const data = res.data[0];
               console.log(data);
               tieu_de.text(data.TIEU_DE);
               sender.text(`NV${data.MA_NV} - ${data.HO_TEN} • ${createDateFormat(data.NGAY_LAM_DON, {
                   day: 'numeric',
                   month: 'numeric',
               })}`);
               date.text(data.SO_NGAY);
               description.text(data.NOI_DUNG);
               $('.badge__container').append(statusBadge(data.TRANG_THAI));
               $('#ten_file').text(data.MINH_CHUNG?.split('/').pop());
               $('#download_link').attr('href', `../api/download.php?file=${data.MINH_CHUNG}`);
               if(data.TRANG_THAI !== 'waiting') {
                   console.log('Hello');
                   $('.btn_container').removeClass('d-flex');
                   $('.btn_container').addClass('d-none');
               }
           });
        });
    </script>
    
    </html>
<?php
