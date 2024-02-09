<?php
	namespace model\dao;

	class DAO{
		//Atributos
		protected $connection, $error, $affectedRecords;

		//Constructor
		public function __construct($connection){
			$this->connection = $connection;
			$this->setError("");
			$this->setAffectedRecords(1);
		}

		//Getters
		function getError(){
			return $this->error;
		}
		function getAffectedRecords(){
			return $this->affectedRecords;
		}

		//Setters
		function setError($error){
			$this->error = (is_string($error)) ? trim($error) : "";
		}
		function setAffectedRecords($affectedRecords){
			$this->affectedRecords = (is_integer($affectedRecords) && ($affectedRecords > 0)) ? (int)$affectedRecords : 0;
		}
	}