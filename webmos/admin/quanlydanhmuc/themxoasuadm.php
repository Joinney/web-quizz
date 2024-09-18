<?php
include '../../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $iddanhmuc = isset($_POST['iddanhmuc']) ? $_POST['iddanhmuc'] : '';
    $tendanhmuc = isset($_POST['tendanhmuc']) ? $_POST['tendanhmuc'] : '';

    if ($action == 'add') {
        $sql = "INSERT INTO danhmuc (tendanhmuc) VALUES ('$tendanhmuc')";
        if ($conn->query($sql) === TRUE) {
            echo "Thêm danh mục thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'update' && !empty($iddanhmuc)) {
        $sql = "UPDATE danhmuc SET tendanhmuc='$tendanhmuc' WHERE iddanhmuc=$iddanhmuc";
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật danh mục thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'delete' && !empty($iddanhmuc)) {
        $sql = "DELETE FROM danhmuc WHERE iddanhmuc=$iddanhmuc";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa danh mục thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }

    // Chuyển hướng về trang quản lý sau khi xử lý
    header("Location: quanlydanhmuc.php");
    exit();
}

$conn->close();
?>
