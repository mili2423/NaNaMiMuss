function verClaveOL(event) {
  event.preventDefault();

  const boton = event.currentTarget;
  let input;

  // Detectar cuál botón fue presionado
  if (boton.classList.contains('verol1')) {
    input = document.getElementById('nuevacon');
  } else if (boton.classList.contains('verol2')) {
    input = document.getElementById('repetir');
  }

  // Alternar visibilidad y el ícono
  if (input.type === 'password') {
    input.type = 'text';
    boton.innerHTML = '<i class="fa-regular fa-eye"></i>'; // ojo abierto
  } else {
    input.type = 'password';
    boton.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'; // ojo cerrado
  }
}
