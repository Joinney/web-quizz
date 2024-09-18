<?php
include('../../connection.php'); // Điều chỉnh đường dẫn nếu cần

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem các trường có tồn tại không
    if (isset($_POST['question_ids']) && isset($_POST['questions']) && isset($_POST['options']) && isset($_POST['exam_id'])) {
        $exam_id = intval($_POST['exam_id']);
        $question_ids = $_POST['question_ids'];
        $questions = $_POST['questions'];
        $options = $_POST['options'];

        // Kiểm tra số lượng dữ liệu
        if (count($question_ids) === count($questions) && count($questions) === count($options)) {
            $conn->begin_transaction(); // Bắt đầu giao dịch

            $update_query = "UPDATE dscauhoi SET cauhoi = ?, a = ?, b = ?, c = ?, d = ?, traloi = ? WHERE idcauhoi = ?";
            $stmt = $conn->prepare($update_query);

            if (!$stmt) {
                die("Câu lệnh chuẩn bị thất bại: " . $conn->error);
            }

            foreach ($question_ids as $index => $question_id) {
                $question_text = $questions[$index];
                $option_a = isset($options[$question_id]['a']) ? $options[$question_id]['a'] : '';
                $option_b = isset($options[$question_id]['b']) ? $options[$question_id]['b'] : '';
                $option_c = isset($options[$question_id]['c']) ? $options[$question_id]['c'] : '';
                $option_d = isset($options[$question_id]['d']) ? $options[$question_id]['d'] : '';
                $correct_answer = isset($options[$question_id]['traloi']) ? $options[$question_id]['traloi'] : '';

                $stmt->bind_param("ssssssi", $question_text, $option_a, $option_b, $option_c, $option_d, $correct_answer, $question_id);
                $stmt->execute();

                if ($stmt->error) {
                    $conn->rollback(); // Hoàn tác giao dịch nếu có lỗi
                    die("Lỗi khi cập nhật câu hỏi ID $question_id: " . $stmt->error);
                }
            }

            $conn->commit(); // Xác nhận giao dịch

            // Chuyển hướng đến trang edit_exam với exam_id
            header("Location: edit_exam.php?id=" . $exam_id);
            exit;
        } else {
            die('Số lượng ID câu hỏi, câu hỏi, và tùy chọn không khớp.');
        }
    } else {
        die('Thiếu dữ liệu cần thiết.');
    }
} else {
    die('Phương thức yêu cầu không hợp lệ.');
}

?>
