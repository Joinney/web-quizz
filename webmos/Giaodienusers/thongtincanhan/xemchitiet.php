<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webmos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy idketqua từ URL
$idketqua = isset($_GET['idketqua']) ? intval($_GET['idketqua']) : 0;

if ($idketqua == 0) {
    die("ID kết quả không hợp lệ.");
}

// Truy vấn để lấy thông tin chi tiết bài thi từ idketqua
$sql = "SELECT thoigian, diem, cauhoitext FROM ketqua WHERE idketqua = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idketqua);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Không tìm thấy kết quả bài thi.");
}

$row = $result->fetch_assoc();

// Giải mã dữ liệu cauhoitext (câu hỏi và câu trả lời)
$cauhoiData = json_decode($row['cauhoitext'], true);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài thi</title>
    <link rel="stylesheet" href="../../Css/lambaithi.css">
    <style>
        .container {
            width: 80%;
            margin: auto;
        }
        .panel {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .panel-heading {
            margin-bottom: 20px;
        }
        .panel-body {
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .back-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
        }

        .back-button:active {
            background-color: #004085;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-4 mb-4 text-center">Chi tiết bài thi</h1>
    <div class="panel">
        <div class="panel-body">
            <p><strong>Ngày thi:</strong> <?php echo $row['thoigian']; ?></p>
            <p><strong>Điểm số:</strong> <?php echo $row['diem']; ?></p>
            <p><strong>Chi tiết câu hỏi:</strong></p>
            <ul>
                <?php foreach ($cauhoiData as $cauhoi): ?>
                    <li>
                        <strong><?php echo $cauhoi['question']; ?></strong><br>
                        <strong>Đáp án của bạn:</strong> <?php echo $cauhoi['user_answer'] ?: 'Không chọn'; ?><br>
                        <strong>Đáp án đúng:</strong> <?php echo $cauhoi['correct_answer']; ?><br>
                        <strong>Kết quả:</strong> <?php echo $cauhoi['is_correct'] ? 'Đúng' : 'Sai'; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="../../Giaodienusers/kiemtra.php" class="back-button">Quay lại</a>
    </div>
</div>
</body>
</html>
