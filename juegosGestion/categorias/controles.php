<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../conf/conf.php');

// Obtener la opción enviada
$opcion = isset($_GET['bandera']) ? $_GET['bandera'] : "";
$nombre_categoria = isset($_POST['nombre_categoria']) ? $_POST['nombre_categoria'] : "";
$id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : "";


// Insertar nueva categoría
if ($opcion == 5) {
    if (!empty($nombre_categoria)) {
        $consulta = "INSERT INTO categorias (nombre_categoria) VALUES ('$nombre_categoria')";
        $ejecutar = mysqli_query($con, $consulta);

        if ($ejecutar) {
            header('Location: index.php'); // Redirige a la lista de categorías
        } else {
            echo "Error al insertar la categoría: " . mysqli_error($con);
        }
    } else {
        echo "El nombre de la categoría no puede estar vacío.";
    }
}
// Actualizar categoría
else if ($opcion == 6) {
    if (!empty($nombre_categoria) && !empty($id_categoria)) {
        $consulta = "UPDATE categorias SET nombre_categoria='$nombre_categoria' WHERE id_categoria=$id_categoria";
        $ejecutar = mysqli_query($con, $consulta);

        if ($ejecutar) {
            header('Location: index.php'); // Redirige a la lista de categorías
        } else {
            echo "Error al actualizar la categoría: " . mysqli_error($con);
        }
    } else {
        echo "El nombre de la categoría y el ID son necesarios para actualizar.";
    }
}
// Eliminar categoría
else if ($opcion == 7) {
    if (!empty($id_categoria)) {
        // Verificación del id_categoria recibido
        echo "Intentando eliminar la categoría con ID: $id_categoria <br>";

        // Ejecutar la consulta para eliminar la categoría
        $consulta = "DELETE FROM categorias WHERE id_categoria=$id_categoria";
        $ejecutar = mysqli_query($con, $consulta);

        if ($ejecutar) {
            echo "Categoría eliminada correctamente.";
            header('Location: index.php'); // Redirige a la lista de categorías
        } else {
            echo "Error al eliminar la categoría: " . mysqli_error($con);
        }
    } else {
        echo "El ID de la categoría es necesario para eliminar.";
    }
}

$con->close();
