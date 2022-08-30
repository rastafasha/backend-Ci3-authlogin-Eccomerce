-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 28, 2022 at 07:43 PM
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `category_id`, `title`, `description`, `video_review`, `img`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'prueba Postman', 'test', '1234', 'a29a9693-a3a3-4a39-8749-df73f03aa35f.jpg', 1, 1, '2022-08-25 15:47:24', '2022-08-24 15:57:17'),
(2, 1, 2, 'prueba Postman2', 'test', '1234', 'IMG_4941.jpg', 1, 0, '2022-08-27 17:39:48', '2022-08-24 16:05:15'),
(3, 1, 1, 'prueba db', 'test', '1234', 'a29a9693-a3a3-4a39-8749-df73f03aa35f.jpg', 1, 1, '2022-08-25 19:47:24', '2022-08-24 19:57:17'),
(4, 1, 2, 'prueba db2', 'test', '1234', '9a6c7b53-2356-42a2-bfe8-64865957e707.jpg', 1, 1, '2022-08-27 18:43:27', '2022-08-24 20:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'productos', '2022-08-27 17:13:26', '2022-08-24 15:46:59'),
(2, 'cursos', '2022-08-27 17:13:32', '2022-08-24 15:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `configuracions`
--

CREATE TABLE `configuracions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `direccion` text NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `cr` varchar(255) NOT NULL,
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

--
-- Dumping data for table `configuracions`
--

INSERT INTO `configuracions` (`id`, `user_id`, `direccion`, `titulo`, `cr`, `telefono_uno`, `telefono_dos`, `email_uno`, `email_dos`, `horarios`, `iframe_mapa`, `facebook`, `instagram`, `youtube`, `language`, `twitter`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', 'My Store', 'copy right', '1234', '456', 'test', 'test', 'test', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.878891988215!2d-66.85781458552528!3d10.431184068324201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2af7cab47b2545%3A0x633eed20b60e339e!2sCentro%20M%C3%A9dico%20Docente%20La%20Trinidad!5e0!3m2!1ses!2sve!4v1576009967450!5m2!1ses!2sve', 'testFace', 'testInst', 'testyou', 'es', 'testtwitt', 'IMG_3338.JPG', 'logo-06.png', '2022-08-27 21:29:57', '2022-08-24 16:07:47');

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
  `is_featured` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `user_id`, `category_id`, `img`, `name`, `price`, `video_review`, `info_short`, `description`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'IMG_4941.jpg', 'ActualizadoPostman', '20.00', 'test', 'test', 'description', 1, 0, '2022-08-28 01:12:09', '2022-08-24 16:00:04'),
(2, 1, 2, '9a6c7b53-2356-42a2-bfe8-64865957e707.jpg', 'ActualizadoPostman', '20.00', 'test', 'test', 'description', 1, 0, '2022-08-28 01:12:13', '2022-08-24 16:00:15');

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

--
-- Dumping data for table `galerias`
--

INSERT INTO `galerias` (`id`, `user_id`, `category_id`, `img`, `titulo`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '697686c9-b783-491c-9aa5-5162fa17eefd.jpg', 'prueba', '2022-08-24 21:22:16', '2022-08-24 17:22:16'),
(2, 1, 1, 'a29a9693-a3a3-4a39-8749-df73f03aa35f.jpg', 'prueba', '2022-08-27 21:23:00', '2022-08-24 21:22:16'),
(3, 1, 1, 'IMG_3337.JPG', 'prueba', '2022-08-27 21:24:12', '2022-08-24 21:22:16'),
(4, 1, 1, '697686c9-b783-491c-9aa5-5162fa17eefd.jpg', 'prueba', '2022-08-25 01:22:16', '2022-08-24 21:22:16'),
(5, 1, 1, '697686c9-b783-491c-9aa5-5162fa17eefd.jpg', 'prueba', '2022-08-25 01:22:16', '2022-08-24 21:22:16'),
(6, 1, 1, '697686c9-b783-491c-9aa5-5162fa17eefd.jpg', 'prueba', '2022-08-25 01:22:16', '2022-08-24 21:22:16');

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
  `is_active` tinyint(1) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `user_id`, `category_id`, `img`, `title`, `description`, `video_review`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '697686c9-b783-491c-9aa5-5162fa17eefd.jpg', 'About', 'esto es una prueba', 'test', NULL, 1, '2022-08-27 17:17:18', '2022-08-24 16:01:10'),
(2, 2, 1, NULL, 'pruebaww', 'esto es una prueba', 'test', NULL, 1, '2022-08-24 20:01:21', '2022-08-24 16:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `video_review` varchar(255) NOT NULL,
  `info_short` varchar(255) NOT NULL,
  `description` text,
  `is_featured` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `user_id`, `category_id`, `img`, `name`, `price`, `video_review`, `info_short`, `description`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'a29a9693-a3a3-4a39-8749-df73f03aa35f.jpg', 'Producto 1', '20.00', 'test', 'test', 'esto es una prueba', 1, 1, '2022-08-25 16:25:55', '2022-08-24 20:36:09'),
(2, 1, 1, 'IMG_3326.JPG', 'Producto 2', '20.00', 'test', 'test', 'esto es una prueba', 1, 1, '2022-08-27 21:24:54', '2022-08-24 16:36:09'),
(3, 1, 1, 'IMG_3946.jpg', 'Producto 3', '20.00', 'test', 'test', 'esto es una prueba', 1, 1, '2022-08-24 23:50:06', '2022-08-24 16:36:56'),
(4, 1, 1, 'IMG_3946.jpg', 'Producto 4', '20.00', 'test', 'test', 'esto es una prueba', 1, 1, '2022-08-25 16:26:01', '2022-08-24 20:36:56'),
(5, 1, 1, 'a29a9693-a3a3-4a39-8749-df73f03aa35f.jpg', 'Producto 5', '20.00', 'test', 'test', 'esto es una prueba', 1, 1, '2022-08-25 16:26:04', '2022-08-24 20:36:09'),
(6, 1, 1, 'IMG_3946.jpg', 'Producto 6', '20.00', 'test', 'test', 'esto es una prueba', 1, 1, '2022-08-25 16:26:07', '2022-08-24 20:36:56');

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
  `boton` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `subtitulo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promocions`
--

INSERT INTO `promocions` (`id`, `producto_title`, `user_id`, `description`, `img`, `is_active`, `is_activeText`, `is_activeBot`, `first_title`, `enlace`, `boton`, `target`, `subtitulo`, `created_at`, `updated_at`) VALUES
(1, 'pruebaActualizado', 2, 'esto es una prueba', 'IMG_33262.JPG', 0, 'visible', 'visible', 'test', 'test', 'test', '_blank', 'tsttsss', '2022-08-24 16:11:39', '2022-08-24 16:03:08'),
(2, 'prueba2', 1, 'esto es una prueba', 'IMG_33263.JPG', 1, 'visible', 'novisible', 'test', 'test', 'test', '_self', 'tsttsss', '2022-08-24 16:03:53', '2022-08-24 16:03:53');

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
(1, 'ADMIN', '1', '2022-08-21 07:59:53', '2022-08-21 07:59:53'),
(2, 'USER', '1', '2022-08-21 07:59:53', '2022-08-21 07:59:53'),
(3, 'Ventas', '1', '2022-08-21 07:59:53', '2022-08-21 07:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` text,
  `user_id` int(11) NOT NULL,
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

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `user_id`, `description`, `img`, `is_active`, `is_activeText`, `is_activeBot`, `boton`, `enlace`, `target`, `created_at`, `updated_at`) VALUES
(1, 'creadoAct211', 1, 'prueba', '56c18653-a0c0-4121-ab1e-149a84b53d72.jpg', 1, '1', 'visible', 'test', 'test', '_blank', '2022-08-24 17:23:10', '2022-08-24 21:23:10'),
(2, 'creadoAct211', 1, 'prueba', '9a6c7b53-2356-42a2-bfe8-64865957e707.jpg', 1, '1', 'visible', 'test', 'test', '_blank', '2022-08-24 17:23:29', '2022-08-24 21:23:29'),
(3, 'creadoAct211', 1, 'prueba', 'IMG_4941.jpg', 1, '1', 'visible', 'test', 'test', '_blank', '2022-08-24 17:23:55', '2022-08-24 21:23:55');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `google`, `password`, `role_id`, `username`, `img`, `created_at`, `updated_at`) VALUES
(1, 'prueba', 'postman', 'prueba@prueba.com', '', '12345', 1, 'prueba ac', 'IMG_39463.jpg', '2022-08-24 17:29:47', '2022-08-24 15:54:21'),
(2, 'prueba', 'postman', 'pruebauser@prueba.com', '', '12345', 2, 'prueba ac', 'IMG_39465.jpg', '2022-08-24 17:32:35', '2022-08-24 15:54:35'),
(3, 'prueba', 'postman', 'pruebaventas@prueba.com', '', '12345', 3, 'prueba ac', '10982416_782793918440642_3183658290050116652_n2.jpg', '2022-08-24 17:31:54', '2022-08-24 15:54:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `galerias`
--
ALTER TABLE `galerias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `galeryproducts`
--
ALTER TABLE `galeryproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `promocions`
--
ALTER TABLE `promocions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `galerias`
--
ALTER TABLE `galerias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `galeryproducts`
--
ALTER TABLE `galeryproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promocions`
--
ALTER TABLE `promocions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `configuracions`
--
ALTER TABLE `configuracions`
  ADD CONSTRAINT `configuracions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `galerias`
--
ALTER TABLE `galerias`
  ADD CONSTRAINT `galerias_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `galerias_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `galeryproducts`
--
ALTER TABLE `galeryproducts`
  ADD CONSTRAINT `galeryproducts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `galeryproducts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pages_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `promocions`
--
ALTER TABLE `promocions`
  ADD CONSTRAINT `promocions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
