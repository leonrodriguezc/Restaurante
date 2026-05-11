# Restaurante Vegano — PHP MVC

## Stack
- PHP 8.0+, vanilla MVC (no framework)
- Bootstrap 5 frontend
- MySQL via PDO
- Composer autoload (`App\` namespace → `app/`)

## Setup
```bash
composer install
# Importar database/schema.sql en MySQL
# Editar config.php con credenciales
php -S localhost:8000 -t public/
```

## Entry point
`public/index.php` — loads autoloader, config, starts session, dispatches router.

## Routes
All routes in `app/config/routes.php`. Format: `['ControllerName', 'method']` (no "Controller" suffix).

## Roles
- `cliente` — usuario normal
- `mesero` — toma pedidos
- `administrador` — CRUD menú, cerrar caja

## Key files
- `app/core/Database.php` — singleton PDO wrapper (query, fetch, fetchAll, insert, update, delete)
- `app/core/Model.php` — base model (all, find, create, update, delete, where)
- `app/core/Controller.php` — base controller (view, redirect, json, auth, role)
- `app/core/Router.php` — dispatches by URI + HTTP method; supports `_method` override

## Database tables
`usuarios`, `categorias`, `platos`, `cajas`, `pedidos`, `detalle_pedido`, `reservas`

## Constraints
- Arte: CreativeCommons (preferir CC BY SA)
- Tipografías: solo fuentes libres
- Licencia código: GPLv3
