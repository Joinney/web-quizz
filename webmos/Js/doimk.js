document.getElementById('openModal').addEventListener('click', function() {
    document.getElementById('changePasswordModal').style.display = 'block';
});

document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('changePasswordModal').style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('changePasswordModal')) {
        document.getElementById('changePasswordModal').style.display = 'none';
    }
});
