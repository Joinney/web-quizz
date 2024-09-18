<?php
session_start();
include_once('connection.php');

// Tạo mã thông báo CSRF nếu chưa tồn tại
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['register'])) {
    $name = htmlspecialchars($_POST['hoten']);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $diachi = htmlspecialchars($_POST['diachi']);
    $sdt = htmlspecialchars($_POST['sdt']);
    $csrf_token = $_POST['csrf_token'];

    // Kiểm tra mã thông báo CSRF
    if ($csrf_token !== $_SESSION['csrf_token']) {
        $_SESSION['error_message'] = 'Mã thông báo CSRF không hợp lệ';
        header("Location: register.php");
        exit;
    }

    // Kiểm tra mật khẩu có chứa số, chữ cái và ký tự đặc biệt không
    if (!preg_match('/[0-9]/', $password) || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/[\W]/', $password)) {
        $_SESSION['error_message'] = 'Mật khẩu phải chứa ít nhất một số, một chữ cái và một ký tự đặc biệt';
        header("Location: register.php");
        exit;
    }

    // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp không
    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = 'Mật khẩu và xác nhận mật khẩu không khớp.';
        header("Location: register.php");
        exit;
    }

    // Kiểm tra định dạng email
    if (!filter_var($username, FILTER_VALIDATE_EMAIL) || substr($username, -10) !== '@gmail.com') {
        $_SESSION['error_message'] = 'Tên đăng nhập phải là một email hợp lệ với đuôi @gmail.com';
        header("Location: register.php");
        exit;
    }

    // Kết nối cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "webmos");
    if ($conn->connect_error) {
        die('Kết nối thất bại: ' . $conn->connect_error);
    }

    // Kiểm tra nếu tên đăng nhập đã tồn tại
    $stmt = $conn->prepare("SELECT * FROM `taikhoan` WHERE `username` = ?");
    if ($stmt === false) {
        die('Chuẩn bị câu lệnh thất bại: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = 'Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác.';
        header("Location: register.php");
    } else {
        // Chèn dữ liệu người dùng
        $stmt = $conn->prepare("INSERT INTO `taikhoan` (`hoten`, `username`, `password`, `diachi`, `sdt`) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('Chuẩn bị câu lệnh thất bại: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("sssss", $name, $username, $password, $diachi, $sdt);

        // Thực hiện câu lệnh
        if ($stmt->execute()) {
            // Xóa thông báo lỗi và chuyển hướng đến trang đăng nhập
            unset($_SESSION['error_message']);
            header("Location: login.php");
            exit;
        } else {
            $_SESSION['error_message'] = 'Đăng ký thất bại: ' . htmlspecialchars($stmt->error);
            header("Location: register.php");
        }

        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <!-- Liên kết file CSS -->
  <link rel="stylesheet" href="./Css/register.css">
  <!-- Liên kết font chữ Lato -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> 
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="background-animation"></div>
  <div class="login-container">
    <div class="menu">
      <a href="login.php" class="active">Đăng nhập</a>
    </div>
    <h1>Đăng ký</h1>
    <form id="register-form" method="POST" action="">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <?php if (isset($_SESSION['error_message'])): ?>
        <div class="error-message">
          <?php echo $_SESSION['error_message']; ?>
          <?php unset($_SESSION['error_message']); ?>
        </div>
      <?php endif; ?>

      <div class="form-group">
        <label for="hoten">Họ tên:</label>
        <input type="text" id="hoten" name="hoten" required oninput="validateHoten()">
        <small id="hotenHelp" class="form-text text-muted"></small>
      </div>

      <div class="form-group">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required oninput="validateUsername()">
        <small id="usernameHelp" class="form-text text-muted">Định dạng đúng: example@gmail.com</small>
      </div>

      <div class="form-group">
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required oninput="validatePassword()">
        <small id="passwordHelp" class="form-text text-muted"></small>
      </div>

      <div class="form-group">
        <label for="confirm-password">Xác nhận mật khẩu:</label>
        <input type="password" id="confirm-password" name="confirm-password" required oninput="validateConfirmPassword()">
        <small id="confirmPasswordHelp" class="form-text text-muted"></small>
      </div>

      <div class="form-group">
        <label for="diachi">Địa chỉ:</label>
        <input type="text" id="diachi" name="diachi" required>
      </div>

      <div class="form-group">
        <label for="sdt">Số điện thoại:</label>
        <input type="text" id="sdt" name="sdt" required>
      </div>

      <button type="submit" name="register" id="register-btn">Đăng ký</button>
    </form>
  </div>
  <footer>
    <!-- Liên kết file JavaScript -->
    <script src="Js/script.js"></script>
  </footer>

  <script>
    function validateHoten() {
      const hoten = document.getElementById('hoten').value;
      const hotenHelp = document.getElementById('hotenHelp');
      if (hoten.length < 3) {
        hotenHelp.textContent = "Họ tên phải dài ít nhất 3 ký tự";
        hotenHelp.style.color = "red";
      } else {
        hotenHelp.textContent = "";
      }
    }

    function validateUsername() {
      const username = document.getElementById('username').value;
      const usernameHelp = document.getElementById('usernameHelp');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(username) || !username.endsWith('@gmail.com')) {
        usernameHelp.textContent = "Tên đăng nhập phải là một email hợp lệ với đuôi @gmail.com";
        usernameHelp.style.color = "red";
      } else {
        usernameHelp.textContent = "";
      }
    }

    function validatePassword() {
      const password = document.getElementById('password').value;
      const passwordHelp = document.getElementById('passwordHelp');
      const numberRegex = /[0-9]/;
      const letterRegex = /[a-zA-Z]/;
      const specialCharRegex = /[\W]/;
      
      if (!numberRegex.test(password) || !letterRegex.test(password) || !specialCharRegex.test(password)) {
        passwordHelp.textContent = "Mật khẩu phải chứa ít nhất một số, một chữ cái và một ký tự đặc biệt";
        passwordHelp.style.color = "red";
      } else {
        passwordHelp.textContent = "";
      }
    }

    function validateConfirmPassword() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm-password').value;
      const confirmPasswordHelp = document.getElementById('confirmPasswordHelp');
      if (password !== confirmPassword) {
        confirmPasswordHelp.textContent = "Mật khẩu và xác nhận mật khẩu không khớp";
        confirmPasswordHelp.style.color = "red";
      } else {
        confirmPasswordHelp.textContent = "";
      }
    }
  </script>
</body>
</html>
