document.addEventListener("DOMContentLoaded",()=>{
    alert("hola");
    list();
});
function list () {

 
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
  
    document.getElementById("tablaReporte").insertAdjacentHTML("beforeend",html);
cont= 1;
        });
    
    });
    
}


