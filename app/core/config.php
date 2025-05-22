<?php

# Конфиг подключения к базе данных
$dbconfig = 
[
    "host" => 'localhost',
    "db" => 'comp',
    "user" => 'root',
    "pass" => '',
    "charset" => 'utf8',
];

# Суперползователи
$db_root =
[
    'login' => 'admin', #Админа не убирать!
];


# Конфиг названий уровней доступа
$perm = 
[
    "admin" => "Администратор",
    "user" => "Пользователь",

];

$tables = 
[
    "user" => "users",
    "component" => "components",
    "computer" => "computers",  
];

$component_type =
[
    "gpu" => "Видеокарта",
    "cpu" => "Процессор",
    "motherboard" => "Материнская плата",
    "ram" => "ОЗУ",
    "storage" => "ПЗУ",
]
?>
