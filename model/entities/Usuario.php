<?php 
namespace model\entities;
 
final class Usuario{
    private $id,$nombre,$apellido,$correo,$cuenta,$clave,$perfilId,$estado,$horaEntrada,$horaSalida,$fechaAlta,$reseteoClave;
    function __construct()
    {
        //Inicializar los atributos
        $this->id = 0;
        $this->apellido = "";
        $this->nombre = "";
        $this->correo = "";
        $this->cuenta= "";
        $this->clave = "";
        $this->perfilId= 0;
        $this->estado = 0;
        $this->horaEntrada = "";
        $this->horaSalida = "";
        $this->fechaAlta = "";
        $this->reseteoClave=0;
    }

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
    public function getNombre(): string{
        return $this->nombre;
    }

    public function setNombre($nombre): void{
        $this->nombre = ((is_string($nombre))&&(strlen(trim($nombre)) <= 45)) ? trim($nombre) : "";
    }
    public function getCorreo(): string{
        return $this->correo;
    }
    public function setCorreo($correo): void{
        $this->correo= $correo;
    }
    public function setCuenta($cuenta): void{
        $this->cuenta= ((is_string($cuenta))&&(strlen(trim($cuenta)) <= 45)) ? trim($cuenta) : "";
      
}
public function getCuenta():string{
    return $this->cuenta;
}


public function setClave($clave): void{
    $this->clave= ((is_string($clave)&&(strlen(trim($clave)) <= 200)) ? trim($clave) : "");
}
public function getClave():string{
    return $this->clave;
}

public function getPerfilId():string{
    return $this->perfilId;
}
public function setPerfilId($id){
    $this->perfilId = (is_integer($id) && ($id > 0)) ? $id : 0; 
}
public function setEstado($estado){
    $this->estado=(is_integer($estado) && ($estado == 0 | $estado== 1)) ? $estado : 0;
}
public function getEstado(): int{
    return $this->estado;
}

public function getHoraEntrada(){
    return $this->horaEntrada;
}
public function setHoraEntrada($hora){
    $this->horaEntrada=$hora;
}
public function getHoraSalida(){
    return $this->horaSalida;
}
public function setHoraSalida($hora){
    $this->horaSalida=$hora;
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
public function setReseteoClave($reseteo){
    $this->reseteoClave= (is_integer($reseteo) && ($reseteo == 0 | $reseteo== 1)) ? $reseteo: 0;
}
public function getReseteoClave():int{
    return $this->reseteoClave;
}

public function toJson(): object{
    $json = json_decode('{}');

    $json->{"id"} = $this->getId();
    $json->{"apellido"} = $this->getApellido();
    $json->{"nombre"} = $this->getNombre();
    $json->{"correo"} = $this->getCorreo();
    $json->{"cuenta"}= $this->getCuenta();
    $json->{"clave"}=$this->getClave();
    $json->{"perfilId"}=$this->getPerfilId();
    $json->{"estado"}=$this->getEstado();
    $json->{"horaEntrada"}=$this->getHoraEntrada();
    $json->{"horaSalida"}=$this->getHoraSalida();
    $json->{"fechaAlta"} = $this->getFechaAlta();
    $json->{"reseteoClave"} = $this->getReseteoClave();

    return $json;        
}

}