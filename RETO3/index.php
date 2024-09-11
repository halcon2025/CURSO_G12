<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $profesion = $_POST['profesion'];
    $email = $_POST['email'];
    $foto = $_FILES['foto'];

    // Crear el directorio 'fotos' si no existe
    if (!is_dir('fotos')) {
        mkdir('fotos', 0777, true);
    }

    // Subir la foto
    $foto_path = 'fotos/' . basename($foto['name']);
    move_uploaded_file($foto['tmp_name'], $foto_path);

    // Insertar el usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, telefono, direccion, pais, ciudad, profesion, email, foto) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
    $result = pg_query_params($conn, $query, array($nombre, $telefono, $direccion, $pais, $ciudad, $profesion, $email, $foto_path));

    if ($result) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registrar Nuevo Usuario</h1>
        <form method="POST" enctype="multipart/form-data">
            Nombre: <input type="text" name="nombre" required><br><br>
            Teléfono: <input type="text" name="telefono" required><br><br>
            Dirección: <input type="text" name="direccion" required><br><br>
            País: <input type="text" name="pais" required><br><br>
            Ciudad: <input type="text" name="ciudad" required><br><br>
            Profesión: <input type="text" name="profesion" required><br><br>
            Email: <input type="email" name="email" required><br><br>
            Foto: <input type="file" name="foto" required><br><br>
            <input type="submit" value="Registrar">
        </form>
        <a href="consultar.php">Consultar Usuarios</a>
    </div>
</body>
</html>
