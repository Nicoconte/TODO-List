<div class="login-container">
	
	<div class="log-title w3-text-white w3-bar w3-teal">
		<blockquote class="w3-center">
			<h1>Lista de tareas</h1>
			<h4>Codigo fuente del proyecto:</h4>
			<a href="https://github.com/Nicoconte/Todo-List" target="_blank">https://github.com/Nicoconte/Todo-List</a><br><br>
		</blockquote>
	</div>	

	<div class="login-text w3-half w3-center">	
		<blockquote>
			<h2>Registre sus tareas en esta sencilla app!</h1>
			<p>Si no tienes cuenta, que estas esperando?</p>
			<p>Registrate y guarda tus tareas</p><br>
			<button class="w3-btn w3-red w3-round" id='toggle-btn'>Registrarse ya!</button>
			<button id="toggle-btn-log" class="w3-btn w3-teal w3-round" style="display:none;">Ya tengo cuenta</button>	
			<button id='recover-password-btn' class='w3-btn w3-text-red w3-round w3-border w3-margin-left'>Recuperar cuenta</button>		
		</blockquote>
	</div>


	<div class="login-form w3-half">
		<form class="w3-center" id="user-log">
			<blockquote>
				<h2>Inicie sesion y vea sus tareas</h2>
				<input type="text" class="w3-input w3-border w3-round w3-border-black" name="user-name-l" placeholder="Usuario"><br>
				<input type="password" class="w3-input w3-border w3-round w3-border-black" name="user-password-l" placeholder="Contraseña"> 
				<br>
				<button class="w3-btn w3-teal w3-round">Iniciar sesion</button>
				<br><br>
			</blockquote>
		</form>


		<form class="w3-center" id="user-register" style="display:none;">
			<blockquote>
				<h2>Registrese y guarde sus tareas</h2>
				<input type="text" class="w3-input w3-border w3-round w3-border-black" name="user-name-r" placeholder="Usuario"><br>
				<input type="password" class="w3-input w3-border w3-round w3-border-black" name="user-password-r" placeholder="Contraseña"> 
				<br>
				<button class="w3-btn w3-red w3-round">Registrarse</button>
			</blockquote>
		</form>
	
	
	</div>

</div>


<div id="recover-modal" class="w3-modal">
	<div class="w3-modal-content w3-white w3-text-white w3-border w3-round w3-animate-top" id="modal-task-content">
		<div class="w3-container">
			<span id='close-recover-modal' class="w3-button w3-red w3-round w3-hover-red w3-display-topright"><i class='fa fa-times'></i></span>
			<form id='recover-form'>
				<blockquote>
					<header class='w3-padding w3-teal w3-round'>
						<h1 class='w3-wide'>Recupere su contraseña ya mismo!</h1><br>
						<p>Le llegara un email con las indicaciones</p>
					</header>
					<input type="text" class='w3-input w3-border w3-border-black w3-round w3-margin-top' placeholder='Coloque su usuario' name='recover-user' required><br>
					<input type="email" class='w3-input w3-border w3-border-black w3-round' placeholder='Coloque su email' name='recover-email' required>
					<br><br>
					<button class='w3-btn w3-text-red w3-border w3-border-red w3-round'>Recuperar</button>
				</blockquote>
			</form>
		</div>
	</div>
</div>
