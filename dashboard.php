<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel principal - Alicorp B2B Web</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <span class="navbar-brand">
            Alicorp B2B Web
        </span>

        <a
            href="logout.php"
            class="btn btn-light">

            Cerrar sesión

        </a>

    </div>

</nav>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2>
                Bienvenido,
                <?php echo htmlspecialchars($_SESSION["nombres"]); ?>
            </h2>

            <p>
                Has iniciado sesión correctamente en
                Alicorp B2B Web.
            </p>

            <hr>

            <h4>Módulos del sistema</h4>

            <div class="row mt-3">

                <div class="col-md-3 mb-3">

                    <div class="card h-100">

                        <div class="card-body">

                            <h5>Usuarios</h5>

                            <p>
                                Gestión de usuarios.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 mb-3">

                    <div class="card h-100">

                        <div class="card-body">

                            <h5>Productos</h5>

                            <p>
                                Catálogo de productos.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 mb-3">

                    <div class="card h-100">

                        <div class="card-body">

                            <h5>Pedidos</h5>

                            <p>
                                Gestión de pedidos.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 mb-3">

                    <div class="card h-100">

                        <div class="card-body">

                            <h5>Seguimiento</h5>

                            <p>
                                Seguimiento de pedidos.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>