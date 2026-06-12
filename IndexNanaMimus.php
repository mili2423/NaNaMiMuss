<?php
include("conexion.php");

// Simulamos el usuario logueado con ID 1
$usuario_id = 1; 

// 1. Obtener tus productos de la DB
$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);

// 2. Obtener los elementos del pedido/carrito de forma segura desde tus tablas reales
$carrito_items = [];
$subtotal = 0;
$items_totales = 0;

// Verificación de seguridad: Comprobamos si las tablas realmente existen antes de consultar
$tabla_pedidos_existe = $conexion->query("SHOW TABLES LIKE 'pedidos'")->num_rows > 0;
$tabla_detalle_existe = $conexion->query("SHOW TABLES LIKE 'detalle_pedido'")->num_rows > 0;

if ($tabla_pedidos_existe && $tabla_detalle_existe) {
    // Buscamos si este usuario ya tiene un pedido "Pendiente" (que actúa como carrito)
    $query_pedido_activo = "SELECT id FROM pedidos WHERE usuario_id = $usuario_id AND estado = 'Pendiente' LIMIT 1";
    $res_pedido = $conexion->query($query_pedido_activo);

    if ($res_pedido && $res_pedido->num_rows > 0) {
        $pedido = $res_pedido->fetch_assoc();
        $pedido_id = $pedido['id'];

        // Traemos sus productos vinculados desde la tabla detalle_pedido
        $query_detalles = "SELECT dp.cantidad, p.id, p.nombre, p.precio, p.imagen 
                           FROM detalle_pedido dp 
                           JOIN productos p ON dp.producto_id = p.id 
                           WHERE dp.pedido_id = $pedido_id";
        
        $resultado_carrito = $conexion->query($query_detalles);

        if ($resultado_carrito && $resultado_carrito->num_rows > 0) {
            while ($fila = $resultado_carrito->fetch_assoc()) {
                $carrito_items[] = $fila;
                $subtotal += $fila['precio'] * $fila['cantidad'];
                $items_totales += $fila['cantidad'];
            }
        }
    }
}

