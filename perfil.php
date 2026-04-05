<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: iniciosesion.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "nana_mimus");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_SESSION['email']);

// Guardar cambios
if (isset($_POST['guardar'])) {
    $nuevo_email = $conn->real_escape_string($_POST['email']); 
    $nuevo_nombre = $conn->real_escape_string($_POST['nombre']); 
    $nuevo_apellido = $conn->real_escape_string($_POST['apellido']);
    $nuevo_fecha = $conn->real_escape_string($_POST['fecha']);
    $nuevo_telefono = $conn->real_escape_string($_POST['telefono']);

    $sql_update = "UPDATE usuarios SET 
        email='$nuevo_email', 
        nombre='$nuevo_nombre', 
        apellido='$nuevo_apellido', 
        fecha='$nuevo_fecha', 
        telefono='$nuevo_telefono' 
        WHERE email='$email'";

    if ($conn->query($sql_update) === TRUE) {
        $mensaje = "Perfil actualizado correctamente.";
        $_SESSION['email'] = $nuevo_email; // actualizar sesión
        $email = $nuevo_email; // actualizar variable local
    } else {
        $mensaje = "Error al actualizar: " . $conn->error;
    }
}

// Obtener datos del usuario
$sql = "SELECT * FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil de Usuario | Nana Mimus</title>
<style>
body 
{ font-family: "Poppins", 
    sans-serif; background: #f8e8ee; 
    color: #a35f74;
    text-align:center;
    padding:10px; 
}

.perfil
 { background:#f9f5f6;
    display:inline-block;
    padding:10px 80px;
    border-radius:20px;
    border:2px solid #fdcedf;
    text-align:left; 
    width: 400px;
}
input[type=text]
 { width:100%;
    padding:5px;
    margin:8px 0;
    border:1px solid #fdcedf;
    border-radius:10px;
    display:none;
 width: 100%;
 }
span.campo 
{ display:block;
    padding:10px;
    background:#fdcedf;
    border-radius:10px;
    margin:8px 0;
 }
button, a 
{ text-decoration:none;
    color:white;
    background:#e195ab;
    padding:12px 25px;
    border-radius:10px;
    margin:10px 0;
    display:inline-block;
    font-weight:600;
    border:none;
    cursor:pointer; 
}
button:hover, a:hover
 { 
    background:#a35f74;
 }
.mensaje 
{ 
    color:green; margin-bottom:15px; 
    }
    h1 {
    padding : 0 0 1px 0;
    margin-top: 5;|
    }
</style>
</head>
<body>

<h1>Perfil de Usuario</h1>

<div class="perfil">
    <?php if(isset($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>

    <form method="post" id="formPerfil">
        <!-- Email -->
        <label>Email:</label>
        <span class='campo' id='span_email'><?php echo htmlspecialchars($usuario['email']); ?></span>
        <input type='text' name='email' id='input_email' value='<?php echo htmlspecialchars($usuario['email']); ?>' required>

        <!-- Nombre -->
        <label>Nombre:</label>
        <span class='campo' id='span_nombre'><?php echo htmlspecialchars($usuario['nombre']); ?></span>
        <input type='text' name='nombre' id='input_nombre' value='<?php echo htmlspecialchars($usuario['nombre']); ?>' required>

        <!-- Apellido -->
        <label>Apellido:</label>
        <span class='campo' id='span_apellido'><?php echo htmlspecialchars($usuario['apellido']); ?></span>
        <input type='text' name='apellido' id='input_apellido' value='<?php echo htmlspecialchars($usuario['apellido']); ?>' required>

        <!-- Fecha -->
        <label>Fecha:</label>
        <span class='campo' id='span_fecha'><?php echo htmlspecialchars($usuario['fecha']); ?></span>
        <input type='text' name='fecha' id='input_fecha' value='<?php echo htmlspecialchars($usuario['fecha']); ?>' required>

        <!-- Teléfono -->
        <label>Teléfono:</label>
        <span class='campo' id='span_telefono'><?php echo htmlspecialchars($usuario['telefono']); ?></span>
        <input type='text' name='telefono' id='input_telefono' value='<?php echo htmlspecialchars($usuario['telefono']); ?>' required>

        <button type="button" id="editarBtn">Editar</button>
        <button type="submit" name="guardar" id="guardarBtn" style="display:none;">Guardar Cambios</button>
    </form>
</div>

<div class="botones">
    <a href="IndexNanaMimus.php">Volver al inicio</a>
    <a href="logout.php">Cerrar sesión</a>
</div>

<script>
const editarBtn = document.getElementById('editarBtn');
const guardarBtn = document.getElementById('guardarBtn');

editarBtn.addEventListener('click', () => {
    document.querySelectorAll('input[type=text]').forEach(input => input.style.display = 'block');
    document.querySelectorAll('span.campo').forEach(span => span.style.display = 'none');
    editarBtn.style.display = 'none';
    guardarBtn.style.display = 'inline-block';
});
</script>

</body>
</html>
