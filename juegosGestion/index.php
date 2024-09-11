<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Iniciar Sesión</title>
</head>

<body class="container mt-5">

    <h2 class="text-center mb-4">Bienvenido, por favor inicie sesión</h2>

    <form action="index.php" method="POST">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    </form>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

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