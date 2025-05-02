<?php
if (isset($_COOKIE['token'])) {
    header("Location: /cabinet");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .auth-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color:rgb(0, 115, 255);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 1rem;
        }
        .error {
            color: #d32f2f;
            background-color: #fde0e0;
            padding: 0.75rem;
            border-radius: 4px;
            margin: 1rem 0;
            display: none;
        }
    </style>
</head>
<body>
    <div class="auth-form">
        <h2>Вход в систему</h2>
        
        <div class="error" id="error-message"></div>
        
        <form method="POST" id="authForm">
            <div class="form-group">
                <input type="text" name="login" placeholder="Логин" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" required>
            </div>
            <button type="submit">Войти</button>
        </form>
    </div>

    <script>
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
    </script>
</body>
</html>