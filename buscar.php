<?php

include("conexion.php");

$busqueda = $_GET['q'] ?? '';

$sql = "SELECT * FROM productos
        WHERE nombre LIKE '%$busqueda%'
        OR descripcion LIKE '%$busqueda%'";

$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Buscar</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<h2 style="text-align:center;margin:30px;">
Resultados para "<?php echo $busqueda; ?>"
</h2>

<div class="productos-container">

<?php

while($producto=mysqli_fetch_assoc($resultado)){

?>

<div class="producto-card">

<a href="producto.php?id=<?php echo $producto['id']; ?>">

<img src="<?php echo $producto['imagen1']; ?>">

</a>

<h3><?php echo $producto['nombre']; ?></h3>

<p>
$<?php echo number_format($producto['precio'],0,',','.'); ?>
</p>

</div>

<?php } ?>

</div>

</body>
</html>