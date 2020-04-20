<?php  
include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/user/UserOperation.php");

if (isset($_POST['user-name-u']) && isset($_POST['user-password-u'])) {

	$id = $_SESSION['CURRENT_USER_ID'];
	$name = $_POST['user-name-u'];
	$password = $_POST['user-password-u'];

	$user =  new UserOP();
	$user->updateUser($name, $password, $id);
 
} else {

	echo json_encode(array("success" => 3)); 

}


?>