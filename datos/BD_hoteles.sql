create database tfg_hoteles;
use tfg_hoteles;

CREATE TABLE clientes (
  DNI_cliente VARCHAR(9) PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  usuario VARCHAR(50) NOT NULL unique,
  contraseña VARCHAR(10) NOT NULL,
  email VARCHAR(50) NOT NULL unique,
  telefono VARCHAR(15) NOT NULL unique,
  direccion VARCHAR(100)
);

CREATE TABLE gerentes (
  DNI_gerente VARCHAR(9) PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  email VARCHAR(50) NOT NULL,
  telefono VARCHAR(15) NOT NULL,
  direccion VARCHAR(100)
);

CREATE TABLE hoteles (
  id_hotel INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  direccion VARCHAR(100) NOT NULL,
  ciudad VARCHAR(50) NOT NULL,
  pais VARCHAR(50) NOT NULL,
  categoria ENUM('1 estrella', '2 estrellas', '3 estrellas', '4 estrellas', '5 estrellas') NOT NULL,
  numHabitaciones int not null,
  imagen longblob
);

CREATE TABLE habitaciones (
  id_habitacion INT PRIMARY KEY AUTO_INCREMENT,
  tipo ENUM('individual', 'doble', 'triple') NOT NULL,
  precioNoche DECIMAL(6,2) NOT NULL,
  numHabitacion int not null,
  id_hotel INT NOT NULL,
  imagen longblob,
  FOREIGN KEY (id_hotel) REFERENCES hoteles(id_hotel)
);

CREATE TABLE PETICIONES(
	id_peticion INT PRIMARY KEY AUTO_INCREMENT,
    fecha_peticion DATE NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    DNI_cliente VARCHAR(9) NOT NULL,
    id_habitacion int not null,
    foreign key (dni_cliente) references clientes(dni_cliente),
    foreign key (id_habitacion) references habitaciones(id_habitacion)
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

select * from clientes;
SELECT id_hotel, nombre, direccion, ciudad, pais, categoria, numHabitaciones, IF(imagen IS NOT NULL, 'Imagen insertada', 'Imagen no insertada') AS estado_imagen
FROM hoteles;

-- Inserciones de los hoteles
INSERT INTO hoteles (nombre, direccion, ciudad, pais, categoria, numHabitaciones, imagen) VALUES
('Hotel A', 'Calle Principal 123', 'Ciudad A', 'España', 4, 100, LOAD_FILE('\Imagenes\hotelValencia.jpg')),
('Hotel B', 'Avenida Central 456', 'Ciudad B', 'España', 3, 80, LOAD_FILE('C:\xampp\htdocs\TFG-SistemaReservasDeHotel\Imagenes\HotelCantabrico.jpg')),
('Hotel C', 'Paseo del Mar 789', 'Ciudad C', 'España', 5, 150, LOAD_FILE('C:\xampp\htdocs\TFG-SistemaReservasDeHotel\Imagenes\HotelMediterraneo.jpg'));

