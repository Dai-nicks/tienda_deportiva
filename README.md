
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# tiendaRopa-api
<div align= "center">
  <h1>Tienda de Ropa API</h1>
  <h3>Framework usado</h3>
  <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
  <h3>Desarrollado por</h3>

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
>>>>>>> a4b509c0b8dba03b746b4cba3c2ed840014f5aaa
