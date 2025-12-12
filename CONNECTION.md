# Conectar frontend con backend (tiendaRopa-api)

Este documento rápido explica cómo conectar tu frontend (Vite/React/Vue/vanilla) con este backend Laravel.

1) Configuración del backend
- Asegúrate de que en el archivo `.env` de Laravel tengas `APP_URL` apuntando al backend, por ejemplo:
  - `APP_URL=http://localhost:8000`
- Si ejecutas `php artisan serve`, por defecto el backend estará en `http://127.0.0.1:8000` o `http://localhost:8000`.

2) CORS
- `config/cors.php` ya incluye `http://localhost:5173` y `http://localhost:3000` en `allowed_origins` y `supports_credentials` está en `true`.
- Si tu frontend corre en otro puerto, añade ese origen exacto (incluye el puerto).

3) Flujo de autenticación
- Endpoint de login: `POST /api/login` (cuerpo JSON: `{ "correo": "...", "contrasena": "..." }`).
- Respuesta del login contiene `token` (plainTextToken). Guarda este token en `localStorage` o en el estado de la app.
- Para acceder a rutas protegidas añade header `Authorization: Bearer <token>`.

4) Ejemplos de uso
- Archivo de ejemplo: `frontend-example/api.js` con funciones para `fetch` y `axios`.
- Si usas Vite, añade en tu `.env` de frontend:
  - `VITE_API_URL=http://localhost:8000/api`
- Ejemplo rápido con `fetch`:
  - `loginFetch('usuario@example.com','password')`
  - `getProductosFetch()`

5) Colección Postman
- Archivo: `postman/tiendaRopa-api.postman_collection.json`
- Importa esa colección en Postman. Variables disponibles:
  - `base_url` (por defecto `http://localhost:8000`)
  - `token` (pegue aquí el token después del login)

6) Comandos rápidos para probar
```powershell
# Login (curl en PowerShell)
curl -Method POST -Uri http://localhost:8000/api/login -Body (@{ correo='usuario@example.com'; contrasena='password' } | ConvertTo-Json) -ContentType 'application/json'

# Listar productos (público)
curl http://localhost:8000/api/productos

# Usar token para rutas protegidas (PowerShell example)
curl -Headers @{ Authorization = 'Bearer TU_TOKEN_AQUI' } http://localhost:8000/api/carritos
```

7) Problemas frecuentes
- CORS: revisa `config/cors.php` y el origen exacto (incluye puerto).
- 401: token no enviado o inválido. Asegúrate de enviar `Authorization` correctamente.
- 404: recuerda el prefijo `/api` en las rutas.

8) Siguientes pasos que puedo hacer por ti
- Generar un pequeño esqueleto de frontend (Vite + React) usando estas funciones.
- Crear una colección Postman con más endpoints (productos/pedidos/pagos) y tests.
- Implementar refresh token o logout en frontend.

9) Demo incluida (Vite + React)
- He añadido un demo mínimo en `frontend-demo/` que utiliza las funciones de `frontend-example/api.js`.
- Para ejecutarlo:
  - `cd frontend-demo`
  - `npm install`
  - `npm run dev`
- Ajusta `VITE_API_URL` en un `.env` dentro de `frontend-demo` si tu backend corre en otro puerto.
