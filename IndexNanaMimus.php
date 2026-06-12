<?php 
include("conexion.php"); 
$usuario_id = 1;

// Consulta rápida inicial solo para que la página cargue con el contador correcto en la Navbar
$res_cont = $conexion->query("SELECT SUM(cantidad) AS total FROM carrito WHERE usuario_id = $usuario_id");
$fila_cont = $res_cont->fetch_assoc();
$items_iniciales = $fila_cont['total'] ?? 0;
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
    <link rel="stylesheet" href="style.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
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
                    <a href="#" onclick="toggleFavoritos()"><i class="fa-regular fa-heart"></i></a>
                    <span class="badge-contador" id="contadorFavoritos">0</span>
                </div>

                <div class="icon-container">
                    <a href="#" id="cart-icon-btn"><i class="fa-solid fa-cart-shopping"></i></a>
                    <span class="badge-contador" id="contadorCarrito"><?php echo $items_iniciales; ?></span>
                </div>

                <div class="icon-container">
                    <a href="iniciosesion.html"><i class="fa-regular fa-user"></i></a>
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
                        
                        <button onclick="ejecutarCarrito('agregar', <?php echo $producto['id']; ?>)" style="background:#ff409f; color:white; padding:8px 16px; border-radius:20px; border:none; cursor:pointer; font-size:13px; font-weight: 500; display: inline-block;">+ Agregar</button>
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
              <span class="badge" id="cart-badge-count">0 items</span>
          </div>
          <button class="close-btn" id="close-cart-btn">&times;</button>
      </div>

      <div id="wrapper-dinamico-carrito" style="height: 100%; display: flex; flex-direction: column;"></div>
  </div>

  <script src="productos.js"></script>
  <script src="index.js"></script>
  <script src="favoritos.js"></script>
  
  <script src="carrito.js"></script>
</body>                 

<footer class="footer">
  </footer>
</html>