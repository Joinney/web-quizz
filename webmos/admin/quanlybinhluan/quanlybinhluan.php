<?php
// Include the connection file
require '../../connection.php';

// Fetch data for the selected date
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Fetch most liked and commented posts
$sql_most_liked_and_commented = "
    SELECT baidang.idbaidang, baidang.tieude, baidang.image AS post_image, baidang.thoigian,
           taikhoan.hoten, taikhoan.image AS user_image,
           COUNT(likes.idbaidang) AS like_count, COUNT(binhluan.idbaidang) AS comment_count
    FROM baidang
    JOIN taikhoan ON baidang.idtaikhoan = taikhoan.idtaikhoan
    LEFT JOIN likes ON baidang.idbaidang = likes.idbaidang
    LEFT JOIN binhluan ON baidang.idbaidang = binhluan.idbaidang
    WHERE DATE(baidang.thoigian) = ?
    GROUP BY baidang.idbaidang
    ORDER BY like_count DESC, comment_count DESC
    LIMIT 5";

$stmt_most_liked_and_commented = $conn->prepare($sql_most_liked_and_commented);
$stmt_most_liked_and_commented->bind_param("s", $date);
$stmt_most_liked_and_commented->execute();
$result_most_liked_and_commented = $stmt_most_liked_and_commented->get_result();

// Fetch least liked and commented posts
$sql_least_liked_and_commented = "
    SELECT baidang.idbaidang, baidang.tieude, baidang.image AS post_image, baidang.thoigian,
           taikhoan.hoten, taikhoan.image AS user_image,
           COUNT(likes.idbaidang) AS like_count, COUNT(binhluan.idbaidang) AS comment_count
    FROM baidang
    JOIN taikhoan ON baidang.idtaikhoan = taikhoan.idtaikhoan
    LEFT JOIN likes ON baidang.idbaidang = likes.idbaidang
    LEFT JOIN binhluan ON baidang.idbaidang = binhluan.idbaidang
    WHERE DATE(baidang.thoigian) = ?
    GROUP BY baidang.idbaidang
    ORDER BY like_count ASC, comment_count ASC
    LIMIT 5";

$stmt_least_liked_and_commented = $conn->prepare($sql_least_liked_and_commented);
$stmt_least_liked_and_commented->bind_param("s", $date);
$stmt_least_liked_and_commented->execute();
$result_least_liked_and_commented = $stmt_least_liked_and_commented->get_result();

// Fetch likes data for charts
$sql_likes = "
    SELECT baidang.idbaidang, baidang.tieude, COUNT(likes.idbaidang) AS like_count
    FROM baidang
    LEFT JOIN likes ON baidang.idbaidang = likes.idbaidang
    WHERE DATE(baidang.thoigian) = ?
    GROUP BY baidang.idbaidang";

$stmt_likes = $conn->prepare($sql_likes);
$stmt_likes->bind_param("s", $date);
$stmt_likes->execute();
$result_likes = $stmt_likes->get_result();

$likes_labels = [];
$likes_data = [];
$likes_ids = [];

while ($row = $result_likes->fetch_assoc()) {
    $likes_labels[] = htmlspecialchars($row['tieude']);
    $likes_data[] = (int)$row['like_count'];
    $likes_ids[] = (int)$row['idbaidang'];
}

// Fetch comments data for charts
$sql_comments = "
    SELECT baidang.idbaidang, baidang.tieude, COUNT(binhluan.idbaidang) AS comment_count
    FROM baidang
    LEFT JOIN binhluan ON baidang.idbaidang = binhluan.idbaidang
    WHERE DATE(baidang.thoigian) = ?
    GROUP BY baidang.idbaidang";

$stmt_comments = $conn->prepare($sql_comments);
$stmt_comments->bind_param("s", $date);
$stmt_comments->execute();
$result_comments = $stmt_comments->get_result();

$comments_labels = [];
$comments_data = [];
$comments_ids = [];

