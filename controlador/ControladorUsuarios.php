<?php
class ControladorUsuarios
{
    static function login()
    {
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $passEnc = sha1($pass);

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo '
                <script>
                    swal("Error", "Por favor, usa un email correcto", "error");
                </script>
                ';
                return;
            }

            $respuesta = ModeloUsuarios::loginUsuarios($email, $passEnc);

            if ($respuesta) { // Verificar si la consulta fue exitosa
                $array = $respuesta->fetch_assoc();
                //var_dump($array);

                if ($array) {
                    session_start();
                    $_SESSION['email'] = $array["email"];
                    $_SESSION['nombre'] = $array["nombre"];
                    $_SESSION['rol'] = $array["tipo_usuario"];
                    $_SESSION['img_perfil'] = $array["ruta_archivo"];
                    $_SESSION['id'] = $array["id"];
                    $_SESSION['activa'] = true;

                    if ($_SESSION['rol'] == 2) {
                        header('Location: index.php?seccion=inicio');
                    } else {
                        header('Location: index.php?seccion=inicio_admin');
                    }
                    exit(); // Detener ejecución después de la redirección
                } else {
                    echo '
                        <script>
                            swal("Error", "Campos incorrectos, verifica tu información", "error");
                        </script>
                    ';
                }
            } else {
                echo '
        <script>
            swal("Error", "Error en la consulta, intenta nuevamente", "error");
        </script>
    ';
            }
        }
    }


    static function registrarUsuario()
    {
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $pass = $_POST["password"];
            $passConfirm = $_POST["passwordConfirm"];
            $tipoUsuario = $_POST["tipoUsuario"];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo '
                <script>
                    swal("Error", "Por favor, usa un email correcto", "error");
                </script>
                ';
                return;
            }

            $unico = ModeloUsuarios::usuarioUnico($email);

            if ($unico) {
                echo '
                <script>
                    swal("Error", "Email ya registrado", "error");
                </script>
                ';
                return;
            }

            if ($pass == $passConfirm) {
                $passEnc = sha1($pass);
                $respuesta = ModeloUsuarios::insertarUsuario($nombre, $email, $passEnc, $tipoUsuario, $target_file);
                if ($respuesta) {
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
                                            text: "Usuario registrado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=usuarios";
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
                                            text: "Usuario registrado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=usuarios";
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
                                        swal("Error", "No se pudo editar el usuario", "error");
                                    </script>
                                ';
                }
            } else {
                echo '
                                    <script>
                                        swal("Error", "El password no coincide", "error");
                                    </script>
                                ';
            }
        }
    }

    static function registrarUsuario_f()
    {
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $pass = $_POST["password"];
            $passConfirm = $_POST["passwordConfirm"];
            $tipoUsuario = 2;
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo '
                <script>
                    swal("Error", "Por favor, usa un email correcto", "error");
                </script>
                ';
                return;
            }

            $unico = ModeloUsuarios::usuarioUnico($email);

            if ($unico) {
                echo '
                <script>
                    swal("Error", "Email ya registrado", "error");
                </script>
                ';
                return;
            }

            if ($pass == $passConfirm) {
                $passEnc = sha1($pass);
                $respuesta = ModeloUsuarios::insertarUsuario($nombre, $email, $passEnc, $tipoUsuario, $target_file);
                if ($respuesta) {
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
                        echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Usuario registrado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "login.php";
                                        });
                                    </script>
                                    ';
                        $uploadOk = 0;
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
                                            text: "Usuario registrado correctamente, inicia sesion!",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "login.php";
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
                                        swal("Error", "No se pudo crear tu cuenta", "error");
                                    </script>
                                ';
                }
            } else {
                echo '
                                    <script>
                                        swal("Error", "El password no coincide", "error");
                                    </script>
                                ';
            }
        }
    }

    static function consultaUsuarios()
    {
        $respuesta = ModeloUsuarios::selectUsuarios();
        $array = $respuesta->fetch_all();
        return $array;
    }
    static function consultaUsuarios_t()
    {
        $respuesta = ModeloUsuarios::selectUsuarios_t();
        $array = $respuesta->fetch_all();
        return $array;
    }

    static function consultaUsuarios_n()
    {
        $respuesta = ModeloUsuarios::selectUsuarios_n();
        $array = $respuesta->fetch_all();
        return $array;
    }



    static function getUsuario()
    {
        if (isset($_GET["idUsuario"])) {
            $id = $_GET["idUsuario"];
            $respuesta = ModeloUsuarios::selectUsuarioById($id);
            $array = $respuesta->fetch_all();
            return $array;
        }
    }

    static function eliminarUsuario()
    {
        if (isset($_GET["idUsuario"]) && isset($_GET["eliminar"]) && $_GET["eliminar"] == 1) {
            $id = $_GET["idUsuario"];
            $respuesta = ModeloUsuarios::deleteUsuario($id);

            if ($respuesta) {
                echo "Usuario eliminado correctamente";
                echo '<script>window.location.href = "index.php?seccion=usuarios";</script>';
            } else {
                echo "No se pudo eliminar el usuario";
            }
        }
    }

    static function editarUsuario()
    {
        if (isset($_POST["editar"])) {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $passConfirm = $_POST["passConfirm"];
            $tipoUsuario = $_POST["tipoUsuario"];

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo '
                <script>
                    swal("Error", "Por favor, usa un email correcto", "error");
                </script>
                ';
                return;
            }

            $unico = ModeloUsuarios::usuarioUnico_editar($_SESSION["id"], $email);

            if ($unico) {
                echo '
                <script>
                    swal("Error", "Email ya registrado en otra cuenta", "error");
                </script>
                ';
                return;
            }

            if ($pass == $passConfirm) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["archivo"]["name"]);

                if (!empty($_FILES["archivo"]["name"])) {
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                        $passEnc = sha1($pass);
                        $respuesta = ModeloUsuarios::updateUsuario($id, $nombre, $email, $passEnc, $tipoUsuario, $target_file);
                        if ($respuesta) {
                            echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Usuario editado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=detalleUsuarios&idUsuario=' . $_SESSION['id'] . '";
                                        });
                                    </script>
                                    ';
                        } else {
                            echo '
                                    <script>
                                        swal("Error", "No se pudo editar el usuario", "error");
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
                    $passEnc = sha1($pass);
                    $respuesta = ModeloUsuarios::updateUsuario2($id, $nombre, $email, $passEnc, $tipoUsuario);
                    if ($respuesta) {
                        echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Usuario editado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=detalleUsuarios&idUsuario=' . $_SESSION['id'] . '";
                                        });
                                    </script>
                                    ';
                    } else {
                        echo '
                                    <script>
                                        swal("Error", "No se pudo editar el usuario", "error");
                                    </script>
                                ';
                    }
                }
            } else {
                echo '
                                <script>
                                    swal("Error", "Las contraseñas no coinciden", "error");
                                </script>
                            ';
            }
        }
    }

    static function editarUsuario_u()
    {
        if (isset($_POST["editar"])) {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo '
                <script>
                    swal("Error", "Por favor, usa un email correcto", "error");
                </script>
                ';
                return;
            }

            $unico = ModeloUsuarios::usuarioUnico_editar($_SESSION["id"], $email);

            if ($unico) {
                echo '
                <script>
                    swal("Error", "Email ya registrado en otra cuenta", "error");
                </script>
                ';
                return;
            }

            $contra = ModeloUsuarios::conntraseña($id, $email);
            $pa = $contra->fetch_assoc();
            $passEnc = $pa["pass"];

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["archivo"]["name"]);

            if (!empty($_FILES["archivo"]["name"])) {
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
                    $respuesta = ModeloUsuarios::updateUsuario_u($id, $nombre, $email, $target_file);

                    $contra = ModeloUsuarios::conntraseña($id, $email);
                    $pa = $contra->fetch_assoc();
                    $passEnc = $pa["pass"];
                    $respuesta1 = ModeloUsuarios::loginUsuarios($email, $passEnc);
                    $array = $respuesta1->fetch_assoc();
                    if ($array > 0) {
                        $_SESSION['email'] = $array["email"];
                        $_SESSION['nombre'] = $array["nombre"];
                        $_SESSION['rol'] = $array["tipo_usuario"];
                        $_SESSION['img_perfil'] = $array["ruta_archivo"];
                        $_SESSION['id'] = $array["id"];
                        $_SESSION['activa'] = true;
                    }

                    if ($respuesta) {
                        echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Usuario editado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=detalleUsuarios&idUsuario=' . $_SESSION['id'] . '";
                                        });
                                    </script>
                                    ';
                    } else {
                        echo '
                                    <script>
                                        swal("Error", "No se pudo editar el usuario", "error");
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
                $respuesta = ModeloUsuarios::updateUsuario_u2($id, $nombre, $email);

                $contra = ModeloUsuarios::conntraseña($id, $email);
                $pa = $contra->fetch_assoc();
                $passEnc = $pa["pass"];
                $respuesta1 = ModeloUsuarios::loginUsuarios($email, $passEnc);
                $array = $respuesta1->fetch_assoc();
                if ($array > 0) {
                    $_SESSION['email'] = $array["email"];
                    $_SESSION['nombre'] = $array["nombre"];
                    $_SESSION['rol'] = $array["tipo_usuario"];
                    $_SESSION['img_perfil'] = $array["ruta_archivo"];
                    $_SESSION['id'] = $array["id"];
                    $_SESSION['activa'] = true;
                }
                if ($respuesta) {
                    echo '
                                    <script>
                                        swal({
                                            title: "Listo!",
                                            text: "Usuario editado correctamente",
                                            type: "success"
                                        }, function(){
                                            window.location.href = "index.php?seccion=detalleUsuarios&idUsuario=' . $_SESSION['id'] . '";
                                        });
                                    </script>
                                    ';
                } else {
                    echo '
                                    <script>
                                        swal("Error", "No se pudo editar el usuario", "error");
                                    </script>
                                ';
                }
            }
        }
    }
}
