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
    <link rel="stylesheet" href="../styles.css">
    <title>Trưởng phòng</title>
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
                    <a class="nav-link active" href="truong_phong.php">Trưởng phòng<span
                            class="sr-only">(current)</span></a>
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
        <div class="container" id="alert-container">

        </div>
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <h3 class="font-weight-bold">Danh Sách Trưởng Phòng</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 mb-md-0 mb-2">
            <form class="form-group mb-0 d-flex flex-sm-row flex-column">
                <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm theo tên phòng ban" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="button">Tìm kiếm</button>
            </form>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <button class="btn btn-success" id="btn-adding" data-toggle="modal" data-target="#addTruongPhong">Thêm
                Trưởng Phòng
            </button>
        </div>
    </div>

    <div class="row mt-5">

        <div class="col-12 table-responsive">
            <table class="table rounded" style="min-width: 750px;">
                <thead>
                <tr>
                    <th scope="col">Mã Phòng Ban</th>
                    <th scope="col">Mã Nhân Viên</th>
                    <th scope="col">Tên Phòng Ban</th>
                    <th scope="col">Tên Trưởng Phòng</th>
                    <th scope="col">Tác vụ</th>
                </tr>
                </thead>
                <tbody id="table-body">
                <!-- data go here -->
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="modal fade px-0" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeModalLabel">Thay đổi trưởng phòng <span class="modal-change__name">PB001</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="truongPhong_change">Trưởng phòng</label>
                    <select class="form-control" name="truongPhong" id="truongPhong_change">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-success btn-updated-leader" data-dismiss="modal">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<!--Modal cập nhật-->
<div class="modal fade" id="addTruongPhong" tabindex="-1" role="dialog" aria-labelledby="addTruongPhongLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTruongPhongLabel">Thêm Trưởng Phòng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="phongBan__add">Phòng Ban</label>
                        <select class="form-control" id="phongBan__add">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="truongPhong__add">Trưởng Phòng</label>
                        <select class="form-control" id="truongPhong__add" disabled>
                        </select>
                    </div>
                    <div class="form-group" id="alert-modal-container">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-modal__adding">Thêm</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Delete-->
