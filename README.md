# Moodle 5.2 con Docker

Entorno Docker simple para ejecutar Moodle 5.2 usando fuentes oficiales.

## Componentes

- Moodle 5.2 descargado desde `download.moodle.org`
- PHP 8.3 con Apache en un contenedor
- MySQL 8.4 en un contenedor separado

## Levantar el entorno

```powershell
docker compose up -d --build
```

Luego abre:

```text
http://localhost:8080
```

## Datos de instalacion

- Tipo de base de datos: `mysqli`
- Servidor de base de datos: `mysql`
- Nombre de base de datos: `moodle`
- Usuario: `moodle`
- Contrasena: `moodle52`
- Prefijo de tablas: `mdl_`
- Puerto: vacio o `3306`
- Socket Unix: vacio
- Directorio de datos: `/var/www/moodledata`
