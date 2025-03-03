<?php

class ControladorCategorias
{
    static function registrarCategoria()
    {
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];

            $respuesta = ModeloCategorias::insertarCategorias($nombre, $descripcion);
            if ($respuesta) {
                echo '
                        <script>
                            swal({
                                title: "Listo!",
                                text: "Categoria registrada correctamente",
                                type: "success"
                            }, function(){
                                window.location.href = "index.php?seccion=categorias";
                            });
                        </script>
                    ';
            } else {
                echo '
                    <script>
                        swal("Error", "No se pudo crear", "error");
                    </script>
                ';
            }
        }
    }


    static function consultaCategorias()
    {
        $respuesta = ModeloCategorias::selectCategorias();
        $array = $respuesta->fetch_all();
        return $array;
    }

    static function getCategoria()
    {
        if (isset($_GET["idCategoria"])) {
            $id = $_GET["idCategoria"];
            $respuesta = ModeloCategorias::selectCategoriasById($id);
            $array = $respuesta->fetch_all();
            return $array;
        }
    }


    static function eliminarCategoria()
    {
        if (isset($_GET["idCategoria"]) && isset($_GET["eliminar"]) && $_GET["eliminar"] == 1) {
            $id = $_GET["idCategoria"];
            $respuesta = ModeloCategorias::deleteCategorias($id);

            if ($respuesta) {
                echo "Categoria eliminada correctamente";
                header('Location: index.php?seccion=categorias');
            } else {
                echo "No se pudo eliminar la Categoria";
            }
        }
    }

    static function editarCategoria()
    {
        if (isset($_POST["editar"])) {
            $id_c = $_POST["id"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];



            $respuesta = ModeloCategorias::updateCategorias($id_c, $nombre, $descripcion);
            // if ($respuesta) {
            //     echo "Categoria editada correctamente";
            //     header('Location: index.php?seccion=Categorias');
            // } else {
            //     echo "No se pudo editar la Categoria";
            // }
            if ($respuesta) {
                echo '
                        <script>
                            swal({
                                title: "Listo!",
                                text: "Categoria editada correctamente",
                                type: "success"
                            }, function(){
                                window.location.href = "index.php?seccion=categorias";
                            });
                        </script>
                    ';
            } else {
                echo '
                    <script>
                        swal("Error", "No se pudo crear", "error");
                    </script>
                ';
            }
        }
    }

    static function Filtrar()
    {
        if (isset($_GET["id_categoria"]) && isset($_GET["filtrar"])) {
            $id = $_GET["id_categoria"];
            $respuesta = ModeloCategorias::filtroCategorias($id);
            $array = $respuesta->fetch_all();
            return $array;
        }
    }


}

