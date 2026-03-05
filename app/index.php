<?php
// 1. กำหนดค่าการเชื่อมต่อฐานข้อมูลโดยดึงชื่อจาก .env [5]
$host = 'db'; // แก้ไขให้ตรงกับค่าทีอยู่ใน Docker Compose หรือ .env
$user = 'root'; // แก้ไขให้ตรงกับค่าที่อยู่ใน Docker Compose หรือ .env
$db   = 'student_shifts'; // แก้ไขให้ตรงกับค่าที่อยู่ใน Docker Compose หรือ .env

// 2. กฎเหล็กด้านความปลอดภัย: อ่านรหัสผ่านจาก Docker Secret แทนการเขียนไว้ในโค้ด [7]
$pass = getenv('MYSQL_ROOT_PASSWORD');

// 3. เริ่มการเชื่อมต่อด้วย mysqli [8]
$conn = new mysqli($host, $user, $pass, $db);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("<h2 style='color:red;'>❌ Connection Failed: " . $conn->connect_error . "</h2>");
}

// Retry connection up to 10 times with 2-second delays
$attempts = 0;
while ($conn->connect_error && $attempts < 10) {
    sleep(2); // รอ 2 วินาที
    $conn = new mysqli($host, $user, $pass, $db);
    $attempts++;
}

if ($conn->connect_error) {
    die("Connection failed after retries: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Shift Scheduler</title>
    <style>
        table { width: 80%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #7e7e7e; text-align: center; }
        th { background-color: #fff5e4; }
        .status-done { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>📋 ระบบจัดการตารางงานนักศึกษา (Student Shift Scheduler)</h1>
    <p>Connected to <strong>MariaDB</strong> successfully!</p>

    <table>
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Project Title</th>
            <th>Shift Status</th>
        </tr>
        <?php
        // 4. ดึงข้อมูลจากตาราง students มาแสดงผล [2]
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["student_id"] . "</td>
                        <td>" . $row["full_name"] . "</td>
                        <td>" . $row["project_name"] . "</td>
                        <td class='status-done'>" . $row["shift_status"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>ไม่พบข้อมูลในระบบ</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>