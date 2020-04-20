<?php  

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/user/UserOperation.php");

if (isset($_POST['user-name-r']) && isset($_POST['user-password-r'])) {

	$data = array("id"=>uniqid(),
				  "user_name"=>$_POST['user-name-r'],
				  "user_password"=>$_POST['user-password-r']);


	$user = new UserOP();
	$user->createUser($data);

} else {

	echo json_encode(array("success"=>3));

}

?>