<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root"; // Thay đổi thông tin đăng nhập cơ sở dữ liệu của bạn
$password = ""; // Thay đổi thông tin đăng nhập cơ sở dữ liệu của bạn
$dbname = "webmos"; // Thay đổi tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$examId = isset($_GET['iddethi']) ? intval($_GET['iddethi']) : 0;
$userId = $_SESSION['idtaikhoan']; // Giả sử id tài khoản người dùng đã được lưu trong session

// Cập nhật số lượng người sử dụng bài thi
$updateUsageSql = "UPDATE dethi SET soluongnguoisudung = soluongnguoisudung + 1 WHERE iddethi = ?";
$stmtUpdate = $conn->prepare($updateUsageSql);
$stmtUpdate->bind_param("i", $examId);
$stmtUpdate->execute();
$stmtUpdate->close();

// Ghi lại thông tin thống kê vào bảng thongkebaithi
$insertThongKeSql = "INSERT INTO thongkebaithi (idtaikhoan, iddethi, thoigiansudung) VALUES (?, ?, NOW())";
$stmtThongKe = $conn->prepare($insertThongKeSql);
$stmtThongKe->bind_param("ii", $userId, $examId);
$stmtThongKe->execute();
$stmtThongKe->close();

// Lấy câu hỏi từ bảng dscauhoi cho kỳ thi đã chỉ định
$sqlQuestions = "SELECT idcauhoi, cauhoi, a, b, c, d FROM dscauhoi WHERE iddethi = ?";
$stmt = $conn->prepare($sqlQuestions);
$stmt->bind_param("i", $examId);
$stmt->execute();
$resultQuestions = $stmt->get_result();

// Lấy thời gian thi từ bảng dethi cho kỳ thi đã chỉ định
$sqlExamTime = "SELECT thoigian FROM dethi WHERE iddethi = ?";
$stmt = $conn->prepare($sqlExamTime);
$stmt->bind_param("i", $examId);
$stmt->execute();
$resultExamTime = $stmt->get_result();
$examTime = $resultExamTime->fetch_assoc()['thoigian'] ?? '00:00:00';

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Làm bài thi</title>
    <link rel="stylesheet" href="../../Css/lambaithi.css">
</head>
<body>
<div class="container">
    <h1 class="mt-4 mb-4 text-center">Làm bài thi</h1>
    <div class="panel">
        <div class="panel-heading d-flex justify-content-between">
            <span id="spFullname" class="font-weight-bold">Làm bài thi</span>
            <span id="divRemainingTime" class="font-weight-bold">
                Thời gian còn lại: <span id="spRemainingTime">00:00:00</span>
            </span>
        </div>
        <div class="panel-body">
            <form method="POST" action="ketquathi.php?iddethi=<?php echo htmlspecialchars($examId); ?>">
                <div id="questions">
                    <?php
                    $questionNumber = 1; // Khởi tạo biến số thứ tự câu hỏi
                    if ($resultQuestions->num_rows > 0) {
                        while ($row = $resultQuestions->fetch_assoc()) {
                            echo '<div class="question">';
                            echo '<p><strong>Câu ' . $questionNumber . ': ' . htmlspecialchars($row['cauhoi']) . '</strong></p>';
                            $options = ['a' => $row['a'], 'b' => $row['b'], 'c' => $row['c'], 'd' => $row['d']];
                            foreach ($options as $key => $option) {
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="radio" name="answer[' . $row['idcauhoi'] . ']" value="' . $key . '">';
                                echo '<label class="form-check-label">' . htmlspecialchars($option) . '</label>';
                                echo '</div>';
                            }
                            echo '</div>';
                            $questionNumber++; // Tăng số thứ tự câu hỏi
                        }
                    } else {
                        echo "<p class='text-center'>Không có câu hỏi nào được tìm thấy.</p>";
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center mt-4">
                        <button type="submit" class="btn btn-warning" id="btnFinish">Kết thúc bài thi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var examTime = '<?php echo htmlspecialchars($examTime); ?>'; // Lấy thời gian thi từ PHP
    
    // Chuyển thời gian thi (HH:MM:SS) thành tổng số giây
    var timeParts = examTime.split(':');
    var totalSeconds = parseInt(timeParts[0]) * 3600 + parseInt(timeParts[1]) * 60 + parseInt(timeParts[2]);

    function updateTimer() {
        var hours = Math.floor(totalSeconds / 3600);
        var minutes = Math.floor((totalSeconds % 3600) / 60);
        var seconds = totalSeconds % 60;

        document.getElementById('spRemainingTime').textContent = 
            String(hours).padStart(2, '0') + ':' +
            String(minutes).padStart(2, '0') + ':' +
            String(seconds).padStart(2, '0');

        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            document.getElementById('btnFinish').click(); // Tự động gửi bài thi khi hết thời gian
        } else {
            totalSeconds--;
        }
    }

    updateTimer(); // Gọi hàm cập nhật thời gian ngay lập tức
    var timerInterval = setInterval(updateTimer, 1000); // Cập nhật thời gian mỗi giây
});
</script>
</body>
</html>
