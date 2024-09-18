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
<h2>Bài 1 - Làm quen với Microsoft Word 2013</h2>
            <div class="col-3-4 layout">
                <!--Nội dung bài-->
                <div class="row lession">
                    <div class="lession-content">
                        <!--nội dung phần I-->
                        <div class="" id="I-LaMa">
                            <h5>
                                <span><strong>I.  Khởi động chương trình</strong></span>
                            </h5>

                            <!--Mục 1 nhỏ-->
                            <div>
                                <p class="sub-title-lession" id="muc-1">
                                    <span>
                                        <strong>1. Mở Microsoft Word 2013</strong>
                                    </span>
                                </p>
                                <div id="muc-1-pg1">
                                    <p><strong><em>a. Trên Windows</em></strong></p>
                                <li class="list-item-l1">Trên máy tính Windows, nhấp vào nút Start (Bắt đầu).</li>
                                <li class="list-item-l1">Tìm và chọn Microsoft Word 2013 từ danh sách các ứng dụng hoặc gõ "Word" vào thanh tìm kiếm và chọn ứng dụng.</li>
                                <li class="list-item-l1">Một cách khác là nhấp đúp vào biểu tượng của Microsoft Word trên màn hình chính hoặc thanh tác vụ nếu bạn đã ghim nó ở đó.</li>
                                </div>
                                <div id="muc-1-pg2">
                                    <p><strong><em>b. Trên Windows 8/10</em></strong></p>
                                <li class="list-item-l1">Di chuyển chuột đến góc dưới bên trái màn hình để mở menu Start hoặc nhấn phím Windows trên bàn phím.</li>
                                <li class="list-item-l1">Gõ "Word" vào ô tìm kiếm, sau đó chọn Microsoft Word 2013 từ kết quả tìm kiếm.</li>
                                </div>
                            </div>

                            
                        </div>
                        <!--hết Phần I-->

                        <!--Phần II-->
                        <div id="II-LaMa">
                           <h5>
                            <span>
                                <strong>II. Tạo một văn bản mới</strong>
                            </span>
                           </h5>

                           <!--Mục 1 nhỏ-->
                           <div>
                                <p class="sub-title-lession" id="muc-2">
                                    <span><strong>1. Mở văn bản mới</strong></span>
                                </p>
                                <div id="muc2-1-pg1">
                                    <p><strong><em>a. Khi Microsoft Word 2013 khởi động</em></strong></p>
                                    <li class="list-item-l1">Trên màn hình bắt đầu, bạn sẽ thấy các tùy chọn cho các mẫu tài liệu và một tùy chọn để tạo tài liệu trống. Nhấp vào Blank Document (Tài liệu trống) để bắt đầu một tài liệu mới.</li>

                                </div>
                                <div id="muc2-1-pg2">
                                   <p><strong><em>b. Từ menu File</em></strong></p>
                                   <li class="list-item-l1">Nếu bạn đã mở một tài liệu hiện có hoặc đang ở trong một phiên bản của Word, hãy nhấp vào tab File ở góc trên bên trái.</li>
                                   <li class="list-item-l1">Chọn New (Tạo mới) từ menu bên trái. Trong cửa sổ xuất hiện, chọn Blank Document để tạo một tài liệu trống mới.</li>
                   
                                </div>
                           </div>

                        </div>

                        <!--Phần III-->
                        <div id="III-LaMa">
                            <h5>
                                <span>
                                    <strong>III.  Giới thiệu thanh Ribbon</strong>
                                </span>
                            </h5>
                            
                            <!--Mục 1 nhỏ-->
                            <div>
                                <p class="sub-title-lession" id="muc-3">
                                    <span><strong>1. Thanh Ribbon </strong></span>
                                </p>
                                <li class="list-item-l1">Thanh Ribbon là một phần của giao diện người dùng trong Microsoft Word, nằm ngay phía trên cùng của cửa sổ ứng dụng. Nó được chia thành các tab, mỗi tab chứa các công cụ và lệnh liên quan.</li>
                                <div id="muc-1-pg1">
                                    <p><strong><em>Các tab chính bao gồm: </em></strong></p>
                                    <li class="list-item-l1">Home (Trang chủ): Các công cụ cơ bản cho định dạng văn bản, sao chép, cắt, dán, và các công cụ khác.</li>
                                    <li class="list-item-l1">Insert (Chèn): Các tùy chọn để chèn hình ảnh, bảng, liên kết, biểu đồ và các đối tượng khác vào tài liệu.</li>
                                    <li class="list-item-l1">Page Layout (Bố cục trang): Các công cụ để điều chỉnh bố cục trang, lề, kích thước giấy, và các tùy chọn hướng trang.</li>
                                    <li class="list-item-l1">References (Tài liệu tham khảo): Các công cụ để thêm chú thích, mục lục, và các phần tài liệu tham khảo khác.</li>
                                    <li class="list-item-l1">Mailings (Gửi thư): Các công cụ để gửi thư dạng hàng loạt và các tài liệu liên quan đến gửi thư.</li>
                                    <li class="list-item-l1">Review (Xem xét): Các công cụ để kiểm tra chính tả, ngữ pháp, và cộng tác với các tính năng như theo dõi thay đổi.</li>
                                    <li class="list-item-l1">View (Xem): Các tùy chọn để thay đổi cách bạn xem tài liệu, bao gồm chế độ đọc, chế độ xem nhiều trang, và chế độ xem phân chia.</li>
                                </div>   
                            </div>

                            
                        </div>


                        <!--Phần IV-->
                        <div id="IV-LaMa">
                           <h5>
                            <span>
                                <strong>IV. Thanh công cụ nhanh</strong>
                            </span>
                           </h5>

                           <!--Mục 1 nhỏ-->
                           <div>
                                <p class="sub-title-lession" id="muc-4">
                                    <span><strong>1. Thanh công cụ nhanh</strong></span>
                                </p>
                                <div id="muc4-1-pg1">
                                    <p><strong><em>a. Thanh công cụ nhanh</em></strong></p>
                                    <li class="list-item-l1">Thanh công cụ nhanh nằm ngay trên thanh Ribbon, phía trên bên trái của cửa sổ ứng dụng. Đây là nơi bạn có thể truy cập nhanh vào các lệnh thường xuyên sử dụng như Save (Lưu), Undo (Hoàn tác), Redo (Làm lại), và Print (In).</li>

                                </div>
                                <div id="muc4-1-pg2">
                                   <p><strong><em>b. Tùy chỉnh thanh công cụ nhanh</em></strong></p>
                                   <li class="list-item-l1">Nhấp vào mũi tên xuống ở cuối thanh công cụ nhanh để mở menu tùy chọn.</li>
                                   <li class="list-item-l1">Bạn có thể chọn thêm các lệnh khác vào thanh công cụ nhanh hoặc xóa các lệnh không cần thiết.</li>
                   
                                </div>
                           </div>

                        </div>



                        <!--Phần V-->
                        <div id="V-LaMa">
                           <h5>
                            <span>
                                <strong>V. Office Button</strong>
                            </span>
                           </h5>

                           <!--Mục 1 nhỏ-->
                           <div>
                                <p class="sub-title-lession" id="muc-5">
                                    <span><strong>1. Office Button</strong></span>
                                </p>
                                <div id="muc5-1-pg1">
                                    <p><strong><em>a. Trong Microsoft Word 2013, Office Button đã được thay thế bằng tab File. Khi bạn nhấp vào tab File, bạn sẽ mở giao diện Backstage View (Giao diện hậu trường), nơi bạn có thể thực hiện các thao tác liên quan đến tài liệu như</em></strong></p>
                                    <li class="list-item-l1">Save (Lưu): Lưu tài liệu hiện tại.</li>
                                    <li class="list-item-l1">Open (Mở): Mở tài liệu từ máy tính hoặc các nguồn lưu trữ khác.</li>
                                    <li class="list-item-l1">Save As (Lưu dưới dạng): Lưu tài liệu với tên mới hoặc định dạng khác</li>
                                    <li class="list-item-l1">Print (In): Thiết lập và thực hiện việc in tài liệu.</li>
                                    <li class="list-item-l1">Share (Chia sẻ): Chia sẻ tài liệu qua email hoặc các dịch vụ lưu trữ đám mây.</li>
                                    <li class="list-item-l1">Export (Xuất): Xuất tài liệu sang các định dạng khác như PDF.</li>

                                </div>
                              
                           </div>

                        </div>
                        <!--Phần VI-->
                        <div id="VI-LaMa">
                           <h5>
                            <span>
                                <strong>VI.  Thanh trạng thái, thanh cuộn, thanh thước đo</strong>
                            </span>
                           </h5>

                           <!--Mục 1 nhỏ-->
                           <div>
                                <p class="sub-title-lession" id="muc6-1">
                                    <span><strong>1. Thanh trạng thái</strong></span>
                                    <li class="list-item-l1">Vị trí: Nằm ở phía dưới cùng của cửa sổ Word, phía trên thanh cuộn ngang.</li>
                                    <li class="list-item-l1">Chức năng: Hiển thị thông tin về tài liệu hiện tại như số trang, số từ, chế độ xem hiện tại (ví dụ: chế độ xem bình thường, chế độ xem in ấn). Bạn có thể thay đổi chế độ xem từ thanh trạng thái, ví dụ, chuyển từ chế độ xem một trang sang chế độ xem nhiều trang.</li>
                                    
                                </p>
                           </div>
                            <!--Mục 2 nhỏ-->
                           <div>
                                <p class="sub-title-lession" id="muc6-2">
                                    <span><strong>2. Thanh cuộn</strong></span>
                                    <li class="list-item-l1">Thanh cuộn dọc: Nằm ở bên phải của cửa sổ, cho phép bạn di chuyển lên xuống trong tài liệu. Thanh cuộn dọc có một thanh kéo và một mũi tên ở trên và dưới.
                                    </li>
                                    <li class="list-item-l1">Thanh cuộn ngang: Nằm ở phía dưới của cửa sổ, cho phép bạn di chuyển trái phải khi tài liệu rộng hơn kích thước cửa sổ. Thanh cuộn ngang có một thanh kéo và một mũi tên ở bên trái và bên phải.</li>
                                    
                                </p>
                           </div>
                            <!--Mục 3 nhỏ-->
                            <div>
                                <p class="sub-title-lession" id="muc6-3">
                                    <span><strong>3. Thanh thước đo</strong></span>
                                    <li class="list-item-l1">Vị trí: Thanh thước đo nằm ở phía trên cùng của cửa sổ, dưới thanh Ribbon, và một thanh thước đo dọc nằm ở bên trái của cửa sổ.
                                    </li>
                                    <li class="list-item-l1">Chức năng: Giúp bạn đo và điều chỉnh lề của tài liệu, kích thước cột và các phần tử khác. Thanh thước đo có thể được sử dụng để kiểm tra khoảng cách từ các phần tử đến các lề trang.</li>
                                    
                                </p>
                           </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end Nội dung bài-->

            <!--Mục lục-->
            <div class="col-1-4 card-table-content">
                <div class="card-header">
                    <h4 class="card-title">Mục lục</h4>
                </div>
                <div class="card-body">
                    <div class="table-of-content">
                        <!--toc = table of content-->
                        <div class="toc-container"></div>
                        <navs class="toc-links">
                            <ul class="toc-list toc-list-level-1">
                                <a href="#I-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">I. Khởi động chương trình </a>
                                <li class="loc-page-1 toc-heading-level-2">
                                    <a href="#muc-1" class="heading-1">
                                    1. Mở Microsoft Word 2013
                                    </a>
                                    <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc-1-pg1">a.  Trên Windows</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc-1-pg2">b. Trên Windows 8/10</a>
                                        </li>
                                        
                                    </ul>
                               </li>
                               
                              
                            </ul>
                            <!--Phần 2-->
                            <ul class="toc-list toc-list-level-1">
                               <a href="#II-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">II. Tạo một văn bản mới</a>
                                <li class="loc-page-1 toc-heading-level-2">
                                    <a href="#muc-2" class="heading-1">
                                        1. Mở văn bản mới
                                    </a>
                                    <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc2-1-pg1">a. Khi Microsoft Word 2013 khởi động</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc2-1-pg2">b. Từ menu File</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                                
                            </ul>
                            <!--Phần 3-->
                            <ul class="toc-list toc-list-level-1">
                                <a href="#III-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">III. Giới thiệu thanh Ribbon</a>
                                <li class="loc-page-1 toc-heading-level-2">
                                     <a href="#muc-3" class="heading-1">
                                         1. Thanh Ribbon
                                     </a>
                                 </li>

                            </ul>

                            <!--Phần 4-->
                            <ul class="toc-list toc-list-level-1">
                               <a href="#IV-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">IV. Thanh công cụ nhanh</a>
                                <li class="loc-page-1 toc-heading-level-2">
                                    <a href="#muc-4" class="heading-1">
                                        1. Thanh công cụ nhanh
                                    </a>
                                    <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc4-1-pg1">a. Thanh công cụ nhanh</a>
                                        </li>
                                        <li class="toc-heading-level-2">
                                            <a href="#muc4-1-pg2">b. Tùy chỉnh thanh công cụ nhanh</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                                
                            </ul>

                            <!--Phần 5-->
                            <ul class="toc-list toc-list-level-1">
                               <a href="#V-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">V. Office Button</a>
                                <li class="loc-page-1 toc-heading-level-2">
                                    <a href="#muc-5" class="heading-1">
                                        1. Office Button
                                    </a>
                                    <ul class="toc-list-level-2">
                                        <li class="toc-heading-level-2">
                                            <a href="#muc5-1-pg1">a. Trong Microsoft Word 2013, Office Button đã được thay thế bằng tab File. Khi bạn nhấp vào tab File, bạn sẽ mở giao diện Backstage View (Giao diện hậu trường), nơi bạn có thể thực hiện các thao tác liên quan đến tài liệu như</a>
                                        </li>   
                                    </ul>
                                </li>
                            </ul>

                         <!--Phần 6-->
                         <ul class="toc-list toc-list-level-1">
                               <a href="#VI-LaMa" class="heading-1" style="font-size: 18px; text-decoration: underline;">VI. Thanh trạng thái, thanh cuộn, thanh thước đo</a>
                                <li class="loc-page-1 toc-heading-level-2">
                                    <a href="#muc6-1" class="heading-1">
                                        1. Thanh trạng thái
                                    </a>
                                    <a href="#muc6-2" class="heading-1">
                                        1. Thanh cuộn
                                    </a>
                                    <a href="#muc6-3" class="heading-1">
                                        1. Thanh thước đo
                                    </a>
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
