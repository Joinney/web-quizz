<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webmos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch submitted answers
$answers = $_POST['answer'] ?? [];

// Get and validate the exam ID
$examId = isset($_GET['iddethi']) ? intval($_GET['iddethi']) : 0;

// Fetch questions and correct answers from the database
$sql = "SELECT idcauhoi, cauhoi, a, b, c, d, traloi FROM dscauhoi WHERE iddethi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $examId);

if (!$stmt->execute()) {
    die('Execute failed: ' . $stmt->error);
}

$result = $stmt->get_result();
if ($result === false) {
    die('Error executing query: ' . $conn->error);
}

if ($result->num_rows == 0) {
    echo 'No questions found for the given exam ID.';
    exit();
}

$questions = [];
$score = 0;
$userId = $_SESSION['idtaikhoan']; // Assuming you store the user's ID in session
$cauhoitext = []; // To store the question and user's answer

while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
    $userAnswer = $answers[$row['idcauhoi']] ?? null;
    $isCorrect = false;
    
    // Check if the user's answer matches the correct answer in the 'traloi' column
    if ($userAnswer && $row[$userAnswer] === $row['traloi']) {
        $isCorrect = true;
        $score++;
    }

    // Prepare cauhoitext with question, user's answer, and correct answer
    $cauhoitext[] = [
        'question' => $row['cauhoi'],
        'options' => ['a' => $row['a'], 'b' => $row['b'], 'c' => $row['c'], 'd' => $row['d']],
        'user_answer' => $userAnswer,
        'correct_answer' => $row['traloi'],
        'is_correct' => $isCorrect
    ];
}

// Save the results in the ketqua table
$cauhoitext_json = json_encode($cauhoitext);
$insert_sql = "INSERT INTO ketqua (idtaikhoan, iddethi, thoigian, cauhoitext, diem) VALUES (?, ?, NOW(), ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("iisd", $userId, $examId, $cauhoitext_json, $score);
if (!$insert_stmt->execute()) {
    die('Error saving results: ' . $insert_stmt->error);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài thi</title>
    <link rel="stylesheet" href="../../Css/lambaithi.css">
    <style>
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

        .correct {
            color: green;
            font-weight: bold;
        }
        .incorrect {
            color: red;
            font-weight: bold;
        }
        .unselected {
            color: black;
            font-weight: normal;
        }
        .question-number {
            font-weight: bold;
            margin-right: 10px;
        }
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
        .question {
            margin-bottom: 20px;
        }
        .form-check {
            margin-left: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-4 mb-4 text-center">Kết quả bài thi</h1>
    <div class="panel">
        <div class="panel-heading">
            <span class="font-weight-bold">Điểm số của bạn: <?php echo $score; ?> / <?php echo count($questions); ?></span>
        </div>
        <div class="panel-body">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question">
                    <p>
                        <span class="question-number">Câu <?php echo $index + 1; ?>:</span>
                        <strong><?php echo htmlspecialchars($question['cauhoi']); ?></strong>
                    </p>
                    <?php foreach (['a', 'b', 'c', 'd'] as $key): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" disabled
                                   <?php echo (isset($answers[$question['idcauhoi']]) && $answers[$question['idcauhoi']] === $key) ? 'checked' : ''; ?>>
                            <label class="form-check-label 
                                <?php 
                                    if (isset($answers[$question['idcauhoi']]) && $answers[$question['idcauhoi']] === $key) {
                                        // User selected this option
                                        echo ($question[$key] === $question['traloi']) ? 'correct' : 'incorrect';
                                    } elseif ($question[$key] === $question['traloi']) {
                                        // This is the correct answer, even if not selected
                                        echo 'correct';
                                    } else {
                                        // Neutral color for unselected wrong options
                                        echo 'unselected';
                                    }
                                ?>">
                                <?php echo htmlspecialchars($question[$key]); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <a href="../../Giaodienusers/kiemtra.php" class="back-button">Quay lại</a>
        </div>
    </div>
</div>
</body>
</html>
