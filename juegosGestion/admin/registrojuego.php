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
    <title>Registrar Juego</title>
</head>

<body>

    <div class="container mt-4">
        <h2>Registrar Nuevo Juego</h2>

        <form action="controles.php" method="POST">
            <input type="hidden" name="bandera" value="3"> <!-- Opción 3 para registrar juego -->

            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Juego</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título del juego" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del juego" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Precio del juego" required>
            </div>

            <div class="mb-3">
                <label for="fecha_lanzamiento" class="form-label">Fecha de Lanzamiento</label>
                <input type="date" class="form-control" id="fecha_lanzamiento" name="fecha_lanzamiento" required>
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select class="form-select" id="id_categoria" name="id_categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                    // Consultar las categorías disponibles
                    include_once('../conf/conf.php');
                    $consulta = "SELECT id_categoria, nombre_categoria FROM categorias";
                    $resultado = mysqli_query($con, $consulta);

                    while ($categoria = mysqli_fetch_assoc($resultado)) {
                        echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nombre_categoria'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Juego</button>
        </form>
    </div>

</body>

</html>