<? if ($row['perm'] == 'admin'): ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить компонент</title>
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
        <h1>Добавить компонент</h1>
        <a href="javascript:history.back()" class="back-button">← Назад</a>

        <form action="/api/add?type=component" method="POST">

            <div class="form-group">
                <label for="motherboard">Название:</label>
                <input type="text" placeholder="Название" name="name" ></input>
            </div>

            <div class="form-group">
                <label for="type">Группа:</label>
                <select id="type" name="type" required>
                    <option value="">-- Выберите тип устройства --</option>
                    <option value="gpu">Видеокарта</option>
                    <option value="cpu">Процессор</option>
                    <option value="motherboard">Материнская плата</option>
                    <option value="ram">ОЗУ</option>
                    <option value="storage">ПЗУ</option>
                </select>
            </div>
            <button type="submit">Добавить</button>
        </form>
    </div>

</body>
</html>
<?else:?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<?endif;?>