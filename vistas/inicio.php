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
                    <a href="https://www.facebook.com/profile.php?id=100040319603542" class="btn btn-primary text-uppercase fs-6 rounded-pill px-4 py-3 mt-3" style="background-color: #0056b3;">
                        <svg width="26" height="26">
                            <use xlink:href="#facebook"></use>
                        </svg>
                        Siguenos en Facebook
                    </a>
                </div>
                <div class="row my-5">
                    <div class="col">
                        <div class="row text-dark">
                            <div class="col-auto">
                                <p
                                    class="fs-1 fw-bold lh-sm mb-0">20+</p>
                            </div>
                            <div class="col">
                                <p class="text-uppercase lh-sm mb-0" style="cursor: default;">Años a
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
                                <p class="text-uppercase lh-sm mb-0" style="cursor: default;">Clientes
                                    felices</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- aqui -->
<section id="latest-products" class="products-carousel">
    <div class="container-lg overflow-hidden pb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex justify-content-between my-4">
                    <h2 class="section-title">Nuestros productos</h2>
                    <div class="d-flex align-items-center">
                        <a href="index.php?seccion=buscar" class="btn btn-primary me-2">Ver todos</a>
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
                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" title="' . $item[1] . '">
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
                                </div>';
                            $resultado = $verificar->verificar($item[0]);
                            if ($resultado) {
                                echo '<div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3">
                                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-heart" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                            <div class="col-7">
                                                <a href="index.php?seccion=inicio&update_cantidad&id_producto=' . $item[0] . '" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart">Échame otro ;)</a>
                                            </div>
                                            <div class="col-2">
                                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-star" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                ';
                            } else {

                                echo '<div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3">
                                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-heart" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                            <div class="col-7">
                                                <a href="index.php?seccion=inicio&add_cart&id_producto=' . $item[0] . '&precio_unitario=' . $item[3] . '" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart">Añadir al carrito</a>
                                            </div>
                                            <div class="col-2">
                                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-star" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                ';
                            }
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
                            </div>
                        </div>
                    </div>
                </div>
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

<div class="preloader-wrapper">
    <div class="preloader">
    </div>
</div>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>