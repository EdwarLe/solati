# User Management API

Este proyecto es una aplicación web que permite gestionar usuarios a través de un servicio web tipo REST. Está desarrollada en PHP con PostgreSQL y utiliza el patrón de diseño MVC (Modelo-Vista-Controlador) y el patrón DAO (Data Access Object) para acceder a los datos.

## Estructura del Proyecto

- **config/**
  - `config.php` - Configuración de la base de datos.
- **controllers/**
  - `UserController.php` - Controlador que maneja las solicitudes relacionadas con los usuarios.
- **models/**
  - `User.php` - Modelo que representa a un usuario.
  - `UserDAO.php` - Data Access Object para acceder y manipular los datos de usuarios en la base de datos.
  - `Database.php` - Archivo de conexión a la base de datos.
- **views/**
  - `index.php` - Vista principal que muestra los formularios y la lista de usuarios.
- **css/**
  - `styles.css` - Archivo de estilos básicos.
- **js/**
  - `index.js` - Archivo con la lógica básica para el fetching de datos.
- `index.php` - Archivo principal que dirige las solicitudes a los controladores adecuados.

## Instalación y Configuración

### Crear la Base de Datos y la Tabla

1. **Conéctate a PostgreSQL** usando tu cliente de base de datos (por ejemplo, pgAdmin o `psql`).

2. **Crea la base de datos:**

    ```sql
    CREATE DATABASE usuarios_db;
    ```

3. **Selecciona la base de datos:**

    ```sql
    \c usuarios_db
    ```

4. **Crea la tabla de usuarios:**

    ```sql
    CREATE TABLE users (
        id SERIAL PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        name VARCHAR(100) NOT NULL,
        surname VARCHAR(100) NOT NULL,
        job VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    );
    ```

### Configuración

1. **Editar `config/config.php`:** Configura los parámetros de conexión a la base de datos PostgreSQL.

    ```php
    <?php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'usuarios_db'); // Cambia esto por el nombre de la base de datos
    define('DB_USER', 'root'); // Cambia esto si tienes un nombre de usuario diferente
    define('DB_PASSWORD', ''); // Cambia esto si tienes una contraseña
    ?>
    ```
