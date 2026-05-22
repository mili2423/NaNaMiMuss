<?php

$conexion = new mysqli("localhost", "root", "", "NanaMimus");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT * FROM productos";

$resultado = $conexion->query($sql);

$productos = [];

while($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
}

echo json_encode($productos);

?>