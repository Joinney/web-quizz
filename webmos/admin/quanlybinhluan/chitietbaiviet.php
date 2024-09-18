<?php
require '../../connection.php';

// Retrieve post ID from query parameter
$idbaidang = isset($_GET['id']) ? $_GET['id'] : 0;

// Prepare and execute query to fetch post details
$sql_post = "
    SELECT baidang.*, taikhoan.hoten, taikhoan.image AS user_image
    FROM baidang
    JOIN taikhoan ON baidang.idtaikhoan = taikhoan.idtaikhoan
    WHERE baidang.idbaidang = ?";
$stmt_post = $conn->prepare($sql_post);
$stmt_post->bind_param("i", $idbaidang);
$stmt_post->execute();
$result_post = $stmt_post->get_result();

// Check if post exists
if ($result_post->num_rows > 0) {
    $post = $result_post->fetch_assoc();
} else {
    echo "Bài đăng không tồn tại.";
    exit;
}

// Fetch likes count
$sql_likes_count = "
    SELECT COUNT(*) AS like_count
    FROM likes
    WHERE idbaidang = ?";
$stmt_likes_count = $conn->prepare($sql_likes_count);
$stmt_likes_count->bind_param("i", $idbaidang);
$stmt_likes_count->execute();
$result_likes_count = $stmt_likes_count->get_result();
$likes_count = $result_likes_count->fetch_assoc()['like_count'];

// Fetch comments count
$sql_comments_count = "
    SELECT COUNT(*) AS comment_count
    FROM binhluan
    WHERE idbaidang = ?";
$stmt_comments_count = $conn->prepare($sql_comments_count);
$stmt_comments_count->bind_param("i", $idbaidang);
$stmt_comments_count->execute();
$result_comments_count = $stmt_comments_count->get_result();
$comments_count = $result_comments_count->fetch_assoc()['comment_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài đăng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .post-header {
            display: flex;
            align-items: center;
        }
        .post-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .post-header h1 {
            margin: 0;
            color: #333;
        }
        .post-content {
            margin-top: 20px;
        }
        .post-content img {
            max-width: 100%;
            border-radius: 8px;
        }
        .post-content p {
            color: #555;
        }
        .post-meta {
            margin-top: 20px;
            font-size: 16px;
            color: #666;
        }
        .post-meta span {
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="post-header">
            <img src="../../img/<?php echo htmlspecialchars($post['user_image']); ?>" alt="User Avatar">
            <h1><?php echo htmlspecialchars($post['tieude']); ?></h1>
        </div>
        <div class="post-content">
            <p>Ngày đăng: <?php echo htmlspecialchars($post['thoigian']); ?></p>
            <img src="../../img/<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image">
            
        </div>
        <div class="post-meta">
            <span>Lượt thích: <?php echo $likes_count; ?></span>
            <span>Số bình luận: <?php echo $comments_count; ?></span>
        </div>
    </div>
</body>
</html>
