<?php
final class Prestamo{
    // Atributos
    private  $id,$idSocio,$idEjemplar,$fechaInicio,$fechaVencimiento,$fechaDevolucion,$observacion,$estado,$tipo;

    // Constructor
    public function __construct() {
      $this->id=0;
      $this->idSocio=0;
      $this->idEjemplar=0;
      $this->fechaInicio="";
      $this->fechaVencimiento="";
      $this->fechaDevolucion="";
      $this->observacion="";
      $this->estado=0;
      $this->tipo=0;
    }

    // Getters
    function getId(): int{
        return $this->id;
    }
    function getIdSocio(): int{
        return $this->idSocio;
    }
    function getIdEjemplar(): int{
        return $this->idEjemplar;
    }
    function getFechaInicio(): string{
        return $this->fechaInicio;
    }
    function getFechaVencimiento(): string{
        return $this->fechaVencimiento;
    }
    function getFechaDevolucion(): string{
        return $this->fechaDevolucion;
    }
    function getObservacion(): string{
        return $this->observacion;
    }
    function getEstado(): int{
        return $this->estado;
    }
    function getTipo(): int{
        return $this->tipo;
    }

    // Setters
    function setId($id){
        $this->id = (is_integer($id) && ($id > 0)) ? (int)$id : 0;
    }
    function setIdSocio($idSocio){
        $this->idSocio = (is_integer($idSocio) && ($idSocio > 0)) ? (int)$idSocio : 0;
    }
    function setIdEjemplar($idEjemplar){
        $this->idEjemplar = (is_integer($idEjemplar) && ($idEjemplar > 0)) ? (int)$idEjemplar : 0;
    }
    function setFechaInicio($fechaI){
        $this->fechaInicio= (is_string($fechaI)) ? trim($fechaI) : "";
    }
    function setFechaVencimiento($fechaV){
        $this->fechaVencimiento= (is_string($fechaV)) ? trim($fechaV) : "";
    }
    function setFechaDevolucion($fechaD){
        $this->fechaDevolucion= (is_string($fechaD)) ? trim($fechaD) : "";
    }
    function setObservacion($obs){
        $this->observacion = (is_string($obs) && strlen(trim($obs)) <= 255) ? trim($obs): "";
    }
    function setEstado($estado){
        $this->estado = (is_integer($estado)) ? (int)$estado : 0;
    }
    function setTipo($tipo){
        $this->tipo = (is_integer($tipo)) ? (int)$tipo : 0;
    }

   // Metodos
    public function toJSON(): object{
        $json = json_decode("{}");
        $json->{"id"} = $this->getId();
        $json->{"idSocio"} = $this->getIdSocio();
        $json->{"idEjemplar"} = $this->getIdEjemplar();
        $json->{"fechaInicio"} = $this->getFechaInicio();
        $json->{"fechaVencimiento"} = $this->getFechaVencimiento();
        $json->{"fechaDevolucion"} = $this->getFechaDevolucion();
        $json->{"observacion"} = $this->getObservacion();
        $json->{"estado"} = $this->getEstado();
        $json->{"tipo"} = $this->getTipo();
        return $json;
    }
}
