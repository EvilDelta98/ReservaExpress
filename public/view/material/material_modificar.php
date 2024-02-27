<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/material/js/material.js"></script>
</head>
<header>
    <?php
        require_once "../public/view/includes/header.php";
    ?>
</header>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Modificar Material</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form-label" id="formModificarMat" name="formModificarMat" method="POST" action="material/update">
                    <div class="form-group">
                        <label for="datoISBN">ISBN</label>
                        <input type="text" required minlength="17" maxlength="17" class="form-control" id="datoISBN" name="datoISBN" value="<?= $c->getISBN() ?>">
                    </div>
                    <div class="form-group">
                        <label for="datoTitulo">Título</label>
                        <input type="text" required minlength="2" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{2,255}" class="form-control" id="datoTitulo" name="datoTitulo" value="<?= $c->getTitulo() ?>">
                    </div>
                    <div class="form-group">
                        <label for="datoAutor">Autor</label>
                        <input type="text" required minlength="3" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{3,255}" class="form-control" id="datoAutor" name="datoAutor" value="<?= $c->getAutor() ?>">
                    </div>
                    <div class="form-group">
                        <label for="datoEdicion">Edición</label>
                        <input type="number" required minlength="1" maxlength="2" class="form-control" id="datoEdicion" name="datoEdicion" value="<?= $c->getEdicion() ?>">
                    </div>
                    <div class="form-group">
                        <label for="datoEditorial">Editorial</label>
                        <input type="text" required minlength="2" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{2,255}" class="form-control" id="datoEditorial" name="datoEditorial" value="<?= $c->getEditorial() ?>">
                    </div>
                    <div class="form-group">
                        <label for="datoDisciplina">Disciplina</label>
                        <input type="text" required minlength="3" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{3,255}" class="form-control" id="datoDisciplina" name="datoDisciplina" value="<?= $c->getDisciplina() ?>">
                    </div>
                    <div class="form-group">
                        <label for="datoCantEjemplares">Cantidad de Ejemplares</label>
                        <input type="number" required minlength="1" maxlength="3" class="form-control" id="datoCantEjemplares" name="datoCantEjemplares" value="<?= $c->getCantEjemplares() ?>">
                    </div>
                    <div class="form-group">
                        <label for="datoEstado">Estado</label>}
                        <select name="datoEstado" id="datoEstado" required>
                        <?php
                            if($c->getEstado()==0){
                                echo'<option>Seleccionar</option>';
                                echo'  <option  selected value="0" > Disponible </option>';
                                echo'  <option  value="1" > No disponible </option>';
                            }
                            else{
                                echo'<option>Seleccionar</option>';
                                echo'  <option value="0">Disponible</option>';
                                echo'  <option selected value="1">No disponible</option>';
                            }
                        ?>
                        </select>
                    </div>

                    <input value="<?= $c->getId() ?>" type="hidden" name="datoId" id="datoId">

                    <button id="guardarMaterial" name="modificaguardarMaterialrMaterial" type="button" onclick="actualizar(<?= $data ?>)" class="btn btn-success my-4">Modificar</button>
                    <button id="limp" name="limp" type="button" onclick="limpiar(formModificarMat)" class="btn btn-danger my-4">Limpiar</button>
                </form>
                <a href="public" class="btn btn-primary my-4">Volver</a>
            </div>
        </div>
    </div>
</body>
<footer>
    <?php
        require_once "../public/view/includes/footer.php";
    ?>
</footer>
</html>