<?php
include 'api.php';
// Kiểm tra nếu có ID bệnh nhân được truyền từ URL
if(isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    // Lấy thông tin của bệnh nhân dựa trên ID
    $patient = getPatientById($patient_id);

    // Kiểm tra nếu bệnh nhân tồn tại
    if($patient) {
        // Nếu form đã được gửi đi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $name = $_POST["name"];
            $dob = $_POST["dob"];
            $address = $_POST["address"];
            $phone_number = $_POST["phone_number"];

            // Cập nhật thông tin của bệnh nhân
            updatePatient($patient_id, $name, $dob, $address, $phone_number);

            // Chuyển hướng về trang index hoặc trang chi tiết của bệnh nhân sau khi cập nhật thành công
            header("Location: index.php");
            exit(); // Đảm bảo không có mã HTML hoặc các lệnh PHP khác được thực thi sau khi chuyển hướng
        }
    } else {
        // Hiển thị thông báo nếu không tìm thấy bệnh nhân
        echo "Không tìm thấy bệnh nhân.";
        exit();
    }
} else {
    // Hiển thị thông báo nếu không có ID bệnh nhân được truyền từ URL
    echo "ID bệnh nhân không được cung cấp.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa thông tin bệnh nhân</title>
    <style>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    </style>
</head>
<body>
    <h1>Chỉnh sửa thông tin bệnh nhân</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $patient_id; ?>">
        <label for="name">Tên bệnh nhân:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $patient['name']; ?>" required><br>
        <label for="dob">Ngày sinh:</label><br>
        <input type="date" id="dob" name="dob" value="<?php echo $patient['date_of_birth']; ?>"><br>
        <label for="address">Địa chỉ:</label><br>
        <textarea id="address" name="address"><?php echo $patient['address']; ?></textarea><br>
        <label for="phone_number">Số điện thoại:</label><br>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $patient['phone_number']; ?>"><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>
