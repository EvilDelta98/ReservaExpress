<?php

namespace controller;

require_once "../model/entities/Cliente.php";
use model\entities\Cliente;
require_once "../model/dao/ClienteDAO.php";
use model\dao\ClienteDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;

final class ClienteController{
    /**
     * Página principal o de inicio del módulo CLIENTE
     */
    public function index($controller, $action, $data){
        
        require_once("../public/view/cliente/index.php");
       

    }
    /**
     * Mostrar el formulario de Alta para un nuevo CLIENTE
     */
    public function showSave($controller, $action, $data){

        $headTitle="Alta de clientes";
        require_once("../public/view/cliente/cliente_alta.php");
    }
    public function showDelete($controller, $action, $data){
        $cl= $this->load($controller,$action,$data);
       
        require_once("../public/view/cliente/cliente_eliminar.php");

        
      
       
    }
    public function load($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $id=(int ) $data;
        try{
            $conexion = Conexion::establecer();
            $dao = new ClienteDAO($conexion);
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
        
        $cliente = new Cliente();
        $cliente->setApellido($data->{"datoApellido"});
        $cliente->setNombres($data->{"datoNombres"});
        $cliente->setDni($data->{"datoDNI"});
       $cliente->setDomicilio($data->{"datoDomicilio"});
       $cliente->setProvincia($data->{"datoProvincia"});
        $cliente->setLocalidad($data->{"datoLocalidad"});
        $cliente->setCodigoPostal($data->{"datoPostal"});
        $cliente->setTelefono($data->{"datoTelefono"});
        $cliente->setCorreo($data->{"datoCorreo"});
     



        try{
            $conexion = Conexion::establecer();
            $dao = new ClienteDAO($conexion);
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
            $dao = new ClienteDAO($conexion);
            //Por ahora, si hubieran filtros, vendrían en $data
            $response->{"result"} = $dao->list($data);
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
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
$dao = new ClienteDAO($conexion);
$cliente = $dao->load((int)$data);
        require_once("../public/view/cliente/cliente_modificar.php");

    }
    /**
     * Actualiza el cliente
     */
    public function update($controller, $action, $data){

        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $id= (int) $data->{"x"};
  
        try{
           
            $conexion = Conexion::establecer();
            $dao = new ClienteDAO($conexion);
          
            $cliente= $dao->load($id);
           
        

        $cliente->setApellido($data->{"datoApellido"});
        $cliente->setNombres($data->{"datoNombres"});
        $cliente->setDni($data->{"datoDNI"});
        $cliente->setDomicilio($data->{"datoDomicilio"});
        $cliente->setProvincia($data->{"datoProvincia"});
        $cliente->setLocalidad($data->{"datoLocalidad"});
        $cliente->setCodigoPostal($data->{"datoPostal"});
        $cliente->setTelefono($data->{"datoTelefono"});
        $cliente->setCorreo($data->{"datoCorreo"});
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
            $dao = new ClienteDAO($conexion);
          
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


    public function report($controller,$action,$data){
     require_once("../report/clientes.php");
    
    }
}
