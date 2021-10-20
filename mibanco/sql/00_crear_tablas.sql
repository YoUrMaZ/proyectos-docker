USE quevedodb;

CREATE TABLE usuarios (
                          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          email VARCHAR(255) NOT NULL UNIQUE,
                          passwd VARCHAR(255) NOT NULL,
                          fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla vacuna
CREATE TABLE vacuna (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(20) NOT NULL,
                        nombre_largo VARCHAR(100) NOT NULL,
                        fabricante VARCHAR(255) NOT NULL,
                        num_dosis INT(10) NOT NULL,
                        tiempo_minimo INT,
                        tiempo_maximo INT
);



CREATE TABLE pacientes (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(20) NOT NULL,
                        apellidos VARCHAR(100) NOT NULL,
                        DNI VARCHAR(9) NOT NULL,
                        edad VARCHAR(3) NOT NULL

);