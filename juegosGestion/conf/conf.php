
<?php
// Parámetros de conexión
$server = "localhost";  // El servidor de la base de datos, por lo general 'localhost'
$user = "root";         // Usuario de MySQL (ajustar si es diferente)
$pass = "witty"; // Contraseña del usuario de MySQL (cámbialo por la que uses)
$db = "gestion_juegos";  // Nombre de la base de datos

// Crear la conexión
$con = mysqli_connect($server, $user, $pass, $db);

// Verificar la conexión
if (!$con) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

// Función para validar el inicio de sesión
function validar($usuario, $pwd)
{
    global $con;
    $usuario = mysqli_real_escape_string($con, $usuario); // Evitar inyecciones SQL
    $pwd = md5($pwd); // Encriptar la contraseña usando MD5

    // Consultar si existe el usuario
    $consulta = "SELECT nombre, usuario FROM usuario WHERE usuario='$usuario' AND pwd='$pwd'";
    $resultado = mysqli_query($con, $consulta);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['nombre']; // Retornar el nombre del usuario
    } else {
        return false; // Si no existe, retornar false
    }
}
?>