// Parámetros de envío idénticos a tu Figma ($5.99 base, gratis a partir de $50.00)
$costo_envio = 5.99;
$meta_envio_gratis = 50.00;
$envio_gratis = ($subtotal >= $meta_envio_gratis || $subtotal == 0);
$total = $envio_gratis ? $subtotal : ($subtotal + $costo_envio);
$cuanto_falta = $meta_envio_gratis - $subtotal;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index | Nana Mimus</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="mas_prod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
</head>
<body>

  <div class="navfija">
    <div class="navbar">
        <div class="navbar-left">
            <a href="IndexNanaMimus.php">
                <img src="NanaMimus/logotipo.jpg" alt="Logo Nana Mimus" class="logo-redondo-tienda">
            </a>
        </div>

        <div class="navbar-search">
            <form action="IndexNanaMimus.php" method="GET" class="search-form">
                <input type="text" name="buscar" placeholder="¿Qué estás buscando?..." value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="navbar-right-container">
            <a href="preguntasfrecuentes.php" class="btn-ayuda">Ayuda</a>

            <div class="navbar-icons">
                <div class="icon-container">
                    <a href="#" onclick="toggleFavoritos()">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    <span class="badge-contador" id="contadorFavoritos">0</span>
                </div>

                <div class="icon-container">
                    <a href="#">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <span class="badge-contador" id="contadorCarrito"><?php echo $items_totales; ?></span>
                </div>

                <div class="icon-container">
                    <a href="iniciosesion.html">
                        <i class="fa-regular fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="menu">
    <ul id="box_search">
        <li><a href="#flores">Flores</a></li>
        <li><a href="#bebes">Ropa de bebé</a></li>
        <li><a href="#accesorio">Accesorios</a></li>
        <li><a href="#trajes">Trajes</a></li>
        <li><a href="#disfraz">Disfraces</a></li>
        <li><a href="sobrenosotros.html">Nosotros</a></li>
    </ul>
  </div>

  <div class="carousel">
    <ul>
        <li><img width="1580" height="450" src="NanaMimus/carrr1.jpg" alt=""></li>
        <li><img width="1580" height="450" src="NanaMimus/carrr2.jpg" alt=""></li>
        <li><img width="1580" height="450" src="NanaMimus/carrr3.jpg" alt=""></li>
        <li><img width="1580" height="450" src="NanaMimus/prueba2.jpg" alt=""></li>
        <li><img width="1580" height="450" src="NanaMimus/carrr7.jpg" alt=""></li>
    </ul>
  </div>

  <div class="main-layout-container" style="display: flex; width: 100%;">
      
      <div class="contenedor-productos" style="width: 73%; box-sizing: border-box;">
          <h2 style="font-family: 'Poppins', sans-serif; text-align: center; margin-top: 20px; color: #333;">✨ Productos Destacados ✨</h2>
          <section class="productos-container">
          <?php
          if ($resultado && $resultado->num_rows > 0) {
              while($producto = $resultado->fetch_assoc()) {
          ?>
              <div class="producto-card">
                  <a href="producto.php?id=<?php echo $producto['id']; ?>">
                      <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                  </a>

                  <?php if(isset($producto['descuento']) && $producto['descuento'] > 0){ ?>
                      <span class="badge-descuento">-<?php echo $producto['descuento']; ?>%</span>
                  <?php } ?>

                  <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>

                  <p class="precio">$<?php echo number_format($producto['precio'], 2, '.', ','); ?></p>
                  
                  <a href="carrito_accion.php?accion=agregar&id=<?php echo $producto['id']; ?>" class="btn-carrito" style="text-decoration: none; display: inline-block; text-align: center;">
                       Agregar al carrito
                  </a>
              </div>
          <?php
              }
          } else {
              echo "<p>No hay productos cargados en la base de datos.</p>";
          }
          ?>
          </section>
      </div>

      <div class="carrito-sidebar">
          <div class="carrito-header">
              <span class="carrito-titulo"><i class="fa-solid fa-cart-shopping" style="color: #d4428a;"></i> Mi Carrito</span>
              <span class="contador-badge"><?php echo $items_totales; ?> item<?php echo $items_totales != 1 ? 's':''; ?></span>
          </div>

          <div class="carrito-cuerpo">
              <?php if (empty($carrito_items)): ?>
                  <div class="carrito-vacio">
                      <div class="icono-vacio">🌸</div>
                      <p>Tu carrito está vacío</p>
                      <a href="#" class="btn-finalizar" style="margin-top:15px; padding: 10px; font-size:14px; text-decoration:none; display:block; text-align: center;">Seguir comprando</a>
                  </div>
              <?php else: ?>
                  <?php foreach ($carrito_items as $item): ?>
                      <div class="carrito-item">
                          <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="Miniatura">
                          <div class="item-detalles">
                              <div class="item-nombre"><?php echo htmlspecialchars($item['nombre']); ?></div>
                              <div class="item-precio">$<?php echo number_format($item['precio'], 2, '.', ','); ?></div>
                              <div class="item-controles">
                                  <a href="carrito_accion.php?accion=restar&id=<?php echo $item['id']; ?>" class="btn-control">-</a>
                                  <span style="font-weight: 500; font-size: 14px;"><?php echo $item['cantidad']; ?></span>
                                  <a href="carrito_accion.php?accion=agregar&id=<?php echo $item['id']; ?>" class="btn-control">+</a>
                              </div>
                          </div>
                          <a href="carrito_accion.php?accion=eliminar&id=<?php echo $item['id']; ?>" class="btn-eliminar"><i class="fa-solid fa-trash-can"></i></a>
                      </div>
                  <?php endforeach; ?>
              <?php endif; ?>
          </div>

          <?php if (!empty($carrito_items)): ?>
              <div class="carrito-footer">
                  <div class="linea-total">
                      <span>Envío:</span>
                      <span style="font-weight: 500 Freemium;"><?php echo $subtotal >= $meta_envio_gratis ? 'Gratis' : '$' . number_format($costo_envio, 2); ?></span>
                  </div>
                  
                  <?php if ($subtotal < $meta_envio_gratis): ?>
                      <div class="alerta-envio" style="font-size: 11px; color: #d4428a; text-align: center; margin: 8px 0;">
                          Agrega $<?php echo number_format($cuanto_falta, 2); ?> más para envío gratis ✨
                      </div>
                  <?php endif; ?>

                  <div class="linea-total" style="margin-top: 10px; border-top: 1px dashed #f0f0f0; padding-top: 10px;">
                      <span style="font-weight: bold; font-size: 16px; color: #333;">Total:</span>
                      <span class="monto-total" style="font-size: 20px; color: #d4428a; font-weight: 700;">$<?php echo number_format($total, 2, '.', ','); ?></span>
                  </div>

                  <button class="btn-finalizar" style="margin-top: 15px;">Finalizar Compra ✨</button>
                  <a href="carrito_accion.php?accion=vaciar" class="vaciar-enlace">Vaciar carrito</a>
              </div>
          <?php endif; ?>
      </div>

  </div> <footer class="footer">
    <div class="footer-content">
      <div class="footer-section brand-info">
        <div class="brand-title">
          <span class="brand-logo-icon">✨</span>
          <h4>Nana Mimus</h4>
        </div>
        <p class="brand-desc">Tu tienda de accesorios, flores tejidas y regalos aesthetic. Hecho con amor para momentos especiales.</p>
        <div class="social-icons">
          <a href="https://www.instagram.com/nana_mimus/" target="_blank" class="social-circle"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="social-circle"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social-circle"><i class="fa-solid fa-heart"></i></a>
        </div>
      </div>

      <div class="footer-section contacto">
        <div class="section-title">
          <i class="fa-regular fa-envelope"></i>
          <h4>Contacto</h4>
        </div>
        <p><i class="fa-solid fa-envelope"></i> NanaMimus@gmail.com</p>
        <p><i class="fa-solid fa-phone"></i> +54 0 3548-546978</p>
        <p><i class="fa-solid fa-location-dot"></i> La Falda, Córdoba, Argentina</p>
      </div>

      <div class="footer-section horarios">
        <div class="section-title">
          <i class="fa-regular fa-clock"></i>
          <h4>Horarios</h4>
        </div>
        <div class="schedule-grid">
          <span class="day">Lunes - Viernes</span> <span class="time">9:00 - 18:00</span>
          <span class="day">Sábado</span> <span class="time">10:00 - 16:00</span>
          <span class="day">Domingo</span> <span class="time closing">Cerrado</span>
        </div>
        <div class="info-badge highlight-badge">
          <p>🚀 Envío gratis en compras mayores a $50.00</p>
        </div>
      </div>

      <div class="footer-section pagos">
        <div class="section-title">
          <i class="fa-regular fa-credit-card"></i>
          <h4>Métodos de Pago</h4>
        </div>
        <div class="payment-cards">
          <span class="card-brand">VISA</span>
          <span class="card-brand">Mastercard</span>
          <span class="card-brand">PayPal</span>
        </div>
        <div class="info-badge secure-badge">
          <h5>Pago seguro</h5>
          <p>Todos tus datos están protegidos con encriptación SSL</p>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="bottom-container">
        <p class="copyright">&copy; 2026 Nana Mimus. Hecho con ❤️ para ti</p>
        <div class="bottom-links">
          <a href="#">Términos y Condiciones</a>
          <a href="#">Política de Privacidad</a>
          <a href="preguntasfrecuentes.html">Preguntas Frecuentes</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="productos.js"></script> 
</body> 
</html>