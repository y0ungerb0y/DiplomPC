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
        <title>История перемещений | COMP LOCAL</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            
            .container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 30px;
                max-width: 1200px;
                margin: 0 auto;
            }
            
            h2 {
                color: #333;
                margin-bottom: 20px;
                text-align: center;
            }
            
            .transfer-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            
            .transfer-table th {
                background-color: #007bff;
                color: white;
                padding: 12px;
                text-align: left;
            }
            
            .transfer-table td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }
            
            .transfer-table tr:nth-child(even) {
                background-color: #f8f9fa;
            }
            
            .transfer-table tr:hover {
                background-color: #e9ecef;
            }
            
            .back-link {
                display: inline-block;
                background-color: #6c757d;
                color: white;
                padding: 10px 15px;
                border-radius: 5px;
                text-decoration: none;
                margin-top: 20px;
            }
            
            .back-link:hover {
                background-color: #5a6268;
            }
            
            .empty-message {
                text-align: center;
                padding: 20px;
                color: #6c757d;
                font-style: italic;
            }
            
            .badge {
                display: inline-block;
                padding: 3px 6px;
                border-radius: 3px;
                font-size: 12px;
                background-color: #e9ecef;
                color: #495057;
            }
        </style>
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
    echo "<h1> Нетдостаточно прав! </h1>";

endif;
?>