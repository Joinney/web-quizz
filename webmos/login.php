<?php
session_start();
include_once('connection.php');

$errorMessages = [];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra xem các trường có trống không
    if (empty($username) || empty($password)) {
        $errorMessages['general'] = 'Vui lòng điền cả tên đăng nhập và mật khẩu';
    } else {
        // Kiểm tra email hợp lệ
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $errorMessages['username'] = 'Tên đăng nhập phải là một địa chỉ email hợp lệ';
        } else {
            // Kiểm tra mật khẩu có chứa số, chữ cái và ký tự đặc biệt không
            if (!preg_match('/[0-9]/', $password) || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/[\W]/', $password)) {
                $errorMessages['password'] = 'Mật khẩu phải chứa ít nhất một số, một chữ cái và một ký tự đặc biệt';
            } else {
                // Chuẩn bị và thực thi câu lệnh để ngăn chặn tấn công SQL injection
                $stmt = $conn->prepare("SELECT * FROM `taikhoan` WHERE `username` = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Xác minh mật khẩu
                    if ($password === $row['password']) { // So sánh mật khẩu dạng văn bản thuần túy
                        $_SESSION['username'] = $username;
                        $_SESSION['idtaikhoan'] = $row['idtaikhoan'];
                        $_SESSION['hoten'] = $row['hoten'];
                        $_SESSION['diachi'] = $row['diachi'];
                        $_SESSION['sdt'] = $row['sdt'];
                        header('Location: ./Giaodienusers/index.php'); // Chuyển hướng đến trang index.php
                        exit;
                    } else {
                        $errorMessages['general'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
                    }
                } else {
                    $errorMessages['general'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
                }

                $stmt->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng Nhập</title>
  <!-- Liên kết file CSS -->
  <link rel="stylesheet" href="./Css/login.css">
  <!-- Liên kết font chữ Lato -->
  <link rel="preconnect" href="https://fonts.googleapis.com"> 
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
  <style>
    .error-message {
      color: red;
      font-size: 0.875em;
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <div class="background-animation"></div>
  <div class="login-container">
    <div class="menu">
      <a href="register.php" class="active">Đăng Ký</a>
    </div>
    <h1>Đăng Nhập</h1>
    <form id="login-form" action="login.php" method="post">
      <div class="form-group">
        <label for="username">Tên đăng nhập (Email):</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars(isset($_POST['username']) ? $_POST['username'] : ''); ?>" required>
        <div id="username-error" class="error-message"><?php echo isset($errorMessages['username']) ? $errorMessages['username'] : ''; ?></div>
      </div>
      <div class="form-group">
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        <div id="password-error" class="error-message"><?php echo isset($errorMessages['password']) ? $errorMessages['password'] : ''; ?></div>
        <a href="forgot.php">Quên mật khẩu?</a>
      </div>
      <button type="submit" name="login">Đăng Nhập</button>
      <div class="form-links">
        <a href="register.php">Đăng Ký</a>
      </div>
      <div id="general-error" class="error-message"><?php echo isset($errorMessages['general']) ? $errorMessages['general'] : ''; ?></div>
    </form>
  </div>
  <footer>
    <!-- JavaScript nội tuyến -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const usernameError = document.getElementById('username-error');
        const passwordError = document.getElementById('password-error');
        const generalError = document.getElementById('general-error');

        // Xác thực tên đăng nhập (email)
        usernameInput.addEventListener('input', function () {
          const usernameValue = usernameInput.value.trim();
          if (usernameValue === '') {
            usernameError.textContent = 'Tên đăng nhập (email) là bắt buộc';
            usernameError.style.display = 'block';
          } else if (!/\S+@\S+\.\S+/.test(usernameValue)) {
            usernameError.textContent = 'Vui lòng nhập một địa chỉ email hợp lệ';
            usernameError.style.display = 'block';
          } else {
            usernameError.style.display = 'none';
          }
        });

        // Xác thực mật khẩu
        passwordInput.addEventListener('input', function () {
          const password = passwordInput.value;
          if (password.trim() === '') {
            passwordError.textContent = 'Mật khẩu là bắt buộc';
            passwordError.style.display = 'block';
          } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password) || !/[\W]/.test(password)) {
            passwordError.textContent = 'Mật khẩu phải chứa ít nhất một số, một chữ cái và một ký tự đặc biệt';
            passwordError.style.display = 'block';
          } else {
            passwordError.style.display = 'none';
          }
        });

        // Hiển thị thông báo lỗi chung
        document.querySelector('form').addEventListener('submit', function () {
          if (usernameError.style.display === 'block' || passwordError.style.display === 'block') {
            generalError.textContent = 'Vui lòng sửa các lỗi trên';
            generalError.style.display = 'block';
            return false; // Ngăn chặn việc gửi biểu mẫu
          }
          return true; // Cho phép gửi biểu mẫu
        });
      });
    </script>
  </footer>
</body>
</html>
