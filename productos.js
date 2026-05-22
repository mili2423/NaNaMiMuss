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

<div class="producto-card">

    <div class="producto-img">
        <img src="${producto.imagen1}" alt="${producto.nombre}">
    </div>

    <div class="producto-info">

        <h3>${producto.nombre}</h3>

        <p class="precio">
            $${producto.precio}
        </p>

        <p class="categoria">
            ${producto.categoria}
        </p>

        <button class="btn-comprar">
            Ver producto
        </button>

    </div>

</div>

`;

      contenedor.innerHTML += card;

    });

  })
  .catch(error => {
    console.error("Error:", error);
  });