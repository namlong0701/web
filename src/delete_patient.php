<?php
include 'api.php';

// Xử lý khi người dùng gửi yêu cầu xóa bệnh nhân
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $patient_id = $_GET["id"];
    
    // Gọi hàm xóa bệnh nhân
    deletePatient($patient_id);

    // Chuyển hướng người dùng về trang danh sách bệnh nhân
    header("Location: index.php");
    exit(); // Đảm bảo không có mã HTML hoặc các lệnh PHP khác được thực thi sau khi chuyển hướng

}
?>
