<?php  
include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/user/UserOperation.php");

$user = new UserOP();
$user->getUserData($_SESSION['CURRENT_USER_ID']);


?>