<div class="modal fade" id="deletedModal" tabindex="-1" role="dialog" aria-labelledby="deletedModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletedModalLabel">Xóa trưởng phòng <span
                        class="modal-deleted__pb">PB1</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc xóa chức vụ trưởng phòng của <span
                    class="font-weight-bold modal-deleted__tennv"> Văn A ?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger btn-modal-deleted" data-dismiss="modal">Xóa</button>
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


    let searchData = [];
    const renderTable = function (data){
        $('#table-body').html('');
        data.forEach((info) => {
            $('#table-body').append(`
                    <tr>
                        <td>PB${info.MA_PHONG_BAN}</td>
                        <td>NV${info.MA_NV}</td>
                        <td>${info.TEN_PB}</td>
                        <td>${info.HO_TEN}</td>
                        <td>
                            <button class="text-primary btn-change" style="border: none; background-color: inherit; cursor: pointer"
                                    type="button" data-toggle="modal" data-target="#changeModal" data-nv='${info.MA_NV}' data-pb ='${info.MA_PHONG_BAN}'>
                                Cập nhật
                            </button>
                            |
                            <button class="text-primary btn-delete" data-ten = '${info.HO_TEN}'  data-nv='${info.MA_NV}' data-pb ='${info.MA_PHONG_BAN}' data-toggle="modal" data-target="#deletedModal"
                                    style="border: none; background-color: inherit; cursor: pointer">Xóa
                            </button>
                        </td>
                    </tr>`
            );
        });
    }


    const loadData = function () {
        $.get('../API/get_all_teamLeaders.php').done(function (respone) {
            const {data} = respone;
            renderTable(data);
            searchData = data;
        });
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

    const loadingAvailableEmployee = function (target, id) {
        $.post('../API/get_tLeader_byDp.php', {id: id}).done(function (response) {
            target.html('');
            if (response.code === 2) {
                target.attr('disabled', true);
            } else if (response.code === 0) {
                const {data} = response;
                data.forEach(el => {
                    target.attr('disabled', false);
                    target.append(`<option value="${el.MA_NV}">${el.HO_TEN}</option>`)
                });
            }

        });
    }


    $(document).ready(function () {
        let currentUpdateDepartment;
        let currentDelete;

        $('#btn-adding').on('click', function () {
            const phongBanAdd = $('#phongBan__add');
            phongBanAdd.html('');
            const truongPhongAdd = $('#truongPhong__add');
            $.getJSON('../API/get_dp_no_leader.php').done(function (response) {
                if (response.code === 2) {
                    phongBanAdd.attr('disabled', true);
                    phongBanAdd.append('<option>Không còn phòng ban cần thêm</option>')
                    truongPhongAdd.attr('disabled', true);
                }
                if (response.code === 0) {
                    phongBanAdd.attr('disabled', false);
                    const {data} = response;
                    data.forEach(el => {
                        phongBanAdd.append(`<option value="${el.MA_PHONG_BAN}">${el.TEN_PB}</option>`)
                    });
                    loadingAvailableEmployee(truongPhongAdd, phongBanAdd.val());
                }
            });
        });


        $('#phongBan__add').on('change', function () {
            loadingAvailableEmployee($('#truongPhong__add'), $('#phongBan__add').val());
            $('#modal-alert').alert('close');
        });

        $('.btn-modal__adding').on('click', function () {
            const phongBanAdd = $('#phongBan__add');
            const truongPhongAdd = $('#truongPhong__add');
            const data = {
                pb: +phongBanAdd.val(),
                id: +truongPhongAdd.val()
            };
            if (!truongPhongAdd.val()) {
                $('#alert-modal-container').append(`<div class="alert alert-danger alert-dismissible fade show" role="alert" id="modal-alert">
                            <strong>Không thể thêm</strong> Phòng ban không có nhân viên, Hãy nhân viên thêm mới.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);
                return;
            }

            $.post('../API/addTeamLeader.php', data).done(function (res) {
                $('#addTruongPhong').modal('hide');
                loadData();
                alertSuccess(res.message);
            });

        });


        $('.btn-updated-leader').on('click', function () {
            const currentLeader = $('#truongPhong_change').val();
            const data = {id: currentLeader, pb: currentUpdateDepartment}
            $.post('../API/update_teamLeaders.php', data).done(function (response) {
                if (response.code === 0) {
                    alertSuccess(response.message);
                    loadData();
                } else if (response.code === 4) {
                    alertDanger(response.message);
                } else {
                    alertDanger(response.message);
                }
                ;
            });
        });

        $('.btn-modal-deleted').on('click', function () {
            $.post('../API/delete_truong_phong.php', {pb: currentDelete}).done(function (response) {
                if (response.code === 0) {
                    alertSuccess(response.message);
                    loadData();
                } else {
                    alertDanger(response.message);
                }
                ;
            });
        });


        loadData();
        $('#table-body').on('click', function (e) {
            const btn = e.target.closest('.btn-change') || e.target.closest('.btn-delete');
            const {pb, nv} = btn.dataset;

            if (!btn) return;
            currentUpdateDepartment = pb;
            if ($(btn).hasClass('btn-change')) {
                $('.modal-change__name').html(`PB${pb}`);
                $('#truongPhong_change').html('');
                $.post('../API/get_tLeader_byDp.php', {id: pb}).done(function (response) {
                    const {data} = response;
                    data.forEach((info) => {
                        $('#truongPhong_change').append(`<option ${nv == info.MA_NV ? 'selected' : ''} value="${info.MA_NV}">NV${info.MA_NV} - ${info.HO_TEN}</option>`)
                    });
                });
            } else {
                const {ten} = btn.dataset;
                $('.modal-deleted__pb').text(`PB${pb}`);
                $('.modal-deleted__tennv').text(ten);
                currentDelete = pb;
            }

        });

        $("input[type='search']").on('input', function (e){
            const value = removeVietnameseTones(e.target.value);
            const foundData = searchData.filter(function (el){
                return removeVietnameseTones(el.TEN_PB.toLowerCase()).includes(value.toLowerCase());
            });
            renderTable(foundData);
        });

    });
</script>
</body>
</html>