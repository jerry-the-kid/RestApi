<?php
    require_once('./template.php');
    require_once('../giamdoc_db.php');
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        if(empty($id)){
            http_response_code(400);
            error_response(1, 'Invalid input');
        }

        if(isTeamLeader($id)){
            error_response(1, "Không thể xóa trưởng phòng");
        }

        $user_info = getUserInfoAndAvatarPathById($id)[0];

        if(any_inprogress_task($user_info["MA_NV"])){
            error_response(2, "Nhân viên còn task đang làm không thể xóa");
        }

        delete_chi_tiet_don_nghi($user_info["MA_NV"]);
        delete_task_info($user_info["MA_NV"]);
        delete_user_info($user_info["MA_NV"]);
        delete_user($user_info["MA_NV"]);
        delete_account($user_info["USER_NAME"]);

        rrmdir(dirname($user_info["AVATAR_PATH"]));

        success_response(true, "Xóa thành công");
    }
    else error_response(1, "Xóa không thành công");


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
