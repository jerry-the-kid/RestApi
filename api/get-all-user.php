<?php
    session_start();
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

    $sql = "SELECT * FROM user";
    if($data = $conn->query($sql)){
        $userList = array();

        while($row = $data->fetch_assoc()){
            $userList[] = $row;
        }

        success_response($userList, "Lấy dữ liệu thành công");
    }
    else error_response(1, "Không thể lấy dữ liệu");
?>