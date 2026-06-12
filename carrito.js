document.addEventListener("DOMContentLoaded", () => {
    // Al cargar el sitio web traemos el estado asíncrono inicial del carrito
    actualizarInterfazCarrito('listar', 0);

    const popUpCarrito = document.getElementById('sidebarCarrito');
    const btnAbrir = document.getElementById('cart-icon-btn');
    const btnCerrar = document.getElementById('close-cart-btn');

    // 1. ESCUCHAR CLICK PARA ABRIR POP-UP
    if (btnAbrir) {
        btnAbrir.addEventListener('click', (e) => {
            e.preventDefault(); // Evita que la pantalla suba o recargue
            popUpCarrito.classList.remove('hidden');
        });
    }

    // 2. ESCUCHAR CLICK EN LA 'X' PARA CERRAR
    if (btnCerrar) {
        btnCerrar.addEventListener('click', () => {
            popUpCarrito.classList.add('hidden');
        });
    }

    // 3. TRUCO DE USABILIDAD: Cerrar al hacer clic afuera en la zona oscura
    if (popUpCarrito) {
        popUpCarrito.addEventListener('click', (e) => {
            // Si el clic fue en el contenedor del fondo y no dentro de la caja blanca
            if (e.target === popUpCarrito) {
                popUpCarrito.classList.add('hidden');
            }
        });
    }
});