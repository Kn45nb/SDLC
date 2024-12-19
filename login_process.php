<?php
// Import file kết nối cơ sở dữ liệu
include('db_connect.php');

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
    die("Role không hợp lệ.");
}

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra kết quả
if ($result->num_rows > 0) {
    // Đăng nhập thành công
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    header("Location: view_grades.php");
} else {
    // Đăng nhập thất bại
    echo "<script>alert('Sai thông tin đăng nhập!'); window.location.href='login.html';</script>";
}
$stmt->close();
$conn->close();
?>
