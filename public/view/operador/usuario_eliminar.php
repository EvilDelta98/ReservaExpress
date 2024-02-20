<!DOCTYPE html>
<html lang="es">
<head>
    <?php
       require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/operador/js/operador.js"></script>
</head>
<header>
    <?php
       require_once "../public/view/includes/header.php";
    ?>
</header>
<body>
    <center>
        <br>
        <br>
        <br>
        <br>
        <!--- FALTA AGREGAR QUÉ USUARIO --->
        <h2>¿Está seguro de que desea eliminar el usuario <?php ?>?</h2>
        <div class="">
            <br>
            <br>
            <br>
            <form id="formEliminar" name="formEliminar">
                <button type="button" class="btn btn-primary ms-3" onclick="delet(<?= $data ?>)">Aceptar</button>
                <button type="button" class="btn btn-primary ms-3" onclick="showIndex()">Cancelar</button>
                <input type="hidden" id="idCliente" name="idCliente" value="<?= $data ?>">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </form>
        </div>
    </center>
</body>
<footer>
    <?php
       require_once "../public/view/includes/footer.php";
    ?>
</footer>
</html>