<?php
    require_once ('db.php');

    function getEmployeeSelfDonNghi($id){
        $conn = getConnection();

        $sql = "SELECT tlead.tleadID, tlead.tleadName, don_nghi.*
                FROM (	SELECT user.MA_USER AS tleadID, user.HO_TEN AS tleadName, user_info.MA_PHONG_BAN
                        FROM user, user_info
                        WHERE EXISTS(SELECT truong_phong.MA_NV FROM truong_phong WHERE user.MA_USER = truong_phong.MA_NV)
                        AND user.MA_USER = user_info.MA_NV
                    ) tlead, user, user_info, don_nghi, chi_tiet_don_nghi
                WHERE tlead.MA_PHONG_BAN = user_info.MA_PHONG_BAN AND user.MA_USER = user_info.MA_NV AND user.MA_USER = $id 
                AND don_nghi.MA_NGHI = chi_tiet_don_nghi.MA_NGHI AND chi_tiet_don_nghi.MA_NV = $id
                AND user.MA_USER = chi_tiet_don_nghi.MA_NV
                ORDER BY don_nghi.NGAY_LAM_DON DESC";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getEmployeeSelfUsedDayOff($id){
        $conn = getConnection();

        $sql = "SELECT SUM(don_nghi.SO_NGAY) AS SO_NGAY
                FROM don_nghi, chi_tiet_don_nghi
                WHERE YEAR(don_nghi.NGAY_LAM_DON) = YEAR(CURDATE()) AND chi_tiet_don_nghi.MA_NGHI = don_nghi.MA_NGHI
                AND chi_tiet_don_nghi.MA_NV = $id";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
?>