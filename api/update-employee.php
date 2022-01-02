<?php
    require_once('./template.php');
    require_once('../giamdoc_db.php');
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    if (isset($_POST['hoTen']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['ngaySinh']) &&
        isset($_POST['gioiTinh']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['phongBan']) &&
        isset($_POST['id'])) {

        $id = $_POST['id'];
        $hoTen = $_POST['hoTen'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $ngaySinh = $_POST['ngaySinh'];
        $gioiTinh = $_POST['gioiTinh'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $phongBan = $_POST['phongBan'];

        if (empty($hoTen) || empty($phone) || empty($address) || empty($ngaySinh) ||
            empty($gioiTinh) || empty($email) || empty($username) || empty($phongBan) ||
            empty($id)) {
            http_response_code(400);
            error_response(1, "Input are empty");
        }

        if ($gioiTinh == 'Male') {
            $gioiTinh = 1;
        } else $gioiTinh = 0;

        if (!is_dir('../image')) {
            mkdir('../image');
        }

        if(isset($_FILES['image'])){
            $image = $_FILES['image'];
            $imagePath = '../image/' . randomString(8) . '/' . $image['name'];

            $old_user_info = getUserInfoAndAvatarPathById($id)[0];
            delete_user_info($id);
            rrmdir(dirname($old_user_info["AVATAR_PATH"]));

            mkdir(dirname($imagePath));

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                if(is_activated($id)){
                    update_account_if_activated($old_user_info["USER_NAME"], $username);
                }
                else update_account_if_not_activated($old_user_info["USER_NAME"], $username);

                update_user($id, $hoTen, $imagePath, $address, $phone, $ngaySinh, $gioiTinh, $email);

                $data = getMaPhongBanByName($phongBan);
                add_user_info($id, $username, $data[0]['MA_PHONG_BAN']);

                success_response(1, "success");
            } else {
                http_response_code(400);
                error_response(1, 'Something went wrong with file');
            }
        }
        else{
            $old_user_info = getUserInfoAndAvatarPathById($id)[0];
            delete_user_info($id);

            if(is_activated($id)){
                update_account_if_activated($old_user_info["USER_NAME"], $username);
            }
            else update_account_if_not_activated($old_user_info["USER_NAME"], $username);

            // update_user($id, $hoTen, $old_user_info["AVATAR_PATH"], $address, $phone, $ngaySinh, $gioiTinh, $email);

            $data = getMaPhongBanByName($phongBan);
            add_user_info($id, $username, $data[0]['MA_PHONG_BAN']);

            success_response(1, "success");
        }
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

    // Hàm xóa folder không rỗng
    function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);

            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . '/' . $object) == 'dir') {
                        rrmdir($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }

            reset($objects);
            rmdir($dir);
        }
    }

?>