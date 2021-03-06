<?php
    require_once('./template.php');
    require_once('../giamdoc_db.php');
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }


    if (isset($_POST['hoTen']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['ngaySinh']) &&
        isset($_POST['gioiTinh']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['phongBan'])) {
        $hoTen = $_POST['hoTen'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $ngaySinh = $_POST['ngaySinh'];
        $gioiTinh = $_POST['gioiTinh'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $phongBan = $_POST['phongBan'];

        if (empty($hoTen) || empty($phone) || empty($address) || empty($ngaySinh) ||
            empty($gioiTinh) || empty($email) || empty($username) || empty($phongBan)) {
            http_response_code(400);
            error_response(1, 'Invalid input');
        }

        if(is_username_existed($username)){
            error_response(1, 'User name đã tồn tại');
        }

        if (!is_dir('../image')) {
            mkdir('../image');
        }

        if(isset($_FILES['image'])){
            $image =  $_FILES['image'];

            $extList = array('jpeg', 'jpg', 'png', 'gif');
            $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

            if(in_array($ext, $extList)){
                $imagePath = '../image/' . randomString(8) . '/' . $image['name'];
                mkdir(dirname($imagePath));
        
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                    add_account($username);
        
                    if ($gioiTinh == 'Male') {
                        $gioiTinh = 1;
                    } else $gioiTinh = 0;
        
                    $id = add_user($hoTen, $imagePath, $address, $phone, $ngaySinh, $gioiTinh, $email);
        
                    $data = getMaPhongBanByName($phongBan);
                    add_user_info($id, $username, $data[0]['MA_PHONG_BAN']);
        
                    success_response(1, "success");
                } else {
                    http_response_code(400);
                    error_response(1, 'Something went wrong with file');
                }
            }
            else error_response(1, 'Wrong extension');
        }
        else error_response(1, 'Invalid file input');
    }
    else{
        http_response_code(400);
        error_response(1, 'Invalid input');
    }

    function randomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }

        return $str;
    }

?>