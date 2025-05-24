<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<? $ROOT ?>/css/admin_components_view.css" rel="stylesheet">
    <title>Личный кабинет - Список комплектующих</title>
</head>
<body>
    <div class="container">
        <h1>Список комплектующих</h1>
        <div class="back-button">
            <a href="/cabinet">Назад</a>
        </div>

        <?php
        $cookie = $_COOKIE['token'];

        if (!isset($cookie)) {
            header("location: /auth");
            exit;
        } else {
            $sql = "SELECT perm FROM users WHERE token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['token' => $cookie]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if ($row['perm'] == 'admin'): ?>
            <div class="admin-buttons">
                <a href="/cabinet/component/add">Добавить</a>
            </div>
        </div>
        <? endif; ?>
            
        <ul class="computer-list">
                <?php
                $sql = "SELECT * FROM components";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $components = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($components as $component): ?>
                    <li class="computer-item">
                        <p><span class="computer-item-label">Название:</span> <span class="computer-item-value"><?= htmlspecialchars($component['name']); ?></span></p>
                        <p><span class="computer-item-label">Тип:</span> <span class="computer-item-value"><?= htmlspecialchars($component_type[$component['type']]); ?></span></p>
                        <p><span class="computer-item-label">Количество:</span> <span class="computer-item-value"><?= htmlspecialchars($component['quantity']); ?></span></p>
                    <? if ($row['perm'] == 'admin'): ?>
                        <a href="javascript:void(0);" onclick="showDeleteModal(<?= $component['id'] ?>)" class="delete-btn">Удалить</a>
                    <? endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
    </div>
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Вы действительно хотите удалить этот компонент?</p>
        <button id="confirmYes" style="background: #dc3545; color: white; border: none; padding: 8px 15px; margin-right: 10px;">Да, удалить</button>
        <button id="confirmNo" style="background: #6c757d; color: white; border: none; padding: 8px 15px;">Отмена</button>
    </div>
</div>
<script src="<?$ROOT?>/js/admin_components_view.js"></script>  
</body>
</html>


