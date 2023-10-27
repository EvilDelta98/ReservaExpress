<!DOCTYPE html>
<html lang="en">
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
<center> <h2>Gestión de Perfiles</h2> 
    <br>
    <div id="botones" >

        <button type="button" class="btn btn-primary ms-3" onclick="showSave()">Nuevo Perfil</button>
        <br>
        <br>
    <a href="usuario/admin">Volver atrás </a>

    </div>
    </center>
    <br>

<br> 
   <center><table id= "tablaPerfiles1" style="width: 60%; margin-left: auto; margin-right: auto;" class="table text-dark">
                        <thead>
                        <tr>

                          
                          
                            <th> id</th>                
                   
                           <th >Nombre </th> 
                           <th> Opción </th> 
                        </tr>
                    </thead>
                     <tbody id="tablaUsuarios">
                     
                       
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