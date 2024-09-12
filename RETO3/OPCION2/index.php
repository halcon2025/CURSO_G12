<?php
// Incluir el archivo de conexión a la base de datos
include 'includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"> <!-- Enlace a la hoja de estilos -->
</head>
<body>
    <div class="container">
        <h1>Bienvenido a la Gestión de Usuarios</h1>

        <p>Usa las siguientes opciones para gestionar los usuarios:</p>

        <ul>
            <li><a href="create.php">Registrar Nuevo Usuario</a></li>
            <li><a href="consultar.php">Consultar Usuarios</a></li>
        </ul>
    </div>

    <script src="js/scripts.js"></script> <!-- Enlace al archivo JavaScript -->
</body>
</html>
