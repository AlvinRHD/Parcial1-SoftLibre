<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

include_once('../conf/conf.php');

// Obtener las categorías desde la base de datos
$consulta = "SELECT * FROM categorias";
$ejecutar = mysqli_query($con, $consulta);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestión de Categorías</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Gestión de Categorías</h1>
        <a href="registrocategoria.php" class="btn btn-primary mb-3">Agregar Nueva Categoría</a>
        <a href="../admin/registrojuego.php" class="btn btn-success" style="margin-left: 10px;">Agregar Juego</a>
        <br><br>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de la Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($categoria = mysqli_fetch_assoc($ejecutar)) {
                    echo '<tr>';
                    echo '<td>' . $categoria['id_categoria'] . '</td>';
                    echo '<td>' . $categoria['nombre_categoria'] . '</td>';
                    echo '<td>';
                    echo '<a href="modificarcategoria.php?id=' . $categoria['id_categoria'] . '" class="btn btn-warning btn-sm">Modificar</a> ';
                    echo '<a href="controles.php?bandera=7&id_categoria=' . $categoria['id_categoria'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Estás seguro de que quieres eliminar esta categoría?\')">Eliminar</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$con->close();
?>