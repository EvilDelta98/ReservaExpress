<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/material/js/material.js"></script>
</head>
<header style="background-color: red">
    <?php
        require_once "../public/view/includes/header.php";
    ?>
</header>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Alta de Material</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form-label" id="formAltaMat" method="POST" action="material/save">
                    <div class="form-group">
                        <label for="datoISBN">ISBN</label>
                        <input type="text" minlength="17" maxlength="17" class="form-control" id="datoISBN" name="datoISBN" placeholder="ISBN">
                    </div>
                    <div class="form-group">
                        <label for="datoTitulo">Título</label>
                        <input type="text" minlength="2" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{2,255}" class="form-control" id="datoTitulo" name="datoTitulo" placeholder="Título">
                    </div>
                    <div class="form-group">
                        <label for="datoAutor">Autor</label>
                        <input type="text" minlength="3" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{3,255}" class="form-control" id="datoAutor" name="datoAutor" placeholder="Autor">
                    </div>
                    <div class="form-group">
                        <label for="datoEdicion">Edición</label>
                        <input type="number" minlength="1" maxlength="2" class="form-control" id="datoEdicion" name="datoEdicion" placeholder="Edición">
                    </div>
                    <div class="form-group">
                        <label for="datoEditorial">Editorial</label>
                        <input type="text" minlength="2" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{2,255}" class="form-control" id="datoEditorial" name="datoEditorial" placeholder="Editorial">
                    </div>
                    <div class="form-group">
                        <label for="datoDisciplina">Disciplina</label>
                        <input type="text" minlength="3" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{3,255}" class="form-control" id="datoDisciplina" name="datoDisciplina" placeholder="Disciplina">
                    </div>
                    <div class="form-group">
                        <label for="datoCantEjemplares">Cantidad de Ejemplares</label>
                        <input type="number" minlength="1" maxlength="3" class="form-control" id="datoCantEjemplares" name="datoCantEjemplares" placeholder="Cantidad de Ejemplares">
                    </div>
                    <button id="guardarMaterial" name="guardarMaterial" type="button" onclick="sendNewMaterial()" class="btn btn-success my-4">Guardar</button>
                    <button id="limp" name="limp" type="button" onclick="limpiar(formAltaMat)" class="btn btn-danger my-4">Limpiar</button>
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