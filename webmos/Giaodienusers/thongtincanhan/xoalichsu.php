<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin người dùng từ session
$username = $_SESSION['username'];

// Truy vấn lấy idtaikhoan của người dùng dựa trên username
$sql_user = "SELECT idtaikhoan FROM taikhoan WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param('s', $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$idtaikhoan = $user['idtaikhoan'];

// Xử lý xóa bài thi
if (isset($_GET['idketqua'])) {
    $idketqua = $_GET['idketqua'];

    // Kiểm tra ID bài thi hợp lệ
    if (empty($idketqua)) {
        echo "<p>ID bài thi không hợp lệ.</p>";
    } else {
        // Kiểm tra bản ghi tồn tại trước khi xóa
        $sql_check = "SELECT 1 FROM ketqua WHERE idketqua = ? AND idtaikhoan = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('ii', $idketqua, $idtaikhoan);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows === 0) {
            echo "<p>Bài thi không tồn tại hoặc không thuộc về bạn.</p>";
        } else {
            // Xóa kết quả bài thi từ cơ sở dữ liệu
            $sql_delete = "DELETE FROM ketqua WHERE idketqua = ? AND idtaikhoan = ?";
            if ($stmt_delete = $conn->prepare($sql_delete)) {
                $stmt_delete->bind_param('ii', $idketqua, $idtaikhoan);
                if ($stmt_delete->execute()) {
                    // Xóa thành công, chuyển hướng lại trang chính
                    header('Location: ../thongtincanhan.php?msg=delete_success');
                    exit();
                } else {
                    echo "<p>Có lỗi xảy ra khi xóa bài thi: " . $stmt_delete->error . "</p>";
                }
                $stmt_delete->close();
            } else {
                echo "<p>Lỗi chuẩn bị câu lệnh xóa: " . $conn->error . "</p>";
            }
        }
        $stmt_check->close();
    }
} else {
    echo "<p>Không có ID bài thi.</p>";
}

// Đóng kết nối
$conn->close();
?>
