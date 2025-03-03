<?php
$Categoria = ControladorCategorias::getCategoria();
foreach ($Categoria as $row => $item) {
}
$info = new ControladorCategorias;
$info->editarCategoria();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Administración de Categorias</h3>
            <div class="card">
                <div class="card-header">Editar Categoria: <?= $item[0] ?></div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="text" value="<?= $item[0] ?>" name="id" readonly>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre de la categoria:</label>
                            <input required value="<?= $item[1] ?>" name="nombre" type="text" class="form-control" id="exampleInputPassword1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Descripción de la categoria:</label>
                            <input required value="<?= $item[2] ?>" name="descripcion" type="text" class="form-control" id="exampleInputPassword1" aria-describedby="emailHelp">
                        </div>
                        <button name="editar" value="newCategory" type="submit" class="btn btn-primary" style="margin-top: 22px;">Editar categoria</button>
                        <a class="btn btn-danger" href="index.php?seccion=inicio_admin" style="margin-left: 5px; margin-top: 22px;">Volver</a>
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