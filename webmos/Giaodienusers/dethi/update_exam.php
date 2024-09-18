<?php
include('../../connection.php'); // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exam_id = intval($_POST['exam_id']);
    $exam_name = $_POST['exam_name'];
    $exam_description = $_POST['exam_description'];
    $exam_time = $_POST['exam_time'];

    // Handle image upload if a new image is provided
    $image_name = null;
    if (isset($_FILES['exam_image']) && $_FILES['exam_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['exam_image']['name']);
        $image_path = "../../img/" . $image_name;
        move_uploaded_file($_FILES['exam_image']['tmp_name'], $image_path);
    }

    // Update exam data in the database
    $query = "UPDATE dethi SET tendethi = ?, mota = ?, thoigian = ?";
    if ($image_name) {
        $query .= ", hinhanh = ?";
    }
    $query .= " WHERE iddethi = ?";

    $stmt = $conn->prepare($query);
    if ($image_name) {
        $stmt->bind_param('ssssi', $exam_name, $exam_description, $exam_time, $image_name, $exam_id);
    } else {
        $stmt->bind_param('sssi', $exam_name, $exam_description, $exam_time, $exam_id);
    }
    $stmt->execute();

    // Redirect to the same page or to a confirmation page
    header("Location: edit_exam.php?id=$exam_id");
    exit();
}
?>
