<?php
session_start();

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "nana_mimus");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha = $_POST['fecha'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$clave = $_POST['clave'];
$confirmar = $_POST['confirmar_clave'];

// Validar que las contraseñas coincidan
if ($clave !== $confirmar) {
    die("Las contraseñas no coinciden. <a href='registro.html'>Volver</a>");
}

// Encriptar la contraseña
$clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

// Insertar datos en la base
$sql = "INSERT INTO usuarios (nombre, apellido, fecha, email, telefono, clave)
        VALUES ('$nombre', '$apellido', '$fecha', '$email', '$telefono', '$clave_encriptada')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['usuario'] = $nombre;
    $_SESSION['email'] = $email;
    header("Location: registro_exitoso.html");
    exit();
} else {
    echo "Error al registrar: " . $conn->error;
}
$conn->close();
?>