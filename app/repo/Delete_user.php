<?php 
include("./app/core/config.php");
$id = $_GET["id"];

$sql = "DELETE FROM users WHERE id = '$id'";
$row = $pdo->query($sql);
header("Location: ".$_SERVER['HTTP_REFERER']);


