<? if ($row['perm'] == 'admin'): ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<? $ROOT ?>/css/admin_users_view.css" rel="stylesheet">
        <title>Личный кабинет - Список пользователей</title>
    </head>
    <body>
        <div class="container">
            <h1>Список пользователей</h1>

            <div class="back-button">
                <a href="/cabinet">Назад</a>
            </div>

            <?php
            $cookie = $_COOKIE['token'];

            if (!isset($cookie)) {
                header("location: /auth");
                exit;
            } 

            if ($row['perm'] == 'admin'): ?>
                <div class="admin-buttons">
                    <a href="/cabinet/user/add">Добавить</a>
                </div>
            </div>
                <ul class="computer-list">
                    <?php
                    $sql = 'SELECT id, name, perm, login FROM users';
                    $stmt = $pdo->query($sql);
                    $row_users = $stmt->fetchall(PDO::FETCH_ASSOC);
                    foreach ($row_users as $value):?>
                    
                        <li class="computer-item">
                            <p><span class="computer-item-label">Имя:</span> <span class="computer-item-value"><?= htmlspecialchars($value['name']) ?></span></p>
                            <p><span class="computer-item-label">Уровень доступа:</span> <span class="computer-item-value"><? echo htmlspecialchars($perm[$value['perm']]); ?></span></p>
                            <? if (!in_array($value['login'], $db_root['login'])): ?>
                                <a href="javascript:void(0);" onclick="showDeleteModal(<?= htmlspecialchars($value['id']) ?>)" class="delete-btn">Удалить</a>
                            <?php endif; ?>
                            <a href="/cabinet/user/view?id=<?= htmlspecialchars($value['id']); ?>">Просмотр</a>
                            <a href="/cabinet/user/edit?id=<?= htmlspecialchars($value['id']); ?>">Изменить</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; text-align: center;">
            <p>Вы действительно хотите удалить этого пользователя?</p>
            <button id="confirmYes" style="background: #dc3545; color: white; border: none; padding: 8px 15px; margin-right: 10px;">Да, удалить</button>
            <button id="confirmNo" style="background: #6c757d; color: white; border: none; padding: 8px 15px;">Отмена</button>
        </div>
    </div>
    <script src="<?$ROOT?>/js/admin_users_view.js"></script>  
    </body>
    </html>
<?endif;?>