<?php

namespace model\dao;

require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/Usuario.php";
use model\entities\Usuario;

final class UsuarioDAO extends DAO implements InterfaceDAO{

    public function __construct($conn){
        parent::__construct($conn);
    }

    public function load($id){

    //consultar para buscar el registro con el id=$id
   
    $sql= "SELECT * FROM usuarios WHERE id = :id";
    //preparar la consulta
    
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "id"=> $id)

    );
        

    //cuando haga el select preguntar cuantos registros devolvió la consulta
    if($stm->rowCount() != 1){
        throw new \Exception("No se encontro el usuario con el id". $id );

    }
   
        $result = $stm->fetch();
       $usuario= new Usuario();
       //hacer todos los setters 
       $usuario->setId($result->id);
       $usuario->setApellido($result->apellido);
       $usuario->setNombre($result->nombre);
       $usuario->setCorreo($result->correo);// tiene que coincidir
       $usuario->setCuenta($result->cuenta);
       $usuario->setclave($result->clave);
       $usuario->setPerfilId($result->perfilId);
       $usuario->setEstado($result->estado);
       $usuario->setHoraEntrada($result->horaEntrada);
       $usuario->setHoraSalida($result->horaSalida);
       $usuario->setFechaAlta($result->fechaAlta);
       $usuario->setReseteoClave($result->reseteoClave);
   
       return $usuario;


    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
    
