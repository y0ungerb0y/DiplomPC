<?php
$cookie = $_COOKIE['token'];

$sql = "SELECT id, perm, login FROM users WHERE token = :token";
$stmt = $pdo->prepare($sql);
$stmt->execute(['token' => $cookie]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>