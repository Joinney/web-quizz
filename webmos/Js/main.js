
    // ====================================danh mục cá nhân=======================

document.addEventListener('DOMContentLoaded', function () {
    var userName = document.querySelector('.user-name');
    var userDropdown = document.querySelector('.user-dropdown');

    userName.addEventListener('click', function () {
        userDropdown.classList.toggle('show');
    });

    // Đóng dropdown nếu nhấp ra ngoài
    window.addEventListener('click', function (event) {
        if (!userName.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.remove('show');
        }
    });
});
