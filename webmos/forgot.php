<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./Css/login.css"> <!-- Include your Bootstrap CSS -->
    
    
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <!-- Form for Sending OTP -->
                    <form id="step1Form" action="send_email.php" method="post" class="forgot-form">
                        <div id="step1">
                            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3">Forgot Password</p>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email"><i class="bi bi-envelope"></i> Email</label>
                                <input type="email" id="email" class="form-control form-control-lg py-3" name="email" placeholder="Enter your email" required />
                                <div id="emailError" class="form-error" style="display: none;">Please enter a valid email address.</div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="send_otp" value="Send OTP" class="btn btn-warning btn-lg text-light" style="border-radius: 30px; font-weight:600;" />
                            </div>
                        </div>
                    </form>

                    <!-- Form for OTP Verification and Password Reset -->
                    <form id="step2Form" action="reset_password.php" method="post" class="forgot-form" style="display:none;">
                        <div id="step2">
                            <input type="hidden" id="hiddenEmail" name="email"> <!-- Hidden input for email -->
                            <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3">Xác minh OTP và đặt lại mật khẩu</p>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="otp"><i class="bi bi-key"></i> OTP</label>
                                <input type="text" id="otp" class="form-control form-control-lg py-3" name="otp" placeholder="Enter OTP" required />
                                <div id="otpError" class="form-error" style="display: none;">Vui lòng nhập mã OTP được gửi đến email của bạn.</div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="new_password"><i class="bi bi-lock"></i> New Password</label>
                                <input type="password" id="new_password" class="form-control form-control-lg py-3" name="new_password" placeholder="Enter new password" required />
                                <div id="newPasswordError" class="form-error" style="display: none;">Mật khẩu phải dài ít nhất 6 ký tự.</div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="confirm_password"><i class="bi bi-lock"></i> Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control form-control-lg py-3" name="confirm_password" placeholder="Confirm new password" required />
                                <div id="confirmPasswordError" class="form-error" style="display: none;">Mật khẩu không khớp.</div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="verify_otp" value="Reset Password" class="btn btn-warning btn-lg text-light" style="border-radius: 30px; font-weight:600;" />
                            </div>
                        </div>
                    </form>
                    <p class="text-center mt-4"><a href="login.php" class="text-warning" style="font-weight:600;text-decoration:none;">Back to Login</a></p>
                </div>
            </div>
        </div>
    </section>

    <script>
      document.getElementById('step1Form').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn gửi form mặc định

        const email = document.getElementById('email').value;
        const emailError = document.getElementById('emailError');

        // Xác thực phía máy khách đơn giản
        if (!email || !validateEmail(email)) {
            emailError.style.display = 'block';
            return;
        } else {
            emailError.style.display = 'none';
        }

        // Yêu cầu AJAX để gửi email
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_email.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Sao chép email vào trường ẩn trong step2Form
                    document.getElementById('hiddenEmail').value = email;
                    // Hiển thị bước 2 và ẩn bước 1
                    document.getElementById('step2Form').style.display = 'block';
                    document.getElementById('step1Form').style.display = 'none';
                } else {
                    emailError.textContent = response.message || 'Gửi OTP thất bại. Vui lòng thử lại.';
                    emailError.style.display = 'block';
                }
            } else {
                emailError.textContent = 'Gửi OTP thất bại. Vui lòng thử lại.';
                emailError.style.display = 'block';
            }
        };
        xhr.send('email=' + encodeURIComponent(email));
    });

    document.getElementById('step2Form').addEventListener('submit', function(event) {
        const otp = document.getElementById('otp').value;
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        let valid = true;

        if (!otp) {
            document.getElementById('otpError').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('otpError').style.display = 'none';
        }

        if (newPassword.length < 6) {
            document.getElementById('newPasswordError').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('newPasswordError').style.display = 'none';
        }

        if (newPassword !== confirmPassword) {
            document.getElementById('confirmPasswordError').style.display = 'block';
            valid = false;
        } else {
            document.getElementById('confirmPasswordError').style.display = 'none';
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    // Hàm tiện ích để xác thực định dạng email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    </script>
</body>
</html>
