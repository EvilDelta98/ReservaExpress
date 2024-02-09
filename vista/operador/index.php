<div class="container-fluid bg-light p-3 mt-2 mb-4 overflow-auto">
	<a href="javascript:operador.mostrarPaginador()" class="btn btn-primary float-right text-light">Listar cuentas</a>
	<a href="index.php?c=Operador&a=formAlta" class="btn btn-primary float-right text-light mr-3" onClick="">Nuevo usuario</a>
</div>

<div class="card">
	<div class="card-header">Listado de usuarios</div>
  	<div class="card-body">

      <!-- Select cantidad de registros por página -->
      <div class="input-group my-2">
        <div class="input-group-prepend">
          <label class="input-group-text" for="selectRegistrosPorPagina"><i class="fas fa-list-ul mr-2"></i>Registros por página</label>
        </div>
        <select class="custom-select col-1" id="selectRegistrosPorPagina" onchange="actualizarPaginador(this)">
          <option value="5">5</option>
          <option value="10" selected>10</option>
          <option value="20">20</option>
        </select>
      </div>

      <!-- Tabla de registros -->
    	<table class="table mt-4">
    		<thead class="text-center">
    			<tr>
    				<th>#</th><th>Usuario<i class="far fa-user ml-1"/></th><th>Cuenta<i class="far fa-id-card ml-1"/></th><th>Correo<i class="far fa-envelope ml-1"/></th><th>Alta<i class="far fa-clock ml-1"/></th><th>Opciones<i class="far fa-wrench ml-1"/></th>
    			</tr>	
    		</thead>
    		<tbody id="tBodyRegistros" class="text-center">
    			<tr>
    				<td colspan="6" class="text-center text-muted">No hay resultados para mostrar</td>
    			</tr>
    		</tbody>
    		<tfoot>
    			<tr><th colspan="6" id="thRegistrosAfectados" class="text-center text-muted"></th></tr>
    		</tfoot>
    	</table>
  	</div>
  	<div class="card-footer">
  		<nav aria-label="..." class="d-flex justify-content-center">
  			<ul class="pagination p-0 my-2">
  				<li class="page-item">
  					<a id="enlacePrimerPagina" class="page-link font-weight-bold" href="" title="Primera página"><<</a>
  				</li>
  				<li class="page-item">
  					<a id="enlacePaginaAnterior" class="page-link font-weight-bold" href="" title="Página anterior"><</a>
  				</li>
  				<li class="page-item active">
  					<span class="page-link" id="paginaXdeY" title="Página X de Y">0 de 0<span class="sr-only">(current)</span></span>
  				</li>
  				<li class="page-item">
  					<a id="enlacePaginaSiguiente" class="page-link font-weight-bold" href="" title="Página siguiente">></a>
  				</li>
  				<li class="page-item">
  					<a id="enlaceUltimaPagina" class="page-link font-weight-bold" href="" title="Última página">>></a>
  				</li>
  			</ul>
  		</nav>
  	</div>
</div>

<!-- Ventana modal para la confirmación de baja de una cuenta. -->
<div id="modalConfirmacion" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title text-danger">Eliminación de cuenta</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	<p id="pMensaje"></p>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        	<button type="button" class="btn btn-danger" onClick="operador.baja()">Confirmar baja</button>
	      	</div>
    	</div>
  	</div>
</div>

<!-- Ventana modal para mostrar el mensaje de confirmación de la baja. -->
<div id="modalConfirmacionBaja" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title text-success">Operación exitosa</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	<p>La cuenta fue eliminada de la base de datos.</p>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Volver al listado</button>
	      	</div>
    	</div>
  	</div>
</div>