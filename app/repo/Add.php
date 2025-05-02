<?php
$type = $_GET["type"] ?? "";

if($type === 'computer'){
    $number = $_POST["number"];
    $motherboard = $_POST["motherboard"];
    $videocard = $_POST["videocard"];
    $processor = $_POST["processor"];
    $memory = $_POST["memory"];
    $harddisk = $_POST["harddisk"];


    $moved = isset($_POST["moved"]) ? 1 : 0; 

    if (empty($number)) {
        die("Номер компьютера не может быть пустым.");
    }

    $sql = "INSERT INTO computers (computer_number, move_it, motherboard, videocard, processor, memory, harddisk) VALUES (:number, :moved, :motherboard, :videocard, :processor, :memory, :harddisk)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['number' => $number, 'moved' => $moved, 'motherboard' => $motherboard, 'videocard' => $videocard, 'processor' => $processor, 'memory' => $memory, 'harddisk' => $harddisk]);

    header("Location: /cabinet");
    exit;
}
elseif($type === 'component')
{
    $name= $_POST["name"];
    $type = $_POST["type"];

    if (empty($name)) {
        die("Имя не должно быть пустым!");
    }

    $sql = "INSERT INTO components (component, type) VALUES (:name, :type)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'type' => $type]);

    header("Location: /cabinet");
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

    header("Location: /cabinet");
    exit;
}
else
{
    echo 'Непредвиденная ошибка';
}