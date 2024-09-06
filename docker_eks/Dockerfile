# Usar Amazon Linux 2 como base
FROM amazonlinux:2

# Actualizar el sistema e instalar Apache, PHP, unzip y curl
RUN yum update -y && \
    yum install -y httpd php unzip curl

# Descargar y configurar la aplicación web
RUN curl -L -o /tmp/lab-app.zip https://github.com/halcon2025/stress/raw/0dadf6ebe411691142f2b9e0cbb458f18356d4d1/lab-app.zip && \
    unzip /tmp/lab-app.zip -d /var/www/html/ && \
    chown -R apache:apache /var/www/html/ && \
    chmod -R 755 /var/www/html/

# Copiar el script
COPY SCRIPT_EC2_INFO_SATURAR_ALL.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/SCRIPT_EC2_INFO_SATURAR_ALL.sh

# Exponer el puerto 80
EXPOSE 80

# Ejecutar el script que arranca Apache
CMD ["/usr/local/bin/SCRIPT_EC2_INFO_SATURAR_ALL.sh"]