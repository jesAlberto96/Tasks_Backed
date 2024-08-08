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
        - Se crea un admin con permisos globales, puede ver todas las tareas de todos los usuarios
            - admin@admin.com
            - secret
        - Se crea usuario con permisos especificos, solo puede visualizar las tareas que este crea
            - usuario@usuario.com
            - secret
7. Ejecutar: php artisan serve
