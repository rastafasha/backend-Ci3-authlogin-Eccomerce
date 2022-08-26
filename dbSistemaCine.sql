-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 06, 2022 at 12:39 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `SistemaReservacionesCine`
--

-- --------------------------------------------------------

--
-- Table structure for table `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `dur_min` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SHOW TABLES;


--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `nombre` varchar(45),
  `apelllido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SHOW TABLES;


--
-- Table structure for table `salas`
--

CREATE TABLE `salas` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `nombre` varchar(45),
  `n_asientos` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SHOW TABLES;


--
-- Table structure for table `funciones`
--

CREATE TABLE `funciones` (
  `id` int PRIMARY key NOT NULL,
  `id_pelicula` int NOT NULL,
  `id_sala` int NOT NULL,
  `hora_inicio` DATETIME NOT NULL,
  FOREIGN KEY (id_pelicula) REFERENCES peliculas(id),
  FOREIGN KEY (id_sala) REFERENCES salas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SHOW TABLES;


--
-- Table structure for table `asientos`
--

CREATE TABLE `asientos` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `fila` CHAR(1) NOT NULL,
  `numero` int NOT NULL,
  `id_sala` int NOT NULL,
  FOREIGN KEY (id_sala) REFERENCES salas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SHOW TABLES;


--
-- Table structure for table `reservaciones`
--

CREATE TABLE `reservaciones` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `id_funcion` int NOT NULL,
  `id_cliente` int NOT NULL,
  FOREIGN KEY (id_funcion) REFERENCES funciones(id),
  FOREIGN KEY (id_cliente) REFERENCES clientes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SHOW TABLES;


--
-- Table structure for table `asientosReservados`
--

CREATE TABLE `asientosReservados` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `id_reservacion` int NOT NULL,
  `id_asiento` int NOT NULL,
  FOREIGN KEY (id_reservacion) REFERENCES reservaciones(id),
  FOREIGN KEY (id_asiento) REFERENCES asientos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SHOW TABLES;
