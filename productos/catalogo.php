<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../login.php");
    exit;
}

require_once "../config/conexion.php";

$sql = "SELECT
            p.id_producto,
            p.codigo_producto,
            p.nombre,
            p.descripcion,
            p.presentacion,
            p.precio_referencial,
            p.stock,
            p.estado,
            c.nombre AS categoria
        FROM productos p
        INNER JOIN categorias c
            ON p.id_categoria = c.id_categoria
        ORDER BY p.id_producto ASC";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo - Alicorp B2B Web</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <a
            href="../dashboard.php"
            class="navbar-brand">

            Alicorp B2B Web

        </a>

        <div>

            <span class="text-white me-3">

                <?php
                echo htmlspecialchars($_SESSION["nombres"]);
                ?>

            </span>

            <a
                href="../logout.php"
                class="btn btn-light">

                Cerrar sesión

            </a>

        </div>

    </div>

</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Catálogo de productos</h2>

            <p class="text-muted">
                Productos disponibles para clientes empresariales B2B.
            </p>

        </div>

        <a
            href="../dashboard.php"
            class="btn btn-secondary">

            Volver al panel

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead class="table-primary">

                        <tr>

                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Presentación</th>
                            <th>Precio referencial</th>
                            <th>Stock</th>
                            <th>Estado</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if ($resultado && $resultado->num_rows > 0): ?>

                        <?php while ($producto = $resultado->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $producto["codigo_producto"]
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $producto["nombre"]
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $producto["categoria"]
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo htmlspecialchars(
                                        $producto["presentacion"]
                                    );
                                    ?>
                                </td>

                                <td>
                                    S/
                                    <?php
                                    echo number_format(
                                        $producto["precio_referencial"],
                                        2
                                    );
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo $producto["stock"];
                                    ?>
                                </td>

                                <td>

                                    <?php if (
                                        $producto["estado"] === "DISPONIBLE"
                                    ): ?>

                                        <span class="badge bg-success">
                                            Disponible
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            No disponible
                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="7"
                                class="text-center">

                                No existen productos registrados.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>

</html>

<?php

$conexion->close();

?>