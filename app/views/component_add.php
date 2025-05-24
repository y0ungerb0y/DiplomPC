<? if ($row['perm'] == 'admin'): ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?$ROOT?>/css/component_add.css" rel="stylesheet">
    <title>Добавить компонент</title>
</head>
<body>

    <div class="container">
        <h1>Добавить компонент</h1>
        <a href="javascript:history.back()" class="back-button">← Назад</a>

        <form action="/api/add?type=component" method="POST">

            <div class="form-group">
                <label for="name">Название:</label>
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
                <div class="form-group">
                    <label for="quantity">Количество:</label>
                <input type="number" name="quantity" placeholder="Количество" min="1" value="1">
            </div>
            <button type="submit">Добавить</button>
        </form>
    </div>

</body>
</html>
<?else:?>
    <h1>Недостаточно прав для просмотра данной страницы!</h1>
<?endif;?>