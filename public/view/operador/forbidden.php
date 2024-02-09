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
		<strong>No tiene los permisos para acceder a esta página.</strong>
        <p>Por favor, inicie sesión con un usuario que tenga los permisos necesarios.</p>
        <center>
            <!--- REVISARRRRRRRRRRRRRRRRRRR ENLACEEEEEEEEEEEEEEEEEEEEE -->
            <a href="socio/index">Volver atrás</a>
        </center>
	</div>
</body>
<footer>
    <?php
        require_once "../public/view/includes/footer.php";
    ?>
</footer>
</html>