<?php
require_once ('tlead_validate.php');
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

    <title>Danh Sách Nhiệm Vụ</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Task<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cancel_task_list.php">Canceled Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="completed_task_list.php">Completed Task</a>
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
<div class="container" id="alert-container">

</div>
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
        <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
            <button class="btn btn-success btn-add" data-toggle="modal" data-target="#createTaskModal">Tạo task</button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="status_select">Trạng thái</label>
                </div>
                <select class="custom-select" id="status_select">
                    <option value="1">All</option>
                    <option value="2">New Tasks</option>
                    <option value="3">In progress Tasks</option>
                    <option selected value="4">Waiting tasks</option>
                    <option selected value="4">Rejected tasks</option>
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
                    <th scope="col">Nhân viên phụ trách</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Tác vụ</th>
                </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Data goes here -->
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- Cancel Modal-->
<div class="modal fade px-0" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Xóa nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn chắc muốn hủy task này chứ ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-danger" id="cancelTask">Hủy</button>
            </div>
        </div>
    </div>
</div>

<!-- Create Task Modal-->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Tạo task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createTaskForm">
                    <div class="form-group">
                        <label for="task-name" class="col-form-label">Tiêu đề</label>
                        <input name="task" type="text" class="form-control" id="task-name">
                    </div>
                    <div class="form-group">
                        <label for="deadline" class="col-form-label">Deadline:</label>
                        <input name="deadline" type="datetime-local" id="deadline" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="createTaskNVien">Nhân viên nhận :</label>
                        <select name="nhanvien" class="form-control" id="createTaskNVien">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="describe-text" class="col-form-label">Mô tả</label>
                        <textarea name="describe" class="form-control" id="describe-text"></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">File đính kèm</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="alert-modal-container">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-create-task">Create</button>
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
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>

