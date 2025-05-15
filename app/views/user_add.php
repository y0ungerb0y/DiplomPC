<?php if ($row['perm'] == 'admin'): ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить пользователя</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #6c757d;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: none;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .button-container {
            position: relative;
        }

        .button-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Добавить пользователя</h1>
        <a href="javascript:history.back()" class="back-button">← Назад</a>

        <div id="alert-message" class="alert" role="alert"></div>

        <form id="addform">
            <div class="form-group">
                <label for="name">Ф.И.О:</label>
                <input type="text" id="name" placeholder="Ф.И.О" name="name" required>
            </div>

            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" id="login" placeholder="Логин" name="login" required>
            </div>

            <div class="form-group">
                <label for="pass">Пароль:</label>
                <input type="password" id="pass" placeholder="Пароль" name="pass" required>
            </div>

            <div class="form-group">
                <label for="type">Уровень доступа:</label>
                <select id="type" name="type" required>
                    <option value="">-- Выберите тип доступа --</option>
                    <option value="admin">Администратор</option>
                    <option value="user">Пользователь</option>
                </select>
            </div>

            <div class="button-container">
                <button type="submit" id="submit">
                    <div class="button-content">
                        <span id="button-text">Добавить</span>
                        <div id="loader" class="loader"></div>
                    </div>
                </button>
            </div>
        </form>
    </div>

    <script>
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
    </script>
</body>
</html>
<?php else: ?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<?php endif; ?>