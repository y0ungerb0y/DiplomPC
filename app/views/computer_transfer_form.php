<?php
if($row['perm'] == 'admin'):


    $computer_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $stmt = $pdo->prepare("SELECT id, computer_number, current_room FROM computers WHERE id = ?");
    $stmt->execute([$computer_id]);
    $computer = $stmt->fetch();

    if (!$computer) {
        header("Location: computers.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $to_room = trim($_POST['to_room']);
        $reason = trim($_POST['reason'] ?? '');
        $from_room = $computer['current_room'];
        $date = date('Y-m-d H:i:s');
        
        if ($from_room === $to_room) {
            $error = "Компьютер уже находится в указанном кабинете!";
        } else {
            try {
                $pdo->beginTransaction();
    
                $stmt = $pdo->prepare("UPDATE computers SET current_room = ? WHERE id = ?");
                $stmt->execute([$to_room, $computer_id]);
                
                $stmt = $pdo->prepare("INSERT INTO computer_transfers 
                                    (computer_id, from_room, to_room, transferred_by, reason, transfer_date) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $computer_id,
                    $from_room,
                    $to_room,
                    $row['id'], 
                    $reason,
                    $date
                ]);
                
                $pdo->commit();
                $success = "Компьютер успешно перенесён из $from_room в $to_room кабинет";
                $computer['current_room'] = $to_room; 
                
            } catch (PDOException $e) {
                $pdo->rollBack();
                $error = "Ошибка при переносе: " . $e->getMessage();
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?$ROOT?>/css/computer_transfer_form.css" rel="stylesheet">
        <title>Перенос компьютера</title>
    </head>
    <body>

        <div class="container">
            <h1>Перенос компьютера</h1>
            <a href="javascript:history.back()" class="back-button">← Назад</a>

            <?php if (isset($error)): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="success-message"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <div class="computer-info">
                <p><strong>Компьютер:</strong> PC-<?= htmlspecialchars($computer['computer_number']) ?></p>
                <p><strong>Текущий кабинет:</strong> <?= htmlspecialchars($computer['current_room']) ?></p>
            </div>
            <form method="POST">
                <input type="hidden" name="computer_id" value="<?= htmlspecialchars($computer['id']) ?>">
                
                <div class="form-group">
                    <label for="from_room">Из кабинета:</label>
                    <input type="number" id="from_room" name="from_room" value="<?= htmlspecialchars($computer['current_room']) ?>" readonly>
                </div>
                
                <div class="form-group">
                    <label for="to_room">В кабинет:</label>
                    <input type="number" id="to_room" name="to_room" required>
                </div>
                
                <div class="form-group">
                    <label for="reason">Причина переноса:</label>
                    <input type="text" id="reason" name="reason" placeholder="Например: ремонт, замена оборудования">
                </div>

                <button type="submit">Подтвердить перенос</button>
            </form>
        </div>
            <style>
                .error-message {
                    color: #dc3545;
                    background-color: #f8d7da;
                    padding: 10px;
                    border-radius: 5px;
                    margin-bottom: 15px;
                    display: <?= isset($error) ? 'block' : 'none' ?>;
                }

                .success-message {
                    color: #28a745;
                    background-color: #d4edda;
                    padding: 10px;
                    border-radius: 5px;
                    margin-bottom: 15px;
                    display: <?= isset($success) ? 'block' : 'none' ?>;
                }
            </style>
    </body>
    </html>
<? 
else:
    echo "<h1> Недостаточно прав! </h1>";
endif;
?>