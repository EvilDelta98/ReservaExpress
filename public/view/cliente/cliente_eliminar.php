

<!DOCTYPE html>
<html lang="es">
<head>
<?php
       require_once "../public/view/includes/head.php";
   ?>
    <script defer type="text/javascript" src="view/cliente/js/cliente1.js"></script>
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
<br>
  <h2>¿Está seguro de que desea eliminar el cliente <?php echo json_encode($cl->result->apellido)?></h2>
  <div class="">
        <form id="formEliminar" name="formEliminar" action="cliente/delete">
        <button type="button" class="btn btn-primary ms-3" onclick="delet(<?= $data ?>)">Aceptar</button>
        <button type="button" class="btn btn-primary ms-3" href="cliente/index">Cancelar</button>


        <input type="hidden" id="idCliente" name="idCliente" value="<?= $data ?>">
    </div>
    <br>
    <a href="cliente/index">Volver a la página de inicio</a>
    </center>
    </form>

    
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
<footer>
<?php

       require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>