<?php
$routes = [
    //Views 
    "/"                      => "app/views/welcome.php",
    "/auth"                 => "app/views/auth.php",
    "/cabinet"              => "app/views/lk.php",
    
    //Computers
    "/cabinet/computer/add" => "app/views/computer_add.php",
    "/cabinet/computer/view" => "app/views/computer_view.php",
    "/cabinet/computer/transfer" => "app/views/computer_transfer_form.php",
    "/cabinet/computer/history" => "app/views/computer_transfer_history.php",
    
    //Components
    "/cabinet/component/add" => "app/views/component_add.php",
   
    //Users
    "/cabinet/user/add" => "app/views/user_add.php",
    "/cabinet/user/view" => "app/views/user_view.php",
    "/cabinet/user/edit" => "app/views/user_edit.php",
    
    
    // API ENDPOINT
    "/api/add"      => "app/repo/Add.php",
    "/api/auth"             => "app/repo/Auth.php",
    "/api/delete"   => "app/repo/Delete.php",
    "/api/edit" => "app/repo/Edit.php",
    "/logout"               => "app/repo/Logout.php", 
];
