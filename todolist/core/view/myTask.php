<div class="mytask-header w3-deep-purple w3-round w3-border">
	<div class="mytask-header-content">
		<div class="mytask-bar w3-center">
			<p id='current-user' class='w3-display-topleft w3-margin-left'></p>
			<a href="#" id='id-explain' class='w3-display-topleft w3-margin-left w3-section'>¿Por que recibo esto?</a>
			<input type="text" id='task-search' name='task-search' placeholder='Buscar por titulo' class='w3-input w3-border w3-border-pink w3-margin-right w3-round' style='width:21%'>				

			<blockquote>
				<button id="write-task" class="w3-btn w3-pink w3-round" title='Nueva tarea'><i class='fa fa-pencil'></i></button>
				<button id="user-config" class="w3-btn w3-white w3-round" title='Configuraciones'><i class="fa fa-cog"></i></button>
				<button id="close-session-btn" class="w3-btn w3-red w3-round" title='Cerrar sesion'><i class="fa fa-times"></i></button>
			</blockquote>
		</div>
	</div>
</div>
 
<div class="mytask-body">
	<div class="mytask-body-content">
		<div class="todolist-form">
			<form id="task-form" class="w3-center w3-margin-top">
				<blockquote>
					<h1 class='w3-wide'>Anote sus tareas</h1>
					<input type="text" name="task-title" id="task-title" class="w3-input w3-border w3-border-black w3-round" required placeholder="Titulo"> <br>
					<textarea name="task-content" id="task-content" class="w3-input w3-border w3-border-black w3-round" required placeholder="Contenido" cols="30" rows="6"></textarea><br>
 					<button class="w3-btn w3-teal w3-round">Guardar tarea!</button>
					<button id='clear-btn' class="w3-btn w3-red w3-round">Cancelar</button>					
				</blockquote>
			</form>

			<form id="config-form" class="w3-center w3-margin-top" style="display:none; width:50%;">
				<blockquote>
					<h1 class='w3-wide'>Configurar usuario</h1>
					<input type="text" name="user-name-u" id="user-name-u" value="" class="w3-input w3-border w3-border-black w3-round"> <br>
					<input type="text" name='user-password-u' id='user-password-u' value="" class="w3-input w3-border w3-border-black w3-round"><br>
 					<button class="w3-btn w3-teal w3-round" id='u-btn'>Guardar cambios!</button>						
				</blockquote>
			</form>

		</div>
		<div class="todolist-result">
			<table class="w3-text-black w3-table w3-centered w3-bordered w3-border w3-border-black w3-striped"  id="t">
				<thead>
					<tr class="w3-pink">
						<td>Titulo</td>
						<td id="c">Contenido</td>
						<td id="e">Estado</td>
						<td>Acciones</td>
					</tr>					
				</thead>
				<tbody id="result"></tbody>
			</table>
		</div>	
	</div>
</div>


<!-- Modal para ver la tarea completa! -->
<div id="modal-task" class="w3-modal">
	<div class="w3-modal-content w3-white w3-text-white w3-border w3-round w3-animate-top" id="modal-task-content">
		<div class="w3-container">
			<span onclick="hideTaskModal()" class="w3-button w3-red w3-round w3-hover-red w3-display-topright"><i class='fa fa-times'></i></span>
			<form id='task-see-data'>
				<blockquote>
					<header class='w3-padding w3-teal w3-round'>
						<h1 id="see-title" class='w3-wide'></h1>
						<p id='see-date' class='w3-wide'></p>
					</header>
					<p id='see-content' class='w3-large w3-text-black'></p>
				</blockquote>
			</form>
		</div>
	</div>
</div>


<div id="explain-modal" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container w3-teal w3-round w3-border w3-border-orange w3-animate-left">
      <span id='explain-close' class="w3-btn w3-tiny w3-display-topright w3-red w3-round w3-hover-red"><i class='fa fa-times'></i></span>
      <p class='w3-padding'>Se recomienda guardar el ID que le se esta otorgando, en caso de perdida u olvido de la contraseña. <br>
		El mismo se le perdida al momento de recuperarla!.
      </p>
    </div>
  </div>
</div>


<!-- Validamos si hay una sesion activa en la pagina del home
	Con esto evitamos que cualquier persona pueda entrar desde la url
-->

<script>

	$.ajax({
		dataType : "JSON",
		url : "core/app/helper/ValidateCurrentSession.php",
		success : function(response) {
			var access = response;

			if(access.success == false) {
				window.location.href = "index.php?p=login";
			}
		}
	})

</script>