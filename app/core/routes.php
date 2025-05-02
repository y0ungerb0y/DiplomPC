<?php
$routes = [
    //Views 
    "/"                      => "app/views/welcome.php",
    "/auth"                 => "app/views/auth.php",
    "/cabinet"              => "app/views/lk.php",
    
    //Computers
    "/cabinet/computer/add" => "app/views/computer_add.php",
    "/cabinet/computer/view" => "app/views/computer_view.php",
   
    //Components
    "/cabinet/component/add" => "app/views/component_add.php",
   
    //Users
    "/cabinet/user/add" => "app/views/user_add.php",
    "/cabinet/user/view" => "app/views/user_view.php",
    
    
    // API ENDPOINT
    "/api/add"      => "app/repo/Add.php",
    "/api/auth"             => "app/repo/Auth.php",
    "/api/delete"   => "app/repo/Delete.php",
    "/logout"               => "app/repo/Logout.php", 
];
