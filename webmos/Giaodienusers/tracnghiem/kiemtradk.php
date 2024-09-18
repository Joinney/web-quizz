<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Lấy ID tài khoản từ SESSION
$userId = isset($_SESSION['idtaikhoan']) ? intval($_SESSION['idtaikhoan']) : 0;

// Lấy ID đề thi từ URL (GET parameter 'id')
$examId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra giá trị của ID tài khoản và ID đề thi
$showMessage = '';  // Biến lưu thông báo
$messageType = '';  // Loại thông báo

if ($userId <= 0) {
    $showMessage = "ID người dùng không hợp lệ.";
    $messageType = 'error'; // Thông báo lỗi
} else {
    $conn = new mysqli("localhost", "root", "", "webmos");
    if ($conn->connect_error) {
        $showMessage = "Kết nối cơ sở dữ liệu thất bại.";
        $messageType = 'error'; // Thông báo lỗi
    } else {
        // Danh sách ID đề thi đặc biệt cần kiểm tra
        $specialExamIds = [1, 2, 3, 4];

        if (in_array($examId, $specialExamIds)) {
            // Nếu là đề thi số 1, chuyển hướng ngay lập tức
            if ($examId == 1) {
                header("Location: ../../../webmos/Giaodienusers/tracnghiem/lambaithi.php?iddethi=$examId");
                exit();  // Kết thúc script sau khi chuyển hướng
            }

            // Xác định ID bài thi cần hoàn thành trước
            $requiredExamId = 0;
            if ($examId == 2) {
                $requiredExamId = 1;
            } elseif ($examId == 3) {
                $requiredExamId = 2;
            } elseif ($examId == 4) {
                $requiredExamId = 3;
            }

            $sql = "SELECT MAX(diem) as max_diem FROM ketqua WHERE idtaikhoan = ? AND iddethi = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                $showMessage = "Lỗi chuẩn bị câu lệnh SQL: " . $conn->error;
                $messageType = 'error'; // Thông báo lỗi
            } else {
                $stmt->bind_param("ii", $userId, $requiredExamId);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row === null || $row['max_diem'] === null) {
                    $showMessage = "Bạn cần hoàn thành bài thi số " . $requiredExamId . " trước để làm bài thi này.";
                    $messageType = 'warning'; // Thông báo cảnh báo
                } elseif ($row['max_diem'] < 4) {
                    $showMessage = "Bạn cần đạt ít nhất 4 điểm trong bài thi số " . $requiredExamId . " để làm bài thi này.";
                    $messageType = 'warning'; // Thông báo cảnh báo
                } else {
                    // Nếu đủ điều kiện, chuyển hướng đến trang bài thi
                    header("Location: ../../../webmos/Giaodienusers/tracnghiem/lambaithi.php?iddethi=$examId");
                    exit();  // Kết thúc script sau khi chuyển hướng
                }

                $stmt->close();
            }
        } else {
            // Đối với các đề thi khác, chuyển hướng đến trang bài thi mà không cần kiểm tra
            header("Location: ../../../webmos/Giaodienusers/tracnghiem/lambaithi.php?iddethi=$examId");
            exit();  // Kết thúc script sau khi chuyển hướng
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            overflow: hidden;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .message-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            animation: fadeIn 0.5s ease-out;
        }
        .message-box.error {
            border-left: 5px solid #dc3545;
            color: #721c24;
        }
        .message-box.warning {
            border-left: 5px solid #ffc107;
            color: #856404;
        }
        .message-box.success {
            border-left: 5px solid #28a745;
            color: #155724;
        }
        .btn-ok {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-ok:hover {
            background-color: #0056b3;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <?php if (!empty($showMessage)): ?>
        <div class="overlay">
            <div class="message-box <?= $messageType ?>">
                <?= htmlspecialchars($showMessage) ?>
                <a href="../../Giaodienusers/kiemtra.php" class="btn-ok">OK</a>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
