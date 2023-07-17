-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 17 juil. 2023 à 16:40
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test_poke`
--

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
CREATE TABLE IF NOT EXISTS `pokemon` (
  `id` int(3) UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL,
  `nom_fr` varchar(32) NOT NULL,
  `type1` varchar(15) NOT NULL,
  `type2` varchar(15) DEFAULT NULL,
  `total` int(3) DEFAULT NULL,
  `hp` int(3) DEFAULT NULL,
  `attack` int(3) DEFAULT NULL,
  `defense` int(3) DEFAULT NULL,
  `sp_atk` int(3) DEFAULT NULL,
  `sp_def` int(3) DEFAULT NULL,
  `speed` int(3) DEFAULT NULL,
  `generation` int(2) DEFAULT NULL,
  `legendary` tinyint(1) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