<script>
    const user_id = <?php echo $_SESSION['user_id'] ?>;
    let storedData = [];
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


    const changeFilter = function (filter){
        let data = [];
        data = storedData.filter(el => el.STATUS === filter);
        renderTable(data);
        searchData = data;
    }


    const renderByValue = function (){
        const value = +$('#status_select').val();
        if(value === 1){
            renderTable(storedData);
            searchData = storedData;
        } else if(value === 2){
            changeFilter('New');
        } else if(value === 3){
            changeFilter('In progress');
        } else if(value === 4){
            changeFilter('Waiting');
        } else if(value === 5){
            changeFilter('Rejected');
        }
    }

    const renderTable = function (data){
        $('#table-body').html('');
        data.forEach((task) => {
            let tableRow = $('<tr> <td>'+ task.TIEU_DE +'</td> <td>NV'+ task.MA_NGUOI_NHAN +' - '+ task.HO_TEN +'</td> <td><span class="'+ check(task.STATUS) +'">'+ task.STATUS +'</span></td> <td>'+ convert(task.DEADLINE) +'</td> <td><a href="'+ link(task.STATUS, task.TASK_ID) +'" class="text-primary" style="text-decoration: none">Chi tiết</a> '+ buttonDlt(task.STATUS, task.TASK_ID) +'</td> </tr>');
            tableRow.attr('task-info', JSON.stringify(task))
            $('#table-body').append(tableRow);
        })
    }


    function loadProduct(){
        $('#table-body').html('');
        $.post("../api/get_task_teamLead.php",{id : user_id}, function(res, status) {
            const data = res.data;
            storedData = data;
            renderByValue();
        },"json");
    }





    function buttonDlt(status, task_id){
        if (status == "New"){
            return '| <button taskId="' + task_id + '" id="cancelBtn" class="text-primary" type="button" data-toggle="modal" data-target="#cancelModal" style="border: none; background-color: inherit; cursor: pointer">Hủy </button>';
        }
        else {
            return '';
        }
    }

    function check(status){
        if (status == "New"){
            return "badge badge-success p-2";
        }
        else if (status == "In progress"){
            return "badge badge-primary p-2";
        }
        else if (status == "Waiting"){
            return "badge badge-warning p-2";
        }
        else if (status == "Rejected"){
            return "badge badge-danger p-2";
        }
    }

    function link(status, task_id){
        if (status == "New"){
            return `new_task_info.php?task=${task_id}`;
        }
        else if (status == "In progress"){
            return `inprogress_task.php?task=${task_id}`;
        }
        else if (status == "Waiting"){
            return `waiting_task.php?task=${task_id}`;
        }
        else if (status == "Rejected"){
            return `reject_task.php?task=${task_id}`;
        }
    }

    function convert(time){
        if (time == null){
            return null;
        }
        else {
            const date = time;
            const readable_date = new Date(date).toLocaleDateString();
            return readable_date;
        }
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

    const clearElementInput = function (...elArray) {
        elArray.forEach(el => {
            $(el).val('');
        })
    };

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


    $(document).ready(function () {
        loadProduct();
        const taskName = $('#task-name');
        const deadLine = $('#deadline');
        const nhanVien = $('#createTaskNVien');
        const describeText = $('#describe-text');
        const file = $('#inputGroupFile01');

        // Render select option
        $('.btn-add').on('click', function (e){
            clearElementInput(taskName, deadLine, nhanVien, describeText, file);
            const selector = $('#createTaskNVien');
            $.post('../API/get_employee_by_Tlead.php', {id : user_id}).done(function (data){
                const nhanVien = data.data;
                if(!nhanVien) {
                    selector.append('')
                    selector.attr('disabled', true);
                    return;
                }
                selector.attr('disabled', false);
                selector.html('');
                nhanVien.forEach(function (el){
                    $('#createTaskNVien').append(`<option value="${el.MA_NV}">${el.HO_TEN} - ${el.MA_NV}</option>`);
                });
            });
        });

        $('.btn-create-task').on('click', function (e){
            if(!taskName.val()){
                alertFormDanger('.alert-modal-container', 'Tiêu đề còn thiếu. Vui lòng nhập');
                taskName.focus();
            } else if(!deadLine.val()){
                alertFormDanger('.alert-modal-container', 'Hạn nộp còn thiếu. Vui lòng nhập');
                deadLine.focus();
            } else if (!nhanVien.val()){
                alertFormDanger('.alert-modal-container', 'Phòng ban không có nhân viên. Vui lòng thêm');
            } else if(!describeText.val()){
                alertFormDanger('.alert-modal-container', 'Vui lòng nhập mô tả task.');
                describeText.focus();
            } else  {
                const form = $('#createTaskForm')[0];
                const formData = new FormData(form);
                formData.append("sender", user_id);
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "../api/create_new_task.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                        $('#createTaskModal').modal('hide');
                        alertSuccess(data.message);
                        loadProduct();
                    },
                    error: function (e) {
                        $('#createTaskModal').modal('hide');
                        alertDanger(e.responseText);
                    }
                });

            }
        });

        $(document).on("click", "#cancelBtn", function(){
            let taskId = $(this).attr("taskId");

            $('#cancelTask').on('click', function (e) {
                $.post('../api/cancel_task.php', {id: taskId}).done(function (response) {
                    $('#cancelModal').modal('hide');
                    loadProduct();
                });
            });

        });

        $('#status_select').on('change', function (){
            renderByValue();
        });

        $("input[type='search']").on('input', function (e){
            const value = removeVietnameseTones(e.target.value);
            const foundData = searchData.filter(function (el){
                return removeVietnameseTones(el.TIEU_DE.toLowerCase()).includes(value.toLowerCase());
            });
            renderTable(foundData);
        });

        [taskName, deadLine, nhanVien, describeText].forEach(el => {
            el.on('input', function (){
                $('.alert-modal-container').html('');
            });
        });
    });
</script>

</html>
