<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Inicializar la variable de búsqueda
$search = '';

// Verificar si se ha enviado una búsqueda
if (isset($_GET['search'])) {
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
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>

        <!-- Formulario de búsqueda -->
        <form method="GET">
            Buscar por nombre: <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Buscar">
        </form>

        <table border="1">
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
            // Mostrar los resultados en la tabla
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['pais']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ciudad']) . "</td>";
                echo "<td>" . htmlspecialchars($row['profesion']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['foto']) . "' width='150' height='150'></td>";
                echo "<td>
                        <a href='editar.php?id=" . $row['id'] . "'>Editar</a> | 
                        <a href='eliminar.php?id=" . $row['id'] . "'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>

        <a href="index.php">Registrar Nuevo Usuario</a>
    </div>
</body>
</html>