public function loadCuenta($id){
    
    //consultar para buscar el registro con el id=$id
    $sql= "SELECT * FROM usuarios WHERE cuenta= :cuenta";
    //preparar la consulta
    $stm = $this->conn->prepare($sql);
    $stm->execute(array(
        "cuenta"=> $id)

    );
        

    //cuando haga el select preguntar cuantos registros devolvió la consulta
    if($stm->rowCount() != 1){
        throw new \Exception("No se encontro la cuenta con la cuenta". $id );

    }
   
        $result = $stm->fetch();
       $usuario= new Usuario();
       //hacer todos los setters 
       $usuario->setId($result->id);
       $usuario->setApellido($result->apellido);
       $usuario->setNombre($result->nombre);
       $usuario->setCorreo($result->correo);// tiene que coincidir
       $usuario->setCuenta($result->cuenta);
       $usuario->setclave($result->clave);
       $usuario->setPerfilId($result->perfilId);
       $usuario->setEstado($result->estado);
       $usuario->setHoraEntrada($result->horaEntrada);
       $usuario->setHoraSalida($result->horaSalida);
       $usuario->setFechaAlta($result->fechaAlta);
       $usuario->setReseteoClave($result->reseteoClave);
   
       return $usuario;


    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
    
    public function save($usuario){
        $this->validate($usuario);
      //  $this->validateDNI($cliente);

        $sql = "INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `cuenta`, `clave`, `perfilId`, `estado`, `horaEntrada`, `horaSalida`, `fechaAlta`, `reseteoClave`) VALUES(DEFAULT, :nomb, :apell, :cor, :cuenta, :clave, :perfilId, :estado, :hE, :hS,NOW(),:rC)";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "apell" => $usuario->getApellido(),
            "nomb" => $usuario->getNombre(),
            "cor" => $usuario->getCorreo(),
            "cuenta" => $usuario->getCuenta(),
            "clave" => $usuario->getClave(),
           "perfilId" => $usuario->getPerfilId(),
            "estado" => $usuario->getEstado(),
            "hE" => $usuario->getHoraEntrada(),
            "hS" => $usuario->getHoraSalida(),
            "rC" => $usuario->getReseteoClave()
        ));
     
    
    
    }
    /**
     * Verifica si el DNI del cliente actual o nuevo, existe para otro cliente.
     */
    private function validateCuenta($cliente){
        //aca vamos a tener 
    }
    private function validateCorreo($cliente){
        //aca vamos a tener 
    
   }
   public function reseteo($cliente){
    $clavenueva= $cliente->getClave();
    $id= $cliente->getId();
    $sql= "UPDATE usuarios SET clave = '$clavenueva', reseteoClave= 0 WHERE id = '$id'";
    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo resetear clave");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

    public function listarPerfiles($filtros){
        $sql = "SELECT *  FROM usuarios_perfiles ";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    


}
   

   public function update($usuario){
    $ap= $usuario->getApellido();
    $nom= $usuario->getNombre();
    $correo= $usuario->getCorreo();
    $cuenta =$usuario->getCuenta();
    $perfilId= (int) $usuario->getPerfilId();
    $perfil= (int) $perfilId;
    $estado=$usuario->getEstado();
    $horaEntrada=$usuario->getHoraEntrada();
    $horaSalida=$usuario->getHoraSalida();
    $reseteo=$usuario->getReseteoClave();
    $id=$usuario->getId();
    
  
    $sql= "UPDATE usuarios SET apellido = '$ap', nombre = '$nom',  correo = '$correo',cuenta = '$cuenta',perfilId = '$perfil',estado = '$estado',horaEntrada = '$horaEntrada',horaSalida = '$horaSalida',reseteoClave = '$reseteo' WHERE id = '$id'";
 
     
     $stmt = $this->conn->prepare($sql);
     if(!$stmt->execute()){
         throw new \Exception("No se pudo eliminar");
     }
     return $stmt->fetchAll(\PDO::FETCH_ASSOC);

 }
   

    public static function login($conn, $cuenta, $clave): void{
        //agarro hora entrada hora de salida en el select
       
        $sql="SELECT id, cuenta, clave, apellido, nombre,estado,perfilId,horaSalida,horaEntrada, reseteoClave FROM usuarios WHERE cuenta= :cuenta";
        
        $stm = $conn->prepare($sql); //le pasamos conn xw es un metodo estatico
        
        $stm->execute(array("cuenta" => $cuenta));

      
        if($stm->rowCount() != 1){
            throw new \Exception("No existe la cuenta => " . $cuenta);
        }
        $result = $stm->fetch();
        if(!password_verify($clave, $result->clave)){
            throw new \Exception("La cuenta o clave es incorrecta");
        }
        if(((int)$result->estado) === 0){
            throw new \Exception("Su cuenta se encuentra inhabilitada");
        }
        if(((int)$result->reseteoClave) === 1){
         
            throw new \Exception("Debe resetear su clave");
            $_SESSION["id"]=$result->id;//USAR ID O NOMBRE
        }

      

//crear la info de estado de la session
$_SESSION["clave_secreta"]="lab2023";//hash
$_SESSION["usuario"]=$result->nombre."," .$result->apellido;
$_SESSION["perfil"]=$result->perfilId;
$_SESSION["horaSalida"]=$result->horaSalida;
$_SESSION["horaEntrada"]=$result->horaEntrada;
$_SESSION["id"]=$result->id;//USAR ID O NOMBRE
//$_SESSION["horaSalida"] = $result->horaSalida;
//INNERJOIN 


    }
    //logout borra la sesion y todo lo qeu hayamos borrado en la sesión 
    public static function logout(): void{
        //borrar variables de sesión
        //eliminar la sesión 
    }
    private function validate($cliente): void{
        if($cliente->getApellido() === ""){
        
            throw new \Exception("El APELLIDO es obligatorio???");
        }
        if($cliente->getCorreo() === ""){
            throw new \Exception("El correo es obligatorio");
        }
        if($cliente->getCuenta() === ""){
            throw new \Exception("La cuenta obligatorio.");
        }
        if($cliente->getClave() === ""){
            throw new \Exception("La clave es obligatoria,clave es ".$cliente->getNombre());
        }
        if($cliente->getPerfilId() === ""){
            throw new \Exception("El perfil id es obligatorio");
        }
        if($cliente->getEstado() === ""){
            throw new \Exception("El estado es obligatorio");
        }
        if($cliente->getHoraEntrada() === ""){
            throw new \Exception("La hora de entrada  es obligatorio");
        }
        if($cliente->getHoraSalida() === ""){
            throw new \Exception("La hora de salida es obligatorio");
        }
        if($cliente->getReseteoClave() === ""){
            throw new \Exception("El reseteo de clave es obligatorio");
        }
        
    }

  

    public function delete($id){
        $sql= "DELETE FROM usuarios WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
public function buscarPerfil($id){
    $sql = "SELECT *  FROM usuarios_perfiles WHERE id ='$id'";
     //  $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
    public function list($filtros){
    $sql = "SELECT *  FROM usuarios_perfiles INNER JOIN usuarios ON usuarios_perfiles.id = usuarios.perfilId";
  //   $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
public function activate($id){
    $sql= "UPDATE `usuarios` SET `estado` = '1' WHERE `usuarios`.`id` = '$id'";

    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo activar la cuenta");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

}
public function inactivate($id){
    $sql= "UPDATE `usuarios` SET `estado` = '0' WHERE `usuarios`.`id` = '$id'";

    $stmt = $this->conn->prepare($sql);
    if(!$stmt->execute()){
        throw new \Exception("No se pudo desactivar la cuenta");
    }
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

}

}