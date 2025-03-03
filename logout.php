<?php
    session_start();
    //session_destroy();
    $_SESSION['activa'] = false;
    header('Location: inicio_publico.php');
?>