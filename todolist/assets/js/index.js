function createTask() {

	$("#task-form").submit(function(e) {
		e.preventDefault();
		$.ajax({
			type : "POST",
			dataType : "JSON",
			url : "core/app/task/CreateTask.php",
			data : {
				title :  $("#task-title").val(),
				content : $("#task-content").val() 
			},
			success: function(response) {
				var message = response;
		
				switch(message.success) {
					case 1:
						Swal.fire({icon:"success",title:"Tarea guardada!",timer:1500}).then(function() {
							$("#task-form")[0].reset();
							showTask(); //refrescamos la parte de resultados
						});
						break;
					case 2:
						Swal.fire({icon:"error",title:"No se pudo guardar la tarea",timer:1500});
						break;
					case 3:
						Swal.fire({icon:"warning",title:"No se enviaron los datos",timer:1500});
						break;

					default:
						alert("Error");
						break;
				}

			}

		});
	});

}

// Las comillas `` te permiten declarar un string en multiples lineas. 

function showTask() {

	$.ajax({
		url : "core/app/task/ShowTask.php",
		type : "POST",
		dataType : "JSON",
		success : function (response) {
			let taskData = response;
			let template = "";
			let msj = "<p class='w3-deep-purple w3-round w3-text-white'> La tarea es muy larga para previsualizarla! </p>";

			/*Recorremos el array que nos devolvio, dentro de ellas verificamos la longitud del contenido,
			* Si es muy grande, la reducimos para que entre en la tabla y no la deforma
			* En el tr colocamos los datos que nos retorna el servidor para luego tomarlo y mostrarlo por pantalla, tambien se va a utilizar para actualizar!
			* Usamos split y join, el replace + /\s/g o / / g, no funcionan 
			*/

			taskData.forEach(
				data => {
				template += `
				<tr taskId=${data.id} taskTitle=${data.title.split(" ").join("~")} taskContent=${data.content.split(" ").join("~")} 
					taskState=${data.state} taskDate=${data.date}>

					<td> ${data.title.substr(0,20)}... </td>
					<td> ${(data.content.length > 50) ? msj : data.content} </td>
					<td> ${data.state} </td>
					<td> 
						<button onclick="showAllTaskData()" class='show-task-data w3-btn w3-teal w3-round' title='Ver contenido'><i class='fa fa-search'></i></button>
						<button class='update-task w3-btn w3-purple w3-round' title='Finalizar tarea'><i class='fa fa-check-square-o'></i></button>
						<button class='delete-task w3-btn w3-red w3-round' title='Eliminar tarea'><i class="fa fa-trash-o"></i></button>
					</td>

				</tr>
				`
			});

			$("#result").html(template);
		}
	});

}


function deleteTask() {

	//Obtenemos el id desde su contenedor padre que es el <tr> y a traves de un atributo que nosotros le asignamos
	$(document).on('click','.delete-task', function(){
		let htmlElement = $(this)[0].parentElement.parentElement;
		let id = $(htmlElement).attr('taskId');

		$.ajax({
			type : "POST",
			dataType : "JSON",
			url : "core/app/task/DeleteTask.php",
			data : {id : id},
			success : function(response) {
				var message = response;

				if (message.success == "1") {
					Swal.fire({icon:"success",title:"Tarea eliminada!",timer:1500,}).then(function() {
						//window.location.href="index.php?p=home"; Que se rompio aca?
						showTask();
					});
				} else {
					Swal.fire({icon:"error",title:"No se pudo eliminar",timer:1500,})
				}

			}
		})

	});
}


function showAllTaskData() {
	
	$(document).on('click','.show-task-data', function() {

		let element = $(this)[0].parentElement.parentElement;
		let data = {
			title : $(element).attr("taskTitle"),
			content : $(element).attr('taskContent'),
			date : $(element).attr('taskDate')
		};

		$("#modal-task").css('display','block');

		$("#see-title").text(data.title.split("~").join(" ")); 
		$("#see-date").text("Fecha de inicio: " + data.date); 
		//"Cortamos donde hay un guion y le devolvemos el espacio en blanco. El atributo discrimina entre espacios abiertos y cerrados"
		$("#see-content").text(data.content.split("~").join(" "));

	})
}


