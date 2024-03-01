<?php
    namespace model\dao;

    require_once("InterfaceDAO.php");
    use model\dao\InterfaceDAO;
    require_once("DAO.php");
    use model\dao\DAO;
    require_once "../model/entities/Prestamo.php";
    use model\entities\Prestamo;

    class PrestamoDAO extends DAO implements InterfaceDAO{
        //Constructor
        public function __construct($conexion){
            parent::__construct($conexion);
        }

        //Métodos
        public function load($id){
            $c = null;
            $sql = "SELECT * FROM prestamo WHERE id = :id";
            $parametros = array(
                ":id" => $id
            );
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute($parametros);
            if(count($stmt) > 0){
                $c = new Prestamo();
                $c->setId($stmt[0]["id"]);
                $c->setIdSocio($stmt[0]["socio"]);
                $c->setIdEjemplar($stmt[0]["ejemplar"]);
                $c->setFechaInicio($stmt[0]["fechaInicio"]);
                $c->setFechaVencimiento($stmt[0]["fechaVencimiento"]);
                $c->setFechaDevolucion($stmt[0]["fechaDevolucion"]);
                $c->setObservacion($stmt[0]["observacion"]);
                $c->setEstado($stmt[0]["estado"]);
                $c->setTipo($stmt[0]["tipo"]);
            }
            else{
                throw new \Exception("No se encontró el registro solicitado con el id ". $id);
            }
            return $c;
        }

        public function save($c){
            $this->validate($c);
            $sql = "INSERT INTO prestamo (id, socio, ejemplar, fechaInicio, fechaVencimiento, fechaDevolucion, observacion, estado, tipo) VALUES (DEFAULT, :socio, :ejemplar, :fechaInicio, :fechaVencimiento, :fechaDevolucion, :observacion, :estado, :tipo)";
            $stmt = $this->conexion->prepare($sql);
            $parametros = array(":socio" => $c->getIdSocio(), ":ejemplar" => $c->getIdEjemplar(), ":fechaInicio" => $c->getFechaInicio(), ":fechaVencimiento" => $c->getFechaVencimiento(), ":fechaDevolucion" => $c->getFechaDevolucion(), ":observacion" => $c->getObservacion(), ":estado" => $c->getEstado(), ":tipo" => $c->getTipo());
            $stmt->execute($parametros);
        }
        
        private function validate($c){
            if($c->getIdSocio() == null || $c->getIdSocio() == ""){
                throw new \Exception("El IdSocio no puede estar vacío");
            }
            if($c->getIdEjemplar() == null || $c->getIdEjemplar() == ""){
                throw new \Exception("El IdEjemplar no puede estar vacío");
            }
            if($c->getFechaInicio() == null || $c->getFechaInicio() == ""){
                throw new \Exception("La fecha de inicio no puede estar vacía");
            }
            if($c->getFechaVencimiento() == null || $c->getFechaVencimiento() == ""){
                throw new \Exception("La fecha de vencimiento no puede estar vacía");
            }
            if($c->getFechaDevolucion() == null || $c->getFechaDevolucion() == ""){
                throw new \Exception("La fecha de devolución no puede estar vacía");
            }
            if($c->getObservacion() == null || $c->getObservacion() == ""){
                throw new \Exception("La observación no puede estar vacía");
            }
            //¿DEBERÍA SER NECESARIO LLENAR EL ESTADO? ¿NO DEBERÍA SER DISPONIBLE POR DEFAULT?
            if($c->getEstado() == null || $c->getEstado() == ""){
                throw new \Exception("El estado no puede estar vacío");
            }
            if($c->getTipo() == null || $c->getTipo() == ""){
                throw new \Exception("El tipo no puede estar vacío");
            }
        }

        public function delete($id){
            $sql = "DELETE FROM prestamo WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al eliminar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function update($c){
            $socio = $c->getIdSocio();
            $ejemplar = $c->getIdEjemplar();
            $fechaInicio = $c->getFechaInicio();
            $fechaVencimiento = $c->getFechaVencimiento();
            $fechaDevolucion = $c->getFechaDevolucion();
            $observacion = $c->getObservacion();
            $estado = $c->getEstado();
            $tipo = $c->getTipo();
            $id = $c->getId();

            $sql = "UPDATE prestamo SET socio = '$socio', ejemplar = '$ejemplar', fechaInicio = '$fechaInicio', fechaVencimiento = '$fechaVencimiento', fechaDevolucion = '$fechaDevolucion', observacion = '$observacion', estado = '$estado', tipo = '$tipo' WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al actualizar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function list($filtros){
            $sql = "SELECT * FROM prestamo";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al listar los registros");
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        //REVISAR ESTA LÍNEAAAAAAAAAAAAAAAAAAAAAAAAAASSSSSSSSSSSSSSSSSSSSSS
        public function activate($id){
            $sql = "UPDATE prestamo SET estado = '0' WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al activar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function deactivate($id){
            $sql = "UPDATE prestamo SET estado = '1' WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("Error al desactivar el registro con id ". $id);
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
