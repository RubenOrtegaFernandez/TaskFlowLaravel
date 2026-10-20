-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 20-10-2026 a les 08:51:02
-- Versió del servidor: 8.0.46-0ubuntu0.24.04.4
-- Versió de PHP: 8.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `taskflow`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `departaments`
--

CREATE TABLE `departaments` (
  `id_dep` bigint UNSIGNED NOT NULL,
  `nom` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `departaments`
--

INSERT INTO `departaments` (`id_dep`, `nom`) VALUES
(1, 'Informática'),
(2, 'Administración'),
(3, 'Recursos Humanos'),
(4, 'Marketing');

-- --------------------------------------------------------

--
-- Estructura de la taula `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_departaments_table', 1),
(2, '0001_01_01_000002_create_usuaris_table', 1),
(3, '0001_01_01_000003_create_tasques_table', 1),
(4, '0001_01_01_000004_afegir_remember_token_a_usuaris', 2),
(5, '0001_01_01_000005_create_password_reset_tokens_table', 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `tasques`
--

CREATE TABLE `tasques` (
  `id_tas` bigint UNSIGNED NOT NULL,
  `estat` enum('pendent','en_curs','fet','revisat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendent',
  `nom_tas` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_inici` timestamp NOT NULL,
  `data_final` timestamp NULL DEFAULT NULL,
  `prioritat` enum('baixa','mitja','alta','urgent') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_usr_creador` bigint UNSIGNED DEFAULT NULL,
  `id_dep_assignat` bigint UNSIGNED DEFAULT NULL,
  `id_usr_assignat` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `tasques`
--

INSERT INTO `tasques` (`id_tas`, `estat`, `nom_tas`, `descripcio`, `data_inici`, `data_final`, `prioritat`, `categoria`, `id_usr_creador`, `id_dep_assignat`, `id_usr_assignat`) VALUES
(1, 'fet', 'Revisar servidor', 'Comprovar l\'estat del servidor principal.', '2026-10-14 07:00:00', '2026-10-20 16:00:00', 'urgent', 'General', 1, 1, 4),
(2, 'en_curs', 'Actualitzar web', 'Posar al dia el contingut de la pàgina web.', '2026-10-10 07:00:00', '2026-10-25 17:00:00', 'alta', 'Desenvolupament', 2, 1, 4),
(3, 'fet', 'Preparar factures', 'Revisar i enviar les factures del mes.', '2026-10-01 07:00:00', '2026-10-12 16:00:00', 'mitja', 'Administració', 3, 2, NULL),
(4, 'revisat', 'Copia de seguretat', 'Fer la còpia de seguretat setmanal.', '2026-09-28 07:00:00', '2026-09-30 16:00:00', 'baixa', 'General', 1, 1, NULL),
(5, 'pendent', 'Prueba', 'ndiwndi', '2026-10-26 23:00:00', '2026-10-30 23:00:00', 'mitja', 'Desenvolupament', 1, 1, 4),
(6, 'pendent', 'Prueba 2', 'Esto es una prueba para ver si conecta con la BD', '2026-10-29 23:00:00', '2026-11-03 23:00:00', 'alta', 'Disseny', 1, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuaris`
--

CREATE TABLE `usuaris` (
  `id_correu` bigint UNSIGNED NOT NULL,
  `nom_usu` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_tipus` enum('admin','cap','client') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `foto_perfil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/default.png',
  `contrasenya` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dep` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `usuaris`
--

INSERT INTO `usuaris` (`id_correu`, `nom_usu`, `correu`, `rol_tipus`, `foto_perfil`, `contrasenya`, `id_dep`, `remember_token`) VALUES
(1, 'Administrador', 'admin@taskflow.com', 'admin', 'img/default.png', '$2y$12$64auZIl5kcsrQpaNiNiOe.scJz3fgJV0URTqOZMvrYN12NPoZNqiq', 1, 'CPjGthubAiAYvE2J1QONZ2Z1pwwUvgbtqtthVMHn4cjpmozfUUSca6aArtfh'),
(2, 'Juan', 'juan@taskflow.com', 'cap', 'img/default.png', '$2y$12$Aw3oqHSxuaD3VRtxVYFW8e2G3LLFHWOweQPFNhuAm.qBNTRV0c/GS', 1, NULL),
(3, 'Maria', 'maria@taskflow.com', 'cap', 'img/default.png', '$2y$12$8a4fsU9v2C6qYJ4JeTogUOmblmkzyyxaq1Do904N2OntOeY0p3Kia', 2, NULL),
(4, 'Pedro', 'pedro@taskflow.com', 'client', 'img/default.png', '$2y$12$IqOXQ/pY.vHfnmrcta2PheMn3lVipri/qVFIwZIzODfFcjrp/5ciG', 1, NULL);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `departaments`
--
ALTER TABLE `departaments`
  ADD PRIMARY KEY (`id_dep`);

--
-- Índexs per a la taula `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índexs per a la taula `tasques`
--
ALTER TABLE `tasques`
  ADD PRIMARY KEY (`id_tas`),
  ADD KEY `tasques_id_usr_creador_foreign` (`id_usr_creador`),
  ADD KEY `tasques_id_dep_assignat_foreign` (`id_dep_assignat`),
  ADD KEY `tasques_id_usr_assignat_foreign` (`id_usr_assignat`);

--
-- Índexs per a la taula `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id_correu`),
  ADD UNIQUE KEY `usuaris_correu_unique` (`correu`),
  ADD KEY `usuaris_id_dep_foreign` (`id_dep`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `departaments`
--
ALTER TABLE `departaments`
  MODIFY `id_dep` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la taula `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `tasques`
--
ALTER TABLE `tasques`
  MODIFY `id_tas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la taula `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id_correu` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `tasques`
--
ALTER TABLE `tasques`
  ADD CONSTRAINT `tasques_id_dep_assignat_foreign` FOREIGN KEY (`id_dep_assignat`) REFERENCES `departaments` (`id_dep`),
  ADD CONSTRAINT `tasques_id_usr_assignat_foreign` FOREIGN KEY (`id_usr_assignat`) REFERENCES `usuaris` (`id_correu`),
  ADD CONSTRAINT `tasques_id_usr_creador_foreign` FOREIGN KEY (`id_usr_creador`) REFERENCES `usuaris` (`id_correu`);

--
-- Restriccions per a la taula `usuaris`
--
ALTER TABLE `usuaris`
  ADD CONSTRAINT `usuaris_id_dep_foreign` FOREIGN KEY (`id_dep`) REFERENCES `departaments` (`id_dep`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
