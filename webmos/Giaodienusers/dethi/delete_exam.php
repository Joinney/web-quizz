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

// Lấy ID đề thi từ URL
$exam_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($exam_id > 0) {
    // Xóa đề thi khỏi cơ sở dữ liệu
    $sql = "DELETE FROM dethi WHERE iddethi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $exam_id);

    if ($stmt->execute()) {
        // Xóa thành công
        header('Location: /webmos/Giaodienusers/dethi/quanlydethi.php');
    } else {
        // Xóa thất bại
        header('Location: /webmos/Giaodienusers/dethi/quanlydethi.php');
    }

    $stmt->close();
} else {
    // ID không hợp lệ
    header('Location: /webmos/Giaodienusers/dethi/quanlydethi.php');
}

$conn->close();
?>
