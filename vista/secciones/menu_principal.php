<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="img/combo.png" alt="Reserva Express logo" width="120" height="70"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<!-- item -->
        <li class="nav-item">
          <a class="nav-link" href="index.php?c=Operador&a=index">Búsqueda de libros</a>
        </li>
		<li class="nav-item">
          <a class="nav-link disabled" href="index.php?c=Operador&a=index">Prestamos y Reservas</a>
        </li>
		<li class="nav-item">
          <a class="nav-link disabled" href="index.php?c=Operador&a=index">Informes</a>
        </li>
		<!-- item deshabilitado -->
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Gestión de libros</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="index.php?c=Operador&a=index">Usuarios</a>
        </li>
      </ul>
	  <!-- Form de búsqueda 
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar libro" aria-label="Búsqueda">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
	  -->
	  <!-- Dropdown -->
	  <li class="dropstart">
          <a class="nav-link dropdown-toggle d-flex justify-content-evenly" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
		  	<i class="fa-regular fa-books"></i> Mi Cuenta
          </a>
          <ul class="dropdown-menu">
		  	<li><a class="dropdown-item" href="index.php?c=Operador&a=formConsulta">Configuración</a></li>
			<li><a class="dropdown-item" href="index.php?c=Operador&a=ReservaExpress">Sobre ReservaExpress</a></li>
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="index.php?c=Operador&a=logoff"><i class="fas fa-power-off mr-3"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
    </div>
  </div>
</nav>

<!-- NavBar viejooo
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><img src="img/combo.png" alt="Reserva Express logo" width="180" height="70"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      	<li class="nav-item">
        	<a class="nav-link" href="index.php?c=Operador&a=index">Búsqueda de libros</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link" href="cons.php">Prestamos y reservas</a>
      	</li>
		  <li class="nav-item">
        	<a class="nav-link" href="cons.php">Informes</a>
      	</li>
		  </li>
		  <li class="nav-item">
        	<a class="nav-link" href="cons.php">Gestión de libros</a>
      	</li>
		<li class="nav-item">
        	<a class="nav-link" href="index.php?c=Operador&a=index">Usuarios</a>
      	</li>
    </ul>
	<div class="dropdown">
  		<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
			<i class="fa-light fa-t-rex"></i> Mi Cuenta
		  	<i class="fa-regular fa-books"></i> Mi Cuenta
  		</button>
 		<ul class="dropdown-menu">
			<li><a class="dropdown-item" href="index.php?c=Operador&a=formConsulta">Configuración</a></li>
			<li><a class="dropdown-item" href="index.php?c=Operador&a=ReservaExpress">Sobre ReservaExpress</a></li>
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="index.php?c=Operador&a=logoff"><i class="fas fa-power-off mr-3"></i> Cerrar Sesión</a></li>
  		</ul>
	</div>
    <ul class="nav navbar-nav navbar-right">
    	<li class="nav-item dropdown">
        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-light fa-t-rex"></i>Mi cuenta</a>
        	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                /// REVISAR ITEMS
          		<a class="dropdown-item" href='index.php?c=Operador&a=formConsulta'>Configuración</a>
          		<a class="dropdown-item" href='index.php?c=Operador&a=ReservaExpress'>Sobre ReservaExpress</a>
          		<div class="dropdown-divider"></div>
          		<a class="dropdown-item" href="index.php?c=Operador&a=logoff"><i class="fas fa-power-off mr-3"></i>Cerrar sesión</a>
                /// REVISAR ITEMS
        	</div>
      	</li>
    </ul>
  </div>
</nav>
-->