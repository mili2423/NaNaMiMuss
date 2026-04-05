<?php

$servidor = "localhost";   // Servidor donde está alojada la base de datos
$usuario = "root";         // Usuario de la base de datos
$password = "";            // Contraseña del usuario
$base_datos = "nana_mimus"; // Nombre de la base de datos


$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
else{
    echo "conexion exitosa";
}

?>