function updateTask() {
	$(document).on('click', '.update-task', function() {

		let element = $(this)[0].parentElement.parentElement;
		let data = {
			id : $(element).attr("taskId"),
			currentState : $(element).attr("taskState"),
			state : "Finalizado"
		};

		if (data.currentState == "Finalizado") {

			Swal.fire({icon:"warning",title:"La tarea ya habia concluido",timer:1500});

		} else {

			$.ajax({
				type:"POST",
				dataType:"JSON",
				url:"core/app/task/UpdateTask.php",
				data:{
					id : data.id,
					state : data.state,
				},
				success : function(response) {
					var message = response;

					if(message.success == "1"){
						Swal.fire({icon:"success",title:"Bien hecho!",text:"Has concluido con tu tarea",timer:1500,}).then(function(){
							showTask();
						})
					} else {
						Swal.fire({icon:"warning",title:"Algo salio mal",timer:1500});
					}
				}
			});
		}
	})
}


function createUser() {

	$("#user-register").submit(function(e) {
		e.preventDefault();
		$.ajax({
			type:"POST",
			dataType : "JSON",
			url : "core/app/user/CreateUser.php",
			data : $(this).serialize(),
			success : function(response) {
				var message = response;

				if(message.success == "1") {
					Swal.fire({icon:"success",title:"Usuario creado!",text:"Inicie sesion y comience con las tareas :D",timer:1500}).then(function(){
						$("#user-register")[0].reset();
					});
				} else {
					Swal.fire({icon:"error",title:"Algo salio mal, revise los datos",timer:1500});
				}
			}

		})
	})

}


function login() {

	$("#user-log").submit(function(e) {
		e.preventDefault();
		
		$.ajax({
			type : "POST",
			dataType : "JSON",
			url : "core/app/user/UserLogin.php",
			data : $(this).serialize(),
			success : function (response) {
				var message = response;

				if (message.success == "1") {
					Swal.fire({icon:"success",title:"Bienvenido!",timer:1600}).then(function(){
						window.location.href = "index.php?p=myTask";
					});
				} else {
					Swal.fire({icon:"warning",title:"Verifique los datos",timer:1500});
				}
			}
		})
	})

}


function closeSession() {
	$("#close-session-btn").click(function() {
		$.ajax({
			dataType:"JSON",
			url : "core/app/helper/DestroySession.php",
			success : function(response) {
				var message = response;

				if (message.success == "1") {
					Swal.fire({icon:"warning",title:"Cerrando sesion...",timer:1500}).then(function(){
						window.location.href = "index.php?p=login";
					});
				}

			}
		})
	})
}


function getUserDataToUpdate() {
	$.ajax({
		dataType:"JSON",
		url:"core/app/user/GetUserData.php",
		success: function(response) {
			var message = response;

			$("#user-name-u").attr("value",message.name);
			$("#user-password-u").attr("value",message.password);
			$("#current-user").text("ID usuario: " + message.id)
		}
	})
}


function updateUser() {

	$("#config-form").submit(function(e) {

		e.preventDefault();

		$.ajax({
			type:"POST",
			dataType:"JSON",
			url: "core/app/user/UpdateUser.php",
			data:$(this).serialize(),
			success : function(response) {

				var message = response;

				if(message.success == "1") {
					Swal.fire({icon:"success",title:"Datos actualizados!",timer:1500,}).then(function(){
						getUserDataToUpdate();
					});
				} else {
					Swal.fire({icon:"warning",title:"No se pudo  actualizar los datos",timer:1500,});
				}

			}

		});
	})

}


