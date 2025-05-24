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
            $sql = "SELECT computer_number, motherboard, memory, processor, videocard, harddisk FROM computers WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo "<h2>Информация о компьютере</h2>";
                echo "<p><span class='label'>Номер компьютера:</span> <span class='value'>" . htmlspecialchars($row['computer_number']) . "</span></p>";
                echo "<p><span class='label'>Материнская плата:</span> <span class='value'>" . htmlspecialchars($row['motherboard']) . "</span></p>";
                echo "<p><span class='label'>Оперативная память:</span> <span class='value'>" . htmlspecialchars($row['memory']) . "</span></p>";
                echo "<p><span class='label'>Процессор:</span> <span class='value'>" . htmlspecialchars($row['processor']) . "</span></p>";
                echo "<p><span class='label'>Видеокарта:</span> <span class='value'>" . htmlspecialchars($row['videocard']) . "</span></p>";
                echo "<p><span class='label'>Запоминающие устройства:</span> <span class='value'>" . htmlspecialchars($row['harddisk']) . "</span></p>";
            } else {
                echo "<p class='error-message'>Компьютер с ID $id не найден.</p>";
            }
        }
        ?>

        <a href="javascript:history.back()" class="button">Вернуться в личный кабинет</a>
    </div>
</body>
</html>