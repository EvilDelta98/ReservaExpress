<?php
require_once "../model/entities/UsuarioPerfil.php";
use model\entities\UsuarioPerfil as Perfil; //barra al reves

$administrador=["id" =>1, "nombre" =>"Administrador"];
$operador= json_decode(('{"id":2,"nombre":"Operador'));
$perfil= new Perfil(["id" => 1 ,"nombre" => "Administrador"]);



echo '<p>';
echo password_hash("joserasjido",PASSWORD_DEFAULT);
//cuandohagamos setclave pnemos lo de arriba  cuando el cliente se loguee verificamos que la clave que tenga en la bd corresponda con la que ingresa el usuario
echo '</p>';
$usuario="jrasjido";
$claveFront= "joserasjido";
// buscar en la bd el usuario jrasjido
//traer de la bd el hash de ese usuario jrasjido ($clave) que esta en la variable clave

print_r(password_verify($claveFront,$clave));

