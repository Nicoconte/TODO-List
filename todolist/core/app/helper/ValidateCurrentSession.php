<?php  

session_start();

if (empty($_SESSION['CURRENT_USER_ID'])) {
	echo json_encode(array("success"=>FALSE));
	exit();
}

?>