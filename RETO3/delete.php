<?php
// Incluir el archivo de conexión
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el usuario de la base de datos
    $query = "DELETE FROM usuarios WHERE id = $1";
    $result = pg_query_params($conn, $query, array($id));

    if ($result) {
        header("Location: consultar.php");
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
}
?>
