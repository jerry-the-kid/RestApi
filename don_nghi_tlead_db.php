<?php
require_once ('db.php');

function getDonNghiEmployee($id)
{
    $conn = getConnection();
    $sql = "SELECT dn.*, u.HO_TEN, ui.MA_NV
    FROM chi_tiet_don_nghi ct join don_nghi dn on dn.MA_NGHI = ct.MA_NGHI
    join user_info ui on ui.MA_NV = ct.MA_NV join user u on ui.MA_USER = u.MA_USER
    WHERE ct.MA_NV in (SELECT MA_NV
    FROM user_info JOIN phong_ban pb on pb.MA_PHONG_BAN = user_info.MA_PHONG_BAN
    WHERE pb.MA_PHONG_BAN = (SELECT MA_PHONG_BAN FROM user_info WHERE MA_NV = ?)
    AND MA_NV != ?) ORDER BY TRANG_THAI DESC ";

    $stm = $conn->prepare($sql);
    $stm->bind_param('ii', $id, $id);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getDetailDonNghi($dn){
    $conn = getConnection();
    $sql = "SELECT dn.*, u.HO_TEN, ui.MA_NV
    FROM chi_tiet_don_nghi ct join don_nghi dn on dn.MA_NGHI = ct.MA_NGHI
    join user_info ui on ui.MA_NV = ct.MA_NV join user u on ui.MA_USER = u.MA_USER
    where ct.MA_NGHI = ?";

    $stm = $conn->prepare($sql);
    $stm->bind_param('i', $dn);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateDetailDonNghi($dn, $status){
    $conn = getConnection();
    $sql = "UPDATE don_nghi
    set TRANG_THAI = ?
    WHERE MA_NGHI = ?";

    $stm = $conn->prepare($sql);
    $stm->bind_param('si', $status, $dn);
    if (!$stm->execute()) {
        return 0;
    }
   return 1;
}

function getSoNgayNghiTrongNam($ma_nv){
    $conn = getConnection();
    $sql = "SELECT SO_NGAY
    FROM don_nghi JOIN chi_tiet_don_nghi ctdn on don_nghi.MA_NGHI = ctdn.MA_NGHI
    join user_info ui on ui.MA_NV = ctdn.MA_NV join user u on u.MA_USER = ui.MA_USER
    WHERE ui.MA_NV = ? AND YEAR(NGAY_LAM_DON) = YEAR(NOW()) and TRANG_THAI = 'approved'";

    $stm = $conn->prepare($sql);
    $stm->bind_param('i', $ma_nv);
    if (!$stm->execute()) {
        return 0;
    }
    $result = $stm->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function createDonNghi($title, $date, $description, $filePath){
    $conn = getConnection();
    $sql = "INSERT INTO don_nghi (TIEU_DE, MINH_CHUNG, SO_NGAY, NOI_DUNG)
    VALUE (?, ?, ?, ?)";

    $stm = $conn->prepare($sql);
    $stm->bind_param('ssss', $title, $filePath, $date, $description);
    if (!$stm->execute()) {
        return 0;
    }
    return $stm->insert_id;
}

function createChiTietDN($id, $dn){
    $conn = getConnection();
    $sql = "insert into chi_tiet_don_nghi(ma_nghi, ma_nv) 
    value (?, ?)";

    $stm = $conn->prepare($sql);
    $stm->bind_param('ii', $dn, $id);
    if (!$stm->execute()) {
        return 0;
    }
    return 1;
}