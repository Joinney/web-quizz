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

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy mật khẩu mới từ form
    $newPassword = $_POST['newPassword'];

    // Xác thực mật khẩu mới
    if (empty($newPassword)) {
        echo "Mật khẩu mới không được để trống.";
        exit();
    }

    // Kiểm tra mật khẩu có ít nhất một chữ cái, một số và một ký tự đặc biệt
    if (!preg_match('/[A-Za-z]/', $newPassword) || 
        !preg_match('/[0-9]/', $newPassword) || 
        !preg_match('/[@!#$%^&*()_+{}\[\]:;"\'<>,.?~`|-]/', $newPassword)) {
        echo "Mật khẩu phải chứa ít nhất một chữ cái, một số và một ký tự đặc biệt (@, !, #, $, %, ^, &, *, (, ), _, +, {, }, [, ], :, ;, \", \', <, >, ,, ., ?, ~, `, |, -).";
        exit();
    }

    // Lấy tên người dùng từ session
    $username = $_SESSION['username'];

    // Cập nhật mật khẩu trong cơ sở dữ liệu
    $sql = "UPDATE taikhoan SET password = ? WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $newPassword, $username);

        if ($stmt->execute()) {
            // Chuyển hướng đến thongtincanhan.php sau khi cập nhật mật khẩu thành công
            header('Location: ../thongtincanhan.php');
            exit();
        } else {
            echo "Đã xảy ra lỗi. Vui lòng thử lại.";
        }

        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị câu lệnh SQL.";
    }

    $conn->close();
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
