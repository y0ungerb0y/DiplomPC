
document.getElementById('addform').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitButton = document.getElementById('submit');
    const buttonText = document.getElementById('button-text');
    const loader = document.getElementById('loader');
    const alertBox = document.getElementById('alert-message');
    
    submitButton.disabled = true;
    buttonText.textContent = 'Отправка...';
    loader.style.display = 'block';
    alertBox.style.display = 'none';
    
    try {
        const formData = new FormData(form);
        
        const response = await fetch('/api/add?type=user', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Ошибка сервера');
        }
        
        if (data.success) {
            alertBox.textContent = 'Пользователь успешно добавлен! Перенаправление...';
            alertBox.className = 'alert alert-success';
            alertBox.style.display = 'block';
            setTimeout(() => {
                window.location.href = '/cabinet?include=users';
            }, 2000);
        } else {
            throw new Error(data.message || 'Неизвестная ошибка');
        }
    } catch (error) {
        alertBox.textContent = error.message;
        alertBox.className = 'alert alert-error';
        alertBox.style.display = 'block';
        
        console.error('Ошибка:', error);
    } finally {
        submitButton.disabled = false;
        buttonText.textContent = 'Добавить';
        loader.style.display = 'none';
    }
});