<?php
require_once('tlead_validate.php');
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

    <title>Danh Sách Đơn Nghỉ</title>
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
                    <a class="nav-link" href="index.php">Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cancel_task_list.php">Canceled Task</a>
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

    <div class="row">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <h3 class="font-weight-bold">Danh Sách Đơn Nghỉ</h3>
        </div>
    </div>
    <div class="container" id="alert-container">
    </div>
    <div class="row">
        <div class="jumbotron jumbotron-fluid col-12 rounded" style="padding: 2rem">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <p class="lead mb-0"><b>Tổng ngày nghỉ :</b> 15 ngày </p>
                    <p class="lead mb-0"><b>Số ngày đã sử dụng :</b> <span id="date-used"></span> ngày</p>
                    <p class="lead mb-0"><b>Còn lại :</b> <span id="date-left"></span> ngày</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-md-8 mb-md-0 mb-2">
            <form class="form-group mb-0 d-flex flex-sm-row flex-column">
                <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm theo tiêu đề"
                       aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <button class="btn btn-success btn-add" data-toggle="modal" data-target="#createTaskModal">Tạo đơn nghỉ
            </button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="status">Trạng thái</label>
                </div>
                <select class="custom-select" id="status">
                    <option value="1">All</option>
                    <option value="2">Approved</option>
                    <option value="3">Refused</option>
                    <option value="4">Waiting</option>
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

                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Create Task Modal-->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Tạo đơn nghỉ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createTaskForm">
                    <div class="form-group">
                        <label for="title" class="col-form-label">Tiêu đề</label>
                        <input name="title" type="text" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="date_left_form">Số ngày :</label>
                        <select name="date" class="form-control" id="date_left_form">
                            <option value="1">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Mô tả</label>
                        <textarea class="form-control" name="description" id="description" cols="10"
                                  rows="3"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">File đính kèm</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                    </div>
                    <div class="alert-modal-container">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-create">Create</button>
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

<script type="application/javascript">
    let dateUsed, dateLeft;
    let storedData = [];
    let searchData = [];

    function removeVietnameseTones(str) {
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
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
        str = str.replace(/ + /g, " ");
        str = str.trim();
        // Remove punctuations
        // Bỏ dấu câu, kí tự đặc biệt
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
        return str;
    }

    const changeFilter = function (filter) {
        let data = [];
        data = storedData.filter(el => el.TRANG_THAI === filter);
        renderTable(data);
        searchData = data;
    }


    const renderByValue = function () {
        const value = +$('#status').val();
        if (value === 1) {
            renderTable(storedData);
            searchData = storedData;
        } else if (value === 2) {
            changeFilter('approved');
        } else if (value === 3) {
            changeFilter('refused');
        } else if (value === 4) {
            changeFilter('waiting');
        }
    }


    const id = <?php echo $_SESSION['user_id']  ?>;
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

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


    const alertFormDanger = function (container, message) {
        $(container).html('');
        $(container).append(`<div class="alert alert-danger alert-dismissible fade show" role="alert" id="modal-alert">
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>`);
    }

    const statusBadge = function (status) {
        if (status === 'waiting') {
            return '<td><span class="badge badge-warning p-2">Waiting</span></td>';
        } else if (status === 'approved') {
            return '<td><span class="badge badge-success p-2">Approved</span></td>';
        } else if (status === 'refused') {
            return '<td><span class="badge badge-secondary p-2">Refused</span></td>';
        }
    }

    const renderTable = function (data) {
        $('#table-body').html('');
        data.forEach(function (el) {
            $('#table-body').append(`<tr>
                    <td>${el.TIEU_DE}</td>
                    <td>NV${el.MA_NV} - ${el.HO_TEN}</td>
                    <td>${el.SO_NGAY}</td>
                    ${statusBadge(el.TRANG_THAI)}
                    <td><a href="don_nghi_self.php?DN=${el.MA_NGHI}" style="text-decoration: none">Xem chi tiết</a></td>
                </tr>`);
        });
    }

    const loadDate = function () {
        $.get('../api/get_ngay_nghi_trong_nam_tlead.php', {id: id}).done(function (res) {
            const data = res.data;
            dateUsed = data.reduce((el, el_1) => el.SO_NGAY + el_1.SO_NGAY);
            $('#date-used').text(dateUsed);
            dateLeft = 15 - dateUsed;
            $('#date-left').text(dateLeft);
            $('#date_left_form').html('');
            for (let i = 1; i <= dateLeft; i++) {
                $('#date_left_form').append(`<option value="${i}">${i}</option>`);
            }
            if (dateLeft === 0) {
                $('.btn-add').attr('disabled', true);
            }
            ;
        });
    }

    const loadData = function () {
        loadDate();
        $.getJSON('../api/get_don_nghi_self_list.php', {id: id}).done(function (res) {
            const now = new Date();
            const data = res.data;
            let sevenDayBlock = data.some(function (el) {
                return now.getTime() - Date.parse(el.NGAY_LAM_DON) < 604800000;
            });

            if (sevenDayBlock) {
                $('.btn-add').attr('disabled', true);
            }
            storedData = data;
            renderByValue();
        });
    }

    $(document).ready(function () {
        const title = $('#title');
        const description = $('#description');
        const file = $('#file');

        loadData();


        $('.btn-create').on('click', function () {
            const extenstion = file[0].files[0].name.split('.').pop();
            if (!title.val()) {
                alertFormDanger('.alert-modal-container', 'Tiêu đề còn thiếu. Vui lòng nhập');
                title.focus();
            } else if (!description.val()) {
                alertFormDanger('.alert-modal-container', 'Nội dung còn thiếu. Vui lòng nhập');
                description.focus();
            } else if (file.get(0).files.length === 0) {
                alertFormDanger('.alert-modal-container', 'File minh chứng còn thiếu. Vui lòng thêm');
            } else if(file[0].files[0].size > 104857600) {
                alertFormDanger('.alert-modal-container', 'File nộp cần nhỏ hơn 100MB');
            }
            else if(extenstion.includes('exe') || extenstion.includes('sh')) {
                alertFormDanger('.alert-modal-container', 'Kiểu file sai. Xin nhập kiểu khác');
            } else {
                const form = $('#createTaskForm')[0];
                const formData = new FormData(form);
                formData.append("sender", id);

                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "../api/create_don_nghi_tlead.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                        alertSuccess(data.message);
                        $('#createTaskModal').modal('hide');
                        loadData();
                    },
                    error: function (e) {
                        $('#createTaskModal').modal('hide');
                        alertDanger(e.responseText);
                    }
                });
            }
        });

        $('#status').on('change', function (){
            renderByValue();
        });

        $("input[type='search']").on('input', function (e){
            const value = removeVietnameseTones(e.target.value);
            const foundData = searchData.filter(function (el){
                return removeVietnameseTones(el.TIEU_DE.toLowerCase()).includes(value.toLowerCase());
            });
            renderTable(foundData);
        });

        [title, description, file].forEach(el => {
            el.on('input', function () {
                $('.alert-modal-container').html('');
            });
        });
    });

</script>
</html>
