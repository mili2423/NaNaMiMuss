<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilos_pf.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Preguntas Frecuentes | Nana Mimus</title>
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
            
            <a href="preguntasfrecuentes.html" class="btn-ayuda">Ayuda</a>

            <div class="navbar-icons">
                <div class="icon-container">
                    <a href="#" onclick="toggleFavoritos()">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    <span class="badge-contador" id="contadorFavoritos">1</span>
                </div>

                <div class="icon-container">
                    <a href="#">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <span class="badge-contador" id="contadorCarrito">1</span>
                </div>

                <div class="icon-container">
                    <a href="micuenta.html">
                        <i class="fa-regular fa-user"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
  </div>

  </div>
</div>
</head>
<body class="body_pf">
    <div class="volver-atras-container">
    <button onclick="history.back()" class="volver-atras">
      <i class="fa-solid fa-arrow-left"></i>
    </button>
    <section>
      <h1 class="titulosuperior">Preguntas Frecuentes</h1>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>¿Cómo puedo pagar mi compra?</h3> <!--pregunta 1-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>
            <strong>Efectivo:</strong> Si compras con retiro en tienda, puedes pagar con efectivo. <br>

            <br><strong>Tarjeta de Débito o Crédito:</strong> A través de nuestro servicio de Webpay Plus (Transbank) puedes realizar el pago de tu compra de una forma rápida y segura. <br>
                
            <br><strong>Transferencia Bancaria:</strong> Al realizar la compra y seleccionar la opción de transferencia bancaria, Modista te enviara un correo electrónico con los datos de tu pedido y nuestros datos bancarios para que puedas realizar transacción. No olvides incluir nuestro correo electrónico en el proceso para se nos envíe el comprobante y poder gestionar el despacho de tu pedido a la brevedad.
          </p>
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>¿Cuánto tiempo demora mi pedido en llegar?</h3> <!--pregunta 2-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>
            El tiempo de envío puede ser variable, dependerá de 3 variables: Peso del pedido, dirección de despacho, el courier seleccionado al momento de realizar el pedido, sin embargo podemos darte un estimado de el tiempo de envío:</p>
          </p>
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>No ha llegado mi pedido ¿qué puedo hacer?</h3> <!--pregunta 3-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>Los envíos de las compras realizadas en nuestra página web no son despachados directamente por Modista, este servicio nos lo proporciona "Ship It", una empresa de servicios logísticos que permite optimizar los procesos de envío. </p>
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>¿Puedo retirar mis compras en el local?</h3> <!--pregunta 4-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>¡Si, claro que puedes!, cuando hagas tu compra en nuestra tienda online (modista.cl), debes seleccionar "Retiro en tienda" al momento de seleccionar la opción de despacho. Nosotros tendremos tu pedido listo a la brevedad para que puedas retirarlo cuando gustes.</p>
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>¿Cuánto tengo que pagar por mi envío?</h3> <!--pregunta 5-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>El costo del envío dependerá del lugar geográfico en donde estés, del volumen y el peso de la orden.Las tarifas son entregadas por las diferentes compañías de logística a "Ship It". </p>
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>¿Cómo se protegen mis datos en la página?</h3> <!--pregunta 6-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
           <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae voluptatum accusamus maiores optio at consectetur in, velit nisi adipisci praesentium harum, magni dicta accusantium. Reiciendis fugiat ut sequi necessitatibus facere.</p>
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>Quiero hacer una consulta sobre mi compra ¿Cómo puedo hacerla?</h3> <!--pregunta 7-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>Para cualquier pregunta, consulta, comentario o sugerencia, te invitamos a escribirnos a nuestro correo contacto@modista.cl, también puedes llamarnos a través del teléfono: (562) 2 5976118. Estaremos dispuestos y encantados de ayudarte en lo que necesites.</p>
       </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>No estoy conforme con mi pedidio y deseo cambiarlo ¿Qué puedo hacer?</h3> <!--pregunta 8-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>Tienes 3 meses para realizar cualquier cambio o devolución de tu pedido, para ello debes tener la boleta asociada y el producto debe estar en perfecto estado, con su etiqueta, caja/bolsa y con todos los accesorios que incluía al momento de hacer la compra. </p>
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>Me llegó un producto defectuoso ¿Qué puedo hacer?</h3> <!--pregunta 9-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
          <p>Todos nuestros productos poseen una garantía legal de 3 meses contados a partir de la fecha de compra, en caso que presenten fallas o deficiencias de fábrica.</p>    
        </div>
      </div>
      <div class="tarjeta">
        <div class="pregunta_encabezado"><h3>¿Dónde los puedo encontrar?</h3> <!--pregunta 10-->
          <img class="fa fa-angle-up" aria-hidden="true" src="" alt="">
        </div>
        <div class="respuesta">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3406.8362916029555!2d-64.23292162498542!3d-31.36349649369547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9432993757127357%3A0x7e331f6a2fd91abc!2sGdor.%20Ortiz%20de%20Ocampo%2C%20X5000%20C%C3%B3rdoba!5e0!3m2!1ses!2sar!4v1743793062722!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div> 
      </div>
    </section>
    <script src="scrip_pf.js"></script>
     <br><br>
    
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
        <p class="copyright">&copy; 2026 Nana Mimus. Hecho con ❤️ para ti</p>
        <div class="bottom-links">
          <a href="#">Términos y Condiciones</a>
          <a href="#">Política de Privacidad</a>
          <a href="preguntasfrecuentes.html">Preguntas Frecuentes</a>
        </div>
      </div>
    </div>
  </footer>
    </body>
</html>