<?php
include_once('../conf/conf.php');

$opcion = isset($_POST['bandera']) ? $_POST['bandera'] : "";
$nombre_categoria = isset($_POST['nombre_categoria']) ? $_POST['nombre_categoria'] : "";
$id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : "";

// Insertar nueva categoría
if ($opcion == 5) {
    if (!empty($nombre_categoria)) {
        $consulta = "INSERT INTO categorias (nombre_categoria) VALUES ('$nombre_categoria')";
        $ejecutar = mysqli_query($con, $consulta);

        if ($ejecutar) {
            header('Location: index.php'); // Redirige a la lista de categorías o una página adecuada
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
            header('Location: index.php'); // Redirige a la lista de categorías o una página adecuada
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
        $consulta = "DELETE FROM categorias WHERE id_categoria=$id_categoria";
        $ejecutar = mysqli_query($con, $consulta);

        if ($ejecutar) {
            header('Location: index.php'); // Redirige a la lista de categorías o una página adecuada
        } else {
            echo "Error al eliminar la categoría: " . mysqli_error($con);
        }
    } else {
        echo "El ID de la categoría es necesario para eliminar.";
    }
}

$con->close();
