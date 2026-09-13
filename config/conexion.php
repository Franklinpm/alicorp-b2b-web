<?php

$servidor = "127.0.0.1";
$usuario = "root";
$password = "";
$puerto = 3307;
$base_datos = "alicorp_b2b";

$conexion = new mysqli(
    $servidor,
    $usuario,
    $password,
    $base_datos,
    $puerto
);

if ($conexion->connect_error) {

    die(
        "Error de conexión con la base de datos: "
        . $conexion->connect_error
    );

}

$conexion->set_charset("utf8mb4");

?>