function recoverUserPassword() {

	$("#recover-form").submit(function(e) {
		e.preventDefault();

		$.ajax({
			type:"POST",
			dataType:"JSON",
			url:"core/app/user/Recover.php",
			data : $(this).serialize(),
			success:function(response){
				var options = response;

				switch(options.success){

					case 1:
						Swal.fire({icon:"success",title:"Email enviado",timer:1400}).then(function(){
							$("#recover-form")[0].reset();
						});
						break;
					case 2:
						Swal.fire({icon:"warning",title:"No se pudo enviar el email",timer:1500});
						break;
					case 3:
						Swal.fire({icon:"Error",title:"El usuario no existe",timer:1500});
						break;
					case 4:
						Swal.fire({icon:"warning",title:"No se enviaron los datos",timer:1500});
						break;
					default:
						Swal.fire({icon:"question",title:"Algo salio mal con la app",timer:1500});
						break;
				}

			}
		});

	});

}



function searchContent() {
	$("#task-search").keyup(function(e) {
		e.preventDefault();
		var keys = $("#task-search").val();

		$.ajax({
			type:"POST",
			dataType:"JSON",
			url:"core/app/user/SearchTask.php",
			data : {search : keys},
			cache:false,
			success : function(response) {
				let template = '';
				let data = response;
				let msj = "<p class='w3-deep-purple w3-round w3-text-white'> La tarea es muy larga para previsualizarla! </p>";

				data.forEach(data=>{
				template += `
					<tr taskId=${data.id} taskTitle=${data.title.split(" ").join("~")} taskContent=${data.content.split(" ").join("~")} 
						taskState=${data.state} taskDate=${data.date}>

						<td> ${data.title.substr(0,20)}... </td>
						<td> ${(data.content.length > 50) ? msj : data.content} </td>
						<td> ${data.state} </td>
						<td> 
							<button onclick="showAllTaskData()" class='show-task-data w3-btn w3-teal w3-round' title='Ver contenido'><i class='fa fa-search'></i></button>
							<button class='update-task w3-btn w3-purple w3-round' title='Finalizar tarea'><i class='fa fa-check-square-o'></i></button>
							<button class='delete-task w3-btn w3-red w3-round' title='Eliminar tarea'><i class="fa fa-trash-o"></i></button>
						</td>

					</tr>
					`
				});

				if (keys == "") {
					showTask();
				} else {
					$("#result").html(template);
				}
			}
		});	
	});
}



function toggleForm() {

	$("#toggle-btn").click(function() {

		$("#user-log, #toggle-btn").hide();
		$("#user-register, #toggle-btn-log").slideToggle("fast");

	})

	$("#toggle-btn-log").click(function() {
		$("#user-register, #toggle-btn-log").hide();
		$("#user-log, #toggle-btn").slideToggle("fast")
	})

}


function toggleConfigForm() {
	$("#user-config").click(function() {
		$("#task-form").hide();
		$("#config-form").slideToggle("fast");
	});

	$("#write-task").click(function() {
		$("#config-form").hide();
		$("#task-form").slideToggle("fast");
	});
}

function clearTextField() {
	$("#clear-btn").click(function() {
		$("#task-form")[0].reset();
	});
}

function hideTaskModal() {
	$("#modal-task").css('display','none');
}

function toggleRecoverForm() {

	$("#recover-password-btn").click(function() {
		$("#recover-modal").css("display","block");
	}); 


	$("#close-recover-modal").click(function() {
		$("#recover-modal").css("display","none")
	});

}


function toggleExplainModal() {

	$("#id-explain").click(function() {
		$("#explain-modal").css("display","block");
	}); 


	$("#explain-close").click(function() {
		$("#explain-modal").css("display","none")
	});

}


function readyFunctions() {
	createTask();
	showTask();
	clearTextField();
	deleteTask();
	updateTask();
	toggleForm();
	createUser();
	login();
	closeSession();
	toggleConfigForm();
	getUserDataToUpdate();
	updateUser();
	toggleRecoverForm();
	recoverUserPassword();
	toggleExplainModal();
	searchContent();
}


$(document).ready(readyFunctions);