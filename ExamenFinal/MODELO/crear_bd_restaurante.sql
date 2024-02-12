-- creamos la base de datos
    CREATE DATABASE IF NOT EXISTS restaurante;
    USE restaurante;

-- Creamos las tablas
    CREATE TABLE IF NOT EXISTS CLIENTES (
        CORREO VARCHAR( 100 ) NOT NULL,
        PASSWD VARCHAR( 50 ) NOT NULL,
        PRIMARY KEY ( CORREO )
    );

    CREATE TABLE IF NOT EXISTS RESERVAS ( 
        FECHA DATE NOT NULL,
        HORA TIME NOT NULL,
        MESA INT(1) NOT NULL,
        DESCRIPCION VARCHAR( 200 ),
        CORREO_CLIENTE VARCHAR( 100 ),
        FOREIGN KEY ( CORREO_CLIENTE ) REFERENCES CLIENTES ( CORREO ),
        PRIMARY KEY ( FECHA, HORA, MESA )
    );
    
    CREATE TABLE IF NOT EXISTS EMPLEADOS (
        USUARIO VARCHAR( 50 ) NOT NULL,
        PASSWD VARCHAR( 50 ) NOT NULL,
        PRIMARY KEY ( USUARIO )
    );

CREATE USER IF NOT EXISTS 'admin_restaurante' IDENTIFIED BY 'admin';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER, EXECUTE ON *.* TO 'admin_restaurante'@'%';

-- Poblamos la base de datos

-- USE restaurante;

-- INSERT IGNORE INTO CLIENTES (CORREO, PASSWD) VALUES
--     ('cliente1@example.com', 'password123'),
--     ('cliente2@example.com', 'securepassword'),
--     ('cliente3@example.com', 'testpassword'),
--     ('cliente4@example.com', '1234'),
--     ('cliente5@example.com', '4321'),
--     ('cliente6@example.com', '6789'),
--     ('cliente7@example.com', 'contrasenia'),
--     ('cliente8@example.com', 'pass'),
--     ('cliente9@example.com', 'pword');

-- INSERT IGNORE INTO RESERVAS (FECHA, HORA, MESA, DESCRIPCION, CORREO_CLIENTE) VALUES
--     ('2024-02-05', '20:30:00', 1, 'Reserva para almuerzo grupal', 'cliente1@example.com'),
--     ('2024-02-05', '20:30:00', 2, 'Reserva para almuerzo grupal', 'cliente1@example.com'),
--     ('2024-02-05', '20:30:00', 3, 'Reserva para almuerzo grupal', 'cliente1@example.com'),
--     ('2024-02-05', '20:30:00', 4, 'Reserva para almuerzo grupal', 'cliente1@example.com'),
--     ('2024-02-05', '20:30:00', 5, 'Reserva para almuerzo grupal', 'cliente1@example.com'),
--     ('2024-02-06', '21:00:00', 2, 'Celebración de aniversario', 'cliente2@example.com'),
--     ('2024-02-07', '21:30:00', 3, NULL, 'cliente7@example.com'),
--     ('2024-02-08', '22:30:00', 4, NULL, 'cliente6@example.com'),    
--     ('2024-02-09', '23:00:00', 5, NULL, 'cliente5@example.com');

-- INSERT IGNORE INTO EMPLEADOS (USUARIO, PASSWD) VALUES
--     ('admin', 'admin'),
--     ('empleado1', 'empleadoseguro'),
--     ('jefe2', 'jefazo');