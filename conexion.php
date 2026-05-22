<?php

$servidor = "localhost";   // Servidor donde está alojada la base de datos
$usuario = "root";         // Usuario de la base de datos
$password = "";            // Contraseña del usuario
$base_datos = "NanaMimus"; // Nombre de la base de datos


$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

