<!DOCTYPE html>
<html lang="en">
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
    <br>
    <center> 
     <h1>Actualización de datos</h1>
    <br>
    <div class="container" >
    <form class="form-label" id="formModificar" method="POST" action="">
     
    
      
         <div   class=" col-sm-2">
            <label for="">Apellido</label>
            <input  value="<?= $cliente->getApellido() ?>" maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoApellido" id="datoApellido">
        </div>

        <div  class=" col-sm-2">
            <label for="">Nombres</label>
            <input  value="<?= $cliente->getNombres() ?>"  minlength="3" maxlength="45" required  required pattern="[a-zA-ZÀ-ÿ\s]{3,45}" type="text" name="datoNombres" id="datoNombres">
        </div>
    
        <div class=" col-sm-2">
            <label for="">Número de documento</label>
            <input   value="<?= $cliente->getDni() ?>"  maxlength="8" minlength="8" required pattern="\d{8,8}" type="text" name="datoDNI" id="datoDNI">
        </div>
   
        <div class=" col-sm-2">
            <label for="">Domicilio</label>
            <input   value="<?= $cliente->getDomicilio() ?>"  maxlength="60" minlength="10" required pattern="[a-zA-ZÀ-ÿ-0-9\s]{10,60}"  type="text" name="datoDomicilio" id="datoDomicilio">
        </div>
        <div class=" col-sm-2"> 
            <label for="">Localidad</label>
            <input  value="<?= $cliente->getLocalidad() ?>"   maxlength="30" minlength="5" required pattern="[a-zA-ZÀ-ÿ\s]{5,30}" type="text" name="datoLocalidad" id="datoLocalidad">
        </div>
        <div class=" col-sm-2">
            <label for="">Provincia</label>
            <input  value="<?= $cliente->getProvincia() ?>"  maxlength="30" minlength="8" required pattern="[a-zA-ZÀ-ÿ\s]{5,30}" type="text" name="datoProvincia" id="datoProvincia">
        </div>
        <div class=" col-sm-2">
            <label for="">Codigo postal</label>
            <input   value="<?= $cliente->getCodPostal() ?>"  maxlength="4" minlength="4" required pattern="[0-9]{4,4}" type="text" name="datoPostal" id="datoPostal">
        </div>
        <div class=" col-sm-2">
            <label for="">Telefono</label>
            <input  value="<?= $cliente->getTelefono() ?>"  maxlength="45" minlength="13" required pattern="\d{13,45}" type="text" name="datoTelefono" id="datoTelefono">
        </div>
        <div class=" col-sm-2">
            <label for="">Correo</label>
            <input    value="<?= $cliente->getCorreo() ?>"  minlength="15" maxlength="255" required type="text" name="datoCorreo" id="datoCorreo">
        </div>
        <input    value="<?= $data ?>" type="hidden" name="x" id="x">
    
        <button id="modCliente" type="button" onclick="actualizar(<?= $data ?>)" class="btn btn-success my-4"  >Actualizar</button>
        <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formModificar)" >Limpiar</button>
    </form>
    </div>
    <a href="cliente/index">Volver a la página de inicio</a>
    </center>
</body>
<footer>
<?php

       require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>