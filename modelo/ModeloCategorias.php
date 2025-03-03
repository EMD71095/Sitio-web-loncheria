<?php

    class ModeloCategorias
    {

        static function insertarCategorias($nombre, $descripcion)
        {
            $sql = "INSERT INTO categorias(id_categoria, nombre, descripcion) 
            VALUES(null, '$nombre', '$descripcion');";

            $query = Conexion::conectar()->query($sql);

            return $query;
        }

        static function filtroCategorias($id)
        {
            $sql = "SELECT * FROM productos WHERE id_categoria = '$id'";
            $query = Conexion::conectar()->query($sql);
            return $query;
        }


        static function selectCategorias()
        {
            $sql = "SELECT * FROM  categorias;";
            $query = Conexion::conectar()->query($sql);
            return $query;
        }
        

        static function selectCategoriasById($id)
        {
            $sql = "SELECT * FROM categorias where id_categoria = $id;";

            $query = Conexion::conectar()->query($sql);

            return $query;
        }

        static function updateCategorias($id, $nombre, $descripcion)
        {
            $sql = "UPDATE categorias set nombre = '$nombre', descripcion = '$descripcion' where id_categoria = '$id';";

            $query = Conexion::conectar()->query($sql);

            return $query;
        }

        static function deleteCategorias($id)
        {
            $sql = "DELETE from categorias where id_categoria = $id;";

            $query = Conexion::conectar()->query($sql);

            return $query;
        }

        //funcion para consultar todos los programas

    }


?>