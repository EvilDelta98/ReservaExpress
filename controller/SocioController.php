<?php

namespace controller;

require_once "../model/entities/Socio.php";
use model\entities\Socio;
require_once "../model/dao/SocioDAO.php";
use model\dao\SocioDAO;
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;

final class SocioController{
    //Página principal del módulo SOCIO
    public function index($controller, $action, $data){
        require_once "../public/view/socio/index.php";
    }

    //Mostrar formulario de Alta para un nuevo SOCIO
    public function showSave($controller, $action, $data){
        $headTitle="Alta de socios";
        require_once("../public/view/socio/socio_alta.php");
    }

    //Mostrar formulario de Baja de un SOCIO
    public function showDelete($controller, $action, $data){
        $cl= $this->load($controller,$action,$data);
        //¿ES NECESARIA ESTA LÍNEAAAAAAAAAAAAAAAAAAAAAAA???
        $headTitle="Baja de socios";
        require_once("../public/view/socio/socio_eliminar.php");
    }

    public function load($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $id = (int)$data;
        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            $c = $dao->load($id);
            $response->{"result"} = $c->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
        return $response;
    }

    public function save($controller, $action, $data){
        $response = json_decode('{"result":{},"controller":"", "action":"","error":""}');
        $response->{'controller'} = $controller;
        $response->{'action'} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $c = new Socio();
        $c->setNombre($data->{"datoNombre"});
        $c->setApellido($data->{"datoApellido"});
        $c->setCuenta($data->{"datoCuenta"});

        $c->setTipoSocio($data->{"datoTipoSocio"});
        //Si es profesor iría id materia, si es alumno iría id carrera.
        $c->setDatoSocio($data->{"datoDatoSocio"});

        $c->setProvincia($data->{"datoProvincia"});
        $c->setLocalidad($data->{"datoLocalidad"});
        $c->setDomicilio($data->{"datoDomicilio"});
        $c->setEstado(1);
        $c->setDNI($data->{"datoDNI"});
        $c->setTelefono($data->{"datoTelefono"});
        $c->setEmail($data->{"datoEmail"});

        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
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

    //Búsqueda de SOCIOS en la bd.
    public function list($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            //Los filtros van en $data
            $response->{"result"} = $dao->list($data);
        }
        catch(\PDOException $ex){
            $response->{"error"} = "Error en la bd: " . $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }
        echo json_encode($response);
    }

    //Muestra el formulario de Actualización para un SOCIO existente.
    public function showUpdate($controller, $action, $data){
        $conexion = new Conexion();
        $dao = new SocioDAO($conexion);
        $c = $dao->load((int)$data);
        $headTitle="Modificación de socios";
        require_once("../public/view/socio/socio_modificar.php");
    }

    //Actualiza el Socio.
    public function update($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));

        $id = (int)$data->{"datoPerfilId"};

        try{
            $conexion = Conexion::establecer();
            $dao = new SocioDAO($conexion);
            $c = $dao->load($id);

            $c->setNombre($data->{"datoNombre"});
            $c->setApellido($data->{"datoApellido"});
            $c->setCuenta($data->{"datoCuenta"});
    
            $c->setTipoSocio($data->{"datoTipoSocio"});
            //Si es profesor iría id materia, si es alumno iría id carrera.
            $c->setDatoSocio($data->{"datoDatoSocio"});
    
            $c->setProvincia($data->{"datoProvincia"});
            $c->setLocalidad($data->{"datoLocalidad"});
            $c->setDomicilio($data->{"datoDomicilio"});
            $c->setEstado(1);
            $c->setDNI($data->{"datoDNI"});
            $c->setTelefono($data->{"datoTelefono"});
            $c->setEmail($data->{"datoEmail"});

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
            $dao = new ClienteDAO($conexion);
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

    public function report($controller, $action, $data){
        require_once("../report/socios.php");
    }
}