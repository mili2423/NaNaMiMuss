<?php

include("conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);

$producto = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $producto['nombre']; ?></title>
</head>
<body>

    <h1><?php echo $producto['nombre']; ?></h1>

    <img src="<?php echo $producto['imagen1']; ?>" width="400">

    <h2>$<?php echo $producto['precio']; ?></h2>

    <p><?php echo $producto['descripcion']; ?></p>

    <p>Stock: <?php echo $producto['stock']; ?></p>

</body>
</html>