<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../login.php");
    exit;
}

require_once "../config/conexion.php";

/* Buscar el cliente relacionado con el usuario que inició sesión */
$sql_cliente = "SELECT id_cliente, razon_social
                FROM clientes
                WHERE id_usuario = ?
                LIMIT 1";

$stmt_cliente = $conexion->prepare($sql_cliente);
$stmt_cliente->bind_param("i", $_SESSION["id_usuario"]);
$stmt_cliente->execute();

$resultado_cliente = $stmt_cliente->get_result();

$cliente = $resultado_cliente->fetch_assoc();

$stmt_cliente->close();

/* Obtener productos disponibles */
$sql_productos = "SELECT
                    id_producto,
                    codigo_producto,
                    nombre,
                    presentacion,
                    precio_referencial,
                    stock
                  FROM productos
                  WHERE estado = 'DISPONIBLE'
                  AND stock > 0
                  ORDER BY nombre ASC";

$resultado_productos = $conexion->query($sql_productos);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo pedido - Alicorp B2B Web</title>

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

            <h2>Registrar nuevo pedido</h2>

            <p class="text-muted">
                Seleccione un producto e indique la cantidad solicitada.
            </p>

        </div>

        <a
            href="../dashboard.php"
            class="btn btn-secondary">

            Volver al panel

        </a>

    </div>


    <?php if (!$cliente): ?>

        <div class="alert alert-warning">

            <h5>Cliente no registrado</h5>

            <p>
                El usuario actual todavía no tiene información de cliente
                asociada.
            </p>

        </div>

    <?php else: ?>


        <div class="card shadow">

            <div class="card-body">

                <h5 class="card-title mb-4">

                    Cliente:
                    <?php
                    echo htmlspecialchars($cliente["razon_social"]);
                    ?>

                </h5>


                <form method="POST" action="guardar.php">


                    <input
                        type="hidden"
                        name="id_cliente"
                        value="<?php echo $cliente["id_cliente"]; ?>">


                    <div class="mb-3">

                        <label class="form-label">

                            Producto

                        </label>

                        <select
                            name="id_producto"
                            id="id_producto"
                            class="form-select"
                            required>

                            <option value="">

                                Seleccione un producto

                            </option>


                            <?php while (
                                $producto =
                                $resultado_productos->fetch_assoc()
                            ): ?>

                                <option
                                    value="<?php
                                    echo $producto["id_producto"];
                                    ?>"
                                    data-precio="<?php
                                    echo $producto["precio_referencial"];
                                    ?>"
                                    data-stock="<?php
                                    echo $producto["stock"];
                                    ?>">

                                    <?php
                                    echo htmlspecialchars(
                                        $producto["codigo_producto"]
                                    );
                                    ?>

                                    -
                                    <?php
                                    echo htmlspecialchars(
                                        $producto["nombre"]
                                    );
                                    ?>

                                    -
                                    <?php
                                    echo htmlspecialchars(
                                        $producto["presentacion"]
                                    );
                                    ?>

                                    | Stock:
                                    <?php
                                    echo $producto["stock"];
                                    ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>


                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Cantidad

                            </label>

                            <input
                                type="number"
                                name="cantidad"
                                id="cantidad"
                                class="form-control"
                                min="1"
                                value="1"
                                required>

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Precio referencial

                            </label>

                            <input
                                type="text"
                                id="precio"
                                class="form-control"
                                value="0.00"
                                readonly>

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Subtotal

                            </label>

                            <input
                                type="text"
                                id="subtotal"
                                class="form-control"
                                value="0.00"
                                readonly>

                        </div>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">

                            Observaciones

                        </label>

                        <textarea
                            name="observaciones"
                            class="form-control"
                            rows="3"
                            placeholder="Observaciones del pedido"></textarea>

                    </div>


                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-success">

                            Registrar pedido

                        </button>

                        <a
                            href="../dashboard.php"
                            class="btn btn-secondary">

                            Cancelar

                        </a>

                    </div>


                </form>

            </div>

        </div>

    <?php endif; ?>

</div>


<script>

const producto = document.getElementById("id_producto");
const cantidad = document.getElementById("cantidad");
const precio = document.getElementById("precio");
const subtotal = document.getElementById("subtotal");

function calcularSubtotal() {

    if (!producto || !cantidad) {
        return;
    }

    const opcion = producto.options[producto.selectedIndex];

    if (!opcion || !opcion.dataset.precio) {

        precio.value = "0.00";
        subtotal.value = "0.00";

        return;
    }

    const precioProducto =
        parseFloat(opcion.dataset.precio);

    const cantidadProducto =
        parseInt(cantidad.value) || 0;

    precio.value =
        precioProducto.toFixed(2);

    subtotal.value =
        (precioProducto * cantidadProducto).toFixed(2);
}

if (producto) {

    producto.addEventListener(
        "change",
        calcularSubtotal
    );

}

if (cantidad) {

    cantidad.addEventListener(
        "input",
        calcularSubtotal
    );

}

</script>

</body>

</html>

<?php

$conexion->close();

?>