-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-10-2025 a las 14:10:47
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora_llegada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `total_horas` double(8,2) DEFAULT NULL,
  `observacion` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras_tecnicas`
--

CREATE TABLE `carreras_tecnicas` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `familia` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `codigo` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `estado` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros_trabajos`
--

CREATE TABLE `centros_trabajos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `rnc` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `area` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `responsable` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `correo` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `whatsApp` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `estado` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_educativo`
--

CREATE TABLE `centro_educativo` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `codigo` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `correo` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `whatsApp` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellidos` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cedula` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `correo` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `usuario` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `contrasena` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `rol` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `direccion` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `whatsApp` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `centroEducativo_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` bigint UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `responsable` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(73, '2014_10_12_100000_create_password_resets_table', 1),
(74, '2019_08_19_000000_create_failed_jobs_table', 1),
(75, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(76, '2025_10_22_120407_create_centro_educativo_table', 1),
(77, '2025_10_22_121305_create_estudiantes_table', 1),
(78, '2025_10_29_112122_create_centros_trabajos_table', 1),
(79, '2025_10_30_112502_create_carreras_tecnicas_table', 1),
(80, '2025_10_30_122503_create_usuarios_table', 1),
(81, '2025_10_30_135322_create_asistencias_table', 1),
(82, '2025_10_30_140003_create_incidencias_table', 1),
(83, '2025_10_30_140455_create_seguimientos_mensuales_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos_mensuales`
--

CREATE TABLE `seguimientos_mensuales` (
  `id` bigint UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `actividades` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tiempo` int NOT NULL,
  `observaciones` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `usuario_id` bigint UNSIGNED NOT NULL,
  `responsable` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `contrasena` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `usuario` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `apellidos` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cedula` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `carrera_tecnica_id` bigint UNSIGNED DEFAULT NULL,
  `tutor` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `centro_de_trabajo_id` bigint UNSIGNED DEFAULT NULL,
  `centro_educativo_id` bigint UNSIGNED DEFAULT NULL,
  `estado` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistencias_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `carreras_tecnicas`
--
ALTER TABLE `carreras_tecnicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centros_trabajos`
--
ALTER TABLE `centros_trabajos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centro_educativo`
--
ALTER TABLE `centro_educativo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiantes_centroeducativo_id_foreign` (`centroEducativo_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidencias_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `seguimientos_mensuales`
--
ALTER TABLE `seguimientos_mensuales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seguimientos_mensuales_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_carrera_tecnica_id_foreign` (`carrera_tecnica_id`),
  ADD KEY `usuarios_centro_de_trabajo_id_foreign` (`centro_de_trabajo_id`),
  ADD KEY `usuarios_centro_educativo_id_foreign` (`centro_educativo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carreras_tecnicas`
--
ALTER TABLE `carreras_tecnicas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centros_trabajos`
--
ALTER TABLE `centros_trabajos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro_educativo`
--
ALTER TABLE `centro_educativo`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguimientos_mensuales`
--
ALTER TABLE `seguimientos_mensuales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_centroeducativo_id_foreign` FOREIGN KEY (`centroEducativo_id`) REFERENCES `centro_educativo` (`id`);

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `seguimientos_mensuales`
--
ALTER TABLE `seguimientos_mensuales`
  ADD CONSTRAINT `seguimientos_mensuales_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_carrera_tecnica_id_foreign` FOREIGN KEY (`carrera_tecnica_id`) REFERENCES `carreras_tecnicas` (`id`),
  ADD CONSTRAINT `usuarios_centro_de_trabajo_id_foreign` FOREIGN KEY (`centro_de_trabajo_id`) REFERENCES `centros_trabajos` (`id`),
  ADD CONSTRAINT `usuarios_centro_educativo_id_foreign` FOREIGN KEY (`centro_educativo_id`) REFERENCES `centro_educativo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
