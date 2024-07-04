## Pasos para la instalacion y ejecución
```bash
## Pasos para la instalacion y ejecución
1. git clone https://github.com/jesAlberto96/Tasks_Backed.git
2. composer install
3. Crear archivo .env, pueden tomar de copia .env.example
4. Borrar Caches
    - php artisan config:clear
    - php artisan route:clear
    - php artisan view:clear
    - php artisan cache:clear
5. Ejecutar migraciones
    - Si no ha creado la DB, por favor crearla y colocar el nombre en la variable DB_DATABASE del .env, en mi caso la llame db_tasks
    - Ejecutar: php artisan migrate
6. Ejecutar Seeders
    - php artisan db:seed
        - Se crea un usuario para probar con credeciales
            - admin@admin.com
            - secret
7. Ejecutar: php artisan serve
