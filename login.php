<?php

session_start();

require_once "config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($correo === "" || $password === "") {

        $mensaje = "Debe ingresar el correo y la contraseña.";

    } else {

        $sql = "SELECT id_usuario, codigo_usuario, nombres,
                       apellidos, correo, password,
                       tipo_usuario, estado
                FROM usuarios
                WHERE correo = ?
                LIMIT 1";

        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("s", $correo);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {

            $usuario = $resultado->fetch_assoc();

            if ($usuario["estado"] !== "ACTIVO") {

                $mensaje = "El usuario se encuentra inactivo.";

            } elseif (password_verify($password, $usuario["password"])) {

                $_SESSION["id_usuario"] = $usuario["id_usuario"];
                $_SESSION["codigo_usuario"] = $usuario["codigo_usuario"];
                $_SESSION["nombres"] = $usuario["nombres"];
                $_SESSION["apellidos"] = $usuario["apellidos"];
                $_SESSION["correo"] = $usuario["correo"];
                $_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];

                header("Location: dashboard.php");
                exit;

            } else {

                $mensaje = "El correo o la contraseña son incorrectos.";
            }

        } else {

            $mensaje = "El correo o la contraseña son incorrectos.";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Alicorp B2B Web</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center">
                        Alicorp B2B Web
                    </h2>

                    <h4 class="text-center mb-4">
                        Inicio de sesión
                    </h4>

                    <?php if ($mensaje !== ""): ?>

                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($mensaje); ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                name="correo"
                                class="form-control"
                                placeholder="Ingrese su correo"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Ingrese su contraseña"
                                required>

                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary">

                                Iniciar sesión

                            </button>

                        </div>

                    </form>

                    <div class="text-center mt-3">

                        <p>
                            ¿No tiene una cuenta?
                        </p>

                        <a
                            href="registro.php"
                            class="btn btn-outline-secondary">

                            Registrarse

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>