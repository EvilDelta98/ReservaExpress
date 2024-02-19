<!DOCTYPE html>
<html lang="es">
<head>
<?php
       require_once "../public/view/includes/head.php";
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
    
    <center> <h2>Gestión de Usuarios</h2> 
    <br>
    <div id="botones" >

        <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Nuevo Usuario</button>
    </div>
    <br>
    <a href="usuario/admin">Volver atrás </a>
    </center>
    <br>
    

    <table id= "tablaUsuarios1" style="width: 40%; margin-left: auto; margin-right: auto;" class="table text-dark">
                        <thead>
                        <tr>

                          
                          
                            <th> #</th>                
                           <th>Apellido </th> 
                           <th>Nombre </th> 
                           <th>Correo</th> 
                           <th>Cuenta</th> 
               
                           <th>Perfil Id</th> 
                           <th>Estado</th> 
                           <th>HoraEntrada</th> 
                           <th>Hora Salida</th> 
                           <th>fecha Alta</th> 
                           <th>Reseteo Clave</th> 
                           <th >Opción</th> 
                        </tr>
                    </thead>
                     <tbody id="tablaUsuarios">
                     
                       
                   </tbody>
                     
                
                
                
                
                
                    </table>
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