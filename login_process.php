<?php
// Import file kết nối cơ sở dữ liệu
include('db_connect.php');
session_start();

// Lấy dữ liệu từ biểu mẫu đăng nhập
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Kiểm tra quyền đăng nhập
if ($role === "Administrator") {
    $query = "SELECT * FROM Administrator WHERE User_name = ? AND Password = ?";
} elseif ($role === "Teacher") {
    $query = "SELECT * FROM Teacher WHERE User_name = ? AND Password = ?";
} elseif ($role === "Student") {
    $query = "SELECT * FROM Student WHERE User_name = ? AND Password = ?";
} else {
    die("Vai trò không hợp lệ.");
}

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra kết quả
if ($result->num_rows > 0) {
    // Đăng nhập thành công
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;

    // Chuyển hướng dựa trên vai trò
    if ($role === "Administrator") {
        header("Location: admin_dashboard.php");
    } elseif ($role === "Teacher") {
        header("Location: teacher_dashboard.php");
    } elseif ($role === "Student") {
        header("Location: student_dashboard.php");
    }
} else {
    // Đăng nhập thất bại
    echo "<script>alert('Sai thông tin đăng nhập!'); window.location.href='login.html';</script>";
}

$stmt->close();
$conn->close();
?>
