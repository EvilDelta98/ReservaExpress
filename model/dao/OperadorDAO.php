<?php

	namespace model\dao;

	require_once("InterfaceDAO.php");
	use model\dao\InterfaceDAO;
	require_once("DAO.php");
	use model\dao\DAO;
	require_once "../model/entities/Operador.php";
	use model\entities\Operador;
	require_once "../model/dao/Conexion.php";


	class OperadorDAO extends DAO implements InterfaceDAO{
		//Atributos
		//Constructor

		public function __construct($conexion){
			parent::__construct($conexion);
		}
		//Métodos

		public function load($id){
			$sql = "SELECT * FROM usuario WHERE id = :id";
			$stm = $this->connection->prepare($sql);
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
			$stm = $this->connection->prepare($sql);
			$stm->execute(array(
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
			$stm = $this->connection->prepare($sql);
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
			$stmt = $this->connection->prepare($sql);
			if(!$stmt->execute()){
				//throw new \Exception("No se pudo resetear la clave.");
				throw new \Exception($stmt->errorInfo()[2]);
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function listarPerfiles($filtros){
			$sql = "SELECT * FROM usuario";
			$stmt = $this->connection->prepare($sql);
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
			$stmt = $this->connection->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo eliminar");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public static function login($conexion, $cuenta, $clave): void{
			echo"hola soy logindao";
			$sql = "SELECT id, cuenta, clave, nombre, apellido, estado FROM usuario WHERE cuenta = :cuenta";
			$stm = $conexion->prepare($sql);
			echo"hola soy logindao";
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
			//USAMOS PERFILES? si para saber que mostrarle al abrir el sistema al usuario segun si es admin o no
			$_SESSION["perfil"]=$result->perfilId;
			$_SESSION["id"]=$result->id;
		}

		public static function logout():void{
			session_unset(); //Destruye las variables
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
			$stmt = $this->connection->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo eliminar");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		//¿USAMOS ESTA FUNCIÓN?
		public function buscarPerfil($id){
			$sql = "SELECT * FROM usuario WHERE id = '$id'";
			$stmt = $this->connection->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function list($filtros){
			//REFACCIONAR PARA LISTAR TODOS LOS SOCIOS SEGÚN SU TIPOUSUARIO
			$sql = "SELECT * FROM usuarios_perfiles INNER JOIN usuarios ON usuarios_perfiles.id = usuarios.perfilId";
			$stmt = $this->connection->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function activate($id){
			$sql = "UPDATE 'usuario' SET 'estado' = '1' WHERE 'usuario'.'id' = '$id'";
			$stmt = $this->connection->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo activar la cuenta");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function deactivate($id){
			$sql = "UPDATE 'usuario' SET 'estado' = '0' WHERE 'usuario'.'id' = '$id'";
			$stmt = $this->connection->prepare($sql);
			if(!$stmt->execute()){
				throw new \Exception("No se pudo desactivar la cuenta");
			}
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}
	}
