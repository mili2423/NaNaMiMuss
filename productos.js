fetch("productos.php")
  .then(response => response.json())
  .then(productos => {

    const contenedor = document.querySelector(".contenedor-productos");

    contenedor.innerHTML = "";

    productos.forEach(producto => {

      contenedor.innerHTML += `
      
      <div class="producto-card">

          <a href="producto.php?id=${producto.id}">
              <img src="${producto.imagen1}" alt="${producto.nombre}">
          </a>

          <div class="producto-info">
              <h3>${producto.nombre}</h3>

              <p class="precio">
                  $${Number(producto.precio).toLocaleString("es-AR")}
              </p>

              <p class="descripcion">
                  ${producto.descripcion}
              </p>

              <a href="producto.php?id=${producto.id}" class="btn-ver">
                  Ver producto
              </a>
          </div>

      </div>

      `;
    });

  })
  .catch(error => {
    console.error("Error cargando productos:", error);
  });