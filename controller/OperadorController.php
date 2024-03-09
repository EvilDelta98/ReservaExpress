<?php

namespace controller;

require_once "../model/entities/Operador.php";
use model\dao\OperadorDAO;
use model\entities\Operador;
require_once "../model/dao/OperadorDAO.php";
require_once "../model/dao/Conexion.php";
use model\dao\Conexion;

final class OperadorController{

    public function index($controller, $action, $data){
       // $headTitle="Indice";
        require_once('../public/view/operador/index.php');
    }
    public function prueba($controller, $action, $data){
        echo("HOLAAA");
    }
    public function forbidden($controller, $action, $data){
        $headTitle="Prohibido";
        require_once('../public/view/operador/forbidden.php');
    }

    public function admin($controller, $action, $data){
        $headTitle="Administrar";
        require_once('../public/view/operador/administrar.php');
    }

    public function reseteoClave($controller, $action, $data){
        $headTitle="Reseteo de clave";
        require_once('../public/view/operador/reseteoClave.php');
    }

    public function mostrarPerfiles($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        try{
            $conexion = Conexion::establecer();
            $dao = new OperadorDAO($conexion);
            $dao->listarPerfiles($controller);
            //$response->{"result"} = $dao->toJson();
        }
        catch(\PDOException $ex){
            $response->{"error"} = $ex->getMessage();
        }
        catch(\Exception $ex){
            $response->{"error"} = $ex->getMessage();
        }

        echo json_encode($response);
    }

    //Mostrar formulario de alta para Socio
    public function showSave($controller, $action, $data){
        require_once("../public/view/operador/operador_alta.php");
    }

    //Mostrar formulario de baja para Socio
    public function showDelete($controller, $action, $data){
        $cl = $this->load($controller,$action,$data);
        require_once("../public/view/operador/operador_eliminar.php");
    }

