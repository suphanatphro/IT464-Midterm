-- 1. สร้างฐานข้อมูลและใช้ฐานข้อมูลนักศึกษา
CREATE DATABASE IF NOT EXISTS student_shifts;
USE student_shifts;

-- 2. สร้างตาราง students พร้อมเพิ่มฟิลด์โครงงานให้แตกต่าง
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(15) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    project_name VARCHAR(255),
    shift_status VARCHAR(50) DEFAULT 'NA'
);

-- 3. เพิ่มข้อมูลจำลองโดยเน้นข้อมูลนักศึกษา
-- แถวแรก: ข้อมูลของผู้สอบ (นักศึกษาต้องเปลี่ยนเป็นข้อมูลจริงของตนเอง)
INSERT INTO students (student_id, full_name, username, email, project_name, shift_status) VALUES 
('1660703552', 'Suphanat Phromwong', 'suphanat.phro', 'suphanat.phro@bumail.net', 'Web Administration', 'Morning Shift');

-- ข้อมูลจำลองอื่นๆ เพื่อความสวยงาม
INSERT INTO students (student_id, full_name, username, email, project_name, shift_status) VALUES 
('1640700001', 'Somsak Rakdee', 'somsak.r', 'somsak.r@example.com', 'Database Design', 'Afternoon Shift'),
('1640700002', 'Wichai Meesuk', 'wichai.m', 'wichai.m@example.com', 'Network Security', 'Night Shift'),
('1640700003', 'Wichai Chaipon', 'wichai.c', 'wichai.c@example.com', 'System Security', 'Evening Shift'),
('1640700004', 'Jane Watson', 'jane.w', 'jane.w@example.com', 'Cloud Computing', 'Rejected');