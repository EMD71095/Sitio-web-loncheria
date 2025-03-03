<?php
    session_start();
    if (!$_SESSION['activa']) {
        header('Location: inicio_publico.php');
    }
    include 'modelo/conexion.php';
    include 'modelo/ModeloProductos.php';
    include 'modelo/ModeloCategorias.php';
    include 'modelo/ModeloUsuarios.php';
    include 'modelo/ModeloOrdenes.php';
    
    
    include 'controlador/ControladorCategorias.php';
    include 'controlador/ControladorProductos.php';
    include 'controlador/ControladorVistas.php';
    include 'controlador/ControladorUsuarios.php';
    include 'controlador/ControladorOrdenes.php';
    include 'plantilla.php';
?>