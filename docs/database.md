# Migraciones, upgrades y backups

## Flujo de migraciones
- Las migraciones viven en `/database/migrations` y son archivos SQL versionados con timestamp.
- Cada migración incluye secciones `-- UP` y `-- DOWN`.
- La tabla `schema_versions` guarda la versión aplicada, checksum y quién aplicó la migración.

## Comandos
### Inicializar base
```bash
php backend/bin/goeduca db:init
```
- Crea base de datos, usuario y permisos.
- Aplica todas las migraciones.
- Ejecuta seeds mínimos.

### Upgrade
```bash
php backend/bin/goeduca db:upgrade
```
- Detecta migraciones pendientes.
- Aplica cada migración y registra `schema_versions`.
- Genera un SQL diferencial en `/database/updates`.

### Rollback
```bash
php backend/bin/goeduca db:rollback --steps=1
```
- Ejecuta la sección `-- DOWN` de las últimas migraciones.

### Backup
```bash
php backend/bin/goeduca db:backup
```
- Genera un dump en `/backups` con timestamp.
- Requiere `mysqldump` disponible en el host.

## Aplicación manual de scripts
1. Ubica el SQL diferencial en `/database/updates`.
2. Ejecuta el SQL en el entorno productivo con un usuario con permisos de DDL.

