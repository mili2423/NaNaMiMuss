document.addEventListener("DOMContentLoaded", () => {
    const contenedor = document.querySelector(".contenedor-productos");

    fetch("productos.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la respuesta del servidor");
            }
            return response.json();
        })
        .then(productos => {
            // Limpiamos el contenedor por si acaso
            contenedor.innerHTML = ""; 

            if (productos.length === 0) {
                contenedor.innerHTML = `<p class="sin-productos">No hay productos cargados en la base de datos.</p>`;
                return;
            }

            // Recorremos cada producto que viene de la base de datos
            productos.forEach(producto => {
                // Evaluamos si tiene descuento para mostrar la etiqueta rosa
                let badgeDescuento = "";
                if (producto.descuento && producto.descuento > 0) {
                    badgeDescuento = `<span class="badge-descuento">-${producto.descuento}%</span>`;
                }

                // Formateamos el precio a moneda local
                const precioFormateado = Number(producto.precio).toLocaleString("es-AR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                // Inyectamos la tarjeta en el HTML
                contenedor.innerHTML += `
                    <div class="producto-card">
                        <div class="producto-img-container">
                            ${badgeDescuento}
                            <a href="producto.php?id=${producto.id}">
                                <img src="${producto.imagen}" alt="${producto.nombre}">
                            </a>
                        </div>

                        <div class="producto-info">
                            <h3>${producto.nombre}</h3>

                            <div class="rating">
                                ⭐ 4.9 <span class="resenas">(72 reseñas)</span>
                            </div>

                            <p class="precio">$${precioFormateado}</p>

                            <a href="carrito_accion.php?accion=agregar&id=${producto.id}" class="btn-carrito">
                                🛒 Agregar al carrito
                            </a>
                        </div>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error("Error cargando productos:", error);
            contenedor.innerHTML = `<p class="sin-productos">Hubo un error al cargar los productos.</p>`;
        });
});