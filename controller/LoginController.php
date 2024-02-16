<?php

namespace controller;

    final class LoginController{
        public function reseteoClave($controller, $action, $data){
            require_once("../public/view/operador/reseteoClave.php");
        }

        public function fueraHorario($controller, $action, $data){
            require_once("../public/view/inicio/fueraHorario.php");
        }
    
    }
/// APARENTEMENTE ACÁ TAMPOCO VA EL COSITO DEL FINAL PHP - REVISARRRRRRRRRRRRRRRRRRRRRRRRRRRRRR	