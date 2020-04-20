<?php  
include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/user/UserOperation.php");

if (isset($_POST['recover-user']) && isset($_POST['recover-email'])) {

	$name = $_POST['recover-user'];
	$email = $_POST['recover-email'];

	$user = new UserOP();
	$user->recoverPassword($name,$email);

} else {

	echo json_encode(array("success"=>4));

}


?>