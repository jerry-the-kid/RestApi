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
    <link rel="stylesheet" href="../styles.css">
    <title>Danh Sách Phòng Ban</title>
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
    <div class="row">
        <div class="container" id="alert-container">

        </div>
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <h3 class="font-weight-bold">Danh Sách Phòng Ban</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 mb-md-0 mb-2">
            <form class="form-group mb-0 d-flex flex-sm-row flex-column">
                <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm theo tên phòng ban" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="button">Search</button>
            </form>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <button class="btn btn-success" data-toggle="modal" data-target="#addModal"> Thêm Phòng Ban</button>
        </div>
    </div>
    <div class="row mt-5">

        <div class="col-12 table-responsive">
            <table class="table rounded" style="min-width: 700px;">
                <thead>
                <tr>
                    <th scope="col">Mã phòng ban</th>
                    <th scope="col">Tên phòng ban</th>
                    <th scope="col">Số phòng</th>
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

<!-- Modal Deleted-->
<div class="modal fade px-0" id="deletedModal" tabindex="-1" role="dialog" aria-labelledby="deletedModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletedModalLabel">Xóa phòng ban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn xóa phòng ban tên <span class="font-weight-bold deletedModal__tenPb" id="">Phòng giáo dục</span>
                    ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-danger deletedModal__delete">Xóa</button>
            </div>
        </div>
    </div>
</div>


<!--Modal adding-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addedModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addedModalLabel">Thêm phòng ban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="modal-add__maphong" class="col-form-label">Tên phòng ban:</label>
                        <input class="form-control" id="modal-add__maphong"/>
                    </div>
                    <div class="form-group">
                        <label for="modal-add__sophong" class="col-form-label">Số phòng:</label>
                        <input type="text" class="form-control" id="modal-add__sophong">
                    </div>
                    <div class="form-group">
                        <label for="modal-add__mota" class="col-form-label">Mô tả:</label>
                        <textarea class="form-control" id="modal-add__mota"></textarea>
                    </div>
                    <div class="form-group" id="modal-add__alert">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-success btn-modal__add">Thêm</button>
            </div>
        </div>
    </div>
</div>


