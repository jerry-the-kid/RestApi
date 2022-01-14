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

    <title>Đổi mật khẩu</title>
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

<div class="container">
    <div class="container col-12" id="alert-container"></div>

    <div class="row flex-column-reverse flex-md-row justify-content-center align-items-center">
        <div class="col-md-6 p-4 bg-light rounded" style="padding: 40px 0;">
            <form onsubmit="return false" id="myform">
                <div class="mb-4">
                    <h1 class="font-weight-light">Đổi mật khẩu</h1>
                </div>

                <label>Mật khẩu hiện tại</label>
                <div class="form-group pass_show"> 
                    <input type="password" class="form-control" placeholder="Mật khẩu hiện tại" id="currentPwd"> 
                </div> 
                <label>Mật khẩu mới</label>
                <div class="form-group pass_show"> 
                    <input type="password" class="form-control" placeholder="Mật khẩu mới" id="newPwd"> 
                </div> 
                <label>Xác nhận mật khẩu mới</label>
                <div class="form-group pass_show"> 
                    <input type="password" class="form-control" placeholder="Xác nhận mật khẩu mới" id="confirmPwd"> 
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-outline-primary w-100" id="save">Save</button>
                </div> 
            </form>
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
    const user_id = <?php echo $_SESSION['user_id'] ?>;

    $(document).ready(function () {
        updatePwd();
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
        $('.alert-danger').fadeOut(3500);
    }

    const clearInput = function(){
        $('#myform')[0].reset();
    }

    const updatePwd = function(){
        $("#save").click(function(event){
            if(!$("#currentPwd").val()){
                alertDanger("Xin nhập Current Password");
                $("#currentPwd").focus();
            }
            else if(!$("#newPwd").val()){
                alertDanger("Xin nhập New Password");
                $("#newPwd").focus();
            }else if($("#newPwd").val().length < 6){
                alertDanger("Mật khẩu phải có ít nhất 6 ký tự");
                $("#newPwd").focus();
            }
            else if(!$("#confirmPwd").val()){
                alertDanger("Xin nhập Confirm Password");
                $("#confirmPwd").focus();
            }
            else if($("#currentPwd").val() == $("#newPwd").val()){
                alertDanger("Mật khẩu mới không đươc chùng khớp với mật khẩu cũ");
                $("#newPwd").focus();
            }
            else if($("#confirmPwd").val() != $("#newPwd").val()){
                alertDanger("Mật khẩu xác nhận không chùng khớp với ban đầu");
            }
            else{
                $.post('../API/change-pwd.php', {id: user_id, pwd: $("#newPwd").val().trim(), oldPwdCheck: $("#currentPwd").val().trim()}).done(function (respone) {
                    if(respone['code'] == 0){
                        clearInput();
                        alertSuccess(respone['message']);
                    }
                    else{
                        alertDanger(respone['message']);
                    }
                });
            }
        });
    }
</script>

</html>
