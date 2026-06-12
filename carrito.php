<?php
include("conexion.php");

$usuario_id = 1; // ID de usuario de prueba

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    $producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($accion == 'agregar' && $producto_id > 0) {
        // Buscar si el producto ya está en el carrito
        $chequear = $conexion->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
        
        if ($chequear && $chequear->num_rows > 0) {
            $fila = $chequear->fetch_assoc();
            $nueva_cantidad = $fila['cantidad'] + 1;
            $conexion->query("UPDATE carrito SET cantidad = $nueva_cantidad WHERE id = " . $fila['id']);
        } else {
            $conexion->query("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($usuario_id, $producto_id, 1)");
        }
    }

    if ($accion == 'restar' && $producto_id > 0) {
        $chequear = $conexion->conexion->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id") ?? $conexion->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
        if ($chequear && $chequear->num_rows > 0) {
            $fila = $chequear->fetch_assoc();
            if ($fila['cantidad'] > 1) {
                $nueva_cantidad = $fila['cantidad'] - 1;
                $conexion->query("UPDATE carrito SET cantidad = $nueva_cantidad WHERE id = " . $fila['id']);
            } else {
                $conexion->query("DELETE FROM carrito WHERE id = " . $fila['id']);
            }
        }
    }

    if ($accion == 'eliminar' && $producto_id > 0) {
        $conexion->query("DELETE FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
    }

    if ($accion == 'vaciar') {
        $conexion->query("DELETE FROM carrito WHERE usuario_id = $usuario_id");
    }

    // Regresa automáticamente al index para ver los cambios
    header("Location: index.php");
    exit();
}
?>