function actualizarInterfazCarrito(accion, idProducto) {
    // MODIFICACIÓN: Enviamos los datos como un objeto JSON real mediante POST
    fetch('carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            accion: accion,
            id: parseInt(idProducto)
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error en la red: Status ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (!data.success) {
            // Esto te dirá exactamente qué error salta en tu base de datos si algo falla
            console.error("Error devuelto por PHP:", data.error);
            return;
        }

        // Sincronizar badges e insignias de la Navbar
        const contadorNavbar = document.getElementById('contadorCarrito');
        const contadorSidebar = document.getElementById('cart-badge-count');
        
        if (contadorNavbar) contadorNavbar.textContent = data.items_totales;
        if (contadorSidebar) contadorSidebar.textContent = `${data.items_totales} item${data.items_totales !== 1 ? 's' : ''}`;

        const wrapper = document.getElementById('wrapper-dinamico-carrito');
        if (!wrapper) return;

        // --- DISEÑO VACÍO ---
        if (!data.items || data.items.length === 0) {
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

        // --- DISEÑO CON ARTÍCULOS DE TU BASE DE DATOS ---
        let productosHTML = '';
        data.items.forEach(item => {
            const idActual = item.producto_id || item.id;
            const precioFlotante = parseFloat(item.precio || 0);
            const subtotalFlotante = parseFloat(item.subtotal_item || (precioFlotante * item.cantidad));

            productosHTML += `
                <div class="producto-card">
                    <img src="${item.imagen1}" alt="${item.nombre}" class="producto-img">
                    <div class="producto-info">
                        <h4>${item.nombre}</h4>
                        <span class="producto-precio">$${precioFlotante.toFixed(2)}</span>
                        <div class="controles-cantidad">
                            <button class="btn-qty" onclick="ejecutarCarrito('restar', ${idActual})">-</button>
                            <span style="font-family: 'Poppins', sans-serif; font-weight: 500; color: #333;">${item.cantidad}</span>
                            <button class="btn-qty" onclick="ejecutarCarrito('agregar', ${idActual})">+</button>
                        </div>
                    </div>
                    <button class="btn-delete" onclick="ejecutarCarrito('eliminar', ${idActual})">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                    <span class="subtotal-item">$${subtotalFlotante.toFixed(2)}</span>
                </div>
            `;
        });

        let faltaParaEnvio = parseFloat(data.falta_para_envio_gratis || 0);
        let textoAlertaEnvio = faltaParaEnvio > 0 
            ? `Agrega $${faltaParaEnvio.toFixed(2)} más para envío gratis`
            : `¡Felicidades! Tienes envío gratis 🎁`;

        let costoEnvioFlotante = parseFloat(data.costo_envio || 0);
        let textoPrecioEnvio = costoEnvioFlotante > 0 ? `$${costoEnvioFlotante.toFixed(2)}` : 'Gratis';
        let totalFlotante = parseFloat(data.total || 0);

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
                        <strong style="color: #ff409f;">$${totalFlotante.toFixed(2)}</strong>
                    </div>

                    <button class="btn-finalizar" onclick="alert('Finalizando tu compra en Nana Mimus ✨')">Finalizar Compra ✨</button>
                    <div style="text-align: center; margin-top: 12px;">
                        <button class="btn-vaciar" onclick="ejecutarCarrito('vaciar')">Vaciar carrito</button>
                    </div>
                </div>
            </div>
        `;

        // Si la acción fue agregar, abrir el panel lateral de Figma
        if (accion === 'agregar') {
            const popUpCarrito = document.getElementById('sidebarCarrito');
            if (popUpCarrito) {
                popUpCarrito.classList.remove('hidden');
            }
        }
    })
    .catch(error => console.error("Error crítico procesando Fetch:", error));
}