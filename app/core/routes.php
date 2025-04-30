<?php
$routes = [
    //Views 
    "/"                      => "app/views/welcome.php",
    "/auth"                 => "app/views/auth.php",
    "/cabinet"              => "app/views/lk.php",
    "/cabinet/computer/add" => "app/views/computer_add.php",
    "/cabinet/computer/view" => "app/views/computer_view.php",
    "/cabinet/component/add" => "app/views/component_add.php",
    
    
    // API ENDPOINT
    "/api/add"      => "app/repo/Add.php",
    "/api/auth"             => "app/repo/Auth.php",
    "/api/delete"   => "app/repo/Delete.php",
    "/logout"               => "app/repo/Logout.php", 
];
