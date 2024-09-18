
<?php
require '../connection.php';
session_start();

if (!isset($_POST['id'])) {
    http_response_code(400);
    die('ID bài đăng không hợp lệ.');
}

$postId = intval($_POST['id']);

if (!isset($_SESSION['idtaikhoan'])) {
    http_response_code(403);
    die('Bạn phải đăng nhập để xóa bài đăng.');
}

$userId = $_SESSION['idtaikhoan'];
$query = "SELECT idtaikhoan FROM baidang WHERE idbaidang = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $postId);
$stmt->execute();
$ownerId = $stmt->get_result()->fetch_assoc()['idtaikhoan'];

if ($userId !== $ownerId) {
    http_response_code(403);
    die('Bạn không có quyền xóa bài đăng này.');
}

$query = "DELETE FROM baidang WHERE idbaidang = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $postId);
if ($stmt->execute()) {
    echo 'Bài đăng đã được xóa.';
} else {
    http_response_code(500);
    echo 'Có lỗi xảy ra khi xóa bài đăng.';
}
?>
