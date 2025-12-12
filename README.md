# tiendaRopa-api
<div align= "center">
  <h1>Tienda de Ropa API</h1>
  <h3>Framework usado</h3>
  <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
  
## Tabla de Contenidos

-   [Tabla de Contenidos](#tabla-de-contenidos)
-   [Acerca de este proyecto](#acerca-de-este-proyecto)
-   [Instalación](#instalación)
    -   [1. Clona el repositorio](#1-clona-el-repositorio)
    -   [2. Navega al directorio del proyecto](#2-navega-al-directorio-del-proyecto)
    -   [3. Comprueba las ramas](#3-comprueba-las-ramas)
    -   [4. Instala las dependencias utilizando Composer](#4-instala-las-dependencias-utilizando-composer)
    -   [5. Configurar el archivo `.env`](#5-configurar-el-archivo-env)
    -   [6. Generar la clave de la aplicación](#6-generar-la-clave-de-la-aplicación)
    -   [7. Configurar la base de datos](#7-configurar-la-base-de-datos)
    -   [8. Ejecutar las migraciones](#8-ejecutar-las-migraciones)
-   [¿Cómo colaborar?](#cómo-colaborar)
    -   [1. Sincronizar las ramas con el repositorio remoto (GitHub)](#1-sincronizar-las-ramas-con-el-repositorio-remoto-github)
    -   [2. Trabajar en un nueva feature](#2-trabajar-en-un-nueva-feature)
    -   [3. Trabajar en su rama local.](#3-trabajar-en-su-rama-local)
    -   [4. Mantener la rama actualizada con `develop`](#4-mantener-la-rama-actualizada-con-develop)
    -   [5. Crear un Pull Request (PR) hacia `develop`](#5-crear-un-pull-request-pr-hacia-develop)
-   [Comandos útiles](#comandos-útiles)
    -   [Crear migraciones](#crear-migraciones)
    -   [Crear Modelos](#crear-modelos)
    -   [Crear Controladores](#crear-controladores)
    -   [Crear Requests](#crear-requests)

## Acerca de este proyecto

Este proyecto es una API RestFull desarrollada con laravel para gestionar una tienda online de Ropa, donde la API nos permite hacer operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre la tienda y los usarios

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu entorno local:

### 1. Clona el repositorio

Ejecuta el siguiente comando en la terminal:

```bash
git clone <url_del_repositorio>
```

### 2. Navega al directorio del proyecto

Ejecuta el siguiente comando en la terminal:

```bash
cd tiendaRopa-api
```

### 3. Comprueba las ramas

Verifica que estés en la rama `develop` antes de proseguir. Si no no es así, sigue el paso 1 de la sección [¿Cómo colaborar?](#cómo-colaborar) para crear y situarte en la rama `develop`. Luego actualiza la rama con los últimos cambios del repositorio remoto ejecutando el siguiente comando:

```bash
git pull origin develop
```

### 4. Instala las dependencias utilizando Composer

Dentro del directorio del proyecto, ejecuta:

```bash
composer install
```

> _Esto instalará todas las dependencias necesarias para que el proyecto funcione correctamente_.

### 5. Configurar el archivo `.env`

Crea un archivo `.env`, luego copia y pega el contenido del archivo `.env.example` en el archivo que creaste. Después, pon tus credenciales de base de datos como se muestra a continuación:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tiendaropadb
DB_USERNAME=root
DB_PASSWORD=
```

Guarda y cierra el archivo `.env`.

### 6. Generar la clave de la aplicación

Genera la clave de la aplicación ejecutando el siguiente comando:

```bash
php artisan key:generate
```

### 7. Configurar la base de datos

Asegúrate de tener una base de datos creada con el nombre que pusiste en el archivo `.env` (en este caso, `relojesdb`).

> _Si no hay una base de datos creada, al ejecutar las migraciones, se preguntará si deseas crearla._

### 8. Ejecutar las migraciones

Ejecuta las migraciones para crear las tablas en la base de datos:

```bash
php artisan migrate
```

> Después de aplicar las migraciones, debe ejecutar el seeder de administrador y el comando para re-hashear contraseñas heredadas si procede:

```bash
php artisan db:seed --class=AdminUserSeeder
php artisan rehash:passwords
```

Esto agregará un usuario administrativo con contraseña encriptada y convertirá contraseñas heredadas en texto plano al formato bcrypt compatible con Laravel.

### Conectar el Frontend (Vite / React)

Si vas a usar el frontend incluido (`Front-end-tienda-`) con Vite, asegúrate de lo siguiente:

- En el proyecto frontend establece la variable de entorno `VITE_API_URL` apuntando a la URL base de la API (incluye `/api` si usas el prefijo):

```
VITE_API_URL=http://localhost:8000/api
```

### Levantar el servidor backend (desarrollo)

Sigue estos pasos en una terminal PowerShell para arrancar el backend Laravel localmente:

```powershell
cd c:\Users\daini\Proyectos\tiendaRopa-api
composer install
Copy-Item .env.example .env
# Edita .env si es necesario para configurar DB, APP_URL y otros valores
php artisan key:generate
php artisan migrate --seed
php artisan serve --host=127.0.0.1 --port=8000
```

Verificación y tips:
- Asegúrate de que `APP_URL` en `.env` sea `http://127.0.0.1:8000` o la URL que uses.
- Si hay errores de sintaxis o excepciones, revisa `storage/logs/laravel.log`.
- Si el servidor requiere HTTPS o una configuración distinta, actualiza `APP_URL` y la configuración de CORS.


## Frontend incluido en este repositorio

En este repositorio hay un frontend localizado en `mkdir frontend` (proyecto Vite + React). Para usarlo, sigue estos pasos:

1. Instalar dependencias e iniciar el servidor de desarrollo

```powershell
cd "c:\Users\daini\Proyectos\tiendaRopa-api\mkdir frontend"
npm install
npm run dev
```

2. Variables de entorno

En la raíz del frontend (`frontend`) puedes crear un `.env` con la siguiente variable (si no existe):

```env
VITE_API_URL=http://localhost:8000/api
```

3. Conexión con el backend

- El frontend hace llamadas a la API en la URL definida por `VITE_API_URL`. Asegúrate de que tu backend (Laravel) esté corriendo en `http://localhost:8000` o cambia la URL según tu entorno.
- CORS: Si tu frontend corre en un puerto distinto (ej. http://localhost:5174), asegúrate de que `config/cors.php` del backend incluya ese origen en `allowed_origins`.

## Probar login (ejemplos)

Credenciales de ejemplo para pruebas (ya presentes en la DB de desarrollo si ejecutaste el seeder):
- **Correo:** admin@gmail.com
- **Contraseña:** abc123

1) Con el UI (recomendado)

- Abre la UI en: `http://localhost:5173` o `http://localhost:5174` según el puerto que Vite asigne.
- Ve a **Login**, introduce `admin@gmail.com` y `abc123`, y pulsa **Entrar**.
- Verifica en DevTools → `Application` → `Local Storage` que se guardó una clave `token`.

2) Con Postman

- Importa `postman/tiendaRopa-api.postman_collection.json` en Postman.
- Ajusta `base_url` a `http://localhost:8000`.
- Haz `POST` a `{{base_url}}/api/login` con body raw JSON (tipo `application/json`):

```json
{
    "correo": "admin@gmail.com",
    "contrasena": "abc123"
}
```

- Copia el token de la respuesta y úsalo en `Authorization: Bearer <token>` en las siguientes peticiones.

3) Con PowerShell (curl/Invoke-RestMethod)

```powershell
$body = @{ correo = 'admin@gmail.com'; contrasena = 'abc123' } | ConvertTo-Json
$response = Invoke-RestMethod -Method Post -Uri 'http://localhost:8000/api/login' -Body $body -ContentType 'application/json'
$response | ConvertTo-Json
$token = $response.token

# Hacer una petición protegida
Invoke-RestMethod -Method Get -Uri 'http://localhost:8000/api/carritos' -Headers @{ Authorization = "Bearer $token" }
```

## Troubleshooting y Errores comunes

- **CORS blocked**: Revisa `config/cors.php` y añade el origen exacto del frontend (`http://localhost:5174` o `http://localhost:5173`).
- **401 Unauthorized**: Asegúrate de enviar el header `Authorization: Bearer <token>` y de que el token no haya vencido. Revisa `localStorage` si el token se guardó.
- **Errores de sintaxis en el backend**: Revisa `storage/logs/laravel.log` y corrige problemas en `routes/api.php` o controladores si aparecen como `syntax error`.
- **Token no válido**: Si al recargar la página el token no es válido, `AuthContext` borrará el token y redirigirá al login.

## Notas adicionales

- Se eliminó `frontend-demo` para evitar duplicidades; el frontend activo está en `mkdir frontend`.
- Si quieres que haga pruebas de login/requests por ti o ejecutar el frontend/backend, dime y lo realizo aquí y comparto resultados.

```

- El servidor de desarrollo de Vite corre por defecto en `http://localhost:5173`. El backend ya tiene `http://localhost:5173` configurado en `config/cors.php`, pero si tu frontend corre en otro host/puerto añade ese origen a `allowed_origins`.

- Para permitir que las peticiones incluyan el token y autenticación, el proyecto usa tokens Bearer (Sanctum en modo token). Asegúrate de haber ejecutado el seeder de administrador y de que las migraciones y seeders estén aplicados.

Ejemplo rápido para levantar ambos servicios (desde dos terminales):

```powershell
# Backend (Terminal 1)
cd c:\Users\daini\Proyectos\tiendaRopa-api
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve --host=127.0.0.1 --port=8000

# Frontend (en otra terminal, Terminal 2)
cd "c:\Users\daini\Proyectos\tiendaRopa-api\mkdir frontend"
npm install
Copy-Item .env.example .env
set-item -path .env -value "VITE_API_URL=http://127.0.0.1:8000/api"
npm run dev
```

## ¿Cómo colaborar?

### 1. Sincronizar las ramas con el repositorio remoto (GitHub)

Si se ha instalado el proyecto desde cero y al ejecutar el comando `git branch` solo aparece la rama `main`, es necesario crear las demás ramas del repositorio remoto en local y sincronizarlas. Para hacer esto se ejecutan los siguientes comandos:

```bash
git fetch origin
git checkout -b develop origin/develop
```

Esto creara una rama local llamada `develop` que rastreara la rama del repositorio remoto `develop`.

### 2. Trabajar en un nueva feature

Asegúrate de estar situado en la rama `develop`, luego actualiza la rama `develop` con los últimos cambios de la rama remota del mismo nombre. Para esto ejecuta el siguiente comando:

```bash
git pull origin develop
```

Después, tienes que crear la rama de la `feature` que vas a desarrollar en el repositorio local. La rama debe seguir la siguiente nomenclatura: `feature/<nombre-feature>`, por ejemplo `feature/crud-usuarios`. El comando para hacer esto es el siguiente:

```bash
git checkout -b feature/<nombre-feature>
```

A continuación, se debe proceder a crear la rama en el repositorio remonto y sincronizarlas. Esto se hace con el siguiente comando:

```bash
git push -u origin feature/<nombre-feature>
```

> _Pedes comprobar que se ha creado la rama en el repositorio de GitHub (es posible que necesites recargar la página para verla)._

Ahora y puedes empezar a trabajar en tu funcionalidad.

### 3. Trabajar en su rama local.

Cada uno desarrolla su parte. Recuerden los comandos:

-   Para hacerle seguimiento a los archivos y sus cambios.
    -   A todos los archivos
        ```bash
        git add .
        ```
    -   A archivos específicos
        ```bash
        git add archivo1, archivo2, archivo3, ...
        ```
-   Para hacer un commit.
    ```bash
    git commit -m "Mensaje del commit"
    ```
-   Para subir los cambios
    ```bash
    git push
    ```
    > _Pueden hacer `push` todas las veces que quiera; la rama `features/<nombre-feature>` es suya._

### 4. Mantener la rama actualizada con `develop`

Si la rama `develop` cambio mientras te encuentras trabajando en tu `feature`, debes actualizar tu rama con los nuevos cambios antes de hacer un Pull Request. Para hacerlo ejecuta los siguientes comandos:

```bash
git fetch origin
git merge origin/develop
```

Una vez que resuelvas los conflictos (si es que los hay), ejecutas:

```bash
git push
```

### 5. Crear un Pull Request (PR) hacia `develop`

Cuando termines la `feature`:

1. Ve a GitHub
2. Situate en la rama de tu `feature` y crea un Pull Request.Lo más probable es que aparezca un ventana de la siguiente forma:
   ![Imagen pull request](https://docs.github.com/assets/cb-34097/mw-1440/images/help/pull_requests/pull-request-compare-pull-request.webp)
3. Define la rama a la que se va a hacer `merge`. En nuestro caso debe ser a `develop` desde la rama de la `feature`: `develop <- feature/<nombre-feature>`. La siguiente imagen muestra donde se hace eso:
   ![Imagen pull request](https://docs.github.com/assets/cb-87213/mw-1440/images/help/pull_requests/pull-request-review-edit-branch.webp)
    > _Recuerda no hacer `merge` a la rama `main`_
4. Por último, dale un titulo y un descripción al Pull Request y dale click en **Create Pull Request**

## Comandos útiles

### Crear migraciones

```bash
php artisan make:migration create_nombreTabla_table --table=nombreTabla
```

### Crear Modelos

```bash
php artisan make:model <NombreDelModelo>
```

Ejemplo

```bash
php artisan make:model Producto
```

### Crear Controladores

```bash
php artisan make:controller <NombreDelControlador> --api
```

Ejemplo

```bash
php artisan make:controller ProductoController --api
```

### Crear Requests

```bash
php artisan make:request <NombreDelRequest>
```

Ejemplo

```bash
php artisan make:request RequestProducto
```

