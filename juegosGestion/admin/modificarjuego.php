<?php
session_start();
if ($_SESSION['usuario'] == "") {
    header('Location: ../index.php');
    exit;
}

include_once '../conf/conf.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if (empty($id)) {
    echo "ID de juego no proporcionado.";
    exit;
}

$consultadev = "SELECT * FROM juegos WHERE id_juego=" . intval($id);
$ejecutar = mysqli_query($con, $consultadev);

if (mysqli_num_rows($ejecutar) == 0) {
    echo "Juego no encontrado.";
    exit;
}

$juego = mysqli_fetch_assoc($ejecutar);

// Consultar categorías disponibles para el select
$categorias_query = "SELECT id_categoria, nombre_categoria FROM categorias";
$categorias_resultado = mysqli_query($con, $categorias_query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Modificar Juego</title>
</head>

<body>

    <div class="container mt-4">
        <h2>Modificar Juego</h2>

        <form action="controles.php" method="POST">
            <input type="hidden" name="bandera" value="4"> <!-- Opción 4 para modificar juego -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Juego</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($juego['titulo']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($juego['descripcion']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($juego['precio']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="fecha_lanzamiento" class="form-label">Fecha de Lanzamiento</label>
                <input type="date" class="form-control" id="fecha_lanzamiento" name="fecha_lanzamiento" value="<?php echo htmlspecialchars($juego['fecha_lanzamiento']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select class="form-select" id="id_categoria" name="id_categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                    while ($categoria = mysqli_fetch_assoc($categorias_resultado)) {
                        $selected = $juego['id_categoria'] == $categoria['id_categoria'] ? 'selected' : '';
                        echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . $categoria['nombre_categoria'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

</body>

</html>

<?php
$con->close();
?>