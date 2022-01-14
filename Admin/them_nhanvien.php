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

    <title>Thêm nhân viên</title>
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
                    <a class="nav-link" href="index.php">Nhân viên<span class="sr-only">(current)</span></a>
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
        <div class="col-md-6 mb-4 col-12 align-items-center justify-content-end">
            <h3 class="font-weight-bold text-left">Thêm Nhân Viên</h3>
        </div>
        <div class="col-md-6 col-12 mb-4 d-flex justify-content-end">
            <a href="index.php" class="btn btn-light d-flex align-items-center justify-content-center">Trở về danh sách</a>
        </div>
    </div>
    <div class="row">
        <div class="container col-12" id="alert-container"></div>

        <div class="col-12">
            <form method="post" enctype="multipart/form-data" onsubmit="return false"> 
                <!-- form is here -->
                <div class="form-group">
                    <label for="exampleFormControlFile1">Ảnh đại diện</label>
                    <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1" accept=".gif,.jpg,.jpeg,.png">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Họ tên</label>
                        <input name="hoTen" type="text" class="form-control" id="name" placeholder="Họ và tên">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone number</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Địa chỉ</label>
                    <input name="address" type="text" class="form-control" id="inputAddress" placeholder="Đường, phố, tỉnh">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 col-6">
                        <label for="birthdate">Ngày sinh</label>
                        <input name="ngaySinh" type="date" class="form-control" id="birthdate">
                    </div>
                    <div class="form-group col-md-2 col-6">
                        <label for="gender">Giới tính</label>
                        <select name="gioiTinh" class="form-control" id="gender">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="xyz@gmail.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="username">Username</label>
                        <input name="username" type="text" class="form-control" id="username">
                    </div>
                    <div class="form-group col-6">
                        <label for="Department">Phòng ban</label>
                        <select name="phongBan" id="Department" class="form-control">
                            <!-- Add option phong ban vào đây -->
                        </select>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success" id="saveBtn">Lưu thông tin</button>
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

    const loadOption = function () {
        $.get('../API/get-all-department-name.php').done(function (respone) {
            const {data} = respone;
            data.forEach((info) => {
                    $('#Department').append(`<option>${info.TEN_PB}</option>`)
                });
        });
    }

    const addEmployee = function () {
        $("#saveBtn").click(function(event) {
            let isFileExisted = $('#exampleFormControlFile1').get(0).files.length
            let hoTen = $("#name").val();
            let phone = $("#phone").val();
            let address = $("#inputAddress").val();
            let ngaySinh = $("#birthdate").val();
            let email = $("#email").val();
            let username = $("#username").val();

            if(isFileExisted === 0 || hoTen === '' || phone === '' || address === '' || ngaySinh === '' ||
                email === '' || username === '')
            {
                alertDanger("Dữ liệu không được để trống");
            }
            else{
                let filename = $('#exampleFormControlFile1').val().replace(/C:\\fakepath\\/i, '')
                
                if(!isPictureExtension(filename)){
                    alertDanger("Định dạng file không hợp lệ");
                    $('#exampleFormControlFile1').focus();
                }
                else{
                    let isSuccess = 0;
                    let data = new FormData();
                    data.append("image", $('#exampleFormControlFile1').get(0).files[0]);
                    data.append("hoTen", hoTen);
                    data.append("phone", phone);
                    data.append("address", address);
                    data.append("ngaySinh", ngaySinh);
                    data.append("email", email);
                    data.append("username", username)
                    data.append("phongBan", $("#Department").val())
                    data.append("gioiTinh", $("#gender").val())

                    let xhr = new XMLHttpRequest();

                    xhr.open("POST", "../API/add-employee.php", true);
                    xhr.send(data);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == XMLHttpRequest.DONE) {
                            const respone = JSON.parse(xhr.response);

                            if(respone.code == 0){
                                alertSuccess("Thêm nhân viên thành công");
                                $('#exampleFormControlFile1').val("")
                                $("#name").val("");
                                $("#phone").val("");
                                $("#inputAddress").val("");
                                $("#birthdate").val("");
                                $("#email").val("");
                                $("#username").val("");
                            }
                            else alertDanger(respone.message);
                        }
                    }
                }
            }
        });
    }

    const isPictureExtension = function(extension){
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
        if ($.inArray(extension.split('.').pop().toLowerCase(), fileExtension) == -1) {
            return false;
        }
        else return true;
    }

    $(document).ready(function () {
        loadOption();
        addEmployee();
    });
</script>

</html>