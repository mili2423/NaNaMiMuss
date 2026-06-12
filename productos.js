fetch("productos.php")
.then(response => response.json())
.then(productos => {

    const contenedor = document.querySelector(".contenedor-productos");
contenedor.innerHTML += `
<div class="producto-card">

    <a href="producto.php?id=${producto.id}">
        <img src="${producto.imagen1}" alt="${producto.nombre}">
    </a>

    <div class="producto-info">

        <h3>${producto.nombre}</h3>

        <div class="rating">
            ⭐ 4.9 (72 reseñas)
        </div>

        <p class="precio">
            $${Number(producto.precio).toLocaleString("es-AR")}
        </p>

        <button class="btn-carrito">
            🛒 Agregar al carrito
        </button>

    </div>

</div>
`;

})
.catch(error => {
    console.error("Error cargando productos:", error);
});