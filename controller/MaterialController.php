<?php

namespace controller;

require_once '../model/entities/Material.php';
use model\entities\Material;
require_once '../model/dao/MaterialDAO.php';
use model\dao\MaterialDAO;
require_once '../model/dao/Conexion.php';
use model\dao\Conexion;

final class MaterialController{

    //Mostrar formulario de alta para Material
    public function showSave($controller, $action, $data){
        require_once("../public/view/material/material_alta.php");
    }

    //Mostrar formulario de baja para Material
    public function showDelete($controller, $action, $data){
        $cl = $this->load($controller,$action,$data);
        require_once("../public/view/material/material_eliminar.php");
    }

    //Carga el correspondiente registro de bd y lo devuelve como una entidad.
    public function load($controller, $action, $data){
        $responde = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $responde->{"controller"} = $controller;
        $responde->{"action"} = $action;
        $id = (int)$data;
        try{
            $conexion = Conexion::establecer();
            $dao = new MaterialDAO($conexion);
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

    //Guarda el socio como un nuevo registro en la bd.
    public function save($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        //$data = json_decode($data);
        $data = json_decode(file_get_contents("php://input"));
        //$idp = (int) $data->{"datoPerfilId"};
        $c = new Material();
        $c->setISBN($data->{"datoISBN"});
        $c->setTitulo($data->{"datoTitulo"});
        $c->setAutor($data->{"datoAutor"});
        $c->setEdicion($data->{"datoEdicion"});
        $c->setEditorial($data->{"datoEditorial"});
        $c->setDisciplina($data->{"datoDisciplina"});
        $c->setCantEjemplares($data->{"datoCantEjemplares"});
        $c->setEstado(0);

        try{
            $conexion = Conexion::establecer();
            $dao = new MaterialDAO($conexion);
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

    //Devuelve un listado de Material.
    public function list($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        try{
            $conexion = Conexion::establecer();
            $dao = new MaterialDAO($conexion);
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

    //Muestra el formulario de actualización para un Material existente
    public function showUpdate($controller, $action, $data){
        $conexion = Conexion::establecer();
        $dao = new MaterialDAO($conexio);
        $c = $dao->load((int)$data);
        require_once("../public/view/material/material_modificar.php");
    }

    public function resetear($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        $data = json_decode(file_get_contents("php://input"));
        $id = (int) $data->{"datoId"};

        try{
            $conexion = Conexion::establecer();
            $dao = new MaterialDAO($conexion);
            $c = $dao->loadCuenta($id);
            $c->setClave($hash);
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
            $dao = new MaterialDAO($conexion);
            $c = $dao->load($id);
            $c->setISBN($data->{"datoISBN"});
            $c->setTitulo($data->{"datoTitulo"});
            $c->setAutor($data->{"datoAutor"});
            $c->setEdicion($data->{"datoEdicion"});
            $c->setEditorial($data->{"datoEditorial"});
            $c->setDisciplina($data->{"datoDisciplina"});
            $c->setCantEjemplares($data->{"datoCantEjemplares"});
            $c->setEstado(0);

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
            $dao = new MaterialDAO($conexion);
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