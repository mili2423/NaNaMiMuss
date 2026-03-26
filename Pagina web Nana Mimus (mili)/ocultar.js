function verClave() {
  const input = document.getElementById("clave");
  const btn = document.getElementById("btnVer");

  if (input.type === "password") {
    input.type = "text";
    btn.innerHTML = '<i class="fa-regular fa-eye"></i>'; // ojo cerrado
  } else {
    input.type = "password";
    btn.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'; // ojo abierto
  }
}
