<?php
    require_once('db.php');

    function getAllEmployees(){
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
?>