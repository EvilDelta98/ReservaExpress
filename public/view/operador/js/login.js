function log(){
    let form = document.forms["formLogin"];
    let request = {};
    let cuenta = form.datoCuenta.value;
    request.datoCuenta = form.datoCuenta.value;
    request.datoClave = form.datoClave.value;
    if(form.reportValidity()==true){
        fetch("usuario/autentication",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
        .then(response => response.json())
        .then(data => {
            if(data.error !== "" && data.error !=="Debe resetear su clave"){
                alert(data.error);
                return;
            }
            if(data.perfil == "1"){
                //REVISARRRRRRRRRRRRRRRRRRRRRRR
                window.location.href = "operador/admin";
            };
            if(data.perfil == "4"){
                //REVISARRRRRRRRRRRRRRRRRRRRRRR
                window.location.href = "socio/index";
            };
            if(data.error == "Debe resetear su clave"){
                //REVISARRRRRRRRRRRRRRRRRRRRRRR
                window.location.href = "operador/reseteoClave/"+cuenta;
            };
        })
        .catch(()=>{});
    }
}