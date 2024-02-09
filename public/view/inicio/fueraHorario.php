<!DOCTYPE html>
<html lang="es">
<head>
<?php
        require_once "../public/view/includes/head.php";

    ?>
</head>
<header>
<?php
       require_once "../public/view/includes/headerlogin.php";
   ?>
    </header>

<body class="container-fluid text-justify h5 overflow-auto">
	<div class="alert alert-info">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<strong>Está fuera de la franja horaria permitida</strong>
		<p id="contador">Será redireccionado a la página de inicio en 5 segundos....</p>
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

<footer>
<?php

require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>