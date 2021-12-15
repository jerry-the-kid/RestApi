<!-- Sử dụng phương thức post thông qua biến 'ma_nv'
Nếu tìm thấy thì trả về 1 (True)
Nếu không tìm thấy trả về 0 (False) -->

<?php
    require_once('../db.php');

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    function error_response($code, $message)
    {
        $res = array();
        $res['code'] = $code;
        $res['message'] = $message;
        die(json_encode($res));
    }

    function success_response($data, $message)
    {
        $res = array();
        $res['code'] = 0;
        $res['message'] = $message;
        $res['data'] = $data;
        die(json_encode($res));
    }

    $conn = getConnection();

    if (!isset($_POST['ma_nv'])) {
        error_response(2, "Không nhận được mã nhân viên");
    }

    $ma_nv = $_POST['ma_nv'];
    $sql = "SELECT * FROM truong_phong WHERE MA_NV = '$ma_nv'";

    if($data = $conn->query($sql)){
        if($data -> num_rows === 0){
            success_response(0, "Lấy dữ liệu thành công");
        }
        else {
            success_response(1, "Lấy dữ liệu thành công");
        }
    }
    else error_response(1, "Không thể lấy dữ liệu");
    
?>