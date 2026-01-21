# Instalación Local - Go Educa

## Requisitos
- Docker + Docker Compose (recomendado)
- Alternativa local: PHP 8.2, MySQL 8, Composer (si decides extender el backend)

## Pasos con Docker
1. Copia el archivo de entorno:
   ```bash
   cp backend/.env.example backend/.env
   ```
2. Levanta los servicios:
   ```bash
   docker compose up -d
   ```
3. Inicializa la base de datos:
   ```bash
   php backend/bin/goeduca db:init
   ```
4. Verifica el estado:
   ```bash
   curl http://localhost:8080/health
   ```

## Acceso inicial
- SuperAdmin
  - RUT: `11111111-1`
  - Contraseña: `Cambiar123!`

## Configuración de variables
Ajusta `backend/.env` con los datos reales de tu entorno.

