#!/bin/bash

# Obtener el token de metadatos para IMDSv2
TOKEN=$(curl -X PUT "http://169.254.169.254/latest/api/token" -H "X-aws-ec2-metadata-token-ttl-seconds: 21600")

# Obtener el ID de la instancia, IP privada y IP pública
INSTANCE_ID=$(curl -H "X-aws-ec2-metadata-token: $TOKEN" -s http://169.254.169.254/latest/meta-data/instance-id)
PRIVATE_IP=$(curl -H "X-aws-ec2-metadata-token: $TOKEN" -s http://169.254.169.254/latest/meta-data/local-ipv4)
PUBLIC_IP=$(curl -H "X-aws-ec2-metadata-token: $TOKEN" -s http://169.254.169.254/latest/meta-data/public-ipv4)

# Crear el archivo index2.html con los datos obtenidos
sudo tee /var/www/html/index2.html > /dev/null <<EOL
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de la Instancia EC2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        .highlight {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <h1>Información de la Instancia EC2</h1>
    <p>El ID de la instancia EC2 es: <span class="highlight">$INSTANCE_ID</span></p>
    <p>La IP privada de esta instancia es: <span class="highlight">$PRIVATE_IP</span></p>
    <p>La IP pública de esta instancia es: <span class="highlight">$PUBLIC_IP</span></p>
</body>
</html>
EOL
