<?php
	namespace model\dao;

	final class Conexion {
		public static function establecer(): object{
			//Extrae datos de lib/config.php
			$conexion = new PDO(
				DB_DSN, 
				DB_USER, 
				DB_PASS, 
				array(
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				)
			);
			if(!$conexion) throw PDOException();
			// $conexion->setAttribute(PDO::ATR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			return $conexion;
		}
	}
?>