<?php

//phpinfo();
//die();

require_once("../model/entities/Cliente.php");
use \model\entities\Cliente;

$cliente = new Cliente();
$cliente->setApellido("Rasjido");

$fechaActual = new DateTime("NOW", new DateTimeZone("America/Argentina/ComodRivadavia"));
$cliente->setFechaAlta($fechaActual->format("d-m-Y"));

print_r($cliente->toJson());
