<?php

namespace model\entities;

final class Cliente{
    //Atributos
    //Se deben corresponder con los de la tabla CLIENTES
    private $id, $apellido, $nombres, $dni, $domicilio;
    private $provincia, $localidad, $codPostal, $telefono, $correo;
    private $fechaAlta;

    /**
     * Constructor de la clase
     */
    function __construct()
    {
        //Inicializar los atributos
        $this->id = 0;
        $this->apellido = "";
        $this->nombres = "";
        $this->dni = "";
        $this->domicilio = "";
        $this->provincia = "";
        $this->localidad = "";
        $this->codPostal = "";
        $this->telefono = "";
        $this->correo = "";
        $this->fechaAlta = "";
    }

    // Getters y Setters
    public function getId(): int{
        return $this->id;
    }
    public function setId($id):void{
        $this->id = (is_integer($id) && ($id > 0)) ? $id : 0;        
    }

    public function getApellido(): string{
        return $this->apellido;
    }
    public function setApellido($apellido): void{

        $this->apellido = ((is_string($apellido))&&(strlen(trim($apellido)) <= 45)) ? trim($apellido) : "";
    }

    public function getNombres(): string{
        return $this->nombres;
    }

    public function setNombres($nombre): void{
        $this->nombres = ((is_string($nombre))&&(strlen(trim($nombre)) <= 45)) ? trim($nombre) : "";
    }

    public function getDni(): string{
        return $this->dni;
    }

    public function setDni($dni): void{
        $this->dni = ( is_string($dni) && (strlen(trim($dni)) == 8) && is_numeric($dni) ) ? trim($dni) : "";
    }
    public function setDomicilio($domicilio):void{
        $this->domicilio = ( is_string($domicilio) && (strlen(trim($domicilio)) <=60)) ? trim($domicilio) : "";
    }

    public function getDomicilio(): string{
        return $this->domicilio;
    }

    public function getProvincia(): string{
        return $this->provincia;
    }
 public function setProvincia($provincia): void{
     $this->provincia = ( is_string($provincia) && (strlen(trim($provincia)) <=30)) ? trim($provincia) : "";
 }
 public function setLocalidad($localidad): void{
    $this->localidad = ( is_string($localidad) && (strlen(trim($localidad)) <=30)) ? trim($localidad) : "";
 }
 public function setCodigoPostal($codigo): void{
    $this->codPostal= ( is_string($codigo) && (strlen(trim($codigo)) ==4)) ? trim($codigo) : "";
 }
 public function setTelefono($telefono): void{
    $this->telefono = ( is_string($telefono) && (strlen(trim($telefono)) <=45)) ? trim($telefono) : "";
 }
 public function setCorreo($correo): void{
    $this->correo= ( is_string($correo) && (strlen(trim($correo)) <=255)) ? trim($correo) : "";
 }
    public function getLocalidad(): string{
        return $this->localidad;
    }

    public function getCodPostal(): string{
        return $this->codPostal;
    }

    public function getTelefono(): string{
        return $this->telefono;
    }

    public function getCorreo(): string{
        return $this->correo;
    }

    public function getFechaAlta(): string{
        return $this->fechaAlta;
    }

    public function setFechaAlta($fecha): void{
        $this->fechaAlta = (
            (is_string($fecha))
            &&
            (strlen(trim($fecha)) == 10)
            ) ? trim($fecha) : "";
    }

    // falta el resto de getters y setters

    //Métodos públicos

    public function toJson(): object{
        $json = json_decode('{}');

        $json->{"id"} = $this->getId();
        $json->{"apellido"} = $this->getApellido();
        $json->{"nombres"} = $this->getNombres();
        $json->{"dni"} = $this->getDni();
        $json->{"domicilio"}=$this->getDomicilio();
        $json->{"localidad"}=$this->getLocalidad();
        $json->{"provincia"}=$this->getProvincia();
        $json->{"codPostal"}=$this->getCodPostal();
        $json->{"telefono"}=$this->getTelefono();
        $json->{"correo"}=$this->getCorreo();
        $json->{"fechaAlta"} = $this->getFechaAlta();
        return $json;        
    }
}