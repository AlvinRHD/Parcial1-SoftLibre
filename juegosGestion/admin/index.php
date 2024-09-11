<?php
session_start();
if ($_SESSION['usuario'] == "") {
    header('Location: ../index.php');
}
include_once('../conf/conf.php');

// Obtener el término de búsqueda del formulario
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Consulta para obtener los juegos de la base de datos con filtro
$consulta = "SELECT juegos.id_juego, 
                    juegos.titulo, 
                    juegos.descripcion, 
                    juegos.precio, 
                    juegos.fecha_lanzamiento, 
                    categorias.nombre_categoria 
             FROM juegos
             LEFT JOIN categorias ON juegos.id_categoria = categorias.id_categoria";

// Si hay un término de búsqueda, modificar la consulta para incluir un filtro
if (!empty($searchTerm)) {
    $consulta .= " WHERE juegos.titulo LIKE '%" . mysqli_real_escape_string($con, $searchTerm) . "%'";
}

$resultado = mysqli_query($con, $consulta);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestión de Juegos</title>
</head>

<body>
    <!-- Barra de navegación -->
    <nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link active" href="#">Bienvenido <?php echo $_SESSION['usuario']; ?></a>
        <a class="btn btn-danger flex-sm-fill text-sm-center" href="salir.php">Salir</a>
    </nav>
    <br><br>

    <!-- Formulario de búsqueda -->
    <div class="container">
        <form action="index.php" method="POST" class="d-flex mb-3">
            <input class="form-control me-2" type="search" name="search" placeholder="Buscar por título" aria-label="Buscar" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </div>

    <!-- Botón para agregar un nuevo juego -->
    <a href="./registrojuego.php" class="btn btn-success" style="margin-left: 10px;">Agregar Juego</a>
    <br><br>
    <a href="../categorias/index.php" class="btn btn-danger" style="margin-left: 10px;">Agregar Categoria</a>
    <br><br>

    <!-- Mostrar juegos en una tabla -->
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Fecha de Lanzamiento</th>
                    <th>Categoría</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar los datos de los juegos en la tabla
                while ($juego = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $juego['id_juego'] . "</td>";
                    echo "<td>" . $juego['titulo'] . "</td>";
                    echo "<td>" . $juego['descripcion'] . "</td>";
                    echo "<td>" . $juego['precio'] . "</td>";
                    echo "<td>" . $juego['fecha_lanzamiento'] . "</td>";
                    echo "<td>" . ($juego['nombre_categoria'] ? $juego['nombre_categoria'] : 'Sin Categoría') . "</td>";
                    echo "<td>
                            <a href='modificarjuego.php?id=" . $juego['id_juego'] . "' class='btn btn-primary'>Modificar</a> 
                            <a href='controles.php?id=" . $juego['id_juego'] . "&opcion=3' class='btn btn-danger'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>