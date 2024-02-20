const showSave = ()=>{
    //window.location.href = "view/socio/socio_alta.php";
    window.location.href = "operador/showSave";
};

function showPerfiles(){
    window.location.href = "perfil/index";
}

//FUNCIÓN DE PRUEBA
function prueba(){
    alert("Prueba Operador.js");
}

document.addEventListener("DOMContentLoaded",()=>{
    fetch("usuario/list")
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("ocurrió un error: " + data.error);
            return;
        }
        if(data.result == ''){
            alert("No hay usuarios para mostrar")
        }

        //procesar data.result en una tabla (mostrar los clientes)
        let usuarios = data.result;
        if(cont == 0){
            usuarios.forEach((c)=>{
                if(c.estado == 1){estado="Activo";} else{estado="Inactivo";}
                //LENARRRRRRR IDDDDSSSS TD
                let html= '<tr  id= "' + c.id + '" class="">';
                html += '<td id="inden">' +  c.id + '</td>';
                html += '<td id="">' +  c.apellido + '</td>';
                html += '<td id="">' + c.nombre + '</td>';
                html += '<td id="">' + c.correo + '</td>';
                html += '<td id="">' + c.cuenta + '</td>';
                html += '<td id="">' + c.perfilId + '</td>';
                html += '<td id="">' + c.tipoUsuario + '</td>';
                html += '<td id="">' + estado + '</td>';
                html += '<td id="">' + cli.fechaAlta + '</td>';
            
                html += '<td id=""><a  href="operador/showUpdate/'+c.id+'" >Modificar</a></td>';
                html += '<td id=""><a  href="operador/showDelete/'+c.id+'" >Eliminar</a></td>';

                html += '</tr>';
  
                document.getElementById("tablaUsuarios").insertAdjacentHTML("beforeend",html);
                cont= 1;
            }); //Cierra el forEach y se guarda en c
        } //Cierra el if
    }); //Cierra el .then y se guarda en la variable data
  
    fetch("perfil/list")
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert(data.error);
            return;
        }
        let usuarios = data.result;
        usuarios.forEach((c)=>{
        let html = '<option value='+c.id+'>'+c.nombre+'</option>';
        document.getElementById("selPer").insertAdjacentHTML("beforeend",html);
        });
    })
});
    
function resetear(){
    let form = document.getElementById("formReseteo");
    pass1 = form.pass1.value;
    pass2 = form.pass2.value;
    x = document.getElementById("y").value;

    let request = {};
    request.datoClave= form.pass2.value;
    request.datoCuenta= x;

    if(form.reportValidity() == true && (pass1==pass2)){
        fetch("operador/resetear",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
            alert(data.error);
                return;
            }
            alert("La contraseña se ha actualizado.");
            window.location.href = "operador/login";
        })
        .catch(()=>{alert()});
    }
    else{
        alert("Las contraseñas deben coincidir.");
    }
}

const showIndex = ()=>{
    //window.location.href = "view/socio/socio_alta.php";
    window.location.href = "operador/index";
};

const showSocios = ()=>{
    //window.location.href = "view/socio/socio_alta.php";
    window.location.href = "socio/index";
};

function salir(){
    window.location.href = "operador/logout";
}

const hidd = (id)=>{
    /*fetch("socio/showDelete",{
        method:'POST',
        body:id
    })
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("ocurrió un error: " + data.error);
            return;
        }
    }
    )}
    */
}

const actualizar = (id)=>{
    let form = document.forms["formModificarU"];
    
    if(form.reportValidity()==true){
        let request = {};
        request.datoNombre = form.datoNombre.value;
        request.datoApellido = form.datoApellido.value;
        request.datoCorreo = form.datoCorreo.value;
        request.datoCuenta= form.datoCuenta.value;
        //request.datoPerfilId=form.selPer.value;
        request.datoTipoUsuario=form.datoTipoUsuario.value;
        request.datoEstado=form.datoEstado.value;
        request.x=form.x.value;
    
        fetch("operador/update",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert(data.error);
                return;
            }
            alert("Se han actualizado los datos del usuario.")
            window.location.href="operador/index";
        })
        .catch(()=>{});
    }
}

