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
     require_once ("../public/view/includes/header.php");
     ?>
    </header>
<body>
    <br>
    <br>
    <br>
   
   
    <center> <h1>Bienvenido <?= $_SESSION["usuario"]?></h1>
    <br>
    <p> Opciones:</p>
    </center>
    <center>
    <div id="botones" >
    <button type="button" class="btn btn-primary ms-3" onclick="showIndex()">Administrar Usuarios</button>
       <br>
       <br>
       <button type="button" class="btn btn-primary ms-3" onclick="showPerfiles()">Administrar Perfiles</button>
       <br>
       <br>
    <button type="button" class="btn btn-primary ms-3" onclick="showClientes()">Gestionar Clientes </button>
   <br>
   <br>

    </div>
    </center>
    <div>








    </div>
    
    
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
<footer>
<?php
       require_once ("../public/view/includes/footer.php");
   ?>
</footer>
</html>