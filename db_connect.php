<?php
$host = 'localhost'; // Máy chủ
$user = 'root';      // Tên người dùng MySQL
$pass = '';          // Mật khẩu MySQL
$db = 'nei';         // Tên cơ sở dữ liệu đã thay đổi

// Kết nối
$conn = new mysqli($host, $user, $pass, $db);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
