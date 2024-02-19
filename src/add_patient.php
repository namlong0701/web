<?php
include 'api.php';

if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $patient = getPatientDetails($patient_id);
    if (!$patient) {
        echo "Không tìm thấy thông tin bệnh nhân!";
        exit;
    }
    $visits = getVisits($patient_id);
} else {
    echo "Không tìm thấy thông tin bệnh nhân!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bệnh nhân</title>
</head>
<body>
    <h2>Thông tin bệnh nhân</h2>
    <p>ID: <?php echo $patient['patient_id']; ?></p>
    <p>Tên: <?php echo $patient['name']; ?></p>
    <p>Ngày sinh: <?php echo $patient['date_of_birth']; ?></p>
    <p>Địa chỉ: <?php echo $patient['address']; ?></p>
    <p>Số điện thoại: <?php echo $patient['phone_number']; ?></p>

    <h2>Lịch sử khám</h2>
    <table border="1">
        <tr>
            <th>Thời gian</th>
            <th>Chuẩn đoán</th>
        </tr>
        <?php foreach ($visits as $visit): ?>
        <tr>
            <td><?php echo $visit['visit_time']; ?></td>
            <td><?php echo $visit['diagnosis']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
