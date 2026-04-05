//EDITADO
document.addEventListener("DOMContentLoaded", () => {
  //todo el HTML esté cargado antes de ejecutar el código.
  //getitem valor asociado a una clave específica de un almacén de datos
  const data = localStorage.getItem("productoSeleccionado"); //busca en el local el producto q se seleccioono
  //let es una variable que solo existe en su bloque de codgo
  if (data) {
    //a partir del objeto seleccionadp
    const producto = JSON.parse(data);
    //JSON.parse() transforma el texto JSON en un objeto con nombre, imagen ,etc
    //suma y resta
    const btnResta = document.getElementById("btn-resta");
    const btnSuma = document.getElementById("btn-suma");
    const input = document.querySelector(".input_prodet");
    // Botón de sumar
    btnSuma.addEventListener("click", () => {
      //convierte una cadena de texto en un número entero.
      let valor = parseInt(input.value);
      input.value = valor + 1;
    });

    // Botón de restar
    btnResta.addEventListener("click", () => {
      let valor = parseInt(input.value);
      if (valor > 1) {
        // Evita que llegue a 0 o negativos
        input.value = valor - 1;
      }
    });
    // aca esta lo nuevo de los radio buton
    if (producto) {
      // Le asigna como src la primera imagen del array imagenes.
      document.getElementById("maincomoImage").src = producto.imagenes[0];
      //busca contenedor radio buton
      //lo guarda
      const radiosContainer = document.querySelector(".radio-buttons");
      //si el prod tine e mas 1 lo crea
      if (producto.imagenes.length > 1) {
        radiosContainer.innerHTML = "";
        //recorre ;as imagenes de producto. Recorre el array producto.imagenes
        producto.imagenes.forEach((imgSrc, index) => {
          //crea un id para cada uno
          const inputId = `img${index + 1}`;
          //por cada uno crea un input tipo radio
          const input = document.createElement("input");
          //lo hace radio
          input.type = "radio";
          //asigna el id
          input.id = inputId;
          //al seleccionar uno los otros se desmarcan
          input.name = "product-image";
          //primero selec
          if (index === 0) input.checked = true;
          //zona clicable que contiene la miniatura
          const label = document.createElement("label");
          //vincula el input id=img1
          label.setAttribute("for", inputId);
          //anade atributos al html

          const img = document.createElement("img");
          img.src = imgSrc;

          label.appendChild(img);
          //Añade el <input type="radio"> al DOM, dentro del contenedor .radio-buttons.
          radiosContainer.appendChild(input);
          radiosContainer.appendChild(label);

          // Evento para cambiar la imagen principal
          input.addEventListener("change", () => {
            document.getElementById("maincomoImage").src = imgSrc;
          });
        });
      } else {
        radiosContainer.style.display = "none";
      }
    }

    // Título, precio y descripción
    // permite seleccionar el primer elemento HTML
    document.querySelector(".titulo_prodet").textContent = producto.nombre;
    document.querySelector(
      ".precio-principal_prodet"
    ).textContent = `$${producto.precio}`;
    document.querySelector(".descripcion_prodet p").textContent =
      producto.descripcion;

    // Especificaciones
    const contenedorTalle = document.querySelector(".talle-container");
    const tallesDiv = document.querySelector(".talles");

    // Primero limpiamos el contenido anterior
    tallesDiv.innerHTML = "";

    // --- Mostrar talles según categoría ---
    let tallesDisponibles = [];

    // Convertimos a minúsculas para evitar errores de mayúsculas
    const categoria = producto.categoria.toLowerCase();

    switch (categoria) {
      case "trajes":
        // 🧍‍♂️ Talles adultos
        tallesDisponibles = ["XS", "S", "M", "L", "XL"];
        break;

      case "disfraz":
        // 🧒 Talles niños
        tallesDisponibles = ["2", "4", "6", "8", "10", "12"];
        break;

      case "bebes":
        // 👶 Talles bebé
        tallesDisponibles = ["RN", "0-3M", "3-6M", "6-9M", "9-12M", "12-18M"];
        break;

      default:
        // En otras categorías no se muestran talles
        contenedorTalle.style.display = "none";
        break;
    }

    // --- Si hay talles, los mostramos con estilo ---
    if (tallesDisponibles.length > 0) {
      contenedorTalle.style.display = "flex"; // muestra el bloque

      tallesDisponibles.forEach((talle) => {
        // Crear input radio
        const input = document.createElement("input");
        input.type = "radio";
        input.name = "talle";
        input.id = talle.toLowerCase().replaceAll(" ", "-");
        input.value = talle;

        // Crear label con estilo de botón
        const label = document.createElement("label");
        label.classList.add("ppp"); // aplica tu estilo rosa
        label.setAttribute("for", input.id);
        label.textContent = talle;

        // Agregar al contenedor
        tallesDiv.appendChild(input);
        tallesDiv.appendChild(label);
      });
    }

    // --- Especificaciones ---
    const listaEspecificaciones = document.querySelector(
      ".especificaciones_prodet"
    );
    listaEspecificaciones.innerHTML = "";

    producto.especificaciones.forEach((item) => {
      const li = document.createElement("li");
      li.textContent = item;
      listaEspecificaciones.appendChild(li);
    });

    // --- Select de opciones (por ejemplo, colores) ---
    const contenedorSelect = document.getElementById("Opcion"); // El <p id="Opcion">
    const selectOpciones = document.getElementById("opciones"); // El <select id="opciones">

    // Primero limpiamos todo
    selectOpciones.innerHTML = "";
    contenedorSelect.textContent = "";

    // Verificamos si el producto tiene opciones
    if (producto.opcion && producto.opcion.length > 0) {
      // Si hay opciones, mostramos el título y el select
      contenedorSelect.textContent = "Seleccione una opción:";

      // Agregamos una opción por defecto
      const defaultOption = document.createElement("option");
      defaultOption.textContent = "Seleccione...";
      defaultOption.value = "";
      defaultOption.disabled = true;
      defaultOption.selected = true;
      selectOpciones.appendChild(defaultOption);

      // Agregamos las opciones reales
      producto.opcion.forEach((item) => {
        const opt = document.createElement("option");
        opt.textContent = item;
        opt.value = item.toLowerCase();
        selectOpciones.appendChild(opt);
      });

      // Aseguramos que se vea el select
      selectOpciones.style.display = "inline-block";
      contenedorSelect.style.display = "block";
    } else {
      // Si NO hay opciones, ocultamos ambos elementos
      selectOpciones.style.display = "none";
      contenedorSelect.style.display = "none";
    }
    // --- Evento para cambiar la imagen principal al seleccionar una opción ---
    // --- Evento para cambiar la imagen principal al seleccionar una opción ---
    // --- Evento para cambiar la imagen principal al seleccionar una opción ---
    selectOpciones.addEventListener("change", (event) => {
      const colorSeleccionado = event.target.value.toLowerCase();

      // Buscar el índice del color seleccionado
      const indexColor = producto.opcion.findIndex(
        (op) => op.toLowerCase() === colorSeleccionado
      );

      // Si existe ese color
      if (indexColor !== -1 && producto.imagenes[indexColor]) {
        // Cambiar la imagen principal
        document.getElementById("maincomoImage").src =
          producto.imagenes[indexColor];

        // --- 🔹 Sincronizar radios ---
        const radios = document.querySelectorAll('input[name="product-image"]');
        const labels = document.querySelectorAll(".radio-buttons label");

        radios.forEach((radio, i) => {
          if (i === indexColor) {
            radio.checked = true; // marcar el radio correspondiente
            labels[i].classList.add("activo"); // marcar visualmente
          } else {
            radio.checked = false; // desmarcar el resto
            labels[i].classList.remove("activo"); // quitar borde
          }
        });
      }
    });
  }
});
