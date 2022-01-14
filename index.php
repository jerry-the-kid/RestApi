<?php
session_start();
//session_destroy();
require_once ('header.php');
if(isset($_SESSION['user_id'])){
    locationLoginPage($_SESSION['position'], $_SESSION['active']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Đăng nhập</title>
</head>
<body style="min-height: 100vh" class="d-flex align-items-center">

<div class="container">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-6 p-4 bg-light rounded" style="padding: 40px 0;">
            <form id="login_form">
                <div style="margin-bottom: 100px; ">
                    <h1 class="font-weight-light">Login</h1>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="username" placeholder="Username" aria-label="Username">
                </div>
                <div class="form-group" style="margin-bottom: 30px">
                    <input type="password" class="form-control" id="password" placeholder="Password"
                           aria-label="Password">
                </div>
                <div class="alert-container mt-4">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-primary" style="width: 100%;">Login</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 p-4 bg-light rounded"
             style="background-image: url(image/us2GQKA.jpg); background-size: cover; min-height: 400px">
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script>
    const alertForm = function (target, message) {
        $('.alert-container').html('');
        $('.alert-container').append(`<div class="alert alert-danger" role="alert">
                    ${message}
                 </div>`)
        target.focus();
    }

    $(document).ready(function () {
        const username = $('#username');
        const password = $('#password');
        $('#login_form').on('submit', function (e) {
            e.preventDefault();
            if (!username.val().trim()) {
                alertForm(username, 'Username is required. Please fill in.');
            } else if (!password.val().trim()) {
                alertForm(password, 'Password is required. Please fill in.');
            } else {
                $.post('login.php', {username: username.val().trim(), password: password.val().trim()}).done(function (res) {
                    const data = JSON.parse(res);
                    if(data.code === 0){
                        window.location = data.message;
                    } else {
                        alertForm(null, data.message);
                    }
                });

            }
        });

        [username, password].forEach(el => {
            el.on('input', function () {
                $('.alert-container').html('');
            });
        });
    });
</script>
</body>
</html>