<?php

    namespace model\dao;

    require_once "InterfaceDAO.php";
    use model\dao\InterfaceDAO;
    require_once "DAO.php";
    use model\dao\DAO;
    require_once "../model/entities/Socio.php";
    use model\entities\Socio;
    //¿ESTO QUE ESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS???????????????
    use PgSql\Lob;

    final class SocioDAO extends DAO implements InterfaceDAO{

        public function __construct($conexion){
            parent::__construct($conexion);
        }

        public function load($id): Socio{
            //Consultar para buscar el registro con el id=$id
            $sql= "SELECT * FROM socio WHERE id= :id";
            //preparar la consulta
            $stm = $this->conexion->prepare($sql);
            $stm->execute(array(
                "id"=> $id)
            );

            //cuando haga el select preguntar cuantos registros devolvió la consulta
            if($stm->rowCount() != 1){
                throw new \Exception("No se encontro el socio con el id ". $id );
            }
        
            $result = $stm->fetch();
            $c= new Socio();
            //Hacer todos los setters
            $c->setId($result->id);
            $c->setNombre($result->nombre);
            $c->setApellido($result->apellido);
            $c->setTipoSocio($result->tipoSocio);
            //Debería ir el dato Socio?
            $c->setProvincia($result->provincia);
            $c->setLocalidad($result->localidad);
            $c->setDomicilio($result->domicilio);
            $c->setEstado($result->estado);
            $c->setDni($result->dni);// tiene que coincidir
            $c->setTelefono($result->telefono);
            $c->setCorreo($result->correo);
            
            $c->setFechaAlta($result->fechaAlta);

            return $c;
            
            //si es distinto de uno, excepcion("no se encontró el cliente con el id $x")
            //si lo encontre le hago fetch saco los datos de la consulta
            //crear una entidad nueva, setear los campos y devolver la entidad
        }
        
        public function save($c):void{
            $this->validate($c);
            $this->validateDNI($c);
            $sql = "INSERT INTO socio VALUES(DEFAULT, :nomb, :apell, :tipsoc, :prov, :loc, :dom, :est, :dni, :tel, :correo, NOW())";
            $stm = $this->conexion->prepare($sql);
            $stm->execute(array(
                "nomb" => $c->getNombre(),
                "apell" => $c->getApellido(),
                "tipsoc" => $c->getTipoSocio(),
                "prov" => $c->getProvincia(),
                "loc" => $c->getLocalidad(),
                "dom" => $c->getDomicilio(),
                "est" => $c->getEstado(),
                "dni" => $c->getDni(),
                "tel" => $c->getTelefono(),
                "correo" => $c->getCorreo()
            ));
        }

        //Verifica si el DNI del socio actual o nuevo, existe para otro socio.
        private function validateDNI($c){
            $sql = "SELECT COUNT(*) AS total FROM socio WHERE dni = :dni AND id <> :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(
                "dni" => $c->getDni(),
                "id" => $c->getId()
            ));
            $result = $stmt->fetch();
            if(((int)$result->total) > 0){
                throw new \Exception("El DNI " . $c->getDni() . " ya se encuentra registrado.");
            }
        }

        private function validate($c): void{
            if($c->getNombre() === ""){
                throw new \Exception("El NOMBRE es obligatorio.");
            }
            if($c->getApellido() === ""){
                throw new \Exception("El APELLIDO es obligatorio.");
            }
            if($c->getTipoSocio() === ""){
                throw new \Exception("El TIPO DE SOCIO es obligatorio.");
            }
            if($c->getProvincia() === ""){
                throw new \Exception("La PROVINCIA es obligatorio");
            }
            if($c->getLocalidad() === ""){
                throw new \Exception("La LOCALIDAD es obligatorio");
            }
            if($c->getDomicilio() === ""){
                throw new \Exception("El DOMICILIO es obligatorio");
            }
            if($c->getEstado() === ""){
                throw new \Exception("El ESTADO es obligatorio");
            }
            if($c->getDni() === ""){
                throw new \Exception("El DNI es obligatorio.");
            }
            if($c->getTelefono() === ""){
                throw new \Exception("El TELEFONO es obligatorio");
            }
            if($c->getCorreo() === ""){
                throw new \Exception("El CORREO es obligatorio");
            }
        }

        public function delete($id){
            $sql= "DELETE FROM socio WHERE id = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("No se pudo eliminar");
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function update($c){
            $nom= $c->getNombre();
            $ap= $c->getApellido();
            $tipsoc= $c->getTipoSocio();
            $prov= $c->getProvincia();
            $localidad=$c->getLocalidad();
            $dom= $c->getDomicilio();
            $est= $c->getEstado();
            $dni= $c->getDni();
            $tel=$c->getTelefono();
            $corr=$c->getCorreo();
            $id=$c->getId();

            $sql= "UPDATE `clientes` SET `nombre`='$nom', `apellido`='$ap', `tipoSocio`='$tipsoc', `provincia`='$prov', `localidad`='$localidad', `domicilio`='$dom', `estado`='$est', `dni`='$dni', `telefono`='$tel', `correo`='$corr' WHERE `socio`.`id` = '$id'";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("No se pudo eliminar");
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function list($filtros){
            $sql = "SELECT * ,DATE_FORMAT(fechaAlta,'%d-%m-%Y') as fechaAltaFormat FROM socio ORDER BY apellido ASC, nombre ASC";
            $stmt = $this->conexion->prepare($sql);
            if(!$stmt->execute()){
                throw new \Exception("No se pudo ejecutar la consulta de LISTAR");
            }
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
}