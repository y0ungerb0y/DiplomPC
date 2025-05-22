<?php
    $host = $dbconfig["host"];
    $db = $dbconfig["db"];
    $user = $dbconfig["user"];
    $pass = $dbconfig["pass"];
    $charset = $dbconfig["charset"];

    try {
        $dsn_temp = "mysql:host=$host;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $pdo_temp = new PDO($dsn_temp, $user, $pass, $opt);
        
        $stmt = $pdo_temp->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'");
        $databaseExists = $stmt->fetch();
        
        if (!$databaseExists) {
            $pdo_temp->exec("CREATE DATABASE `$db` CHARACTER SET $charset");
            echo "База данных '$db' успешно создана.<br>";
            
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $pdo = new PDO($dsn, $user, $pass, $opt);
            
            $pdo->exec("SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO'");
            $pdo->exec("SET time_zone = '+00:00'");
            
            $pdo->exec("
            CREATE TABLE `components` (
                `id` int NOT NULL,
                `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                `type` varchar(32) NOT NULL,
                `quantity` int NOT NULL DEFAULT '1'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");
            
            $pdo->exec("
            CREATE TABLE `computers` (
                `id` int NOT NULL,
                `computer_number` int NOT NULL,
                `motherboard` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                `videocard` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                `processor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                `memory` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                `harddisk` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                `current_room` varchar(50) NOT NULL DEFAULT 'Кабинет 101'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");
            
            $pdo->exec("
            CREATE TABLE `computer_transfers` (
                `id` int NOT NULL,
                `computer_id` int NOT NULL,
                `from_room` varchar(50) NOT NULL,
                `to_room` varchar(50) NOT NULL,
                `transferred_by` int NOT NULL,
                `reason` text,
                `transfer_date` datetime DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");
            
            $pdo->exec("
            CREATE TABLE `users` (
                `id` int NOT NULL,
                `name` varchar(32) NOT NULL,
                `login` varchar(16) NOT NULL,
                `pass` varchar(32) NOT NULL,
                `perm` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
                `token` varchar(512) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");
            
            // Добавляем индексы и ограничения
            $pdo->exec("ALTER TABLE `components` ADD PRIMARY KEY (`id`)");
            $pdo->exec("ALTER TABLE `computers` ADD PRIMARY KEY (`id`)");
            $pdo->exec("ALTER TABLE `computer_transfers` ADD PRIMARY KEY (`id`), ADD KEY `computer_id` (`computer_id`), ADD KEY `transferred_by` (`transferred_by`)");
            $pdo->exec("ALTER TABLE `users` ADD PRIMARY KEY (`id`)");
            
            // Модифицируем AUTO_INCREMENT
            $pdo->exec("ALTER TABLE `components` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24");
            $pdo->exec("ALTER TABLE `computers` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55");
            $pdo->exec("ALTER TABLE `computer_transfers` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7");
            $pdo->exec("ALTER TABLE `users` MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17");
            
            // Добавляем внешние ключи
            $pdo->exec("ALTER TABLE `computer_transfers` ADD CONSTRAINT `computer_transfers_ibfk_1` FOREIGN KEY (`computer_id`) REFERENCES `computers` (`id`)");
            $pdo->exec("ALTER TABLE `computer_transfers` ADD CONSTRAINT `computer_transfers_ibfk_2` FOREIGN KEY (`transferred_by`) REFERENCES `users` (`id`)");
            
            // Добавляем начальные данные
            $pdo->exec("INSERT INTO `users` (`id`, `name`, `login`, `pass`, `perm`, `token`) VALUES (4, 'admin', 'admin', 'admin', 'admin', '')");
            
            echo "Таблицы и начальные данные успешно созданы, доступ суперпользователя Логин - admin, Пароль - admin ПОМЕНЯЙТЕ ВО ИЗБЕЖАНИЕ НЕЖЕЛАТЕЛЬНОГО ДОСТУПА,чтобы убрать сообщение обновите страницу.<br>";
        } else {
            // Если база данных уже существует, просто подключаемся
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $pdo = new PDO($dsn, $user, $pass, $opt);
        }
        
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
?>