-- Lệnh thêm dữ liệu vào bảng student
INSERT INTO `student` (`username`, `PASSWORD`, `email`) VALUES
('student1', 'password1', 'student1@example.com'),
('student2', 'password2', 'student2@example.com'),
('student3', 'password3', 'student3@example.com');


-- Lệnh thêm dữ liệu vào bảng teacher
INSERT INTO `teacher` (`username`, `email`, `PASSWORD`) VALUES
('teacher1', 'teacher1@example.com', 'password1'),
('teacher2', 'teacher2@example.com', 'password2');


-- Lệnh thêm dữ liệu vào bảng course
INSERT INTO `course` (`description`, `teacher_id`, `start_date`, `end_date`) VALUES
('Math 101', 1, '2024-01-10', '2024-06-10'),
('History 202', 2, '2024-02-15', '2024-07-15');


-- Lệnh thêm dữ liệu vào bảng performance
INSERT INTO `performance` (`student_id`, `course_id`, `grade`) VALUES
(1, 1, 90.5),
(1, 2, 85.3),
(2, 1, 78.2),
(3, 2, 88.9);



-- Lệnh thêm dữ liệu vào bảng attendance
INSERT INTO `attendance` (`student_id`, `course_id`, `attendance_date`, `STATUS`) VALUES
(1, 1, '2024-12-20', 'Present'),
(2, 1, '2024-12-20', 'Absent'),
(3, 2, '2024-12-20', 'Present');