    //Carga el correspondiente registro de bd y lo devuelve como una entidad.
    public function load($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $id = (int)$data;
        try{
            $conexion = Conexion::establecer();
            $dao = new OperadorDAO($conexion);
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
        $idp = (int) $data->{"datoPerfilId"};
        $hash= password_hash($data->{"datoClave"},PASSWORD_DEFAULT);
        $c = new Operador();
        $c->setNombre($data->{"datoNombre"});
        $c->setApellido($data->{"datoApellido"});
        $c->setCorreo($data->{"datoCorreo"});
        $c->setCuenta($data->{"datoCuenta"});
        $c->setClave($hash);
        //$c->setPerfilId($idp); VER QUE ONDA ESTO
        $c->setTipoUsuario($data->{"datoTipoUsuario"});
        $c->setEstado(1);

      //  $c->setHoraEntrada($data->{"datoHoraEntrada"});
        //$c->setHoraSalida($data->{"datoHoraSalida"});

        $c->setReseteoClave(1);
        try{
            $conexion = Conexion::establecer();
            $dao = new OperadorDAO($conexion);
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

    //Devuelve un listado de socios.
   
    public function list($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
      
        try{
            $conexion = Conexion::establecer();
            $dao = new OperadorDAO($conexion);
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

    //Muestra el formulario de actualización para un socio existente
    public function showUpdate($controller, $action, $data){
        $conexion = Conexion::establecer();
        $dao = new OperadorDAO($conexion);
        $c = $dao->load((int)$data);
        require_once("../public/view/operador/operador_modificar.php");
    }

    public function resetear($controller, $action, $data){
        $response = json_decode('{"result":[],"controller":"", "action":"","error":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;

        $data = json_decode(file_get_contents("php://input"));
        $id = (int) $data->{"datoCuenta"};
        $hash = password_hash($data->{"datoClave"}, PASSWORD_DEFAULT);

        try{
            $conexion = Conexion::establecer();
            $dao = new OperadorDAO($conexion);
            $c = $dao->loadCuenta($id);
            $c->setClave($hash);
            //REVISAR ESTA LÍNEAAAAAAAAAAAAAAAAAAAAAAAAAAAA
            $dao->reseteo($c);
            $c->setReseteoClave(0);
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

        $idp = (int) $data->{"datoPerfilId"};
        
        try{
            $conexion = Conexion::establecer();
            $dao = new OperadorDAO($conexion);
            $c = $dao->load($id);

            $c->setNombre($data->{"datoNombre"});
            $c->setApellido($data->{"datoApellido"});
            $c->setCorreo($data->{"datoCorreo"});
            $c->setCuenta($data->{"datoCuenta"});
            $c->setTipoUsuario($data->{"datoTipoUsuario"});
            $c->setEstado($data->{"datoEstado"});

            $c->setPerfilId((int)$data->{"datoPerfilId"});

            $c->setHoraEntrada($data->{"datoHoraEntrada"});
            $c->setHoraSalida($data->{"datoHoraSalida"});

            //Actualizar reseteoClave?
            $c->setReseteoClave($data->{"datoReseteoClave"});

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
            $dao = new OperadorDAO($conexion);
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

    public function login($controller, $action, $data){
        require_once("../public/view/operador/login.php");
    }

    public function au($controller, $action, $data){
    
      //require_once("../public/view/usuario/login.php");
      $response = json_decode('{"controller":"", "action":"","error":"","perfil":""}');
      $response->{"controller"} = $controller;
      $response->{"action"} = $action;
      $data = json_decode(file_get_contents("php://input"));
     
    $cuenta= $data->{"datoCuenta"};
    $clave= $data->{"datoClave"};
    
      try{
          $conexion = Conexion::establecer();
          OperadorDAO::login($conexion, $cuenta, $clave);
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

    public function logout($controller, $action, $data){
        //Terminar la info de estado
        session_unset(); //Destruye las variables
        session_destroy(); //Destruye la sesión
        require_once("../public/view/operador/logout.php");
        header("refresh:6;url=http://localhost/PruebaNuevaHibrido/public/");
    }

    public function fueraHorario($controller, $action, $data){
        //Terminar la info de estado
        session_unset(); //Destruye las variables
        session_destroy(); //Destruye la sesión
        require_once("../public/view/operador/fueraHorario.php");
        header("refresh:6;url=http://localhost/PruebaNuevaHibrido/public/socio/index");
    }
    public function autentication1($controller,$action,$data){
    
        //require_once("../public/view/usuario/login.php");
        $response = json_decode('{"controller":"", "action":"","error":"","perfil":""}');
        $response->{"controller"} = $controller;
        $response->{"action"} = $action;
        $data = json_decode(file_get_contents("php://input"));
      $cuenta= $data->{"datoCuenta"};
      $clave= $data->{"datoClave"};
        try{
            $conexion = Conexion::establecer();
            OperadorDAO::login($conexion, $cuenta, $clave);
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
}
    //MÉTODOS VIEJOSSSSSSSSSSSSSSSSSSSSSSSSS
    /* 
    public function alta(){
        $respuesta = json_decode('{"accion":"alta", "error":"", "data":{}}');
        $data = json_decode(filter_input(INPUT_POST,"data"));
        $conexion = null;
        try{
            $conexion = Conexion::establecer();

            $operador = new Operador();
            $operador->setNombre($data->{"nombre"});
            $operador->setApellido($data->{"apellido"});
            $operador->setCorreo($data->{"correo"});
            $operador->setCuenta($data->{"cuenta"});
            $operador->setClave($data->{"clave"});
            $operador->setTipoUsuario($data->{"tipoUsuario"});
            $operador->setEstado($data->{"estado"});

            $modelo = new OperadorDAO($conexion);
            $modelo->guardar($operador);

            $respuesta->{"data"} = $operador->toJSON();
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();	
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }

    public function baja(){
        $respuesta = json_decode('{"accion":"baja", "error":"", "data":{}}');
        $data = json_decode(filter_input(INPUT_POST,"data"));

        $conexion = null;
        try{
            $conexion = Conexion::establecer();
            $modelo = new OperadorDAO($conexion);

            $operador = $modelo->cargar($data->{"id"});
            $modelo->eliminar($operador);

            $respuesta->{"data"} = $operador->toJSON();
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();	
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }

    public function modificacion(){
        $respuesta = json_decode('{"accion":"modificacion", "error":"", "data":{}}');
        $data = json_decode(filter_input(INPUT_POST,"data"));

        $conexion = null;
        try{
            $conexion = Conexion::establecer();
            $modelo = new OperadorDAO($conexion);

            $operador = $modelo->cargar($data->{"id"});

            $operador->setNombre($data->{"nombre"});
            $operador->setApellido($data->{"apellido"});
            $operador->setCorreo($data->{"correo"});
            $operador->setCuenta($data->{"cuenta"});
            $operador->setEstado($data->{"estado"});

            $modelo->actualizar($operador);

            $respuesta->{"data"} = $operador->toJSON();
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }

    //REVISAAAAAAAAAARRRRRRRRRRRRRRRRR
    /*
    public function bajaMaterial(){
        $respuesta = json_decode('{"accion":"bajaMaterial", "error":"", "data":{}}');
        $data = json_decode(filter_input(INPUT_POST,"data"));

        $conexion = null;
        try{
            $conexion = Conexion::establecer();
            $modelo = new UsuarioDAO($conexion);

            $usuario = $modelo->cargar($data->{"id"});
            $modelo->eliminar($usuario);

            $respuesta->{"data"} = $usuario->toJSON();
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();	
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }


    public function modificacionClave(){
        $respuesta = json_decode('{"accion":"modificacionClave", "error":"", "data":{}}');
        $data = json_decode(filter_input(INPUT_POST,"data"));
        //$data={id,claveActual,claveNueva});
        $conexion = null;
        try{
            $conexion = Conexion::establecer();
            $modelo = new OperadorDAO($conexion);

            $operador = $modelo->cargar($data->{"id"});
            if($operador->getClave() === $data->{"claveActual"}){
                $operador->setClave($data->{"claveNueva"});
                $modelo->actualizarClave($operador);
                $respuesta->{"data"} = $operador->toJSON();
            }
            else{
                $respuesta->{"error"} = "La contraseña actual es incorrecta";
            }
            
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();	
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }
    
    public function consulta(){
        $respuesta = json_decode('{"accion":"consulta", "error":"", "data":{}}');
        $data = json_decode(filter_input(INPUT_POST,"data"));

        $conexion = null;
        try{
            $conexion = Conexion::establecer();
            $modelo = new OperadorDAO($conexion);
            $operador = $modelo->cargar($data->{"id"});
            $respuesta->{"data"} = $operador->toJSON();
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();	
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }

    public function listar(){
        $respuesta = json_decode('{"accion":"listar", "error":"", "data":{}, "registrosAfectados":0}');
        $data = json_decode(filter_input(INPUT_POST,"data"));

        $conexion = null;
        try{
            $conexion = Conexion::establecer();
            $modelo = new OperadorDAO($conexion);
            $respuesta->{"data"} = $modelo->listar($data);

            $respuesta->{"registrosAfectados"} = $modelo->getRegistrosAfectados();
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();	
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }
    //REVISAAAAAAAARRRRRRRRRRRRRRRRRRR
    /*
    public function listarMaterial(){
        $respuesta = json_decode('{"accion":"listarMaterial", "error":"", "data":{}, "registrosAfectados":0}');
        $data = json_decode(filter_input(INPUT_POST,"data"));

        $conexion = null;
        try{
            $conexion = Conexion::establecer();
            $modelo = new UsuarioDAO($conexion);
            $respuesta->{"data"} = $modelo->listarMaterial($data);

            $respuesta->{"registrosAfectados"} = $modelo->getRegistrosAfectados();
            $conexion = null;
        }
        catch(PDOException $ex){
            $respuesta->{"error"} = $ex->getMessage();
            if($conexion != null) $conexion = null;
        }
        catch(Exception $ex){
            $respuesta->{"error"} = $ex->getMessage();	
            if($conexion != null) $conexion = null;
        }

        echo json_encode($respuesta);
    }


    public function index(){
        $contenido = "vista/operador/index.php";
        $scripts = [];
        $scripts[] = '<script defer type="text/javascript" src="vista/operador/script.js"></script>';
        $scripts[] = '<script defer src="lib/fontawesome/js/all.js"></script>';

        require_once 'vista/plantilla.php';
        // require_once("vista/inicio/index.php");
    }

    //ARTEFACTO VIEJOOOOOO QUITARRRRRRRRRRRRRRR
    /*
    public function indexM(){
        $contenido = "vista/usuario/indexM.php";
        $scripts = [];
        $scripts[] = '<script defer type="text/javascript" src="vista/usuario/script.js"></script>';
        $scripts[] = '<script defer src="lib/fontawesome/js/all.js"></script>';

        require_once 'vista/plantilla.php';
        // require_once("vista/inicio/index.php");
    }


    public function cons(){
        $contenido = "vista/operador/consulta.php";
        $scripts = [];
        $scripts[] = '<script defer type="text/javascript" src="vista/operador/script.js"></script>';
        $scripts[] = '<script defer src="lib/fontawesome/js/all.js"></script>';

        require_once 'vista/plantilla.php';
        // require_once("vista/inicio/index.php");
    }

    public function formAlta(){
        $contenido = "vista/operador/alta.php";
        $scripts = [];
        $scripts[] = '<script defer type="text/javascript" src="vista/operador/script.js"></script>';
        $scripts[] = '<script defer type="text/javascript" src="lib/jshash-2.2/md5.js"></script>';

        require_once 'vista/plantilla.php';
    }

    public function formConsulta(){
        $contenido = "vista/operador/consulta.php";
        $scripts = [];
        if (is_numeric(filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT))){
            $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        }
        else $id = $_SESSION["id"];
        $scripts[] = '<script defer type="text/javascript">let idUsuarioCarga = '.$id.';</script>';
        $scripts[] = '<script defer type="text/javascript" src="vista/operador/script.js"></script>';
        $scripts[] = '<script defer type="text/javascript" src="vista/operador/script_consulta.js"></script>';
        $scripts[] = '<script defer type="text/javascript" src="lib/jshash-2.2/md5.js"></script>';
        require_once 'vista/plantilla.php';
    }

    public function login(){
        if(isset($_POST["textUsuario"]) && isset($_POST["textClave"])){
            $conexion = null;
            try{
                $conexion = Conexion::establecer();

                $operador = new Operador();
                $modelo = new OperadorDAO($conexion);
                
                $cuenta = filter_input(INPUT_POST,"textUsuario",FILTER_SANITIZE_STRING);
                $clave = filter_input(INPUT_POST,"textClave",FILTER_SANITIZE_STRING);
                $operador->setCuenta($cuenta);
                $operador->setClave($clave);
                $modelo->login($operador);
                //Falta cerrar la conexión, se hace en la excepción o dentro del login del modelo.
                // $conexion = null;
            }
            catch(PDOException $ex){
                $error = 'ERROR: '.$ex->getMessage();
                if($conexion != null) $conexion = null;
            }
            catch(Exception $ex){
                $error = 'ERROR: '.$ex->getMessage();
                if($conexion != null) $conexion = null;
            }
        }
        //Si no pasa la verificacion, genera un mensaje de error y lo mostramos en la ventana de login.
        require_once("vista/operador/login.php");
    }

    public function logoff(){
        unset($_SESSION["id"]);
        unset($_SESSION["cuenta"]);
        unset($_SESSION["usuario"]);
        //unset($_SESSION["usuario"]);
        unset($_SESSION["perfil"]);
        unset($_SESSION["logueado"]);
        session_destroy();
        header("Refresh:5;URL=index.php?c=operador&a=login");
        require_once("vista/operador/logoff.php");
    }

    public function ReservaExpress(){
        $contenido = "vista/secciones/reservaexpress.php";
        require_once 'vista/plantilla.php';
    }
}	
?>
*/
