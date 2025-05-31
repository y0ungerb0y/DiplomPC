<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<? $ROOT ?>/css/computer_view.css" rel="stylesheet">
    <title>Информация о компьютере</title>
</head>
<body>
    <div class="container">
        <?php
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "<p class='error-message'>ID компьютера не указан.</p>";
        } else {
            $sql = "SELECT 
            c.computer_number, c.motherboard, c.memory, c.processor, 
            c.videocard, c.harddisk, c.responsible_person,
            u.id as user_id, u.name as user_name
            FROM computers c
            LEFT JOIN users u ON c.responsible_person = u.id
            WHERE c.id = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo "<p><span class='label'>Номер компьютера:</span> <span class='value'>" . htmlspecialchars($row['computer_number']) . "</span></p>";
                echo "<p><span class='label'>Материнская плата:</span> <span class='value'>" . htmlspecialchars($row['motherboard']) . "</span></p>";
                echo "<p><span class='label'>Оперативная память:</span> <span class='value'>" . htmlspecialchars($row['memory']) . "</span></p>";
                echo "<p><span class='label'>Процессор:</span> <span class='value'>" . htmlspecialchars($row['processor']) . "</span></p>";
                echo "<p><span class='label'>Видеокарта:</span> <span class='value'>" . htmlspecialchars($row['videocard']) . "</span></p>";
                echo "<p><span class='label'>Запоминающие устройства:</span> <span class='value'>" . htmlspecialchars($row['harddisk']) . "</span></p>";
                echo "<p><span class='label'>Ответственный:</span> <span class='value'>" . htmlspecialchars($row['user_name']) . "</span></p>";
            } else {
                echo "<p class='error-message'>Компьютер с ID $id не найден.</p>";
            }
        }
        ?>

        <a href="javascript:history.back()" class="button">Вернуться в личный кабинет</a>
    </div>
</body>
</html>