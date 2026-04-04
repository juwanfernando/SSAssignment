<?php session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
function connectServer($servername, $username, $password, $port) {
    $connect = new mysqli($servername, $username, $password, "", $port);
    if ($connect->connect_error) {
        die("Connection failed.");
    } else {
        return $connect;
    }
}
?>
