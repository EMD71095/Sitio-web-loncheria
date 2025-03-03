<?php
class ControladorProductos
{
    static function registrarProducto()
    {
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $id_categoria = $_POST["id_categoria"];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $respuesta = ModeloProductos::insertarProductos($nombre, $descripcion, $precio, $target_file, $id_categoria);
            if ($respuesta) {

                echo $target_file;
                echo $imageFileType;
                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["archivo"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $uploadOk = 0;
                    echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Producto registrado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=productos";
                                        });
                                    </script>
                                    ';
                }
                // Check file size
                if ($_FILES["archivo"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    echo $_FILES["archivo"]["size"];
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png") {
                    echo "Sorry, only mp3 files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                } else {
                    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                        echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Producto registrado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=productos";
                                        });
                                    </script>
                                    ';
                    } else {
                        echo '
                        <script>
                            swal("Error", "Hubo un error al cargar tu archivo.", "error");
                        </script>
                    ';
                    }
                }
            } else {
                echo '
                                    <script>
                                        swal("Error", "No se pudo registrar el producto", "error");
                                    </script>
                                ';
            }
        }
    }



    static function consultaProductos()
    {
        $respuesta = ModeloProductos::selectProductos();
        $array = $respuesta->fetch_all();
        return $array;
    }



    static function consultaProductosview()
    {
        $respuesta = ModeloProductos::selectProductosview();
        $array = $respuesta->fetch_all();
        return $array;
    }

    static function consultaProductosviewLimit()
    {
        if (isset($_GET['pagina'])) {
            $iniciar = ($_GET['pagina'] - 1) * 9;
        } else {
            $iniciar = 0;
        }
        $respuesta = ModeloProductos::selectProductosviewLimit($iniciar);
        $array = $respuesta->fetch_all();
        return $array;
    }




    static function getProducto()
    {
        if (isset($_GET["idProducto"])) {
            $id = $_GET["idProducto"];
            $respuesta = ModeloProductos::selectProductosById($id);
            $array = $respuesta->fetch_all();
            return $array;
        }
    }


    static function getProductoview()
    {
        if (isset($_GET["idProducto"])) {
            $id = $_GET["idProducto"];
            $respuesta = ModeloProductos::selectProductosByIdview($id);
            $array = $respuesta->fetch_all();
            return $array;
        }
    }

    static function eliminarProducto()
    {
        if (isset($_GET["idProducto"]) && isset($_GET["eliminar"]) && $_GET["eliminar"] == 1) {
            $id = $_GET["idProducto"];
            $respuesta = ModeloProductos::deleteProductos($id);

            if ($respuesta) {
                echo '
                                <script>
                                    swal({
                                        title: "Listo!",
                                        text: "Producto eliminado correctamente",
                                        type: "success"
                                    }, function(){
                                        window.location.href = "index.php?seccion=productos";
                                    });
                                </script>
                                ';
            } else {
                echo '
                                <script>
                                    swal("Error", "No se pudo eliminar el producto", "error");
                                </script>
                            ';
            }
        }
    }

    static function editarProducto()
    {
        if (isset($_POST["editar"])) {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $id_categoria = $_POST["id_categoria"];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["archivo"]["name"]);

            if (!empty($_FILES["archivo"]["name"])) {
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                    $respuesta = ModeloProductos::updateProductos($id, $nombre, $descripcion, $precio, $target_file, $id_categoria);
                    if ($respuesta) {
                        echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Producto editado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=productos";
                                        });
                                    </script>
                                    ';
                    } else {
                        echo '
                                    <script>
                                        swal("Error", "No se pudo editar el producto", "error");
                                    </script>
                                ';
                    }
                } else {
                    echo '
                                    <script>
                                        swal("Error", "No se pudo subir el archivo", "error");
                                    </script>
                                ';
                }
            } else {
                $respuesta = ModeloProductos::updateProductos2($id, $nombre, $descripcion, $precio, $id_categoria);
                if ($respuesta) {
                    echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Producto editado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=productos";
                                        });
                                    </script>
                                    ';
                } else {
                    echo '
                                    <script>
                                        swal("Error", "No se pudo editar el producto", "error");
                                    </script>
                                ';
                }
            }
        }
    }

    static function buscarProductos()
    {
        if (isset($_POST['name'])) {
            $prod = $_POST['name'];
        } else {
            $prod = "";
        }
        $respuesta = ModeloProductos::buscarProducto($prod);
        $array = $respuesta->fetch_all();
        return $array;
    }
}
