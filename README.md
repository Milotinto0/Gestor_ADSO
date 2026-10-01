# Gestor ADSO

Aplicación web desarrollada en **Laravel** para la gestión de aprendices con autenticación y autorización por roles (**administrador**, **instructor** y **aprendiz**). Incluye CRUD completo de aprendices, gestión de usuarios del sistema, búsqueda, filtrado, paginación, validaciones y una política de seguridad multicapa.

---

## Tabla de contenidos

- [Requisitos](#requisitos)
- [Instalación desde cero](#instalación-desde-cero)
- [Creación de la base de datos](#creación-de-la-base-de-datos)
- [Configuración del `.env`](#configuración-del-env)
- [Migraciones y seeders](#migraciones-y-seeders)
- [Usuarios de prueba](#usuarios-de-prueba)
- [Roles y permisos](#roles-y-permisos)
- [Cómo verificar cada rol](#cómo-verificar-cada-rol)
- [Comandos útiles](#comandos-útiles)
- [Rutas principales](#rutas-principales)
- [Capturas](#capturas)
- [Solución de problemas](#solución-de-problemas)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Tecnologías utilizadas](#tecnologías-utilizadas)

---

## Requisitos

Antes de instalar, asegúrate de tener:

| Herramienta | Versión mínima |
|---|---|
| PHP | 8.2 o superior |
| Composer | 2.x |
| Node.js | 18.x o superior |
| npm | 9.x o superior |
| MySQL o MariaDB | 8.0 / 10.4 |
| Git | 2.x |
| XAMPP (o equivalente) | Opcional, para el servidor MySQL |

Extensiones PHP necesarias (normalmente vienen activas en XAMPP):
`openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`.

---

## Instalación desde cero

### 1. Clonar el repositorio

```bash
git clone https://github.com/Milotinto0/Gestor_ADSO.git
cd Gestor_ADSO
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de Node

```bash
npm install
```

### 4. Crear el archivo `.env`

Copia el archivo de ejemplo y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar el archivo `.env`

Edita `.env` con los datos de tu base de datos (ver la sección [Configuración del `.env`](#configuración-del-env)).

### 6. Crear la base de datos

Ver [Creación de la base de datos](#creación-de-la-base-de-datos).

### 7. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

### 8. Compilar assets del frontend

```bash
npm run dev
```

> Déjalo corriendo en una terminal aparte. Si vas a producción, usa `npm run build`.

### 9. Levantar el servidor

```bash
php artisan serve
```

Abre [http://localhost:8000](http://localhost:8000) en tu navegador.

---

## Creación de la base de datos

### Opción A: Desde la terminal MySQL

```bash
mysql -u root -p
```

```sql
CREATE DATABASE gestor_adso
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;
exit;
```

### Opción B: Desde phpMyAdmin (XAMPP)

1. Abre [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Clic en **Nueva** (columna izquierda).
3. Nombre: `gestor_adso`, cotejamiento: `utf8mb4_unicode_ci`.
4. Clic en **Crear**.

---

## Configuración del `.env`

Estas son las variables **mínimas** que debes ajustar en tu `.env`:

```env
APP_NAME="Gestor ADSO"
APP_ENV=local
APP_KEY=                    # se genera con: php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestor_adso
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

> ⚠️ **Nunca publiques tu `.env` real en el repositorio.** El archivo `.env` está incluido en `.gitignore` y **no** se sube a GitHub. Usa siempre `.env.example` como plantilla.

### Sobre `.env.example`

El archivo `.env.example` incluido en el repositorio contiene valores **genéricos y seguros** que sirven como plantilla. No contiene contraseñas reales ni claves de producción.

---

## Migraciones y seeders

### Migraciones

Crean todas las tablas necesarias (`users`, `aprendices`, `cache`, `jobs`, etc.):

```bash
php artisan migrate
```

### Seeders

Pueblan la base de datos con:
- 3 usuarios de prueba (uno por rol).
- Usuarios aleatorios adicionales (instructores y aprendices).
- 50 aprendices ficticios con `Factory`.

```bash
php artisan db:seed
```

### Todo junto (recomendado en desarrollo)

Reinicia la base de datos desde cero, corre migraciones y ejecuta seeders:

```bash
php artisan migrate:fresh --seed
```

> ⚠️ `migrate:fresh` **borra todos los datos** de la base. Úsalo solo en desarrollo.

---

## Usuarios de prueba

> ⚠️ Estas credenciales son solo para desarrollo y pruebas. **Nunca** las uses en producción.

| Rol | Email | Contraseña |
|---|---|---|
| Administrador | `admin@gestor.com` | `password` |
| Instructor | `instructor@gestor.test` | `password` |
| Aprendiz | `aprendiz@gestor.test` | `password` |

Estas cuentas se crean automáticamente al ejecutar:

```bash
php artisan migrate:fresh --seed
```

---

## Roles y permisos

La aplicación define **3 roles** almacenados en la columna `role` de la tabla `users`.

### Matriz de permisos

| Acción | Administrador | Instructor | Aprendiz |
|---|:-:|:-:|:-:|
| Ver listado de aprendices | ✅ | ✅ | ✅ |
| Ver detalle de aprendiz | ✅ | ✅ | ✅ |
| Crear aprendiz | ✅ | ✅ | ❌ |
| Editar aprendiz | ✅ | ✅ | ❌ |
| Eliminar aprendiz | ✅ (con restricciones) | ❌ | ❌ |
| Ver gestión de usuarios | ✅ | ❌ | ❌ |
| Crear / editar usuarios | ✅ | ❌ | ❌ |
| Eliminar usuarios | ✅ (con restricciones) | ❌ | ❌ |

### Restricciones adicionales

- **El administrador no puede eliminarse a sí mismo.**
- **El administrador no puede eliminar a otros administradores.**
- **El administrador no puede eliminar su propia cuenta** desde la vista de perfil.
- El administrador **sí** puede editar a otros administradores y a sí mismo.

### Defensa en profundidad

La autorización se aplica en **3 capas independientes**:

1. **Rutas** — middleware `can:` en `routes/web.php`.
2. **Controladores** — `$this->authorize(...)` en cada acción.
3. **Vistas** — directivas `@can` / `@cannot` en Blade.

Si un usuario intenta forzar una acción (por ejemplo, editando el HTML en DevTools), el servidor responde con **HTTP 403 Forbidden**.

### Implementación

- **Policies**: `AprendizPolicy` y `UserPolicy` en `app/Policies/`.
- **Form Requests**: validación y mensajes personalizados en `app/Http/Requests/`.
- **Middleware**: `can:viewAny,App\Models\User` aplicado a las rutas.

---

## Cómo verificar cada rol

### 1. Administrador

1. Inicia sesión con `admin@gestor.com` / `password`.
2. En el navbar verás el badge azul **ADMINISTRADOR**.
3. Ve a **Aprendices**:
   - Verás el botón **+ Nuevo**.
   - Cada fila tiene **Editar** y **Eliminar**.
4. Ve a **Usuarios** (link visible solo para admin):
   - Puedes crear, editar y eliminar usuarios.
   - **No** puedes eliminar tu propia cuenta.
   - **No** puedes eliminar a otros administradores.
5. Ve a **Perfil**:
   - **No** aparece la sección "Eliminar cuenta".

### 2. Instructor

1. Cierra sesión y entra con `instructor@gestor.test` / `password`.
2. El navbar muestra el badge verde **INSTRUCTOR**.
3. Ve a **Aprendices**:
   - Verás el botón **+ Nuevo**.
   - Cada fila tiene **Editar** pero **NO** "Eliminar".
4. **No** aparece el link "Usuarios" en el navbar.
5. Si intentas acceder manualmente a `/users` → **403 Forbidden**.
6. Si intentas eliminar un aprendiz vía POST → **403 Forbidden**.

### 3. Aprendiz

1. Cierra sesión y entra con `aprendiz@gestor.test` / `password`.
2. El navbar muestra el badge naranja **APRENDIZ**.
3. Ve a **Aprendices**:
   - **No** hay botón **+ Nuevo**.
   - **No** hay columna "Acciones" (la tabla solo muestra datos).
4. Si intentas acceder a `/aprendices/create` → **403 Forbidden**.
5. Si intentas acceder a `/users` → **403 Forbidden**.

---

## Comandos útiles

| Comando | Descripción |
|---|---|
| `php artisan serve` | Levanta el servidor en `http://localhost:8000` |
| `npm run dev` | Compila assets en modo desarrollo con hot reload |
| `npm run build` | Compila assets para producción |
| `php artisan migrate` | Ejecuta migraciones pendientes |
| `php artisan migrate:fresh --seed` | Reinicia la BD, migra y ejecuta seeders |
| `php artisan db:seed` | Ejecuta solo los seeders |
| `php artisan tinker` | Consola interactiva de Laravel |
| `php artisan route:list` | Lista todas las rutas registradas |
| `php artisan route:list --name=users` | Filtra rutas por nombre |
| `php artisan optimize:clear` | Limpia todas las cachés |
| `php artisan make:model Nombre -mfs` | Crea modelo + migración + factory + seeder |
| `php artisan make:policy NombrePolicy --model=Nombre` | Crea una Policy |
| `php artisan make:request NombreRequest` | Crea un Form Request |

---

## Rutas principales

### Públicas

| Método | URL | Nombre | Descripción |
|---|---|---|---|
| GET | `/` | — | Redirige a `/aprendices` |

### Autenticación (Breeze)

| Método | URL | Nombre |
|---|---|---|
| GET | `/login` | `login` |
| POST | `/login` | — |
| GET | `/register` | `register` |
| POST | `/register` | — |
| POST | `/logout` | `logout` |

### Perfil

| Método | URL | Nombre |
|---|---|---|
| GET | `/profile` | `profile.edit` |
| PATCH | `/profile` | `profile.update` |
| DELETE | `/profile` | `profile.destroy` |

### Aprendices (protegidas)

| Método | URL | Nombre | Roles permitidos |
|---|---|---|---|
| GET | `/aprendices` | `aprendices.index` | Todos |
| GET | `/aprendices/create` | `aprendices.create` | Admin, Instructor |
| POST | `/aprendices` | `aprendices.store` | Admin, Instructor |
| GET | `/aprendices/{aprendiz}` | `aprendices.show` | Todos |
| GET | `/aprendices/{aprendiz}/edit` | `aprendices.edit` | Admin, Instructor |
| PUT | `/aprendices/{aprendiz}` | `aprendices.update` | Admin, Instructor |
| DELETE | `/aprendices/{aprendiz}` | `aprendices.destroy` | Solo Admin |

### Usuarios (protegidas)

| Método | URL | Nombre | Roles permitidos |
|---|---|---|---|
| GET | `/users` | `users.index` | Solo Admin |
| GET | `/users/create` | `users.create` | Solo Admin |
| POST | `/users` | `users.store` | Solo Admin |
| GET | `/users/{usuario}/edit` | `users.edit` | Solo Admin |
| PUT | `/users/{usuario}` | `users.update` | Solo Admin |
| DELETE | `/users/{usuario}` | `users.destroy` | Solo Admin (con restricciones) |

---

## Capturas

> 📸 Agrega aquí las capturas de tu aplicación. Guárdalas en `docs/capturas/` y referéncialas así:

### Login

![Pantalla de login](docs/capturas/01-login.png)

### Listado de aprendices (vista administrador)

![Listado como admin](docs/capturas/02-aprendices-admin.png)

### Listado de aprendices (vista aprendiz — solo lectura)

![Listado como aprendiz](docs/capturas/03-aprendices-aprendiz.png)

### Formulario de creación con validaciones

![Formulario de creación](docs/capturas/04-crear-aprendiz.png)

### Errores de validación mostrados al usuario

![Errores de validación](docs/capturas/05-errores-validacion.png)

### Gestión de usuarios (solo admin)

![Gestión de usuarios](docs/capturas/06-usuarios.png)

### Respuesta 403 al forzar acceso no autorizado

![403 Forbidden](docs/capturas/07-403.png)

> Para agregar capturas: crea la carpeta `docs/capturas/` en el repositorio y sube los archivos `.png`. El instructor podrá verlas directamente en GitHub.

---

## Solución de problemas

### `SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'`

Credenciales incorrectas en `.env`. En XAMPP el usuario suele ser `root` sin contraseña:

```env
DB_USERNAME=root
DB_PASSWORD=
```

### `php artisan migrate` no conecta con MySQL

Verifica que el servicio MySQL esté corriendo en XAMPP. Luego limpia cachés:

```bash
php artisan config:clear
php artisan optimize:clear
```

### `Class "App\Models\X" not found`

Falta el `use` en el controlador. Agrega arriba:

```php
use App\Models\X;
```

### `Call to undefined method Controller::authorize()`

Falta el trait `AuthorizesRequests` en la clase base. Abre `app/Http/Controllers/Controller.php`:

```php
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;
}
```

### `403 This action is unauthorized` al editar o crear

Revisa que el Form Request correspondiente tenga `authorize()` en `true`:

```php
public function authorize(): bool
{
    return true;
}
```

Y que la Policy del modelo permita la acción para tu rol.

### La tabla queda desalineada según el rol

Ocultar columnas condicionales debe hacerse **tanto en el `<thead>` como en el `<tbody>`**, con la misma condición `@can`. Si solo ocultas la cabecera y no la celda, la tabla se desalinea.

### `Vite manifest not found`

Falta compilar los assets. Ejecuta:

```bash
npm install
npm run dev
```

### La paginación se ve sin estilos

Laravel usa Tailwind por defecto en los enlaces de paginación. Publica las vistas y usa una personalizada:

```bash
php artisan vendor:publish --tag=laravel-pagination
```

### `Route [X] not defined`

Actualiza la caché de rutas:

```bash
php artisan route:clear
php artisan optimize:clear
```

---

## Estructura del proyecto

```
Gestor_ADSO/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AprendizController.php
│   │   │   ├── UserController.php
│   │   │   └── ProfileController.php
│   │   └── Requests/
│   │       ├── StoreUpdateAprendizRequest.php
│   │       └── StoreUpdateUserRequest.php
│   ├── Models/
│   │   ├── Aprendiz.php
│   │   └── User.php
│   └── Policies/
│       ├── AprendizPolicy.php
│       └── UserPolicy.php
├── database/
│   ├── factories/
│   │   ├── AprendizFactory.php
│   │   └── UserFactory.php
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── aprendizajes/
│       ├── users/
│       ├── profile/
│       └── layouts/
│           └── app.blade.php
├── routes/
│   ├── web.php
│   └── auth.php
└── .env.example
```

---

## Tecnologías utilizadas

- **PHP** 8.2
- **Laravel** 11/12
- **Laravel Breeze** (autenticación con Blade)
- **Blade** (motor de plantillas)
- **Eloquent ORM**
- **MySQL / MariaDB**
- **Vite** (compilación de assets)
- **Git + GitHub** (control de versiones)

---

## Autor

**Juan Camilo Zea Ortiz**
Plan de mejoramiento académico — Programación con PHP y Laravel

---

## Licencia

Proyecto académico. Uso educativo.