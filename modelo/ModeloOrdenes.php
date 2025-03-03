<?php

class ModeloOrdenes
{
    static function OrdenLista($id_orden)
    {
        $sql = "UPDATE ordenes SET estado = 'Entregado' WHERE id_orden = '$id_orden';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function insertarOrdenes($id_usuario, $fecha, $total)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
        $max = strlen($caracteres) - 1;

        for ($i = 0; $i < 5; $i++) {
            $codigo .= $caracteres[random_int(0, $max)];
        }

        $sql = "INSERT INTO ordenes(id_orden, id_usuario, fecha, total, codigo) VALUES(null, '$id_usuario', '$fecha', '$total', '$codigo');";
        $query = Conexion::conectar()->query($sql);
        if ($query) {
            self::actualizar_ordenes($id_usuario);
        }
        return $query;
    }


    static function actualizar_ordenes($id_usuario)
    {
        $orden = "SELECT MAX(id_orden) as total FROM ordenes;";
        $res = Conexion::conectar()->query($orden);
        $fila = $res->fetch_assoc();
        $last_orden = $fila['total'];
        $id_orden = $fila['total'] + 1;

        $sql = "UPDATE detalle_orden SET id_orden = '$id_orden' WHERE id_orden = '$last_orden' and id_usuario != '$id_usuario';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function insertarDetalleOrdenes($id_producto, $id_usuario, $cantidad, $precio_unitario)
    {
        $orden = "SELECT MAX(id_orden) as total FROM ordenes;";
        $res = Conexion::conectar()->query($orden);
        $fila = $res->fetch_assoc();
        $id_orden = $fila['total'] + 1;

        $sql = "INSERT INTO detalle_orden(id_detalle, id_orden, id_producto, id_usuario, cantidad, precio_unitario) 
        VALUES(null, '$id_orden', '$id_producto', '$id_usuario', '$cantidad', '$precio_unitario');";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function updateCantidad($id_producto, $id_usuario)
    {
        $orden = "SELECT MAX(id_orden) as total FROM ordenes;";
        $res = Conexion::conectar()->query($orden);
        $fila = $res->fetch_assoc();
        $id_orden = $fila['total'] + 1;

        $can = "SELECT cantidad FROM detalle_orden WHERE id_orden = '$id_orden' AND id_producto = '$id_producto' and id_usuario = '$id_usuario';";
        $res1 = Conexion::conectar()->query($can);
        $fila1 = $res1->fetch_assoc();
        $cantidad = $fila1['cantidad'] + 1;

        $sql = "UPDATE detalle_orden SET cantidad = '$cantidad' WHERE id_orden = '$id_orden' AND id_usuario = '$id_usuario' AND id_producto = '$id_producto';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function verificar($id_producto, $id_usuario)
    {
        $orden = "SELECT MAX(id_orden) as total FROM ordenes;";
        $res = Conexion::conectar()->query($orden);
        $fila = $res->fetch_assoc();
        $id_orden = $fila['total'] + 1;

        $sql = "SELECT * FROM detalle_orden WHERE id_producto = '$id_producto' and id_orden = '$id_orden' and id_usuario = '$id_usuario';";
        $query = Conexion::conectar()->query($sql);

        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    static function countProductos($id_usuario)
    {
        // Contar el número total de órdenes
        $orden = "SELECT MAX(id_orden) as total FROM ordenes;";
        $res = Conexion::conectar()->query($orden);
        $fila = $res->fetch_assoc();
        $id_orden = $fila['total'] + 1;

        // Sumar las cantidades de productos para el usuario y orden específicos
        $sql = "SELECT SUM(cantidad) as total_productos FROM detalle_orden WHERE id_usuario = '$id_usuario' AND id_orden = '$id_orden';";
        $query = Conexion::conectar()->query($sql);

        // Verificar si la consulta devolvió un resultado
        if ($fila = $query->fetch_assoc()) {
            return $fila['total_productos'] ?: 0; // Retorna 0 si el resultado es NULL
        } else {
            return 0; // Si no hay filas, retorna 0
        }
    }



    static function selectOrdenesUsuarios($id_usuario)
    {
        $sql = "SELECT * FROM  ordenes_view WHERE id_usuario = '$id_usuario';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectOrdenesgrafica()
    {
        $sql = "SELECT V.NOMBRE_Ordenes, COUNT(P.ID) FROM Ordenes V INNER JOIN postulacion P ON V.ID_Ordenes = P.ID_Ordenes WHERE P.ESTATUS = 1 GROUP BY V.ID_Ordenes;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectOrdenesView()
    {
        $sql = "SELECT * FROM  ordenes_view;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectDetalleOrdenView($id_usuario)
    {
        $orden = "SELECT MAX(id_orden) as total FROM ordenes;";
        $res = Conexion::conectar()->query($orden);
        $fila = $res->fetch_assoc();
        $id_orden = $fila['total'] + 1;

        $sql = "SELECT * FROM  detalle_orden_view WHERE id_orden = '$id_orden' AND id_usuario = '$id_usuario';";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }


    static function selectOrdenesById($id)
    {
        $sql = "SELECT * FROM ordenes where id_orden = $id;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function selectOrdenesByIdview($id)
    {
        $sql = "SELECT * FROM ordenes_view where id_orden = $id;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }

    static function deleteProductoOrden($id_producto, $id_usuario)
    {
        $orden = "SELECT MAX(id_orden) as total FROM ordenes;";
        $res = Conexion::conectar()->query($orden);
        $fila = $res->fetch_assoc();
        $id_orden = $fila['total'] + 1;

        $sql = "DELETE FROM detalle_orden WHERE id_producto = '$id_producto' and id_usuario = '$id_usuario' and id_orden = '$id_orden';";
        $query = Conexion::conectar()->query($sql);
        //echo $sql;
        return $query;
    }

    static function CountOrdenes()
    {
        $sql = "SELECT COUNT(ordenes.id_orden) AS total_ordenes FROM ordenes";
        $query = Conexion::conectar()->query($sql);
        $resultado = $query->fetch_assoc();
        $totalOrdenes = $resultado['total_ordenes'];
        return $totalOrdenes;
    }

    static function graficaOrdenes()
    {
        $sql = "SELECT nombre, SUM(cantidad) AS total_cantidad FROM detalle_orden_view GROUP BY nombre;";
        $query = Conexion::conectar()->query($sql);
        return $query;
    }
}
