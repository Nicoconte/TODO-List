<?php  

include($_SERVER['DOCUMENT_ROOT'] . "/todolist/core/db/DbConnection.php");


class TaskCrud {


	public function insertTask($data) {

		$dbObj = new DbConnection();
		$conn = $dbObj->getConnection();

		if(!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "INSERT INTO task VALUES (?,?,?,?,?,?)";
			
			if($stmt = mysqli_prepare($conn, $sql)) {

				mysqli_stmt_bind_param($stmt, "ssssss", $data['id'], $data['authorId'], $data['title'], $data['content'], $data['state'], $data['date']);

				mysqli_stmt_execute($stmt);

				mysqli_close($conn);

				echo json_encode(array("success" => 1));

			} else {

				echo json_encode(array("success" => 2));

			}

		}
	}


	public function getTasks($userID) {

		$dbObj = new DbConnection();
		$conn  = $dbObj->getConnection();
		$jsonResponse = array();

		if(!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "SELECT * FROM task INNER JOIN userinfo ON task.taskAuthorId=userinfo.userId WHERE taskAuthorId='$userID'";

			if($rs = mysqli_query($conn, $sql)) {

				if(mysqli_num_rows($rs) > 0) {

					//Retornamos un array para que lo podamos recorrer y mostrar desde el front
					while($row = mysqli_fetch_assoc($rs)) {
						$jsonResponse[] = array(
											   "resultados" =>count($row),
											   "id"=>$row['taskID'],
											   "title"=>$row['taskTitle'],
											   "content"=>$row['taskContent'],
											   "state"=>$row['taskState'],
											   "date"=>$row['taskDate']);
					}

					echo json_encode($jsonResponse);


				} else {
					echo json_encode(array("resultados"=>0));
				}

			}

		}
	}


	public function deleteTask($id) {

		$dbObj = new DbConnection();
		$conn  = $dbObj->getConnection();

		if(!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());
		
		} else {

			$sql = "DELETE FROM task WHERE taskID='$id'";

			echo (mysqli_query($conn, $sql)) ? json_encode(array("success"=> 1)) : json_encode(array("success"=> 2));

		}	
	}


	public function updateTask($id, $state) {

		$dbObj = new DbConnection();
		$conn  = $dbObj->getConnection();	

		if(!$conn) {

			die("Connection failed at this point " . mysqli_connect_error());

		} else {

			$sql = "UPDATE task SET taskState='$state' WHERE taskID='$id'";

			echo (mysqli_query($conn, $sql)) ? json_encode(array("success"=> 1)) : json_encode(array("success"=> 2));

		}
	}

}



?>