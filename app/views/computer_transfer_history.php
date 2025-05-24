<?php
if($row['perm'] == 'admin'):

    $transfers = $pdo->query("
        SELECT 
            computer_transfers.*,
            users.name as user_name,
            computers.computer_number
        FROM computer_transfers
        INNER JOIN users ON users.id = computer_transfers.transferred_by
        INNER JOIN computers ON computers.id = computer_transfers.computer_id
        ORDER BY computer_transfers.transfer_date DESC
    ")->fetchAll();
    ?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?$ROOT?>/css/computer_transfer_history.css" rel="stylesheet">
        <title>История перемещений | COMP LOCAL</title>
    </head>
    <body>
        <div class="container">
            <h2><i class="bi bi-clock-history"></i> История перемещений компьютеров</h2>
            
            <?php if (empty($transfers)): ?>
                <div class="empty-message">
                    <p>Нет данных о перемещениях</p>
                </div>
            <?php else: ?>
                <table class="transfer-table">
                    <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Компьютер</th>
                            <th>Перемещение</th>
                            <th>Ответственный</th>
                            <th>Причина</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transfers as $transfer): ?>
                        <tr>
                            <td><?= date('d.m.Y H:i', strtotime($transfer['transfer_date'])) ?></td>
                            <td>PC-<?= htmlspecialchars($transfer['computer_number']) ?></td>
                            <td>
                                <span class="badge">Из кабинета <?= htmlspecialchars($transfer['from_room']) ?></span>
                                <i class="bi bi-arrow-right"></i>
                                <span class="badge">В кабинет <?= htmlspecialchars($transfer['to_room']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($transfer['user_name']) ?></td>
                            <td><?= htmlspecialchars($transfer['reason'] ?? '—') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <a href="/cabinet?include=computers" class="back-link">
                <i class="bi bi-arrow-left"></i> Личный кабинет
            </a>
        </div>
    </body>
    </html>
<? 
else:
    echo "<h1> Недостаточно прав! </h1>";

endif;
?>