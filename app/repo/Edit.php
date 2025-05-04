<?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $pass = $_POST['pass'] ?? '';
    $perm = $_POST['perm'] ?? '';
    $id = $_POST['id'] ?? '';


    if (empty($name) || empty($perm) || empty($id)) {
        $error = "Заполните все обязательные поля!";
    } else {
        try {
            if (!empty($pass)) {
                $stmt = $pdo->prepare("UPDATE users SET name = ?, pass = ?, perm = ? WHERE id = ?");
                $stmt->execute([$name, $pass, $perm, $id]);
            } else {
                $stmt = $pdo->prepare("UPDATE users SET name = ?, perm = ? WHERE id = ?");
                $stmt->execute([$name, $perm, $id]);
            }
            
            $success = "Данные пользователя успешно обновлены!";
            $user_row['name'] = $name;
            $user_row['type'] = $perm;

            header('Location: /cabinet?include=users');
            
        } catch (PDOException $e) {
            $error = "Ошибка базы данных: " . $e->getMessage();
        }
    }
}
?>