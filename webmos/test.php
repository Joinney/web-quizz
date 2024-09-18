<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "webmos");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn SQL để lấy dữ liệu trạng thái học tập
$sql = "
    SELECT 
        t.username,
        d.tendethi,
        COUNT(k.idketqua) AS so_lan_thi,
        COALESCE(MAX(k.diem), 0) AS diem_cao_nhat,
        CASE 
            WHEN COALESCE(MAX(k.diem), 0) >= 4 THEN 'Đạt'
            ELSE 'Không đạt'
        END AS tinh_trang
    FROM 
        taikhoan t
    LEFT JOIN 
        ketqua k ON t.idtaikhoan = k.idtaikhoan
    LEFT JOIN 
        dethi d ON k.iddethi = d.iddethi
    WHERE
        t.idtaikhoan != 1
    GROUP BY 
        t.username, d.tendethi
    ORDER BY 
        t.username, d.tendethi;
";

$result = $conn->query($sql);

// Mảng lưu trữ dữ liệu
$data = [];

// Tạo mảng dữ liệu cho mỗi username
while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $tendethi = $row['tendethi'];
    
    if (!isset($data[$username])) {
        $data[$username] = [];
    }
    
    $data[$username][$tendethi] = [
        'so_lan_thi' => $row['so_lan_thi'],
        'diem_cao_nhat' => $row['diem_cao_nhat'],
        'tinh_trang' => $row['tinh_trang']
    ];
}

// Truy vấn SQL để lấy danh sách tất cả các đề thi
$allExamsResult = $conn->query("SELECT iddethi, tendethi FROM dethi");

$allExams = [];
while ($row = $allExamsResult->fetch_assoc()) {
    $allExams[$row['iddethi']] = $row['tendethi'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lộ Trình Học Tập</title>
    <style>
        /* Timeline Container */
        .timeline-container {
            width: 100%;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Timeline */
        .timeline {
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px 0;
        }

        /* Timeline Item */
        .timeline-item {
            flex: 0 0 auto;
            min-width: 180px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            position: relative;
            transition: background-color 0.3s, border-color 0.3s;
        }

        /* Timeline Connector */
        .timeline::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #3498db, #3498db 50%, #ddd 50%);
            z-index: 0;
            transform: translateY(-50%);
        }

        /* Timeline Content */
        .timeline-content {
            position: relative;
            z-index: 1;
        }

        .timeline-content h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .timeline-content p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        /* Styles for passed exams */
        .passed {
            border-color: #28a745; /* Green border */
            background: linear-gradient(to bottom right, #d4edda, #c3e6cb); /* Light green gradient */
        }

        .passed::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #28a745; /* Green circle */
            box-shadow: 0 0 0 3px #fff; /* White ring */
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Styles for not attempted exams */
        .not-attempted {
            border-color: #ddd;
            background: linear-gradient(to bottom right, #ffe5e5, #f8d7da); /* Light orange gradient */
        }

        .not-attempted::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ccc; /* Grey circle */
            box-shadow: 0 0 0 3px #fff; /* White ring */
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Styles for opened exams */
        .opened {
            border-color: #007bff; /* Blue border */
            background: linear-gradient(to bottom right, #d1ecf1, #bee5eb); /* Light blue gradient */
        }

        .opened::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #007bff; /* Blue circle */
            box-shadow: 0 0 0 3px #fff; /* White ring */
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Additional styling for opened label */
        .opened-label {
            font-size: 13px;
            color: #007bff;
            margin-top: 5px;
            display: block;
            font-weight: 500;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="timeline-container">
        <?php foreach ($data as $username => $exams): ?>
            <h2>User: <?php echo htmlspecialchars($username); ?></h2>
            <div class="timeline">
                <?php
                $previousPassed = false; // Track if the previous exam was passed
                foreach ($allExams as $examId => $tendethi):
                    // Lọc dữ liệu cho đề thi hiện tại
                    $examData = $exams[$tendethi] ?? null;
                    
                    // Kiểm tra xem dữ liệu có tồn tại không
                    if ($examData === null) {
                        $examData = [
                            'so_lan_thi' => 0,
                            'diem_cao_nhat' => 0,
                            'tinh_trang' => 'Chưa làm'
                        ];
                    }
                    
                    $isPassed = $examData['tinh_trang'] === 'Đạt' ? 'passed' : '';
                    $isNotAttempted = $examData['tinh_trang'] === 'Chưa làm' ? 'not-attempted' : '';
                    $isOpened = $previousPassed && $examData['tinh_trang'] !== 'Chưa làm' ? 'opened' : '';
                    
                    $previousPassed = $examData['tinh_trang'] === 'Đạt'; // Update track
                ?>
                    <div class="timeline-item <?php echo $isPassed . ' ' . $isNotAttempted . ' ' . $isOpened; ?>">
                        <div class="timeline-content">
                            <h3><?php echo htmlspecialchars($tendethi); ?></h3>
                            <p>Số lần thi: <?php echo htmlspecialchars($examData['so_lan_thi']); ?></p>
                            <p>Điểm cao nhất: <?php echo htmlspecialchars($examData['diem_cao_nhat']); ?></p>
                            <p>Tình trạng: <?php echo htmlspecialchars($examData['tinh_trang']); ?></p>
                            <?php if ($isOpened): ?>
                                <span class="opened-label">Đã mở</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
