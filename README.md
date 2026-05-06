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

## Persistencia

Moodle guarda datos en dos lugares:

- `moodledata/`: archivos subidos, cache, sesiones y datos internos de Moodle.
- `mysql_data`: volumen Docker donde vive la base de datos MySQL.

Para detener sin borrar datos:

```powershell
docker compose stop
```

Para eliminar contenedores sin borrar los datos persistentes:

```powershell
docker compose down
```

Para eliminar contenedores y volumenes:

```powershell
docker compose down -v
```

Usa `docker compose down -v` solo si quieres reiniciar la instalacion desde cero, porque borra la base de datos guardada en el volumen `mysql_data`.
