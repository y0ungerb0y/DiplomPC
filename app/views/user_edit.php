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
        <link href="<? $ROOT ?>/css/user_edit.css" rel="stylesheet">
        <title>Редактировать пользователя</title>
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
            <label for="type">Уровень доступа:</label>
            <select id="type" name="perm">
                <option value="">-- Выберите тип доступа --</option>
                <option value="admin" <?= ($user_row['perm'] ?? '') === 'admin' ? 'selected' : '' ?>>Администратор</option>
                <? if (!in_array($value['login'], $db_root['login'])): ?>
                    <option value="user" <?= ($user_row['perm'] ?? '') === 'user' ? 'selected' : '' ?>>Пользователь</option>
                <? endif; ?>
        </select>
    </div>
    
    
    
    <button type="submit" class="btn btn-primary">Изменить</button>
</form>
        </div>
    </body>
    </html>
<? else: ?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<? endif; ?>