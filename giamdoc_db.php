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

    $sql = "SELECT phong_ban.TEN_PB 
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
    $stm->bind_param('sssssis', $hoTen, $avatar, $address, $phone, $ngaySinh, $gioiTinh, $email);
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

function getMaPhongBangByName($tenPhongBan)
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

?>