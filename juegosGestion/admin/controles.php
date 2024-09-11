<?php

include_once('../conf/conf.php');

// Variables para manejar la lógica del controlador
$opcion = isset($_POST['bandera']) ? $_POST['bandera'] : "";
$opcionG = isset($_GET['opcion']) ? $_GET['opcion'] : "";
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$precio = isset($_POST['precio']) ? $_POST['precio'] : "";
$fecha_lanzamiento = isset($_POST['fecha_lanzamiento']) ? $_POST['fecha_lanzamiento'] : "";
$id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : "";
$id = isset($_POST['id']) ? $_POST['id'] : ""; // id de juego o categoría
$idG = isset($_GET['id']) ? $_GET['id'] : ""; // id para eliminación

// Manejar inserción y edición de categorías
if ($opcion == 1) {
    // Insertar una nueva categoría
    $consulta = "INSERT INTO categorias (nombre_categoria) VALUES ('$nombre')";
    $ejecutar = mysqli_query($con, $consulta);

    if ($ejecutar) {
        header('Location: index.php');
    } else {
        echo "Error al insertar categoría.";
    }
} else if ($opcion == 2) {
    // Actualizar una categoría existente
    $consulta = "UPDATE categorias SET nombre_categoria = '$nombre' WHERE id_categoria = $id";
    $ejecutar = mysqli_query($con, $consulta);

    if ($ejecutar) {
        header('Location: index.php');
    } else {
        echo "Error al actualizar la categoría.";
    }
}

// Manejar inserción y edición de juegos
else if ($opcion == 3) {
    // Insertar un nuevo juego
    $consulta = "INSERT INTO juegos (titulo, descripcion, precio, fecha_lanzamiento, id_categoria) 
                 VALUES ('$titulo', '$descripcion', $precio, '$fecha_lanzamiento', $id_categoria)";
    $ejecutar = mysqli_query($con, $consulta);

    if ($ejecutar) {
        header('Location: index.php');
    } else {
        echo "Error al insertar juego.";
    }
} else if ($opcion == 4) {
    // Actualizar un juego existente
    $consulta = "UPDATE juegos SET 
                 titulo = '$titulo', 
                 descripcion = '$descripcion', 
                 precio = $precio, 
                 fecha_lanzamiento = '$fecha_lanzamiento',
                 id_categoria = $id_categoria 
                 WHERE id_juego = $id";
    $ejecutar = mysqli_query($con, $consulta);

    if ($ejecutar) {
        header('Location: index.php');
    } else {
        echo "Error al actualizar el juego.";
    }
}

// Manejar eliminaciones (categorías o juegos)
else if ($opcionG == 5) {
    // Eliminar una categoría
    $consulta = "DELETE FROM categorias WHERE id_categoria = $idG";
    $ejecutar = mysqli_query($con, $consulta);

    if ($ejecutar) {
        header('Location: index.php');
    } else {
        echo "Error al eliminar la categoría.";
    }
} else if ($opcionG == 6) {
    // Eliminar un juego
    $consulta = "DELETE FROM juegos WHERE id_juego = $idG";
    $ejecutar = mysqli_query($con, $consulta);

    if ($ejecutar) {
        header('Location: index.php');
    } else {
        echo "Error al eliminar el juego.";
    }
}

$con->close();
