<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<? $ROOT ?>/css/lk.css" rel="stylesheet">
    <title>Личный кабинет</title>
    
</head>
<body>

    <?php

    if (!isset($cookie)) {
        header("location: /auth");
        exit;
    } 
    else 
    {
        $sql = "SELECT name, perm FROM users WHERE token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['token' => $cookie]);
        $row_check_lk = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row_check_lk) {
            header("location: /auth");
            exit;
        }
    }
    ?>

    <div class="container">
        <a href="/" class="button back">← Назад</a>
        <h1>Личный кабинет</h1>
        <p>Здравствуйте, <?php echo htmlspecialchars($row_check_lk['name']); ?></p>
        <p>Уровень доступа: <?php echo htmlspecialchars($perm[$row['perm']]); ?></p>
        <div class="button-container">
            <a href="/cabinet?include=computers" class="button">Компьютеры</a>
            <a href="/cabinet?include=components" class="button">Комплектующие</a> 
            <? if ($row['perm'] == 'admin'): ?>
                <a href="/cabinet?include=users" class="button">Пользователи</a> 
            <? endif; ?>
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