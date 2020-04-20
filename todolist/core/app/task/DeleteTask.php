<?php  

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/task/TaskCrud.php");

$task = new TaskCrud();

if (isset($_POST['id'])) {
	
	$id = $_POST['id'];
	$task->deleteTask($id);
 
} else {

	echo json_encode(array("success" => 3));

}

?>