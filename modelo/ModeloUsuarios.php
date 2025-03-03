<?php

class ModeloUsuarios
{
    static function loginUsuarios($email, $passEnc)
    {
        $sql = "SELECT * FROM usuarios WHERE email = '$email' and pass = '$passEnc';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function insertarUsuario($nombre, $email, $passEnc, $tipoUsuario, $target_file)
    {
        $sql = "INSERT INTO usuarios(nombre, email, pass, tipo_usuario, ruta_archivo)
            VALUES ('$nombre', '$email', '$passEnc', '$tipoUsuario', '$target_file')";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }
    static function selectUsuarios()
    {
        $sql = "SELECT * FROM  usuarios where tipo_usuario != 0;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectUsuarios_t()
    {
        $sql = "SELECT * FROM  usuarios";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectUsuarios_n()
    {
        $sql = "SELECT * FROM  usuarios where tipo_usuario != 0 and tipo_usuario != 1;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }


    static function selectUsuarioById($id)
    {
        $sql = "SELECT * FROM  usuarios where id = $id;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function deleteUsuario($id)
    {
        $sql = "DELETE from usuarios where id = $id;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function updateUsuario($id, $nombre, $email, $pass, $tipoUsuario, $target_file)
    {
        $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email', pass = '$pass', tipo_usuario = '$tipoUsuario', ruta_archivo = '$target_file' WHERE id = '$id';";

        $query = Conexion::conectar()->query($sql);

        return $query;
    }

    static function updateUsuario_u($id, $nombre, $email, $target_file)
    {
        $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email', ruta_archivo = '$target_file' WHERE id = '$id';";

        $query = Conexion::conectar()->query($sql);

        return $query;
    }

    static function updateUsuario_u2($id, $nombre, $email)
    {
        $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email' WHERE id = '$id';";

        $query = Conexion::conectar()->query($sql);

        return $query;
    }

    static function updateUsuario2($id, $nombre, $email, $pass, $tipoUsuario)
    {
        $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email', pass = '$pass', tipo_usuario = '$tipoUsuario' WHERE id = '$id';";

        $query = Conexion::conectar()->query($sql);

        return $query;
    }

    static function conntraseña($id, $email)
    {
        $sql = "SELECT U.pass FROM usuarios U WHERE U.id = '$id' AND U.email = '$email';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function usuarioUnico($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = '$email';";
        $query = Conexion::conectar()->query($sql);

        // Verifica si hay resultados
        if ($query && $query->num_rows > 0) {
            return true;  // Retorna true si encuentra al usuario
        } else {
            return false; // Retorna false si no encuentra el usuario
        }
    }

    static function usuarioUnico_editar($id, $email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = '$email' and id != $id;";
        $query = Conexion::conectar()->query($sql);

        // Verifica si hay resultados
        if ($query && $query->num_rows > 0) {
            return true;  // Retorna true si encuentra al usuario
        } else {
            return false; // Retorna false si no encuentra el usuario
        }
    }
}
