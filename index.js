//agrupa por categorias y tienen la funcionalidad de os iconos
function renderCategorias() {
  const contenedor = document.getElementById("lista-categorias");

  contenedor.innerHTML = ""; //limpia el contenedr

  // Agrupar productos por categoría
  const categoriasMap = productos.reduce((acc, p) => {
    //agrupa productos en un objeto donde cada clave es una categoría
    (acc[p.categoria] = acc[p.categoria] || []).push(p); //or
    return acc;
  }, {});

  // Recorrer categorías
  //devuelve un arreglo con los nombres de las propiedades enumerables de un objeto.
  Object.keys(categoriasMap).forEach((categoria) => {
    //recorre cada categoría encontrada.
    const section = document.createElement("section");
    const header = document.createElement("div");
    header.classList.add("categoria-header"); //estilo
    const titulo = document.createElement("h2");
    titulo.classList.add("categoria-title");
    titulo.textContent = categoria; //coloca el nombre de la categoria
    header.appendChild(titulo); //inserta el h2 dentro del header
    //
    section.id = categoria.toLowerCase().replace(/\s+/g, ""); //funcione el navbar. replace elimina los espacios
    //BOTON
    const btnContainer = document.createElement("div"); //crea div
    btnContainer.classList.add("button-container");
    btnContainer.innerHTML =
      //para que el boton aparesca
      `
      <a href="${categoria
        .toLowerCase()
        .replace(/\s+/g, "")}.html" class="learn-more">
        <span aria-hidden="true" class="circle">
          <span class="icon arrow"></span>
          
        </span> <span class="button-text">Ver más</span>
       
      </a>
    `;
    header.appendChild(btnContainer); //anade el boton
    section.appendChild(header); //anade la seccion

    // Contenedor de productos (máx 4)
    const grid = document.createElement("div"); //a cada objetpo
    grid.classList.add("grid-product");
    //toma los primeros 4 elementos
    categoriasMap[categoria].slice(0, 4).forEach((p) => {
      //agrega el diseno
      const card = document.createElement("div");
      card.classList.add("product");
      card.innerHTML = `
      
        <div class="product-icons">
          <a href="productodetallado.html" class="ver-detalle" onclick="guardarProducto(${
            p.id
          })">
            <i class="fa-solid fa-eye"></i>
          </a>
          <i class="fa-solid fa-heart" onclick="agregarAFavoritos('${
            p.nombre
          }','${p.precio}','${p.imagenes[0]}')"></i>
        </div>
        <img src="${p.imagenes[0]}" alt="${p.nombre}">
        <p>${p.nombre}</p>
        <div class="price">$${p.precio.toLocaleString()}</div>
        <span class="add-cart">
  <i class="fa-solid fa-basket-shopping" 
     onclick="carrito.agregar(productos.find(p => p.id === ${
       p.id
     })); actualizarCarritoUI();">
  </i>
</span>

      `;
      grid.appendChild(card); //se inserten las tarjetas
    });

    section.appendChild(grid); //pone los productos en la seccion
    contenedor.appendChild(section); //lo anade al contenedror lista-categorias

    // si es la categoría Flores, agrego la barra de features después
    if (categoria === "Flores") {
      const barra = document.createElement("section");
      barra.classList.add("container-feactures");
      barra.innerHTML = `
        <div class="card-feacture">
          <i class="fa-solid fa-dollar-sign"></i>
          <div class="feacture-content">
            <span>Compra Segura</span>
            <p>Protegemos tus datos</p>
          </div>
        </div>
        <div class="card-feacture">
          <i class="fa-solid fa-car-side"></i>
          <div class="feacture-content">
            <span>Delivery con Cargo</span>
            <p>Compra sin salir de tu casa</p>
          </div>
        </div>
        <div class="card-feacture">
          <i class="fa-solid fa-credit-card"></i>
          <div class="feacture-content">
            <span>Métodos de Pago</span>
            <p>Billeteras Virtuales y Transferencias</p>
          </div>
        </div>
      `;
      contenedor.appendChild(barra); //aparesca las tarjetas
    }
  });
} //ejecuta rendercategorias

//en proddetall recupere el objeto y muestre su info
function guardarProducto(id) {
  //guarda e; producto por id
  const producto = productos.find((p) => p.id === id); //
  localStorage.setItem("productoSeleccionado", JSON.stringify(producto));
} //busca el prod por el id. lo guarda en el localstorage
//gracias a esto podemos ver los productos detallados. se carga la info

document.addEventListener("DOMContentLoaded", renderCategorias);
