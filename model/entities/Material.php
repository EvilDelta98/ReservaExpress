<?php
 namespace model\entities;

 final class Material{
    private $id, $ISBN, $titulo, $autor, $edicion, $editorial, $disciplina,$cantEjemplares,$estado;

    public function __construct(){ 
        $this->setId(0);
        $this->setISBN("");
        $this->setTitulo("");
        $this->setAutor("");
        $this->setEdicion("");
        $this->setEditorial("");
        $this->setDisciplina("");
        $this->setCantEjemplares("");//??  
        $this->setEstado("");
     
    }
    ### Getters ###
    function getId(): int {
        return $this->id;
    }
    function getISBN(): string {
        return $this->ISBN;
    }
    function getTitulo(): string {
        return $this->titulo;
    }
    function getAutor(): string {
        return $this->autor;
    }
    function getEdicion(): string {
        return $this->edicion;
    }
    function getEditorial(): string {
        return $this->editorial;
    }
    function getDisciplina(): string {
        return $this->disciplina;
    }
    function getCantEjemplares(): int {
        return $this->cantEjemplares;
    }
    function getEstado(): int {
        return $this->estado
    }
    ### Setters ###
    function setId($id){
        $this->id = (is_integer($id) && ($id > 0)) ? (int)$id : 0;
    }
    function setISBN($ISBN){
        $this->ISBN = (is_string($clave) && (strlen($clave) == 17)) ? trim($clave): "";
    }
    function setTitulo($titulo){
        $this->titulo = (is_string($titulo) && strlen(trim($titulo)) <= 255) ? trim($titulo): "";
    }
    function setAutor($autor){
        $this->autor = (is_string($autor) && strlen(trim($autor)) <= 255) ? trim($autor): "";
    }
    function setEdicion($edicion){
        $this->edicion = (is_integer($edicion) && ($edicion > 0)) ? (int)($edicion): 0;
    }
    function setEditorial($editorial){
        $this->editorial = (is_string($editorial) && strlen(trim($editorial)) <= 255) ? trim($editorial): "";
    }
    function setDisciplina($disciplina){
        $this->disciplina = (is_string($disciplina) && strlen(trim($disciplina)) <= 255) ? trim($disciplina): "";
    }
    function setEstado($estado){ 
        $this->estado = (is_integer($estado) && (estado > 0)) ? (int)$id : 0;
    }
    public function toJSON(){
        $json = json_decode("{}");
        $json->{"id"} = $this->getId();
        $json->{"ISBN"} = $this->getISBN();
        $json->{"titulo"} = $this->getTitulo();
        $json->{"autor"} = $this->getAutor();
        $json->{"edicion"} = $this->getEdicion();
        $json->{"editorial"} = $this->getEditorial();
        $json->{"disciplina"} = $this->getDisciplina();
        $json->{"cantElementos"} = $this->getDisciplina();
        $json->{"estado"} = $this->getDisciplina();
        return $json;
    }

    //CANT EJEMPLARES Y ESTADO lo ponemos??
 }
