<?php
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
    elseif($type === 'user')
    {

        $name = $_POST["name"];
        $login = $_POST["login"];
        $pass = $_POST["pass"];
        $perm = $_POST["type"];

        if (empty($name)) {
            die("Имя не должно быть пустым!");
        }

        $sql = "INSERT INTO users (name, login, pass, perm) VALUES (:name, :login, :pass, :perm)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'login' => $login, 'pass' => $pass, 'perm' => $perm]);

        header("Location: /cabinet?include=users");
        exit;
    }
    else
    {
        echo 'Непредвиденная ошибка';
    }
}
else
{
    echo '<h1> Недостаточно прав! </h1>';
}