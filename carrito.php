<?php
include 'conexion.php';

$usuario_id = 1; // Simulamos que el usuario "Invitado" o Logueado es el ID 1

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    $producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($accion == 'agregar' && $producto_id > 0) {
        // Comprobar si el producto ya existe en el carrito para este usuario
        $chequear = $conn->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
        
        if ($chequear->num_rows > 0) {
            // Si ya existe, incrementamos la cantidad
            $fila = $chequear->fetch_assoc();
            $nueva_cantidad = $fila['cantidad'] + 1;
            $conn->query("UPDATE carrito SET cantidad = $nueva_cantidad WHERE id = " . $fila['id']);
        } else {
            // Si no existe, se inserta nuevo registro usando tus columnas
            $conn->query("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($usuario_id, $producto_id, 1)");
        }
    }

    if ($accion == 'restar' && $producto_id > 0) {
        $chequear = $conn->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
        if ($chequear->num_rows > 0) {
            $fila = $chequear->fetch_assoc();
            if ($fila['cantidad'] > 1) {
                $nueva_cantidad = $fila['cantidad'] - 1;
                $conn->query("UPDATE carrito SET cantidad = $nueva_cantidad WHERE id = " . $fila['id']);
            } else {
                $conn->query("DELETE FROM carrito WHERE id = " . $fila['id']);
            }
        }
    }

    if ($accion == 'eliminar' && $producto_id > 0) {
        $conn->query("DELETE FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
    }

    if ($accion == 'vaciar') {
        $conn->query("DELETE FROM carrito WHERE usuario_id = $usuario_id");
    }

    header("Location: index.php");
    exit();
}
?>