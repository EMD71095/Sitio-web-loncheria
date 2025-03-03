<?php
$verificar = new ControladorOrdenes;
$producto = ControladorProductos::getproductoview();
foreach ($producto as $row => $item) {
}
?>


<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body" style="font-size: 15px;">
                    <h4 class="text-center"><strong><?= $item[1] ?></strong></h4>
                    <p><strong>Descripción del producto:</strong> <?= $item[2] ?></p>
                    <p><strong>Precio:</strong> $ <?= $item[3] ?></p>
                    <p><strong>Categoria:</strong> <?= $item[5] ?></p>
                    <p><strong>Imagen:</strong></p>
                    <p class="text-center"><img src="<?= $item[4] ?>" alt="img del producto" style="width: 900px; height: 600px;"></p>

                </div>
                <div class="card-footer">
                    <?php
                    if ($_SESSION["rol"] == 2) {
                        echo '<a class="btn btn-danger" href="index.php?seccion=inicio" style="margin-right: 5px;">Volver</a>';
                        $resultado = $verificar->verificar($item[0]);
                        if ($resultado) {
                            echo '
                                <a href="index.php?seccion=inicio&update_cantidad&id_producto=' . $item[0] . '" class="btn btn-primary">Añadir uno más</a>';
                        } else {
                            echo '
                                <a href="index.php?seccion=inicio&add_cart&id_producto=' . $item[0] . '&precio_unitario=' . $item[3] . '" class="btn btn-primary">Añadir al carrito</a>';
                        }
                    } else {
                        echo '<a class="btn btn-danger" href="index.php?seccion=productos" style="margin-right: 5px;">Volver</a>';
                        echo '<a class="btn btn-primary" href="index.php?seccion=editarProducto&idProducto=' . $item[0] . '" style="margin-right: 5px;">Editar producto</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="preloader-wrapper">
    <div class="preloader">
    </div>
</div>

<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>