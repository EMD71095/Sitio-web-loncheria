<?php
$usuario = ControladorUsuarios::getUsuario();
foreach ($usuario as $row => $item) {
}
$info = new ControladorUsuarios;
$info->editarUsuario_u();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Administración de usuario</h3>
            <div class="card">
                <div class="card-header">Editar Usuario: <?= $item[0] ?></div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $item[0] ?>" name="id" readonly>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre del Usuario</label>
                            <input required value="<?= $item[1] ?>" name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input required value="<?= $item[2] ?>" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="fileUpload" class="form-label">Foto de perfil</label>
                            <input value="<?= $item[5] ?>" name="archivo" type="file" class="form-control" id="fileUpload">
                            <small>Nota: Selecccione unicamente archivos con extensión .jpg o .png</small>
                        </div>
                        <button name="editar" value="newPodcast" type="submit" class="btn btn-primary" style="margin-top: 22px;">Editar Usuario</button>
                        <a class="btn btn-danger" href="index.php?seccion=inicio" style="margin-left: 5px; margin-top: 22px;">Volver</a>
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