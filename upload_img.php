<?php
// Hàm random
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

/////////////////////////////////// Create folder <- file img ////////////////////////
if (!is_dir('images')) {
    mkdir('images');
}

$image = isset($_FILES['image']) ? $_FILES['image'] : null;
$imagePath = '';
if ($image && $image['tmp_name']) {
    $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
    mkdir(dirname($imagePath));

    move_uploaded_file($image['tmp_name'], $imagePath);
};
/////////////////////////////////// Xóa account, xóa folder ảnh có ảnh ////////////////////////
// Hàm xóa folder không rỗng
function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);

        foreach ($objects as $object) {
            if ($object != '.' && $object != '..') {
                if (filetype($dir . '/' . $object) == 'dir') {
                    rrmdir($dir . '/' . $object);
                } else {
                    unlink($dir . '/' . $object);
                }
            }
        }

        reset($objects);
        rmdir($dir);
    }
}