const delet = (id)=>{
    fetch("operador/delete",{
        method:'POST',
        body:id
    })
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("ocurrió un error: " + data.error);
            return;
        }
        else{
            alert("Usuario borrado exitosamente")
            window.location.href="operador/index";
        }
    })
}

/* function list(){
    fetch("operador/list")
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("ocurrió un error: " + data.error);
            return;
        }
        if(data.result == ''){
            alert("No hay usuarios para mostrar")
        }
        //procesar data.result en una tabla (mostrar los clientes)
        let usuarios= data.result;
        if(cont == 0){
            usuarios.forEach((c)=>{
                console.log(c.perfil);
                let html= '<tr  id= "' + c.id + '" class="">';
                html += '<td id="inden">' + c.id + '</td>';
                html += '<td id="">' + c.nombre + '</td>';
                html += '<td id="">' + c.apellido + '</td>';
                html += '<td id="gvg"> '+ cli.correo+'</td>';
                html += '<td id="">' + c.cuenta + '</td>';
                html += '<td id="">' + c.tipoUsuario + '</td>';
                html += '<td id="">' + estado + '</td>';
                html += '<td id="">' + c.fechaAlta + '</td>';
                
                html += '<td id=""><a  href="operador/showUpdate/'+c.id+'" >Modificar</a></td>';
                html += '<td id=""><a  href="operador/showDelete/'+c.id+'" >Eliminar</a></td>';
                html += '</tr>';
        
                document.getElementById("tablaUsuarios").insertAdjacentHTML("beforeend",html);
                cont= 1;
            });
        }
    });

}; */

/* document.addEventListener("DOMContentLoaded",()=>{
    let btnGuardar = document.getElementById("guardarUsuario"); //otra forma
    btnGuardar.onclick = ()=>{
        let form1 = document.forms["formAltaU"];
        if(form1.reportValidity() == true){
            alert("Pasó el reportValidity");
            sendNewClient();
        }
        else{
            alert("Completó los campos correctamente.");
        }  
    }

    let btnMod = document.getElementById("modCliente"); //otra forma
    btnMod.onclick = ()=>{
        let form = document.forms["formModificarU"];
        if(form.reportValidity() == true){
            id = document.getElementById("x").value;
            actualizar(id);
        }
        else{
            alert("Completó los campos correctamente.");
        } 
    }
}); */

const sendNewUser = ()=>{
    let form = document.forms["formAltaU"];
    let select = document.getElementById("datoPerfilId");
    if(form.reportValidity()){
        let request1 = {};
        request1.datoNombre = form.datoNombre.value;
        request1.datoApellido = form.datoApellido.value;
        request1.datoCorreo = form.datoCorreo.value;
        request1.datoCuenta = form.datoCuenta.value;
        //request1.datoClave=form.datoNombre.value+form.datoApellido.value;
        //request1.datoPerfilId=form.selPer.value;
        request1.datoTipoUsuario=form.datoTipoUsuario.value;
        request1.datoEstado=form.datoEstado.value;
        //REVISARRRRRR ESTA VARIABLE X
        request1.x=form.x.value;

        fetch("operador/save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request1)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert(data.error);
                return;
            }
            alert("Se registró el nuevo usuario " + data.result.apellido);
            form.reset();
            window.location.href="operador/index";
        })
        .catch(()=>{});
    }
    else{
        //REVISAR ESTE "nada" EN LA CAJA PARA SELECCIONAR VALORES
        if(form.reportValidity() && !select.value == "nada")
        alert("Seleccione el perfil del usuario.")
    }
}

/*
}
    form = new FormData(document.forms["formAlta"]);
    fetch("cliente/save",{"method":"POST", "body": new URLSearchParams(form.entries())})
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(()=>{});
*/

const limpiar = (id)=>{
    id.reset();
}