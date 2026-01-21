# Go Educa

Sistema de gestión educacional para Chile (multi-tenant por RBD).

## Arquitectura
- Backend PHP 8.2 con CLI propio (`backend/bin/goeduca`).
- Frontend MVC (PHP) con vistas en `app/Views` y rutas en `routes/web.php`.
- Base de datos MySQL 8.
- Migraciones SQL versionadas + scripts diferenciales.

## Estructura
```
backend/
  bin/goeduca
  src/
  .env.example
app/
  Controllers/
  Views/
routes/
public/
database/
  migrations/
  updates/
  seeds/
docs/
```

## Instalación rápida
```bash
cp backend/.env.example backend/.env
docker compose up -d
php backend/bin/goeduca db:init
```

## Documentación
- [Instalación](docs/installation.md)
- [Migraciones y upgrades](docs/database.md)
- [Roles y permisos](docs/roles-permissions.md)
