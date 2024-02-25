<?php 

   namespace model\entities;

   final class UsuarioPerfil{
      // Atributos
      private $id,$nombre;

      // Constructor 
      public function __construct($data = null ){
         if(is_array($data)){
            $this->setId($data["id"]);
            $this->setNombre($data["nombre"]);
         }
         else if(is_object($data)){
            $this-> setId($data->{"id"});
            $this->setNombre($data->{"nombre"});
         }
         else{
            $this->id=0;
            $this->nombre="";
         }
      }

      // Getters
      public function getId():int{
         return $this->id;
      }

      public function getNombre():string{
         return $this->nombre;
      }

      // Setters
      public function setId($id):void{
         $this->id=(is_integer($id) && $id > 0) ? (int)$id : 0;
      }

      public function setNombre($nombre):void {
         $this->nombre=(is_string($nombre) && strlen(trim($nombre))>0)  ? trim ($nombre) : "";
      }

      // Metodos
      public function toJson(): object{
         $json= json_decode('{}');
         $json->{"id"}=$this->getId();
         $json->{"nombre"}=$this->getNombre();

         return $json;
      }
   }