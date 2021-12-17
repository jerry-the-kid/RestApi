<?php
    require_once('db.php');
    function reset_Password($username){
        $conn = get_connection();
        $password = password_hash($username, PASSWORD_DEFAULT);
        $sql = "UPDATE `account` SET `PASSWORD` = $password, `ACTIVE` = 0 WHERE `USER_NAME` = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param('s', $username);
        $stm->execute();
        if ($stm->affected_rows == 1){
            return $stm->insert_id;
        }
        return 0;
    }
?>