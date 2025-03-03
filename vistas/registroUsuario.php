<?php
$nuevo = new ControladorUsuarios; //respuestas boleanas
$nuevo->registrarUsuario();
?>


<div class="container">
    <div class="row">
        <div class="col">
            <h3>Administración de Usuarios</h3>
            <div class="card">
                <div class="card-header">Registrar usuario</div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombreUsuario" class="form-label">Nombre de usuario:</label>
                            <input required name="nombre" type="text" class="form-control" id="nombreUsuario" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="emailUsuario" class="form-label">Email:</label>
                            <input required name="email" type="text" class="form-control" id="emailUsuario" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="passUsuario" class="form-label">Contraseña:</label>
                            <input required name="password" type="password" class="form-control" id="passUsuario" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="emailUsuario" class="form-label">Confirmar contraseña:</label>
                            <input required name="passwordConfirm" type="password" class="form-control" id="emailUsuario" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="tipoUsuario" class="form-label">Tipo de usuario:</label>
                            <select name="tipoUsuario" class="form-control" id="tipoUsuario">
                                <option value="1">Administrador</option>
                                <option value="2">Cliente</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fileUpload" class="form-label">Foto de perfil</label>
                            <input name="archivo" type="file" class="form-control" id="fileUpload">
                            <small>Nota: Seleccione unicamente archivos con extension .jpg o .png</small>
                        </div>
                        <button name="nuevo" value="newUsuario" type="submit" class="btn btn-primary">Registrar usuario</button>
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