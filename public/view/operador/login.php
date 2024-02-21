<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once "../public/view/includes/head.php";
		$headTitle = "Sistema ReservaExpress";
        $pass = "1234";
        $hash = password_hash($pass,PASSWORD_DEFAULT);
    ?>
    <script defer type="text/javascript" src="view/operador/js/login.js"></script>
</head>
<header>
    <?php
       require_once "../public/view/includes/headerlogin.php";
    ?>
</header>
<body>
    <header>
		<img src="img/tipografia.png" alt="ReservaExpress tipografia" width="260" height="120">
		<img src="img/logo.png" alt="ReservaExpress logo" width="148" height="148">
	</header>
    <main>
		<form class="formulario_login" id="formLogin" method="POST" action="">
			<h1 class="h3 mb-3 font-weight-normal">Ingrese sus datos</h1>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user fa-lg"></i></span>
				</div>
				<label for="datoCuenta" class="sr-only">Cuenta: </label>
				<input required type="text" class="form-control" id="datoCuenta" name="datoCuenta" placeholder="Ingrese su nombre de usuario" autofocus required>
			</div>

			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-key fa-lg"></i></span>
				</div>
				<label for="datoClave" class="sr-only">Contraseña: </label>
				<input required type="password" class="form-control" id="datoClave" name="datoClave" placeholder="Ingrese su contraseña">
			</div>

			<div class="row px-2">
			  	<button type="button" class="btn btn-primary btn-lg btn-block" onclick="log()">Ingresar</button>
			</div>
    <!--- Handler de error - PROBARRRR
            <?php
                //if(isset($error) && ($error != "")){
            ?>
			<div class="alert alert-danger py-0 mt-4 mb-1" role="alert">
				<p class="my-3 text-danger"><?php //echo $error; ?></p>
			</div>
            <?php
                //}
            ?>
    --->
		</form>
        <!-- IMPLEMENTAR? -->
		<light><a href="">Recuperar contraseña</a></light>
	</main>
</body>
<footer>
    <?php
        require_once "../public/view/includes/footer.php";
    ?>
</footer>
</html>