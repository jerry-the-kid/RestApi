<?php
    require_once('db.php');

    function getAllEmployees()
    {
        $conn = getConnection();

        $sql = "SELECT MA_NV, HO_TEN, TEN_PB,   CASE
                    WHEN EXISTS (SELECT MA_NV FROM truong_phong WHERE user_info.MA_NV = truong_phong.MA_NV)
                        THEN 'Tổ Trưởng'
                    ELSE 'Nhân Viên'
                    END AS CHUC_VU
                    FROM user, user_info, phong_ban
                    WHERE user.MA_USER = user_info.MA_NV AND phong_ban.MA_PHONG_BAN = user_info.MA_PHONG_BAN  AND phong_ban.MA_PHONG_BAN AND user_info.CHUC_VU != 'admin'  
                    ORDER BY MA_NV ASC";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getAllDepartmentName()
    {
        $conn = getConnection();

        $sql = "SELECT phong_ban.MA_PHONG_BAN, phong_ban.TEN_PB 
                    FROM phong_ban";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getAllAccount()
    {
        $conn = getConnection();

        $sql = "SELECT MA_NV, HO_TEN, USER_NAME 
                    FROM user_info, user
                    WHERE user_info.MA_NV = user.MA_USER AND user_info.CHUC_VU != 'admin'
                    ORDER BY MA_NV ASC";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function add_account($username)
    {
        $sql = 'INSERT INTO `account` (`USER_NAME`, `PASSWORD`, `ACTIVE`) VALUES (?, ?, ?)';
        $conn = getConnection();
        $stm = $conn->prepare($sql);
        $zero = 0;
        $stm->bind_param('ssi', $username, password_hash($username, PASSWORD_DEFAULT), $zero);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return $stm->insert_id;
        }
        return 0;
    }

    function add_user($hoTen, $avatar, $address, $phone, $ngaySinh, $gioiTinh, $email)
    {
        $conn = getConnection();
        $sql = 'INSERT INTO `user` (`HO_TEN`, `AVATAR_PATH`, `ADDRESS`, `PHONE`, `ngay_sinh`, `gioi_tinh`, `email`) 
                    VALUES(?, ?, ?, ?, ?, ?, ?)';
        $stm = $conn->prepare($sql);
        $stm->bind_param('sssssss', $hoTen, $avatar, $address, $phone, $ngaySinh, $gioiTinh, $email);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return $stm->insert_id;
        }
        return 0;
    }

    function add_user_info($MA_NV, $username, $maphongban)
    {
        $conn = getConnection();
        $sql = "INSERT INTO `user_info` (`MA_NV` ,`USER_NAME`, `MA_PHONG_BAN`, `CHUC_VU`, `MA_USER`) 
                    VALUES($MA_NV, '$username', $maphongban, 'employee', $MA_NV)";
        $stm = $conn->prepare($sql);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return $stm->insert_id;
        }
        return 0;
    }

    function getMaPhongBanByName($tenPhongBan)
    {
        $conn = getConnection();

        $sql = "SELECT phong_ban.MA_PHONG_BAN 
                FROM phong_ban
                WHERE phong_ban.TEN_PB = '$tenPhongBan'";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getUserInfoAndAvatarPathById($id){
        $conn = getConnection();

        $sql = "SELECT MA_NV, USER_NAME, AVATAR_PATH 
                FROM user, user_info
                WHERE user_info.MA_NV = $id AND user_info.MA_NV = user.MA_USER";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function delete_user_info($id){
        $conn = getConnection();
        $sql = "DELETE FROM user_info WHERE user_info.MA_NV = $id";
        $stm = $conn->prepare($sql);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return 1;
        }
        return 0;
    }

    function delete_user($id){
        $conn = getConnection();
        $sql = "DELETE FROM user WHERE user.MA_USER = $id";
        $stm = $conn->prepare($sql);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return 1;
        }
        return 0;
    }

    function delete_account($username){
        $conn = getConnection();
        $sql = "DELETE FROM account WHERE account.USER_NAME = '$username'";
        $stm = $conn->prepare($sql);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return 1;
        }
        return 0;
    }

    function isTeamLeader($id){
        $conn = getConnection();
        $sql = "SELECT * FROM truong_phong
                WHERE truong_phong.MA_NV = $id";
        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();

        if($result->num_rows > 0){
            return TRUE;
        }
        else return FALSE;
    }

    function getEmployeeDetail($id){
        $conn = getConnection();

        $sql = "SELECT user.HO_TEN, user.AVATAR_PATH, user.ADDRESS, user.PHONE, user.ngay_sinh, user.gioi_tinh, user.email, 
                account.USER_NAME, user_info.MA_PHONG_BAN 
                FROM user, account, user_info
                WHERE user.MA_USER = $id AND user.MA_USER = user_info.MA_NV AND account.USER_NAME = user_info.USER_NAME";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function is_activated($id){
        $conn = getConnection();
        $sql = "SELECT account.ACTIVE 
                FROM account, user_info 
                WHERE account.USER_NAME = user_info.USER_NAME AND user_info.MA_NV = $id";
        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        $row = $result->fetch_assoc();

        if($row['ACTIVE'] == 1){
            return TRUE;
        }
        else return FALSE;
    }

    function update_account_if_not_activated($oldUsername, $newUsername){
        $conn = getConnection();
        $sql = "UPDATE account
                SET USER_NAME = '$newUsername', PASSWORD = '$newUsername'
                WHERE USER_NAME = '$oldUsername'";
        $stm = $conn->prepare($sql);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return 1;
        }
        return 0;
    }

    function update_account_if_activated($oldUsername, $newUsername){
        $conn = getConnection();
        $sql = "UPDATE account
                SET USER_NAME = '$newUsername'
                WHERE USER_NAME = '$oldUsername'";
        $stm = $conn->prepare($sql);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return 1;
        }
        return 0;
    }

    function update_user($id, $hoTen, $avatar, $address, $phone, $ngaySinh, $gioiTinh, $email){
        $conn = getConnection();
        $sql = "UPDATE user
                SET HO_TEN = '$hoTen', AVATAR_PATH = '$avatar', ADDRESS = '$address', PHONE = '$phone'
                ngay_sinh = '$ngaySinh', gioi_tinh = $gioiTinh, email = '$email'
                WHERE MA_USER = $id";
        $stm = $conn->prepare($sql);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            return 1;
        }
        return 0;
    }
?>