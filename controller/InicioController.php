<?php

namespace controller;


final class InicioController{
    public function index($controller, $action, $data){
        
        require_once("../public/view/inicio/Administrar.php");
       

    }
    public function fordiben($controller, $action, $data){
        
        require_once("../public/view/usuario/fordiben.php");
       

    }
    
   
   
}