<?php
// Datos de conexión a PostgreSQL
$host = 'db'; // Este es el nombre del servicio del contenedor Docker para la DB
$dbname = 'mydb';
$user = 'myuser';
$password = 'mypassword';

// Conexión a PostgreSQL
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

// Verificar la conexión
if (!$conn) {
    die("Error: No se pudo conectar a la base de datos.");
}
?>
