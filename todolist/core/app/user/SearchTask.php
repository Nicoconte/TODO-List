<?php  

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/user/UserOperation.php");

$user = new UserOP();
$user->searchTask($_POST['search'], $_SESSION['CURRENT_USER_ID']);


?>