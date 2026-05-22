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

      const card = `
        <div class="card-producto">

          <img src="${producto.imagen1}" alt="${producto.nombre}">

          <h3>${producto.nombre}</h3>

          <p>$${producto.precio}</p>

        </div>
      `;

      contenedor.innerHTML += card;

    });

  })
  .catch(error => {
    console.error("Error:", error);
  });