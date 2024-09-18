function startExam(examId) {
    // Gửi yêu cầu AJAX để kiểm tra điều kiện
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../../webmos/Giaodienusers/tracnghiem/kiemtradk.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response); // Debug output
            if (response.allowed) {
                // Điều hướng ngay lập tức đến trang thi nếu điều kiện được thỏa mãn
                window.location.href = "../../../webmos/Giaodienusers/tracnghiem/lambaithi.php?iddethi=" + examId;
            } else {
                // Hiển thị thông báo lỗi nếu không đủ điều kiện
                alert(response.message);
            }
        }
    };
    xhr.send('examId=' + examId);
}
