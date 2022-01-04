<?php
if(!empty($_GET['file'])){
    $filepath = isset($_GET['file']) ? $_GET['file'] : null;
    if(!empty($filepath) && file_exists($filepath)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Content-Length: ' . filesize($filepath));
        header('Pragma: public');
        readfile($filepath);
        exit();
    }
} else{
    echo 'This File Does Not Exist';
}
