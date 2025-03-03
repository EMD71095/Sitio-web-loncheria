<?php
$nuevo = new ControladorProductos;
$nuevo->registrarProducto();

$cat = ControladorCategorias::consultaCategorias();
?>


<div class="container">
    <div class="row">
        <div class="col">
            <h3>Administración de productos</h3>
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de producto:</label>
                            <input required name="nombre" type="text" class="form-control" id="nombre" aria-describedby="">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion:</label>
                            <input required name="descripcion" type="text" class="form-control" id="descripcion" aria-describedby="">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <input required name="precio" type="number" class="form-control" id="precio" aria-describedby="" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="id_categoria" class="form-label">Categoría:</label>
                            <select required name="id_categoria" class="form-control" id="id_categoria">
                                <option value="">Selecciona una opción</option>
                                <?php foreach ($cat as $key => $val) {
                                    echo '<option value="' . $val[0] . '">' . $val[1] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fileUpload" class="form-label">Foto</label>
                            <input required name="archivo" type="file" class="form-control" id="fileUpload">
                            <small>Nota: Seleccione unicamente archivos con extension .jpg o .png</small>
                        </div>
                        <button name="nuevo" value="newproducto" type="submit" class="btn btn-primary">Registrar producto</button>
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