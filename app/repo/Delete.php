<?php 
if ($row['perm'] == 'admin')
{
    $id = $_GET["id"] ?? "";
    $type = $_GET["type"] ?? "";

    if (!isset($tables[$type])) {
        die("Неверный тип!");
    }

    $database = $tables[$type]; 

    $sql = "DELETE FROM $database WHERE id = '$id'";
    $row = $pdo->query($sql);
    header("Location: ". $_SERVER['HTTP_REFERER']);
}
else
{
    echo '<h1> Недостаточно прав! </h1>';     
}

