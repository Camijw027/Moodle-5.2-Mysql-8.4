# Herramientas HVAC

Plugin local de Moodle creado como ejemplo claro de personalizacion sin modificar el nucleo de Moodle.

## Objetivo

Agregar una pagina util para estudiantes de HVAC dentro de Moodle, respetando el tema activo de la plataforma y usando una estructura de plugin local.

## Funcionalidades

- Convertidor interactivo de temperatura Celsius/Fahrenheit.
- Checklist de preparacion para actividades o practicas.
- Guia rapida de diagnostico para fallas comunes.
- Enlaces externos a recursos tecnicos.

## Archivos principales

- `version.php`: define metadatos, version y compatibilidad del plugin.
- `index.php`: construye la pagina visible dentro del tema de Moodle.
- `styles.css`: contiene estilos propios de la pagina.
- `lang/es/local_hvactools.php`: contiene textos traducibles en espanol.

## Como acceder

Despues de instalar o actualizar plugins desde la administracion de Moodle, entra a:

```text
http://localhost:8080/local/hvactools/index.php
```

## Nota tecnica

El plugin usa `require('../../config.php')`, `$PAGE` y `$OUTPUT`, por eso se integra con el encabezado, navegacion, pie de pagina y tema actual de Moodle.

El enlace superior se configura desde la administracion de Moodle, en los items del menu personalizado:

```text
Herramientas HVAC|/local/hvactools/index.php
```
