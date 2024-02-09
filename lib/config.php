<?php
	const DB_HOST = "localhost";
	const DB_NAME = "reservaexpress";
	const DB_PORT = "3306";
	const DB_USER = "root";
	const DB_PASS = "";
	const DB_ENGINE = "mysql";
	const DB_CHARSET = "UTF8";
	const DB_DSN = DB_ENGINE.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=".DB_CHARSET;
	const NOMBRE_SISTEMA = "ReservaExpress";

	const URL_SERVER = "localhost";

	//Artefactos antiguos - Arrays de controladores y acciones
	//const CONTROLADORES = array("Socio","Inicio","Operador","Administrador");
	//const ACCIONES = array("alta","baja","index","modificacion","consulta","login","logoff","formAlta","formConsulta","modificacionClave","ReservaExpress");

	const CONTROLADOR_POR_DEFECTO = "Inicio";
	const ACCION_POR_DEFECTO = "index";

?>