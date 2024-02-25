<?php

    namespace model\entities;

	final class Administrador{
        // Atributos
		private $id, $nombre, $apellido, $correo, $cuenta, $clave, $tipoUsuario, $estado, $fechaAlta;

        // Constructor
		public function __construct(){ 
			$this->setId(0);
			$this->setNombre("");
			$this->setApellido("");
			$this->setCorreo("");
			$this->setCuenta("");
			$this->setClave("");
			$this->setTipoUsuario(0);
            $this->setEstado(0);
            $this->setFechaAlta("");
		}

		// Getters
		function getId(): int {
			return $this->id;
		}
        function getNombre(): string {
            return $this->nombre;
        }
		function getApellido(): string {
            return $this->apellido;
        }
        function getCorreo(): string {
            return $this->correo;
        }
        function getCuenta(): string {
            return $this->cuenta;
        }
        function getClave(): string {
            return $this->clave;
        }
        function getTipoUsuario(): int {
            return $this->tipoUsuario;
        }
        function getEstado(): int {
            return $this->estado;
        }
        function getFechaAlta(): string {
            return $this->fechaAlta;
        }

		// Setters
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
        function setTipoUsuario($tipoUsuario){
            $this->tipoUsuario = (is_integer($tipoUsuario) && ($tipoUsuario > 0)) ? (int)$tipoUsuario : 0;
        }
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


		// Métodos
		public function toJSON(): object{
			$json = json_decode("{}");
			$json->{"id"} = $this->getId();
            $json->{"nombre"} = $this->getNombre();
			$json->{"apellido"} = $this->getApellido();
            $json->{"correo"} = $this->getCorreo();
			$json->{"cuenta"} = $this->getCuenta();
			// $json->{"clave"} = $this->getClave();
            $json->{"tipoUsuario"} = $this->getTipoUsuario();
            $json->{"estado"} = $this->getEstado();
			$json->{"fechaAlta"} = $this->getFechaAlta();
			return $json;
		}
 	}