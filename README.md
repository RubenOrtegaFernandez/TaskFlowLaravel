# TaskFlow

TaskFlow es una aplicación web para organizar tareas por departamento. Permite asignar tareas a trabajadores, revisar su progreso y administrar usuarios, categorías y departamentos desde una interfaz adaptada a cada rol.

La interfaz está principalmente en catalán.

## Funcionalidades

- Registro e inicio de sesión de usuarios.
- Recuperación y cambio de contraseña.
- Paneles distintos para administración, caps de departamento y trabajadores.
- Creación, asignación, edición y seguimiento de tareas.
- Activación y desactivación de tareas sin eliminarlas.
- Estados de tarea: `pendent`, `en_curs`, `fet` y `revisat`.
- Prioridades: `baixa`, `mitja`, `alta` y `urgent`.
- Gestión de departamentos y categorías.
- Asignación de usuarios a departamentos y administración de roles.
- Exportación de tareas a Excel.
- Efectos Liquid Glass y estilos propios en SCSS.

## Roles

| Rol | Acceso principal |
| --- | --- |
| Administrador (`admin`) | Gestiona usuarios, roles, departamentos, categorías y todas las tareas. |
| Cap de departamento (`cap`) | Gestiona las tareas y los trabajadores de su departamento, y revisa tareas finalizadas. |
| Trabajador (`client`) | Consulta sus tareas asignadas y puede marcarlas como finalizadas si están activas. |

Los nuevos registros se crean como trabajadores. El administrador puede cambiar el rol y el departamento desde **Treballadors → Editar usuario**. Cada departamento puede tener un único cap.

## Requisitos

- PHP 8.3 o superior, con las extensiones requeridas por Laravel y PhpSpreadsheet (`fileinfo`, `gd` y `zip`).
- Composer.
- Node.js y npm.
- MySQL o MariaDB.

## Instalación local

1. Instala las dependencias de PHP y JavaScript:

   ```sh
   composer install
   npm install
   ```

2. Crea el archivo de entorno. En PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

   En macOS o Linux:

   ```sh
   cp .env.example .env
   ```

3. Crea una base de datos vacía llamada `taskflow` (o el nombre que prefieras) y configura `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` en `.env`.

4. Genera la clave de la aplicación y ejecuta las migraciones:

   ```sh
   php artisan key:generate
   php artisan migrate
   ```

5. Opcionalmente, carga los datos de demostración una sola vez en una base vacía:

   ```sh
   php artisan db:seed
   ```

   `DatabaseSeeder` crea departamentos, usuarios de demostración y tareas. Los seeders insertan registros nuevos y no están preparados para ejecutarse repetidamente sobre la misma base: pueden producir duplicados o conflictos de correo. Las cuentas y contraseñas de demostración están definidas en `database/seeders/DatabaseSeeder.php`; úsalas solo en desarrollo.

6. Inicia la aplicación. En una terminal:

   ```sh
   php artisan serve
   ```

   En otra terminal, para servir los recursos de Vite durante el desarrollo:

   ```sh
   npm run dev
   ```

   Abre `http://127.0.0.1:8000`.

## Base de datos

Las migraciones de `database/migrations` son la fuente recomendada para crear o actualizar el esquema:

```sh
php artisan migrate
```

Entre otras tablas, el esquema incluye `usuaris`, `departaments`, `tasques` y `categories`. La disponibilidad de una tarea se guarda en el booleano `activa`; el valor inicial es `true` y no sustituye al campo `estat`, que registra el progreso.

El repositorio también contiene `taskflow.sql`, un volcado histórico de phpMyAdmin. Puede no incluir los cambios de esquema más recientes; para una instalación nueva, utiliza las migraciones en lugar de importar ese volcado.

## Recursos de frontend

El JavaScript se procesa con Vite y el CSS se compila desde `resources/scss/main.scss`.

```sh
npm run dev          # Vite en desarrollo
npm run build        # Compila los recursos de Vite
npm run sass:build   # Compila SCSS a public/css/main.css
npm run sass:watch   # Recompila SCSS al guardar cambios
```

Para una ejecución sin servidor Vite, compila los recursos antes de servir la aplicación:

```sh
npm run build
npm run sass:build
```

Liquid Glass se utiliza en varios componentes de la interfaz.

## Recuperación de contraseña y correo

El `.env.example` usa el mailer `log` para desarrollo. Los mensajes de recuperación se escriben en `storage/logs/laravel.log`. Para enviar correo real, configura un transporte SMTP en `.env` (`MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD` y `MAIL_FROM_ADDRESS`).

## Pruebas

Ejecuta la suite PHPUnit/Laravel con:

```sh
php artisan test
```

Las pruebas existentes cubren principalmente los flujos de autenticación, recuperación de contraseña y perfil.

## Estructura del proyecto

```text
app/                 Controladores, modelos, correo y exportaciones
database/migrations/ Esquema de la base de datos
database/seeders/    Datos de demostración
resources/js/        JavaScript y módulos de interfaz
resources/scss/      Estilos fuente
resources/views/     Vistas Blade
routes/web.php       Rutas de la aplicación
public/              Recursos públicos y CSS compilado
tests/               Pruebas PHPUnit
```

## Configuración y seguridad

- No subas `.env` ni credenciales reales al repositorio. `.env` está incluido en `.gitignore`.
- Usa claves, contraseñas y cuentas propias en cualquier entorno compartido o de producción.
- Los usuarios y tareas creados por los seeders son solo datos de demostración.