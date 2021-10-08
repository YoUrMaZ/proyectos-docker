USE quevedodb;

CREATE TABLE usuarios (
    nombre VARCHAR(255),
    apellidos VARCHAR(255),
    nickname VARCHAR(255) NOT NULL,
    Direccion VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    passwd VARCHAR(255),
);
