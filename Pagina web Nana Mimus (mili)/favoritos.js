let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];

// Selectores seguros
const favoritoBtn = document.querySelector(".iconcora a"); // botón del icono favoritos
const favoritosPopup = document.getElementById("favoritosPopup");
const closeFavButton =
  document.querySelector(".favoritos-header .cerrar-favorito") ||
  document.getElementById("favoritosclose");
const listaFavoritosEl = document.getElementById("listaFavoritos");
const mensajeVacioEl = document.getElementById("mensajeVacio");

// Guardar en localStorage
function guardarFavoritos() {
  localStorage.setItem("favoritos", JSON.stringify(favoritos));
}

// Actualizar contador en ícono (si existe)
function actualizarContadorFavoritos() {
  const contador = document.getElementById("contadorFavoritos");
  if (!contador) return;
  contador.innerText = favoritos.length;
}

// Mostrar lista en popup (re-render)
function mostrarFavoritos() {
  if (!listaFavoritosEl || !mensajeVacioEl) return;

  listaFavoritosEl.innerHTML = "";

  if (favoritos.length === 0) {
    mensajeVacioEl.style.display = "block";
    actualizarContadorFavoritos();
    return;
  }
  mensajeVacioEl.style.display = "none";

  favoritos.forEach((producto, index) => {
    const div = document.createElement("div");
    div.classList.add("favorito-item");
    div.innerHTML = `
      <img src="${producto.imagen || ""}" alt="${producto.nombre || ""}">
      <div class="favorito-info">
        <h4>${producto.nombre || "Sin nombre"}</h4>
        <p>${producto.precio !== undefined ? producto.precio : ""}</p>
      </div>
      <div class="favorito-acciones">
        <button class="favorito-eliminar" data-index="${index}" title="Eliminar">
          <i class="fa-solid fa-trash"></i>
        </button>
        <!-- Si querés permitir "Agregar al carrito" y tenés el id del producto, se puede usar: -->
        <button class="favorito-eliminar" data-index="${index}" title="Agregar al carrito">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
      </div>
    `;
    listaFavoritosEl.appendChild(div);
  });

  // Delegación de eventos: evitar recrear listeners por cada item
  // Primero removemos posibles listeners previos (por seguridad)
  listaFavoritosEl.querySelectorAll(".favorito-eliminar").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const idx = Number(btn.dataset.index);
      eliminarFavorito(idx);
    });
  });

  listaFavoritosEl.querySelectorAll(".favorito-agregar").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const idx = Number(btn.dataset.index);
      // Intentamos agregar al carrito si existe la función agregarAlCarrito y el favorito tiene id
      const fav = favoritos[idx];
      if (window.agregarAlCarrito && fav && fav.id !== undefined) {
        agregarAlCarrito(fav.id);
        // opcional: quitar de favoritos al agregar al carrito
        // eliminarFavorito(idx);
      } else {
        // alternativa: si no tenés id, podés construir un objeto producto compatible y usar carrito.agregar(producto)
        console.warn(
          "No se pudo agregar al carrito: falta función agregarAlCarrito o id en el favorito."
        );
      }
    });
  });

  actualizarContadorFavoritos();
}

// Agregar a favoritos. Acepta objeto o parámetros (compatibilidad)
function agregarAFavoritos(objOrNombre, precio, imagen, id) {
  // Permitir tanto agregarAFavoritos({nombre,precio,imagen,id}) como agregarAFavoritos(nombre, precio, imagen)
  let item;
  if (typeof objOrNombre === "object") {
    item = objOrNombre;
  } else {
    item = { nombre: objOrNombre, precio, imagen, id };
  }

  // Evitar duplicados (comprobá por id si existe, sino por nombre)
  const existe =
    item.id !== undefined
      ? favoritos.some((f) => f.id === item.id)
      : favoritos.some((f) => f.nombre === item.nombre);

  if (!existe) {
    favoritos.push(item);
    guardarFavoritos();
    actualizarContadorFavoritos();
    mostrarFavoritos();
  }
}

// Eliminar de favoritos
function eliminarFavorito(index) {
  if (index < 0 || index >= favoritos.length) return;
  favoritos.splice(index, 1);
  guardarFavoritos();
  actualizarContadorFavoritos();
  mostrarFavoritos();
}

// Toggle del popup (si preferís toggle)
function toggleFavoritos() {
  if (!favoritosPopup) return;
  const visible = favoritosPopup.style.display === "block";
  favoritosPopup.style.display = visible ? "none" : "block";
  if (!visible) mostrarFavoritos();
}

// Listeners: abrir/cerrar con seguridad (si existen elementos)
if (favoritoBtn) {
  favoritoBtn.addEventListener("click", (e) => {
    e.preventDefault();
    // Abrir popup y re-renderizar la lista
    favoritosPopup.style.display = "block";
    mostrarFavoritos();
  });
}

if (closeFavButton) {
  closeFavButton.addEventListener("click", () => {
    if (favoritosPopup) favoritosPopup.style.display = "none";
  });
}

// Cerrar al click fuera del modal
window.addEventListener("click", (e) => {
  if (e.target === favoritosPopup) {
    favoritosPopup.style.display = "none";
  }
});

// Init al cargar DOM
document.addEventListener("DOMContentLoaded", () => {
  // Asegurarnos de que el popup empiece oculto
  if (favoritosPopup) favoritosPopup.style.display = "none";
  actualizarContadorFavoritos();
  mostrarFavoritos();
});

//04/11/25
function moverAFavoritosAlCarrito(idProducto) {
  // Obtener los datos de favoritos y carrito
  const favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
  const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

  // Buscar el producto en favoritos
  const producto = favoritos.find((p) => p.id === idProducto);
  if (!producto) return;

  // Agregar el producto al carrito
  carrito.push(producto);
  localStorage.setItem("carrito", JSON.stringify(carrito));

  // Eliminarlo de favoritos
  const nuevosFavoritos = favoritos.filter((p) => p.id !== idProducto);
  localStorage.setItem("favoritos", JSON.stringify(nuevosFavoritos));

  // Actualizar visualmente ambas listas
  renderFavoritos(); // función que ya debería actualizar tu popup de favoritos
  actualizarCarrito(); // función que actualiza el carrito (debería estar en carrito.js)
}
