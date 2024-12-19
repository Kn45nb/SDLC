<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user']['user_name'];

// Fetch grades from database
$sql = "SELECT course.description, performance.grade FROM course 
        INNER JOIN performance ON course.Course_ID = performance.Course_ID 
        WHERE performance.Student_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='2'>No grades to display.</td></tr>";
}

$stmt->close();
?>
