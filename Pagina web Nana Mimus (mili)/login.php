<?php
session_start();

$conn = new mysqli("localhost", "root", "", "nana_mimus");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$email = $_POST['email'];
$clave = $_POST['clave'];

$email = $conn->real_escape_string($email);

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    if (password_verify($clave, $usuario['clave'])) {
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['email'] = $usuario['email'];

        // Redirige al index normal
        header("Location: indexNanaMimus.php");
        exit();
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location.href='iniciosesion.html';</script>";
    }
} else {
    echo "<script>alert('No existe una cuenta con ese correo'); window.location.href='iniciosesion.html';</script>";
}

$conn->close();
?>
