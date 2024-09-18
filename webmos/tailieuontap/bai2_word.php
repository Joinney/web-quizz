<?php


// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học MOS Cơ Bản</title>
    <link rel="stylesheet" href="../Css/main.css">
    <link rel="stylesheet" href="../Css/ontap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <style>


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
                    <img src="../img/LogoMOS.jpg" alt="MOS Learning Logo">
                </a></li>
    
                <li><a href="../index.php">Trang Chủ</a></li>
                <li><a href="#tutorials">Giới Thiệu </a></li>            
                <li><a href="../tai-lieu.html" class="active">Tài liệu</a></li>
                <li><a href="../diendan.php" class="active">Diễn đàn</a></li>
                <li><a href="../kiemtra.php">Kiểm Tra</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="../lienhe.php" class="active">Liên hệ</a></li>
                <li><a href="../login.php" class="btn">Đăng nhập</a></li>
                <li><a href="../register.php" class="btn">Đăng ký</a></li>
            </ul>
        </div>
    </nav>
  <!-- phần main ở đây -->

  <sectiont class="course row" id="course">
  <h2>Bài 2 – Soạn thảo văn bản</h2>
    <div class="col-3-4 layout">
        <!-- Nội dung bài -->
        <div class="row lession">
            <div class="lession-content">
                <!-- Phần 1 -->
                <div class="" id="II-LaMa">
                    <h5>
                        <span><strong>I. Khái niệm văn bản</strong></span>
                    </h5>
                    <div>
                        <p class="sub-title-lession" id="muc-1">
                            <span><strong>1. Định nghĩa văn bản</strong></span>
                        </p>
                        <li class="list-item-l1">Văn bản là một tập hợp các ký tự được sắp xếp theo một cấu trúc nhất định để truyền tải thông tin. Trong Microsoft Word, văn bản có thể bao gồm chữ, số, và các ký hiệu khác.</li>
                        <li class="list-item-l1">Văn bản có thể được tạo ra từ các phần mềm xử lý văn bản hoặc được sao chép từ các nguồn khác và dán vào tài liệu.</li>
                    </div>
                    <div>
                        <p class="sub-title-lession" id="muc-2">
                            <span><strong>2. Các loại văn bản</strong></span>
                        </p>
                        <li class="list-item-l1">Văn bản đơn giản: Chỉ bao gồm văn bản cơ bản mà không có định dạng đặc biệt.</li>
                        <li class="list-item-l1">Văn bản định dạng: Có áp dụng các kiểu định dạng như chữ đậm, chữ nghiêng, gạch chân, và các thuộc tính định dạng khác.</li>
                        <li class="list-item-l1">Văn bản đa phương tiện: Bao gồm hình ảnh, bảng biểu, liên kết, và các yếu tố khác ngoài văn bản thuần túy.</li>
                    </div>
                </div>
                <!-- Kết thúc Phần I -->

                <!-- Phần 2 -->
                <div id="III-LaMa">
                    <h5>
                        <span><strong>II. Các thao tác với một tệp văn bản</strong></span>
                    </h5>
                    <div>
                        <p class="sub-title-lession" id="muc-3">
                            <span><strong>1. Mở và đóng tệp văn bản</strong></span>
                        </p>
                        <li class="list-item-l1">Để mở một tệp văn bản, bạn có thể nhấp vào File (Tệp) trên thanh Ribbon, chọn Open (Mở), và duyệt đến vị trí của tệp văn bản bạn muốn mở.</li>
                        <li class="list-item-l1">Để đóng một tệp văn bản, nhấp vào biểu tượng X ở góc trên bên phải của cửa sổ tài liệu hoặc chọn File (Tệp) > Close (Đóng).</li>
                    </div>
                    <div>
                        <p class="sub-title-lession" id="muc-4">
                            <span><strong>2. Lưu và lưu dưới dạng mới</strong></span>
                        </p>
                        <li class="list-item-l1">Để lưu tệp văn bản, nhấp vào biểu tượng Save (Lưu) trên thanh công cụ nhanh hoặc chọn File (Tệp) > Save (Lưu).</li>
                        <li class="list-item-l1">Để lưu tệp dưới dạng mới, chọn File (Tệp) > Save As (Lưu dưới dạng) và chọn một vị trí khác hoặc đổi tên tệp tài liệu.</li>
                    </div>
                    <div>
                        <p class="sub-title-lession" id="muc-5">
                            <span><strong>3. Xóa và phục hồi tệp văn bản</strong></span>
                        </p>
                        <li class="list-item-l1">Để xóa một tệp văn bản, bạn có thể nhấp chuột phải vào tệp và chọn Delete (Xóa). Tệp sẽ được đưa vào thùng rác hoặc Recycle Bin.</li>
                        <li class="list-item-l1">Để phục hồi một tệp đã xóa, mở thùng rác, tìm tệp, nhấp chuột phải vào tệp và chọn Restore (Khôi phục).</li>
                    </div>
                </div>
                <!-- Kết thúc Phần II -->

                <!-- Phần 3 -->
                <div id="IV-LaMa">
                    <h5>
                        <span><strong>III. Định dạng khổ giấy và đặt lề văn bản</strong></span>
                    </h5>
                    <div>
                        <p class="sub-title-lession" id="muc-6">
                            <span><strong>1. Định dạng khổ giấy</strong></span>
                        </p>
                        <li class="list-item-l1">Để thay đổi khổ giấy, chọn tab Layout (Bố cục) trên thanh Ribbon, sau đó nhấp vào Size (Kích thước) và chọn khổ giấy mong muốn từ danh sách.</li>
                        <li class="list-item-l1">Bạn cũng có thể chọn More Paper Sizes (Kích thước giấy khác) để nhập kích thước tùy chỉnh cho khổ giấy của bạn.</li>
                    </div>
                    <div>
                        <p class="sub-title-lession" id="muc-7">
                            <span><strong>2. Đặt lề văn bản</strong></span>
                        </p>
                        <li class="list-item-l1">Để thay đổi lề văn bản, chọn tab Layout (Bố cục) trên thanh Ribbon và nhấp vào Margins (Lề). Chọn một kiểu lề có sẵn hoặc nhấp vào Custom Margins (Lề tùy chỉnh) để nhập kích thước lề cụ thể.</li>
                        <li class="list-item-l1">Bạn có thể điều chỉnh các lề trên, dưới, trái, phải để phù hợp với nhu cầu của tài liệu.</li>
                    </div>
                    <div>
                        <p class="sub-title-lession" id="muc-8">
                            <span><strong>3. Căn chỉnh và phân chia văn bản</strong></span>
                        </p>
                        <li class="list-item-l1">Sử dụng các công cụ căn chỉnh (trái, giữa, phải, đều) trên tab Home (Trang chủ) để thay đổi cách văn bản được căn chỉnh trong tài liệu.</li>
                        <li class="list-item-l1">Bạn cũng có thể thêm phân chia trang hoặc phân chia cột để tổ chức văn bản theo cách phù hợp.</li>
                    </div>
                </div>
                <!-- Kết thúc Phần III -->
            </div>
        </div>
    </div>
    <!-- Kết thúc Nội dung bài -->

    <!-- Mục lục -->
    <div class="col-1-4 card-table-content">
        <div class="card-header">
            <h4 class="card-title">Mục lục</h4>
        </div>
        <div class="card-body">
            <div class="table-of-content">
                <!-- toc = table of content -->
                <div class="toc-container"></div>
                <navs class="toc-links">
                    <ul class="toc-list toc-list-level-1">
                        <a href="#II-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">I. Khái niệm văn bản</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-1" class="heading-1">1. Định nghĩa văn bản</a>
                            <a href="#muc-2" class="heading-1">2. Các loại văn bản</a>
                        </li>
                    </ul>
                    <ul class="toc-list toc-list-level-1">
                        <a href="#III-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">II. Các thao tác với một tệp văn bản</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-3" class="heading-1">1. Mở và đóng tệp văn bản</a>
                            <a href="#muc-4" class="heading-1">2. Lưu và lưu dưới dạng mới</a>
                            <a href="#muc-5" class="heading-1">3. Xóa và phục hồi tệp văn bản</a>
                        </li>
                    </ul>
                    <ul class="toc-list toc-list-level-1">
                        <a href="#IV-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">III. Định dạng khổ giấy và đặt lề văn bản</a>
                        <li class="loc-page-1 toc-heading-level-2">
                            <a href="#muc-6" class="heading-1">1. Định dạng khổ giấy</a>
                            <a href="#muc-7" class="heading-1">2. Đặt lề văn bản</a>
                            <a href="#muc-8" class="heading-1">3. Căn chỉnh và phân chia văn bản</a>
                        </li>
                    </ul>
                </navs>
            </div>
        </div>
    </div>
</sectiont>



<!-- phần end main -->

<section1 id="section__footer" class="body__section">
    <div id="block__logo" class="block__footer">
        <li class="logo-item">
            <a href="" class="logo">
                <img src="../img/LogoMOS.jpg" alt="MOS Learning Logo">
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
</section1>

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

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
       <script src="Js/theodoichungtoi.js"></script> 

</body>
</html>
