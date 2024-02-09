<div id="divCard" class="card text-center">
	<div class="card-header">Consulta y actualización de datos</div>
	<div class="card-body">
		<form id="formAltaUsuario">
		  	<div class="form-row">
		    	<div class="form-group col-md-6">
		      		<label for="textApellido">Apellido</label>
		     		<input type="text" class="form-control" id="textApellido">
		    	</div>
		    	<div class="form-group col-md-6">
		      		<label for="textNombre">Nombre</label>
		      		<input type="text" class="form-control" id="textNombre">
		    	</div>
		  	</div>
		  	<div class="form-row">
			 	<div class="form-group col-md-6">
			    	<label for="textCorreo">Correo electrónico</label>
			    	<input type="email" class="form-control" id="textCorreo">
			  	</div>
			  	<div class="form-group col-md-6">
			    	<label for="textCuenta">Nombre de usuario</label>
			    	<input type="text" class="form-control" id="textCuenta">
			  	</div>
			</div>
			<div class="form-row">
			 	<div class="form-group col-md-12">
			    	<label for="textFechaAlta">Fecha de alta</label>
			    	<input type="text" class="form-control" id="textFechaAlta" disabled>
			  	</div>
			</div>
		</form>
	</div>
	<div class="card-footer text-muted">
		<button class="btn btn-success float-left" onclick="operador.modalModificacion()">Actualizar datos</button>
		<button class="btn btn-dark float-left ml-3" onclick="location.href = 'index.php?c=Operador&a=index'">Volver al listado</button>
		<button class="btn btn-dark float-right ml-3" onClick="$('#modalActualizarClave').modal('show')">Actualizar clave</button>
	</div>
</div>

<!-- Ventana modal para la confirmación de la actualización de una cuenta. -->
<div id="modalConfirmacionActualizar" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title text-success">Se actualizarán los datos</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">¿Está seguro de modificar los datos de la cuenta?</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        	<button type="button" class="btn btn-success" onClick="operador.modificacion()">Confirmar cambios</button>
	      	</div>
    	</div>
  	</div>
</div>

<!-- Ventana modal para la actualización de la contraseña. -->
<div id="modalActualizarClave" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title text-success">Actualización de datos de acceso</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<form>
				  	<div class="form-group">
				    	<label for="textClaveActual">Contraseña actual</label>
				    	<input type="password" class="form-control" id="textClaveActual">
				  	</div>
				  	<div class="form-group">
				    	<label for="textClaveNueva">Contraseña nueva</label>
				    	<input type="password" class="form-control" id="textClaveNueva">
				  	</div>
				  	<div class="form-group">
				    	<label for="textClaveNuevaConfirmacion">Confirmación</label>
				    	<input type="password" class="form-control" id="textClaveNuevaConfirmacion">
				  	</div>
				</form>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        	<button type="button" class="btn btn-success" onClick="operador.modificacionClave()">Actualizar clave</button>
	      	</div>
    	</div>
  	</div>
</div>