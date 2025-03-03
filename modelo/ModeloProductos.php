<?php

class ModeloProductos
{

    static function insertarProductos($nombre,$descripcion, $precio, $imagen, $id_categoria)
    {
        $sql = "INSERT INTO productos(id_producto, nombre, descripcion, precio, imagen, id_categoria) 
            VALUES(null, '$nombre', '$descripcion', '$precio', '$imagen', '$id_categoria');";

        $query = Conexion::conectar()->query($sql);

        return $query;
    }


    static function selectProductos()
    {
        $sql = "SELECT * FROM  productos;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectProductosgrafica()
    {
        $sql = "SELECT V.NOMBRE_productos, COUNT(P.ID) FROM productos V INNER JOIN postulacion P ON V.ID_productos = P.ID_productos WHERE P.ESTATUS = 1 GROUP BY V.ID_productos;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectProductosview()
    {
        $sql = "SELECT * FROM  productos_view;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectProductosviewLimit($inicio)
    {
        $sql = "SELECT * FROM  productos_view LIMIT $inicio, 9;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }


    static function selectproductosById($id)
    {
        $sql = "SELECT * FROM productos where id_producto = $id;";

        $query = Conexion::conectar()->query($sql);

        return $query;
    }

    static function selectproductosByIdview($id)
    {
        $sql = "SELECT * FROM productos_view where id_producto = $id;";

        $query = Conexion::conectar()->query($sql);

        return $query;
    }

    static function updateProductos($id, $nombre,$descripcion, $precio, $imagen, $id_categoria)
    {
        $sql = "UPDATE productos set nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', imagen = '$imagen', id_categoria = '$id_categoria' where id_producto = '$id';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function updateProductos2($id, $nombre,$descripcion, $precio, $id_categoria)
    {
        $sql = "UPDATE productos set nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', id_categoria = '$id_categoria' where id_producto = '$id';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function deleteProductos($id)
    {
        $sql = "DELETE from productos where id_producto = $id;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }


    static function buscarProducto($nombre)
    {
        $sql = "SELECT * FROM productos_view WHERE nombre LIKE CONCAT('%', '$nombre', '%');";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }
}
