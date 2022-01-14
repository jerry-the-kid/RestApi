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

    <title>Thông tin cá nhân</title>
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
    <div class="row mb-2 flex-column-reverse flex-md-row">
        <div class="col-md-6 col-12 mb-4 align-items-center justify-content-end">
            <h2 class="font-weight-bold text-left">Thông tin nhân viên</h2>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end">
            <a href="index.php" class="btn btn-light d-flex align-items-center justify-content-center">Trở về danh sách</a>
        </div>
    </div>
    <div class="row rounded p-4">
        <div class="col-4 bg-light py-4 rounded d-flex align-items-center justify-content-center flex-column">
            <h5 class="font-weight-bold mb-4" id="name">Tên</h5>
            <img class="img-responsive mb-2" id="avatar" src="" alt="Không nhận được avatar xin hãy cập nhật avatar" height="150px" width="150px" style="display: block; border-radius: 50%;">
            <a href="#" class="link-primary" data-toggle="modal" data-target="#updateAvatarModal">Cập nhật ảnh đại diện</a>
        </div>

        <div class="col-8 border-left bg-light py-4 rounded">
            <table class="table table-bordered">
                <tbody>

                <tr>
                    <td class="font-weight-bold">Username</td>
                    <td colspan="4" id="username"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Mã NV</td>
                    <td id="manv"></td>
                    <td class="font-weight-bold">Mã PB</td>
                    <td id="mapb"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Ngày sinh</td>
                    <td id="ngaySinh"></td>
                    <td class="font-weight-bold">Giới tính</td>
                    <td id="gender"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Email</td>
                    <td id="email"></td>
                    <td class="font-weight-bold" >SĐT</td>
                    <td id="phone"></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Địa chỉ</td>
                    <td colspan="4" id="address"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Cập nhật avatar Modal-->
<div class="modal fade px-0" id="updateAvatarModal" tabindex="-1" role="dialog" aria-labelledby="updateAvatarModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAvatarModalLabel">Cập nhật ảnh đại diện</h5>
                <button id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="container col-12" id="alert-container"></div>

                <p>Ảnh đại diện</p>
                <div class="d-flex justify-content-center">
                    <img src="" width="240px" height="240px" class="img-responsive mb-2" alt="" id="avatarUpdate">
                </div>
                
                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1" style="display:none">
                <button type="button" class="btn btn-secondary btn-sm mr-2 text-right" id="chooseFile">Choose File</button>
                <span class="text-right" id="fileName">Không có avatar</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="modalExit">Thoát</button>
                <button type="button" class="btn btn-danger" id="updateBtn">Cập nhật</button>
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
    
    const fillData = function(){
        let id = user_id;

        $.get('../API/get-employee-detail.php', {id: id}).done(function (respone) {
            const employee = respone['data'][0];

            $('#avatar').attr('src', employee.AVATAR_PATH);
            $("#name").text(employee.HO_TEN);
            $("#username").text((employee.USER_NAME));
            $("#manv").text("NV" + id)
            $("#mapb").text("PB" + employee.MA_PHONG_BAN);
            $("#ngaySinh").text(dateFormat(employee.ngay_sinh));

            if(employee.gioi_tinh == 0){
                $("#gender").text("Nữ");
            }
            else $("#gender").text("Nam");

            $("#email").text(employee.email);
            $("#phone").text(employee.PHONE);
            $("#address").text(employee.ADDRESS);
        });
    }

    function dateFormat(date){
        let dateObj = new Date(date);
        let month = dateObj.getUTCMonth() + 1;
        let day = dateObj.getUTCDate();
        let year = dateObj.getUTCFullYear();

        newdate = day + "/" + month + "/" + year;
        return newdate;
    }

    const selectFileInModel = function(){
        $("#chooseFile").click(function(event) {
            $('#exampleFormControlFile1').trigger('click');
            $("#exampleFormControlFile1").on("change", function() {
                let filename = $('input[type=file]').val().split('\\').pop();
                $("#fileName").text(filename);

                const [file] = exampleFormControlFile1.files
                if (file) {
                    $("#avatarUpdate").attr("src", URL.createObjectURL(file));
                }
            });
        }); 
    }

    const clearModelWhenExit = function(){
        $("#modalExit, #close, body").click(function(event){
            $('#exampleFormControlFile1').val("");
            $("#avatarUpdate").attr("src", "");
        });
    }

    const updateAvatar = function(){
        $("#updateBtn").click(function(event){
            let isFileExisted = $('#exampleFormControlFile1').get(0).files.length;

            if(!isFileExisted){
                alertDanger("Dữ liệu không được để trống");
            }
            else{
                let data = new FormData();

                data.append("id", user_id);
                data.append("image", $('#exampleFormControlFile1').get(0).files[0]);

                let xhr = new XMLHttpRequest();

                xhr.open("POST", "../API/update-employee-avatar.php", true);
                xhr.send(data);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        const respone = JSON.parse(xhr.response);

                        if(respone.code == 0){
                            $('#updateAvatarModal').modal('hide');
                            fillData();
                        }
                        else alertDanger("Cập nhật ảnh đại diện không thành công");
                    }
                }
            }
        });
    }

    $(document).ready(function () {
        fillData();
        selectFileInModel();
        clearModelWhenExit();
        updateAvatar();
    });
</script>

</html>
