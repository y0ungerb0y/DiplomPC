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
        input[type="number"] {
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
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Расположение checkbox и label в одну строку */
        .moved-group {
            display: flex;
            align-items: center;
        }

        .moved-group label {
            margin-right: 10px;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Добавить компьютер</h1>

        <form action="/api/addcomputer" method="POST">
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
                <input type="text" id="memory" name="memory" required>
            </div>

            <div class="form-group">
                <label for="motherboard">Материнская плата:</label>
                <input type="text" id="motherboard" name="motherboard" required>
            </div>

            <div class="form-group">
                <label for="processor">Процессор:</label>
                <input type="text" id="processor" name="processor" required>
            </div>

            <div class="form-group">
                <label for="videocard">Видеокарта:</label>
                <input type="text" id="videocard" name="videocard" required>
            </div>

            <div class="form-group">
                <label for="harddisk">Запоминающие устройства:</label>
                <input type="text" id="harddisk" name="harddisk" required>
            </div>

            <button type="submit">Добавить</button>
        </form>
    </div>

</body>
</html>