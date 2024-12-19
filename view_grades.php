<?php
// Import file kết nối cơ sở dữ liệu
include('db_connect.php');
session_start();

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Lấy điểm của sinh viên (chỉ dành cho sinh viên)
if ($role === "Student") {
    $query = "SELECT Course.Description, Performance.Grade 
              FROM Performance 
              INNER JOIN Course ON Performance.Course_ID = Course.Course_ID
              INNER JOIN Student ON Performance.Student_ID = Student.Student_ID
              WHERE Student.User_name = ?";
} else {
    die("Chỉ sinh viên mới có thể xem điểm.");
}

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Your Grades</h2>
    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Hiển thị điểm
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Description'] . "</td>";
                echo "<td>" . $row['Grade'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
