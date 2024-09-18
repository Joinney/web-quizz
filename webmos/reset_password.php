
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Successful</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e2e2e2, #ffffff); /* Background gradient */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            text-align: center;
            padding: 20px;
        }

        .message-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .message-container h1 {
            font-size: 1.5rem;
            color: #333;
        }

        .message-container p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px; /* Space between text and button */
        }

        .login-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ffc800;
            color: #fff;
            font-size: 1.1rem;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;
            width: 100%; /* Make the button stretch to full width */
            max-width: 200px; /* Limit the maximum width of the button */
            margin: 0 auto; /* Center the button */
        }

        .login-button:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .login-button:active {
            background-color: #004494;
            transform: translateY(1px);
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Password Reset Successful</h1>
        <?php
if (isset($_POST['verify_otp'])) {
    // Kiểm tra xem biến email và mật khẩu mới có được thiết lập không
    if (isset($_POST['email'], $_POST['new_password'], $_POST['confirm_password'])) {
        // Lấy dữ liệu từ form và loại bỏ khoảng trắng thừa
        $email = trim($_POST['email']);
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Hiển thị email nhận được từ form
        echo "Email nhận được: " . htmlspecialchars($email) . "<br>";

        // Kiểm tra định dạng email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email không hợp lệ.";
            exit();
        }

        // Kiểm tra mật khẩu có chứa số, chữ cái và ký tự đặc biệt không
        if (!preg_match('/[0-9]/', $new_password) || !preg_match('/[a-zA-Z]/', $new_password) || !preg_match('/[\W]/', $new_password)) {
            echo "<script>alert('Mật khẩu phải chứa ít nhất một số, một chữ cái và một ký tự đặc biệt');</script>";
            exit;
        }

        // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp không
        if ($new_password === $confirm_password && strlen($new_password) >= 6) {
            // Kết nối với cơ sở dữ liệu
            $conn = new mysqli("localhost", "root", "", "webmos");

            if ($conn->connect_error) {
                die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
            }

            // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
            $sql = "SELECT * FROM taikhoan WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Email tồn tại, tiếp tục với logic đặt lại mật khẩu
                $update_sql = "UPDATE taikhoan SET password = ? WHERE username = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param('ss', $new_password, $email);

                if ($update_stmt->execute()) {
                    echo "Mật khẩu đã được đặt lại thành công.";
                } else {
                    echo "Lỗi khi cập nhật mật khẩu. Vui lòng thử lại sau.";
                }
                $update_stmt->close(); // Đóng câu lệnh sau khi thực hiện
            } else {
                // Email không tồn tại
                echo "Email không tồn tại trong cơ sở dữ liệu.";
            }

            // Đóng câu lệnh và kết nối
            $stmt->close();
            $conn->close();
        } else {
            echo "Mật khẩu không khớp hoặc không đủ điều kiện. Vui lòng thử lại.";
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin.";
    }
}
?>
        <p>Your password has been successfully reset. You can now log in with your new password.</p>
        <a href="login.php" class="login-button">Log In</a>
    </div>
</body>
</html>
