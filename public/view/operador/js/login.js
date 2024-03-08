function log(){
    
    let form=document.forms["formLogin"];
    let request = {};
    let cuenta= form.datoCuenta.value;
    request.datoCuenta= form.datoCuenta.value;
    request.datoClave= form.datoClave.value;
    if(form.reportValidity()==true){
    
       fetch("operador/au",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
       .then(response => response.json())
       .then(data => {
           if(data.error !== "" && data.error !=="Debe resetear su clave"){
              alert(data.error);
               return;
           }
        /*
           if(data.perfil == "1"){
               window.location.href = "usuario/admin";
           };
           if(data.perfil == "4"){
               window.location.href = "cliente/index";
           };
            
           if(data.error == "Debe resetear su clave"){
               
              window.location.href = "usuario/reseteoClave/"+cuenta;
               
           };*/
          // window.location.href="operador/index";
         
       })
       .catch(()=>{});
    }
   }