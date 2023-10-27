const showSave = ()=>{

   window.location.href = "cliente/showSave";
};

document.addEventListener("DOMContentLoaded",()=>{
list();
    });


const showIndex = ()=>{
   
    //window.location.href = "view/cliente/cliente_alta.php";
    window.location.href = "view/cliente/index.php";
};


function salir(){
    window.location.href = "usuario/logout";
}
function act (id){
    fetch("cliente/update",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);


            return;
        }
        alert("Se han actualizado los datos del cliente.")
        window.location.href="cliente";
        
      
    })
    .catch(()=>{});
   

}
const actualizar =(id)=>{
    let form = document.forms["formModificar"];
    
if(form.reportValidity()){
    let request = {};
    request.datoApellido = form.datoApellido.value;
    request.datoNombres = form.datoNombres.value;
    request.datoDNI = form.datoDNI.value;
    request.datoDomicilio= form.datoDomicilio.value;
    request.datoLocalidad=form.datoLocalidad.value;
    request.datoProvincia=form.datoProvincia.value;
    request.datoPostal=form.datoPostal.value;
    request.datoTelefono=form.datoTelefono.value;
    request.datoCorreo=form.datoCorreo.value;
    request.x=form.x.value;
  
    
   
    fetch("cliente/update",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        alert("Se han actualizado los datos del cliente.")
        window.location.href="cliente/index";
        
      
    })
    .catch(()=>{});
   
      
}
    

      
    


 
}

const delet = (id )=>{
 
  fetch("cliente/delete",{
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
            alert("Cliente borrado exitosamente")
            window.location.href="cliente/index";
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
const list = ()=>{

 
    fetch("cliente/list",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("ocurrió un error: " + data.error);
            return;
        }
        if(data.result == ''){
            alert("No hay clientes para mostrar")
        }


        
        //procesar data.result en una tabla (mostrar los clientes)
        let clientes = data.result;
   

     

 if(cont== 0 ){

        clientes.forEach((cli)=>{
                   
            let html= '<tr  id= "'+cli.id+'" class="">';
            html += '<td id="inden">' +  cli.id+ '</td>';
            html += '<td id="">' +  cli.apellido+ '</td>';
            html += '<td id="">' + cli.nombres + '</td>';
            html += '<td>'+ + cli.dni + '</td>';
            html += '<td id="">' + cli.domicilio+ '</td>';
            html += '<td id="">'+cli.localidad+ '</td>';
            html += '<td id="">'+cli.provincia+ '</td>';
            html += '<td id="">'+cli.telefono+ '</td>';
            html += '<td id="">'+ cli.codPostal+ '</td>';
            html += '<td id="">'+ cli.correo+ '</td>';
            html += '<td id="">'+ cli.fechaAlta+ '</td>';
           
            html += '<td id=""><a  href="cliente/showUpdate/'+cli.id+'" >Modificar</a></td>';

            html += '<td id=""><a  href="cliente/showDelete/'+cli.id+'" >Eliminar</a></td>';

            html += '</tr>';
  
    document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
cont= 1;
        });
    }
    });
    
    

};

/*document.addEventListener("DOMContentLoaded",()=>{

let btnGuardar=document.getElementById("guardarCliente"); //otra forma
btnGuardar.onclick= ()=>{

let form1 =document.forms["formAlta"];
if(form1.reportValidity()== true){

   sendNewClient();

}
else{
    alert("Complete los campos correctamente.")
}
    
}

let btnMod=document.getElementById("modCliente"); //otra forma
btnMod.onclick= ()=>{
let form =document.forms["formModificar"];
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
const sendNewClient = ()=>{
   
 
    let form = document.forms["formAlta"];
    
  if(form.reportValidity()){
   
    let request = {};
    request.datoApellido = form.datoApellido.value;
    request.datoNombres = form.datoNombres.value;
    request.datoDNI = form.datoDNI.value;
    request.datoDomicilio= form.datoDomicilio.value;
    request.datoLocalidad=form.datoLocalidad.value;
    request.datoProvincia=form.datoProvincia.value;
    request.datoPostal=form.datoPostal.value;
    request.datoTelefono=form.datoTelefono.value;
    request.datoCorreo=form.datoCorreo.value;
 
    

    fetch("cliente/save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        
            alert("Se registro el cliente: " +  data.apellido);
            window.location.href="cliente/index";
    
      
    })
    .catch(()=>{});

   form.reset();
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