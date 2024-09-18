<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách tài khoản từ cơ sở dữ liệu
$sql = "SELECT * FROM taikhoan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tài khoản</title>
    <link rel="stylesheet" href="../../Css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <style>
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"]{
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
        button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
        button:hover:not(:disabled) {
            background-color: #45a049;
        }
        button + button {
            background-color: #f44336;
            margin-left: 10px;
        }
        button + button:hover {
            background-color: #d73727;
        }
        td button {
            margin-right: 5px;
            background-color: #007BFF;
        }
        td button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
  <!-- Top Bar with Contact Information and Social Media Links -->
  <div class="top-bar">
        <div class="left">
            <a href="tel:0933008831">📞 0933 008831</a>
            <a href="#">08:00 - 17:00</a>
        </div>
        <div class="right social-icons">
            <a href="https://www.facebook.com/YourPage" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://github.com/YourPage" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
            <a href="https://zalo.me/YourPage" target="_blank" rel="noopener noreferrer" aria-label="Zalo">
                <i class="fab fa-whatsapp"></i> <!-- Zalo icon is not available in Font Awesome, using WhatsApp as placeholder -->
            </a>
        </div>
    </div>
    

      <!-- Thanh điều hướng -->
   <nav>
        <div class="container">
            
            <ul class="nav-links">
                <li class="logo-item"><a href="#" class="logo">
                    <img src="../../img/LogoMOS.jpg" alt="MOS Learning Logo">
                </a></li>
    
                <li><a href="../../Giaodienusers/index.php">Trang Chủ</a></li>
                <li><a href="../../Giaodienusers/gioithieu.php">Giới Thiệu </a></li>            
                <li><a href="../../Giaodienusers/tailieu.php" class="active">Tài liệu</a></li>
                <li><a href="../../Giaodienusers/diendan.php" class="active">Diễn đàn</a></li>
                <li class="nav-user-info">
                    <a href="../../Giaodienusers/kiemtra.php">Kiểm Tra</a>
                    <ul class="dropdown">
                        <?php
                        $conn3 = mysqli_connect("localhost", "root", "", "webmos");

                        if (!$conn3) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql3 = "SELECT * FROM danhmuc";
                        $ketqua3 = mysqli_query($conn3, $sql3);

                        if (mysqli_num_rows($ketqua3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($ketqua3)) {
                                $idDanhMuc = htmlspecialchars($row3['iddanhmuc']);
                                $tenDanhMuc = htmlspecialchars($row3['tendanhmuc']);
                                echo '<li><a href="../../Giaodienusers/kiemtra.php?id=' . $idDanhMuc . '">' . $tenDanhMuc . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="#">No categories found.</a></li>';
                        }

                        mysqli_close($conn3);
                        ?>
                    </ul>
                </li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="../../Giaodienusers/lienhe.php" class="active">Liên hệ</a></li>
                <?php if (isset($_SESSION['hoten'])): ?>
                        <li class="nav-user-info">
                            <span class="user-name">Xin chào, <?php echo $_SESSION['hoten']; ?>!</span>
                            <div class="user-dropdown">
                                <a href="profile.php">Thông tin cá nhân</a>
                                <a href="change_password.php">Đổi mật khẩu</a>
                               
                            </div>
                            <a href="../../index.php" class="btn">Đăng xuất</a>
                        </li>
                        
                    <?php else: ?>
                        <li><a href="login.php" class="btn">Đăng nhập</a></li>
                    <?php endif; ?>
            </ul>
            
        </div>
    </nav>
    <!-- Thêm thanh tìm kiếm -->
    <div class="search-container">
                <form action="../../timkiem.php" method="get" class="search-form">
                    <input type="text" name="query" placeholder="Tìm kiếm...">
                    <button type="submit">Tìm</button>
                </form>
            </div>
    
    <!-- PHẦN THÂN Ở ĐÂY -->
    <h2>Quản lý Tài khoản</h2>
     <!-- Danh sách tài khoản -->
     <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Tên đăng nhập</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP để hiển thị danh sách tài khoản -->
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idtaikhoan"] . "</td>";
                    echo "<td>" . $row["hoten"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["diachi"] . "</td>";
                    echo "<td>" . $row["sdt"] . "</td>";
                    echo "<td>
                        <button type='button' onclick=\"editAccount('" . $row["idtaikhoan"] . "', '" . $row["hoten"] . "', '" . $row["username"] . "', '" . $row["diachi"] . "', '" . $row["sdt"] . "')\">Sửa</button>
                        <form action='themxoasuatk.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='idtaikhoan' value='" . $row["idtaikhoan"] . "'>
                            <button type='submit' name='action' value='delete'>Xóa</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có tài khoản nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>


    <!-- Form thêm/sửa tài khoản -->
    <form action="themxoasuatk.php" method="POST">
        <input type="hidden" name="idtaikhoan" id="idtaikhoan" value="">
        <label for="hoten">Họ tên:</label>
        <input type="text" id="hoten" name="hoten" required>
        
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>
        
      
        
        <label for="diachi">Địa chỉ:</label>
        <input type="text" id="diachi" name="diachi">
        
        <label for="sdt">Số điện thoại:</label>
        <input type="text" id="sdt" name="sdt">
        
       
        <button type="submit" name="action" value="update" disabled>Sửa</button>
    </form>

   


    
    <section id="section__footer" class="body__section">
    <div id="block__logo" class="block__footer">
        <li class="logo-item">
            <a href="" class="logo">
                <img src="../../img/LogoMOS.jpg" alt="MOS Learning Logo">
            </a>
        </li>
        
    </div>
    <div id="block__address" class="block__footer">
        <p class="footer-title">Work Place</p>
        <div class="footer-description">
            <p>NTT Institute of International Education</p>
            <p>458/3F Nguyen Huu Tho Str.</p>
            <p> Dist. 7, HCMC</p>
        </div>
    </div>
    <div id="block__contact" class="block__footer">
        <p class="footer-title">Contact me</p>
        <div class="footer-description">
            <p>(+84) 97 975 87 44</p>
            <p>voduyduydlk@gmail.com</p>
        </div>
    </div>
    <div id="block__followMe" class="block__footer">
        <p class="footer-title">Contact me</p>
        <div class="contact-icons">
            <a href="https://www.facebook.com/zVoDuyToanz"><i class="bx bxl-facebook"></i></a>
            <a href="https://github.com/Joinney"><i class="bx bxl-github"></i></a>
            <a href=""><i class="bx bxl-instagram"></i></a>
        </div>
    </div>
</section>

    <!-- Chân trang -->
    <footer>
        <div class="container">
            <p>&copy; 2024 MOSLearning. All rights reserved.</p>
            
        </div>
    </footer>
    <script>
        function editAccount(id, hoten, username, diachi, sdt) {
            document.getElementById('idtaikhoan').value = id;
            document.getElementById('hoten').value = hoten;
            document.getElementById('username').value = username;
            document.getElementById('diachi').value = diachi;
            document.getElementById('sdt').value = sdt;
            document.querySelector('button[name="action"][value="update"]').disabled = false;
        }
    </script>

</body>
</html>

<?php
$conn->close();
?>
