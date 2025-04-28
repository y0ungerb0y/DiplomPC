<?php 
include("./app/core/config.php");

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