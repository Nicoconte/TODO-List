<?php  

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/user/UserOperation.php");

if (isset($_POST['user-name-l']) && isset($_POST['user-password-l'])) {

	$user = new UserOP();
	$user->userLog($_POST['user-name-l'], $_POST['user-password-l']);

} else {

	echo json_encode(array("success" => 3));

}


?>