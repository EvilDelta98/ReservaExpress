<?php

namespace controller;


final class LoginController{
    
   
    public function reseteoClave($controller, $action, $data){
        
        require_once("../public/view/usuario/reseteoClave.php");
       

    }
    public function fueraHorario($controller, $action, $data){
        
        require_once("../public/view/inicio/fueraHorario.php");
       

    }
    
}