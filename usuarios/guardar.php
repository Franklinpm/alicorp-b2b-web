<?php

require_once "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../registro.php");
    exit;
}

$codigo_usuario = trim($_POST["codigo_usuario"] ?? "");
$nombres = trim($_POST["nombres"] ?? "");
$apellidos = trim($_POST["apellidos"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$password = $_POST["password"] ?? "";

if (
    $codigo_usuario === "" ||
    $nombres === "" ||
    $apellidos === "" ||
    $correo === "" ||
    $password === ""
) {
    die("Todos los campos son obligatorios.");
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no tiene un formato válido.");
}

$password_segura = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios
        (codigo_usuario, nombres, apellidos, correo, password)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param(
    "sssss",
    $codigo_usuario,
    $nombres,
    $apellidos,
    $correo,
    $password_segura
);

try {

    if ($stmt->execute()) {

        echo "<h2>Usuario registrado correctamente</h2>";

        echo "<p>El usuario fue almacenado en la base de datos.</p>";

        echo '<a href="../login.php">Ir al inicio de sesión</a>';

    }

} catch (mysqli_sql_exception $e) {

    if ($e->getCode() == 1062) {

        echo "<h2>No se pudo registrar el usuario</h2>";

        echo "<p>";
        echo "El código de usuario o el correo electrónico ya está registrado.";
        echo "</p>";

        echo '<a href="../registro.php">Volver al registro</a>';

    } else {

        echo "<h2>Error al registrar el usuario</h2>";

        echo "<p>";
        echo "Se produjo un error al guardar la información.";
        echo "</p>";
    }
}

$stmt->close();
$conexion->close();

?>