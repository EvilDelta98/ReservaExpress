<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once "../public/view/includes/head.php";
    ?>
    <script defer type="text/javascript" src="view/prestamo/js/prestamo.js"></script>
</head>
<header style="background-color: blue">
    <?php
        require_once "../public/view/includes/header.php";
    ?>
</header>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Alta de Préstamo</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form-label" id="formAltaPrest" method="POST" action="prestamo/save">
                    <div class="form-group">
                        <label for="datoIdSocio">Socio</label>
                        <input type="number" minlength="10" maxlength="10" class="form-control" id="datoIdSocio" name="datoIdSocio" placeholder="Id Socio">
                    </div>
                    <div class="form-group">
                        <label for="datoIdEjemplar">Ejemplar</label>
                        <input type="number" minlength="10" maxlength="10" class="form-control" id="datoIdEjemplar" name="datoIdEjemplar" placeholder="Id Ejemplar">
                    </div>
                    <div class="form-group">
                        <label for="datoFechaInicio">Fecha de Inicio</label>
                        <!--- REVISAR EXPRESIÓN REGULAR PARA DATE --->
                        <input type="date" min="" pattern="\d{4}-\d{2}-\d{2}" class="form-control" id="datoFechaInicio" name="datoFechaInicio">
                    </div>
                    <div class="form-group">
                        <label for="datoFechaVencimiento">Fecha de Vencimiento</label>
                        <!--- REVISAR EXPRESIÓN REGULAR PARA DATE --->
                        <input type="date" min="" pattern="\d{4}-\d{2}-\d{2}" class="form-control" id="datoFechaVencimiento" name="datoFechaVencimiento">
                    </div>
                    <div class="form-group">
                        <label for="datoFechaDevolucion">Fecha de Devolución</label>
                        <!--- REVISAR EXPRESIÓN REGULAR PARA DATE --->
                        <input type="date" min="" pattern="\d{4}-\d{2}-\d{2}" class="form-control" id="datoFechaDevolucion" name="datoFechaDevolucion">
                    </div>
                    <div class="form-group">
                        <label for="datoEdicion">Edición</label>
                        <input type="number" minlength="1" maxlength="2" class="form-control" id="datoEdicion" name="datoEdicion" placeholder="Edición">
                    </div>
                    <div class="form-group">
                        <label for="datoObservacion">Observación</label>
                        <input type="text" maxlength="255" pattern="[a-zA-ZÀ-ÿ\s]{2,255}" class="form-control" id="datoObservacion" name="datoObservacion" placeholder="Observación">
                    </div>
                    <!--- TIPO DEBERÍA ESTAR? --->
                    <div class="col-sm-2">
                        <label for="selTipo">Tipo de Préstamo</label>
                        <select id="selTipo">
                            <option required>Seleccione:</option>
                            <option value="0">En sala</option>
                            <option value="1">Común</option>
                            <option value="2">Reserva</option>
                        </select>
                    </div>
                    <button id="guardarPrestamo" name="guardarPrestamo" type="button" onclick="sendNewPrestamo()" class="btn btn-success my-4">Guardar</button>
                    <button id="limp" name="limp" type="button" onclick="limpiar(formAltaPrest)" class="btn btn-danger my-4">Limpiar</button>
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