<?php
header('Content-Type: application/json');

$login = trim($_POST['login'] ?? '');
$password = trim($_POST['password'] ?? '');


if (empty($login) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Заполните все поля'
    ]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
$stmt->execute([$login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);



if (!$user || $user['pass'] !== $password) {
    echo json_encode([
        'success' => false,
        'message' => 'Неверный логин или пароль'
    ]);
    exit;
}
$token = createToken();   
setcookie("token", $token, time() + 3600, '/');
$pdo->query("UPDATE users SET token = '$token' WHERE login = '$login'");

echo json_encode([
    
    'success' => true,
    'message' => 'Авторизация успешна'
]);
function createToken()
{
    return base64_encode(date('l js \of F Y h:i:s A') . rand(1, 1000000));
}