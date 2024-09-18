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

// Thực hiện hành động thêm, sửa, xóa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idtaikhoan = $_POST["idtaikhoan"];
    $hoten = $_POST["hoten"];
    $username = $_POST["username"];
    $password = isset($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : "";
    $diachi = $_POST["diachi"];
    $sdt = $_POST["sdt"];
    
    if ($_POST["action"] == "add") {
        $sql = "INSERT INTO taikhoan (hoten, username, password, diachi, sdt) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $hoten, $username, $password, $diachi, $sdt);
    } elseif ($_POST["action"] == "update") {
        $sql = "UPDATE taikhoan SET hoten=?, username=?, diachi=?, sdt=? WHERE idtaikhoan=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $hoten, $username, $diachi, $sdt, $idtaikhoan);
    } elseif ($_POST["action"] == "delete") {
        $sql = "DELETE FROM taikhoan WHERE idtaikhoan=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idtaikhoan);
    }

    if ($stmt->execute()) {
        header("Location: quanlytaikhoan.php");
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
