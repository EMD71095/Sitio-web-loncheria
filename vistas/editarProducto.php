<?php
$producto = ControladorProductos::getProducto();
foreach ($producto as $row => $item) {
}

$info = new Controladorproductos;
$info->editarProducto();

$cat = ControladorCategorias::consultaCategorias();
?>


<div class="container">
    <div class="row">
        <div class="col">
            <h3>Administración de productos</h3>
            <div class="card">
                <div class="card-header">
                    Editar Producto <?= $item[0] ?>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="text" value="<?= $item[0] ?>" name="id" readonly>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de producto:</label>
                            <input required name="nombre" type="text" class="form-control" id="nombre" value="<?= $item[1] ?>" aria-describedby="">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion:</label>
                            <input required name="descripcion" class="form-control" type="text" value="<?= $item[2] ?>" id="descripcion" aria-describedby="">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <input required name="precio" class="form-control" type="number" value="<?= $item[3] ?>" id="precio" aria-describedby="">
                        </div>
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría:</label>
                            <select name="id_categoria" class="form-control" id="id_categoria">
                                <option value="">Selecciona una opción</option>
                                <?php foreach ($cat as $key => $val) {
                                    // Si el valor de la categoría coincide con el del item, agregar "selected"
                                    $selected = ($val[0] == $item[5]) ? 'selected' : '';
                                    echo '<option value="' . $val[0] . '" ' . $selected . '>' . $val[1] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fileUpload" class="form-label">Foto</label>
                            <input name="archivo" type="file" class="form-control" id="fileUpload">
                            <small>Nota: Seleccione unicamente archivos con extension .jpg o .png</small>
                        </div>
                        <button name="editar" value="editproducto" type="submit" class="btn btn-primary">Editar producto</button>
                    </form>
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