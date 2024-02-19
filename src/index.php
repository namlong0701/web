<?php
include 'api.php';
// Lấy danh sách bệnh nhân
$result = getAllPatients();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý bệnh nhân</title>
    <style>
            /* CSS cho dropdown menu */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropbtn {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown-content a:hover {
                background-color: #f1f1f1;
            }

            .show {
                display: block;
            }

            /* CSS cho layout */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f0f0f0;
            }

            .header {
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 20px 0;
            }

            .container {
                max-width: 1200px;
                margin: 20px auto;
                display: flex;
                justify-content: space-between;
            }

            .patients-list {
                flex-grow: 1;
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            table {
                width: 100%;
                border-collapse: collapse;
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

            .buttons {
                flex-grow: 1;
                margin-left: 20px;
            }

            .button {
                display: block; /* Hiển thị nút "Thêm bệnh nhân mới" */
                width: 200px; /* Độ rộng của nút */
                margin-top: 20px; /* Khoảng cách giữa nút và bảng danh sách bệnh nhân */
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                text-align: center;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .button:hover {
                background-color: #45a049;
            }

    </style>
</head>
<body>
    <div class="header">
        <h1>Hệ thống quản lý bệnh nhân</h1>
    </div>
    <div class="container">
        <div class="patients-list">
            <h2>Danh sách bệnh nhân</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["patient_id"] . "</td>";
                        echo "<td>". $row["name"]."</td>";
                        echo "<td>" . $row["date_of_birth"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["phone_number"] . "</td>";
                        echo "<td class='action-column'>";
                        echo "<div class='dropdown'>";
                        echo "<button class='dropbtn'>Thao tác</button>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='edit_patient.php?id=" . $row["patient_id"] . "'>Sửa</a>"; // Thêm liên kết đến edit_patient.php
                        echo "<a href='delete_patient.php?id=" . $row["patient_id"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa bệnh nhân này không?\");'>Xóa</a>";
                        echo "<a href='patient_detail.php?patient_id=" . $row["patient_id"] . "'>Chi tiết</a>"; // Thay đổi từ 'id' thành 'patient_id'
                        echo "</div>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>0 kết quả</td></tr>";
                }
                ?>
            </table>
            <div class="buttons">
                <a href="add_patient.php" class="button">Thêm bệnh nhân mới</a>
            </div>
        </div>
    </div>
    <script>
        // JavaScript để xử lý sự kiện khi nhấp vào chữ "Thao tác"
        var dropdowns = document.getElementsByClassName("dropdown");
        for (var i = 0; i < dropdowns.length; i++) {
            var dropdown = dropdowns[i];
            dropdown.addEventListener("click", function() {
                var dropdownContent = this.querySelector(".dropdown-content");
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
</body>
</html>
