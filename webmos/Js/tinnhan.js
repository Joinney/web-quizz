document.getElementById('chatButton').addEventListener('click', function() {
    var chatContainer = document.getElementById('chatContainer');
    chatContainer.classList.toggle('show');
});

document.getElementById('chatForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting the traditional way

    var formData = new FormData(this); // Collect form data

    fetch('your-server-endpoint.php', { // Thay đổi 'your-server-endpoint.php' thành URL của máy chủ
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Parse JSON response
    .then(data => {
        if (data.success) {
            var chatBox = document.getElementById('chatBox');
            var messageDiv = document.createElement('div');
            messageDiv.className = 'message';
            messageDiv.innerHTML = '<p><strong>Bạn:</strong> ' + formData.get('message') + '</p><p><small>Just now</small></p>';
            chatBox.appendChild(messageDiv);

            // Scroll to the bottom of the chat box
            chatBox.scrollTop = chatBox.scrollHeight;

            // Clear the textarea
            document.querySelector('textarea[name="message"]').value = '';
        } else {
            alert(data.error); // Show error message
        }
    })
    .catch(error => console.error('Error:', error)); // Handle errors
});
