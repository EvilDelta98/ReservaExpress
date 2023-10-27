

<!DOCTYPE html>
<html lang="es">
<head>
<?php
       require_once "../public/view/includes/head.php";
   ?>
    <script defer type="text/javascript" src="view/perfil/js/perfil1.js"></script>
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
  <h2>¿Está seguro de que desea eliminar el perfil? </h2>
  <div class="">
    <br>
    <br>
   
    
    
        <form id="formEliminar" name="formEliminar">
        <button type="button" class="btn btn-primary ms-3" onclick="delet(<?= $data ?>)">Aceptar</button>
        <button type="button" class="btn btn-primary ms-3" onclick="showPerfiles()">Cancelar</button>


        <input type="hidden" id="idCliente" name="idCliente" value="<?= $data ?>">
    </div>
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