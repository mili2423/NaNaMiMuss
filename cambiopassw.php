<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';
    if ($usuario === "admin" && $clave === "1234") {
     
        header("Location: IndexNanaMimus.html");
        exit();
    } else {
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location.href='iniciosesion.html';
              </script>";
             
    }
}
?>