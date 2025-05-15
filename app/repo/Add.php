<?php
header('Content-Type: application/json');
if ($row['perm'] == 'admin'){
    $type = $_GET["type"] ?? "";

    if($type === 'computer'){
        $number = $_POST["number"];
        $motherboard = $_POST["motherboard"];
        $videocard = $_POST["videocard"];
        $processor = $_POST["processor"];
        $memory = $_POST["memory"];
        $harddisk = $_POST["harddisk"];


        if (empty($number)) {
            die("Номер компьютера не может быть пустым.");
        }
        $sql = "INSERT INTO computers (computer_number, motherboard, videocard, processor, memory, harddisk) VALUES (:number, :motherboard, :videocard, :processor, :memory, :harddisk)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['number' => $number, 'motherboard' => $motherboard, 'videocard' => $videocard, 'processor' => $processor, 'memory' => $memory, 'harddisk' => $harddisk]);

        header("Location: /cabinet?include=computers");
        exit;
    }
    elseif($type === 'component')
    {
        $name = trim($_POST['name']);
        $type = trim($_POST['type']);
        $quantity = (int)$_POST['quantity'];
        
        $stmt = $pdo->prepare("SELECT id, quantity FROM components WHERE name = ? AND type = ?");
        $stmt->execute([$name, $type]);
        $existing = $stmt->fetch();
        
        if ($existing) {
            $newQuantity = $existing['quantity'] + $quantity;
            $update = $pdo->prepare("UPDATE components SET quantity = ? WHERE id = ?");
            $update->execute([$newQuantity, $existing['id']]);
            $message = "Количество компонента увеличено на $quantity. Теперь: $newQuantity шт.";
        } else {
            $insert = $pdo->prepare("INSERT INTO components (name, type, quantity) VALUES (?, ?, ?)");
            $insert->execute([$name, $type, $quantity]);
            $message = "Новый компонент добавлен: $quantity шт.";
        }
        header("Location: /cabinet?include=components&message=" . urlencode($message));
        exit;
    }
elseif($type === 'user') {
    header('Content-Type: application/json');
    
    try {
        $name = trim($_POST["name"] ?? '');
        $login = trim($_POST["login"] ?? '');
        $pass = $_POST["pass"] ?? '';
        $perm = $_POST["type"] ?? '';

        if (empty($name)) {
            throw new Exception('Имя пользователя не должно быть пустым!');
        }

        if (empty($login)) {
            throw new Exception('Логин не должен быть пустым!');
        }

        if (empty($pass)) {
            throw new Exception('Пароль не должен быть пустым!');
        }

        if (!in_array($perm, ['admin', 'user'])) {
            throw new Exception('Неверный уровень доступа!');
        }

        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
        $stmt->execute([':login' => $login]);

        if ($stmt->fetchColumn() > 0) {
            throw new Exception('Пользователь с таким логином уже существует!');
        }

        $sql = "INSERT INTO users (name, login, pass, perm) VALUES (:name, :login, :pass, :perm)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'login' => $login,
            'pass' => $pass,
            'perm' => $perm
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Пользователь успешно добавлен!'
        ]);
        exit;

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }

}
else
{
    echo '<h1> Недостаточно прав! </h1>';
}}