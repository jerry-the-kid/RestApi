<?php
    require_once ('./template.php');
    require_once ('../giamdoc_db.php');

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        http_response_code(405);
        error_response(1, 'API support POST method only');
    }


    if (isset($_POST['hoTen']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['ngaySinh']) && 
        isset($_POST['gioiTinh']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['phongBan']))
    {
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

        if (!is_dir('../images')) {
            mkdir('../images');
        }

        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        $imagePath = '';
        // if ($image && $image['tmp_name']) {
            $imagePath = '../images/' . randomString(8) . '/' . $image['name'];
            mkdir(dirname($imagePath));

            if(move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)){
                add_account($username);

                if($gioiTinh == 'Male'){
                    $gioiTinh = 1;
                }else $gioiTinh = 0;

                $id = add_user($hoTen, $imagePath, $address, $phone, $ngaySinh, $gioiTinh, $email);

                $data = getMaPhongBangByName($phongBan);
                add_user_info($id, $username, $data[0]['MA_PHONG_BAN']);

                success_response(1,"success");
            }
            else{
                http_response_code(400);
                error_response(1, 'Something went wrong with file row 53');
            }
        // }
        // else{
        //     http_response_code(400);
        //     error_response(1, 'Something went wrong with file row 58');
        // }

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