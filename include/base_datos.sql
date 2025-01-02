-- Crear la base de datos
CREATE DATABASE bd_tesoro_del_saber;

-- Usar la base de datos creada
USE bd_tesoro_del_saber;

-- Crear la tabla USUARIOS
CREATE TABLE
    USUARIOS (
        IDUsuario VARCHAR(20) PRIMARY KEY,
        Nombre VARCHAR(50) NOT NULL,
        ApellidoPaterno VARCHAR(50) NOT NULL,
        ApellidoMaterno VARCHAR(50) NOT NULL,
        Edad INT CHECK (Edad >= 0),
        Sexo ENUM ('M', 'F') NOT NULL,
        Email VARCHAR(100) NOT NULL UNIQUE,
        Telefono VARCHAR(15),
        TipoUsuario ENUM ('Admin', 'Cliente', 'PL', 'CL') NOT NULL,
        Password VARCHAR(255) NOT NULL
    );

-- Crear la tabla PEDIDOS
CREATE TABLE
    PEDIDOS (
        FolioPedido INT AUTO_INCREMENT PRIMARY KEY,
        IDUsuario VARCHAR(10),
        TituloLibro VARCHAR(100) NOT NULL,
        Autor VARCHAR(100) NOT NULL,
        Precio DECIMAL(10, 2) NOT NULL,
        FechaPedido DATE NOT NULL,
        FOREIGN KEY (IDUsuario) REFERENCES USUARIOS (IDUsuario)
    );

--Inserciones
-- Insertar usuario de tipo PL (Personal de la librería)
INSERT INTO
    USUARIOS (
        IDUsuario,
        Nombre,
        ApellidoPaterno,
        ApellidoMaterno,
        Edad,
        Sexo,
        Email,
        Telefono,
        TipoUsuario,
        Password
    )
VALUES
    (
        '0000',
        'Emilio',
        'Garcia',
        'Meneses',
        44,
        'M',
        'emilio.garcia@gmail.com',
        '5551234567',
        'PL',
        'Progweb2#'
    );

-- Insertar usuario de tipo CL (Cliente de la librería)
INSERT INTO
    USUARIOS (
        IDUsuario,
        Nombre,
        ApellidoPaterno,
        ApellidoMaterno,
        Edad,
        Sexo,
        Email,
        Telefono,
        TipoUsuario,
        Password
    )
VALUES
    (
        '9999',
        'Esther',
        'Meneses',
        'Hernandez',
        60,
        'F',
        'ester.meneses@gmail.com',
        '5559876543',
        'CL',
        'Progweb2#'
    );

INSERT INTO
    PEDIDOS (
        IDUsuario,
        TituloLibro,
        Autor,
        Precio,
        FechaPedido
    )
VALUES
    (
        '9999',
        'El principito',
        'Antoine de Saint-Exupéry',
        99,
        '2024-06-07'
    ),
    (
        '9999',
        'Juego de tronos',
        'George R. R. Martin',
        489,
        '2024-06-05'
    ),
    (
        '9999',
        'Cien años de soledad',
        'Gabriel García Márquez',
        348,
        '2024-07-09'
    ),
    (
        '9999',
        'El alquimista',
        'Paulo Coelho',
        199,
        '2024-05-11'
    ),
    (
        '9999',
        'La divina comedia',
        'Dante Alighieri',
        299,
        '2024-04-12'
    ),
    (
        '9999',
        'Los miserables',
        'Víctor Hugo',
        257,
        '2024-03-15'
    );