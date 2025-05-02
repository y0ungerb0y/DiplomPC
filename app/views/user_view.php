<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информация о пользователе</title>
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
            position: relative;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 600px;
            text-align: left;
            position: relative;
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
            text-align: center;
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
                echo "<p><span class='label'>Уровень доступа:</span> <span class='value'>" . htmlspecialchars($row['perm']) . "</span></p>";
            } else {
                echo "<p class='error-message'>Пользователь с ID $id не найден.</p>";
            }
        }
        ?>

        <a href="javascript:history.back()" class="button">Назад</a>
    </div>
</body>
</html>