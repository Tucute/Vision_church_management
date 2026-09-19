<?php
$host = 'mysql';       // tên service trong docker-compose, KHÔNG dùng localhost/127.0.0.1
$dbname = 'my_app_db';
$user = 'appuser';
$pass = 'apppassword';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

echo "Kết nối MySQL thành công!";
?>