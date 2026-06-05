// Clase para definir productos
class Producto {
  constructor(
    id,
    nombre,
    precio,
    imagenes,
    categoria,
    descripcion,
    especificaciones,
    subcategoria,
    opcion
  ) {
    this.id = id;
    this.nombre = nombre;
    this.precio = precio;
    this.imagenes = imagenes;
    this.categoria = categoria;
    this.descripcion = descripcion;
    this.especificaciones = especificaciones;
    this.subcategoria = subcategoria;
    this.opcion = opcion;
  }
}
fetch("productos.php")
  .then(response => response.json())
  .then(productos => {

    const contenedor = document.querySelector(".contenedor-productos");

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

              <p class="precio">
                  $${parseFloat(producto.precio).toLocaleString()}
              </p>

              <button class="btn-carrito">
                  <i class="fa-solid fa-cart-shopping"></i>
                  Agregar al carrito
              </button>

          </div>

      </div>

      `;
    });
  });