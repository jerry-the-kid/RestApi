<?php session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['active'] === 1) {
        header('Location: http://localhost/final/');
    }
} else {
    header('Location: http://localhost/final/');
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

    <title>Hello, world!</title>
</head>
<body style="min-height: 100vh" class="d-flex align-items-center">

<div class="container">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-6 p-4 bg-light rounded" style="padding: 40px 0;">
            <form id="newpwd-form">
                <div style="margin-bottom: 100px; ">
                    <h1 class="font-weight-light">New password</h1>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="pwd_new" placeholder="Created new password"
                           aria-label="Pwd new">
                </div>
                <div class="form-group" style="margin-bottom: 30px">
                    <input type="password" class="form-control" id="pwd_confirm" placeholder="Confirm your password"
                           aria-label="Pwd new confirm">
                </div>
                <div class="alert-container mt-4">
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-outline-primary" style="width: 100%;">Change</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 p-4 bg-light rounded"
             style="background-image: url(../image/us2GQKA.jpg); background-size: cover; height: 400px">
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
        const pwdNew = $('#pwd_new');
        const pwdConfirm = $('#pwd_confirm');

        $('#newpwd-form').on('submit', function (e) {
            e.preventDefault();
            if (!pwdNew.val().trim()) {
                alertForm(pwdNew, 'Password new is required. Please fill in.');
            } else if (!pwdConfirm.val().trim()) {
                alertForm(pwdConfirm, 'Password repeat is required. Please fill in.');
            } else if (pwdNew.val().trim() !== pwdConfirm.val().trim()) {
                alertForm(pwdNew, "Passwords don't match. Please fill in again.");
            } else {
                $.post('../renew_pwd.php', {new_pass: pwdNew.val().trim()}).done(function (res) {
                    const data = JSON.parse(res);
                    if (data.code === 0) {
                        window.location = data.message;
                    } else {
                        alertForm(null, data.message);
                    }
                });
            }
        });

        [pwdConfirm, pwdNew].forEach(el => {
            el.on('input', function () {
                $('.alert-container').html('');
            });
        });
    });
</script>
</body>
</html>