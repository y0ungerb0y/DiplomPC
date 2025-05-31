<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<? $ROOT ?>/css/admin_computers_view.css" rel="stylesheet">
    <title>Личный кабинет - Список компонентов</title>
</head>
<body>
    <div class="container">
        <h1>Список компьютеров</h1>

        <div class="back-button">
            <a href="/cabinet">Назад</a>
        </div>

        <?php
        if ($row['perm'] == 'admin'): ?>
            <div class="admin-buttons">
                <a href="/cabinet/computer/history">История</a>
                <a href="/cabinet/computer/add">Добавить</a>     
                <form method="POST" action="/cabinet/generateReport">
                    <button type="submit" name="generate_report">Сгенерировать отчет</button>
                </form>          
            </div>
                
            </div>
        <?endif;?>

            <ul class="computer-list">
                <?php
                $sql = "SELECT id, computer_number, current_room FROM computers";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $computers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($computers as $computer): ?>
                    <li class="computer-item">
                        <p><span class="computer-item-label">ID:</span> <span class="computer-item-value"><?= htmlspecialchars($computer['id']); ?></span></p>
                        <p><span class="computer-item-label">Номер:</span> <span class="computer-item-value"><?= htmlspecialchars($computer['computer_number']); ?></span></p>
                        <p><span class="computer-item-label">Кабинет:</span> <span class="computer-item-value"><?= htmlspecialchars($computer['current_room']); ?></span></p>
                        <? if ($row['perm'] == 'admin'): ?>
                            <a href="javascript:void(0);" onclick="showDeleteModal(<?= $computer['id'] ?>)" class="delete-btn">Удалить</a>
                            <a href="/cabinet/computer/view?id=<?= htmlspecialchars($computer['id']); ?>">Детальный просмотр</a>
                            <a href="/cabinet/computer/transfer?id=<?= htmlspecialchars($computer['id']); ?>">Переместить</a>
                        <? endif;?>

                    </li>
                <?php endforeach; ?>
            </ul>
    </div>
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Вы действительно хотите удалить этот компьютер?</p>
        <button id="confirmYes" style="background: #dc3545; color: white; border: none; padding: 8px 15px; margin-right: 10px;">Да, удалить</button>
        <button id="confirmNo" style="background: #6c757d; color: white; border: none; padding: 8px 15px;">Отмена</button>
    </div>
</div>
<script src="<?$ROOT?>/js/admin_computers_view.js"></script>  
</body>
</html>

