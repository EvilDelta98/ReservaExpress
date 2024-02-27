const showSave = ()=>{
    window.location.href = '/material/showSave';
}

document.addEventListener('DOMContentLoaded',()=>{
    fetch("material/list")
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("Ocurrió un error: " + data.error);
            return;
        }
        if(data.result == ''){
            alert("No hay registros");
        }

        let materiales = data.result;
        if(cont == 0){
            materiales.foreach((material)=>{
                if(material.estado == 0){estado="Disponible";} else{estado="No disponible";}
                let html = '<tr id= "' + materiales.id + '" class="">';
                html += '<td id="">' + material.id + '</td>';
                html += '<td id="">' + material.isbn + '</td>';
                html += '<td id="">' + material.titulo + '</td>';
                html += '<td id="">' + material.autor + '</td>';
                html += '<td id="">' + material.edicion + '</td>';
                html += '<td id="">' + material.editorial + '</td>';
                html += '<td id="">' + material.disciplina + '</td>';
                html += '<td id="">' + material.cantEjemplares + '</td>';
                html += '<td id="">' + estado + '</td>';

                html += '<td id=""> <a href"material/showUpdate/'+materiales.id+'" >Modificar</a></td>';
                html += '<td id=""> <a href"material/showDelete/'+materiales.id+'" >Eliminar</a></td>';

                html += '</tr>';
                document.getElementById('tablaMateriales').insertAdjacentHTML('beforeend',html);
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
        request.isbn = form.datoISBN.value;
        request.titulo = form.datoTitulo.value;
        request.autor = form.datoAutor.value;
        request.edicion = form.datoEdicion.value;
        request.editorial = form.datoEditorial.value;
        request.disciplina = form.datoDisciplina.value;
        request.cantEjemplares = form.datoEjemplares.value;
        request.estado = form.datoEstado.value;

        fetch("material/update",{"method":'POST', "headers":{'Content-Type':'application/json'}, "body": JSON.stringify(request)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert("Ocurrió un error: " + data.error);
                return;
            }
            alert("Material actualizado");
            window.location.href = '/material/showList';
        })
        .catch(()=>{});
    }
}

const delet = (id)=>{
    fetch("material/delete/",{
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
            alert("Material eliminado");
            window.location.href = '/material/showList';
        }
    })
}

const sendNewMaterial = ()=>{
    let form = document.forms['formAltaMat'];
    if(form.reportValidity()){
        let request = {};
        request.datoISBN = form.datoISBN.value;
        request.datoTitulo = form.datoTitulo.value;
        request.datoAutor = form.datoAutor.value;
        request.datoEdicion = form.datoEdicion.value;
        request.datoEditorial = form.datoEditorial.value;
        request.datoDisciplina = form.datoDisciplina.value;
        request.datoEjemplares = form.datoEjemplares.value;
        request.datoEstado = form.datoEstado.value;
        
        fetch("material/save",{"method":'POST', "headers":{'Content-Type':'application/json'}, "body":JSON.stringify(request)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert("Ocurrió un error: " + data.error);
                return;
            }
            alert("Se guardó el material " + data.result.titulo);
            form.reset();
            window.location.href = '/material/showList';
        })
        .catch(()=>{});
    }
}

const limpiar = (id)=>{
    id.reset();
}