document.getElementById('authForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    document.getElementById('error-message').style.display = 'none';
    
    fetch('/api/auth', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/cabinet';
        } else {
            const errorElement = document.getElementById('error-message');
            errorElement.textContent = data.message;
            errorElement.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
});