<? 
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT login, name, pass, perm FROM users WHERE id = ?");
$stmt->execute([$id]);
$user_row = $stmt->fetch();


if ($row['perm'] == 'admin'): ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Редактировать пользователя</title>
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
            }

            h1 {
                color: #333;
                text-align: center;
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
            }

            input[type="text"],
            input[type="password"],
            input[type="number"],
            select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
            }

            input[type="checkbox"] {
                margin-bottom: 15px;
            }

            button {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 12px 25px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                font-size: 16px;
                width: 100%;
            }

            button:hover {
                background-color: #0056b3;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .moved-group {
                display: flex;
                align-items: center;
            }

            .moved-group label {
                margin-right: 10px;
            }
            .back-button {
                background-color: #6c757d;
                color: #fff;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                font-size: 14px;
                text-decoration: none;
                position: absolute;
                top: 20px;
                left: 20px;
            }
            
            .back-button:hover {
                background-color: #5a6268;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <h1>Редактировать пользователя</h1>
            <a href="javascript:history.back()" class="back-button">← Назад</a>

            <form action="/api/edit" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id ?? '') ?>">
        
        <div class="form-group">
            <label for="name">Ф.И.О:</label>
            <input type="text" id="name" name="name" placeholder="Ф.И.О" 
                value="<?= htmlspecialchars($user_row['name'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="pass" placeholder="Новый пароль">
        </div>
        
        <div class="form-group">
            <? if($user_row['login'] != $db_root['login']):?>
            <label for="type">Уровень доступа:</label>
            <select id="type" name="perm">
                <option value="">-- Выберите тип доступа --</option>
                <option value="admin" <?= ($user_row['perm'] ?? '') === 'admin' ? 'selected' : '' ?>>Администратор</option>
                <option value="user" <?= ($user_row['perm'] ?? '') === 'user' ? 'selected' : '' ?>>Пользователь</option>
        </select>
    </div>
    <? endif; ?>
    
    
    <button type="submit" class="btn btn-primary">Изменить</button>
</form>
        </div>
    </body>
    </html>
<? else: ?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<? endif; ?>