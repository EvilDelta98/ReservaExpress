<?php

namespace controller;

	final class InicioController{
		public function index($controller, $action, $data){
			//Revisar bien este enlace, creo que va para operador/administrar.php - REVISARRRRRRRRRRRRRRRRRRR
			require_once("../public/view/inicio/administrar.php");

			/*** Artefacto antiguo
			$contenido = 'vista/inicio/index.php';
			require_once 'vista/plantilla.php';
			***/
		}

		public function forbidden($controller, $action, $data){
			require_once("../public/view/operador/forbidden.php");
		}
	}
/// APARENTEMENTE ACÁ TAMPOCO VA EL COSITO DEL FINAL PHP - REVISARRRRRRRRRRRRRRRRRRRRRRRRRRRRRR	