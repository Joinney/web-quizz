<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webmos"; // Thay đổi tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Xử lý khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý thêm đề thi
    if (isset($_POST['submit_test'])) {
        // Lấy dữ liệu từ form
        $tendethi = $_POST['tendethi'];
        $mota = $_POST['mota'];
        $thoigian = $_POST['thoigian'];
        $danhgia = $_POST['danhgia'];
        $iddanhmuc = $_POST['iddanhmuc'];


        
        // Xử lý hình ảnh
        $hinhanh = "";
        if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == UPLOAD_ERR_OK) {
            $target_dir = __DIR__ . "/../../img/"; // Đảm bảo thư mục này tồn tại
            $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);

            if (!is_dir($target_dir)) {
                echo "<p>Thư mục lưu trữ không tồn tại.</p>";
                exit;
            }

            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                $hinhanh = basename($_FILES["hinhanh"]["name"]);
            } else {
                echo "<p>Lỗi khi tải lên hình ảnh.</p>";
                exit;
            }
        }

        // Thực hiện truy vấn để thêm dữ liệu vào bảng dethi
        $sql = "INSERT INTO dethi (tendethi, mota, thoigian, hinhanh, danhgia, iddanhmuc) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $tendethi, $mota, $thoigian, $hinhanh, $danhgia, $iddanhmuc);

        if ($stmt->execute()) {
            $iddethi = $stmt->insert_id; // Lấy id của đề thi vừa thêm
            echo "<p>Thêm đề thi thành công!</p>";
        } else {
            echo "<p>Lỗi: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    // Xử lý thêm câu hỏi
    if (isset($_POST['submit_question']) && isset($_POST['iddethi'])) {
        $iddethi = $_POST['iddethi']; // Lấy id đề thi từ form
        $cauhoi = $_POST['cauhoi'];
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];
        $d = $_POST['d'];
        $traloi = $_POST['traloi'];

        // Thực hiện truy vấn để thêm dữ liệu vào bảng dscauhoi
        $sql = "INSERT INTO dscauhoi (cauhoi, a, b, c, d, iddethi, traloi) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssis", $cauhoi, $a, $b, $c, $d, $iddethi, $traloi);

        if ($stmt->execute()) {
            echo "<p>Thêm câu hỏi thành công!</p>";
        } else {
            echo "<p>Lỗi: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

// Lấy danh sách danh mục
$sql = "SELECT iddanhmuc, tendanhmuc FROM danhmuc";
$result = $conn->query($sql);

$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['iddanhmuc'] . "'>" . $row['tendanhmuc'] . "</option>";
    }
}

// Lấy danh sách đề thi
$sql = "SELECT iddethi, tendethi FROM dethi";
$result = $conn->query($sql);

$test_options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $test_options .= "<option value='" . $row['iddethi'] . "'>" . $row['tendethi'] . "</option>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Đề Thi và Câu Hỏi</title>
    <link rel="stylesheet" href="../../Css/themdethi.css">
</head>
<body>
    <h1>Thêm Đề Thi và Câu Hỏi</h1>

    <!-- Form Thêm Đề Thi -->
    <h2>Thêm Đề Thi</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="tendethi">Tên Đề Thi:</label>
            <input type="text" id="tendethi" name="tendethi" required>
        </div>
        <div>
            <label for="mota">Mô Tả:</label>
            <textarea id="mota" name="mota" rows="4" required></textarea>
        </div>
        <div>
            <label for="thoigian">Thời Gian (phút):</label>
            <input type="text" id="thoigian" name="thoigian" pattern="([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" title="Vui lòng nhập thời gian theo định dạng HH:MM:SS" required>
        </div>
        <div>
            <label for="hinhanh">Hình Ảnh:</label>
            <input type="file" id="hinhanh" name="hinhanh" accept="image/*">
        </div>
        <div>
            <label for="danhgia">Đánh Giá:</label>
            <textarea id="danhgia" name="danhgia" rows="2"></textarea>
        </div>
        <div>
            <label for="iddanhmuc">Danh Mục:</label>
            <select id="iddanhmuc" name="iddanhmuc" required>
                <?php echo $options; ?>
            </select>
        </div>
        <div>
            <button type="submit" name="submit_test">Thêm Đề Thi</button>
        </div>
    </form>

    <!-- Form Thêm Câu Hỏi -->
    <h2>Thêm Câu Hỏi</h2>
    <form action="" method="post">
        <div>
            <label for="iddethi">Chọn Đề Thi:</label>
            <select id="iddethi" name="iddethi" required>
                <?php echo $test_options; ?>
            </select>
        </div>
        <div>
            <label for="cauhoi">Câu Hỏi:</label>
            <textarea id="cauhoi" name="cauhoi" rows="4" required></textarea>
        </div>
        <div>
            <label for="a">Đáp Án A:</label>
            <input type="text" id="a" name="a" required>
        </div>
        <div>
            <label for="b">Đáp Án B:</label>
            <input type="text" id="b" name="b" required>
        </div>
        <div>
            <label for="c">Đáp Án C:</label>
            <input type="text" id="c" name="c" required>
        </div>
        <div>
            <label for="d">Đáp Án D:</label>
            <input type="text" id="d" name="d" required>
        </div>
        <div>
            <label for="traloi">Đáp Án Đúng:</label>
            <input type="text" id="traloi" name="traloi" required>
        </div>
        <div>
            <button type="submit" name="submit_question">Thêm Câu Hỏi</button>
        </div>
    </form>
</body>
</html>
