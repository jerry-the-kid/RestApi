<?php
session_start();
require_once('db.php');
$new_pass = isset($_POST['new_pass']) ? $_POST['new_pass'] : null;
if (!$new_pass) die(json_encode(['code' => 1, 'message' => 'New Password is empty']));
$new_pass = password_hash($new_pass, PASSWORD_BCRYPT);
$username = $_SESSION['user_name'];

$conn = getConnection();
$sql = "UPDATE account
SET ACTIVE = 1, PASSWORD = ?
WHERE USER_NAME = ?";
$stm = $conn->prepare($sql);
$stm->bind_param('ss', $new_pass, $username);
if (!$stm->execute()) {
    die(json_encode(['code' => 2, 'message' => 'Something have occurred. Please try again.']));
}
$_SESSION['active'] = 1;
die(json_encode(['code' => 0, 'message' => '../index.php']));

