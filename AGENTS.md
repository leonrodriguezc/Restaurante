# Restaurante Vegano

## Stack
- MVC (Modelo Vista Controlador)
- Bootstrap frontend

## Modules
- Auth (clientes, meseros, administrador)
- Menú digital (CRUD platos y categorías)
- Pedidos en tiempo real
- Reservas (fecha y hora)
- Cierre de caja y reportes diarios

## Constraints
- Arte: CreativeCommons (preferir CC BY SA)
- Tipografías: solo fuentes libres
- Licencia código: GPLv3

## Project structure
```
app/
  controllers/
  models/
  views/
  config/
public/
  index.php
  assets/
database/
  schema.sql
config.php
composer.json
```

## Entry point
- `public/index.php` — front controller (auto-load + router dispatch)

## Setup
1. `composer install`
2. Import `database/schema.sql` en MySQL
3. Editar `config.php` con credenciales BD
4. `php -S localhost:8000 -t public/`

## Roles
- `cliente` — usuario normal
- `mesero` — puede tomar pedidos
- `administrador` — acceso total (menú CRUD, cerrar caja)

## Key files
- `app/core/` — Database, Router, Controller, Model (base classes)
- `app/config/routes.php` — todas las rutas GET/POST
- `app/models/` — User, Categoria, Plato, Pedido, Reserva, Caja
 
