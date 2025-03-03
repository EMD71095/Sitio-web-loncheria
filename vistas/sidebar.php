<?php
$cat = ControladorCategorias::consultaCategorias();
$mandar = new ControladorCategorias;  //no array de regreso
$res = new ControladorOrdenes;
$cantidad = $res->cantidad($_SESSION["id"]);
$mandar->Filtrar();

$producto_orden = ControladorOrdenes::consultaDetalleOrdenView();
$eliminar = new ControladorOrdenes;  //no array de regreso
$eliminar->eliminarProductoOrden();
$nuevo = new ControladorOrdenes;
$nuevo->insertarOrden();


if ($_SESSION['rol'] == 2) {
  echo '
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
      <div class="offcanvas-header justify-content-between">
        <h4 class="fw-normal text-uppercase fs-6">Menu</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
          aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul
          class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
            <li class="nav-item border-dashed">
              <a href="index.php?seccion=inicio" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                <i class="fas fa-home" style="font-size: 15px;"></i>
                <span>Inicio</span>
              </a>
            </li>
            <li class="nav-item border-dashed">
              <a href="index.php?seccion=buscar" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                <i class="fas fa-utensils" style="font-size: 15px;"></i>
                <span>Productos</span>
              </a>
            </li>
          <li class="nav-item border-dashed">
      <button
        class="btn btn-toggle dropdown-toggle position-relative w-100 d-flex justify-content-between align-items-center text-dark p-2"
        data-bs-toggle="collapse" data-bs-target="#beverages-collapse"
        aria-expanded="false">
        <div class="d-flex gap-3">
          <i class="fas fa-list"></i>
          <span>Categorías</span>
        </div>
      </button>
      <div class="collapse" id="beverages-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal ps-5 pb-1">';
  foreach ($cat as $key => $val) {
    echo ' 
    <li class="border-bottom py-2"><a href="index.php?seccion=categorias_u&filtrar&id_categoria=' . $val[0] . '&name=' . $val[1] . '" class="dropdown-item"><i class="fas fa-layer-group"></i> ' . $val[1] . '</a></li>';
  }
  echo '
          </ul>
        </div>
      </li>
      <li class="nav-item border-dashed">
          <a href="index.php?seccion=carrito" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-shopping-cart" style="font-size: 15px;"></i>
            <span>Carrito (' . $cantidad . ')</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="index.php?seccion=ordenes_usuario" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-check" style="font-size: 15px;"></i>
            <span>Mis ordenes</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="index.php?seccion=detalleUsuarios&idUsuario=' . $_SESSION["id"] . '" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-user" style="font-size: 15px;"></i>
            <span>Perfil</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="logout.php" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-sign-in-alt" style="font-size: 15px;"></i>
            <span>Salir</span>
          </a>
        </li>
    </ul>

  </div>

</div>
  ';
} else {
  echo '
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
          <a href="index.php?seccion=inicio_admin" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-home" style="font-size: 15px;"></i>
            <span>Inicio</span>
          </a>
        </li>
      <!-- Aqui termina -->
      <li class="nav-item border-dashed">
          <a href="index.php?seccion=productos" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-utensils" style="font-size: 15px;"></i>
            <span>Productos</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="index.php?seccion=categorias" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-th-large" style="font-size: 15px;"></i>
            <span>Categorías</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="index.php?seccion=ordenes" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-receipt" style="font-size: 15px;"></i>
            <span>Ordenes</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="index.php?seccion=usuarios" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-users" style="font-size: 15px;"></i>
            <span>Usuarios</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="index.php?seccion=grafica" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-chart-pie" style="font-size: 15px;"></i>
            <span>Panel grafíco</span>
          </a>
        </li>
        <li class="nav-item border-dashed">
          <a href="logout.php" class="nav-link d-flex align-items-center gap-3 text-dark p-2">
            <i class="fas fa-sign-out-alt" style="font-size: 15px;"></i>
            <span>Salir</span>
          </a>
        </li>
    </ul>

  </div>

</div>
  ';
}
?>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1"
  id="offcanvasCart">
  <div class="offcanvas-header justify-content-center">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
      aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="order-md-last">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Tu carrito</span>
        <span class="badge bg-primary rounded-pill"><?= $cantidad ?></span>
      </h4>
      <ul class="list-group mb-3">
        <?php
        $total = 0;
        foreach ($producto_orden as $row => $item) {
          echo '
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">' . $item[2] . '</h6>
                <small class="text-body-secondary">' . $item[4] . '</small>
                </div>
                <span class="text-body-secondary">' . $item[5] . '</span>
              </li>
            ';
          $total += ($item[4] * $item[5]);
        }
        ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (MX)</span>
          <strong>$<?= number_format($total, 2) ?></strong>
        </li>
      </ul>

      <a href="index.php?seccion=carrito">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Ir al pedido</button>
      </a>
    </div>
  </div>
</div>