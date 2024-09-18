<?php

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID đề thi từ URL
$exam_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin đề thi
$sql_exam = "SELECT * FROM dethi WHERE iddethi = ?";
$stmt = $conn->prepare($sql_exam);
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$exam_result = $stmt->get_result();
$exam = $exam_result->fetch_assoc();

// Kiểm tra nếu không có đề thi với ID đó
if (!$exam) {
    die("Đề thi không tồn tại.");
}

// Lấy danh sách câu hỏi
$sql_questions = "SELECT * FROM dscauhoi WHERE iddethi = ?";
$stmt = $conn->prepare($sql_questions);
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$questions_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($exam['tendethi']); ?> - Chi tiết</title>
    <link rel="stylesheet" href="./Css/main.css">
    <link rel="stylesheet" href="./Css/dethichitiet.css">
</head>
<body>
    <nav>
        <!-- Your navigation bar code -->
    </nav>

    <h1><?php echo htmlspecialchars($exam['tendethi']); ?></h1>
    <div class="exam-detail">
        <p><?php echo htmlspecialchars($exam['mota']); ?></p>
        <div class="questions-section">
            <h2>Câu hỏi</h2>
            <?php if ($questions_result->num_rows > 0): ?>
                <ul class="questions-list">
                    <?php $question_number = 1; // Initialize question number ?>
                    <?php while($question = $questions_result->fetch_assoc()): ?>
                        <li class="question-item">
                            <p><strong>Question <?php echo $question_number; ?>:</strong> <?php echo htmlspecialchars($question['cauhoi']); ?></p>
                            <ul class="options">
                                <li>A. <?php echo htmlspecialchars($question['a']); ?></li>
                                <li>B. <?php echo htmlspecialchars($question['b']); ?></li>
                                <li>C. <?php echo htmlspecialchars($question['c']); ?></li>
                                <li>D. <?php echo htmlspecialchars($question['d']); ?></li>
                            </ul>
                        </li>
                        <?php $question_number++; // Increment question number ?>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Không có câu hỏi nào.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="exam-buttons">
        <a href="kiemtra.php" class="btn btn-back">Quay lại</a>
        <a href="login.php" class="btn btn-start">Bắt đầu thi</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Your JavaScript code
    </script>
</body>
</html>
