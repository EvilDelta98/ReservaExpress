<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/perfil/js/perfil.js"></script>    
</head>
<header>
    <?php
        require_once "../public/view/includes/header.php";
    ?>
</header>
<body>
    <br>
    <center> 
        <h1>Agregar nuevo perfil</h1>
        <br>
        <form class="form-label" id="fap" name="fm" method="POST" action="">
            <div  class=" col-sm-2">
                <label for="">Nombre</label>
                <br>
                <input minlength="5" maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoNombre" id="datoNombre">
            </div>
            <br>
            <button type="button" class="btn btn-primary ms-3" onclick="sendNewPerfil()">Aceptar</button>
        </form>
        <a href="perfil/index">Volver a la página de inicio</a>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </center>
</body>
<footer>
    <?php
        require_once "../public/view/includes/footer.php";
    ?>
</footer>
</html>