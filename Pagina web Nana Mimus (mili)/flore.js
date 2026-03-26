// Renderizar solo productos de flores

// es un bloque de código reutilizable que realiza una tarea específica
function mostrarFlores() {
  const contenedor = document.getElementById("lista-flores");
  contenedor.innerHTML = "";

  // Filtrar solo productos con categoría "Flores"
  const flores = productos.filter((p) => p.categoria === "Flores");

  flores.forEach((producto) => {
    const card = document.createElement("div");
    card.classList.add("product");

    card.innerHTML = `
      
      <div class="product-icons">
        <a href="productodetallado.html" class="ver-detalle" onclick="guardarProducto(${
          producto.id
        })">
          <i class="fa-solid fa-eye"></i>
        </a>
        <i class="fa-solid fa-heart" onclick="agregarAFavoritos('${
          producto.nombre
        }','${producto.precio}','${producto.imagenes[0]}')"></i>
      </div>
      <img src="${producto.imagenes[0]}" alt="${producto.nombre}">
      <p>${producto.nombre}</p>
      <div class="price">
        $${producto.precio.toLocaleString()}
      </div>
      <span class="add-cart">
        <i class="fa-solid fa-basket-shopping"></i>
      </span>
    `;
    const grupos = flores.reduce((acc, producto) => {
      const sub = producto.subcategoria || "Otros";
      if (!acc[sub]) acc[sub] = [];
      acc[sub].push(producto);
      return acc;
    }, {});

    contenedor.appendChild(card);
  });
}

// Reutilizamos la misma función de index.js
function guardarProducto(id) {
  const producto = productos.find((p) => p.id === id);
  localStorage.setItem("productoSeleccionado", JSON.stringify(producto));
}

// Esperamos que cargue el DOM
document.addEventListener("DOMContentLoaded", mostrarFlores);
//frege
