<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Registro de Usuario - Alicorp B2B Web</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-body">

                        <h2 class="text-center mb-4">
                            Registro de Usuario
                        </h2>

                        <p class="text-center">
                            Alicorp B2B Web
                        </p>

                        <form method="POST" action="usuarios/guardar.php">

                            <div class="mb-3">

                                <label class="form-label">
                                    Código de usuario
                                </label>

                                <input
                                    type="text"
                                    name="codigo_usuario"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Nombres
                                </label>

                                <input
                                    type="text"
                                    name="nombres"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Apellidos
                                </label>

                                <input
                                    type="text"
                                    name="apellidos"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    name="correo"
                                    class="form-control"
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
                                    required>

                            </div>

                            <div class="d-grid">

                                <button
                                    type="submit"
                                    class="btn btn-primary">

                                    Registrar usuario

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>