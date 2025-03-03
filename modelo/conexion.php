<?php
class Conexion
{
    static function conectar()
    {
        $_conn = new mysqli('localhost', 'root', '', 'guerrerito');

        if ($_conn->connect_errno) {
            echo "Error";
        } else {
            //echo 'Connection established';
            return $_conn;
        }
    }
}
