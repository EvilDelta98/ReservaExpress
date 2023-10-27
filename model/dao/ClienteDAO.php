<?php

namespace model\dao;

require_once "InterfaceDAO.php";
use model\dao\InterfaceDAO;
require_once "DAO.php";
use model\dao\DAO;
require_once "../model/entities/Cliente.php";
use model\entities\Cliente;
use PgSql\Lob;

final class ClienteDAO extends DAO implements InterfaceDAO{

    public function __construct($conn){
        parent::__construct($conn);
    }

    public function load($id): Cliente{

     
    //consultar para buscar el registro con el id=$id
    
    $sql= "SELECT * FROM clientes  WHERE id= :id";
    //preparar la consulta
    
    $stm = $this->conn->prepare($sql);

    $stm->execute(array(
        "id"=> $id)

    );
   
        
  
    //cuando haga el select preguntar cuantos registros devolvió la consulta
    if($stm->rowCount() != 1){
        throw new \Exception("No se encontro el cliente con el id". $id );

    }
   
        $result = $stm->fetch();
       $cliente= new Cliente();
       //hacer todos los setters 
       
       $cliente->setId($result->id);
       $cliente->setApellido($result->apellido);
       $cliente->setNombres($result->nombres);
       $cliente->setDni($result->dni);// tiene que coincidir
       $cliente->setDomicilio($result->domicilio);
       $cliente->setLocalidad($result->localidad);
       $cliente->setProvincia($result->provincia);
       $cliente->setCodigoPostal($result->codPostal);
       $cliente->setTelefono($result->telefono);
       $cliente->setCorreo($result->correo);
       $cliente->setFechaAlta($result->fechaAlta);
       
       return $cliente;
      
    //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
    //si lo encontre le hago fetch saco los datos de la consulta
    //crear una entidad nueva, setear los campos y devolver la entidad
}
    

    public function save($cliente):void{
        $this->validate($cliente);
        $this->validateDNI($cliente);
        $sql = "INSERT INTO clientes VALUES(DEFAULT, :apell, :nomb, :dni, :dom, :prov, :loc, :cp, :tel, :correo, NOW())";
        $stm = $this->conn->prepare($sql);
        $stm->execute(array(
            "apell" => $cliente->getApellido(),
            "nomb" => $cliente->getNombres(),
            "dni" => $cliente->getDni(),
            "dom" => $cliente->getDomicilio(),
            "prov" => $cliente->getProvincia(),
            "loc" => $cliente->getLocalidad(),
            "cp" => $cliente->getCodPostal(),
            "tel" => $cliente->getTelefono(),
            "correo" => $cliente->getCorreo()
        ));
     
    }
    /**
     * Verifica si el DNI del cliente actual o nuevo, existe para otro cliente.
     */
    private function validateDNI($cliente){
        $sql = "SELECT COUNT(*) AS total FROM clientes WHERE dni = :dni AND id <> :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            "dni" => $cliente->getDni(),
            "id" => $cliente->getId()
        ));
        $result = $stmt->fetch();
        if(((int)$result->total) > 0){
            throw new \Exception("El DNI " . $cliente->getDni() . " ya se encuentra registrado.");
        }
    }

    private function validate($cliente): void{
        if($cliente->getApellido() === ""){
        
            throw new \Exception("El APELLIDO es obligatorio?");
        }
        if($cliente->getNombres() === ""){
            throw new \Exception("El NOMBRE es obligatorio.");
        }
        if($cliente->getDni() === ""){
            throw new \Exception("El DNI es obligatorio.");
        }
        if($cliente->getDomicilio() === ""){
            throw new \Exception("El domicilio es obligatorio");
        }
        if($cliente->getLocalidad() === ""){
            throw new \Exception("La localidad es obligatorio");
        }
        if($cliente->getProvincia() === ""){
            throw new \Exception("La provincia es obligatorio");
        }
        if($cliente->getCodPostal() === ""){
            throw new \Exception("El codigo postal es obligatorio");
        }
        if($cliente->getTelefono() === ""){
            throw new \Exception("El telefono es obligatorio");
        }
        if($cliente->getCorreo() === ""){
            throw new \Exception("El correo es obligatorio");
        }
    }


    public function delete($id){
        $sql= "DELETE FROM clientes WHERE id= '$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function update($cliente){
       $ap= $cliente->getApellido();
       $nom= $cliente->getNombres();
       $dni= $cliente->getDni();
       $dom= $cliente->getDomicilio();
       $localidad=$cliente->getLocalidad();
       $prov= $cliente->getProvincia();
       $cod=$cliente->getCodPostal();
       $tel=$cliente->getTelefono();
       $correo=$cliente->getCorreo();
       $id=$cliente->getId();

        $sql= "UPDATE `clientes` SET `apellido` = '$ap', `nombres` = '$nom',  `dni` = '$dni',`domicilio` = '$dom',`localidad` = '$localidad',`provincia` = '$prov',`codPostal` = '$cod',`telefono` = '$tel',`correo` = '$correo' WHERE `clientes`.`id` = '$id'";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo eliminar");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
    public function list($filtros){
      
        $sql = "SELECT * ,DATE_FORMAT(fechaAlta,'%d-%m-%Y') as fechaAltaFormat FROM clientes ORDER BY apellido ASC, nombres ASC";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt->execute()){
            throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
}