CREATE DATABASE IF NOT EXISTS proyecto_dw;
USE proyecto_dw;

CREATE TABLE usuario(
	id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(50),
	clave VARCHAR(50) NOT NULL UNIQUE,
	rol VARCHAR(20) NOT NULL
);

CREATE TABLE productos(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL UNIQUE,
	precioUnitario DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
	stock INT NOT NULL
);

CREATE TABLE ventas(
	id INT AUTO_INCREMENT PRIMARY KEY,
	productoId INT NOT NULL,
	cantidad INT NOT NULL,
	precioUnitario DECIMAL(10,2) NOT NULL,
	total DECIMAL(10,2) NOT NULL,
	FOREIGN KEY (productoId) REFERENCES productos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO usuario (nombre, correo, clave, rol) VALUES
('Carlos', 'carlos@mail.com', 'clave123', 'admin'),
('Maria', 'maria@mail.com', 'clave456', 'vendedor'),
('Jorge', 'jorge@mail.com', 'clave789', 'vendedor');

INSERT INTO productos (nombre, precioUnitario, categoria, stock) VALUES
('Cuaderno Universitario', 2.50, 'Cuadernos', 80),
('Lapiz HB', 0.35, 'Escritura', 200),
('Esfero Azul', 0.60, 'Escritura', 150),
('Borrador Blanco', 0.40, 'Utiles', 120),
('Regla 30cm', 1.20, 'Geometria', 60),
('Resaltador Amarillo', 0.90, 'Escritura', 90),
('Carpeta Plastica', 1.50, 'Organizacion', 70),
('Marcador Permanente', 1.10, 'Escritura', 50);

INSERT INTO ventas (productoId, cantidad, precioUnitario, total) VALUES
(1, 3, 2.50, 7.50),
(2, 10, 0.35, 3.50),
(5, 2, 1.20, 2.40);
