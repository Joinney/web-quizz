<?php
include('../../connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch categories for the dropdown
$category_query = "SELECT iddanhmuc, tendanhmuc FROM danhmuc";
$result = $conn->query($category_query);

$options = "";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['iddanhmuc'] . "'>" . $row['tendanhmuc'] . "</option>";
}

// Handle form submission for creating exam
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_exam'])) {
    // Extract exam details
    $exam_name = $_POST['exam_name'];
    $exam_description = $_POST['exam_description'];
    $exam_time = $_POST['exam_time'];
    $iddanhmuc = $_POST['iddanhmuc'];

    // Validate exam details
    if (empty($exam_name) || empty($exam_description) || empty($exam_time) || empty($iddanhmuc)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Insert exam into the database
    $exam_query = "INSERT INTO dethi (tendethi, mota, thoigian, iddanhmuc) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($exam_query);
    $stmt->bind_param("sssi", $exam_name, $exam_description, $exam_time, $iddanhmuc);

    if ($stmt->execute()) {
        $exam_id = $stmt->insert_id; // Get the ID of the newly created exam

        // Handle image upload
        if (isset($_FILES['exam_image']) && $_FILES['exam_image']['error'] == 0) {
            $image_name = $_FILES['exam_image']['name'];
            $image_tmp_name = $_FILES['exam_image']['tmp_name'];
            $image_path = "../../img/" . basename($image_name);

            if (move_uploaded_file($image_tmp_name, $image_path)) {
                $update_query = "UPDATE dethi SET hinhanh = ? WHERE iddethi = ?";
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param("si", $image_name, $exam_id);
                $stmt->execute();
            }
        }

        echo "Exam created successfully. You can now add questions.";
    } else {
        echo "Failed to create exam: " . htmlspecialchars($stmt->error);
    }
}

// Handle form submission for adding questions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_questions'])) {
    $exam_id = $_POST['exam_id'];

    // Insert questions
    if (isset($_POST['questions'])) {
        foreach ($_POST['questions'] as $index => $question) {
            $question_text = $question['text'];
            $options = $question['options'];
            $answer = $question['answer'];

            $question_query = "INSERT INTO dscauhoi (iddethi, cauhoi, a, b, c, d, traloi) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($question_query);
            $stmt->bind_param("issssss", $exam_id, $question_text, $options['a'], $options['b'], $options['c'], $options['d'], $answer);
            $stmt->execute();
        }

        echo "Questions added successfully.";
    } else {
        echo "No questions to add.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Exam</title>
    <link rel="stylesheet" href="../../Css/main.css">
    <link rel="stylesheet" href="../../Css/edit_exam.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav>
        <!-- Navigation bar -->
    </nav>

    <h1>Create New Exam</h1>

    <!-- Form for creating a new exam -->
    <div class="create-form">
        <form action="create_exam.php" method="post" enctype="multipart/form-data">
            <label for="exam_name">Exam Name:</label>
            <input type="text" id="exam_name" name="exam_name" required>

            <label for="exam_description">Description:</label>
            <textarea id="exam_description" name="exam_description" required></textarea>

            <label for="exam_time">Time:</label>
            <input type="text" id="exam_time" name="exam_time" required>

            <div>
                <label for="iddanhmuc">Category:</label>
                <select id="iddanhmuc" name="iddanhmuc" required>
                    <?php echo $options; ?>
                </select>
            </div>

            <label for="exam_image">Image:</label>
            <input type="file" id="exam_image" name="exam_image">

            <button type="submit" name="create_exam" class="create-button">Create Exam</button>
        </form>
    </div>

    <!-- Form for adding questions -->
    <h2>Add Questions</h2>
    <form id="questions-form" action="create_exam.php" method="post">
        <input type="hidden" name="exam_id" value="<?php echo isset($exam_id) ? $exam_id : ''; ?>">

        <!-- Repeat the question fields as needed -->
        <div class="question-item">
            <label for="question_1">Question 1:</label>
            <textarea id="question_1" name="questions[1][text]" required></textarea>

            <label for="option_a_1">A:</label>
            <input type="text" id="option_a_1" name="questions[1][options][a]" required>

            <label for="option_b_1">B:</label>
            <input type="text" id="option_b_1" name="questions[1][options][b]" required>

            <label for="option_c_1">C:</label>
            <input type="text" id="option_c_1" name="questions[1][options][c]" required>

            <label for="option_d_1">D:</label>
            <input type="text" id="option_d_1" name="questions[1][options][d]" required>

            <label for="answer_1">Answer:</label>
            <input type="text" id="answer_1" name="questions[1][answer]" required>
        </div>

        <!-- Add more question fields as needed -->

        <button type="submit" name="add_questions" class="create-button">Add Questions</button>
    </form>

    <footer>
        <!-- Footer -->
    </footer>
</body>
</html>
