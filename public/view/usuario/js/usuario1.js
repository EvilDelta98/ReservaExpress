const showSave = ()=>{
   
    //window.location.href = "view/cliente/cliente_alta.php";
    window.location.href = "usuario/showSave";
};

function showPerfiles(){
    window.location.href = "perfil/index";

}
function hola(){
    alert("hola")
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
        let usuarios= data.result;

     

 if(cont== 0 ){
       usuarios.forEach((cli)=>{
        
        

        if(cli.estado==1){
            estado="Activo";
        }
        else{
            estado="Inactivo";
        }
        if(cli.reseteoClave==1){
            reseteo= "Debe resetear";
        }
        else{
            reseteo= "No debe resetear";
        }
            let html= '<tr  id= "'+cli.id+'" class="">';
            html += '<td id="inden">' +  cli.id+ '</td>';
            html += '<td id="">' +  cli.apellido+ '</td>';
            html += '<td id="">' + cli.nombre + '</td>';
            html += '<td id="">' + cli.correo+ '</td>';
            html += '<td id="">' + cli.cuenta + '</td>';
          
            html += '<td id="">'+cli.perfilId+ '</td>';
            html += '<td id="">'+estado+ '</td>';
            html += '<td id="">'+ cli.horaEntrada+ '</td>';
            html += '<td id="">'+ cli.horaSalida+ '</td>';
            html += '<td id="">'+ cli.fechaAlta+ '</td>';
            html += '<td id="">'+reseteo+ '</td>';
           
            html += '<td id=""><a  href="usuario/showUpdate/'+cli.id+'" >Modificar</a></td>';
            html += '<td id=""><a  href="usuario/showDelete/'+cli.id+'" >Eliminar</a></td>';

            html += '</tr>';
  
    document.getElementById("tablaUsuarios").insertAdjacentHTML("beforeend",html);
cont= 1;
        });
    }
    });
  


    fetch("perfil/list")
    .then(response => response.json())
    .then(data => {
     if(data.error !== ""){
       alert(data.error);
        return;
        }








let usuarios= data.result;
usuarios.forEach((c)=>{


let html =  '<option value='+c.id+'>'+c.nombre+'</option>';


document.getElementById("selPer").insertAdjacentHTML("beforeend",html);


});


})

        });
    

function resetear(){
let form= document.getElementById("formReseteo");

pass1= form.pass1.value;
pass2= form.pass2.value;
x= document.getElementById("y").value;


let request = {};
 request.datoClave= form.pass2.value;
 request.datoCuenta= x;




 
if(form.reportValidity()== true && (pass1==pass2)){

    fetch("usuario/resetear",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        
            
           alert("La contraseña se ha actualizado.");
           window.location.href = "usuario/login";
        
      
    })
    .catch(()=>{alert()});
 
   
}
else{
    alert("Las contraseñas deben coincidir. pass1 es ");
}
}
const showIndex = ()=>{
   
    //window.location.href = "view/cliente/cliente_alta.php";
    window.location.href = "usuario/index";
};
const showClientes = ()=>{
 
    //window.location.href = "view/cliente/cliente_alta.php";
    window.location.href = "cliente/index";
};

