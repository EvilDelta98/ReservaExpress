<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/operador/js/operador.js"></script>    
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
            <div class="col-sm-2">
                <label for="">Apellido</label>
                <input minlength="3" maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoApellido" id="datoApellido">
            </div>
            <div  class="col-sm-2">
                <label for="">Nombre</label>
                <input  minlength="3" maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}" type="text" name="datoNombre" id="datoNombre">
            </div>
        
            <div class="col-sm-2">
                <label for="">Correo</label>
                <input minlength="15" maxlength="255" type="text" name="datoCorreo" id="datoCorreo">
            </div>
            <div class="col-sm-2">
                <label for="">Cuenta</label>
                <input minlength="5" maxlength="45" required pattern="[a-zA-ZÀ-ÿ\s]{5,45}"  type="text" name="datoCuenta" id="datoCuenta">
            </div>
            <div class=" col-sm-2"> 
                <!--- ¿ESTE DIV ESTÁ VACÍO? --->
            </div>
            <br>
            <div class="col-sm-2">
                <label for="">PerfilId</label>
                <select id="selPer">
                <option required value="0">Seleccione:</option>
                    <script>
                        //¿NO HAY SCRIPT ACÁ?
                    </script>
                </select>
            </div>
            <br>
            <!--- AGREGAR EL OTRO DATO (TipoUsuario) --->
            <div class="col-sm-2">
                <label for="">Tipo de Cuenta</label>
                <select id="selTipo">
                    <option required>Seleccione:</option>
                    <option value="0">Prueba</option>
                    <option value="1">Operador</option>
                    <option value="2">Administrador</option>
                </select>
            </div>

            <button id="guardarUsuario"  name="guardarUsuario" type="button" onclick="sendNewUser()"class="btn btn-success my-4">Registrar</button>
            <button id="limp" type="button" class="btn btn-success my-4" onclick="limpiar(formAlta)">Limpiar</button>
        </form>
        <a href="public">Volver a la página de inicio</a>
    </center>
</body>
<footer>
    <?php
        require_once "../public/view/includes/footer.php";
    ?>
</footer>
</html>