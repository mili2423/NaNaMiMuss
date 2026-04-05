<?php
session_start();
$conn = new mysqli("localhost", "root", "", "nana_mimus");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

if (!isset($_SESSION['recuperar_email'])) {
    header("Location: olvidar.php");
    exit();
}

$email = $_SESSION['recuperar_email'];

if (isset($_POST['confirmar'])) { // Botón del formulario
    $codigo = $conn->real_escape_string($_POST['codigo']);
    $nueva = $_POST['nuevacon'];
    $repetir = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND codigo_recuperacion='$codigo'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        if ($nueva === $repetir) {
            $hash = password_hash($nueva, PASSWORD_DEFAULT);
            $conn->query("UPDATE usuarios SET clave='$hash', codigo_recuperacion=NULL WHERE email='$email'");
            session_destroy();
            header("Location: contcam.php");
            exit();
        } else {
            $error = "Las contraseñas no coinciden.";
        }
    } else {
        $error = "Código incorrecto.";
    }
}
?>

<!-- TU HTML ORIGINAL DE olvidar2.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña | Nana Mimus</title>
    <link rel="stylesheet" href="estilos.css">     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="navbar">
    <div class="navbar-left">
        <a href="IndexNanaMimus.html">
            <img src="NanaMimus/logotipo.jpg" alt="Logo" class="logo">
        </a>
    </div>
</div>
<div class="volver-atras-container">
    <button onclick="history.back()" class="volver-atras">
      <i class="fa-solid fa-arrow-left"></i>
    </button>
</div>
<div class="login_olvidar2">
    <h2 class="h2_olvidar2">Cambiar Contraseña</h2>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="olvidar2.php" method="post">
        <div class="lacont2">
            <label class="label_olvidar2" for="codigo">Código de verificación:</label>
        </div>
        <div class="imcont2">
            <input class="imput_olvidar2" type="number" name="codigo" required>
        </div>

        <div class="lacont2">
            <label class="label_olvidar2" for="nuevacon">Nueva contraseña:</label>
        </div>
        <div class="imcont2">
            <input class="imput_olvidar2" type="password" id="nuevacon" name="nuevacon" required>
            <button type="button" class="verol1" onclick="verClaveOL(event)" id="verol1">
                <i class="fa-regular fa-eye-slash"></i>
            </button>
        </div>

        <div class="lacont2">
            <label class="label_olvidar2" for="password">Confirmar contraseña:</label>
        </div>
        <div class="imcont2">
            <input class="imput_olvidar2" type="password" id="repetir" name="password" required>
            <button type="button" class="verol2" onclick="verClaveOL(event)" id="verol2">
                <i class="fa-regular fa-eye-slash"></i>
            </button>
        </div>

        <button class="button_olvidar2" type="submit" name="confirmar">Confirmar</button>
    </form>
</div>
<script src="ocultar_olvidar2.js"></script>
</body>
</html>
