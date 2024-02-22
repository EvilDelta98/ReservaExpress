
<?php

//ver que los atributos unicos sean realmente únicos
final class Socio{
   private  $id, $nombre,$apellido, $cuenta,$clave,$fechaAlta,$tipoSocio,$provincia,$localidad,$domicilio,$estado,$dni,$telefono,$correo;

   public function public function __construct() {
      $this->id = 0;
      $this->nombre="";
      $this->apellido="";
      $this->cuenta="";
      $this->clave="";
      $this->fechaAlta="";
      $this->tipoSocio=0;
      $this->provincia="";
      $this->localidad= "";
      $this->domicilio="";
      $this->estado=0;
      $this->dni=0;
      $this->telefono="";
      $this->correo="";
   }

   function getId(): int {
      return $this->id;
   }
   function getNombre(): string {
         return $this->nombre;
     }
   function getApellido(): string {
      return $this->apellido;
  }
   function getFechaAlta(): string {
         return $this->fechaAlta;
     }
    function getCuenta(): string {
         return $this->cuenta;
     }
   function getClave(): string {
         return $this->clave;
     }
   function getTipoSocio(): int {
         return $this->tipoSocio;
     }
   function getEstado(): int {
         return $this->estado;
     }
   function getFechaAlta(): string {
         return $this->fechaAlta;
     }
   function getProvincia(): string {
      return $this->provincia;}
      function getLocalidad(): string {
         return $this->localidad;
     }
   function getDomicilio(): string {
      return $this->domicilio;
  }
   function getDni(): int {
         return $this->dni;
     }
   function getTelefono(): string {
      return $this->telefono
  }  
  function getCorreo(): string {
   return $this->correo;
}

		/** Setters **/
		/**
		 * Setea y valida el identificador del usuario.
		 * @param int $id Identificador del registro en la base de datos.
		 */
		function setId($id){
			$this->id = (is_integer($id) && ($id > 0)) ? (int)$id : 0;
		}
        /**
		 * Setea y valida el nombre del usuario.
		 * @param String $nombre Cadena de texto que representa el nombre.
		 */
		function setNombre($nombre){
			$this->nombre = (is_string($nombre) && strlen(trim($nombre)) <= 45) ? trim($nombre): "";
		}
		/**
		 * Setea y valida el apellido del usuario.
		 * @param String $apellido Cadena de texto que representa un apellido.
		 */
		function setApellido($apellido){
			$this->apellido = (is_string($apellido) && strlen(trim($apellido)) <= 45) ? trim($apellido): "";
		}
		/**
		 * Setea y valida el correo del usuario.
		 * @param String $correo Cadena de texto que representa un correo.
		 */
		function setCorreo($correo){
			$this->correo = (is_string($correo) && strlen(trim($correo)) <= 255) ? trim($correo): "";
		}
		/**
		 * Setea y valida el formato del nombre de la cuenta.
		 * @param String $cuenta Nombre de usuario o cuenta.
		 */
		function setCuenta($cuenta){
			$this->cuenta = (is_string($cuenta) && strlen(trim($cuenta)) >= 5 && strlen(trim($cuenta)) <= 255) ? trim($cuenta) : "";
		}
		/**
		 * Setea y valida la clave del usuario en formato MD5.
		 * @param String $clave Contraseña en formato MD5.
		 */
		function setClave($clave){
			$this->clave = (is_string($clave) && (strlen($clave) == 32)) ? $clave: "";
		}
        /**
         * Setea y valida el tipo de usuario.
         * @param int $tipoUsuario Identificador del tipo de usuario.
         */
        function setTipoSocio($tipoSocio){
            $this->tipoSocio = (is_integer($tipoSocio) && ($tipoSocio > 0)) ? (int)$tipoSocio : 0;
        }//le podriamos agregar que tipo socio sea mayor a cero y menor o igual a 2 ? ya que tomaría el valor 1 o 2
        /**
         * Setea y valida el estado del usuario.
         * @param int $estado Identificador del estado del usuario.
         */
        function setEstado($estado){
            $this->estado = (is_integer($estado)) ? (int)$estado : 0;
        }
      /**
         * Setea y valida la fecha de alta del usuario.
         * @param String $fechaAlta Fecha de alta del usuario.
      */
		function setFechaAlta($fechaAlta){
			$this->fechaAlta = (is_string($fechaAlta)) ? trim($fechaAlta) : "";
		}
      /**
         * Setea y valida la provincia de origen del usuario.
         * @param String $provincia provincia de origen del usuario.
       */
      function setProvincia($provincia){
			$this->provincia = (is_string($provincia) && strlen(trim($provincia)) <= 255) ? trim($provincia): "";
		}
      /**
         * Setea y valida la localidad del usuario.
         * @param String $localidad localidad del usuario.
      */
      function setLocalidad($localidad){
			$this->localidad = (is_string($localidad) && strlen(trim($localidad)) <= 255) ? trim($localidad): "";
		}
      /**
         * Setea y valida la localidad del usuario.
         * @param String $localidad localidad del usuario.
      */
      function setDomicilio($domicilio){
			$this->domicilio = (is_string($domicilio) && strlen(trim($domicilio)) <= 255) ? trim($domicilio): "";
		}
      /**
         * Setea y valida el DNI del usuario.
         * @param String $dni DNI del usuario.
      */
      function setDni($dni){
         $this->dni = ( is_string($dni) && (strlen(trim($dni)) == 8) && is_numeric($dni) ) ? trim($dni) : "";
		}
      /**
         * Setea y valida el telefono del usuario.
         * @param String $telefono  telefono del usuario.
      */
      function setTelefono($telefono): void{
         $this->telefono = ( is_string($telefono) && (strlen(trim($telefono)) <=255)) ? trim($telefono) : "";
      }
		public function toJSON(): object{
			$json = json_decode("{}");
			$json->{"id"} = $this->getId();
         $json->{"nombre"} = $this->getNombre();
			$json->{"apellido"} = $this->getApellido();
         $json->{"correo"} = $this->getCorreo();
			$json->{"cuenta"} = $this->getCuenta();
         $json->{"provincia"} = $this->getProvincia();
         $json->{"localidad"} = $this->getLocalidad();
         $json->{"domicilio"} = $this->getDomicilio();
         $json->{"TipoSocio"} = $this->getTipoSocio();
         $json->{"telefono"} = $this->getTelefono();
         $json->{"dni"} = $this->getDni();
         $json->{"estado"} = $this->getEstado();
			$json->{"fechaAlta"} = $this->getFechaAlta();
			return $json;
		}
 	

  

}
