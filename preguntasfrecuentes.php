<?php 
include("conexion.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes | Nana Mimus</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos_pf.css">
</head>
<body class="body-faq">

  <div class="navfija">
    <div class="navbar">
        <div class="navbar-left">
            <a href="indexNanaMimus.php">
                <img src="NanaMimus/logotipo.jpg" alt="Logo Nana Mimus" class="logo-tienda-horizontal">
            </a>
        </div>

        <div class="navbar-search">
            <form action="indexNanaMimus.php" method="GET" class="search-form">
                <input type="text" name="buscar" placeholder="¿Qué estás buscando?..." value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="navbar-right-container">
            <a href="preguntasfrecuentes.php" class="btn-ayuda active-ayuda">Ayuda</a>
            <div class="navbar-icons">
                <div class="icon-container">
                    <a href="#" onclick="toggleFavoritos()"><i class="fa-regular fa-heart"></i></a>
                    <span class="badge-contador" id="contadorFavoritos">1</span>
                </div>
                <div class="icon-container">
                    <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                    <span class="badge-contador" id="contadorCarrito">1</span>
                </div>
                <div class="icon-container">
                    <a href="micuenta.html"><i class="fa-regular fa-user"></i></a>
                </div>
            </div>
        </div>
    </div>
  </div>

  <main class="faq-main-container">
      
      <div class="faq-header-center">
          <span class="faq-top-badge">🌸 Centro de Ayuda</span>
          <h1 class="faq-main-title">Preguntas Frecuentes</h1>
          <p class="faq-subtitle">Encuentra respuestas rápidas a las dudas más comunes sobre nuestra tienda y productos.</p>
      </div>

      <div class="faq-categories-tabs">
          <button class="tab-btn active" onclick="filtrarFaq('todos', this)">Todos</button>
          <button class="tab-btn" onclick="filtrarFaq('envios', this)">Envíos</button>
          <button class="tab-btn" onclick="filtrarFaq('productos', this)">Productos</button>
          <button class="tab-btn" onclick="filtrarFaq('pedidos', this)">Pedidos</button>
          <button class="tab-btn" onclick="filtrarFaq('pagos', this)">Pagos</button>
      </div>

      <div class="faq-wrapper">
          
          <div class="faq-card" data-category="pagos">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator payments-tag">Pagos</span>
                      <h3>¿Cómo puedo pagar mi compra?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p><strong>Efectivo:</strong> Si compras con retiro en tienda, puedes pagar en efectivo al momento de retirar.<br><br>
                  <strong>Tarjeta de Débito o Crédito:</strong> A través de nuestro servicio seguro Webpay Plus puedes realizar tu pago de forma rápida.<br><br>
                  <strong>Transferencia Bancaria:</strong> Te enviaremos un correo con los datos bancarios. Recuerda enviar el comprobante para procesar tu envío.</p>
              </div>
          </div>

          <div class="faq-card" data-category="envios">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator shipping-tag">Envíos</span>
                      <h3>¿Cuánto tiempo demora mi pedido en llegar?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>El tiempo estimado de entrega varía entre <strong>2 a 5 días hábiles</strong>, dependiendo de tu ubicación y el método de despacho seleccionado.</p>
              </div>
          </div>

          <div class="faq-card" data-category="envios">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator shipping-tag">Envíos</span>
                      <h3>No ha llegado mi pedido ¿qué puedo hacer?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>Si excedió el tiempo estimado, escríbenos con tu número de seguimiento para revisar el estado logístico directamente con la paquetería.</p>
              </div>
          </div>

          <div class="faq-card" data-category="pedidos">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator orders-tag">Pedidos</span>
                      <h3>¿Puedo retirar mis compras en el local?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>¡Sí, claro! Elige la opción <strong>"Retiro en Tienda"</strong> al finalizar tu compra y procesaremos tu orden para que pases por ella sin costo adicional.</p>
              </div>
          </div>

          <div class="faq-card" data-category="envios">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator shipping-tag">Envíos</span>
                      <h3>¿Cuánto tengo que pagar por mi envío?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>El costo depende de la zona geográfica y el peso del paquete. Recuerda que tienes <strong>envío gratis</strong> si tu compra supera los $50.</p>
              </div>
          </div>

          <div class="faq-card" data-category="pagos">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator payments-tag">Pagos</span>
                      <h3>¿Cómo se protegen mis datos en la página?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>Contamos con certificados de seguridad SSL de alta gama, asegurando que tus transacciones y datos personales estén 100% encriptados.</p>
              </div>
          </div>

          <div class="faq-card" data-category="productos">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator products-tag">Productos</span>
                      <h3>¿Todos los productos son hechos a mano?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>¡Absolutamente! Nuestras flores tejidas y amigurumis son elaborados de forma artesanal, pieza por pieza, haciéndolos únicos.</p>
              </div>
          </div>

          <div class="faq-card" data-category="productos">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator products-tag">Productos</span>
                      <h3>¿Cómo cuido mis productos tejidos?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>Se recomienda lavarlos a mano con agua fría y jabón suave. Evita exprimir de forma brusca y déjalos secar en superficies horizontales a la sombra.</p>
              </div>
          </div>

          <div class="faq-card" data-category="pedidos">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator orders-tag">Pedidos</span>
                      <h3>No estoy conforme con mi pedido ¿Qué puedo hacer?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <p>Tienes hasta 30 días para solicitar cambios o devoluciones siempre que el producto se encuentre sin uso y en su empaque original.</p>
              </div>
          </div>

          <div class="faq-card" data-category="pedidos">
              <div class="faq-question-row">
                  <div class="question-title-wrapper">
                      <span class="category-indicator orders-tag">Pedidos</span>
                      <h3>¿Dónde los puedo encontrar?</h3>
                  </div>
                  <i class="fa-solid fa-plus toggle-icon"></i>
              </div>
              <div class="faq-answer-content">
                  <div class="map-responsive">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.5463721382414!2d-99.1686736!3d19.4326018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTXCsDI1JzU3LjQiTiA5OcKwMTAnMDcuMiJX!5e0!3m2!1ses!2smx!4v1700000000000!5m2!1ses!2smx" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                  </div>
              </div>
          </div>

      </div>

      <div class="contact-cards-grid">
          <div class="contact-box-card">
              <div class="contact-icon-pink"><i class="fa-regular fa-envelope"></i></div>
              <h4>Escríbenos</h4>
              <p>Respondemos en menos de 24 horas</p>
              <a href="mailto:hola@nanamimus.com" class="contact-link">hola@nanamimus.com</a>
          </div>
          <div class="contact-box-card">
              <div class="contact-icon-pink"><i class="fa-solid fa-phone"></i></div>
              <h4>Llámanos</h4>
              <p>Lun - Vie de 9:00 a 18:00</p>
              <a href="tel:+521234567890" class="contact-link">+52 123 456 7890</a>
          </div>
      </div>

      <div class="center-btn-wrapper">
          <a href="indexNanaMimus.php" class="btn-back-to-shop">
              <i class="fa-solid fa-store"></i> Volver a la tienda
          </a>
      </div>

  </main>

  <footer class="footer">
    <div class="footer-content">
      <div class="footer-section brand-info">
        <div class="brand-title">
          <span class="brand-logo-icon">🌸</span>
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
        <p><i class="fa-solid fa-envelope"></i> hola@nanamimus.com</p>
        <p><i class="fa-solid fa-phone"></i> +52 123 456 7890</p>
        <p><i class="fa-solid fa-location-dot"></i> Ciudad de México, México</p>
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
          <p>🚀 Envío gratis en compras mayores a $50</p>
        </div>
      </div>

      <div class="footer-section pagos">
        <div class="section-title">
          <i class="fa-regular fa-credit-card"></i>
          <h4>Métodos de Pago</h4>
        </div>
        <div class="payment-cards">
          <span class="card-brand">VISA</span>
          <span class="card-brand">MC</span>
          <span class="card-brand">AMEX</span>
        </div>
        <div class="info-badge secure-badge">
          <h5>Pago seguro</h5>
          <p>Todos tus datos están protegidos con encriptación SSL</p>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="bottom-container">
        <p class="copyright">© 2026 Nana Mimus. Hecho con ❤️ para ti</p>
        <div class="bottom-links">
          <a href="#">Términos y Condiciones</a>
          <a href="#">Política de Privacidad</a>
          <a href="preguntasfrecuentes.php">Preguntas Frecuentes</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="scrip_pf.js"></script>

</body>
</html>