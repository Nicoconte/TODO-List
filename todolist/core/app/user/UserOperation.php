<?php  
session_start();

//Include database class

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/db/DbConnection.php");

//Include Php mailer class

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/phpmailer/src/Exception.php");
include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/phpmailer/src/PHPMailer.php");
include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/app/phpmailer/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class UserOP {
	
	public function createUser($userData) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();

		if (!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "INSERT INTO userinfo VALUES (?,?,?)";

			if ($stmt = mysqli_prepare($conn, $sql)) {


				mysqli_stmt_bind_param($stmt, "sss", $userData['id'], $userData['user_name'], $userData['user_password']);

				mysqli_stmt_execute($stmt);

				echo json_encode(array("success"=>1));

				mysqli_close($conn);

			} else {

				echo json_encode(array("success"=>2));

			}
		}

	}


	public function userLog($name, $password) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();


		if(!$conn ) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "SELECT * FROM userinfo WHERE (userName='$name' and userPassword='$password')";


			$rs = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($rs);
			$rowRs = mysqli_fetch_assoc($rs);

			if ($row > 0) {

				$_SESSION['CURRENT_USER_ID'] = $rowRs['userId']; 
				echo json_encode(array("success" => 1)); 

			} else {

				echo json_encode(array("success" => 2)); 

			}

		}


	}


	public function getUserData($id) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();

		if (!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "SELECT * FROM userinfo WHERE userId='$id'";

			$rs = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($rs);
			$rowRs = mysqli_fetch_assoc($rs);

			if ($row > 0) {

				echo json_encode(array("name" => $rowRs['userName'],
								  	   "password" => $rowRs['userPassword'],
								  		"id" => $rowRs['userId']));			
			}

		}

	}


	public function updateUser($name, $password, $id) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();

		if (!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "UPDATE userinfo SET userName='$name', userPassword='$password' WHERE userId='$id'";

			echo (mysqli_query($conn, $sql)) ? json_encode(array("success"=>1)) : json_encode(array("success"=>2));

		}

	}



	public function recoverPassword($name, $email) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();

		if (!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$names = array();

			$sql = "SELECT userName FROM userinfo";

			if ($rs = mysqli_query($conn, $sql)) {

				while($row = mysqli_fetch_assoc($rs)) {
					array_push($names, $row['userName']);
				}

				if (in_array($name, $names)) {


					$mail = new PHPMailer(true);

					try {
					    //Server settings
					    $mail->SMTPDebug = 0;                     
					    $mail->isSMTP();                                            
					    $mail->Host       = 'smtp.gmail.com';                    
					    $mail->SMTPAuth   = true;                                  
					    $mail->Username   = 'nicoconte1999@gmail.com';                    
					    $mail->Password   = 'Hellyeah123';                             
					    $mail->SMTPSecure = 'tls';        
					    $mail->Port       = 587;                              

					    //Recipients
					    $mail->setFrom('nicoconte1999@gmail.com', 'Nicolas Conte');
					    $mail->addAddress($email);     
					    // Content
					    $mail->isHTML(true);                                 
					    $mail->Subject = 'Recuperar cuenta';
					    $mail->Body    = "
					    Haga click <a href='localhost/todolist/index.php?p=recover'>aqui</a> para recuperar su cuenta </p>
					    ";

					    $mail->send();
					    echo json_encode(array("success"=>1));

					} catch (Exception $e) {

					    echo json_encode(array("success"=>2));

					}
		
					//? json_encode(array("success"=>1)) : json_encode(array("success"=>2)); 5e9914fec7b73

				} else {

					echo json_encode(array("success"=>3));

				}

			}


		}


	}


	public function searchTask($task, $id) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();

		if (!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "SELECT * FROM task INNER JOIN userinfo ON task.taskAuthorId=userinfo.userId WHERE taskAuthorId='$id' 
					AND taskTitle LIKE '%$task%'";

			$taskResponse = array();

			if ($rs = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($rs) > 0){

					while ($rowRs = mysqli_fetch_assoc($rs)) {
						$taskResponse[] = array(
											   "success" =>1,
											   "id"=>$rowRs['taskID'],
											   "title"=>$rowRs['taskTitle'],
											   "content"=>$rowRs['taskContent'],
											   "state"=>$rowRs['taskState'],
											   "date"=>$rowRs['taskDate']);
					}

					echo json_encode(($taskResponse));

				} else {
					echo json_encode(array("success"=>2));
				}

			} else {
				echo json_encode(array("success"=>2));
			}

		}

	}


	public function updatePassword($password,$id) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();

		if (!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "UPDATE userinfo SET userPassword='$password' WHERE userId='$id'";

			echo (mysqli_query($conn, $sql)) ? json_encode(array("success"=>1)) : json_encode(array("success"=>2));

		}

	}
 
}



?>
