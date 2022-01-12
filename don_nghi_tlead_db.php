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