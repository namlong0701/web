<?php
include "api.php";
// Kiểm tra xem có thông tin bệnh nhân được gửi từ trang patient_detail.php không
if(isset($_GET['patient_id'])) {
    // Lấy thông tin bệnh nhân từ tham số truyền qua
    $patient_id = $_GET['patient_id'];
    
    // Xử lý khi nút "Thêm lịch khám" được ấn
    if(isset($_POST['submit'])) {
        // Lấy thông tin thời gian khám và kết quả khám từ form
        $visit_time = $_POST['visit_time'];
        $diagnosis = $_POST['diagnosis'];
        
        // Thêm lịch khám mới vào bảng visits
        addVisit($patient_id, $visit_time, $diagnosis);
        
        // Chuyển hướng quay lại trang chi tiết bệnh nhân
        header("Location: patient_detail.php?patient_id=$patient_id");
        exit();
    }
} else {
    // Nếu không có thông tin bệnh nhân được gửi, chuyển hướng người dùng đến trang không hợp lệ
    header("Location: invalid_page.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm lịch khám mới</title>
    <style>
        /* CSS cho form */
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="datetime-local"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Thêm đợt đã khám mới</h2>
    <form action="" method="post">
        <label for="visit_time">Thời gian khám:</label>
        <input type="datetime-local" id="visit_time" name="visit_time" required>

        <label for="diagnosis">Kết quả khám:</label>
        <textarea id="diagnosis" name="diagnosis" rows="4" required></textarea>

        <input type="submit" name="submit" value="Thêm">
    </form>
</body>
</html>
