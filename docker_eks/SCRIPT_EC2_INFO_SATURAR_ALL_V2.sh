#!/bin/bash
# Iniciar el servicio de Apache
systemctl start httpd

# Crear el archivo index2.html con el nuevo contenido
tee /var/www/html/index2.html > /dev/null <<EOL
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos Grupo G12</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #e0f7fa, #80deea);
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 3em;
            color: #01579b;
            margin-top: 20px;
        }
        .container {
            text-align: center;
            padding: 50px;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #004d40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .version {
            font-size: 1.2em;
            color: #00796b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenidos Grupo G12</h1>
        <p class="version">Esta es una página Web actualizada - Versión: ACR002</p>
    </div>
    <footer>
        Creado por Ing. Antonio Contreras - Curso de AWS Arquitectura en la Nube
    </footer>
</body>
</html>
EOL

# Mantener Apache en ejecución en primer plano
apachectl -D FOREGROUND
