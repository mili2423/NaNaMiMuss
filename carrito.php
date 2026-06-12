<?php
include("conexion.php");

// Configurar para que devuelva respuestas JSON legibles por JS
header('Content-Type: application/json');

$usuario_id = 1; // Tu ID de usuario por defecto

// CAPTURA BLINDADA: Leemos de todas las formas posibles (POST JSON, POST NORMAL O GET)
$data = json_decode(file_get_contents('php://input'), true);

$accion = $_GET['accion'] ?? $data['accion'] ?? $_POST['accion'] ?? '';
$producto_id = intval($_GET['id'] ?? $data['id'] ?? $_POST['id'] ?? 0);

if (empty($accion)) {
    echo json_encode(['success' => false, 'error' => 'No se especificó ninguna acción en el backend.']);
    exit();
}

// --- PROCESAR ACCIONES DIRECTAS EN BASE DE DATOS ---
if ($accion == 'agregar' && $producto_id > 0) {
    // 1. Verificamos si ya existe el producto para ese usuario
    $chequear = $conexion->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
    
    if ($chequear && $chequear->num_rows > 0) {
        $fila = $chequear->fetch_assoc();
        $nueva_cantidad = $fila['cantidad'] + 1;
        $conexion->query("UPDATE carrito SET cantidad = $nueva_cantidad WHERE id = " . $fila['id']);
    } else {
        // 2. Si es nuevo, lo insertamos
        $conexion->query("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($usuario_id, $producto_id, 1)");
    }
}

// ... (Los bloques de restar, eliminar y vaciar se quedan igual de impecables)
if ($accion == 'restar' && $producto_id > 0) {
    $chequear = $conexion->query("SELECT id, cantidad FROM carrito WHERE usuario_id = $usuario_id AND producto_id = $producto_id");
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

// --- LEER EL CARRITO ACTUALIZADO DESDE LA BD ---
$query_carrito = "SELECT c.id AS carrito_id, p.id AS producto_id, p.nombre, p.precio, p.imagen1, c.cantidad 
                  FROM carrito c 
                  INNER JOIN productos p ON c.producto_id = p.id 
                  WHERE c.usuario_id = $usuario_id";

$resultado_carrito = $conexion->query($query_carrito);

$subtotal = 0;
$items_totales = 0;
$items = [];

if ($resultado_carrito && $resultado_carrito->num_rows > 0) {
    while ($fila = $resultado_carrito->fetch_assoc()) {
        $subtotal += $fila['precio'] * $fila['cantidad'];
        $items_totales += $fila['cantidad'];
        
        $items[] = [
            'carrito_id' => $fila['carrito_id'],
            'producto_id' => $fila['producto_id'],
            'nombre' => $fila['nombre'],
            'precio' => floatval($fila['precio']),
            'imagen1' => $fila['imagen1'],
            'cantidad' => intval($fila['cantidad']),
            'subtotal_item' => floatval($fila['precio'] * $fila['cantidad'])
        ];
    }
}

$costo_envio = ($subtotal > 0 && $subtotal < 50000) ? 5.99 : 0; 
$total = $subtotal + $costo_envio;
$falta_para_envio_gratis = max(0, 50000 - $subtotal);

echo json_encode([
    'success' => true,
    'items' => $items,
    'items_totales' => $items_totales,
    'subtotal' => $subtotal,
    'costo_envio' => $costo_envio,
    'total' => $total,
    'falta_para_envio_gratis' => $falta_para_envio_gratis
]);
exit();
?>