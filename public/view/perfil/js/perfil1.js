const showSave = ()=>{
   
    //window.location.href = "view/cliente/cliente_alta.php";
    window.location.href = "perfil/showSave";
};


function showPerfiles(){
    window.location.href = "perfil/index";

}
document.addEventListener("DOMContentLoaded",()=>{
    listar();
        });

function resetear(){
let form= document.getElementById("formReseteo");

pass1= form.pass1.value;
pass2= form.pass2.value;
x= document.getElementById("y").value;
alert("x es"+x)

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
           window.location.href = "";
        
      
    })
    .catch(()=>{alert()});
 
   
}
else{
    alert("Las contraseñas deben coincidir.")
}
}
const showIndex = ()=>{
   
    //window.location.href = "view/cliente/cliente_alta.php";
    window.location.href = "perfil/index";
};
const showClientes = ()=>{
 
    //window.location.href = "view/cliente/cliente_alta.php";
    window.location.href = "cliente/index";
};
const hola =()=>{

}
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
    let form = document.forms["fm"];
    

if(form.reportValidity()==true){

    let request = {};
    

    request.nombre = form.datoNombre.value;

    request.id=form.datoId.value;
    
   
    fetch("perfil/update",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
       else{
        alert("Se ha actualizado el perfil.")
        window.location.href="perfil/index";
       } 
        
      
    })
    .catch(()=>{"error"});
   
}

    

      
    


 
}

const delet = (id )=>{
  fetch("perfil/delete",{
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
            alert("Perfil borrado exitosamente")
            window.location.href="perfil/index";
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
const listar = ()=>{

  
    fetch("perfil/list")
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            alert("ocurrió un error: " + data.error);
            return;
        }
        if(data.result == ''){
            alert("No hay perfiles para mostrar")
        }


        
        //procesar data.result en una tabla (mostrar los clientes)
        let usuarios= data.result;

     

 if(cont== 0 ){
       usuarios.forEach((cli)=>{
       
            let html= '<tr  id= "'+cli.id+'" class="">';
            html += '<td id="inden">' +  cli.id+ '</td>';
            html += '<td id="">' + cli.nombre + '</td>';
            
           
            html += '<td id=""><a  href="perfil/showUpdate/'+cli.id+'" >Modificar</a>    <a  href="perfil/showDelete/'+cli.id+'" >   Eliminar</a></td>';
           
            html += '</tr>';
  
    document.getElementById("tablaUsuarios").insertAdjacentHTML("beforeend",html);
cont= 1;
        });
    }
    });

};

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
const sendNewPerfil = ()=>{
    
    let form = document.forms["fap"];
    
  if(form.reportValidity()){

  
    
    let request = {};

    request.nombre = form.datoNombre.value;
  
   

    

    fetch("perfil/save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
       alert("Se registró el nuevo usuario " + data.result.nombre);
       form.reset();
       window.location.href = "perfil/index";
     
    })
    .catch(()=>{});
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