<!--Modal cập nhật-->
<div class="modal fade" id="updatedModal" tabindex="-1" role="dialog" aria-labelledby="updatedModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatedModalLabel">Cập nhật phòng ban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="modal-update__maphong" class="col-form-label">Tên phòng ban:</label>
                        <input class="form-control" id="modal-update__maphong"/>
                    </div>
                    <div class="form-group">
                        <label for="modal-update__sophong" class="col-form-label">Số phòng:</label>
                        <input type="text" class="form-control" id="modal-update__sophong">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Mô tả:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="form-group" id="modal-update__alert">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-success btn-modal__update">Cập nhật</button>
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
    let currentUpdate;
    let searchData = [];

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
        $('.alert-danger').fadeOut(4500);
    }

    const clearElementInput = function (...elArray) {
        elArray.forEach(el => {
            $(el).val('');
        })
    };


    const renderTable = function (data) {
        $('#table-body').html('');
        data.forEach((info) => {
            $('#table-body').append(`
                <tr>
                    <td>PB${info.MA_PHONG_BAN}</td>
                    <td>${info.TEN_PB}</td>
                    <td>${info.SO_PHONG}</td>
                    <td>
                        <a href="phong_ban_info.php?id=${info.MA_PHONG_BAN}" class="text-primary" style="text-decoration: none">Chi tiết</a>
                        |
                        <button href="#" class="text-primary" data-id="${info.MA_PHONG_BAN}"
                                onclick="updateDepartment(this)"
                                type="button" data-toggle="modal" data-target="#updatedModal"
                                style="border: none; background-color: inherit; cursor: pointer">Cập nhật
                        </button>
                        |
                        <button href="#" class="text-primary btn-delete"
                                data-id = '${info.MA_PHONG_BAN}'
                                data-ten = '${info.TEN_PB}'
                                type="button" data-toggle="modal" data-target="#deletedModal"
                                style="border: none; background-color: inherit; cursor: pointer">Xóa
                        </button>
                    </td>
                </tr>`
            );
        });
    }


    const loadData = function () {
        $.get('../API/get_all_departments.php').done(function (respone) {
            const {data} = respone;
            renderTable(data);
            searchData = data;
        });
    }

    const updateDepartment = function (e) {
        const id = e.dataset.id;
        currentUpdate = id;
        $.post('../api/get_dp_info.php', {pb: id}).done(function (res) {
            const data = res.data[0];
            $('#modal-update__maphong').val(data.TEN_PB);
            $('#modal-update__sophong').val(data.SO_PHONG);
            $('#message-text').val(data.MO_TA);
        });
    };


    const alertFormDanger = function (container, message) {
        $(container).append(`<div class="alert alert-danger alert-dismissible fade show" role="alert" id="modal-alert">
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`);
    }

    $(document).ready(function () {
        let currentDeleteDp;
        const maPhongAdding = $('#modal-add__maphong');
        const soPhongAdding = $('#modal-add__sophong');
        const motaAdding = $('#modal-add__mota');


        loadData();

        [maPhongAdding, soPhongAdding, motaAdding, $('#modal-update__maphong'), $('#modal-update__sophong'), $('#message-text')].forEach(el => {
            el.on('input', function () {
                $('#modal-alert').alert('close');
            });
        });


        $('.btn-modal__update').on('click', function () {
            if (!$('#modal-update__maphong').val()) {
                alertFormDanger('#modal-update__alert', 'Tên phòng ban còn thiếu.Vui lòng nhập.');
                $('#modal-update__maphong').focus();
            } else if (!$('#modal-update__sophong').val()) {
                alertFormDanger('#modal-update__alert', 'Số phòng ban còn thiếu. Vui lòng nhập.');
                $('#modal-update__sophong').focus();
            } else if (!$('#message-text').val()) {
                alertFormDanger('#modal-update__alert', 'Mô tả phòng ban còn thiếu. Vui lòng nhập.');
                $('#message-text').focus();
            } else {
                const data = {
                    id : currentUpdate,
                    ten: $('#modal-update__maphong').val(),
                    phong: $('#modal-update__sophong').val(),
                    mota: $('#message-text').val()
                };

                $.post('../API/update_dp.php', data).done(function (response) {
                    if (response.code === 0) {
                        alertSuccess(response.message);
                        $('#updatedModal').modal('hide');
                        loadData();
                        clearElementInput($('#modal-update__maphong'), $('#modal-update__sophong'), $('#message-text'));
                    } else {
                        alertDanger(response.message);
                        $('#updatedModal').modal('hide');
                    }
                });
            }
        });


        $('.btn-modal__add').on('click', function (e) {
            if (!maPhongAdding.val()) {
                alertFormDanger('#modal-add__alert', 'Tên phòng ban còn thiếu.Vui lòng nhập.');
                maPhongAdding.focus();
            } else if (!soPhongAdding.val()) {
                alertFormDanger('#modal-add__alert', 'Số phòng ban còn thiếu. Vui lòng nhập.');
                soPhongAdding.focus();
            } else if (!motaAdding.val()) {
                alertFormDanger('#modal-add__alert', 'Mô tả phòng ban còn thiếu. Vui lòng nhập.');
                motaAdding.focus();
            } else {
                const data = {
                    ten: maPhongAdding.val(),
                    phong: soPhongAdding.val(),
                    mota: motaAdding.val()
                };

                $.post('../API/add_dp.php', data).done(function (response) {
                    if (response.code === 0) {
                        alertSuccess(response.message);
                        $('#addModal').modal('hide');
                        loadData();
                        clearElementInput(maPhongAdding, soPhongAdding, motaAdding);
                    } else {
                        alertDanger(response.message);
                        $('#addModal').modal('hide');
                    }
                });
            }

        });

        $("input[type='search']").on('input', function (e){
            const value = removeVietnameseTones(e.target.value);
            const foundData = searchData.filter(function (el){
                return removeVietnameseTones(el.TEN_PB.toLowerCase()).includes(value.toLowerCase());
            });
            renderTable(foundData);
        });


        $('.deletedModal__delete').on('click', function () {
            $.post('http://localhost/final/API/delete_db.php', {id: currentDeleteDp}).done(function (response) {
                if (response.code === 0) {
                    alertSuccess(response.message);
                    $('#deletedModal').modal('hide');
                    loadData();
                } else {
                    alertDanger(response.message);
                    $('#deletedModal').modal('hide');
                }
            });
        });

        $('#table-body').on('click', function (e) {
            const btn = e.target.closest('.btn-delete');
            if (!btn) return;
            const {id, ten} = btn.dataset;
            if ($(btn).hasClass('btn-delete')) {
                $('.deletedModal__tenPb').text(ten);
                currentDeleteDp = id;
            }
        });
    });
</script>
</body>
</html>