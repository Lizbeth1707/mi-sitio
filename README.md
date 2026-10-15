# Mi Sitio

Sitio web desarrollado con PHP, PostgreSQL y PDO.

## Requisitos

- Laragon
- PHP con pdo_pgsql habilitado
- PostgreSQL

## Configuración

1. Crear la base de datos sitio_db.
2. Crear el usuario sitio_user y darle permisos sobre la base de datos.
3. Ejecutar database/schema.sql en PostgreSQL.
4. Configurar las credenciales en el archivo .env.
5. Abrir el sitio mediante el dominio local configurado en Laragon.

## Funcionalidad

El sitio contiene un inicio y un formulario de contacto.
Los mensajes se validan y se guardan en la tabla mensajes.