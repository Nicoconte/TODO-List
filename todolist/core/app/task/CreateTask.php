<?php  

session_Start();

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/task/TaskCrud.php");

$task = new TaskCrud();


$title = $_POST['title'];
$content = $_POST['content'];

if(isset($title) && isset($content)) {

	$data = array("id"=>uniqid(),
				  "authorId"=>$_SESSION['CURRENT_USER_ID'],
				  "title" => $_POST['title'],
				  "content"=>$_POST['content'],
				  "state"=>"En proceso",
				  "date" => date("Y/m/d"));


	$task->insertTask($data);	

} else {

	json_encode(array("success" => 3));

}



?>