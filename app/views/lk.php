<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
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
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .included-content {
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <?php
    $cookie = $_COOKIE['token'];

    if (!isset($cookie)) {
        header("location: /auth");
        exit;
    } else {
        $sql = "SELECT name, perm FROM users WHERE token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['token' => $cookie]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            header("location: /auth");
            exit;
        }
    }
    ?>

    <div class="container">
        <h1>Личный кабинет</h1>
        <p>Здравствуйте, <?php echo htmlspecialchars($row['name']); ?></p>
        <p>Уровень доступа: <?php echo htmlspecialchars($row['perm']); ?></p>

        <div class="button-container">
            <a href="/cabinet?include=computers" class="button">Компьютеры</a>
            <a href="/cabinet?include=components" class="button">Комплектующие</a> 
            <a href="/cabinet?include=users" class="button">Пользователи</a> 
        </div>

        <div class="included-content">
            <?php
            if (isset($_GET['include'])) {
                $include = $_GET['include'];

                if ($include == 'computers') {
                    include('AdminViews/admin_computers_view.php');
                } elseif ($include == 'components') { 
                    include('AdminViews/admin_components_view.php'); 
                } elseif ($include == 'users') { 
                    include('AdminViews/admin_users_view.php'); 
                } else {
                    echo "<p>Выберите раздел для отображения.</p>";
                }
            } else {
                echo "<p>Выберите раздел для отображения.</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
