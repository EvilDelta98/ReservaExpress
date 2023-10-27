<?php 
//primero crear clase como ninguna hereda le ponemos final class
 //definimos namespace 
 namespace model\entities;
 
final class UsuarioPerfil{
    

   //ahora reflejamos atributos de la tabla
   private $id,$nombre;
   //constructor 
 //HACER ESTO MISM CON LA ENTIDAD USUARIO
   public function __construct($data = null ){ // averiguar cuando armamos una identidad como validar
     //si no recibe ningun parametro sirvepara definir los valores por defectos
     if(is_array($data)){ //caso para comunicacion entre componentes internos
        $this-> setId($data["id"]);
        $this->setNombre($data["nombre"]);
     }
     else  if(is_object($data)){ //caso ara comunicacion entre componentes externos?
        $this-> setId($data->{"id"});
        $this->setNombre($data->{"nombre"});
     }
     else{
        $this-> id=0;
        $this->nombre="";
     }
     
   }
   //Getters
   public function getId():int{
    return $this->id;
   }

   public function getNombre():string{
    return $this->nombre;
   }
   //setters
   public function setId($id):void{
    //validamos que sea entero y que sea unoo o mayor a 1
    $this->id=$id; //estaría bueno poner una expresion regular

   }
   public function setNombre($nombre):void {
    $this->nombre=(is_string($nombre) && strlen(trim($nombre))>0)  ? trim ($nombre) : "";
    //si se usa pretmach el trim igual va. /s espacio en blanco 
   }

   //metodos
   public function toJson(): object{
    $json= json_decode('{}');
    $json->{"id"}=$this->getId();
    $json->{"nombre"}=$this->getNombre();

    return $json;
   }
}
//load crea un nuevo cliente y setead todos los datos  parecido a save(de controlador) las primeras lineas

