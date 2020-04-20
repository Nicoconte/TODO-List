<?php  

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/user/UserOperation.php");

$user = new UserOP();
$user->updatePassword($_POST['a-p'], $_POST['a-id']);



?>