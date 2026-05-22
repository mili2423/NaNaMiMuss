// Clase para definir productos. obj, prop, met
class Producto {
  //molde o plantilla para crear varios objetos con las mismas propiedades
  constructor( //ejecuta automáticamente
    id,
    nombre,
    precio,
    imagenes,
    categoria,
    descripcion,
    especificaciones,
    subcategoria, //se le asigna
    opcion
  ) {
    this.id = id;
    this.nombre = nombre;
    this.precio = precio;
    this.imagenes = imagenes; // Array de imágenes
    this.categoria = categoria;
    this.descripcion = descripcion;
    this.especificaciones = especificaciones;
    this.subcategoria = subcategoria; // Array de strings
    this.opcion = opcion;
  }
}

// Lista de productos+
//er utilizado en otros módulos o archivos del programa
fetch("productos.php")
  .then(response => response.json())
  .then(productos => {

    productos.forEach(producto => {

      const card = `
        <div class="card-producto">

          <img src="${producto.imagen1}" alt="${producto.nombre}">

          <h3>${producto.nombre}</h3>

          <p>$${producto.precio}</p>

        </div>
      `;

      document.querySelector(".contenedor-productos")
      .innerHTML += card;

    });

  });
window.productos = productos;
