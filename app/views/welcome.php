<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<? $ROOT ?>/css/welcome.css" rel="stylesheet">
    <title>COMP LOCAL - Добро пожаловать!</title>
</head>
<body>

    <div class="container">
        <h1>COMP LOCAL</h1>
        <h4>Добро пожаловать!</h4>

        <?php if (!isset($_COOKIE['token'])): ?>
            <a href="/auth">Авторизация</a>
        <?php endif; ?>

        <?php if (isset($_COOKIE['token'])): ?>
            <a href="/cabinet">Личный кабинет</a>
            <form method="POST" action="/logout">
                <button type="submit">Выход</button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>