<?php
	$controller = '';
	$action = '';
	$data = 0;

	if(isset($_GET["controlador"])){
		$controller = $_GET["controlador"];
	}
	if(isset($_GET["accion"])){
		$action = $_GET["accion"];
	}
	if(isset($_GET["data"])){
		$data = $_GET["data"];
	}
	
	/*** Artefacto antiguo
	header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');
	require_once 'lib/config.php';
	$controlador = "Operador";
	$accion = "login";
	***/

	session_start();

	if (isset($_SESSION["clave_secreta"]) && ($_SESSION["clave_secreta"] == "final2024")){

		/*** Artefacto antiguo - Arrays de controladores y acciones
		//Capturar controlador y acción, si especificada por el usuario.
		$c = filter_input(INPUT_GET,"c",FILTER_SANITIZE_STRING);
		if(!$c) $c = filter_input(INPUT_POST,"c",FILTER_SANITIZE_STRING);
		$a = filter_input(INPUT_GET,"a",FILTER_SANITIZE_STRING);
		if(!$a) $a = filter_input(INPUT_POST,"a",FILTER_SANITIZE_STRING);
		//Validar parámetros válidos.
		if(in_array($c,CONTROLADORES) && in_array($a,ACCIONES)){
			$controlador = $c;
			$accion = $a;
		}
		else{
			$controlador = CONTROLADOR_POR_DEFECTO;
			$accion = ACCION_POR_DEFECTO;
		}
		***/

		//Verificación de horario
		$fechaActual = new DateTime("NOW", new DateTimeZone("America/Argentina/ComodRivadavia"));
		$horaSalida = new DateTime($fechaActual->format("d-m-Y")." ".$_SESSION["horaSalida"], new DateTimeZone("America/Argentina/ComodRivadavia"));
		$horaEntrada = new DateTime($fechaActual->format("d-m-Y")." ".$_SESSION["horaEntrada"], new DateTimeZone("America/Argentina/ComodRivadavia"));
		if(($fechaActual > $horaSalida) || ($fechaActual < $horaEntrada)){
			$controller = "operador";
			$action = 'fueraHorario';
		}
	}

	else{
		if(($controller !== "operador" || $action != "autenticacion") && ($action != "reseteoClave" && $action != "resetear")){
			$controller = 'operador';
			$action = 'login';
			$data = 0;
		}
	}

	/*** Artefacto antiguo - Array de funciones de controladores
    require_once 'controlador/'.ucfirst($controlador).'Controlador.php';
    $controlador = ucfirst($controlador).'Controlador';
	$controlador = new $controlador;
	call_user_func_array(array($controlador, $accion), array());
	***/

	//Copia de controller
	$inputController = $controller;
	//Invocación del controlador
	require_once '../controller/'.ucfirst($controller).'Controller.php';
	//Conversión $controller a objeto. String => Object()
	$controller = "\\controller\\".ucfirst($controller).'Controller';
	$controller = new $controller;
	//Llamada al método correspondiente
	call_user_func_array(
		array($controller, $action),   //Ej: operador->delete()
		array($inputController, $action, $data)  //Ej: operador->delete(action,data)
	);
