<?php 
include("conexion.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Carrito | Nana Mimus</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos_carrito.css">
</head>
<body class="body-carrito">

  <!-- NAVBAR (Igual a tus otros archivos) -->
  <div class="navfija">
    <div class="navbar">
        <div class="navbar-left">
            <a href="indexNanaMimus.php">
                <img src="NanaMimus/logotipo.jpg" alt="Logo Nana Mimus" class="logo-tienda-horizontal">
            </a>
        </div>
        <div class="navbar-search">
            <form action="indexNanaMimus.php" method="GET" class="search-form">
                <input type="text" name="buscar" placeholder="¿Qué estás buscando?...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="navbar-right-container">
            <a href="preguntasfrecuentes.php" class="btn-ayuda">Ayuda</a>
            <div class="navbar-icons">
                <div class="icon-container">
                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                    <span class="badge-contador" id="contadorFavoritos">0</span>
                </div>
                <div class="icon-container">
                    <a href="carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <span class="badge-contador" id="contadorCarrito">0</span>
                </div>
                <div class="icon-container">
                    <a href="micuenta.html"><i class="fa-regular fa-user"></i></a>
                </div>
            </div>
        </div>
    </div>
  </div>

  <!-- CONTENEDOR DEL CARRITO -->
  <main class="carrito-container">
      <h1 class="carrito-title">🌸 Tu Carrito de Compras</h1>

      <div class="carrito-wrapper" id="carritoWrapper">
          <!-- Las tarjetas de productos se inyectan dinámicamente con JS -->
          <div class="carrito-productos" id="listaProductos">
              <!-- JS va a poner los productos aquí -->
          </div>

          <!-- RESUMEN DE COMPRA -->
          <aside class="carrito-resumen">
              <h3>Resumen del Pedido</h3>
              <div class="resumen-item">
                  <span>Subtotal</span>
                  <span id="resumenSubtotal">$0.00</span>
              </div>
              <div class="resumen-item">
                  <span>Envío</span>
                  <span id="resumenEnvio" class="envio-gratis">Gratis</span>
              </div>
              <hr>
              <div class="resumen-item total">
                  <span>Total</span>
                  <span id="resumenTotal">$0.00</span>
              </div>

              <div class="envio-alert" id="alertaEnvio">
                  🎉 ¡Felicidades! Tienes envío gratis.
              </div>

              <button class="btn-proceder-pago" onclick="procederAlPago()">
                  Proceder al pago <i class="fa-solid fa-arrow-right"></i>
              </button>
              
              <a href="indexNanaMimus.php" class="btn-seguir-comprando">
                  <i class="fa-solid fa-bag-shopping"></i> Seguir comprando
              </a>
          </aside>
      </div>

      <!-- MENSAJE DE CARRITO VACÍO (Oculto por defecto) -->
      <div class="carrito-vacio" id="carritoVacio" style="display: none;">
          <div class="vacio-icon">🛒</div>
          <h2>Tu carrito está vacío</h2>
          <p>¿Aún no sabes qué regalar? Explora nuestras hermosas flores tejidas y artículos aesthetic.</p>
          <a href="indexNanaMimus.php" class="btn-volver-tienda">Ver Productos</a>
      </div>
  </main>

  <!-- JS del Carrito -->
  <script src="carrito.js"></script>
</body>
</html>