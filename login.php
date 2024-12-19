<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $table = '';
    if ($user_type == "Administrator") {
        $table = 'administrator';
    } elseif ($user_type == "Student") {
        $table = 'student';
    } elseif ($user_type == "Teacher") {
        $table = 'teacher';
    }

    $sql = "SELECT * FROM $table WHERE user_name = ? AND PASSWORD = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = 'Tên tài khoản hoặc mật khẩu không đúng!';
        header("Location: login.html");
        exit();
    }

    $stmt->close();
}
?>
