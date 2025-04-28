<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информация о компьютере</title>
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
            width: 80%;
            max-width: 600px;
            text-align: left;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 150px; 
        }

        .value {
            color: #777;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            display: block;
            margin: 20px auto; 
            text-decoration: none; 
            width: fit-content; 
        }

        .button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php
        include("./app/core/config.php");

        $id = $_GET['id'];

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
            echo "<p class='error-message'>Компьютер не найден.</p>";
        }
        ?>

        <a href="/cabinet" class="button">Личный кабинет</a>
    </div>

</body>
</html>