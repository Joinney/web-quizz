<?php
// Cấu hình và kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webmos";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy email từ yêu cầu POST và làm sạch dữ liệu đầu vào
$email = trim($_POST['email']);

// Kiểm tra tính hợp lệ của email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = array(
        'success' => false,
        'message' => 'Địa chỉ email không hợp lệ.'
    );
    echo json_encode($response);
    exit;
}

// Chuẩn bị và thực hiện truy vấn để kiểm tra xem email có tồn tại không
$sql = "SELECT * FROM taikhoan WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem email có tồn tại không
$response = array();
if ($result->num_rows > 0) {
    // Logic để gửi OTP đến email
    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0; // 0 = no output, 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "zbachhoaminiz@gmail.com";
    $mail->Password = "tyonowvmmiwepeni";
    $mail->SetFrom("zbachhoaminiz@gmail.com", "G5TD MOS");

    // Generate OTP
    $otp = rand(100000, 999999); // Generates a random 6-digit OTP

    // Email subject and body
    $mail->Subject = "OTP CODE REGENERATES YOUR PASSWORD";
    $mail->Body = "Xin chào,<br><br>Mã OTP của bạn là: <strong>$otp</strong><br><br>Vui lòng sử dụng mã này để hoàn tất việc xác thực.";

    // Thiết lập người nhận email
    $mail->AddAddress($email);

    if (!$mail->Send()) {
        $response['success'] = false;
        $response['message'] = "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $response['success'] = true;
        $response['message'] = 'Mã OTP đã được gửi tới email của bạn.';
        
        // Lưu OTP vào session
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Email không tồn tại hoặc chưa được đăng ký.';
}

// Đóng kết nối
$stmt->close();
$conn->close();

// Trả về phản hồi JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
