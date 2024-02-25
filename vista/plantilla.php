<html lang="es">
	<head>
		<!-- ESTILO -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<base href="<?php echo URL_SERVER;?>"/>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css"> -->

		<!-- Librería jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- <script src="lib/jquery/jquery-3.5.1.min.js"></script> -->


		<!-- Librería Popper -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<!-- <script src="lib/popper/src/popper.js"></script> -->

		<!-- Latest compiled JavaScript Bootstrap-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Fontawesome -->
		<script defer src="lib/fontawesome/js/all.js"></script>

		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<title><?php echo NOMBRE_SISTEMA;?></title>

<?php
	// CARGA DE SCRIPTS
	if(isset($scripts)){
		foreach($scripts as $script){
			echo $script;
		}
	}
?>
	</head>
	<body>
<?php
	// CARGA DE MENÚ
	require_once "secciones/menu_principal.php";
?>
		<div id="divContenedor" class='container-fluid mx-0'>
<?php
	// CARGA DE CONTENIDO A MOSTRAR
	require_once $contenido;
?>
		</div>

		<footer class="container-fluid bg-light text-muted text-center mx-0 mt-3">
			<p class="my-1"><small>Sistema de gestión de reservas - Versión 1.0 - Delta Pie</small></p>
		</footer>
	</body>
</html>