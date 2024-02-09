<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset = "UTF-8">
	<title>Saliendo del sistema</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="<?php echo URL_SERVER;?>"/>
	<meta name="description" content="Despedida del sistema"/>
	<meta name="author" content="DeltaPie"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	<!-- <link href="css/login.css" rel="stylesheet" type="text/css" > -->
</head>
<!-- <body class="d-flex justify-content-center align-items-lg-center">		 -->
<body class="container-fluid text-justify h5 overflow-auto">
	<div class="alert alert-info">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<strong>Se ha desconectado del sistema correctamente.</strong>
		<p id="contador">Será redireccionado a la página de autenticación en 5 segundos....</p>
		<p>Si no lo redirecciona, haga click <a href="public">aquí</a></p>
	</div>

	<script type="text/javascript">
		var count = 5;
		var counter = setInterval(timer, 1000);
		function timer(){
  			count=count-1;
  			if (count <= 0){
     			clearInterval(counter);
     		return;
  			}
  		if(count == 1){
  			document.getElementById("contador").innerHTML='Será redireccionado a la página de autenticación en '+count+' segundo....';
  		}
  		else{
  			document.getElementById("contador").innerHTML='Será redireccionado a la página de autenticación en '+count+' segundos....';
		}
	}
	</script>
</body>
</html>