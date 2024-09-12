<?php
// Incluir el archivo de conexión a la base de datos
include 'includes/conexion.php';

// Verificar si se ha proporcionado el ID del usuario a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la foto del usuario para eliminarla del servidor
    $query = "SELECT foto FROM usuarios WHERE id = $1";
    $result = pg_query_params($conn, $query, array($id));
    $user = pg_fetch_assoc($result);

    if ($user) {
        // Eliminar la foto si existe
        if (file_exists($user['foto'])) {
            unlink($user['foto']);
        }

        // Eliminar el usuario de la base de datos
        $query = "DELETE FROM usuarios WHERE id = $1";
        $result = pg_query_params($conn, $query, array($id));

        if ($result) {
            echo "Usuario eliminado exitosamente.";
        } else {
            echo "Error al eliminar usuario.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> <!-- Enlace a la hoja de estilos -->
</head>
<body>
    <div class="container">
        <h1>Eliminar Usuario</h1>
        <p><a href="consultar.php">Volver a la lista de usuarios</a></p>
    </div>

    <script src="js/scripts.js"></script> <!-- Enlace al archivo JavaScript -->
</body>
</html>
