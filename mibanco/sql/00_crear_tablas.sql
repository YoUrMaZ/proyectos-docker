USE quevedodb;

CREATE TABLE usuarios (
                          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          nombre VARCHAR(20) NOT NULL,
                          apellidos VARCHAR(50) NOT NULL,
                          Direccion VARCHAR(100) NOT NULL,
                          edad DATE,
                          email VARCHAR(100) NOT NULL,
                          password VARCHAR(100) NOT NULL
);

-- Crear tabla vacuna
CREATE TABLE vacuna (
                        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(20) NOT NULL,
                        nombre_largo VARCHAR(100) NOT NULL,
                        fabricante VARCHAR(255) NOT NULL,
                        num_dosis INT(10) NOT NULL

);



CREATE TABLE pacientes (
                           id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                           nombre VARCHAR(20) NOT NULL,
                           apellidos VARCHAR(100) NOT NULL,
                           DNI VARCHAR(9) NOT NULL,
                           edad VARCHAR(3) NOT NULL,
                           vacuna VARCHAR(50) NOT NULL

);

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE eventoscalendar (
                        id int(11) NOT NULL,
                        evento varchar(250) DEFAULT NULL,
                        color_evento varchar(20) DEFAULT NULL,
                        fecha_inicio varchar(20) DEFAULT NULL,
                        fecha_fin varchar(20) DEFAULT NULL
);

INSERT INTO eventoscalendar (id, evento, color_evento, fecha_inicio, fecha_fin) VALUES (51, 'Mi Primera Prueba', 'teal', '2021-07-07', '2021-07-08'),
                                                                                       (52, 'Mi Segunda Prueba', 'amber', '2021-07-17', '2021-07-18'),
                                                                                       (53, 'Mi Tercera Prueba', 'orange', '2021-07-03', '2021-07-04');


ALTER TABLE eventoscalendar
    ADD PRIMARY KEY (`id`);

ALTER TABLE eventoscalendar
    MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;
