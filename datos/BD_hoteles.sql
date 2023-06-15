create database tfg_hoteles;
use tfg_hoteles;

CREATE TABLE clientes (
  DNI_cliente VARCHAR(9) PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(50) NOT NULL,
  usuario VARCHAR(50) NOT NULL unique,
  contraseña VARCHAR(10) NOT NULL unique,
  email VARCHAR(50) NOT NULL unique,
  telefono VARCHAR(20) NOT NULL unique,
  direccion VARCHAR(100)
);


CREATE TABLE hoteles (
  id_hotel INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  direccion TEXT NOT NULL,
  ciudad VARCHAR(50) NOT NULL,
  pais VARCHAR(50) NOT NULL,
  categoria ENUM('1 estrella', '2 estrellas', '3 estrellas', '4 estrellas', '5 estrellas') NOT NULL,
  email VARCHAR(50) NOT NULL,
  telefono VARCHAR(20) NOT NULL,
  imagen longblob
);

CREATE TABLE habitaciones (
  id_habitacion INT PRIMARY KEY AUTO_INCREMENT,
  tipo TEXT NOT NULL,
  precioNoche DECIMAL(6,2) NOT NULL,
  descripcion TEXT NOT NULL,
  id_hotel INT NOT NULL,
  imagen longblob,
  FOREIGN KEY (id_hotel) REFERENCES hoteles(id_hotel)
);


CREATE TABLE reservas (
  id_reserva INT PRIMARY KEY AUTO_INCREMENT,
  fecha_entrada DATE NOT NULL,
  fecha_Salida DATE NOT NULL,
  precioTotal double not null,
  estado VARCHAR(50) NOT NULL,
  DNI_cliente VARCHAR(9) NOT NULL,
  id_habitacion INT NOT NULL,
  FOREIGN KEY (DNI_cliente) REFERENCES clientes(DNI_cliente),
  FOREIGN KEY (id_habitacion) REFERENCES habitaciones(id_habitacion)
);




