<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS Cơ Bản</title>
    <link rel="stylesheet" href="Css/main.css">
    <link rel="stylesheet" href="Css/lienhe.css">
</head>
<body>
    <!-- Top Bar with Contact Information and Social Media Links -->
  <div class="top-bar">
        <div class="left">
            <a href="tel:0933008831">📞 0933 008831</a>
            <a href="#">08:00 - 17:00</a>
        </div>
        <div class="right social-icons">
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://github.com" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
            <a href="https://zalo.me" target="_blank" rel="noopener noreferrer" aria-label="Zalo">
                <i class="fab fa-whatsapp"></i> <!-- Zalo icon is not available in Font Awesome, using WhatsApp as placeholder -->
            </a>
        </div>
    </div>
    <!-- Thanh điều hướng -->
    <nav>
        <div class="container">
            
            <ul class="nav-links">
                <li class="logo-item"><a href="#" class="logo">
                    <img src="./img/LogoMOS.jpg" alt="MOS Learning Logo">
                </a></li>
    
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="gioithieu.php">Giới Thiệu </a></li>            
                <li><a href="tailieu.php" class="active">Tài liệu</a></li>
                <li><a href="diendan.php" class="active">Diễn đàn</a></li>
                <li class="nav-user-info">
                    <a href="kiemtra.php">Kiểm Tra</a>
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
                                echo '<li><a href="./kiemtra.php?id=' . $idDanhMuc . '">' . $tenDanhMuc . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="#">No categories found.</a></li>';
                        }

                        mysqli_close($conn3);
                        ?>
                    </ul>
                </li>
                <li><a href="tintuc.php">Tin tức</a></li>
                <li><a href="lienhe.php" class="active">Liên hệ</a></li>
                <li><a href="login.php" class="btn">Đăng nhập</a></li>
                <li><a href="register.php" class="btn">Đăng ký</a></li>
            </ul>
             
        </div>
    </nav>
         <!-- Thêm thanh tìm kiếm -->
         <div class="search-container">
                    <form action="timkiem.php" method="get" class="search-form">
                        <input type="text" name="query" placeholder="Tìm kiếm...">
                        <button type="submit">Tìm</button>
                    </form>
                </div>
    
    <div class="body-lienhe">
        <div class="lienhe-header">Liên hệ</div>
        <div class="lienhe-info">
            <div class="info-left">
                <p>
                    <h2 style="color: gray"> TRUNG TÂM HỌC MOS - G5TD </h2><br />
                    <b>Địa chỉ:</b> 194 Võ Văn Kiệt, phường 3, Quận 1, TPHCM<br /><br />
                    <b>Telephone:</b> 055 6935 5559<br /><br />
                    <b>Hotline:</b> 0977744477 - CSKH: 015 0597 337<br /><br />
                    <b>Website:</b> <a href="https://github.com/Joinney/web-new">Github</a> <br /><br />
                    <b>E-mail:</b> web@gmail.com<br /><br />
                    <b>Mã số thuế:</b> 01 02 03 04 05<br /><br />
                    <b>Tài khoản ngân hàng :</b><br /><br />
                    <b>Số TK:</b> 060008086888 <br /><br />
                    <b>Tại Ngân hàng:</b> MBbank Chi nhánh Sài Gòn<br /><br /><br /><br />
                    <b>Quý khách có thể gửi liên hệ tới chúng tôi bằng cách hoàn tất biểu mẫu dưới đây. Chúng tôi
                        sẽ trả lời thư của quý khách, xin vui lòng khai báo đầy đủ. Hân hạnh phục vụ và chân thành
                        cảm ơn sự quan tâm, đóng góp ý kiến đến Glasses Store.</b>
                </p>
            </div>
            <div class="info-right">
                <iframe width="100%" height="450" src="https://maps.google.com/maps?width=100%&amp;height=450&amp;hl=en&amp;coord=10.759660000323064,106.68192160315813&amp;q=273%20An%20D%C6%B0%C6%A1ng%20V%C6%B0%C6%A1ng%20Ph%C6%B0%E1%BB%9Dng%203%20Qu%E1%BA%ADn%205%20H%E1%BB%93%20Ch%C3%AD%20Minh%20700000%2C%20Vi%E1%BB%87t%20Nam+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=B&amp;output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Embed
                        Google Map
                    </a>
                </iframe>
                <br />
            </div>
        </div>
        <div class="lienhe-info">

            <div class="guithongtin">
                <p style="font-size: 22px; color: gray">Gửi thông tin liên lạc cho chúng tôi: </p>
                <hr />
                <form name="formlh" onsubmit="return nguoidung()">
                    <table cellspacing="10px">
                        <tr>
                            <td>Họ và tên</td>
                            <td><input type="text" name="ht" size="40" maxlength="40" placeholder="Họ tên"
                                    autocomplete="off" required></td>
                        </tr>
                        <tr>
                            <td>Điện thoại liên hệ</td>
                            <td><input type="text" name="sdt" size="40" maxlength="11" minlength="10" placeholder="Điện thoại"
                                    required></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ Email</td>
                            <td><input type="email" name="em" size="40" placeholder="Email" autocomplete="off"
                                    required></td>
                        </tr>
                        <tr>
                            <td>Tiêu đề</td>
                            <td><input type="text" name="tde" size="40" maxlength="100" placeholder="Tiêu đề"
                                    required>
                        </tr>
                        <tr>
                            <td>Nội dung</td>
                            <td><textarea name="nd" rows="5" cols="44" maxlength="500" wrap="physical"
                                    placeholder="Nội dung liên hệ" required></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit">Gửi thông tin liên hệ</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="thongtinnhom">
                <p style="font-size: 22px; color: gray">Thông tin thành viên nhóm: </p>
                <hr />
                <table>
                    <tr>
                        <th>Họ tên</th>
                        <th>MSSV</th>
                        <th>Giới tính</th>
                        <th>Lớp</th>
                        <th>Tỉ lệ công việc</th>
                    </tr>
                    <script>
                        var thongtin = [
                            
                            ["Võ Duy Toàn", "2200002076", "Nam", "22BITV02", "100%"],
                            ["Nguyễn Thị Huyền Diệu", "2200001765", "Nữ", "22BITV02", "100%"],
                            ["Phan Minh Thuận", "2200010286", "Nam", "22BITV02", "100%"],
                            ["Lê Đoàn Anh Tuấn", "2200010939", "Nam", "22BITV02", "100%"],
                            ["Nguyễn Văn Thuận", "2200009501", "Nam", "22BITV02", "100%"],
                            ["Lê Thanh Trọng", "2200001234", "Nam", "22BITV02", "100%"]
                        ]
                        for (var i = 0; i < thongtin.length; i++) {
                            document.write(
                                `
                                <tr>
                                    <td>` +
                                thongtin[i][0] + `</td>
                                    <td>` +
                                thongtin[i][1] + `</td>
                                    <td>` +
                                thongtin[i][2] + `</td>
                                    <td>` +
                                thongtin[i][3] + `</td>
                                    <td>` +
                                thongtin[i][4] +
                                `</td>
                                </tr>
                            `
                            )
                        }
                    </script>
                </table>
            </div>

        </div>
    </div>
</section>






    <section id="section__footer" class="body__section">
    <div id="block__logo" class="block__footer">
        <li class="logo-item">
            <a href="" class="logo">
                <img src="./img/LogoMOS.jpg" alt="MOS Learning Logo">
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
        <div class="right social-icons">
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://github.com" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
            <a href="https://zalo.me" target="_blank" rel="noopener noreferrer" aria-label="Zalo">
                <i class="fab fa-whatsapp"></i> <!-- Zalo icon is not available in Font Awesome, using WhatsApp as placeholder -->
            </a>
        </div>
    </div>
</section>

    <!-- Chân trang -->
    <footer>
        <div class="container">
            <p>&copy; 2024 MOSLearning. All rights reserved.</p>
            
        </div>
    </footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        });
    });
</script>

</body>
</html>
