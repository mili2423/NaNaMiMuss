document.addEventListener("DOMContentLoaded", () => {
    // Al cargar la página, traemos el estado real desde la base de datos
    actualizarInterfazCarrito('listar', 0);

    const popUpCarrito = document.getElementById('sidebarCarrito');
    const btnAbrir = document.getElementById('cart-icon-btn');
    const btnCerrar = document.getElementById('close-cart-btn');

    // Abrir lateral de Figma
    if (btnAbrir) {
        btnAbrir.addEventListener('click', (e) => {
            e.preventDefault();
            popUpCarrito.classList.remove('hidden');
        });
    }

    // Cerrar lateral de Figma con la X
    if (btnCerrar) {
        btnCerrar.addEventListener('click', () => {
            popUpCarrito.classList.add('hidden');
        });
    }

    // Cerrar si hacen click en el fondo oscuro
    if (popUpCarrito) {
        popUpCarrito.addEventListener('click', (e) => {
            if (e.target === popUpCarrito) {
                popUpCarrito.classList.add('hidden');
            }
        });
    }
});

function ejecutarCarrito(accion, idProducto = 0) {
    actualizarInterfazCarrito(accion, idProducto);
}

function actualizarInterfazCarrito(accion, idProducto) {
    fetch(`carrito.php?accion=${accion}&id=${idProducto}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error("Error devuelto por PHP:", data.error);
                return;
            }

            // Sincronizar badges e insignias
            document.getElementById('contadorCarrito').textContent = data.items_totales;
            document.getElementById('cart-badge-count').textContent = `${data.items_totales} item${data.items_totales !== 1 ? 's' : ''}`;

            const wrapper = document.getElementById('wrapper-dinamico-carrito');

            // --- DISEÑO VACÍO ---
            if (data.items.length === 0) {
                wrapper.innerHTML = `
                    <div class="carrito-vacio">
                        <div class="icon-bag">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ff409f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        </div>
                        <p>Tu carrito está vacío</p>
                        <button class="btn-seguir" onclick="document.getElementById('sidebarCarrito').classList.add('hidden')">Seguir comprando</button>
                    </div>
                `;
                return;
            }

            // --- DISEÑO CON ARTÍCULOS ---
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
                                <span style="font-family: 'Poppins', sans-serif; font-weight: 500; color: #333;">${item.cantidad}</span>
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

            let textoAlertaEnvio = data.falta_para_envio_gratis > 0 
                ? `Agrega $${data.falta_para_envio_gratis.toFixed(2)} más para envío gratis`
                : `¡Felicidades! Tienes envío gratis 🎁`;

            let textoPrecioEnvio = data.costo_envio > 0 ? `$${data.costo_envio.toFixed(2)}` : 'Gratis';

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
                            <strong style="color: #ff409f;">$${data.total.toFixed(2)}</strong>
                        </div>

                        <button class="btn-finalizar" onclick="alert('Finalizando tu compra en Nana Mimus ✨')">Finalizar Compra ✨</button>
                        <div style="text-align: center; margin-top: 12px;">
                            <button class="btn-vaciar" onclick="ejecutarCarrito('vaciar')">Vaciar carrito</button>
                        </div>
                    </div>
                </div>
            `;

            // Si el usuario sumó un ítem desde el catálogo externo, abrimos el drawer automáticamente
            if (accion === 'agregar') {
                popUpCarrito.classList.remove('hidden');
            }
        })
        .catch(error => console.error("Error crítico procesando Fetch:", error));
}