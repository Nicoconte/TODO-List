<?php  
session_start();

unset($_SESSION['CURRENT_SESSION_ID']);
session_destroy();
echo json_encode(array("success"=>1));

exit();
?>