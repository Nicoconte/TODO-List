<div class="account-recover-container">
	
	<div class="account-recover-form w3-center">
		<form id="account-recover-form">
			<blockquote>
				<h1 class='w3-teal'>Coloque el ID provisto por la app</h1> <br>
				<input type="text" class='w3-input w3-border w3-round' name='a-id' placeholder='Coloque su ID'> <br>
				<input type="password" class='w3-input w3-border w3-round' name='a-p' placeholder='Nueva contraseña' required> <br>
				<button class='w3-btn w3-teal w3-round' id='a-btn'>Establecer nueva contraseña</button>
			</blockquote>
		</form>
	</div>

</div>


<script>

	$("#account-recover-form").submit(function(e){
		e.preventDefault();
			$.ajax({
				type:"POST",
				datatype:"JSON",
				url:"core/app/user/RecoverUpdate.php",
				data :$(this).serialize(),
				success : function(response) {
					var message = response;
					if(message.success == "1") {
						Swal.fire({icon:"warning",title:"El ID es incorrecto",timer:1500}).then(function(){
							$("#account-recover-form")[0].reset();
						});
					} else {
						Swal.fire({icon:"success",title:"Contraseña actualizada",timer:1500}).then(function(){
							window.location.href = "index.php?p=login";
						});
					}
				}
			})
	})


</script>