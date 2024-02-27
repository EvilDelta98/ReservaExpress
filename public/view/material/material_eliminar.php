<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/material/js/material.js"></script>
</head>
<header>
    <?php
        require_once "../public/view/includes/header.php";
    ?>
</header>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Eliminar Material</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!--- FALTA AGREGAR QUÉ USUARIO --->
                <h2>¿Está seguro de que desea eliminar el usuario <?php ?>?</h2>
                <form class="form-label" id="formEliminarMat" method="POST" action="material/delete">
                    <button id="eliminarMaterial" name="eliminarMaterial" type="button" onclick="delet(<?= $data ?>)" class="btn btn-danger my-4">Eliminar</button>
                    <button id="limp" name="limp" type="button" onclick="limpiar(formEliminarMat)" class="btn btn-warning my-4">Limpiar</button>
                    <!-- <input type="hidden" id="idCliente" name="idCliente" value=""> -->
                </form>
                <a href="public" class="btn btn-primary my-4">Volver</a>
            </div>
        </div>
    </div>
</body>
<footer>
    <?php
        require_once "../public/view/includes/footer.php";
    ?>
</footer>
</html>