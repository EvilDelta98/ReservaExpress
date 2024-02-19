<!DOCTYPE html>
<html lang="en">
<head>
<?php
  require_once "../public/view/includes/head.php";
   ?>
    <script defer type="text/javascript" src="view/usuario/js/usuario1.js"></script>    
</head>
<header>
<?php
       require_once "../public/view/includes/headerlogin.php";
   ?>
    </header>
<body>
    <center>
<br> <br>
      <h2>Usted debe resetear su clave </h2>
      <p>Por favor, ingrese una nueva contraseña de mínimo 8 digitos </p>
      <input id="y" type="hidden" value="<?= $data?>"> </input>
      <form class="form-label" id="formReseteo" method="POST" action=" ">
      <div class=" col-sm-2"> 
            <label for=""></label>
            <input  maxlength="45" minlength="8" required  type="password" name="pass1" id="pass1">
        </div>
        <div class=" col-sm-2"> 
            <label for="">Confirme su clave</label>
            <input  maxlength="45" minlength="8" required  type="password" name="pass2" id="pass2">
        </div>
        <button  type="button" onclick="resetear()" class="btn btn-success my-4"  >Registrar </button>
      </form>
    </center>
    <br> <br><br> <br><br> <br><br> <br>
</body>
<footer>
<?php

require_once "../public/view/includes/footer.php";

   ?>
   >
</footer>
</html>