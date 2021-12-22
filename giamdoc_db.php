<?php
    require_once('db.php');

    function getAllEmployees(){
        $conn = getConnection();

        $sql = "SELECT MA_NV, HO_TEN, TEN_PB, CHUC_VU
                FROM user, user_info, phong_ban
                WHERE user.MA_USER = user_info.MA_NV AND phong_ban.MA_PHONG_BAN = user_info.MA_PHONG_BAN 
                ORDER BY MA_NV ASC";

        $stm = $conn->prepare($sql);
        if (!$stm->execute()) {
            return 0;
        }
        $result = $stm->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
?>