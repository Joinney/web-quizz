<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý việc tải lên hình ảnh
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['newImage'])) {
    // Cài đặt thư mục và tệp đích
    $target_dir = "../../img/";
    $target_file = $target_dir . basename($_FILES["newImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là hình ảnh không
    $check = getimagesize($_FILES["newImage"]["tmp_name"]);
    if ($check === false) {
        echo "Tệp không phải là hình ảnh.";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước tệp (giới hạn 5MB)
    if ($_FILES["newImage"]["size"] > 5000000) {
        echo "Xin lỗi, tệp của bạn quá lớn.";
        $uploadOk = 0;
    }

    // Cho phép các định dạng tệp nhất định
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Xin lỗi, chỉ cho phép các tệp JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }

    // Kiểm tra nếu $uploadOk bằng 0 do lỗi
    if ($uploadOk == 0) {
        echo "Xin lỗi, tệp của bạn không được tải lên.";
    } else {
        // Nếu mọi thứ đều ổn, thử tải tệp lên
        if (move_uploaded_file($_FILES["newImage"]["tmp_name"], $target_file)) {
            // Cập nhật hình ảnh người dùng trong cơ sở dữ liệu
            $username = $_SESSION['username'];
            $image_path = basename($_FILES["newImage"]["name"]); // Lưu tên tệp thay vì đường dẫn đầy đủ

            // Cập nhật đường dẫn hình ảnh vào cơ sở dữ liệu
            $sql = "UPDATE taikhoan SET image = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $image_path, $username);

            if ($stmt->execute()) {
                // Đóng kết nối và chuyển hướng về trang thông tin cá nhân
                $stmt->close();
                $conn->close();
                header('Location: ../thongtincanhan.php ');
                exit();
            } else {
                echo "Lỗi: " . $stmt->error;
            }
        } else {
            echo "Xin lỗi, đã xảy ra lỗi khi tải lên tệp của bạn.";
        }
    }
}
?>