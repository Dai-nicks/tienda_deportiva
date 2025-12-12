# Despliegue - Checklist Rápida

Sigue estos pasos en el servidor de producción para desplegar la API y migrar datos con seguridad:

1. Obtener cambios y actualizar dependencias

```bash
git pull origin develop
composer install --no-dev --optimize-autoloader
```

2. Configurar el archivo `.env`

Configura las variables de entorno `DB_*`, `APP_KEY`, `APP_ENV=production`, `VITE_API_URL`, etc.

3. Ejecutar migraciones y crear el admin

```bash
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder
```

4. Re-hashear contraseñas heredadas (si procede)

Si tu sistema antiguo usaba contraseñas en texto plano, ejecuta:

```bash
php artisan rehash:passwords
```

5. Limpiar caches

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

6. Reiniciar servicios/queue si procede

En production, asegúrate de reiniciar Webserver/PHP-FPM y workers si usas queues:

```bash
php artisan queue:restart
```

7. Verificar endpoints básicos

Probar:
- POST /api/login
- GET /api/usuarios (con Authorization header)

8. Ejecutar E2E básico (opcional)

En la carpeta `e2e` hay un script node que prueba login y un endpoint protegido. Para usarlo:

```bash
cd e2e
npm install
npm test
```

El script asume que la API está disponible en `http://localhost:8000/api` y que existe un admin con credenciales `admin@local.dev` / `admin123` (seed).
