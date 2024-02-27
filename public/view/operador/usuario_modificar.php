<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once "../public/view/includes/head.php";
        if($c->getPerfilId()=="0"){
            $perf= "Prueba";
        }
        if($c->getPerfilId()=="1"){
            $perf= "Operador";
        }
        if($c->getPerfilId()=="2"){
            $perf= "Administrador";
        }
        if($c->getEstado()=="1"){
            $estado= "Activo";
        }
        if($c->getEstado()=="0"){
            $estado= "Inactivo";
        }
    ?>
    <script defer type="text/javascript" src="view/operador/js/operador.js"></script>    
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
        <form class="form-label" id="formModificarU" name="formModificarU" method="POST" action="operador/update">
        <div class="col-sm-2">
            <label for="">Apellido</label>
            <input value="<?= $c->getApellido() ?>" maxlength="255" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoApellido" id="datoApellido">
        </div>
        <div class="col-sm-2">
            <label for="">Nombre</label>
            <input value="<?= $c->getNombre() ?>" minlength="3" maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoNombre" id="datoNombre">
        </div>
        <div class=" col-sm-2">
            <label for="">Correo</label>
            <input value="<?= $c->getCorreo() ?>" maxlength="255" minlength="15" required type="text" name="datoCorreo" id="datoCorreo">
        </div>
        <div class=" col-sm-2">
            <label for="">Cuenta</label>
            <input value="<?= $c->getCuenta() ?>" maxlength="45" minlength="5" required type="text" name="datoCuenta" id="datoCuenta">
        </div>
        <div class=" col-sm-2">
            <label for="">PerfilId</label>
            <br>
            <select id="selPer">
            <script>
                //¿NO HAY SCRIPT ACÁ?
            </script>
            </select>
        </div>
        <!---
        <div class=" col-sm-2">
            <label for="">Reseteo Clave</label>
            <br>
            <select name="datoReseteoClave" id="datoReseteoClave" required>
            <?php
            /***
                if($c->getReseteoClave() == 0){
                echo'<option>Seleccionar</option>';
                echo'<  option selected value="no">No</option>';
                echo'<  option value="si">Si</option>';
                }
                else{
                echo'<option>Seleccionar</option>';
                echo'<  option value="no">No</option>';
                echo'<  option selected value="si">Si</option>';
                }
            */
            ?>
            </select>
        </div>
        --->
        <div class="col-sm-2">
            <label for="">Estado</label>
            <br>
            <select name="datoEstado" id="datoEstado" required>
            <?php
                if($c->getEstado()==1){
                    echo'<option>Seleccionar</option>';
                    echo'  <option  selected value="1" > Activo </option>';
                    echo'  <option  value="0" > Inactivo </option>';
                }
                else{
                    echo'<option>Seleccionar</option>';
                    echo'  <option value="1">Activo</option>';
                    echo'  <option selected value="0">Inactivo</option>';
                }
            ?>
            </select>
        </div>

        <input value="<?= $data ?>" type="hidden" name="x" id="x">
        <button id="guardarUsuario"  name="guardarUsuario" type="button" onclick="actualizar(<?= $data ?>)"class="btn btn-success my-4">Registrar</button>
        <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)">Limpiar</button>
        </form>
        <!--- REVISAR ESTE ENLACEEEEEEEEEE --->
        <a href="operador/index">Volver a la página de inicio</a>
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