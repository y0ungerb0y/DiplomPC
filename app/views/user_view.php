<? if ($row['perm'] == 'admin'): ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<? $ROOT ?>/css/user_view.css" rel="stylesheet">
        <title>Информация о пользователе</title>
    </head>
    <body>
        <div class="container">
            <?php
            $id = $_GET['id'] ?? null;

            if (!$id) {
                echo "<p class='error-message'>ID пользователя не найден .</p>";
            } else {
                $sql = "SELECT * FROM users WHERE id = :id";
                $stmt = $pdo->prepare($sql);    
                $stmt->execute(['id' => $id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    echo "<h2>Информация о пользователе</h2>";
                    echo "<p><span class='label'>Ф.И.О:</span> <span class='value'>" . htmlspecialchars($row['name']) . "</span></p>";
                    echo "<p><span class='label'>Логин:</span> <span class='value'>" . htmlspecialchars($row['login']) . "</span></p>";
                    echo "<p><span class='label'>Уровень доступа:</span> <span class='value'>" . htmlspecialchars($perm[$row['perm']]) . "</span></p>";
                } else {
                    echo "<p class='error-message'>Пользователь с ID $id не найден.</p>";
                }
            }
            ?>

            <a href="javascript:history.back()" class="button">Назад</a>
        </div>
    </body>
    </html>
<? else: ?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<? endif; ?>