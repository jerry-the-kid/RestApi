<?php
    require_once('./template.php');
    require_once('../giamdoc_db.php');
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    if (isset($_POST['id'])) {

        $id = $_POST['id'];

        if (empty($id)) {
            http_response_code(400);
            error_response(1, "Input are empty");
        }

        if (!is_dir('../image')) {
            mkdir('../image');
        }

        $old_user_info = getUserInfoAndAvatarPathById($id)[0];

        if(isset($_FILES['image'])){
            $image = $_FILES['image'];
            $imagePath = '../image/' . randomString(8) . '/' . $image['name'];

            rrmdir(dirname($old_user_info["AVATAR_PATH"]));
            mkdir(dirname($imagePath));

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                update_employee_avatar($id, $imagePath);

                success_response(1, "success");
            } else {
                http_response_code(400);
                error_response(1, 'Something went wrong with file');
            }
        }
        else{
            error_response(1, 'No file found');
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