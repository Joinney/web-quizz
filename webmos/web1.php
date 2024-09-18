<?php
// config.php: Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "webmos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý Đăng Bài
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_post'])) {
    session_start();
    $userId = $_SESSION['idtaikhoan'];
    $title = $_POST['title'];

    // Xử lý tải ảnh lên
    $imagePath = '' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

    // Thêm bài đăng vào cơ sở dữ liệu
    $sql = "INSERT INTO baidang (idtaikhoan, tieude, image, thoigian) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $userId, $title, $imagePath);
    $stmt->execute();

    header("Location: ../Giaodienusers/diendan.php");
    exit();
}

// Xử lý Thích (Like)
if (isset($_POST['like'])) {
    session_start();
    $userId = $_SESSION['idtaikhoan'];
    $postId = $_POST['post_id'];

    // Kiểm tra xem người dùng đã thích bài đăng chưa
    $sql = "SELECT * FROM likes WHERE idtaikhoan = ? AND idbaidang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu đã thích, bỏ thích
        $sql = "DELETE FROM likes WHERE idtaikhoan = ? AND idbaidang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $postId);
        $stmt->execute();
    } else {
        // Nếu chưa thích, thêm vào
        $sql = "INSERT INTO likes (idtaikhoan, idbaidang) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $postId);
        $stmt->execute();
    }
    header("Location: ../Giaodienusers/diendan.php");
    exit();
}

// Xử lý Xóa Bình Luận
if (isset($_POST['delete_comment'])) {
    session_start();
    $commentId = $_POST['comment_id'];
    $userId = $_SESSION['idtaikhoan'];

    // Kiểm tra xem người dùng có phải là chủ sở hữu của bình luận không
    $sql = "SELECT idtaikhoan FROM binhluan WHERE idbinhluan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $commentOwner = $result->fetch_assoc()['idtaikhoan'];

    // Chỉ cho phép xóa nếu người dùng là chủ sở hữu của bình luận
    if ($commentOwner == $userId) {
        // Xóa bình luận khỏi cơ sở dữ liệu
        $sql = "DELETE FROM binhluan WHERE idbinhluan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $commentId);
        $stmt->execute();
    } else {
        die("Bạn không có quyền xóa bình luận này.");
    }

    // Chuyển hướng lại trang bài đăng sau khi xóa bình luận
    header("Location: ../Giaodienusers/diendan.php");
    exit();
}

        // Xử lý Xóa Bài Đăng
    if (isset($_POST['delete'])) {
        session_start();

        if (!isset($_SESSION['idtaikhoan'])) {
            die("Bạn cần đăng nhập để xóa bài đăng.");
        }

        $userId = $_SESSION['idtaikhoan'];
        $postId = $_POST['post_id'];

        // Kiểm tra quyền xóa bài đăng
        $sql = "SELECT idtaikhoan FROM baidang WHERE idbaidang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $ownerId = $stmt->get_result()->fetch_assoc()['idtaikhoan'];

        if ($ownerId != $userId && !isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != true) {
            die("Bạn không có quyền xóa bài đăng này.");
        }

        // Xóa bài đăng từ cơ sở dữ liệu
        $sql = "DELETE FROM baidang WHERE idbaidang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();

        // Xóa tất cả các bình luận liên quan
        $sql = "DELETE FROM binhluan WHERE idbaidang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();

        // Xóa tất cả các lượt thích liên quan
        $sql = "DELETE FROM likes WHERE idbaidang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();

        header("Location: ../Giaodienusers/diendan.php");
        exit();
    }

?>

