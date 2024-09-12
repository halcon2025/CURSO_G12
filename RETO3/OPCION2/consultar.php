<?php
// Incluir el archivo de conexión a la base de datos
include 'includes/conexion.php';

// Inicializar la variable de búsqueda
$search = '';

if (isset($_GET['search'])) {
    // Obtener el valor de búsqueda
    $search = $_GET['search'];
    // Preparar la consulta SQL usando LIKE para buscar coincidencias parciales
    $query = "SELECT * FROM usuarios WHERE nombre LIKE $1";
    $result = pg_query_params($conn, $query, array('%' . $search . '%'));
} else {
    // Si no hay búsqueda, mostrar todos los usuarios
    $query = "SELECT * FROM usuarios";
    $result = pg_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Usuarios</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> <!-- Enlace a la hoja de estilos -->
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>

        <!-- Formulario de búsqueda -->
        <form method="GET">
            Buscar por nombre: <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Buscar">
        </form>

        <table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>País</th>
                <th>Ciudad</th>
                <th>Profesión</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
            <?php
            // Verificar si hay resultados
            if (pg_num_rows($result) > 0) {
                while ($row = pg_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['telefono']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['direccion']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['pais']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['ciudad']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['profesion']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                    echo '<td><img src="' . htmlspecialchars($row['foto']) . '" width="50"></td>';
                    echo '<td><a href="edit.php?id=' . $row['id'] . '">Editar</a> | <a href="delete.php?id=' . $row['id'] . '" onclick="return confirmarEliminacion();">Eliminar</a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="9">No se encontraron usuarios.</td></tr>';
            }
            ?>
        </table>
    </div>

    <script src="js/scripts.js"></script> <!-- Enlace al archivo JavaScript -->
</body>
</html>
