// Lấy các phần tử
var changeImageBtn = document.getElementById('changeImageBtn');
var changePasswordBtn = document.getElementById('changePasswordBtn');
var changeImageModal = document.getElementById('changeImageModal');
var changePasswordModal = document.getElementById('changePasswordModal');
var closeBtns = document.getElementsByClassName('close');

// Hiển thị Modal Đổi Hình Ảnh
changeImageBtn.onclick = function() {
    changeImageModal.style.display = "block";
}

// Hiển thị Modal Đổi Mật Khẩu
changePasswordBtn.onclick = function() {
    changePasswordModal.style.display = "block";
}

// Đóng Modal khi nhấn vào nút đóng
for (var i = 0; i < closeBtns.length; i++) {
    closeBtns[i].onclick = function() {
        this.parentElement.parentElement.style.display = "none";
    }
}

// Đóng Modal khi nhấn ra ngoài Modal
window.onclick = function(event) {
    if (event.target == changeImageModal) {
        changeImageModal.style.display = "none";
    }
    if (event.target == changePasswordModal) {
        changePasswordModal.style.display = "none";
    }
}
