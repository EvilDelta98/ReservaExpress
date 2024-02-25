<?php

    namespace controller;

    require_once "../model/entities/UsuarioPerfil.php";
    use model\entities\Socio;
    require_once "../model/dao/PerfilDAO.php";
    use model\dao\SocioDAO;
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion;
    use model\dao\PerfilDAO;
    use model\entities\UsuarioPerfil;

    final class PerfilController{

        public function index($controller, $action, $data){
            $headTitle = "Sistema";
            require_once("../public/view/perfil/index.php");
        }

        /**
         * Mostrar el formulario de Alta para un nuevo CLIENTE
         */
        public function showSave($controller, $action, $data){
            $headTitle = "Alta de socios";
            require_once("../public/view/perfil/perfil_alta.php");
        }

        public function showDelete($controller, $action, $data){
            $cl = $this->load($controller,$action,$data);
            require_once("../public/view/perfil/perfil_eliminar.php");
        }

        public function showUpdate($controller, $action, $data){
            $headTitle="Actualización";
            $conexion = Conexion::establecer();
            $dao = new PerfilDAO($conexion);
            $c = $dao->load((int)$data);

            require_once("../public/view/perfil/perfil_modificar.php");
        }

        public function load($controller, $action, $data){
            $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
            $response->{"controller"} = $controller;
            $response->{"action"} = $action;
            $id = (int)$data;
            try{
                $conexion = Conexion::establecer();
                $dao = new PerfilDAO($conexion);
                $c = $dao->load($id);
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
            
            $c = new UsuarioPerfil();
            $c->setNombre($data->{"nombre"});
            try{
                $conexion = Conexion::establecer();
                $dao = new PerfilDAO($conexion);
                $dao->save($c);
                $response->{"result"} = $c->toJson();
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
         * Realiza una búsqueda de SOCIOS en la base de datos
         */
        public function list($controller, $action, $data){
            $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
            $response->{"controller"} = $controller;
            $response->{"action"} = $action;
            try{
                $conexion = Conexion::establecer();
                $dao = new PerfilDAO($conexion);
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

        public function update($controller, $action, $data){
            $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
            $response->{"controller"} = $controller;
            $response->{"action"} = $action;
            $data = json_decode(file_get_contents("php://input"));
            $id = (int) $data->{"id"};
            try{
                $conexion = Conexion::establecer();
                $dao = new PerfilDAO($conexion);
                $c = $dao->load($id);
                $c->setNombre($data->{"nombre"});
                $c->setId($data->{"id"});
                $dao->update($c);
                //Por ahora, si hubieran filtros, vendrían en $data
                $response->{"result"} = $c->toJson();
            }
            catch(\PDOException $ex){
                $response->{"error"} = "Error en base de datos: " . $ex->getMessage();
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
            $id = $data;
            // $id= (int)$data;
            try{
                $conexion = Conexion::establecer();
                $dao = new PerfilDAO($conexion);
                $c = $dao->load($id);
                $dao->delete($id);
                $c->setId(0);
                //Por ahora, si hubieran filtros, vendrían en $data
                $response->{"result"} = $c->toJson();
            }
            catch(\PDOException $ex){
                $response->{"error"} = "Error en base de datosxdxd: " . $ex->getMessage();
            }
            catch(\Exception $ex){
                $response->{"error"} = $ex->getMessage();
            }
            echo json_encode($response);
        }
    }