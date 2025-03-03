<?php
$producto = ControladorCategorias::Filtrar();
$nuevo = new ControladorOrdenes; //respuestas boleanas
$nuevo->add_cart();
$editar = new ControladorOrdenes; //respuestas boleanas
$editar->update_cantidad();
$verificar = new ControladorOrdenes;
$nom = $_GET["name"];
?>

<style>
    h4.fixed-height {
        font-size: 24px;
        height: 60px;
        /* Define la altura fija */
        line-height: 1.2;
        /* Ajusta la altura de línea */
        overflow: hidden;
        /* Oculta el contenido que exceda la altura */
        text-overflow: ellipsis;
        /* Agrega puntos suspensivos si el texto es muy largo */
        white-space: nowrap;
        /* Evita que el texto se divida en varias líneas */
    }
</style>


<div class="container">
    <h4 class="text-center">Disfruta de nuestros productos</h4>
</div>

<section id="latest-products" class="products-carousel">
    <div class="row">

        <div class="col-md-12">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    if (!empty($producto)) {
                        $arre = array("#5D9CEC", "#4FC1E9", "#48CFAD", "#A0D468", "#FFCE54", "#FC6E51", "#ED5565", "#AC92EC", "#EC87C0", "#F5F7FA", "#CCD1D9", "#656D78");
                        $arre2 = array("#4A89DC", "#3BAFDA", "#37BC9B", "#8CC152", "#F6BB42", "#E9573F", "#DA4453", "#967ADC", "#D770AD", "#E6E9ED", "#AAB2BD", "#434A54");

                        foreach ($producto as $row => $item) {
                            $indice = $row % count($arre);
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
                    } else {
                        echo '
                        </div>
                                <div class="text-center">
                                    <p>No se encontraron productos.</p>
                                </div>';
                    }
                    ?>

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