<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset = "UTF-8">
	<title>Ingreso al sistema</title>
	<base href="<?php echo URL_SERVER;?>"/>
	<meta name="description" content="Ingreso al sistema"/>
	<meta name="author" content="DeltaPie"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css"> -->
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- <script src="lib/jquery/jquery-3.5.1.min.js"></script> -->
	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <script href="lib/bootstrap/js/bootstrap.js"></script> -->

	<script defer src="lib/fontawesome/js/all.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- <script defer src="lib/popper/src/popper.js"></script> -->

	<!-- <script href="lib/bootstrap/js/transition.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	<script defer type="text/javascript" src="lib/jshash-2.2/md5.js"></script>
	<script defer type="text/javascript">
		function validarLogin(){
			$("#textClave").val(hex_md5($("#textClave").val()));
			return true;
		}
	</script>
	<link href="css/estilo.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>
<body class="text-center">
	<header>
		<img src="img/tipografia.png" alt="ReservaExpress tipografia" width="260" height="120">
		<img src="img/logo.png" alt="ReservaExpress logo" width="148" height="148">
	</header>
	<main>
		<form class="formulario_login" method="POST" action="index.php" onsubmit="return validarLogin();">
			<h1 class="h3 mb-3 font-weight-normal">Ingrese sus datos</h1>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user fa-lg"></i></span>
				</div>
				<label for="textUsuario" class="sr-only">Nombre de usuario: </label>
				<input type="text" class="form-control" id="textUsuario" name="textUsuario" placeholder="Ingrese su nombre de usuario" autofocus required>
			</div>

			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-key fa-lg"></i></span>
				</div>
				<label for="textClave" class="sr-only">Contraseña: </label>
				<input type="password" class="form-control" id="textClave" name="textClave" placeholder="Ingrese su contraseña" required>
			</div>

			<div class="row px-2">
			  	<button type="submit" class="btn btn-primary btn-lg btn-block">Ingresar</button>
			  	<input type="hidden" id="c" name="c" value="operador"/>
			  	<input type="hidden" id="a" name="a" value="index"/>
			</div>
<?php
	if(isset($error) && ($error != "")){
?>
			<div class="alert alert-danger py-0 mt-4 mb-1" role="alert">
				<p class="my-3 text-danger"><?php echo $error; ?></p>
			</div>
<?php
	}
?>
		</form>
		<light><a href="">Recuperar contraseña</a></light>
	</main>
	<footer>
		<p class="mt-5 mb-3 text-muted">© DeltaPie 2024</p>
	</footer>
</body>
</html>