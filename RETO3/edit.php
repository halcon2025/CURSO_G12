<?php
// Incluir el archivo de conexión
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Obtener los datos del usuario a editar
    $query = "SELECT * FROM usuarios WHERE id = $1";
    $result = pg_query_params($conn, $query, array($id));
    $usuario = pg_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $profesion = $_POST['profesion'];
    $email = $_POST['email'];

    if ($_FILES['foto']['name']) {
        // Subir una nueva foto si se selecciona
        $foto_path = 'fotos/' . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path);
    } else {
        // Usar la foto actual si no se sube una nueva
        $foto_path = $_POST['foto_actual'];
    }

    // Actualizar los datos del usuario
    $query = "UPDATE usuarios SET nombre = $1, telefono = $2, direccion = $3, pais = $4, ciudad = $5, profesion = $6, email = $7, foto = $8 WHERE id = $9";
    $result = pg_query_params($conn, $query, array($nombre, $telefono, $direccion, $pais, $ciudad, $profesion, $email, $foto_path, $id));

    if ($result) {
        header("Location: consultar.php");
        exit();
    } else {
        echo "Error al actualizar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            Nombre: <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br><br>
            Teléfono: <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" required><br><br>
            Dirección: <input type="text" name="direccion" value="<?php echo $usuario['direccion']; ?>" required><br><br>
            País: <input type="text" name="pais" value="<?php echo $usuario['pais']; ?>" required><br><br>
            Ciudad: <input type="text" name="ciudad" value="<?php echo $usuario['ciudad']; ?>" required><br><br>
            Profesión: <input type="text" name="profesion" value="<?php echo $usuario['profesion']; ?>" required><br><br>
            Email: <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br><br>
            Foto: <input type="file" name="foto"><br><br>
            <input type="hidden" name="foto_actual" value="<?php echo $usuario['foto']; ?>">
            <input type="submit" value="Actualizar">
        </form>
        <a href="consultar.php">Volver a la lista de usuarios</a>
    </div>
</body>
</html>
