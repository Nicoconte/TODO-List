<?php 
session_start();

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/task/TaskCrud.php");

$task = new TaskCrud;

$task->getTasks($_SESSION['CURRENT_USER_ID']);


?>