<?php if ($row['perm'] == 'admin'): ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<? $ROOT ?>/css/user_add.css" rel="stylesheet">
    <title>Добавить пользователя</title>
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
    <script src="<?$ROOT?>/js/user_add.js"></script>  
</body>
</html>
<?php else: ?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<?php endif; ?>