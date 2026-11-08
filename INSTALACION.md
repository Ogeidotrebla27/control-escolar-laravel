🚀 PASO 1: Crear el archivo de instalación

Comando:
bash

nano INSTALACION.md

Pega esto (son los pasos exactos para el futuro servidor):
markdown

# 🚀 Guía de Instalación en el Servidor de la Escuela

Esta guía está diseñada para instalar el sistema en la PC que funcionará como servidor (Ubuntu Server 24.04 LTS).

## 📋 Requisitos Previos en el Servidor

Antes de comenzar, asegúrate de tener instalado:
*   PHP 8.5 o superior
*   Composer
*   Node.js y NPM
*   MySQL o MariaDB
*   Git

## ⚙️ Pasos para la Instalación

**1. Clonar el repositorio:**
```bash
git clone https://github.com/Ogeidotrebla27/control-escolar-laravel.git
cd control-escolar-laravel

2. Instalar dependencias de PHP:
bash

composer install --no-dev --optimize-autoloader

3. Instalar dependencias de Frontend:
bash

npm install

4. Configurar el archivo de entorno:
bash

cp .env.example .env
php artisan key:generate

(Edita el archivo .env con nano .env para configurar los datos de la base de datos y la URL del servidor).

5. Configurar la base de datos:

    Crea la base de datos en MySQL:

bash

mysql -u root -p -e "CREATE DATABASE control_escolar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

    Ejecuta las migraciones (esto creará las tablas vacías):

bash

php artisan migrate

6. Compilar los assets de Frontend:
bash

npm run build

7. Crear el primer usuario Administrador:
bash

php artisan tinker

Dentro de Tinker, pega esto (cambiando el correo y contraseña):
php

App\Models\User::create([
    'name' => 'Administrador',
    'email' => 'admin@escuela.com',
    'password' => bcrypt('12345678'),
    'role' => 'admin'
]);
exit;

8. Configurar el servidor web (Apache o Nginx):

    La carpeta pública a la que debe apuntar el servidor es: /var/www/control_escolar/public

    Asegúrate de dar permisos a las carpetas:

bash

sudo chown -R www-data:www-data /var/www/control_escolar
sudo chmod -R 775 /var/www/control_escolar/storage
sudo chmod -R 775 /var/www/control_escolar/bootstrap/cache

9. Crear el enlace simbólico para los archivos subidos:
bash

php artisan storage:link

10. Iniciar el servidor de Laravel:
bash

php artisan serve --host=0.0.0.0 --port=8000

🔒 Notas de Seguridad para Producción

    Asegúrate de que APP_DEBUG=false en el archivo .env.

    Configura un certificado SSL (HTTPS) usando Let's Encrypt.

    Configura un respaldo automático de la base de datos en un disco externo.

text


**Guarda con:** `Ctrl + O`, `Enter`, `Ctrl + X`.

---
