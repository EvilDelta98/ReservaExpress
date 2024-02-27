<?php
    namespace model\dao;

    require_once("InterfaceDAO.php");
    use model\dao\InterfaceDAO;
    require_once("DAO.php");
    use model\dao\DAO;
    require_once "../model/entities/Material.php";
    use model\entities\Material;

    class MaterialDAO extends DAO implements InterfaceDAO{
        //Constructor
        public function __construct($conexion){
            parent::__construct($conexion);
        }

        //Métodos
        public function load($id){
            $c = null;
            $sql = "SELECT * FROM material WHERE id = :id";
            $parametros = array(
                ":id" => $id
            );
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute($parametros);
            if(count($stmt) > 0){
                $c = new Material();
                $c->setId($stmt[0]["id"]);
                $c->setISBN($stmt[0]["isbn"]);
                $c->setTitulo($stmt[0]["titulo"]);
                $c->setAutor($stmt[0]["autor"]);
                $c->setEdicion($stmt[0]["edicion"]);
                $c->setEditorial($stmt[0]["editorial"]);
                $c->setDisciplina($stmt[0]["disciplina"]);
                $c->setCantEjemplares($stmt[0]["cantEjemplares"]);
                $c->setEstado($stmt[0]["estado"]);
            }
            else{
                throw new \Exception("No se encontró el registro solicitado con el id ". $id);
            }
            return $c;
        }

        public function save($c){
            $this->validate($c);
            $sql = "INSERT INTO material (id, isbn, titulo, autor, edicion, editorial, disciplina, cantEjemplares, estado) VALUES (DEFAULT, :isbn, :titulo, :autor, :edicion, :editorial, :disciplina, :cantEjemplares, :estado)";
            $stmt = $this->conexion->prepare($sql);
            $parametros = array(":isbn" => $c->getISBN(), ":titulo" => $c->getTitulo(), ":autor" => $c->getAutor(), ":edicion" => $c->getEdicion(), ":editorial" => $c->getEditorial(), ":disciplina" => $c->getDisciplina(), ":cantEjemplares" => $c->getCantEjemplares(), ":estado" => $c->getEstado());
            $stmt->execute($parametros);
        }
        
        private function validate($c){
            if($c->getISBN() == null || $c->getISBN() == ""){
                throw new \Exception("El ISBN no puede estar vacío");
            }
            if($c->getTitulo() == null || $c->getTitulo() == ""){
                throw new \Exception("El título no puede estar vacío");
            }
            if($c->getAutor() == null || $c->getAutor() == ""){
                throw new \Exception("El autor no puede estar vacío");
            }
            if($c->getEdicion() == null || $c->getEdicion() == ""){
                throw new \Exception("La edición no puede estar vacía");
            }
            if($c->getEditorial() == null || $c->getEditorial() == ""){
                throw new \Exception("La editorial no puede estar vacía");
            }
            if($c->getDisciplina() == null || $c->getDisciplina() == ""){
                throw new \Exception("La disciplina no puede estar vacía");
            }
            if($c->getCantEjemplares() == null || $c->getCantEjemplares() == ""){
                throw new \Exception("La cantidad de ejemplares no puede estar vacía");
            }
            //¿DEBERÍA SER NECESARIO LLENAR EL ESTADO? ¿NO DEBERÍA SER DISPONIBLE POR DEFAULT?
            if($c->getEstado() == null || $c->getEstado() == ""){
                throw new \Exception("El estado no puede estar vacío");
            }
        }

        public function delete($id){
            $sql = "DELETE FROM material WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al eliminar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function update($c){
            $isbn = $c->getISBN();
            $titulo = $c->getTitulo();
            $autor = $c->getAutor();
            $edicion = $c->getEdicion();
            $editorial = $c->getEditorial();
            $disciplina = $c->getDisciplina();
            $cantEjemplares = $c->getCantEjemplares();
            $estado = $c->getEstado();
            $id = $c->getId();

            $sql = "UPDATE material SET isbn = '$isbn', titulo = '$titulo', autor = '$autor', edicion = '$edicion', editorial = '$editorial', disciplina = '$disciplina', cantEjemplares = '$cantEjemplares', estado = '$estado' WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al actualizar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function list($filtros){
            $sql = "SELECT * FROM material";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al listar los registros");
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function activate($id){
            $sql = "UPDATE material SET estado = '0' WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al activar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function deactivate($id){
            $sql = "UPDATE material SET estado = '1' WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al desactivar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
