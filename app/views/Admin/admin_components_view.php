<?php

if (!isset($cookie)) {
            header("location: /auth");
            exit;
        } else {
            $sql = "SELECT perm FROM users WHERE token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['token' => $cookie]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

if ($row['perm'] == 'admin'):
    $sql = 'SELECT * FROM components';
    $stmt = $pdo->query($sql);
    $row = $stmt->fetchall(PDO::FETCH_ASSOC);
    foreach ($row as $value):?>

        <div>Компонент <?=$value['component']?></div>
        <div>Тип: <?=$value['type']?></div><br>
        <a href="/api/deleteuser?id=<?= htmlspecialchars($value['id']); ?>"><button>Удалить</button></a>
        <a href="/cabinet/computer/view?id=<?= htmlspecialchars($value['id']); ?>"><button>Детальный просмотр</button></a>
        <a href="/api/deleteuser=<?= htmlspecialchars($value['id']); ?>"><button>Изменить</button></a><br><br>
    <?endforeach?>
<?endif;?>