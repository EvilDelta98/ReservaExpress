<!DOCTYPE html>
<html lang="en">
<head>
   <?php
  require_once "../public/view/includes/head.php";

  if($cliente->getPerfilId()=="1"){
    $perf= "Administrador";
  }
  
  if($cliente->getPerfilId()=="3"){
    $perf= "Operador";
  }
  
  if($cliente->getEstado()=="1"){
    $estado= "Activo";
  }
  if($cliente->getEstado()=="0"){
    $estado= "Inactivo";
  }
  if($cliente->getReseteoClave()=="1"){
    $estado= "Si";
  }
  if($cliente->getReseteoClave()=="0"){
    $estado= "No";
  }
   ?>
    <script defer type="text/javascript" src="view/usuario/js/usuario1.js"></script>    
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
    <form class="form-label" id="formModificarU" name="formModificarU" method="POST" action="usuario/update">
     
    
      
         <div   class=" col-sm-2">
            <label for="">Apellido</label>
            <input  value="<?= $cliente->getApellido() ?>"  maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoApellido" id="datoApellido">
        </div>

        <div  class=" col-sm-2">
            <label for="">Nombre</label>
            <input   value="<?= $cliente->getNombre() ?>" minlength="3" maxlength="45" required  required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoNombre" id="datoNombre">
        </div>
    
        <div class=" col-sm-2">
            <label for="">Correo


            </label>
            <input  value="<?= $cliente->getCorreo() ?>" maxlength="255" minlength="15" required  type="text" name="datoCorreo" id="datoCorreo">
        </div>
   
        <div class=" col-sm-2">
            <label for="">Cuenta</label>
            <input value="<?= $cliente->getCuenta() ?>"  maxlength="45" minlength="5" required   type="text" name="datoCuenta" id="datoCuenta">
        </div>
      
        
        <div class=" col-sm-2">
            <label for="">PerfilId</label>
           <br>
          <select  id="selPer">
         

           <script>
                 

            </script>
        </select>
        </div>
     
        <div class=" col-sm-2">
            <label for="">Hora de  Entrada</label>
            <br>
            <input  value="<?= $cliente->getHoraEntrada() ?>" required   type="time" name="datoHoraEntrada" id="datoHoraEntrada">
        </div>
        
        <div class=" col-sm-2">
            <label for="">Hora de Salida</label>
            <br>
            <input  value="<?= $cliente->getHoraSalida() ?>" required   type="time" name="datoHoraSalida" id="datoHoraSalida">
        </div>
        
        <div class=" col-sm-2">
            <label for="">Reseteo Clave</label>
            <br>
            <select name="datoReseteoClave" id="datoReseteoClave" required>
            <?php
              if($cliente->getReseteoClave()==0){
                echo '<option  > Seleccionar</option>';
                echo'<option  selected value="no" > No </option>';
                echo'<option  value="si" > Si </option>';
              }
              else{
                echo '<option  > Seleccionar</option>';
                echo'<option   value="no" > No </option>';
                echo'<option   selected value="si" > Si </option>';
              }
              
           
              

            ?>
               

</select>
        </div>
      
        <div class=" col-sm-2">
            <label for="">Estado</label>
            <br>
            <select name="datoEstado" id="datoEstado" required>
                <?php
                if($cliente->getEstado()==1){
                    echo '<option  > Seleccionar</option>';
                  echo'  <option  selected value="1" > Activo </option>';
                  echo'  <option  value="0" > Inactivo </option>';
                }
                else{
                    echo '<option  > Seleccionar</option>';
                    echo'  <option   value="1" > Activo </option>';
                  echo'  <option  selected value="0" > Inactivo </option>';
                }
                ?>
              

</select>
        </div>
   
        <input    value="<?= $data ?>" type="hidden" name="x" id="x">
       
        <button id="guardarUsuario"  name="guardarUsuario" type="button" onclick="actualizar(<?= $data ?>)"class="btn btn-success my-4"  >Registrar </button>
        <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)" >Limpiar</button>
    </form>
    <a href="usuario/index">Volver a la página de inicio</a>
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