while ($row = $result_comments->fetch_assoc()) {
    $comments_labels[] = htmlspecialchars($row['tieude']);
    $comments_data[] = (int)$row['comment_count'];
    $comments_ids[] = (int)$row['idbaidang'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .stats {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            border-bottom: 3px solid #007bff;
            padding-bottom: 12px;
            color: #333;
            font-size: 26px;
            margin-top: 0;
            font-weight: 600;
        }

        form {
            margin-bottom: 20px;
        }

        form label {
            font-size: 16px;
            color: #495057;
        }

        form input[type="date"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
            margin-right: 10px;
        }

        form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Post Card Styles */
        .post {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .post:hover {
            transform: translateY(-5px);
        }

        .post img.user-image {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #007bff;
        }

        .post .user-name {
            font-size: 18px;
            font-weight: 600;
            color: #007bff;
        }

        .post p {
            margin: 5px 0;
            color: #495057;
        }

        .post a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .post a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Layout for Posts */
        .most-liked-and-commented-posts,
        .least-liked-and-commented-posts {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .most-liked-and-commented-posts .post,
        .least-liked-and-commented-posts .post {
            flex: 1 1 calc(33.333% - 20px);
            box-sizing: border-box;
        }

        /* Chart Styles */
        canvas {
            width: 100% !important;
            max-width: 100%;
            height: 300px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="stats">
        <!-- Form to select date and filter -->
        <form method="get" action="">
            <label for="date">Chọn ngày:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
            <button type="submit">Xem thống kê</button>
        </form>

        <!-- Charts -->
        <h2>Biểu đồ lượt thích</h2>
        <canvas id="likesChart"></canvas>
        
        <h2>Biểu đồ bình luận</h2>
        <canvas id="commentsChart"></canvas>

        <!-- Most liked and commented posts -->
        <h2>Bài đăng có nhiều lượt thích và bình luận nhất</h2>
        <div class="most-liked-and-commented-posts">
            <?php if ($result_most_liked_and_commented->num_rows > 0) { ?>
                <?php while ($post = $result_most_liked_and_commented->fetch_assoc()) { ?>
                    <div class="post">
                        <img src="../../img/<?php echo htmlspecialchars($post['user_image']); ?>" alt="User Avatar" class="user-image">
                        <span class="user-name"><?php echo htmlspecialchars($post['hoten']); ?></span>
                        <p><?php echo htmlspecialchars($post['tieude']); ?></p>
                        <p>Lượt thích: <?php echo htmlspecialchars($post['like_count']); ?></p>
                        <p>Số bình luận: <?php echo htmlspecialchars($post['comment_count']); ?></p>
                        <a href="chitietbaiviet.php?id=<?php echo $post['idbaidang']; ?>">Xem chi tiết</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Không có bài đăng nào vào ngày này.</p>
            <?php } ?>
        </div>

        <!-- Least liked and commented posts -->
        <h2>Bài đăng có ít lượt thích và bình luận nhất</h2>
        <div class="least-liked-and-commented-posts">
            <?php if ($result_least_liked_and_commented->num_rows > 0) { ?>
                <?php while ($post = $result_least_liked_and_commented->fetch_assoc()) { ?>
                    <div class="post">
                        <img src="../../img/<?php echo htmlspecialchars($post['user_image']); ?>" alt="User Avatar" class="user-image">
                        <span class="user-name"><?php echo htmlspecialchars($post['hoten']); ?></span>
                        <p><?php echo htmlspecialchars($post['tieude']); ?></p>
                        <p>Lượt thích: <?php echo htmlspecialchars($post['like_count']); ?></p>
                        <p>Số bình luận: <?php echo htmlspecialchars($post['comment_count']); ?></p>
                        <a href="chitietbaiviet.php?id=<?php echo $post['idbaidang']; ?>">Xem chi tiết</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Không có bài đăng nào vào ngày này.</p>
            <?php } ?>
        </div>
    </div>

    <script>
        // Data for likes chart
        const likesLabels = <?php echo json_encode($likes_labels); ?>;
        const likesData = <?php echo json_encode($likes_data); ?>;

        const likesCtx = document.getElementById('likesChart').getContext('2d');
        new Chart(likesCtx, {
            type: 'bar',
            data: {
                labels: likesLabels,
                datasets: [{
                    label: 'Số lượt thích',
                    data: likesData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat().format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Data for comments chart
        const commentsLabels = <?php echo json_encode($comments_labels); ?>;
        const commentsData = <?php echo json_encode($comments_data); ?>;

        const commentsCtx = document.getElementById('commentsChart').getContext('2d');
        new Chart(commentsCtx, {
            type: 'bar',
            data: {
                labels: commentsLabels,
                datasets: [{
                    label: 'Số bình luận',
                    data: commentsData,
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat().format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
