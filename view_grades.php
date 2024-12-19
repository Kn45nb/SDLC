<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['username'];

$sql = "SELECT course.description, performance.grade FROM course 
        INNER JOIN performance ON course.course_id = performance.course_id 
        WHERE performance.student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Grades</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="grades-container">
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
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No grades to display.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
