<?php  

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/task/TaskCrud.php");

$task = new TaskCrud();

if (isset($_POST['id']) && isset($_POST['state'])) {
	
	$id = $_POST['id'];
	$state = $_POST['state'];

	$task->updateTask($id, $state);
 
} else {

	echo json_encode(array("success" => 3));

}

?>