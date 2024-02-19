<?php

// Hàm kết nối đến cơ sở dữ liệu
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }
    return $conn;
}

// Hàm thêm bệnh nhân mới vào cơ sở dữ liệu
function addPatient($name, $dob, $address, $phone_number) {
    $conn = connectToDatabase();

    $sql = "INSERT INTO patients (name, date_of_birth, address, phone_number) 
            VALUES ('$name', '$dob', '$address', '$phone_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm mới bệnh nhân thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Hàm xóa bệnh nhân khỏi cơ sở dữ liệu
function deletePatient($patient_id) {
    $conn = connectToDatabase();

    $sql = "DELETE FROM patients WHERE patient_id = $patient_id";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa bệnh nhân thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Hàm lấy tất cả bệnh nhân từ cơ sở dữ liệu
function getAllPatients() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM patients";
    $result = $conn->query($sql);

    $conn->close();

    return $result;
}

// Hàm lấy thông tin chi tiết của bệnh nhân dựa trên patient_id
function getPatientDetails($patient_id) {
    $conn = connectToDatabase();

    $patient_id = mysqli_real_escape_string($conn, $patient_id);
    $query = "SELECT * FROM patients WHERE patient_id = '$patient_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }

    // Di chuyển câu lệnh đóng kết nối xuống phía dưới
    $conn->close();
}

// Hàm lấy danh sách các lần khám của bệnh nhân dựa trên patient_id
// Hàm lấy danh sách các lần khám của bệnh nhân dựa trên patient_id
function getVisits($patient_id) {
    $conn = connectToDatabase();
    $patient_id = mysqli_real_escape_string($conn, $patient_id);
    $query = "SELECT * FROM visits WHERE patient_id = '$patient_id'";
    $result = $conn->query($query);
    $visits = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $visits[] = $row;
        }
    }
    return $visits;
}

// Hàm thêm lịch khám mới vào bảng visits
function addVisit($patient_id, $visit_time, $diagnosis) {
    // Gọi hàm kết nối đến cơ sở dữ liệu từ file api.php
    $conn = connectToDatabase();
    
    // Chuẩn bị câu lệnh SQL để thêm lịch khám mới
    $sql = "INSERT INTO visits (patient_id, visit_time, diagnosis) 
            VALUES ('$patient_id', '$visit_time', '$diagnosis')";
    
    // Thực thi câu lệnh SQL
    if ($conn->query($sql) === TRUE) {
        echo "Thêm lịch khám mới thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    
    // Đóng kết nối đến cơ sở dữ liệu
    $conn->close();
}
?>
