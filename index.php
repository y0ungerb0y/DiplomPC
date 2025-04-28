<?php

$routes = [
    "/"                      => "app/views/welcome.php",
    "/auth"                 => "app/views/auth.php",
    "/cabinet"              => "app/views/lk.php",
    "/cabinet/computer/add" => "app/views/computer_add.php",
    "/cabinet/computer/view" => "app/views/computer_view.php",
    "/api/addcomputer"      => "app/repo/Add_computer.php",
    "/api/auth"             => "app/repo/Auth.php",
    "/api/deletecomputer"   => "app/repo/Delete_computer.php",
    "/api/deleteuser"   => "app/repo/Delete_user.php",
    "/logout"               => "app/repo/Logout.php", 
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


if (array_key_exists($uri, $routes)) {
    include_once($routes[$uri]);
} else {
    http_response_code(404); 
}

?>
