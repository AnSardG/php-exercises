-- Creamos la base de datos
	CREATE DATABASE DEPARTAMENTOS;
	USE DEPARTAMENTOS;
	
-- Creamos la tabla
    CREATE TABLE EMPLEADO (
        DNI VARCHAR( 9 ) NOT NULL PRIMARY KEY,
        NOMBRE VARCHAR( 100 ) NOT NULL ,
        APELLIDOS VARCHAR( 200 ) NOT NULL ,
        ES_CANDIDATO BOOLEAN NOT NULL,
        VOTA_A VARCHAR( 9 ),
        FOREIGN KEY (VOTA_A) REFERENCES EMPLEADO (DNI) ON UPDATE CASCADE
    );

-- Creamos el usuario
CREATE USER 'gestor_empleados' IDENTIFIED BY 'gestorGESTOR2';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER, EXECUTE ON *.* TO 'gestor_empleados'@'%';

-- Insertamos datos
use DEPARTAMENTOS;

INSERT INTO EMPLEADO (DNI, NOMBRE, APELLIDOS, ES_CANDIDATO)
VALUES 
  ('12345678A', 'Aurora', 'Arcoíris', 1),
  ('87654321B', 'Luna', 'Estrellada', 0),
  ('23456789C', 'Río', 'Cristalino', 1),
  ('98765432D', 'Sol', 'Amanecer', 0),
  ('34567890E', 'Jazmín', 'Espiritual', 1),
  ('34567891K', 'Lucas', 'Fuentes', 1),
  ('78901234L', 'Matías', 'García', 0),
  ('56789123M', 'Adrián', 'Castillo', 1),
  ('12345678N', 'Santiago', 'Martínez', 0),
  ('78901234O', 'Javier', 'Fernández', 1);

