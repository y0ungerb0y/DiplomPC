<? if ($row['perm'] == 'admin'): ?>
<?php
$rams = $pdo->query("SELECT * FROM components WHERE type='ram'")->fetchAll();
$motherboards = $pdo->query("SELECT * FROM components WHERE type='motherboard'")->fetchAll();
$cpus = $pdo->query("SELECT * FROM components WHERE type='cpu'")->fetchAll();
$gpus = $pdo->query("SELECT * FROM components WHERE type='gpu'")->fetchAll();
$storages = $pdo->query("SELECT * FROM components WHERE type='storage'")->fetchAll();
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?$ROOT?>/css/computer_add.css" rel="stylesheet">
    <title>Добавить компьютер</title>
</head>
<body>

    <div class="container">
        <h1>Добавить компьютер</h1>
        <a href="javascript:history.back()" class="back-button">← Назад</a>

        <form action="/api/add?type=computer" method="POST">
            <div class="form-group">
                <label for="number">Номер компьютера:</label>
                <input type="number" id="number" name="number" required>
            </div>
            <div class="form-group">
                <label for="memory">Оперативная память:</label>
                <select id="memory" name="memory" required>
                    <option value="">-- Выберите ОЗУ --</option>
                    <?php foreach($rams as $ram): ?>
                        <option value="<?= $ram['name'] ?>"><?= $ram['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="motherboard">Материнская плата:</label>
                <select id="motherboard" name="motherboard" required>
                    <option value="">-- Выберите мат. плату --</option>
                    <?php foreach($motherboards as $mb): ?>
                        <option value="<?= $mb['name'] ?>"><?= $mb['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="processor">Процессор:</label>
                <select id="processor" name="processor" required>
                    <option value="">-- Выберите процессор --</option>
                    <?php foreach($cpus as $cpu): ?>
                        <option value="<?= $cpu['name'] ?>"><?= $cpu['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="videocard">Видеокарта:</label>
                <select id="videocard" name="videocard" required>
                    <option value="">-- Выберите видеокарту --</option>
                    <?php foreach($gpus as $gpu):?>
                        <option value="<?= $gpu['name'] ?>"><?= $gpu['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="harddisk">Накопитель:</label>
                <select id="harddisk" name="harddisk" required>
                <option value="">-- Выберите ПЗУ --</option>
                    <?php foreach($storages as $storage): ?>
                        <option value="<?= $storage['name'] ?>"><?= $storage['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Добавить</button>
        </form>
    </div>
</body>
</html>
<?else: ?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<?endif;?>