<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Inicio | Guerrerito</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="author" content>
  <meta name="keywords" content>
  <meta name="description" content>

  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
    crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/vendor.css">
  <link rel="stylesheet" type="text/css" href="style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="bookmark" href="favicon_16.ico" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Notificaciones con Sweet alert -->
  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
  <!-- icono -->
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <!-- DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link href="DataTables/datatables.css" rel="stylesheet">
  <script src="DataTables/datatables.js"></script>

</head>

<body>

  <?php
  include 'modelo/conexion.php';
  include 'controlador/ControladorUsuarios.php';
  include 'controlador/ControladorProductos.php';
  include 'controlador/ControladorOrdenes.php';
  include 'controlador/ControladorCategorias.php';
  include 'modelo/ModeloUsuarios.php';
  include 'modelo/ModeloProductos.php';
  include 'modelo/ModeloOrdenes.php';
  include 'modelo/ModeloCategorias.php';
  ?>

  <?php
  $producto = ControladorProductos::consultaProductosview();
  $nuevo = new ControladorOrdenes;
  $nuevo->add_cart();
  $editar = new ControladorOrdenes;
  $editar->update_cantidad();
  $verificar = new ControladorOrdenes;
  $cat = ControladorCategorias::consultaCategorias();
  // Definir la cantidad de productos por página
  $productos_por_pagina = 9;

  // Obtener el número total de productos
  $total_productos = count($producto);

  // Calcular el número total de páginas
  $total_paginas = ceil($total_productos / $productos_por_pagina);

  // Obtener la página actual de la URL, si no está definida, es la página 1
  $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

  // Asegurarse de que la página actual esté dentro de los límites válidos
  if ($pagina_actual < 1) {
    $pagina_actual = 1;
  } elseif ($pagina_actual > $total_paginas) {
    $pagina_actual = $total_paginas;
  }
  $producto_li = ControladorProductos::consultaProductosviewLimit();
  ?>

  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <defs>
      <symbol xmlns="http://www.w3.org/2000/svg" id="facebook"
        viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V7.05c0-1.05.28-1.73 1.76-1.73Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="twitter"
        viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M22.991 3.95a1 1 0 0 0-1.51-.86a7.48 7.48 0 0 1-1.874.794a5.152 5.152 0 0 0-3.374-1.242a5.232 5.232 0 0 0-5.223 5.063a11.032 11.032 0 0 1-6.814-3.924a1.012 1.012 0 0 0-.857-.365a.999.999 0 0 0-.785.5a5.276 5.276 0 0 0-.242 4.769l-.002.001a1.041 1.041 0 0 0-.496.89a3.042 3.042 0 0 0 .027.439a5.185 5.185 0 0 0 1.568 3.312a.998.998 0 0 0-.066.77a5.204 5.204 0 0 0 2.362 2.922a7.465 7.465 0 0 1-3.59.448A1 1 0 0 0 1.45 19.3a12.942 12.942 0 0 0 7.01 2.061a12.788 12.788 0 0 0 12.465-9.363a12.822 12.822 0 0 0 .535-3.646l-.001-.2a5.77 5.77 0 0 0 1.532-4.202Zm-3.306 3.212a.995.995 0 0 0-.234.702c.01.165.009.331.009.488a10.824 10.824 0 0 1-.454 3.08a10.685 10.685 0 0 1-10.546 7.93a10.938 10.938 0 0 1-2.55-.301a9.48 9.48 0 0 0 2.942-1.564a1 1 0 0 0-.602-1.786a3.208 3.208 0 0 1-2.214-.935q.224-.042.445-.105a1 1 0 0 0-.08-1.943a3.198 3.198 0 0 1-2.25-1.726a5.3 5.3 0 0 0 .545.046a1.02 1.02 0 0 0 .984-.696a1 1 0 0 0-.4-1.137a3.196 3.196 0 0 1-1.425-2.673c0-.066.002-.133.006-.198a13.014 13.014 0 0 0 8.21 3.48a1.02 1.02 0 0 0 .817-.36a1 1 0 0 0 .206-.867a3.157 3.157 0 0 1-.087-.729a3.23 3.23 0 0 1 3.226-3.226a3.184 3.184 0 0 1 2.345 1.02a.993.993 0 0 0 .921.298a9.27 9.27 0 0 0 1.212-.322a6.681 6.681 0 0 1-1.026 1.524Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="youtube"
        viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M23 9.71a8.5 8.5 0 0 0-.91-4.13a2.92 2.92 0 0 0-1.72-1A78.36 78.36 0 0 0 12 4.27a78.45 78.45 0 0 0-8.34.3a2.87 2.87 0 0 0-1.46.74c-.9.83-1 2.25-1.1 3.45a48.29 48.29 0 0 0 0 6.48a9.55 9.55 0 0 0 .3 2a3.14 3.14 0 0 0 .71 1.36a2.86 2.86 0 0 0 1.49.78a45.18 45.18 0 0 0 6.5.33c3.5.05 6.57 0 10.2-.28a2.88 2.88 0 0 0 1.53-.78a2.49 2.49 0 0 0 .61-1a10.58 10.58 0 0 0 .52-3.4c.04-.56.04-3.94.04-4.54ZM9.74 14.85V8.66l5.92 3.11c-1.66.92-3.85 1.96-5.92 3.08Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="instagram"
        viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M17.34 5.46a1.2 1.2 0 1 0 1.2 1.2a1.2 1.2 0 0 0-1.2-1.2Zm4.6 2.42a7.59 7.59 0 0 0-.46-2.43a4.94 4.94 0 0 0-1.16-1.77a4.7 4.7 0 0 0-1.77-1.15a7.3 7.3 0 0 0-2.43-.47C15.06 2 14.72 2 12 2s-3.06 0-4.12.06a7.3 7.3 0 0 0-2.43.47a4.78 4.78 0 0 0-1.77 1.15a4.7 4.7 0 0 0-1.15 1.77a7.3 7.3 0 0 0-.47 2.43C2 8.94 2 9.28 2 12s0 3.06.06 4.12a7.3 7.3 0 0 0 .47 2.43a4.7 4.7 0 0 0 1.15 1.77a4.78 4.78 0 0 0 1.77 1.15a7.3 7.3 0 0 0 2.43.47C8.94 22 9.28 22 12 22s3.06 0 4.12-.06a7.3 7.3 0 0 0 2.43-.47a4.7 4.7 0 0 0 1.77-1.15a4.85 4.85 0 0 0 1.16-1.77a7.59 7.59 0 0 0 .46-2.43c0-1.06.06-1.4.06-4.12s0-3.06-.06-4.12ZM20.14 16a5.61 5.61 0 0 1-.34 1.86a3.06 3.06 0 0 1-.75 1.15a3.19 3.19 0 0 1-1.15.75a5.61 5.61 0 0 1-1.86.34c-1 .05-1.37.06-4 .06s-3 0-4-.06a5.73 5.73 0 0 1-1.94-.3a3.27 3.27 0 0 1-1.1-.75a3 3 0 0 1-.74-1.15a5.54 5.54 0 0 1-.4-1.9c0-1-.06-1.37-.06-4s0-3 .06-4a5.54 5.54 0 0 1 .35-1.9A3 3 0 0 1 5 5a3.14 3.14 0 0 1 1.1-.8A5.73 5.73 0 0 1 8 3.86c1 0 1.37-.06 4-.06s3 0 4 .06a5.61 5.61 0 0 1 1.86.34a3.06 3.06 0 0 1 1.19.8a3.06 3.06 0 0 1 .75 1.1a5.61 5.61 0 0 1 .34 1.9c.05 1 .06 1.37.06 4s-.01 3-.06 4ZM12 6.87A5.13 5.13 0 1 0 17.14 12A5.12 5.12 0 0 0 12 6.87Zm0 8.46A3.33 3.33 0 1 1 15.33 12A3.33 3.33 0 0 1 12 15.33Z" />
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="amazon"
        viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M1.04 17.52q.1-.16.32-.02a21.308 21.308 0 0 0 10.88 2.9a21.524 21.524 0 0 0 7.74-1.46q.1-.04.29-.12t.27-.12a.356.356 0 0 1 .47.12q.17.24-.11.44q-.36.26-.92.6a14.99 14.99 0 0 1-3.84 1.58A16.175 16.175 0 0 1 12 22a16.017 16.017 0 0 1-5.9-1.09a16.246 16.246 0 0 1-4.98-3.07a.273.273 0 0 1-.12-.2a.215.215 0 0 1 .04-.12Zm6.02-5.7a4.036 4.036 0 0 1 .68-2.36A4.197 4.197 0 0 1 9.6 7.98a10.063 10.063 0 0 1 2.66-.66q.54-.06 1.76-.16v-.34a3.562 3.562 0 0 0-.28-1.72a1.5 1.5 0 0 0-1.32-.6h-.16a2.189 2.189 0 0 0-1.14.42a1.64 1.64 0 0 0-.62 1a.508.508 0 0 1-.4.46L7.8 6.1q-.34-.08-.34-.36a.587.587 0 0 1 .02-.14a3.834 3.834 0 0 1 1.67-2.64A6.268 6.268 0 0 1 12.26 2h.5a5.054 5.054 0 0 1 3.56 1.18a3.81 3.81 0 0 1 .37.43a3.875 3.875 0 0 1 .27.41a2.098 2.098 0 0 1 .18.52q.08.34.12.47a2.856 2.856 0 0 1 .06.56q.02.43.02.51v4.84a2.868 2.868 0 0 0 .15.95a2.475 2.475 0 0 0 .29.62q.14.19.46.61a.599.599 0 0 1 .12.32a.346.346 0 0 1-.16.28q-1.66 1.44-1.8 1.56a.557.557 0 0 1-.58.04q-.28-.24-.49-.46t-.3-.32a4.466 4.466 0 0 1-.29-.39q-.2-.29-.28-.39a4.91 4.91 0 0 1-2.2 1.52a6.038 6.038 0 0 1-1.68.2a3.505 3.505 0 0 1-2.53-.95a3.553 3.553 0 0 1-.99-2.69Zm3.44-.4a1.895 1.895 0 0 0 .39 1.25a1.294 1.294 0 0 0 1.05.47a1.022 1.022 0 0 0 .17-.02a1.022 1.022 0 0 1 .15-.02a2.033 2.033 0 0 0 1.3-1.08a3.13 3.13 0 0 0 .33-.83a3.8 3.8 0 0 0 .12-.73q.01-.28.01-.92v-.5a7.287 7.287 0 0 0-1.76.16a2.144 2.144 0 0 0-1.76 2.22Zm8.4 6.44a.626.626 0 0 1 .12-.16a3.14 3.14 0 0 1 .96-.46a6.52 6.52 0 0 1 1.48-.22a1.195 1.195 0 0 1 .38.02q.9.08 1.08.3a.655.655 0 0 1 .08.36v.14a4.56 4.56 0 0 1-.38 1.65a3.84 3.84 0 0 1-1.06 1.53a.302.302 0 0 1-.18.08a.177.177 0 0 1-.08-.02q-.12-.06-.06-.22a7.632 7.632 0 0 0 .74-2.42a.513.513 0 0 0-.08-.32q-.2-.24-1.12-.24q-.34 0-.8.04q-.5.06-.92.12a.232.232 0 0 1-.16-.04a.065.065 0 0 1-.02-.08a.153.153 0 0 1 .02-.06Z" />
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="menu"
        viewBox="0 0 24 24">
        <path fill="currentColor"
          d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1m0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1m1 5.033a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2z" />
      </symbol>

      <symbol xmlns="http://www.w3.org/2000/svg" id="user"
        viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor"
          stroke-width="1.5">
          <circle cx="12" cy="9" r="3" />
          <circle cx="12"
            cy="12" r="10" />
          <path stroke-linecap="round"
            d="M17.97 20c-.16-2.892-1.045-5-5.97-5s-5.81 2.108-5.97 5" />
        </g>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="wishlist"
        viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor"
          stroke-width="1.5">
          <path
            d="M21 16.09v-4.992c0-4.29 0-6.433-1.318-7.766C18.364 2 16.242 2 12 2C7.757 2 5.636 2 4.318 3.332C3 4.665 3 6.81 3 11.098v4.993c0 3.096 0 4.645.734 5.321c.35.323.792.526 1.263.58c.987.113 2.14-.907 4.445-2.946c1.02-.901 1.529-1.352 2.118-1.47c.29-.06.59-.06.88 0c.59.118 1.099.569 2.118 1.47c2.305 2.039 3.458 3.059 4.445 2.945c.47-.053.913-.256 1.263-.579c.734-.676.734-2.224.734-5.321Z" />
          <path
            stroke-linecap="round" d="M15 6H9" />
        </g>
      </symbol>
      <symbol xmlns="http://www.w3.org/2000/svg" id="shopping-bag"
        viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor"
          stroke-width="1.5">
          <path
            d="M3.864 16.455c-.858-3.432-1.287-5.147-.386-6.301C4.378 9 6.148 9 9.685 9h4.63c3.538 0 5.306 0 6.207 1.154c.901 1.153.472 2.87-.386 6.301c-.546 2.183-.818 3.274-1.632 3.91c-.814.635-1.939.635-4.189.635h-4.63c-2.25 0-3.375 0-4.189-.635c-.814-.636-1.087-1.727-1.632-3.91Z" />
          <path
            d="m19.5 9.5l-.71-2.605c-.274-1.005-.411-1.507-.692-1.886A2.5 2.5 0 0 0 17 4.172C16.56 4 16.04 4 15 4M4.5 9.5l.71-2.605c.274-1.005.411-1.507.692-1.886A2.5 2.5 0 0 1 7 4.172C7.44 4 7.96 4 9 4" />
          <path
            d="M9 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2h-4a1 1 0 0 1-1-1Z" />
          <path
            stroke-linecap="round" stroke-linejoin="round"
            d="M8 13v4m8-4v4m-4-4v4" />
        </g>
      </symbol>

    </defs>
  </svg>

  <div class="preloader-wrapper">
    <div class="preloader">
    </div>
  </div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">

    <div class="offcanvas-header justify-content-between">
      <h4 class="fw-normal text-uppercase fs-6">Menu</h4>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

      <ul
        class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
        <!-- Aqui empieza el item -->
        <li class="nav-item border-dashed">
          <a href="login.php" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-sign-in-alt" style="font-size: 15px;"></i>
            <span>Iniciar sesión</span>
          </a>
        </li>
        <!-- Aqui termina -->
        <li class="nav-item border-dashed">
          <a href="registroUsuario_publico.php" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <!-- Icono de usuario de Font Awesome para representar "Registrarse" -->
            <i class="fas fa-user-plus" style="font-size: 15px;"></i>
            <span>Regístrate</span>
          </a>
        </li>

      </ul>

    </div>

  </div>

  <header>
    <div class="container-fluid">
      <div class="row py-3 border-bottom">
        <div
          class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
          <div class="d-flex align-items-center my-3 my-sm-0">
            <a href="index.html">
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
          <div class="search-bar row bg-light p-2 rounded-4">

            <div class="col-11 col-md-11">
              <form id="search-form" class="text-center" action="login.php"
                method="post">
                <input type="text"
                  class="form-control border-0 bg-transparent"
                  placeholder="Buscar">
              </form>
            </div>
            <div class="col-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <ul
            class="navbar-nav list-unstyled d-flex flex-row gap-3 gap-lg-5 justify-content-center flex-wrap align-items-center mb-0 fw-bold text-uppercase text-dark">
            <li class="nav-item active">
              <a href="inicio_publico.php" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle pe-3" role="button"
                id="pages" data-bs-toggle="dropdown"
                aria-expanded="false">Pagínas</a>
              <ul class="dropdown-menu border-0 p-3 rounded-0 shadow"
                aria-labelledby="pages">
                <li><a href="login.php" class="dropdown-item">Iniciar sesión</a></li>
                <li><a href="registroUsuario_publico.php" class="dropdown-item">Regístrarse</a></li>
              </ul>
            </li>
          </ul>
        </div>

        <div
          class="col-sm-8 col-lg-2 d-flex gap-5 align-items-center justify-content-center justify-content-sm-end">
          <ul class="d-flex justify-content-end list-unstyled m-0">
            <li>
              <a href="#" class="p-2 mx-1">
                <svg width="24" height="24">
                  <use
                    xlink:href="#user"></use>
                </svg>
              </a>
            </li>
            <li>
              <a href="#" class="p-2 mx-1">
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
                </svg>
              </a>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </header>

  <section
    style="background-image: url('img/banner.jpg');background-repeat: no-repeat;background-size: cover;">
    <div class="container-lg">
      <div class="row">
        <div class="col-lg-6 pt-5 mt-5">
          <h2 class="display-1 ls-1"><span
              class="fw-bold text-primary">Gorditas al carbón</span>
            "EL GUERRERITO"</h2>
          <p class="fs-4">Gómez Palacio</p>
          <div class="d-flex gap-3">
            <a href="login.php"
              class="btn btn-primary text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">Inicia
              sesión</a>
            <a href="registroUsuario_publico.php"
              class="btn btn-dark text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">¡Registrate
              ahora!</a>
          </div>
          <div class="row my-5">
            <div class="col">
              <div class="row text-dark">
                <div class="col-auto">
                  <p
                    class="fs-1 fw-bold lh-sm mb-0">20+</p>
                </div>
                <div class="col">
                  <p class="text-uppercase lh-sm mb-0">Años a
                    tu servicio</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row text-dark">
                <div class="col-auto">
                  <p
                    class="fs-1 fw-bold lh-sm mb-0">1.1k+</p>
                </div>
                <div class="col">
                  <p class="text-uppercase lh-sm mb-0">Clientes
                    felices</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>


  <section id="latest-products" class="products-carousel">
    <div class="container-lg overflow-hidden pb-5">
      <div class="row">
        <div class="col-md-12">
          <div class="section-header d-flex justify-content-between my-4">
            <h2 class="section-title">Nuestros productos</h2>
            <div class="d-flex align-items-center">
              <a href="login.php" class="btn btn-primary me-2">Ver todos</a>
              <div class="swiper-buttons">
                <button
                  class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                <button
                  class="swiper-next products-carousel-next btn btn-primary">❯</button>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="swiper">
            <div class="swiper-wrapper">
              <!-- Aqui empieza -->
              <?php
              foreach ($producto as $row => $item) {
                echo '
                                <div class="product-item swiper-slide">
                            <figure>
                                <a href="login.php" title="' . $item[1] . '">
                                    <img src="' . $item[4] . '"
                                        alt="img producto" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">' . $item[1] . '</h3>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$' . ($item[3] + 15) . '</del>
                                    <span class="text-dark fw-semibold">$' . $item[3] . '</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">Descuento</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3">
                                                <a href="login.php" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-heart" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                            <div class="col-7">
                                                <a href="login.php" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart">Añadir al carrito</a>
                                            </div>
                                            <div class="col-2">
                                                <a href="login.php" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-star" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
              }
              ?>
            </div>
          </div>
        </div>
  </section>

  <section class="py-3">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-12">

          <div class="banner-blocks">

            <div
              class="banner-ad d-flex align-items-center large bg-info block-1"
              style="background: url('images/banner-ad-1.jpg') no-repeat; background-size: cover;">
              <div class="banner-content p-5">
                <div class="content-wrapper text-light">
                  <h3 class="banner-title text-light">Prueba las nuevas
                    Fresas
                    con crema</h3>
                  <p>Solo por temporada!</p>
                  <a href="login.php" class="btn-link text-white">Inicia ahora</a>
                </div>
              </div>
            </div>

            <div class="banner-ad bg-success-subtle block-2"
              style="background:url('images/banner-ad-2.jpg') no-repeat;background-size: cover">
              <div class="banner-content align-items-center p-5">
                <div class="content-wrapper text-light">
                  <h3 class="banner-title text-light">Aprovecha nuestros
                    descuentos</h3>
                  <p>Selecciona nuestras ofertas del dia</p>
                  <a href="login.php" class="btn-link text-white">Inicia</a>
                </div>
              </div>
            </div>

            <div class="banner-ad bg-danger block-3"
              style="background:url('images/banner-ad-3.jpg') no-repeat;background-size: cover">
              <div class="banner-content align-items-center p-5">
                <div class="content-wrapper text-light">
                  <h3 class="banner-title text-light">Cupones de
                    descuento</h3>
                  <p>Proximamente...</p>
                  <a href="login.php" class="btn-link text-white">Inicia
                    ahora!</a>
                </div>
              </div>
            </div>

          </div>
          <!-- / Banner Blocks -->

        </div>
      </div>
    </div>
  </section>

  <section class="py-5 overflow-hidden">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-12">

          <div
            class="section-header d-flex flex-wrap justify-content-between mb-5">
            <h2 class="section-title">Categorías</h2>

            <div class="d-flex align-items-center">
              <a href="index.php?seccion=buscar" class="btn btn-primary me-2">Ver todo</a>
              <div class="swiper-buttons">
                <button
                  class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                <button
                  class="swiper-next category-carousel-next btn btn-yellow">❯</button>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="category-carousel swiper">
            <div class="swiper-wrapper">
              <?php
              foreach ($cat as $key => $val) {
                echo '
                                <a href="index.php?seccion=categorias_u&filtrar&id_categoria=' . $val[0] . '&name=' . $val[1] . '" class="nav-link swiper-slide text-center">
                                    <img src="images/category-thumb-1.jpg" class="rounded-circle" alt="Category Thumbnail">
                                    <h4 class="fs-6 mt-3 fw-normal category-title">' . $val[1] . '</h4>
                                </a>
                            ';
              }
              ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="pb-4 my-4">
    <div class="container-lg">

      <div class="bg-warning pt-5 rounded-5">
        <div class="container">
          <div class="row justify-content-center align-items-center">
            <div class="col-md-4">
              <h2 class="mt-5">¡Encuentranos en Didi, Rappi Y Uber
                eats!</h2>
              <p>¡No esperes mas!</p>
              <div class="d-flex gap-2 flex-wrap mb-5">
                <a href="#" title="App store"><img
                    src="images/img-app-store.png" alt="app-store"></a>
                <a href="#" title="Google Play"><img
                    src="images/img-google-play.png"
                    alt="google-play"></a>
              </div>
            </div>
            <div class="col-md-5">
              <img src="images/banner-onlineapp.png" alt="phone"
                class="img-fluid">
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <footer class="py-5">
    <div class="container-lg">
      <div class="row">
        <div class="row">

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-menu">
              <img src="img/logo.png" width="200" height="200" alt="logo">
              <div class="social-links mt-3">
                <ul class="d-flex list-unstyled gap-2">
                  <li class="text-center">
                    <a
                      href="https://www.facebook.com/profile.php?id=100040319603542"
                      class="btn btn-outline-light">
                      <svg width="36" height="36">
                        <use
                          xlink:href="#facebook"></use>
                      </svg>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-2 col-sm-6">
            <div class="footer-menu">
              <h5 class="widget-title">Ubicación</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                  <a target="new" href="https://maps.app.goo.gl/A8Fo5mjAGXiZMkwX9" class="nav-link">Calle 20 de Noviembre #256 col.Centro , Gómez Palacio, Mexico</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-2 col-sm-6">
            <div class="footer-menu">
              <h5 class="widget-title">Rappi</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                  <a target="new" href="https://www.rappi.com.mx/restaurantes/1923820766-gorditas-al-carbon-el-guerrerito" class="nav-link">Pide en Rappi</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-2 col-sm-6">
            <div class="footer-menu">
              <h5 class="widget-title">Uber Eats</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                  <a target="new" href="https://www.ubereats.com/mx/store/gorditas-al-carbon-el-guerrerito/QssMrAm2QzOPczcbBIGUmg?utm_campaign=CM2508147-search-free-nonbrand-google-pas_e_all_acq_Global&utm_medium=search-free-nonbrand&utm_source=google-pas" class="nav-link">Pide en Uber Eats</a>
                </li>

              </ul>
            </div>
          </div>
          <div class="col-md-2 col-sm-6">
            <div class="footer-menu">
              <h5 class="widget-title">LLamanos!</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                  <p>+52 8711609352</p>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
  </footer>
  <div id="footer-bottom">
    <div class="container-lg">
      <div class="row">
        <div class="col-md-6 copyright">
          <p>© 2024 Organic. All rights reserved.</p>
        </div>
        <div class="col-md-6 credit-link text-start text-md-end">
          <p>HTML Template by <a
              href="https://templatesjungle.com/">TemplatesJungle</a>
            Distributed By <a href="https://themewagon.com">ThemeWagon</a>
          </p>
        </div>
      </div>
    </div>
  </div>


  <script src="js/jquery-1.11.0.min.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
</body>

</html>