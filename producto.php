<?php
include("conexion.php");

if (!isset($_GET['id'])) {
    die("Producto no encontrado");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 0) {
    die("Producto no encontrado");
}

$producto = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $producto['nombre']; ?></title>

    <style>
        .contenedor{
            max-width:1200px;
            margin:50px auto;
            display:flex;
            gap:50px;
            padding:20px;
        }

        .imagen1 img{
            width:450px;
            border-radius:20px;
        }

        .info{
            flex:1;
        }

        .precio{
            font-size:32px;
            color:#ff6f91;
            font-weight:bold;
        }

        .btn{
            background:#ffb6c1;
            color:white;
            border:none;
            padding:15px 30px;
            border-radius:10px;
            cursor:pointer;
        }
    </style>
</head>
<body>

<div class="contenedor">

    <div class="imagen">
        <img src="<?php echo $producto['imagen1']; ?>" alt="">
    </div>

    <div class="info">

        <h1><?php echo $producto['nombre']; ?></h1>

        <p class="precio">
            $<?php echo number_format($producto['precio'],0,',','.'); ?>
        </p>

        <p>
            <?php echo $producto['descripcion']; ?>
        </p>

        <p>
            Stock disponible:
            <?php echo $producto['stock']; ?>
        </p>

        <button class="btn">
            Agregar al carrito
        </button>

    </div>

</div>

</body>
</html>