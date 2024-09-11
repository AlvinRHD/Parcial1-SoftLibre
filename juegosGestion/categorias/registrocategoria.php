<?php
session_start();
if ($_SESSION['usuario'] == "") {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrar Categoría</title>
</head>

<body>

    <div class="container mt-4">
        <h2>Registrar Nueva Categoría</h2>

        <form action="controles.php" method="POST">
            <input type="hidden" name="bandera" value="5"> <!-- Opción 5 para registrar categoría -->

            <div class="mb-3">
                <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Nombre de la categoría" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

</body>

</html>