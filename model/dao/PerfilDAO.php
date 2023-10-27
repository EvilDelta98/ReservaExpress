<?php

namespace model\dao;

require_once("InterfaceDAO.php");
use model\dao\InterfaceDAO;
require_once("DAO.php");
use model\dao\DAO;
require_once "../model/entities/UsuarioPerfil.php";
use model\entities\UsuarioPerfil;

final class PerfilDAO extends DAO implements InterfaceDAO{
    public function __construct($conn){
        parent::__construct($conn);
    }


    public function load($id){

        //consultar para buscar el registro con el id=$id
       
        $sql= "SELECT * FROM usuarios_perfiles WHERE id = :id";
        //preparar la consulta
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "id"=> $id)
    
        );
            
    
        //cuando haga el select preguntar cuantos registros devolvió la consulta
        if($stm->rowCount() != 1){
            throw new \Exception("No se encontro el perfil con el id". $id );
    
        }
       
            $result = $stm->fetch();
           $usuario= new UsuarioPerfil();
           //hacer todos los setters 
          
           
           $usuario->setId($result->id);
         
           $usuario->setNombre($result->nombre);
           
           return $usuario;
    
    
        //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
        //si lo encontre le hago fetch saco los datos de la consulta
        //crear una entidad nueva, setear los campos y devolver la entidad
    }
    public function save($usuario){
       // $this->validate($usuario);
      //  $this->validateDNI($cliente);
   
        $sql = "INSERT INTO `usuarios_perfiles` (`id`, `nombre`) VALUES (DEFAULT, :nomb)";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
           
            "nomb" => $usuario->getNombre(),
            
        ));
     }
     
     public function delete($id){
        $sql= "DELETE FROM usuarios_perfiles WHERE id='$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function list($filtros){
        $sql = "SELECT * FROM usuarios_perfiles ORDER BY id ASC, nombre ASC";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }  

    public function update($usuario){
        $nom= $usuario->getNombre();
       
        $id=$usuario->getId();
        $sql= " UPDATE usuarios_perfiles SET nombre = '$nom' WHERE id = '$id'";
       
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo actualizar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
}