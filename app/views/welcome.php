<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMP LOCAL - Добро пожаловать!</title>
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
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
        }

        h4 {
            color: #666;
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

        button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c82333;
        }

        form {
            display: inline-block; /* Чтобы кнопка была на той же строке, что и ссылка */
            margin-left: 10px;
        }
    </style>
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