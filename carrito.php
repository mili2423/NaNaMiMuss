<?php
include("conexion.php");

$usuario_id = 1; // ID de usuario de prueba

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    // Capturamos el id que pasas por la URL
    $producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // --- ACCIÓN: AGREGAR ---
    if ($accion == 'agregar' && $producto_id > 0) {
        $chequear = $conexion->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
        
        if ($chequear && $chequear->num_rows > 0) {
            $fila = $chequear->fetch_assoc();
            $nueva_cantidad = $fila['cantidad'] + 1;
            $conexion->query("UPDATE carrito SET cantidad = $nueva_cantidad WHERE id = " . $fila['id']);
        } else {
            $conexion->query("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($usuario_id, $producto_id, 1)");
        }
    }

    // --- ACCIÓN: RESTAR ---
    if ($accion == 'restar' && $producto_id > 0) {
        // Corrección aquí: eliminamos el doble "conexion->conexion" que causaba error
        $chequear = $conexion->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
        
        if ($chequear && $chequear->num_rows > 0) {
            $fila = $chequear->fetch_assoc();
            if ($fila['cantidad'] > 1) {
                $nueva_cantidad = $fila['cantidad'] - 1;
                $conexion->query("UPDATE carrito SET cantidad = $nueva_cantidad WHERE id = " . $fila['id']);
            } else {
                // Si le queda 1 sola unidad y resta, se borra del carrito
                $conexion->query("DELETE FROM carrito WHERE id = " . $fila['id']);
            }
        }
    }

    // --- ACCIÓN: ELIMINAR UN PRODUCTO ---
    if ($accion == 'eliminar' && $producto_id > 0) {
        $conexion->query("DELETE FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
    }

    // --- ACCIÓN: VACIAR TODO EL CARRITO ---
    if ($accion == 'vaciar') {
        $conexion->query("DELETE FROM carrito WHERE usuario_id = $usuario_id");
    }

    // Redirección corregida a tu archivo real
    header("Location: IndexNanaMimus.php");
    exit();
}
?>