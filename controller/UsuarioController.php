<?php

namespace controller;

require_once "../model/entities/Usuario.php";
use model\entities\Usuario;
require_once "../model/dao/UsuarioDAO.php";
use model\dao\UsuarioDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;

final class UsuarioController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
    public function index($controller, $action, $data){
        $headTitle="Sistema";
        require_once("../public/view/usuario/index.php");
       

    }
    public function fordiben($controller, $action, $data){
        $headTitle="Sistema";
        require_once("../public/view/usuario/fordiben.php");
       

    }
    public function admin($controller, $action, $data){
        $headTitle="Sistema";
        
        require_once("../public/view/usuario/Administrar.php");
       

    }
    public function reseteoClave($controller, $action, $data){
        $headTitle="Sistema";
        require_once("../public/view/usuario/reseteoClave.php");
       

    }

    public function mostrarPerfiles($controller,$action,$data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        
        try{
            $conexion = Conexion::establecer();
            $dao = new UsuarioDAO($conexion);
            $dao->listarPerfiles($controller);
          //  $response->{"result"} = $dao->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
        
        echo json_encode($response);
    }
    /**
     * Mostrar el formulario de Alta para un nuevo CLIENTE
     */
    public function showSave($controller, $action, $data){

        
        require_once("../public/view/usuario/usuario_alta.php");
    }
    public function showDelete($controller, $action, $data){
        $cl= $this->load($controller,$action,$data);
       
        require_once("../public/view/usuario/usuario_eliminar.php");

        
      
       
    }
    public function load($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $id=(int ) $data;
        try{
            $conexion = Conexion::establecer();
            $dao = new UsuarioDAO($conexion);
            $c= $dao->load($id);
            $response->{"result"} = $c->toJson();
            
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

     //echo json_encode($response);

     return $response;
    
    }


    
    public function save($controller, $action, $data){
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        $data = json_decode(file_get_contents("php://input"));
       $idp= (int)  $data->{"datoPerfilId"};
      $hash= password_hash($data->{"datoClave"},PASSWORD_DEFAULT);
        $cliente = new Usuario();
        $cliente->setApellido($data->{"datoApellido"});
        $cliente->setNombre($data->{"datoNombre"});
        $cliente->setCorreo($data->{"datoCorreo"});
       $cliente->setCuenta($data->{"datoCuenta"});
      
       $cliente->setClave($hash);
       $cliente->setPerfilId($idp);
        
        $cliente->setEstado(1);
        $cliente->setHoraEntrada($data->{"datoHoraEntrada"});
        $cliente->setHoraSalida($data->{"datoHoraSalida"});
      
        $cliente->setReseteoClave(1);
      

     

        try{
            $conexion = Conexion::establecer();
            $dao = new UsuarioDAO($conexion);
            $dao->save($cliente);
            $response->{"result"} = $cliente->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
        
        echo json_encode($response);
    }
    /**
     * Realiza una búsqueda de CLIENTES en la base de datos
     */
    public function list($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new UsuarioDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->list($data);
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosssss: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }
    /**
     * Muestra el formulario de Actualización para un cliente existente
     */
    public function showUpdate($controller, $action, $data){
     
        $conexion = Conexion::establecer();
$dao = new UsuarioDAO($conexion);
$cliente = $dao->load((int)$data);
        require_once("../public/view/usuario/usuario_modificar.php");

    }
    /**
     * Actualiza el cliente
     */
    public function resetear($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
       $data = json_decode(file_get_contents("php://input"));

$clave= $data->{"datoClave"};
$id=$data->{"datoCuenta"};
        try{
           
            $conexion = Conexion::establecer();
            $dao = new UsuarioDAO($conexion);
           $cliente= $dao->loadCuenta($id);
           $pass= password_hash($clave,PASSWORD_DEFAULT);
           $cliente->setClave($pass);
            $dao->reseteo($cliente);
            
            //Por ahora, si hubieran filtros, vendrían en $data
            $cliente->setReseteoClave(0);
            $response->{"result"} = $cliente->toJson();
            
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosxdxd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
      

    }
    public function update($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $id= (int) $data->{"x"};
  
        try{
           
            $conexion = Conexion::establecer();
            $dao = new UsuarioDAO($conexion);
          
            $cliente= $dao->load($id);
           
            $cliente->setApellido($data->{"datoApellido"});
            $cliente->setNombre($data->{"datoNombre"});
            $cliente->setCorreo($data->{"datoCorreo"});
           $cliente->setCuenta($data->{"datoCuenta"});
           $cliente->setEstado($data->{"datoEstado"});
          
           
             $cliente->setPerfilId((int)$data->{"datoPerfilId"});
           
           
            $cliente->setHoraEntrada($data->{"datoHoraEntrada"});
            $cliente->setHoraSalida($data->{"datoHoraSalida"});
         
 $dao->update($cliente);
            
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $cliente->toJson();

        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datosxdxd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }


        echo json_encode($response);
    












        

          
    }
    public function delete($controller, $action, $data){
   

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $id=(int ) $data;
        try{
           
            $conexion = Conexion::establecer();
            $dao = new UsuarioDAO($conexion);
          
            $cliente= $dao->load($id);
    
            $dao->delete($id);
            $cliente->setId(0);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $cliente->toJson();
            
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }

    public function login($controller,$action,$data){
        require_once("../public/view/usuario/login.php");
    }
    

public function autentication($controller,$action,$data){
    
      //require_once("../public/view/usuario/login.php");
      $response = json_decode('{"controller":"", "action":"","error":"","perfil":""}');
      $response->{"controller"} = $controller;
      $response->{"action"} = $action;
      $data = json_decode(file_get_contents("php://input"));
    $cuenta= $data->{"datoCuenta"};
    $clave= $data->{"datoClave"};
      try{
          $conexion = Conexion::establecer();
          UsuarioDAO::login($conexion, $cuenta, $clave);
          $response->{"perfil"} = $_SESSION["perfil"];
         
          //redireccionar a inicio/index
      }
      catch(\PDOException $ex){
          $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
      }
      catch(\Exception $ex){
          $response->{"error"} = $ex->getMessage();
      }
     
      echo json_encode($response);
  
}

public function logout($controller,$action,$data){
    //destruir la info de estado
session_unset(); //destruye todas las vairables 
session_destroy();
    //destruir l asesion
   //require_once(../public/view/..logout;REFRESH:5); ARREGLAR LLEVAR AL LOGOUT

   require_once("../public/view/usuario/logout.php");
   header("refresh:6;url=http://localhost/entregable_02/public/");
}
public function fueraHorario($controller,$action,$data){
    session_unset(); //destruye todas las vairables 
    session_destroy();
    require_once("../public/view/usuario/fueraHorario.php");
    header("refresh:6;url=http://localhost/entregable_02/public/cliente/index");

    }
}