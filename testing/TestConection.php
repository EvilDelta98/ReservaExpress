<?php
    require_once "../model/dao/Conexion.php";
    use model\dao\Conexion as Conexion;

    try{
        $conexion = Conexion::establecer();

        $sql = "INSERT INTO clientes VALUES(DEFAULT, :apell, :nomb, :dni, :dom, :prov, :loc, :cp, :tel, :correo, NOW())";
        $stm = $conexion->prepare($sql);

        $stm->execute(array(
            "apell" => "Rasjido",
            "nomb" => "Pepito",
            "dni" => "26555444",
            "dom" => "Centro",
            "prov" => "Chubut",
            "loc" => "Comodoro Rivadavia",
            "cp" => "9011",
            "tel" => "4850000",
            "correo" => "jrasjido@gmail.com"
        ));

        echo '<p>Se registró un nuevo cliente</p>';

    }
    catch(\PDOException $ex){
        echo '<p>No se pudo registrar el cliente</p>';
        echo '<p>' . $ex->getMessage() . '</p>';
    }
    catch(\Exception $ex){
        echo '<p>Error al registrar el cliente, contacte a su administrador</p>';
    }

    print_r($conexion);

