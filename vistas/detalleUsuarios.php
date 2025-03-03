<?php
$usuarios = ControladorUsuarios::getUsuario();
foreach ($usuarios as $row => $item) {
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Perfil</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> <?= $item[1] ?></p>
                    <p><strong>Email:</strong> <?= $item[2] ?></p>
                    <?php
                    if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 0) {
                        echo '
                            <p>Contraseña encriptada: ' . $item[3] . '</p>
                            <p>Tipo de usuario: ' . $item[4] . '</p>
                        ';
                    }
                    ?>
                    <p class="text-center">
                        <img src="<?= $item[5] ?>" alt="img de perfil" style="width: 50%; height: auto;">
                    </p>

                </div>
                <div class="card-footer">
                    <?php
                    if ($_SESSION["rol"] == 1) {
                        echo '<a class="btn btn-danger btn-sm" href="index.php?seccion=usuarios">Volver</a>';
                        echo '<a class="btn btn-primary btn-sm" style="margin-left: 5px;" href="index.php?seccion=editarUsuario&idUsuario=' . $item[0] . '">Editar</a>';
                    } else {
                        echo '<a class="btn btn-danger btn-sm" href="index.php?seccion=inicio">Volver</a>';
                        echo '<a class="btn btn-primary btn-sm" style="margin-left: 5px;" href="index.php?seccion=editarUsuario_u&idUsuario=' . $_SESSION["id"] . '">Editar</a>';
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