let operador = {
	"parametros":{"url":"index.php"},
	"data": {"id":0, "nombre":"", "apellido":"", "correo":"", "cuenta":"", "clave":"", "tipoUsuario":0, "estado":0,  "fechaAlta":""},
	"paginador":{"indice":0,"cantidad":10, "totalRegistros":0}, //Parámetros para el listado de usuarios.
	//Se leen los datos del formulario y se guardan en "data".
	"actualizarData": function(){
		this.data.nombre = $("#textNombre").val();
        this.data.apellido = $("#textApellido").val();
        this.data.correo = $("#textCorreo").val();
		this.data.cuenta = $("#textCuenta").val();
        this.data.tipoUsuario = $("#textTipoUsuario").val();
        this.data.estado = $("#textEstado").val();
		this.data.clave = "";
	},

	//Los datos que se reciben del servidor se replican en el formulario.
	"replicarData": function(){
        $("#textNombre").val(this.data.nombre);
		$("#textApellido").val(this.data.apellido);
		$("#textCorreo").val(this.data.correo);
        $("#textCuenta").val(this.data.cuenta);
        $("#textTipoUsuario").val(this.data.tipoUsuario);
        $("#textEstado").val(this.data.estado);
		$("#textFechaAlta").val(this.data.fechaAlta);
	},

	"resetearData": function(){
		this.data = {"id":0, "nombre":"", "apellido":"", "correo":"", "cuenta":"", "clave":"", "tipoUsuario":0, "estado":0,  "fechaAlta":""};
	},

	"alta": function(){
		//Paso 1: Copiar el formulario en data.
		this.actualizarData();
		this.data.clave = hex_md5($("#textClave").val());
		//Paso 2: Enviar los datos al controlador operador (alta).
		
		this.abm("Operador","alta",this.data);
	},

	"baja": function(){
		//Paso 1: Enviar los datos al controlador usuario (baja).
		this.abm("Operador","baja",{"id":this.data.id});
	},

	"modalBaja": function(cuenta, id){
		this.data.id = parseInt(id);
		$("#pMensaje").html('¿Está seguro de eliminar la cuenta <strong>'+cuenta+'</strong>?');
		$("#modalConfirmacion").modal("show");
	},

	"modificacion": function(){
		//Paso 1: Copiar el formulario en data.
		this.actualizarData();
		//Paso 2: Enviar los datos al controlador usuario (modificacion).
		this.abm("Operador","modificacion",this.data);
	},

	"modalModificacion": function(){
		$("#modalConfirmacionActualizar").modal("show");
	},

	"modificacionClave": function(){
		//Paso 1: Validar los datos.
		$("#textClaveActual, #textClaveNueva, #textClaveNuevaConfirmacion").removeClass("is-invalid").removeClass("is-valid");
		$("#divFeedback1, #divFeedback2, #divFeedback3").remove();
		//Validar que los campos no estén vacíos
		if($("#textClaveActual").val().length == 0) $("#textClaveActual").addClass("is-invalid").after('<div id="divFeedback1" class="invalid-feedback">Este campo es obligatorio.</div>');
		else $("#textClaveActual").addClass("is-valid");
		if($("#textClaveNueva").val().length == 0) $("#textClaveNueva").addClass("is-invalid").after('<div id="divFeedback2" class="invalid-feedback">Este campo es obligatorio.</div>');
		else $("#textClaveNueva").addClass("is-valid");
		if($("#textClaveNuevaConfirmacion").val().length == 0) $("#textClaveNuevaConfirmacion").addClass("is-invalid").after('<div id="divFeedback3" class="invalid-feedback">Este campo es obligatorio.</div>');
		else $("#textClaveNuevaConfirmacion").addClass("is-valid");
		//Validar que la contraseña nueva coincida con la confirmación.
		if($("#textClaveNueva").val() != $("#textClaveNuevaConfirmacion").val()){
			$("#textClaveNuevaConfirmacion").addClass("is-valid");
			$("#textClaveNuevaConfirmacion").addClass("is-invalid").after('<div id="divFeedback3" class="invalid-feedback">No coincide con la clave nueva.</div>');
		}
		//Paso 2: Enviar al servidor.
		if($("#textClaveActual").hasClass("is-invalid") || $("#textClaveNueva").hasClass("is-invalid") || $("#textClaveNuevaConfirmacion").hasClass("is-invalid")) return false;
		this.abm("Operador","modificacionClave",{"id":this.data.id,"claveActual":hex_md5($("#textClaveActual").val()),"claveNueva":hex_md5($("#textClaveNueva").val())});
	},

	"cargar": function(id){
		//Paso 1: Enviar los datos al controlador operador (consulta).
		//El identificador (id) se captura y crea en el controlador "formConsulta".
		this.abm("Operador","consulta",{"id":id});
	},

	"listar": function(){
		this.abm("Operador","listar",this.paginador);
	},

	"abm": function(controlador, accion, datos){
		// alert(JSON.stringify(datos));
		$.ajax({"url":this.parametros.url, "method":"post", "dataType":"json", "accept":"json", "data":{"c":controlador,"a":accion,"data":JSON.stringify(datos)}})
			.done(function(data, statusText){
				$('#divAlert').remove();
				$('#modalConfirmacion').modal("hide");
				$('#modalConfirmacionActualizar').modal("hide");
				$('#modalActualizarClave').modal("hide");
				$("#textClaveActual, #textClaveNueva, #textClaveNuevaConfirmacion").removeClass("is-invalid").removeClass("is-valid");
				$("#divFeedback1, #divFeedback2, #divFeedback3").remove();
				if(data.error !== ""){
                    //Método viejo
					// $('<div id="divAlert" class="alert alert-danger"><p class="my-3">'+data.error+'</p></div>').insertBefore("#divContenedor");
					$("#divContenedor").prepend('<div id="divAlert" class="alert alert-danger"><p class="my-3">'+data.error+'</p></div>');
				}
				else{
					switch(data.accion){
						case "consulta":
							operador.data = data.data;
							operador.replicarData();
							break;
						case "alta":
							// $('<div id="divAlert" class="alert alert-success"><p class="my-3">Se registró una nueva cuenta "'+data.data.cuenta+'".</p></div>').insertBefore("#divContenedor");
							$("#divContenedor").prepend('<div id="divAlert" class="alert alert-success"><p class="my-3">Se registró una nueva cuenta "'+data.data.cuenta+'".</p></div>');
							document.forms["formAltaUsuario"].reset();
							break;
						case "modificacion":
							operador.data = data.data;
							operador.replicarData();
							$("#divContenedor").prepend('<div id="divAlert" class="alert alert-success"><p class="my-3">Se actualizaron los datos de la cuenta "'+data.data.cuenta+'".</p></div>');
							break;
						case "modificacionClave":
							operador.data = data.data;
							operador.replicarData();
							$("#divContenedor").prepend('<div id="divAlert" class="alert alert-success"><p class="my-3">Se actualizó la clave de la cuenta "'+data.data.cuenta+'".</p></div>');
							break;
						case "baja":
							//Mensaje de éxito
							$("#divContenedor").prepend('<div id="divAlert" class="alert alert-success"><p class="my-3">Se eliminó el registro de la base de datos.</p></div>');
							//Resetear "data" de usuario
							operador.resetearData();
							//Actualizar el listado
							operador.listar();
							$("#modalConfirmacionBaja").modal("show");
							break;	
						case "listar":
							if(data.data.length === 0){
								$("#tBodyRegistros").html('<tr><td colspan="6" class="text-center text-muted">No hay resultados para mostrar</td></tr>');
								$("#thRegistrosAfectados").text("");
							}
							else{
								$("#tBodyRegistros").empty();
								let fila = '';
								for(let i = 0; i < data.data.length; i++){
                                    //ACTUALIZAR FILAAASSSSSSS OPERADORRRRRRRRRRRRRR
									fila = '<tr>';
									fila += '<td>'+(operador.paginador.indice+i+1)+'</td>';
									fila += '<td>'+data.data[i].operador+'</td>';
									fila += '<td>'+data.data[i].cuenta+'</td>';
									fila += '<td>'+data.data[i].correo+'</td>';
									fila += '<td>'+data.data[i].fecha_alta+'</td>';
									fila += '<td><a href="index.php?c=Operador&a=formConsulta&id='+data.data[i].id+'">Modificar</a> | <a href="javascript:operador.modalBaja(\''+data.data[i].cuenta+'\','+data.data[i].id+')">Eliminar</a></td>';
									fila += '</tr>';
									$("#tBodyRegistros").append(fila);
								}
								$("#thRegistrosAfectados").text("Registros encontrados: "+data.registrosAfectados);
							}
							//Paginador de registros.
							operador.paginador.totalRegistros = data.registrosAfectados;
							let paginaActual = parseInt(operador.paginador.indice / operador.paginador.cantidad) + 1;
							let totalPaginas = parseInt((data.registrosAfectados - 1) / operador.paginador.cantidad) + 1;
							$("#paginaXdeY").text("Página "+paginaActual+" de "+totalPaginas);
							$("#enlacePrimerPagina").attr("href","javascript:operador.mostrarPaginador(1,"+totalPaginas+")");
							$("#enlacePaginaAnterior").attr("href","javascript:operador.mostrarPaginador("+(paginaActual-1)+","+totalPaginas+")");
							$("#enlacePaginaSiguiente").attr("href","javascript:operador.mostrarPaginador("+(paginaActual+1)+","+totalPaginas+")");
							$("#enlaceUltimaPagina").attr("href","javascript:operador.mostrarPaginador("+totalPaginas+","+totalPaginas+")");
							break;
						default: break;
					}
				}
			})
			.fail(function(){

			})
			.always(function(){

			});
	},
	"mostrarPaginador": function(paginaActual, totalPaginas){
		if((paginaActual != null) && (totalPaginas != null)){
			if(paginaActual <= 1) this.paginador.indice = 0;
			else if(paginaActual >= totalPaginas) this.paginador.indice = this.paginador.cantidad*(totalPaginas-1);
			else this.paginador.indice = this.paginador.cantidad*(paginaActual-1);
		}
		else{
			this.paginador.indice = 0;
		}
		if(paginaActual == null || paginaActual == 0) paginaActual = 1;
		else if(paginaActual > totalPaginas) paginaActual = totalPaginas; 	

		operador.listar();
	}
};
function actualizarPaginador(lista){
        operador.paginador.cantidad = parseInt(lista.value);
		operador.mostrarPaginador();
	}