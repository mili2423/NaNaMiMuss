<?php
session_start();
$conn = new mysqli("localhost", "root", "", "nana_mimus");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

if (isset($_POST['enviar'])) { // Botón del formulario
    $email = $conn->real_escape_string($_POST['email']);
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $codigo = rand(100000, 999999);
        $conn->query("UPDATE usuarios SET codigo_recuperacion='$codigo' WHERE email='$email'");
        $_SESSION['recuperar_email'] = $email;

        // Muestra el código y redirige a olvidar2.php
        echo "<script>alert('Tu código de verificación es: $codigo'); window.location.href='olvidar2.php';</script>";
        exit();
    } else {
        $error = "El correo no está registrado.";
    }
}
?>

<!-- TU HTML ORIGINAL DE olvidar.php -->
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
<div class="content_olvidar1">
    <h1 class="h1_olvidar1">Cambiar Contraseña</h1>
    <h3 class="h3_olvidar1">Ingrese su correo electrónico para recibir un código de verificación</h3>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="olvidar.php" method="post">
        <div class="email">
            <label for="email" class="label_olvidar1">Email</label>
            <input class="InputEmail" required class="imput_olvidar1" type="email" id="email" name="email">
        </div>
        <button class="enviarEmail" type="submit" name="enviar">Enviar Código</button>
    </form>
</div>
</body>
</html>
