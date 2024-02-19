<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bệnh nhân</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .button-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'api.php';

        if(isset($_GET['patient_id'])) {
            $patient_id = $_GET['patient_id'];
            $patient = getPatientDetails($patient_id);
            if ($patient) {
                $visits = getVisits($patient_id); // Loại bỏ đối số kết nối đến cơ sở dữ liệu

                // Hiển thị thông tin bệnh nhân và lịch sử khám
        ?>
        <h2>Chi tiết bệnh nhân</h2>
        <p><strong>Tên:</strong> <?php echo $patient['name']; ?></p>
        <p><strong>Ngày sinh:</strong> <?php echo $patient['date_of_birth']; ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo $patient['address']; ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo $patient['phone_number']; ?></p>

        <h3>Lịch sử khám</h3>
        <table>
            <tr>
                <th>Ngày khám</th>
                <th>Kết quả</th>
            </tr>
            <?php foreach ($visits as $visit): ?>
                <tr>
                    <td><?php echo $visit['visit_time']; ?></td>
                    <td><?php echo $visit['diagnosis']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Sử dụng một div để bao quanh cả hai nút -->
        <div class="button-container">
            <!-- Thêm nút button để chuyển sang trang thêm thời gian khám và kết quả khám -->
            <form action="add_visit.php" method="get">
                <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                <button type="submit">Thêm đợt đã khám mới</button>
            </form>

            <!-- Thêm nút "Thoát" để quay lại trang index.php -->
            <button onclick="window.location.href='index.php'">Thoát</button>
        </div>

        <?php
            } else {
                echo "<p>Không tìm thấy thông tin bệnh nhân!</p>";
            }
        } else {
            echo "<p>Không tìm thấy thông tin bệnh nhân!</p>";
        }
        ?>
    </div>
</body>
</html>
