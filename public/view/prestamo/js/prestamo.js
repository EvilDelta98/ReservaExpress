const showSave = ()=>{
    window.location.href = '/prestamo/showSave';
}

document.addEventListener('DOMContentLoaded',()=>{
    fetch("prestamo/list")
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("Ocurrió un error: " + data.error);
            return;
        }
        if(data.result == ''){
            alert("No hay registros");
        }

        //PODRÍAMOS BUSCAR PRESTAMOS VIGENTES O PRESTAMOS VENCIDOS 
        let prestamos = data.result;
        if(cont == 0){
            prestamos.foreach((prestamo)=>{
                if(prestamo.estado == 0){estado="Vigente";} else{estado="Vencido";}
                let html = '<tr id= "' + prestamos.id + '" class="">';
                html += '<td id="">' + prestamo.id + '</td>';
                //REVISAR SI ERA idSocio o sólo socio
                html += '<td id="">' + prestamo.socio + '</td>';
                //REVISAR SI ERA idEjemplar o sólo ejemplar
                html += '<td id="">' + prestamo.ejemplar + '</td>';
                html += '<td id="">' + prestamo.fechaInicio + '</td>';
                html += '<td id="">' + prestamo.fechaVencimiento + '</td>';
                html += '<td id="">' + prestamo.fechaDevolucion + '</td>';
                html += '<td id="">' + prestamo.observacion + '</td>';
                
                html += '<td id="">' + estado + '</td>';
                html += '<td id="">' + prestamo.tipo + '</td>';

                html += '<td id=""> <a href"prestamo/showUpdate/'+prestamos.id+'" >Modificar</a></td>';
                html += '<td id=""> <a href"prestamo/showDelete/'+prestamos.id+'" >Eliminar</a></td>';

                html += '</tr>';
                document.getElementById('tablaPrestamos').insertAdjacentHTML('beforeend',html);
                cont=1;
            }); //end foreach
        }   //end if
    }); //end fetch
}); //end addEventListener

const actualizar = (id)=>{
    let form = document.forms['formModificarMat'];

    if(form.reportValidity()==true){
        let request = {};
        request.id = id;
        request.socio = form.datoIdSocio.value;
        request.ejemplar = form.datoIdEjemplar.value;
        request.fechaInicio = form.datoFechaInicio.value;
        request.fechaVencimiento = form.datoFechaVencimiento.value;
        request.fechaDevolucion = form.datoFechaDevolucion.value;
        request.observacion = form.datoObservacion.value;
        request.estado = form.datoEstado.value;
        request.tipo = form.datoTipo.value;

        fetch("prestamo/update",{"method":'POST', "headers":{'Content-Type':'application/json'}, "body": JSON.stringify(request)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert("Ocurrió un error: " + data.error);
                return;
            }
            alert("Préstamo actualizado");
            window.location.href = '/prestamo/showList';
        })
        .catch(()=>{});
    }
}

const delet = (id)=>{
    fetch("prestamo/delete/",{
        method: 'POST',
        body:id
    })
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("Ocurrió un error: " + data.error);
            return;
        }
        else{
            alert("Préstamo eliminado");
            window.location.href = '/prestamo/showList';
        }
    })
}

const sendNewPrestamo = ()=>{
    let form = document.forms['formAltaPrest'];
    if(form.reportValidity()){
        let request = {};
        request.id = id;
        request.socio = form.datoIdSocio.value;
        request.ejemplar = form.datoIdEjemplar.value;
        request.fechaInicio = form.datoFechaInicio.value;
        request.fechaVencimiento = form.datoFechaVencimiento.value;
        request.fechaDevolucion = form.datoFechaDevolucion.value;
        request.observacion = form.datoObservacion.value;
        request.estado = form.datoEstado.value;
        request.tipo = form.datoTipo.value;
        
        fetch("prestamo/save",{"method":'POST', "headers":{'Content-Type':'application/json'}, "body":JSON.stringify(request)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert("Ocurrió un error: " + data.error);
                return;
            }
            alert("Se guardó el préstamo " + data.result.id);
            form.reset();
            window.location.href = '/prestamo/showList';
        })
        .catch(()=>{});
    }
}

const limpiar = (id)=>{
    id.reset();
}