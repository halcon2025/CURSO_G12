<?php
// Incluir el archivo de conexión a la base de datos
include 'includes/conexion.php';

// Verificar si se ha enviado el ID del usuario para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del usuario existente
    $query = "SELECT * FROM usuarios WHERE id = $1";
    $result = pg_query_params($conn, $query, array($id));

    if (pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
}

// Procesar el formulario si se envía con el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $profesion = $_POST['profesion'];
    $email = $_POST['email'];
    $foto = $_FILES['foto'];

    // Si se sube una nueva foto, reemplazar la anterior
    if ($foto['name']) {
        $foto_path = 'fotos/' . basename($foto['name']);
        move_uploaded_file($foto['tmp_name'], $foto_path);
    } else {
        $foto_path = $user['foto']; // Mantener la foto actual si no se sube una nueva
    }

    // Actualizar el usuario en la base de datos
    $query = "UPDATE usuarios SET nombre = $1, telefono = $2, direccion = $3, pais = $4, ciudad = $5, profesion = $6, email = $7, foto = $8 WHERE id = $9";
    $result = pg_query_params($conn, $query, array($nombre, $telefono, $direccion, $pais, $ciudad, $profesion, $email, $foto_path, $id));

    if ($result) {
        echo "Usuario actualizado exitosamente.";
    } else {
        echo "Error al actualizar usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> <!-- Enlace a la hoja de estilos -->
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form method="POST" enctype="multipart/form-data">
            Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required><br><br>
            Teléfono: <input type="text" name="telefono" value="<?php echo htmlspecialchars($user['telefono']); ?>" required><br><br>
            Dirección: <input type="text" name="direccion" value="<?php echo htmlspecialchars($user['direccion']); ?>" required><br><br>
            País: <input type="text" name="pais" value="<?php echo htmlspecialchars($user['pais']); ?>" required><br><br>
            Ciudad: <input type="text" name="ciudad" value="<?php echo htmlspecialchars($user['ciudad']); ?>" required><br><br>
            Profesión: <input type="text" name="profesion" value="<?php echo htmlspecialchars($user['profesion']); ?>" required><br><br>
            Email: <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>
            Foto actual: <img src="<?php echo htmlspecialchars($user['foto']); ?>" width="50"><br><br>
            Cambiar foto: <input type="file" name="foto"><br><br>
            <input type="submit" value="Actualizar">
        </form>
        <a href="consultar.php">Volver a la lista de usuarios</a>
    </div>

    <script src="js/scripts.js"></script> <!-- Enlace al archivo JavaScript -->
</body>
</html>
