# Archivos movidos a /tmp_app

## ¿Qué se movió?
Se movieron los archivos demo y páginas de plantilla que **no** se usan en el módulo de Login ni en el Dashboard inicial, por ejemplo:

- `apps-*.php` (demos de aplicaciones)
- `auth-*.php` (demos de autenticación)
- `charts-*.php` (demos de gráficos)
- `extended-*.php` (componentes extendidos)
- `forms-*.php` (formularios demo)
- `icons-*.php` (iconos demo)
- `layouts-*.php` (layouts demo)
- `maps-*.php` (mapas demo)
- `pages-*.php` (páginas informativas demo)
- `tables-*.php` (tablas demo)
- `ui-*.php` (componentes UI demo)
- `widgets.php` y `index.php` (dashboard demo original)
- Carpetas `partials/` y `services/` de la plantilla original

## ¿Por qué no se usaron?
El módulo solicitado requiere un flujo MVC estricto con Login y Dashboard propios dentro de `/app` y `/public`. 
Las páginas demo originales no forman parte del flujo de rutas `/login` y `/dashboard` y por ello se movieron para evitar confusión y mantener el proyecto limpio.

## ¿Cómo reutilizarlos luego?
1. Copia el archivo o carpeta deseada desde `/tmp_app` hacia una ubicación dentro de `/app/views` o `/public`.
2. Ajusta las rutas de assets (por ejemplo, `/assets/...`) para que apunten a `/public/assets`.
3. Crea una ruta en `/routes/web.php` y un controlador que renderice la nueva vista.

> **Nota:** Ningún archivo fue eliminado, solo movido para cumplir la regla de conservación de demos.
