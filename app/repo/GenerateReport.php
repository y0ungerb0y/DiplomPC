<?php
$sql = "
SELECT 
    u.id AS user_id,
    u.name AS user_name,
    stats.responsible_person,
    stats.computers_count,
    stats.pc_list,
    stats.rooms
FROM (
    SELECT 
        responsible_person,
        COUNT(*) AS computers_count,
        GROUP_CONCAT(computer_number SEPARATOR ', ') AS pc_list,
        GROUP_CONCAT(DISTINCT current_room SEPARATOR ', ') AS rooms
    FROM computers
    GROUP BY responsible_person
) AS stats
INNER JOIN users u ON stats.responsible_person = u.id
ORDER BY stats.responsible_person;
";

try {
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка запроса: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчет по компьютерам</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .report-header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .table-responsive {
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .table thead {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .print-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .print-btn:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        @media print {
            .no-print, .print-btn {
                display: none !important;
            }
            body {
                padding: 0;
                font-size: 12pt;
            }
            .report-header {
                background-color: white !important;
                color: black !important;
                padding: 10px 0 !important;
            }
            .table {
                width: 100% !important;
            }
            .table th {
                background-color: #f1f1f1 !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="report-header text-center">
            <h1>Отчет по компьютерам</h1>
            <p class="mb-0">Актуальные данные на <?= date('d.m.Y') ?></p>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Отвественный</th>
                        <th>Количество ПК</th>
                        <th>Список ПК</th>
                        <th>Кабинет</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($row['user_name']) ?></td>
                        <td class="text-center"><?= $row['computers_count'] ?></td>
                        <td><?= htmlspecialchars($row['pc_list']) ?></td>
                        <td><?= htmlspecialchars($row['rooms'] ?? 'Нет данных') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="no-print text-center">
            <button class="print-btn" onclick="window.print()">
                <i class="bi bi-printer-fill"></i> Печать отчета
            </button>
            <button class="print-btn" onclick="exportToExcel()" style="background-color: #17a2b8; margin-left: 10px;">
                <i class="bi bi-file-earmark-excel"></i> Экспорт в Excel
            </button>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <script>
        function exportToExcel() {
            // Реализация экспорта в Excel
            let table = document.querySelector('table');
            let html = table.outerHTML;
            
            // Создаем Blob и скачиваем файл
            let blob = new Blob([html], {type: 'application/vnd.ms-excel'});
            let a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = 'Отчет_по_компьютерам_<?= date('d-m-Y') ?>.xls';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
</body>
</html>