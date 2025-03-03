<?php
$res = new ControladorOrdenes;
$cantidad = $res->cantidad($_SESSION["id"]);
$usu = ControladorUsuarios::consultaUsuarios_t();
foreach ($usu as $row => $item) {
  if ($_SESSION["nombre"] == $item[1]) {
    $id = $item[0];
  }
}

if (isset($_POST['nuevo']) && $_POST['nuevo'] === 'busqueda') {
  $nombre = isset($_POST['name']) ? $_POST['name'] : '';
  $nuevo = ControladorProductos::buscarProductos($nombre);
} else {
  $nuevo = ControladorProductos::buscarProductos('');
}
?>

<header>
  <div class="container-fluid">
    <div class="row py-3 border-bottom">
      <div
        class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
        <div class="d-flex align-items-center my-3 my-sm-0">
          <a href="login.php">
            <img src="img/logo.png" alt="logo" style="height: 50px;"
              class="img-fluid">
          </a>
        </div>
        <button class="navbar-toggler" type="button"
          data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar">
          <svg width="24" height="24" viewBox="0 0 24 24">
            <use
              xlink:href="#menu"></use>
          </svg>
        </button>
      </div>

      <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-4">
        <div class="search-bar d-flex align-items-center bg-light p-2 rounded-4">
          <form id="search-form" class="d-flex w-100" action="index.php?seccion=buscar" method="POST">
            <input
              type="text"
              class="form-control border-0 bg-transparent me-2"
              name="name"
              id="name"
              autocomplete="off"
              placeholder="¿Qué estás buscando?">
            <button
              name="nuevo"
              value="busqueda"
              type="submit"
              class="btn p-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
              </svg>
            </button>
          </form>
        </div>
      </div>


      <div class="col-lg-4">
        <ul
          class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
          <li class="nav-item active">
            <?php if ($_SESSION["rol"] == 2) {
              echo '<a href="index.php?seccion=inicio" class="nav-link">Inicio</a>';
            } else {
              echo '<a href="index.php?seccion=inicio_admin" class="nav-link">Inicio</a>';
            } ?>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle pe-3" role="button"
              id="pages" data-bs-toggle="dropdown"
              aria-expanded="false">Hola, <?= $_SESSION['nombre'] ?></a>
            <ul class="dropdown-menu border-0 p-3 rounded-0 shadow"
              aria-labelledby="pages">
              <?php echo '<li><a href="index.php?seccion=detalleUsuarios&idUsuario=' . $id . '" class="dropdown-item">Ver perfil</a></li>' ?>
              <li><a href="logout.php" class="dropdown-item">Salir</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <div
        class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
        <ul class="d-flex justify-content-end list-unstyled m-0">
          <li>
            <a <?php echo 'href="index.php?seccion=detalleUsuarios&idUsuario=' . $id . '"'; ?> class="p-2 mx-1">
              <img src="<?= $_SESSION["img_perfil"] ?>" alt="img_perfil" style="width: 24px; height: 24px; border-radius: 50%; border: 0.5px solid #000;"">
            </a>
          </li>
          <li>
            <a href=" index.php?seccion=ordenes_usuario" class=" p-2 mx-1">
              <svg width="24" height="24">
                <use
                  xlink:href="#wishlist"></use>
              </svg>
            </a>
          </li>
          <li>
            <a href="#" class="p-2 mx-1" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
              <svg width="24" height="24">
                <use
                  xlink:href="#shopping-bag"></use>
                <span class="badge bg-primary rounded-pill"><?= $cantidad ?></span>
              </svg>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </div>
</header>