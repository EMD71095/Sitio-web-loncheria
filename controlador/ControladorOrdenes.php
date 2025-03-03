<?php
class ControladorOrdenes
{
    static function add_cart()
    {
        if (isset($_GET["add_cart"])) {
            $id_producto = $_GET["id_producto"];
            $cantidad = 1;
            $precio_unitario = $_GET["precio_unitario"];
            $respuesta = ModeloOrdenes::insertarDetalleOrdenes($id_producto, $_SESSION["id"], $cantidad, $precio_unitario);
            if ($respuesta) {
                echo '
                    <script>
                        swal({
                        title: "Listo!",
                        text: "Producto añadido correctamente",
                        type: "success"
                        }, function(){
                        window.location.href = "index.php?seccion=inicio";
                        });
                    </script>
                    ';
            } else {
                echo '
                    <script>
                        swal("Error", "No se pudo añadir el producto", "error");
                    </script>
                                ';
            }
        }
    }

    static function update_cantidad()
    {
        if (isset($_GET["update_cantidad"])) {
            $id_producto = $_GET["id_producto"];
            $respuesta = ModeloOrdenes::updateCantidad($id_producto, $_SESSION["id"]);
            if ($respuesta) {
                echo '
                    <script>
                        swal({
                        title: "Listo!",
                        text: "Producto añadido correctamente",
                        type: "success"
                        }, function(){
                        window.location.href = "index.php?seccion=inicio";
                        });
                    </script>
                    ';
            } else {
                echo '
                    <script>
                        swal("Error", "No se pudo añadir el producto", "error");
                    </script>
                                ';
            }
        }
    }

    static function verificar($id_producto)
    {
        $respuesta = ModeloOrdenes::verificar($id_producto, $_SESSION["id"]);
        return $respuesta;
    }

    static function cantidad()
    {
        $respuesta = ModeloOrdenes::countProductos($_SESSION["id"]);
        return $respuesta;
    }


    static function consultaOrdenes()
    {
        $respuesta = ModeloOrdenes::selectOrdenesView();
        $array = $respuesta->fetch_all();
        return $array;
    }

    static function consultaOrdenesUsuario()
    {
        $respuesta = ModeloOrdenes::selectOrdenesUsuarios($_SESSION["id"]);
        $array = $respuesta->fetch_all();
        return $array;
    }

    static function consultaDetalleOrdenView()
    {
        $respuesta = ModeloOrdenes::selectDetalleOrdenView($_SESSION["id"]);
        $array = $respuesta->fetch_all();
        return $array;
    }



    static function consultaOrdenesview()
    {
        $respuesta = ModeloOrdenes::selectOrdenesview();
        $array = $respuesta->fetch_all();
        return $array;
    }


    static function eliminarProductoOrden()
    {
        if (isset($_GET["id_producto"]) && isset($_GET["eliminar"]) && $_GET["eliminar"] == 1) {
            $id_producto = $_GET["id_producto"];
            $respuesta = ModeloOrdenes::deleteProductoOrden($id_producto, $_SESSION["id"]);

            if ($respuesta) {
                echo '<script>window.location.href = "index.php?seccion=carrito";</script>';
            } else {
                echo "No se pudo eliminar el usuario";
            }
        }
    }



    static function getProducto()
    {
        if (isset($_GET["idProducto"])) {
            $id = $_GET["idProducto"];
            $respuesta = ModeloOrdenes::selectOrdenesById($id);
            $array = $respuesta->fetch_all();
            return $array;
        }
    }


    static function getProductoview()
    {
        if (isset($_GET["idProducto"])) {
            $id = $_GET["idProducto"];
            $respuesta = ModeloOrdenes::selectOrdenesByIdview($id);
            $array = $respuesta->fetch_all();
            return $array;
        }
    }

    //Oredenes efectuadas

    static function insertarOrden()
    {
        if (isset($_POST["finalizar"])) {
            $total = $_POST["total"];
            $id_usuario = $_SESSION["id"];
            date_default_timezone_set('America/Mexico_City');
            $fecha = date("Y-m-d H:i:s");

            $respuesta = ModeloOrdenes::insertarOrdenes($id_usuario, $fecha, $total);
            if ($respuesta) {
                echo '
                    <script>
                        swal({
                        title: "Listo!",
                        text: "Orden procesada correctamente",
                        type: "success"
                        }, function(){
                        window.location.href = "index.php?seccion=ordenes_usuario";
                        });
                    </script>
                    ';
            } else {
                echo '
                    <script>
                        swal("Error", "No se pudo añadir el producto", "error");
                    </script>
                ';
            }
        }
    }

    static function countOrdenes()
    {
        $respuesta = ModeloOrdenes::countOrdenes();
        return $respuesta;
    }

    static function grafica()
    {
        $part = ModeloOrdenes::graficaOrdenes();
        $cantidad = $part->fetch_all();
        return $cantidad;
    }

    static function listo()
    {
        if (isset($_GET["idOrden"]) && isset($_GET["listo"]) && $_GET["listo"] == 1) {
            $id_orden = $_GET["idOrden"];
            $respuesta = ModeloOrdenes::OrdenLista($id_orden);
            if ($respuesta) {
                echo '
                    <script>
                        swal({
                        title: "Listo!",
                        text: "Orden entregada",
                        type: "success"
                        }, function(){
                        window.location.href = "index.php?seccion=ordenes";
                        });
                    </script>
                    ';
            } else {
                echo '
                    <script>
                        swal("Error", "No se pudo añadir el producto", "error");
                    </script>
                ';
            }
        }
    }
}
