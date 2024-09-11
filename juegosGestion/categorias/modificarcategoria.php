<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

include_once('../conf/conf.php');

// Obtener el ID de la categoría a modificar
$id_categoria = isset($_GET['id']) ? $_GET['id'] : "";

// Consultar la categoría desde la base de datos
$consulta = "SELECT * FROM categorias WHERE id_categoria = " . intval($id_categoria);
$ejecutar = mysqli_query($con, $consulta);
$categoria = mysqli_fetch_assoc($ejecutar);

if (!$categoria) {
    echo "Categoría no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Modificar Categoría</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Modificar Categoría</h1>
        <form action="controles.php" method="POST">
            <input type="hidden" name="bandera" value="6">
            <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">

            <div class="mb-3">
                <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" value="<?php echo htmlspecialchars($categoria['nombre_categoria']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>

<?php
$con->close();
?>