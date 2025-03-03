<?php
class ControladorVistas
{
    //cargar la seccion dependiendo del parametro seccion en la URL
    static function cargarSeccion()
    {
        if (isset($_GET["seccion"])) {
            // Ruta de la vista solicitada
            $ruta = 'vistas/' . $_GET["seccion"] . '.php';

            // Verificar si el usuario es de rol 2 y está intentando acceder a la vista "usuarios"
            if ($_SESSION["rol"] == 2 && $_GET["seccion"] == "usuarios") {
                echo 'No tienes permiso para entrar a esa vista';
                include 'vistas/inicio.php';
            } else {
                if ($_SESSION["rol"] == 2 && $_GET["seccion"] == "ordenes") {
                    echo 'No tienes permiso para entrar a esa vista';
                    include 'vistas/inicio.php';
                } else {
                    if ($_SESSION["rol"] == 2 && $_GET["seccion"] == "grafica") {
                        echo 'No tienes permiso para entrar a esa vista';
                        include 'vistas/inicio.php';
                    } else {
                        if ($_SESSION["rol"] == 2 && $_GET["seccion"] == "categorias") {
                            echo 'No tienes permiso para entrar a esa vista';
                            include 'vistas/inicio.php';
                        } else {
                            if ($_SESSION["rol"] == 2 && $_GET["seccion"] == "productos") {
                                echo 'No tienes permiso para entrar a esa vista';
                                include 'vistas/inicio.php';
                            } else {
                                if ($_SESSION["rol"] == 2 && $_GET["seccion"] == "inicio_admin") {
                                    echo 'No tienes permiso para entrar a esa vista';
                                    include 'vistas/inicio.php';
                                } else {
                                    // Si la vista existe, cargarla
                                    if (file_exists($ruta)) {
                                        include $ruta;
                                    } else {
                                        if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 0) {
                                            include 'vistas/inicio_admin.php';
                                        } else {
                                            include 'vistas/inicio.php';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            // Cargar la vista predeterminada según el rol si no hay sección en el GET
            if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 0) {
                include 'vistas/inicio_admin.php';
            } else {
                include 'vistas/inicio.php';
            }
        }
    }
}
