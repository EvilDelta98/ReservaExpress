<?php

namespace controller;

require_once '../model/entities/Prestamo.php';
use model\entities\Prestamo;
require_once '../model/dao/PrestamoDAO.php';
use model\dao\PrestamoDAO;
require_once '../model/dao/Conexion.php';
use model\dao\Conexion;

final class PrestamoController{

    //Mostrar formulario de alta para Prestamo
    //TEMPORAL - REVISAR MÉTODO
    public function showSave($controller, $action, $data){
        require_once("../public/view/prestamo/prestamo_alta.php");
    }

    //Mostrar formulario de baja para Prestamo
    /** 
    public function showDelete($controller, $action, $data){
        $cl = $this->load($controller,$action,$data);
        require_once("../public/view/material/material_eliminar.php");
    }
    */

    //Carga el correspondiente registro de bd y lo devuelve como una entidad.
    public function load($controller, $action, $data){
        $responde = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $responde->{"controller"} = $controller;
        $responde->{"action"} = $action;
        $id = (int)$data;
        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
            $c = $dao -> load($id);
            $response -> {"result"} = $c->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        return $response;
    }

    //Guarda el Prestamo como un nuevo registro en la bd.
    public function save($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        //$data = json_decode($data);
        $data = json_decode(file_get_contents("php://input"));
        //$idp = (int) $data->{"datoPerfilId"};
        $c = new Prestamo();
        $c->setIdSocio($data->{"datoIdSocio"});
        $c->setIdEjemplar($data->{"datoIdEjemplar"});
        $c->setFechaInicio($data->{"datoFechaInicio"});
        $c->setFechaVencimiento($data->{"datoFechaVencimiento"});
        $c->setFechaDevolucion($data->{"datoFechaDevolucion"});
        $c->setObservacion($data->{"datoObservacion"});
        //DEBERÍAN COMENZAR VIGENTES? Y SI SON RESERVA? DEBERÍAMOS USAR DOS MÉTODOS DISTINTOS?
        $c->setEstado(0);
        $c->setTipo($data->{"datoTipo"});

        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
            $dao->save($c);
            $response->{"result"} = $c->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }

    //Devuelve un listado de Prestamos.
    public function list($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
            //Si hay filtros, van en $data
            $dao->list($data);
            $response->{"result"} = $dao->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }

    //Muestra el formulario de actualización para un Prestamo existente
    public function showUpdate($controller, $action, $data){
        $conexion = Conexion::establecer();
        $dao = new PrestamoDAO($conexio);
        $c = $dao->load((int)$data);
        require_once("../public/view/prestamo/prestamo_modificar.php");
    }

    public function resetear($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        $data = json_decode(file_get_contents("php://input"));
        $id = (int) $data->{"datoId"};

        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
            $c = $dao->loadCuenta($id);
            //REVISAR ESTA LÍNEAAAAAAAAAAAAAAAAAAAAAAAAAAAA
            $dao->reseteo($c);
            $response->{"result"} = $c->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
        echo json_encode($response);
    }

    //Replica los datos del objeto, en su correpondiente registro de bd.
    public function update($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $id = (int) $data->{"datoId"};
        
        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
            $c = $dao->load($id);
            $c->setIdSocio($data->{"datoIdSocio"});
            $c->setIdEjemplar($data->{"datoIdEjemplar"});
            $c->setFechaInicio($data->{"datoFechaInicio"});
            $c->setFechaVencimiento($data->{"datoFechaVencimiento"});
            $c->setFechaDevolucion($data->{"datoFechaDevolucion"});
            $c->setObservacion($data->{"datoObservacion"});
            $c->setEstado($data->{"datoEstado"});
            $c->setTipo($data->{"datoTipo"});

            $dao->update($c);
            $response->{"result"} = $c->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
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
        $id = (int)$data;
        try{
            $conexion = Conexion::establecer();
            $dao = new PrestamoDAO($conexion);
            $c = $dao->load($id);
            $dao->delete($id);
            $c->setId(0);
            $response->{"result"} = $c->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
        echo json_encode($response);
    }
}