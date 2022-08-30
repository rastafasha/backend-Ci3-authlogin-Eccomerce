-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 20, 2022 at 04:28 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `api_rest_ursi`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `video_review` text,
  `img` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `configuracions`
--

CREATE TABLE `configuracions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `telefono_uno` varchar(255) NOT NULL,
  `telefono_dos` varchar(255) NOT NULL,
  `email_uno` varchar(255) NOT NULL,
  `email_dos` varchar(255) NOT NULL,
  `horarios` text NOT NULL,
  `iframe_mapa` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `twitter` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text,
  `tema` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `video_review` varchar(255) NOT NULL,
  `info_short` varchar(255) NOT NULL,
  `description` text,
  `subcategory` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `galerias`
--

CREATE TABLE `galerias` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `galeryproducts`
--

CREATE TABLE `galeryproducts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca_name` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `video_review` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `video_review` varchar(255) NOT NULL,
  `info_short` varchar(255) NOT NULL,
  `description` text,
  `subcategory` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `promocions`
--

CREATE TABLE `promocions` (
  `id` int(11) NOT NULL,
  `producto_title` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `description` text,
  `img` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_activeText` varchar(255) NOT NULL,
  `is_activeBot` varchar(255) NOT NULL,
  `first_title` text NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `subtitulo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', '1', '2022-08-21 03:59:53', '2022-08-21 03:59:53'),
(2, 'USER', '1', '2022-08-21 03:59:53', '2022-08-21 03:59:53');
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int PRIMARY key AUTO_INCREMENT,
  `title` text,
  `user_id` int NOT NULL,
  `description` text,
  `img` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_activeText` varchar(255) NOT NULL,
  `is_activeBot` varchar(255) NOT NULL,
  `boton` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `carritos`
--

CREATE TABLE `carritos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `productPrice` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `productCode` varchar(255) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `productName` text NOT NULL,
  `quantity` text NOT NULL,
  `description` text NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_pagado` varchar(255) DEFAULT NULL,
  `info_cupon` varchar(255) DEFAULT NULL,
  `metodo_pago` varchar(255) DEFAULT NULL,
  `precio_envio` varchar(255) DEFAULT NULL,
  `tipo_envio` varchar(255) DEFAULT NULL,
  `tiempo_estimado` varchar(255) DEFAULT NULL,
  `direccion` text NOT NULL,
  `referencia` text NOT NULL,
  `destinatario` text NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `idtransaccion` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `direccions`
--

CREATE TABLE `direccions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `direccion` text NOT NULL,
  `referencia` text NOT NULL,
  `telefono` text NOT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `descuento` varchar(255) DEFAULT NULL,
  `codigo` text NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------


--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `pros` text NOT NULL,
  `cons` text NOT NULL,
  `estrellas` varchar(11) DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  FOREIGN KEY (producto_id) REFERENCES productos(id) ON UPDATE CASCADE,
  FOREIGN KEY (curso_id) REFERENCES cursos(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `likescomments`
--

CREATE TABLE `likescomments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  FOREIGN KEY (comentario_id) REFERENCES comentarios(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;


-- --------------------------------------------------------

--
-- Table structure for table `dislikescomments`
--

CREATE TABLE `dislikescomments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  FOREIGN KEY (comentario_id) REFERENCES comentarios(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `cancelacions`
--

CREATE TABLE `cancelacions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `pros` text NOT NULL,
  `cons` text NOT NULL,
  `estrellas` varchar(11) DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  FOREIGN KEY (venta_id) REFERENCES ventas(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;


-- --------------------------------------------------------

--
-- Table structure for table `videocursos`
--

CREATE TABLE `videocursos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `estado` varchar(11) DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  FOREIGN KEY (curso_id) REFERENCES cursos(id) ON UPDATE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SHOW TABLES;

-- --------------------------------------------------------
