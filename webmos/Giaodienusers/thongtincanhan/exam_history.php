<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin người dùng từ session
$username = $_SESSION['username'];

// Truy vấn lấy idtaikhoan của người dùng dựa trên username
$sql_user = "SELECT idtaikhoan FROM taikhoan WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param('s', $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$idtaikhoan = $user['idtaikhoan'];

// Truy vấn lấy lịch sử bài thi của người dùng
$sql = "SELECT k.idketqua, d.tendethi, k.thoigian, k.diem 
        FROM ketqua k 
        JOIN dethi d ON k.iddethi = d.iddethi 
        WHERE k.idtaikhoan = ? 
        ORDER BY k.thoigian DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idtaikhoan);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử bài thi</title>
    <style>
        /* Basic styling for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .status-pass {
            color: green;
            font-weight: bold;
        }

        .status-fail {
            color: red;
            font-weight: bold;
        }

        .detail-button, .delete-button {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 5px;
        }

        .detail-button {
            background-color: #007bff;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .detail-button:hover {
            background-color: #0056b3;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .detail-button:focus, .delete-button:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>
    <h1>Lịch sử bài thi của bạn</h1>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'delete_success'): ?>
        <p style="color: green;">Xóa bài thi thành công.</p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Tên bài thi</th>
                <th>Thời gian hoàn thành</th>
                <th>Điểm</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
                <th>Xóa</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tendethi']); ?></td>
                    <td><?php echo htmlspecialchars($row['thoigian']); ?></td>
                    <td><?php echo htmlspecialchars($row['diem']); ?></td>
                    <td class="<?php echo ($row['diem'] >= 4) ? 'status-pass' : 'status-fail'; ?>">
                        <?php echo ($row['diem'] >= 4) ? 'Đạt' : 'Chưa đạt'; ?>
                    </td>
                    <td><a href="../Giaodienusers/thongtincanhan/xemchitiet.php?idketqua=<?php echo htmlspecialchars($row['idketqua']); ?>" class="detail-button">Xem chi tiết</a></td>
                    <td>
                        <a href="../Giaodienusers/thongtincanhan/xoalichsu.php?idketqua=<?php echo htmlspecialchars($row['idketqua']); ?>" class="delete-button" onclick="return confirm('Bạn có chắc chắn muốn xóa bài thi này?');">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Bạn chưa hoàn thành bài thi nào.</p>
    <?php endif; ?>

    <?php
    // Đóng kết nối
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
