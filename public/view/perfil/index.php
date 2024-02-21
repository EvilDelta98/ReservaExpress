<!DOCTYPE html>
<html lang="es">
<head>
    <?php
       require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/perfil/js/perfil.js"></script>    
</head>
<header>
    <?php
       require_once "../public/view/includes/header.php";
    ?>
</header>
<body>
    <center> 
        <h2>Gestión de Perfiles</h2> 
        <br>
        <div id="botones">
            <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Nuevo Perfil</button>
            <br>
            <br>
            <!--- REVISARRRRRRRR ENLACEEEE --->
            <a href="operador/admin">Volver atrás </a>
        </div>
    </center>
    <br>
    <br> 
    <center>
        <table id= "tablaPerfiles1" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">
            <thead>
                <tr>  
                    <th>Id</th>                
                    <th>Nombre</th> 
                    <th>Opción</th> 
                </tr>
            </thead>
            <tbody id="tablaUsuarios">
                <!--- POSIBLE IMPLEMENTACIÓN DEFAULT?
                <tr>
                    <td colspan="12">No hay usuarios registrados</td>
                </tr>      
                --->
            </tbody>
        </table>
    </center>
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