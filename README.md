Prueba Técnica Mantum

Instalación y Configuración

1. Clonar el repositorio

git clone https://github.com/esteban8356/prueba_tecnica_mantum.git
cd prueba_tecnica_mantum

2. Instalar dependencias

composer install

3. Configurar el entorno

cp .env.example .env

Editar .env y configurar la base de datos:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=PruebaT
DB_USERNAME=postgres
DB_PASSWORD=Admin123

4. Generar clave de aplicación

php artisan key:generate

5. Ejecutar migraciones y seeders

php artisan migrate --seed

6. Iniciar el servidor
