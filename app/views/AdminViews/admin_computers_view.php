<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Список компонентов</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 800px;
            margin: 0 auto; 
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-buttons a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .admin-buttons a:hover {
            background-color: #0056b3;
        }

        .computer-list {
            list-style: none;
            padding: 0;
        }

        .computer-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .computer-item p {
            margin: 5px 0;
        }

        .computer-item a {
            display: inline-block;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .computer-item a:hover {
            background-color: #c82333;
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            display: inline-block;
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #5a6268;
        }

        .computer-item-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 100px; 
        }

        .computer-item-value {
            color: #777;
        }
    </style>
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
</body>
</html>

<script>
let currentIdToDelete = null;
const modal = document.getElementById('confirmModal');

function showDeleteModal(id) {
    currentIdToDelete = id;
    modal.style.display = 'flex';
}

document.getElementById('confirmYes').addEventListener('click', function() {
    if (currentIdToDelete) {
        window.location.href = `/api/delete?id=${currentIdToDelete}&type=computer`;
    }
});

document.getElementById('confirmNo').addEventListener('click', function() {
    modal.style.display = 'none';
    currentIdToDelete = null;
});

modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        modal.style.display = 'none';
        currentIdToDelete = null;
    }
});
</script>