function salir(){
    window.location.href = "usuario/logout";
}
const hidd =(id)=>{

/*fetch("cliente/showDelete",{
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


const actualizar =(id)=>{
    let form = document.forms["formModificarU"];
    
 
if(form.reportValidity()==true){

    
    let request = {};
    request.datoApellido = form.datoApellido.value;
    request.datoNombre = form.datoNombre.value;
    request.datoCorreo = form.datoCorreo.value;
    request.datoCuenta= form.datoCuenta.value;
    request.datoPerfilId=form.selPer.value;
    request.datoEstado=form.datoEstado.value;
    request.datoHoraEntrada=form.datoHoraEntrada.value;
    request.datoHoraSalida=form.datoHoraSalida.value;
    request.datoReseteoClave=form.datoReseteoClave.value;
    request.x=form.x.value;
 
   
    fetch("usuario/update",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        alert("Se han actualizado los datos del usuario.")
        window.location.href="usuario/index";
        
      
    })
    .catch(()=>{});
   
}

    

      
    


 
}

const delet = (id )=>{
  fetch("usuario/delete",{
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
            window.location.href="usuario/index";
        }
    }
    )}

    /*prods.forEach(prod=>{
idd= document.querySelectorAll("iden");
idd.forEach((i) => {
    if(id==$id){

    }*/
    


/*const filter ={
//startIndex=0;
//records: 3;

};
*/
let cont= 0;
/*function list(){

  
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
        let usuarios= data.result;

     

 if(cont== 0 ){
       usuarios.forEach((cli)=>{
      console.log(cli.perfil);
                  let html= '<tr  id= "'+cli.id+'" class="">';
            html += '<td id="inden">' +  cli.id+ '</td>';
            html += '<td id="">' +  cli.apellido+ '</td>';
            html += '<td id="">' + cli.nombre + '</td>';
            
        
            html += '<td id="">' + cli.correo+ '</td>';
            html += '<td>' + cli.cuenta + '</td>';
            html += '<td id="gvg"> '+ cli.correo+'</td>';
            html += '<td id="">'+estado+ '</td>';
            html += '<td id="">'+ cli.horaEntrada+ '</td>';
            html += '<td id="">'+ cli.horaSalida+ '</td>';
            html += '<td id="">'+ cli.fechaAlta+ '</td>';
            html += '<td id="">'+reseteo+ '</td>';
           
            html += '<td id=""><a  href="usuario/showUpdate/'+cli.id+'" >Modificar</a></td>';
            html += '<td id=""><a  href="usuario/showDelete/'+cli.id+'" >Eliminar</a></td>';

            html += '</tr>';
  
    document.getElementById("tablaUsuarios").insertAdjacentHTML("beforeend",html);
cont= 1;
        });
    }
    });

};*/

/*document.addEventListener("DOMContentLoaded",()=>{

let btnGuardar=document.getElementById("guardarUsuario"); //otra forma
btnGuardar.onclick= ()=>{
let form1 =document.forms["formAltaU"];
if(form1.reportValidity()== true){
alert("pasaste el repor ")
   sendNewClient();

}
else{
    alert("Complete los campos correctamente.")
}
    
}

let btnMod=document.getElementById("modCliente"); //otra forma
btnMod.onclick= ()=>{
let form =document.forms["formModificarU"];
if(form.reportValidity()== true){

  id= document.getElementById("x").value;

   actualizar(id);

}
else{
    alert("Complete los campos correctamente.")
}
    
}
});
*/
const sendNewUser = ()=>{
    
    let form = document.forms["formAltaU"];
    let selectt= document.getElementById("datoPerfilId");
  if(form.reportValidity() ){

  
    let request1 = {};
    request1.datoApellido = form.datoApellido.value;
    request1.datoNombre = form.datoNombre.value;
    request1.datoCorreo = form.datoCorreo.value;
    request1.datoCuenta= form.datoCuenta.value;
    request1.datoClave=form.datoNombre.value+form.datoApellido.value;
    request1.datoPerfilId=form.selPer.value;
    request1.datoHoraEntrada=form.datoHoraEntrada.value;
    request1.datoHoraSalida=form.datoHoraSalida.value;
   

 

    fetch("usuario/save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request1)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
       alert("Se registró el nuevo usuario " + data.result.apellido);
       form.reset();
       window.location.href="usuario/index";
     
    })
    .catch(()=>{});
  }
  else{
    if(form.reportValidity() && !selectt.value == "nada")
    alert("Seleccione el perfil del usuario.")
  }

   }
/*}
    form = new FormData(document.forms["formAlta"]);
    fetch("cliente/save",{"method":"POST", "body": new URLSearchParams(form.entries())})
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(()=>{});
    */


const limpiar  = (id)=>{


id.reset();
}