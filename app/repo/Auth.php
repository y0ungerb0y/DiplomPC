<?php
include("./app/core/config.php");

$login = $_POST["login"];
$password = $_POST["password"];

$sql = "SELECT * FROM users WHERE login = :login";

$stmt = $pdo->prepare($sql);
$stmt->execute(['login' => $login]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row && is_array($row)){
    if ($row['pass'] == $password) 
    {
        $token = createToken();
        
        setcookie("token", $token, time() + 3600, '/');
        
        $pdo->query("UPDATE users SET token = '$token' WHERE login = '$login'");
        
        header('Location: /cabinet');
    }
    else
    {
        echo "Неверный логин или пароль.";
    }
}
else
{
    echo "Неверный логин или пароль.";
}
function createToken()
{
    return base64_encode(date('l js \of F Y h:i:s A') . rand(1, 1000000));
}