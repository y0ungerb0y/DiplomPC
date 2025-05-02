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
    <title>Добавить компьютер</title>
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
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .moved-group {
            display: flex;
            align-items: center;
        }

        .moved-group label {
            margin-right: 10px;
        }
        .button.back {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-button {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            position: absolute;
            top: 20px;
            left: 20px;
        }
        
        .back-button:hover {
            background-color: #5a6268;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Добавить компьютер</h1>
        <a href="javascript:history.back()" class="back-button">← Назад</a>

        <form action="/api/add?type=computer" method="POST">
            <div class="form-group">
                <label for="number">Номер компьютера:</label>
                <input type="text" id="number" name="number" required>
            </div>

            <div class="form-group moved-group">
                <label for="moved">Перемещен:</label>
                <input type="checkbox" id="moved" name="moved" value="true">
            </div>

            <div class="form-group">
                <label for="memory">Оперативная память:</label>
                <select id="memory" name="memory" required>
                    <option value="">-- Выберите ОЗУ --</option>
                    <?php foreach($rams as $ram): ?>
                        <option value="<?= $ram['component'] ?>"><?= $ram['component'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="motherboard">Материнская плата:</label>
                <select id="motherboard" name="motherboard" required>
                    <option value="">-- Выберите мат. плату --</option>
                    <?php foreach($motherboards as $mb): ?>
                        <option value="<?= $mb['component'] ?>"><?= $mb['component'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="processor">Процессор:</label>
                <select id="processor" name="processor" required>
                    <option value="">-- Выберите процессор --</option>
                    <?php foreach($cpus as $cpu): ?>
                        <option value="<?= $cpu['component'] ?>"><?= $cpu['component'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="videocard">Видеокарта:</label>
                <select id="videocard" name="videocard" required>
                    <option value="">-- Выберите видеокарту --</option>
                    <?php foreach($gpus as $gpu):?>
                        <option value="<?= $gpu['component'] ?>"><?= $gpu['component'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="harddisk">Накопитель:</label>
                <select id="harddisk" name="harddisk" required>
                <option value="">-- Выберите ПЗУ --</option>
                    <?php foreach($storages as $storage): ?>
                        <option value="<?= $storage['component'] ?>"><?= $storage['component'] ?></option>
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