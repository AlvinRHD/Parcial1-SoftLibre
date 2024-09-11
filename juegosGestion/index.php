<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="css/estilos.css" rel="stylesheet">
    <title>Iniciar Sesión</title>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="./logo.png"
                                            style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Bienvenido a Nuestro Sitio</h4>
                                    </div>

                                    <form action="index.php" method="POST">
                                        <p>Por favor, inicie sesión en su cuenta</p>

                                        <!-- Usuario input -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese su usuario" required />
                                            <label class="form-label" for="usuario">Usuario</label>
                                        </div>

                                        <!-- Contraseña input -->
                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese su contraseña" required />
                                            <label class="form-label" for="password">Contraseña</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Iniciar Sesión</button>
                                        </div>

                                    </form>

                                    <?php if (isset($error)) : ?>
                                        <div class="alert alert-danger mt-3" role="alert">
                                            <?php echo $error; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Somos más que solo una empresa</h4>
                                    <p class="small mb-0">Somos "La Empresa"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>

<?php

include_once './conf/conf.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $pwd = $_POST['password'] ?? '';

    // Consulta segura utilizando prepared statements para evitar SQL injection
    $consulta = $con->prepare("SELECT nombre, usuario, pwd FROM usuario WHERE usuario = ? AND pwd = ?");
    $pwd_hash = md5($pwd);
    $consulta->bind_param("ss", $usuario, $pwd_hash);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows == 1) {
        session_start();
        $user = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $user['nombre'];

        header('Location: ./admin/index.php');
    } else {
        $error = "Error en el inicio de sesión. Usuario o contraseña incorrectos.";
    }
}
?>
