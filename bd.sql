DROP DATABASE IF EXISTS daniel;
CREATE DATABASE daniel;
USE daniel;

DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	modelo_view INT DEFAULT 0,
	PRIMARY KEY (id)
);

INSERT INTO roles (id,nombre) VALUES (1,'admin');
ALTER TABLE roles CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS sedes;
CREATE TABLE sedes (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	ciudad VARCHAR(250) NOT NULL,
	responsable VARCHAR(250) NOT NULL,
	cedula VARCHAR(250) NOT NULL,
	rut VARCHAR(250) NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE sedes CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;


DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
	id INT AUTO_INCREMENT,
	usuario VARCHAR(250) NOT NULL,
	clave VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	rol INT NOT NULL,
	sede INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO usuarios (usuario,clave,correo,rol,sede,fecha_inicio) VALUES 
('Admin','0192023a7bbd73250516f069df18b500','juanmaldonado.co@gmail.com',1,1,'2020-10-13');
ALTER TABLE usuarios CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias (
	id INT AUTO_INCREMENT,
	nombre VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE categorias CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO categorias (nombre,fecha_inicio) VALUES 
('Sin categoria','2020-10-13'),
('Camisas','2020-10-13');

DROP TABLE IF EXISTS productos;
CREATE TABLE productos (
	id INT AUTO_INCREMENT,
	descripcion VARCHAR(250) NOT NULL,
	cantidad INT NOT NULL,
	precio INT NOT NULL,
	imagen VARCHAR(250) NOT NULL,
	categoria INT NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE productos CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO productos (descripcion,cantidad,precio,imagen,categoria,fecha_inicio) VALUES
('Test',20,400000,'default.jpg',1,'2020-10-13');

DROP TABLE IF EXISTS servicios;
CREATE TABLE servicios (
	id INT AUTO_INCREMENT,
	tipo VARCHAR(250) NOT NULL,
	producto VARCHAR(250) NOT NULL,
	marca VARCHAR(250) NOT NULL,
	modelo VARCHAR(250) NOT NULL,
	falla VARCHAR(250) NOT NULL,
	observaciones VARCHAR(250) NOT NULL,
	abono INT NOT NULL,
	valor_reparacion INT NOT NULL,
	valor_revision INT NOT NULL,
	pago_reparacion VARCHAR(250) NOT NULL,
	pago_revision VARCHAR(250) NOT NULL,
	estado_reparacion VARCHAR(250) NOT NULL,
	diagnostico VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	id_usuario INT NOT NULL,
	id_cliente INT NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE servicios CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes (
	id INT AUTO_INCREMENT,
	tipo_identificacion VARCHAR(250) NOT NULL,
	numero_identificacion VARCHAR(250) NOT NULL,
	direccion VARCHAR(250) NOT NULL,
	nombre VARCHAR(250) NOT NULL,
	telefono VARCHAR(250) NOT NULL,
	ciudad VARCHAR(250) NOT NULL,
	correo VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE clientes CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS facturacion;
CREATE TABLE facturacion (
	id INT AUTO_INCREMENT,
	id_servicio VARCHAR(250) NOT NULL,
	fecha_inicio date NOT NULL,
	PRIMARY KEY (id)
); ALTER TABLE facturacion CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;