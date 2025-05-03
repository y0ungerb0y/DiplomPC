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
        <title>Перенос компьютера</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                position: relative;
            }

            .container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 30px;
                width: 80%;
                max-width: 600px;
            }

            h1 {
                color: #333;
                text-align: center;
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
            }
            input[type="number"],
            input[type="text"],
            select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
            }

            button {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 12px 25px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                font-size: 16px;
                width: 100%;
            }

            button:hover {
                background-color: #0056b3;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .back-button {
                background-color: #6c757d;
                color: #fff;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                font-size: 14px;
                text-decoration: none;
                position: absolute;
                top: 20px;
                left: 20px;
            }
            
            .back-button:hover {
                background-color: #5a6268;
            }

            .computer-info {
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
                border-left: 4px solid #007bff;
            }

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

            <!-- Информация о компьютере -->
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

    </body>
    </html>
<? 
else:

    echo "<h1> Нетдостаточно прав! </h1>";
endif;
?>