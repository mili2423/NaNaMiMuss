<?php 
include("conexion.php"); 

$usuario_id = 1; // ID de usuario de prueba (debe coincidir con carrito.php)

// 1. CONSULTA PARA EL CONTADOR DE LA NAVBAR Y DETALLES DEL CARRITO
$query_carrito = "SELECT c.id AS carrito_id, p.id AS producto_id, p.nombre, p.precio, p.imagen1, c.cantidad 
                  FROM carrito c 
                  INNER JOIN productos p ON c.producto_id = p.id 
                  WHERE c.usuario_id = $usuario_id";

$resultado_carrito = $conexion->query($query_carrito);

$subtotal = 0;
$items_totales = 0;
$productos_en_carrito = [];

if ($resultado_carrito && $resultado_carrito->num_rows > 0) {
    while ($fila = $resultado_carrito->fetch_assoc()) {
        $productos_en_carrito[] = $fila;
        $subtotal += $fila['precio'] * $fila['cantidad'];
        $items_totales += $fila['cantidad'];
    }
}

// Lógica de envíos (Envío gratis a partir de $50,000 según tu footer)
$costo_envio = ($subtotal > 0 && $subtotal < 50000) ? 5.99 : 0; 
$total = $subtotal + $costo_envio;
$falta_para_envio_gratis = 50000 - $subtotal;
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
</head>
<body>

  <div class="navfija">
    <div class="navbar">
        
        <div class="navbar-left">
            <a href="indexNanaMimus.php">
                <img src="NanaMimus/logotipo.jpg" alt="Logo Nana Mimus" class="logo-redondo-tienda">
            </a>
        </div>

        <div class="navbar-search">
            <form action="indexNanaMimus.php" method="GET" class="search-form">
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
                    <a href="#" onclick="toggleCarrito(event)">
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

  <div class="contenedor-productos">
    <?php
    // Búsqueda de productos si se usó el buscador de la navbar
    $buscar = isset($_GET['buscar']) ? $conexion->real_escape_string($_GET['buscar']) : '';
    $sql = "SELECT * FROM productos WHERE activo = 1";
    if ($buscar != '') {
        $sql .= " AND (nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%')";
    }
    $resultado = $conexion->query($sql);
    ?>
    <main id="lista-categorias" class="productos-secciones">
        <div style="display: flex; gap: 20px; flex-wrap: wrap; padding: 20px; justify-content: center;">
            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <?php while($producto = $resultado->fetch_assoc()): ?>
                    <div style="background: white; padding: 15px; border-radius: 15px; border: 1px solid #fdeef5; text-align: center; width: 220px; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                        <img src="<?php echo $producto['imagen1']; ?>" alt="" style="width: 100%; height: 180px; object-fit: cover; border-radius: 10px;">
                        <h4 style="margin: 10px 0 5px 0; font-size: 0.95rem; color: #333;"><?php echo $producto['nombre']; ?></h4>
                        <p style="color: #ff409f; font-weight: bold; margin: 0 0 12px 0;">$<?php echo number_format($producto['precio'], 2); ?></p>
                        <a href="carrito.php?accion=agregar&id=<?php echo $producto['id']; ?>" style="background:#ff409f; color:white; padding:8px 16px; border-radius:20px; text-decoration:none; font-size:13px; font-weight: 500; display: inline-block;">+ Agregar</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No se encontraron productos disponibles.</p>
            <?php endif; ?>
        </div>
    </main>
  </div>

  <div class="carrito-sidebar hidden" id="sidebarCarrito">
      <div class="carrito-header">
          <div style="display: flex; align-items: center; gap: 10px;">
              <span style="font-size: 1.3rem;">🛒</span>
              <h2 style="margin: 0; font-size: 1.2rem; color: #333;">Mi Carrito</h2>
              <?php if ($items_totales > 0): ?>
                  <span class="badge"><?php echo $items_totales; ?> item<?php echo $items_totales > 1 ? 's' : ''; ?></span>
              <?php endif; ?>
          </div>
          <button class="close-btn" onclick="cerrarCarrito()">&times;</button>
      </div>

      <?php if (empty($productos_en_carrito)): ?>
          <div class="carrito-vacio">
              <div class="icon-bag">
                  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff409f" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
              </div>
              <p style="margin: 0; color: #666;">Tu carrito está vacío</p>
              <a href="#" class="btn-seguir" onclick="cerrarCarrito()">Seguir comprando</a>
          </div>
      <?php else: ?>
          <div class="carrito-contenido">
              <div class="lista-productos">
                  <?php foreach ($productos_en_carrito as $item): 
                      $subtotal_item = $item['precio'] * $item['cantidad'];
                  ?>
                      <div class="producto-card">
                          <img src="<?php echo $item['imagen1']; ?>" alt="" class="producto-img">
                          <div class="producto-info">
                              <h4><?php echo $item['nombre']; ?></h4>
                              <span class="producto-precio">$<?php echo number_format($item['precio'], 2); ?></span>
                              <div class="controles-cantidad">
                                  <a href="carrito.php?accion=restar&id=<?php echo $item['producto_id']; ?>" class="btn-qty">-</a>
                                  <span><?php echo $item['cantidad']; ?></span>
                                  <a href="carrito.php?accion=agregar&id=<?php echo $item['producto_id']; ?>" class="btn-qty">+</a>
                              </div>
                          </div>
                          <a href="carrito.php?accion=eliminar&id=<?php echo $item['producto_id']; ?>" class="btn-delete">
                              <i class="fa-solid fa-trash-can"></i>
                          </a>
                          <span class="subtotal-item">$<?php echo number_format($subtotal_item, 2); ?></span>
                      </div>
                  <?php endforeach; ?>
              </div>

              <div class="carrito-resumen">
                  <div class="resumen-fila">
                      <span>Envío</span>
                      <span><?php echo $costo_envio > 0 ? '$' . number_format($costo_envio, 2) : 'Gratis'; ?></span>
                  </div>
                  
                  <p class="alerta-envio">
                      <?php if ($falta_para_envio_gratis > 0): ?>
                          Agrega $<?php echo number_format($falta_para_envio_gratis, 2); ?> más para envío gratis
                      <?php else: ?>
                          ¡Felicidades! Tienes envío gratis 🎁
                      <?php endif; ?>
                  </p>
                  
                  <div class="resumen-fila total-fila">
                      <strong>Total</strong>
                      <strong>$<?php echo number_format($total, 2); ?></strong>
                  </div>

                  <button class="btn-finalizar" onclick="alert('¡Compra Procesada con éxito!')">Finalizar Compra ✨</button>
                  <div style="text-align: center; margin-top: 10px;">
                      <a href="carrito.php?accion=vaciar" class="btn-vaciar">Vaciar carrito</a>
                  </div>
              </div>
          </div>
      <?php endif; ?>
  </div>

  <script src="productos.js"></script>
  <script src="index.js"></script>
  <script src="favoritos.js"></script>
  <script src="carrito.js"></script>
  
  <script>
    function toggleCarrito(event) {
        if(event) event.preventDefault();
        const sidebar = document.getElementById('sidebarCarrito');
        sidebar.classList.toggle('hidden');
    }
    function cerrarCarrito() {
        document.getElementById('sidebarCarrito').classList.add('hidden');
    }
  </script>
</body>                 

<footer class="footer">
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
        <p>🚀 Envío gratis en compras mayores a $50000</p>
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
</html>