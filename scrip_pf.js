//JAVA SCRIPT DE PREGUNTAS FRECUENTES
document.addEventListener("DOMContentLoaded", () => {
  const tarjetas = document.querySelectorAll(".tarjeta");

  tarjetas.forEach((tarjeta) => {
    tarjeta.addEventListener("click", () => {
      // Cerrar todas las demás
      tarjetas.forEach(t => {
        if (t !== tarjeta) t.classList.remove("active");
      });

      // Alternar la tarjeta actual
      tarjeta.classList.toggle("active");
    });
  });
});