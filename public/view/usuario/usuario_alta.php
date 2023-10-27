<!DOCTYPE html>
<html lang="en">
<head>
   <?php
  require_once "../public/view/includes/head.php";
   ?>
    <script defer type="text/javascript" src="view/usuario/js/usuario1.js"></script>    
</head>
<header style="background-color: red">
<?php
       require_once "../public/view/includes/header.php";
   ?>
    </header>
<body>
    <br>
    <center> 
     <h1>Alta de Usuario</h1>
    <br>
    <form class="form-label" id="formAltaU" method="POST" action="usuario/save">
     
    
      
         <div   class=" col-sm-2">
            <label for="">Apellido</label>
            <input maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoApellido" id="datoApellido">
        </div>

        <div  class=" col-sm-2">
            <label for="">Nombre</label>
            <input  minlength="3" maxlength="45" required  required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoNombre" id="datoNombre">
        </div>
    
        <div class=" col-sm-2">
            <label for="">Correo  </label>
            <input  maxlength="255" minlength="15" type="text" name="datoCorreo" id="datoCorreo">
        </div>
   
        <div class=" col-sm-2">
            <label for="">Cuenta</label>
            <input  maxlength="45" minlength="5" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}"  type="text" name="datoCuenta" id="datoCuenta">
        </div>
        <div class=" col-sm-2"> 
            
    
        </div>
        <br>
        <div class=" col-sm-2">
            <label for="">PerfilId</label>
        <select  id="selPer">
           <option required value="0">Seleccione:</option>
           <script>
                 

            </script>
        </select>
        </div>
        <br>
        <div class=" col-sm-2">
            <label for="">Hora de  Entrada</label>
            <input  required   type="time" name="datoHoraEntrada" id="datoHoraEntrada">
        </div>
        <br>
        <div class=" col-sm-2">
            <label for="">Hora de Salida</label>
            <input  required   type="time" name="datoHoraSalida" id="datoHoraSalida">
        </div>
        <br>
        
   
    
       
        <button id="guardarUsuario"  name="guardarUsuario" type="button" onclick="sendNewUser()"class="btn btn-success my-4"  >Registrar </button>
        <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
    </form>
    <a href="usuario/index">Volver a la página de inicio</a>
    </center>
</body>
<footer>
<?php

require_once "../public/view/includes/footer.php";
   ?>
</footer>
</html>