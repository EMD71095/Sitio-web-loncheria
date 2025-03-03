<?php
session_start();
if (isset($_SESSION['activa']) && $_SESSION['activa'] == true) {
  if ($_SESSION['rol'] == 2) {
    header('Location: index.php?seccion=inicio');
  } else {
    header('Location: index.php?seccion=inicio_admin');
  }
}

include 'modelo/conexion.php';
include 'modelo/ModeloUsuarios.php';
include 'controlador/ControladorUsuarios.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Inicio de sesión</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="dist/css/site.min.css">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  <link rel="icon" href="img/aliru_logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script type="text/javascript" src="dist/js/site.min.js"></script>

  <!-- Sweet alert -->
  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="icon" href="img/logo.png" type="image/x-icon">
</head>

<body>

  <?php
  $login = new ControladorUsuarios;
  $login->login();
  ?>

  <div class="container" id="container">
    <div class="form-container sign-in">
      <form role="form" action="" method="POST" autocomplete="off">
        <h1>Inicia sesión</h1>
        <div class="social-icons">
          <img src="img/logo.png" alt="logo" style="width: 50px;">
        </div>
        <span>Usa tu correo y contraseña</span>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" />
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" autocomplete="off" />
        <button name="login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
      <footer>
        <div class="card-footer copyright clearfix text-center">
          <p><b>Guerrerito</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="inicio_publico.php">Volver</a>&nbsp;&bull;&nbsp;<a href="registroUsuario_publico.php">Registrarse</a></p>
          <p><a href="https://www.facebook.com/profile.php?id=100040319603542" target="_blank" rel="external nofollow">Pagina de facebook "Guerrerito"</a>©️</p>
        </div>
      </footer>
    </div>
  </div>
</body>

</html>