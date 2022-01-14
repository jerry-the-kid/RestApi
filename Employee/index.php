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
<div class="container">
    <div class="row">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <h3 class="font-weight-bold">Danh Sách Nhiệm Vụ</h3>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-md-8 mb-md-0 mb-2">
            <form class="form-group mb-0 d-flex flex-sm-row flex-column">
                <input id="search" class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 mb-4 align-items-center justify-content-end">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="statusSelect">Trạng thái</label>
                </div>
                <select class="custom-select" id="statusSelect">
                    <option selected value="1">All</option>
                    <option value="2">New Tasks</option>
                    <option value="3">Rejected tasks</option>
                    <option value="4">Cancel Tasks</option>
                    <option value="5">Waiting tasks</option>
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

                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade px-0" id="deletedModal" tabindex="-1" role="dialog" aria-labelledby="deletedModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletedModalLabel">Xóa nhân viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc muốn xóa nhân viên tên <span class="font-weight-bold">Văn A</span> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-danger">Xóa</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Tạo task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nhân viên giao</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Mô tả</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">File đính kèm</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Create</button>
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
    let taskList = [];
    let tempSearch = [];

    $(document).ready(function () {
        loadProduct();
        statusSelect();
        searchTask();
    });

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

    const statusSelect = function(){
        $("#statusSelect").on("change", function(event){
            let value = $(this).val();

            if(value == 1){
                tempSearch = taskList;
                renderTable(tempSearch);
            } else if(value == 2){
                tempSearch = taskList.filter(el => el.STATUS === "New");
                renderTable(tempSearch);
            } else if(value == 3){
                tempSearch = taskList.filter(el => el.STATUS === "In progress");
                renderTable(tempSearch);
            } else if(value == 4){
                tempSearch = taskList.filter(el => el.STATUS === "Waiting");
                renderTable(tempSearch);
            } else if(value == 5){
                tempSearch = taskList.filter(el => el.STATUS === "Rejected");
                renderTable(tempSearch);
            }
        });
    }
    
    function renderTable(data){
        $('#table-body').html('');
        data.forEach((task) => {
            let tableRow = $('<tr> <td>'+ task.TIEU_DE +'</td> <td>NV'+ task.MA_NGUOI_NHAN +' - '+ task.HO_TEN +'</td> <td><span class="'+ check(task.STATUS) +'">'+ task.STATUS +'</span></td> <td>'+ convert(task.DEADLINE) +'</td> <td><a href="'+ link(task.STATUS, task.TASK_ID) +'" class="text-primary" style="text-decoration: none">Chi tiết</a> </td> </tr>');
            tableRow.attr('task-info', JSON.stringify(task))
            $('.table').append(tableRow);
        });
    }

    const searchTask = function(){
        $("#search").on('input', function (e){
            let value = removeVietnameseTones(e.target.value);
            let foundData = tempSearch.filter(function (el){
                return removeVietnameseTones(el.TIEU_DE.toLowerCase()).includes(value.toLowerCase());
            });

            $('#table-body').html('');
            foundData.forEach((task) => {
                let tableRow = $('<tr> <td>'+ task.TIEU_DE +'</td> <td>NV'+ task.MA_NGUOI_NHAN +' - '+ task.HO_TEN +'</td> <td><span class="'+ check(task.STATUS) +'">'+ task.STATUS +'</span></td> <td>'+ convert(task.DEADLINE) +'</td> <td><a href="'+ link(task.STATUS, task.TASK_ID) +'" class="text-primary" style="text-decoration: none">Chi tiết</a> </td> </tr>');
                tableRow.attr('task-info', JSON.stringify(task))
                $('.table').append(tableRow);
            });
        });
    }

    function loadProduct(){
        $.post("../api/get_task_employee.php",{id : user_id}, function(data, status) {
            taskList = data.data;
            tempSearch = data.data;
            $('.table-body').html('');
            data.data.forEach((task) => {
                let tableRow = $('<tr> <td>'+ task.TIEU_DE +'</td> <td>NV'+ task.MA_NGUOI_NHAN +' - '+ task.HO_TEN +'</td> <td><span class="'+ check(task.STATUS) +'">'+ task.STATUS +'</span></td> <td>'+ convert(task.DEADLINE) +'</td> <td><a href="'+ link(task.STATUS, task.TASK_ID) +'" class="text-primary" style="text-decoration: none">Chi tiết</a> </td> </tr>');
                tableRow.attr('task-info', JSON.stringify(task))
                $('.table').append(tableRow);
            })
        },"json");
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
            var date = time;
            var readable_date = new Date(date).toLocaleDateString();
            return readable_date;
        }
    }
</script>

</html>
