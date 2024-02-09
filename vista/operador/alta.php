<div id="divCard" class="card text-center">
	<div class="card-header">Nueva cuenta de usuario</div>
	<div class="card-body">
		<form id="formAltaUsuario">
		  	<div class="row">
			  	<div class="form-group col-md-6">
		      		<label for="textNombre">Nombre</label>
		      		<input type="text" class="form-control" id="textNombre">
		    	</div>
		    	<div class="form-group col-md-6">
		      		<label for="textApellido">Apellido</label>
		     		<input type="text" class="form-control" id="textApellido">
		    	</div>
		  	</div>
		  	<div class="row">
			  	<div class="form-group col-md-6">
			    	<label for="textCuenta">Nombre de usuario</label>
			    	<input type="text" class="form-control" id="textCuenta">
			  	</div>
			 	<div class="form-group col-md-6">
			    	<label for="textCorreo">Correo electrónico</label>
			    	<input type="email" class="form-control" id="textCorreo">
			  	</div>
			</div>
			<div class="row">
			 	<div class="form-group col-md-6">
			    	<label for="textTipoUsuario">Tipo de usuario</label>
					<select class="form-control" id="textTipoUsuario">
						<option value=1>1 (Operador)</option>
						<option value=2>2 (Administrador)</option>
					</select>
			  	</div>
			  	<div class="form-group col-md-6">
			    	<label for="textEstado">Estado</label>
					<select class="form-control" id="textEstado">
						<option value=0>0 (Activo)</option>
						<option value=1>1 (Inactivo)</option>
					</select>
			  	</div>
			</div>
		  	<div class="row">
		    	<div class="form-group col-md-6">
			      	<label for="textClave">Contraseña</label>
			      	<input type="password" class="form-control" id="textClave">
		    	</div>
		    	<div class="form-group col-md-6">
			      	<label for="textClave2">Confirmación de contraseña</label>
			      	<input type="password" class="form-control" id="textClave2">
		    	</div>
		  	</div>
		</form>
	</div>
	<div class="card-footer text-muted">
		<button class="btn btn-success float-left" onclick="operador.alta()">Crear cuenta</button>
		<button class="btn btn-dark float-left ml-3" onclick="location.href = 'index.php?c=Operador&a=index'">Volver al listado</button>
	</div>
</div>