function verClaveCon(event) {
  // Detecta cuál botón fue clickeado
  const boton = event.currentTarget;

  // Detecta el input asociado según el botón
  let input;
  if (boton.classList.contains('verr1')) {
    input = document.getElementById('claveRe');
  } else if (boton.classList.contains('verr2')) {
    input = document.getElementById('claveCo');
  }

  // Cambia el tipo de input y el ícono
  if (input.type === 'password') {
    input.type = 'text';
    boton.innerHTML = '<i class="fa-regular fa-eye"></i>'; // ojo abierto
  } else {
    input.type = 'password';
    boton.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'; // ojo cerrado
  }
}
