// CLASE CARRITO
class Carrito {
  constructor() {
    this.items = JSON.parse(localStorage.getItem("carrito")) || [];
  }

  agregar(producto) {
    const index = this.items.findIndex((item) => item.id === producto.id);
    if (index !== -1) this.items[index].cantidad += 1;
    else this.items.push({ ...producto, cantidad: 1 });
    this.guardar();
    this.render();
  }

  quitar(id) {
    this.items = this.items.filter((item) => item.id !== id);
    this.guardar();
    this.render();
  }

  vaciar() {
    this.items = [];
    this.guardar();
    this.render();
  }

  guardar() {
    localStorage.setItem("carrito", JSON.stringify(this.items));
  }

  obtenerTotal() {
    return this.items.reduce(
      (acc, item) => acc + item.precio * item.cantidad,
      0
    );
  }

  render() {
    const container = document.getElementById("cart-items");
    const resumen = document.querySelector(".cart-summary");
    if (!container || !resumen) return; // prevención si falta el DOM

    container.innerHTML = "";

    if (this.items.length === 0) {
      container.innerHTML = "<p>Tu carrito está vacío....</p>";
      const sf = document.getElementById("subtotal-final");
      const cf = document.getElementById("cart-total-final");
      const ct = document.getElementById("cart-totaltrans");
      if (sf) sf.textContent = "$0";
      if (cf) cf.textContent = "$0";
      if (ct) ct.textContent = "$0";
      resumen.style.display = "none";
      actualizarContadorCarrito();
      return;
    }

    resumen.style.display = "block";

    this.items.forEach((item) => {
      const div = document.createElement("div");
      div.classList.add("cart-item");
      div.innerHTML = `
        <div class="cart-item-info">
          <img src="${item.imagenes?.[0] || ""}" alt="${
        item.nombre
      }" width="50">
          <p>${item.nombre}</p>
        </div>

        <div class="cart-item-actions">
          <button class="cantidad-btn restar" data-id="${item.id}">−</button>
          <span class="cantidad">${item.cantidad}</span>
          <button class="cantidad-btn sumar" data-id="${item.id}">+</button>
        </div>

        <p class="cart-item-precio">$${(
          item.precio * item.cantidad
        ).toLocaleString()}</p>
        <button class="remove-btn favorito-eliminar" data-id="${item.id}">
          <i class="fa-solid fa-trash"></i>
        </button>
      `;
      container.appendChild(div);
    });

    const total = this.obtenerTotal();
    const totalTransfer = total * 0.85;

    const sf = document.getElementById("subtotal-final");
    const cf = document.getElementById("cart-total-final");
    const ct = document.getElementById("cart-totaltrans");
    if (sf) sf.textContent = "$" + total.toLocaleString();
    if (cf) cf.textContent = "$" + total.toLocaleString();
    if (ct) ct.textContent = "$" + totalTransfer.toLocaleString();

    // Botones eliminar
    container.querySelectorAll(".remove-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        this.quitar(Number(btn.dataset.id));
      });
    });

    // Botones sumar/restar cantidad
    container.querySelectorAll(".sumar").forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = Number(btn.dataset.id);
        const producto = this.items.find((p) => p.id === id);
        if (producto) producto.cantidad++;
        this.guardar();
        this.render();
      });
    });

    container.querySelectorAll(".restar").forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = Number(btn.dataset.id);
        const producto = this.items.find((p) => p.id === id);
        if (producto && producto.cantidad > 1) producto.cantidad--;
        else this.quitar(id);
        this.guardar();
        this.render();
      });
    });

    actualizarContadorCarrito();
  }
}

// Actualizar contador en ícono
function actualizarContadorCarrito() {
  const contador = document.getElementById("contadorCarrito");
  if (!contador) return;

  // Si hay items en el carrito (desde localStorage o memoria)
  const totalItems = carrito.items.reduce(
    (acc, item) => acc + item.cantidad,
    0
  );
  contador.innerText = totalItems;
}

// INSTANCIA GLOBAL
const carrito = new Carrito();

// FUNCION PARA AGREGAR DESDE TARJETA
function agregarAlCarrito(id) {
  const producto = productos.find((p) => p.id === id);
  if (producto) carrito.agregar(producto);
  actualizarContadorCarrito();
}

// MODAL Y BOTONES
document.addEventListener("DOMContentLoaded", () => {
  const cartModal = document.getElementById("Mimodal");
  const iconoCarrito = document.querySelector(".iconcar a");
  const closeButton = document.getElementById("jsmodalclose");
  actualizarContadorCarrito();
  // Cerrar modal al hacer clic en "Ver más productos"
  const verMasBtn = document.querySelector(".cart-summary .link");
  verMasBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Para que no recargue la página
    cartModal.style.display = "none";
  });

  // ABRIR MODAL
  iconoCarrito.addEventListener("click", (e) => {
    e.preventDefault();
    cartModal.style.display = "block";
    carrito.render();
  });

  // CERRAR MODAL
  closeButton.addEventListener(
    "click",
    () => (cartModal.style.display = "none")
  );

  // CERRAR CLIC FUERA
  window.addEventListener("click", (e) => {
    if (e.target === cartModal) cartModal.style.display = "none";
  });

  // RENDER INICIAL
  carrito.render();

  // Cambiar total según método de pago
  document.querySelectorAll('input[name="metodo-pago"]').forEach((radio) => {
    radio.addEventListener("change", () => {
      const total = carrito.obtenerTotal();
      const totalTransfer = total * 0.85;
      if (radio.value === "transferencia" && radio.checked) {
        document.getElementById("cart-total-final").textContent =
          "$" + totalTransfer.toLocaleString();
      } else {
        document.getElementById("cart-total-final").textContent =
          "$" + total.toLocaleString();
      }
    });
  });
});
