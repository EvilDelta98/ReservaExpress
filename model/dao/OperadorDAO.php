<?php

	namespace model\dao;

	require_once("InterfaceDAO.php");
	use model\dao\InterfaceDAO;
	require_once("DAO.php");
	use model\dao\DAO;
	require_once "../model/entities/Operador.php";
	use model\entities\Operador;

	class OperadorDAO extends DAO implements InterfaceDAO{
		//Atributos
		//Constructor

		public function __construct($conexion){
			parent::__construct($conexion);
		}
		//Métodos

		public function load($id){
			$sql = "SELECT * FROM usuario WHERE id = :id";
			$stm = $this->conexion->prepare($sql);
			$stm->execute(array(
				"id" => $id)
			);

			if($stm->rowCount() != 1){
				throw new \Exception("No se encontro el usuario con el id". $id );
			}

			$result = $stm->fetch();
			$usuario = new Operador();
			$usuario->setId($result->id);
			$usuario->setNombre($result->nombre);
			$usuario->setApellido($result->apellido);
			$usuario->setCorreo($result->correo);
			$usuario->setCuenta($result->cuenta);
			$usuario->setClave($result->clave);
			$usuario->setTipoUsuario($result->tipoUsuario);
			$usuario->setEstado($result->estado);
			$usuario->setFechaAlta($result->fechaAlta);
			return $usuario;
		}

		public function loadCuenta($id){
			$sql = "SELECT * FROM usuario WHERE cuenta = :cuenta";
			$stmt = $this->conexion->prepare($sql);
			$stmt->execute(array(
				"cuenta" => $id)
			);
			if($stm->rowCount() != 1){
				throw new \Exception("No se encontro el usuario con el id". $id );
			}
			$result = $stm->fetch();
			$usuario = new Operador();
			$usuario->setId($result->id);
			$usuario->setNombre($result->nombre);
			$usuario->setApellido($result->apellido);
			$usuario->setCorreo($result->correo);
			$usuario->setCuenta($result->cuenta);
			$usuario->setClave($result->clave);
			$usuario->setTipoUsuario($result->tipoUsuario);
			$usuario->setEstado($result->estado);
			$usuario->setFechaAlta($result->fechaAlta);
			return $usuario;
		}

		public function save($usuario){
			$this->validate($usuario);
			// $this->validateDNI($usuario);
			$sql = "INSERT INTO 'usuario' ('id', 'nombre', 'apellido', 'correo', 'cuenta', 'clave', 'tipoUsuario', 'estado', 'fechaAlta') VALUES (DEFAULT, :nomb, :apell, :cor, :cuent, :clav, :tipUsur, :est, NOW())";
			$stm = $this->conexion->prepare($sql);
			$stm->execute(array(
				"nomb" => $usuario->getNombre(),
				"apell" => $usuario->getApellido(),
				"cor" => $usuario->getCorreo(),
				"cuent" => $usuario->getCuenta(),
				"clav" => $usuario->getClave(),
				"tipUsur" => $usuario->getTipoUsuario(),
				"est" => $usuario->getEstado()
			));
		}

		private function validateCuenta($usuario){
			//RELLENAR
		}
		private function validateCorreo($usuario){
			//RELLENAR
		}

		public function reseteo($usuario){
			$claveNueva = $usuario->getClave();
			$id = $usuario->getId();
			$sql = "UPDATE usuario SET clave = '$claveNueva' WHERE id = '$id'";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				//throw new \Exception("No se pudo resetear la clave.");
				throw new \Exception($stmt->errorInfo()[2]);
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function listarPerfiles($filtros){
			$sql = "SELECT * FROM usuario";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				//throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
				throw new \Exception($stmt->errorInfo()[2]);
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function update($usuario){
			$nom = $usuario->getNombre();
			$ap = $usuario->getApellido();
			$cor = $usuario->getCorreo();
			$cuent = $usuario->getCuenta();
			$tipUsur = $usuario->getTipoUsuario();
			$est = $usuario->getEstado();
			$id = $usuario->getId();

			$sql = "UPDATE usuario SET nombre ='$nom', apellido ='$ap', correo ='$cor', cuenta ='$cuent', tipoUsuario ='$tipUsur', estado ='$est' WHERE id = '$id'";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo eliminar");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public static function login($conexion, $cuenta, $clave): void{
			$sql = "SELECT id, cuenta, clave, nombre, apellido, estado FROM usuario WHERE cuenta = :cuenta";
			$stm = $conexion->prepare($sql);
			$stm->execute(array("cuenta" => $cuenta));
			if($stm->rowCount() != 1){
				throw new \Exception("No existe la cuenta " . $cuenta);
			}
			$result = $stm->fetch();
			if(!password_verify($clave, $result->clave)){
				throw new \Exception("La cuenta o clave es incorrecta");
			}
			if(((int)$result->estado) === 0){
				throw new \Exception("Su cuenta se encuentra inhabilitada");
			}

			$_SESSION["clave_secreta"]="final2024";//hash
			$_SESSION["usuario"]=$result->nombre."," .$result->apellido;
			//USAMOS PERFILES?
			$_SESSION["perfil"]=$result->perfilId;
			$_SESSION["id"]=$result->id;
		}

		public static function logout():void{
			sesion_unset(); //Destruye las variables
        	session_destroy(); //Destruye la sesión
		}

		private function validate($usuario): void{
			if($usuario->getNombre() == ""){
				throw new \Exception("El nombre es obligatorio");
			}
			if($usuario->getApellido() == ""){
				throw new \Exception("El apellido es obligatorio");
			}
			if($usuario->getCorreo() == ""){
				throw new \Exception("El correo es obligatorio");
			}
			if($usuario->getCuenta() == ""){
				throw new \Exception("La cuenta es obligatoria");
			}
			if($usuario->getClave() == ""){
				throw new \Exception("La clave es obligatoria");
			}
			if($usuario->getTipoUsuario() == ""){
				throw new \Exception("El tipo de usuario es obligatorio");
			}
			if($usuario->getEstado() == ""){
				throw new \Exception("El estado es obligatorio");
			}
		}

		public function delete($id){
			$sql = "DELETE FROM usuario WHERE id='$id'";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo eliminar");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		//¿USAMOS ESTA FUNCIÓN?
		public function buscarPerfil($id){
			$sql = "SELECT * FROM usuario WHERE id = '$id'";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function list($filtros){
			//REFACCIONAR PARA LISTAR TODOS LOS SOCIOS SEGÚN SU TIPOUSUARIO
			$sql = "SELECT * FROM usuarios_perfiles INNER JOIN usuarios ON usuarios_perfiles.id = usuarios.perfilId";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function activate($id){
			$sql = "UPDATE 'usuario' SET 'estado' = '1' WHERE 'usuario'.'id' = '$id'";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo activar la cuenta");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function deactivate($id){
			$sql = "UPDATE 'usuario' SET 'estado' = '0' WHERE 'usuario'.'id' = '$id'";
			$stmt = $this->conexion->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo desactivar la cuenta");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

	/**** MÉTODOS VIEJOSSSSS REVISAR

		public function actualizar($objeto){
			$this->setError("");	
			//Validar los atributos con campos obligatorios en la tabla de bd.
			if(!$this->validar($objeto)){
				throw new Exception($this->getError());
			}
			//Validación de cuenta existente
			if($this->existeCuenta($objeto)){
				throw new Exception("La cuenta de usuario (".$objeto->getCuenta().") ya existe");
			}
			//Validación de correo existente
			if($this->existeCorreo($objeto)){
				throw new Exception("El correo de usuario (".$objeto->getCorreo().") ya existe");
			}
			//Preparar la consulta, no va clave
            if ($stmt = $this->conexion->prepare("update usuario set nombre = :nombre, apellido = :apellido, correo = :correo, cuenta = :cuenta, tipoUsuario = :tipoUsuario,estado = :estado  where id = :id")){    
				$stmt->bindValue("nombre",$objeto->getNombre(),PDO::PARAM_STR);
				$stmt->bindValue("apellido",$objeto->getApellido(),PDO::PARAM_STR);
                $stmt->bindValue("correo",$objeto->getCorreo(),PDO::PARAM_STR);
				$stmt->bindValue("cuenta",$objeto->getCuenta(),PDO::PARAM_STR);
				$stmt->bindValue("tipoUsuario",$objeto->getTipoUsuario(),PDO::PARAM_INT);
                $stmt->bindValue("estado",$objeto->getEstado(),PDO::PARAM_INT);
				$stmt->bindValue("id",$objeto->getId(),PDO::PARAM_INT);
				if(!$stmt->execute()){
					throw new Exception($stmt->errorInfo()[2]);
				}
				$stmt->closeCursor();
			}
			else{
				throw new PDOExpection();
			}
		}

		public function actualizarClave($objeto){
			$this->setError("");
			//Validar la longitud de la clave
			if(strlen($objeto->getClave()) != 32){
				throw new Exception("No se especificó la nueva clave.");
			}
			//Preparar la consulta
			if ($stmt = $this->conexion->prepare("update usuario set clave = :clave where id = :id;")){
				if(!$stmt->execute(array("id"=>$objeto->getId(), "clave"=>$objeto->getClave()))){
					throw new Exception($stmt->errorInfo()[2]);
				}
				$stmt->closeCursor();
			}
			else{
				throw new PDOExpection();
			}
		}

		/**
		 * Busca un registro en la bd y lo devuelve como un objeto php.
		 * @param      integer       $id     Identificador del registro en la bd.
		 *
		 * @throws     Exception     Mensaje de error.
		 * @throws     PDOExpection  Mensaje de error del driver.
		 
		public function cargar($id){
			//Validar que el id sea un entero válido.
			if(!is_integer($id) || ($id <= 0)){
				throw new Exception("El identificador a buscar es inválido.");
			}
			//Preparar la consulta
			if ($stmt = $this->conexion->prepare("select id, nombre, apellido, correo, cuenta, clave, tipoUsuario, estado, DATE_FORMAT(fechaAlta,'%d-%m-%Y %H:%i:%s') as fechaAlta from usuario where id = :id;")){
				if($stmt->execute(array("id" => $id))){
					if($stmt->rowCount() == 1){
						$objeto = new Operador();
						//Cargar los datos en el objeto.
						$reg = $stmt->fetch();
						$objeto->setId((int)$reg->id);
                        $objeto->setNombre($reg->nombre);
                        $objeto->setApellido($reg->apellido);
                        $objeto->setCorreo($reg->correo);
						$objeto->setCuenta($reg->cuenta);
						$objeto->setClave($reg->clave);
						$objeto->setTipoUsuario($reg->tipoUsuario);
                        $objeto->setEstado($reg->estado);
						$objeto->setFechaAlta($reg->fechaAlta);
						$stmt->closeCursor();
						return $objeto;
					}
					else{
						throw new Exception("No se encontró el registro con el identificador = ".$id);
					}
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
			}
			else{
				throw new PDOExpection();
			}
		}

		public function eliminar($objeto){
			//Preparar la consulta
			if ($stmt = $this->conexion->prepare("delete from usuario where id = :id;")){
				if($stmt->execute(array("id" => $objeto->getId()))){
					if($stmt->rowCount() == 0){
						throw new Exception("No se eliminaron registros de la base de datos.");
					}
					$objeto->setId(0);
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
				$stmt->closeCursor();
			}
			else{
				throw new PDOExpection();
			}
		}

		public function guardar ($objeto){
			$this->setError("");	
			//Validar los atributos con campos obligatorios en la tabla de bd.
			if(!$this->validar($objeto)){
				throw new Exception($this->getError());
			}
			//Validamos que la clave no esté vacía.
			if($objeto->getClave() == ""){
				throw new Exception("No se especificó una contraseña para la cuenta.");
			}
			//Validación de cuenta existente
			if($this->existeCuenta($objeto)){
				throw new Exception("La cuenta de usuario (".$objeto->getCuenta().") ya existe");
			}
			//Validación de correo existente
			if($this->existeCorreo($objeto)){
				throw new Exception("El correo de usuario (".$objeto->getCorreo().") ya existe");
			}
			//Preparar la consulta
			if ($stmt = $this->conexion->prepare("insert into usuario values(null,:nombre,:apellido,:correo,:cuenta,:clave,:tipoUsuario,:estado,NOW());")){
				$stmt->bindValue("nombre",$objeto->getNombre(),PDO::PARAM_STR);
                $stmt->bindValue("apellido",$objeto->getApellido(),PDO::PARAM_STR);
                $stmt->bindValue("correo",$objeto->getCorreo(),PDO::PARAM_STR);
                $stmt->bindValue("cuenta",$objeto->getCuenta(),PDO::PARAM_STR);
				$stmt->bindValue("clave",$objeto->getClave(),PDO::PARAM_STR);
                $stmt->bindValue("tipoUsuario",$objeto->getTipoUsuario(),PDO::PARAM_INT);
                $stmt->bindValue("estado",$objeto->getEstado(),PDO::PARAM_INT);
				if($stmt->execute()){
					$objeto->setId((int)$this->conexion->lastInsertId());
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
				$stmt->closeCursor();
			}
			else{
				throw new PDOExpection();
			}
		}

		public function listar($filtros): array{
			$registros = array();
			$sql = 'select SQL_CALC_FOUND_ROWS id, concat(apellido,", ",nombres) as operador, correo, cuenta, tipoUsuario, estado, date_format(user_fecha_alta,"%d-%m-%Y %H:%i:%s") as user_fecha_alta from usuario';
			if($filtros->{"cantidad"} != 0) $sql .= ' limit '.$filtros->{"indice"}.', '.$filtros->{"cantidad"};

			if($stmt = $this->conexion->prepare($sql)){
				if($stmt->execute()){
					$registros = $stmt->fetchAll();
					$stmt->closeCursor();
					//Recuperar el total de filas
					if($stmt = $this->conexion->prepare("select FOUND_ROWS();")){
						if($stmt->execute()){
							$total = $stmt->fetch(PDO::FETCH_NUM);
							$this->setRegistrosAfectados((int)$total[0]);
						}
						else{
							throw new Exception($stmt->errorInfo()[2]);
						}
					}
					else{
						throw new PDOExpection();
					}
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
			}
			else{
				throw new PDOExpection();
			}
			return $registros;
		}

        /* PROBARRRRRRRRRRRRRRRRRRRRRRR
		public function listarMaterial($filtros): array{
			$registros = array();
			$sql = 'select id, ISBN, titulo, autor, edicion, editorial, disciplina from material';
			if($filtros->{"cantidad"} != 0) $sql .= ' limit '.$filtros->{"indice"}.', '.$filtros->{"cantidad"};

			if($stmt = $this->conexion->prepare($sql)){
				if($stmt->execute()){
					$registros = $stmt->fetchAll();
					$stmt->closeCursor();
					//Recuperar el total de filas
					if($stmt = $this->conexion->prepare("select FOUND_ROWS();")){
						if($stmt->execute()){
							$total = $stmt->fetch(PDO::FETCH_NUM);
							$this->setRegistrosAfectados((int)$total[0]);
						}
						else{
							throw new Exception($stmt->errorInfo()[2]);
						}
					}
					else{
						throw new PDOExpection();
					}
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
			}
			else{
				throw new PDOExpection();
			}
			return $registros;
		}
        

		private function validar($objeto): bool{
			if($objeto->getNombre() == ""){
				$this->setError("El formato del nombre es inválido.");
				return false;
			}
            if($objeto->getApellido() == ""){
				$this->setError("El formato del apellido es inválido.");
				return false;
            }
			if($objeto->getCorreo() == ""){
				$this->setError("El formato del correo es inválido.");
				return false;
			}
			if($objeto->getCuenta() == ""){
				$this->setError("El formato del nombre de la cuenta es inválido.");
				return false;
			}
			return true;
		}

		/**
		 * Comprueba si existe una cuenta específica en la bd.
		 *
		 * @param      Operador       $objeto  Cuenta de operador
		 * 
		 * @return     boolean       TRUE si existe la cuenta. FALSE si no la encuentra.
		 * 
		 * @throws     Exception     Mensaje de error de la sentencia preparada.
		 * @throws     PDOExpection  Mensaje de error del driver.
		 
		public function existeCuenta($objeto){
			//Preparar la consulta
			if ($stmt = $this->conexion->prepare("select count(id) as total from usuario where (cuenta = :cuenta) AND (id <> :id);")){
				$stmt->bindValue("cuenta",$objeto->getCuenta(),PDO::PARAM_STR);
				$stmt->bindValue("id",$objeto->getId(),PDO::PARAM_INT);
				if($stmt->execute()){
					$reg = $stmt->fetch();
					if((int)$reg->total == 1){
						$stmt->closeCursor();
						return true;
					} 
					else{
						$stmt->closeCursor();
						return false;
					}
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
				$stmt->closeCursor();
			}
			else{
				throw new PDOExpection();
			}
		}

		/**
		 * Comprueba si existe un correo específica en la bd.
		 *
		 * @param      Usuario       $objeto  Cuenta de usuario
		 * 
		 * @return     boolean       TRUE si existe el correo. FALSE si no lo encuentra.
		 * 
		 * @throws     Exception     Mensaje de error de la sentencia preparada.
		 * @throws     PDOExpection  Mensaje de error del driver.
		 
		public function existeCorreo($objeto){
			//Preparar la consulta
			if ($stmt = $this->conexion->prepare("select count(correo) as total from usuario where (correo = :correo) AND (id <> :id);")){
				$stmt->bindValue("correo",$objeto->getCorreo(),PDO::PARAM_STR);
				$stmt->bindValue("id",$objeto->getId(),PDO::PARAM_INT);
				if($stmt->execute()){
					$reg = $stmt->fetch();
					if((int)$reg->total == 1){
						$stmt->closeCursor();
						return true;
					}
					else {
						$stmt->closeCursor();
						return false;
					}
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
			}
			else{
				throw new PDOExpection();
			}	
		}

		/**
		 * Se autentica el inicio de sesión (Usuario y clave).
		 * @param      Operador  $objeto  Objeto con los datos de autenticación.
		 
		public function login($objeto){
			//Preparar la consulta
			if ($stmt = $this->conexion->prepare("select id, concat(apellido,', ',nombre) as Usuario from usuario where cuenta = :cuenta AND clave = :clave;")){
				if($stmt->execute(array("cuenta" => $objeto->getCuenta(), "clave" => $objeto->getClave()))){
					if($stmt->rowCount() == 1){
						$reg = $stmt->fetch();
						$_SESSION["id"] = (int)$reg->id;
						$_SESSION["cuenta"] = $objeto->getCuenta();
						$_SESSION["Usuario"] = $reg->usuario;
						$_SESSION["perfil"] = "";
						$_SESSION["logueado"] = 2024;
						$stmt->closeCursor();
						$this->conexion = null;
						header("Location:index.php?c=inicio&a=index");
					}
					else{
						throw new Exception("Usuario y/o clave incorrectos.");
					}
				}
				else{
					throw new Exception($stmt->errorInfo()[2]);
				}
			}
			else{
				throw new PDOExpection();
			}
		}
	}
?>
*/
	}