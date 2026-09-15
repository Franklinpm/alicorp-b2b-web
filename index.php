<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alicorp B2B Web</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

    <!-- ENCABEZADO -->

    <nav class="navbar navbar-dark bg-primary">

        <div class="container">

            <span class="navbar-brand mb-0 h1">
                Alicorp B2B Web
            </span>

            <a
                href="login.php"
                class="btn btn-light">

                Iniciar sesión

            </a>

        </div>

    </nav>


    <!-- CONTENIDO PRINCIPAL -->

    <div class="container py-5">

        <div class="text-center mb-5">

            <h1 class="fw-bold">
                Sistema Web de Gestión Integral
            </h1>

            <h2 class="text-primary">
                y Seguimiento de Pedidos B2B
            </h2>

            <p class="lead mt-3">
                Plataforma web para la gestión de usuarios,
                productos y pedidos de clientes empresariales.
            </p>

        </div>


        <!-- OPCIONES -->

        <div class="row g-4 justify-content-center">


            <!-- LOGIN -->

            <div class="col-md-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <h3>🔐</h3>

                        <h4 class="card-title">
                            Inicio de sesión
                        </h4>

                        <p class="card-text">
                            Acceda al sistema utilizando
                            sus credenciales.
                        </p>

                        <a
                            href="login.php"
                            class="btn btn-primary">

                            Iniciar sesión

                        </a>

                    </div>

                </div>

            </div>


            <!-- REGISTRO -->

            <div class="col-md-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <h3>👤</h3>

                        <h4 class="card-title">
                            Registro de usuarios
                        </h4>

                        <p class="card-text">
                            Registre nuevos usuarios
                            empresariales en el sistema.
                        </p>

                        <a
                            href="registro.php"
                            class="btn btn-outline-primary">

                            Registrarse

                        </a>

                    </div>

                </div>

            </div>


            <!-- CATÁLOGO -->

            <div class="col-md-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <h3>📦</h3>

                        <h4 class="card-title">
                            Catálogo de productos
                        </h4>

                        <p class="card-text">
                            Consulte los productos
                            disponibles para clientes B2B.
                        </p>

                        <a
                            href="productos/catalogo.php"
                            class="btn btn-outline-primary">

                            Ver catálogo

                        </a>

                    </div>

                </div>

            </div>


            <!-- DASHBOARD -->

            <div class="col-md-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <h3>📊</h3>

                        <h4 class="card-title">
                            Panel principal
                        </h4>

                        <p class="card-text">
                            Acceda al panel de gestión
                            del sistema.
                        </p>

                        <a
                            href="dashboard.php"
                            class="btn btn-outline-primary">

                            Entrar al panel

                        </a>

                    </div>

                </div>

            </div>


            <!-- PEDIDOS -->

            <div class="col-md-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <h3>🛒</h3>

                        <h4 class="card-title">
                            Gestión de pedidos
                        </h4>

                        <p class="card-text">
                            Módulo destinado al registro
                            y gestión de pedidos.
                        </p>

                        <a
                            href="pedidos/nuevo.php"
                            class="btn btn-outline-primary">

                            Gestionar pedidos

                        </a>

                    </div>

                </div>

            </div>


        </div>

    </div>


    <!-- PIE DE PÁGINA -->

    <footer class="bg-dark text-white text-center py-3">

        <p class="mb-0">
            Alicorp B2B Web - Proyecto académico de Ingeniería Web
        </p>

    </footer>

</body>

</html>