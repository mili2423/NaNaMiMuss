document.addEventListener("DOMContentLoaded", () => {
    // Al cargar la página, listamos el estado inicial del carrito desde la base de datos
    actualizarInterfazCarrito('listar', 0);

    const popUpCarrito = document.getElementById('sidebarCarrito');
    const btnCerrar = document.getElementById('close-cart-btn');

    // Cerrar la barra lateral con el botón X de Figma
    if (btnCerrar) {
        btnCerrar.addEventListener('click', () => {
            popUpCarrito.classList.add('hidden');
        });
    }

    // Cerrar si hacen clic fuera del panel blanco (en el fondo oscuro)
    if (popUpCarrito) {
        popUpCarrito.addEventListener('click', (e) => {
            if (e.target === popUpCarrito) {
                popUpCarrito.classList.add('hidden');
            }
        });
    }
});

// Función global que se ejecuta al presionar "Agregar al carrito" en tu catálogo PHP
function ejecutarCarrito(accion, idProducto = 0) {
    actualizarInterfazCarrito(accion, idProducto);
}

function actualizarInterfazCarrito(accion, idProducto) {
    // Petición asíncrona a tu backend PHP
    fetch(`carrito.php?accion=${accion}&id=${idProducto}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error("Error en el servidor:", data.error);
                return;
            }

            // 1. Actualizar los contadores globales en tu Navbar (Insignias rosas)
            const contadorNavbar = document.getElementById('contadorCarrito');
            const contadorBadgeSidebar = document.getElementById('cart-badge-count');
            
            if (contadorNavbar) {
                contadorNavbar.textContent = data.items_totales;
            }
            if (contadorBadgeSidebar) {
                contadorBadgeSidebar.textContent = `${data.items_totales} item${data.items_totales !== 1 ? 's' : ''}`;
            }

            // Contenedor interno donde se renderizan los datos dinámicos
            const wrapper = document.getElementById('wrapper-dinamico-carrito');
            if (!wrapper) return;

            // --- ESTADO: CARRITO VACÍO (Figma 1) ---
            if (data.items.length === 0) {
                wrapper.innerHTML = `
                    <div class="carrito-vacio">
                        <div class="icon-bag">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#ff409f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                        </div>
                        <p>Tu carrito está vacío</p>
                        <button class="btn-seguir" onclick="document.getElementById('sidebarCarrito').classList.add('hidden')">Seguir comprando</button>
                    </div>
                `;
                return;
            }

            // --- ESTADO: CON PRODUCTOS (Figma 2) ---
            let productosHTML = '';
            data.items.forEach(item => {
                productosHTML += `
                    <div class="producto-card">
                        <img src="${item.imagen1}" alt="${item.nombre}" class="producto-img">
                        <div class="producto-info">
                            <h4>${item.nombre}</h4>
                            <span class="producto-precio">$${item.precio.toFixed(2)}</span>
                            <div class="controles-cantidad">
                                <button class="btn-qty" onclick="ejecutarCarrito('restar', ${item.producto_id})">-</button>
                                <span style="font-family: 'Poppins', sans-serif; font-weight: 500; color: #1e293b;">${item.cantidad}</span>
                                <button class="btn-qty" onclick="ejecutarCarrito('agregar', ${item.producto_id})">+</button>
                            </div>
                        </div>
                        <button class="btn-delete" onclick="ejecutarCarrito('eliminar', ${item.producto_id})">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                        <span class="subtotal-item">$${item.subtotal_item.toFixed(2)}</span>
                    </div>
                `;
            });

            // Lógica de cálculo estético para envío gratis de Nana Mimus
            let textoAlertaEnvio = data.falta_para_envio_gratis > 0 
                ? `Agrega $${data.falta_para_envio_gratis.toFixed(2)} más para envío gratis`
                : `¡Felicidades! Tienes envío gratis 🎁`;

            let textoPrecioEnvio = data.costo_envio > 0 ? `$${data.costo_envio.toFixed(2)}` : 'Gratis';

            // Inyectamos la estructura limpia respetando el scroll y el footer fijo
            wrapper.innerHTML = `
                <div class="carrito-contenido">
                    <div class="lista-productos">
                        ${productosHTML}
                    </div>

                    <div class="carrito-resumen">
                        <div class="resumen-fila">
                            <span>Envío</span>
                            <span style="font-weight: 500; color: #1e293b;">${textoPrecioEnvio}</span>
                        </div>
                        
                        <p class="alerta-envio">${textoAlertaEnvio}</p>
                        
                        <div class="resumen-fila total-fila">
                            <strong>Total</strong>
                            <strong>$${data.total.toFixed(2)}</strong>
                        </div>

                        <button class="btn-finalizar" onclick="location.href='checkout.php'">Finalizar Compra ✨</button>
                        <button class="btn-vaciar" onclick="ejecutarCarrito('vaciar')">Vaciar carrito</button>
                    </div>
                </div>
            `;

            // REGLA DE ORO: Si el usuario presionó el botón rosa de tu catálogo, abrimos el Drawer automáticamente hacia la derecha
            if (accion === 'agregar') {
                const popUpCarrito = document.getElementById('sidebarCarrito');
                if (popUpCarrito) {
                    popUpCarrito.classList.remove('hidden');
                }
            }
        })
        .catch(error => console.error("Error crítico procesando el carrito interactivo:", error));
}