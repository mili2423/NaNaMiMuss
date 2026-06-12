fetch("productos.php")
.then(response => response.json())
.then(productos => {

    const contenedor = document.querySelector(".contenedor-productos");

    contenedor.innerHTML = "";

    productos.forEach(producto => {

        contenedor.innerHTML += `
        
        <div class="producto-card">

            <div class="producto-img">

                <a href="producto.php?id=${producto.id}">
                    <img src="${producto.imagen1}" alt="${producto.nombre}">
                </a>

                <button class="btn-favorito">
                    <i class="fa-regular fa-heart"></i>
                </button>

            </div>

            <div class="producto-info">

                <h3>${producto.nombre}</h3>

                <div class="rating">
                    ⭐ 4.9 <span>(72 reseñas)</span>
                </div>

                <p class="precio">
                    $${Number(producto.precio).toLocaleString("es-AR")}
                </p>

                <button class="btn-carrito" onclick="window.location.href='producto.php?id=${producto.id}'">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Agregar al carrito
                </button>

            </div>

        </div>
        
        `;

    });

})
.catch(error => {
    console.error("Error cargando productos:", error);
});