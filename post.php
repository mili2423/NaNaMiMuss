<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';
    if ($usuario === "admin" && $clave === "1234") {
     
        header("Location: IndexNanaMimus.html");
        exit();
    } else {
        // Si está mal, vuelve al login con un mensaje
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location.href='login.html';
              </script>";
              
    }
}
?>