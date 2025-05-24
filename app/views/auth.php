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
    <link href="<?$ROOT?>/css/auth.css" rel="stylesheet">
    <title>Авторизация</title>
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
    <script src="<?$ROOT?>/js/auth.js"> </script>
</body>
</html>