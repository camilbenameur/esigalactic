-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 04 juin 2023 à 10:24
-- Version du serveur : 10.10.2-MariaDB
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `esigalactic`
--

-- --------------------------------------------------------

--
-- Structure de la table `bonus`
--

DROP TABLE IF EXISTS `bonus`;
CREATE TABLE IF NOT EXISTS `bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bonus_value` int(11) NOT NULL,
  `planet_position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `galaxy`
--

DROP TABLE IF EXISTS `galaxy`;
CREATE TABLE IF NOT EXISTS `galaxy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `universe_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `universe_id` (`universe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `galaxy`
--

INSERT INTO `galaxy` (`id`, `name`, `universe_id`) VALUES
(1, 'Galaxy 1', 1),
(2, 'Galaxy 2', 1),
(3, 'Galaxy 3', 1),
(4, 'Galaxy 4', 1),
(5, 'Galaxy 5', 1),
(6, 'Galaxy 1', 2),
(7, 'Galaxy 2', 2),
(8, 'Galaxy 3', 2),
(9, 'Galaxy 4', 2),
(10, 'Galaxy 5', 2),
(11, 'Galaxy 1', 3),
(12, 'Galaxy 2', 3),
(13, 'Galaxy 3', 3),
(14, 'Galaxy 4', 3),
(15, 'Galaxy 5', 3);

-- --------------------------------------------------------

--
-- Structure de la table `infrastructure`
--

DROP TABLE IF EXISTS `infrastructure`;
CREATE TABLE IF NOT EXISTS `infrastructure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planet_id` int(11) NOT NULL,
  `archetype_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `planet_id` (`planet_id`),
  KEY `archetype_id` (`archetype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `infrastructure`
--

INSERT INTO `infrastructure` (`id`, `planet_id`, `archetype_id`, `level`) VALUES
(1, 1, 1, 6),
(2, 1, 3, 2),
(3, 1, 5, 5),
(4, 1, 6, 2),
(6, 1, 2, 4),
(8, 2, 4, 5),
(9, 1, 4, 2),
(10, 369, 4, 3),
(11, 369, 5, 1),
(12, 369, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `infrastructure_archetype`
--

DROP TABLE IF EXISTS `infrastructure_archetype`;
CREATE TABLE IF NOT EXISTS `infrastructure_archetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `building_time` int(11) NOT NULL,
  `energy_cost` int(11) NOT NULL,
  `metal_cost` int(11) NOT NULL,
  `deuterium_cost` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `defence_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_id` (`resource_id`),
  KEY `defence_id` (`defence_id`),
  KEY `facility_id` (`facility_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `infrastructure_archetype`
--

INSERT INTO `infrastructure_archetype` (`id`, `name`, `building_time`, `energy_cost`, `metal_cost`, `deuterium_cost`, `resource_id`, `defence_id`, `facility_id`) VALUES
(1, 'Research lab', 50, 500, 1000, 0, 0, 0, 1),
(2, 'Shipyard', 50, 500, 500, 0, 0, 0, 2),
(3, 'Nanite factory', 600, 5000, 10000, 0, 0, 0, 3),
(4, 'Metal mine', 10, 10, 100, 0, 1, 0, 0),
(5, 'Deuterium synthesizer', 25, 50, 200, 0, 2, 0, 0),
(6, 'Solar plant', 10, 0, 150, 20, 3, 0, 0),
(7, 'Fusion plant', 120, 2000, 5000, 2000, 4, 0, 0),
(8, 'Laser artillery', 10, 0, 1500, 300, 0, 1, 0),
(9, 'Ion cannon', 40, 0, 5000, 1000, 0, 2, 0),
(10, 'Shield', 60, 1000, 10000, 5000, 0, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `infrastructure_defence`
--

DROP TABLE IF EXISTS `infrastructure_defence`;
CREATE TABLE IF NOT EXISTS `infrastructure_defence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `defence_value` int(11) NOT NULL,
  `offence_value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `infrastructure_defence`
--

INSERT INTO `infrastructure_defence` (`id`, `defence_value`, `offence_value`) VALUES
(1, 25, 100),
(2, 200, 250),
(3, 2000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `infrastructure_facility`
--

DROP TABLE IF EXISTS `infrastructure_facility`;
CREATE TABLE IF NOT EXISTS `infrastructure_facility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `infrastructure_facility`
--

INSERT INTO `infrastructure_facility` (`id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Structure de la table `infrastructure_resources`
--

DROP TABLE IF EXISTS `infrastructure_resources`;
CREATE TABLE IF NOT EXISTS `infrastructure_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(55) NOT NULL,
  `resource_type` varchar(50) NOT NULL,
  `production_rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `infrastructure_resources`
--

INSERT INTO `infrastructure_resources` (`id`, `resource_name`, `resource_type`, `production_rate`) VALUES
(1, 'metal', '2', 3),
(2, 'deuterium', '3', 1),
(3, 'energy', '1', 20),
(4, 'energy', '1', 50);

-- --------------------------------------------------------

--
-- Structure de la table `planet`
--

DROP TABLE IF EXISTS `planet`;
CREATE TABLE IF NOT EXISTS `planet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `position` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `solar_system_id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solar_system_id` (`solar_system_id`),
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1051 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `planet`
--

INSERT INTO `planet` (`id`, `name`, `position`, `size`, `solar_system_id`, `player_id`) VALUES
(1, 'Planet 1', 1, 90, 1, 2),
(2, 'Planet 2', 4, 120, 1, 2),
(3, 'Planet 3', 5, 130, 1, NULL),
(4, 'Planet 4', 10, 80, 1, NULL),
(5, 'Planet 1', 1, 90, 2, NULL),
(6, 'Planet 2', 2, 100, 2, NULL),
(7, 'Planet 3', 4, 120, 2, NULL),
(8, 'Planet 4', 5, 130, 2, NULL),
(9, 'Planet 5', 6, 120, 2, NULL),
(10, 'Planet 6', 7, 110, 2, NULL),
(11, 'Planet 7', 8, 100, 2, NULL),
(12, 'Planet 8', 9, 90, 2, NULL),
(13, 'Planet 9', 10, 80, 2, NULL),
(14, 'Planet 1', 2, 100, 3, NULL),
(15, 'Planet 2', 4, 120, 3, NULL),
(16, 'Planet 3', 5, 130, 3, NULL),
(17, 'Planet 4', 6, 120, 3, NULL),
(18, 'Planet 5', 8, 100, 3, NULL),
(19, 'Planet 6', 9, 90, 3, NULL),
(20, 'Planet 7', 10, 80, 3, NULL),
(21, 'Planet 1', 2, 100, 4, NULL),
(22, 'Planet 2', 3, 110, 4, NULL),
(23, 'Planet 3', 4, 120, 4, NULL),
(24, 'Planet 4', 5, 130, 4, NULL),
(25, 'Planet 5', 6, 120, 4, NULL),
(26, 'Planet 6', 7, 110, 4, NULL),
(27, 'Planet 7', 8, 100, 4, NULL),
(28, 'Planet 8', 9, 90, 4, NULL),
(29, 'Planet 1', 3, 110, 5, NULL),
(30, 'Planet 2', 5, 130, 5, NULL),
(31, 'Planet 3', 8, 100, 5, NULL),
(32, 'Planet 4', 10, 80, 5, NULL),
(33, 'Planet 1', 2, 100, 6, NULL),
(34, 'Planet 2', 3, 110, 6, NULL),
(35, 'Planet 3', 4, 120, 6, NULL),
(36, 'Planet 4', 6, 120, 6, NULL),
(37, 'Planet 5', 7, 110, 6, NULL),
(38, 'Planet 6', 8, 100, 6, NULL),
(39, 'Planet 7', 9, 90, 6, NULL),
(40, 'Planet 8', 10, 80, 6, NULL),
(41, 'Planet 1', 1, 90, 7, NULL),
(42, 'Planet 2', 3, 110, 7, NULL),
(43, 'Planet 3', 4, 120, 7, NULL),
(44, 'Planet 4', 5, 130, 7, NULL),
(45, 'Planet 5', 6, 120, 7, NULL),
(46, 'Planet 6', 7, 110, 7, NULL),
(47, 'Planet 7', 9, 90, 7, NULL),
(48, 'Planet 8', 10, 80, 7, NULL),
(49, 'Planet 1', 3, 110, 8, NULL),
(50, 'Planet 2', 4, 120, 8, NULL),
(51, 'Planet 3', 5, 130, 8, NULL),
(52, 'Planet 4', 7, 110, 8, NULL),
(53, 'Planet 5', 8, 100, 8, NULL),
(54, 'Planet 1', 1, 90, 9, NULL),
(55, 'Planet 2', 2, 100, 9, NULL),
(56, 'Planet 3', 3, 110, 9, NULL),
(57, 'Planet 4', 4, 120, 9, NULL),
(58, 'Planet 5', 5, 130, 9, NULL),
(59, 'Planet 6', 6, 120, 9, NULL),
(60, 'Planet 7', 7, 110, 9, NULL),
(61, 'Planet 8', 8, 100, 9, NULL),
(62, 'Planet 9', 9, 90, 9, NULL),
(63, 'Planet 10', 10, 80, 9, NULL),
(64, 'Planet 1', 1, 90, 10, NULL),
(65, 'Planet 2', 2, 100, 10, NULL),
(66, 'Planet 3', 3, 110, 10, NULL),
(67, 'Planet 4', 4, 120, 10, NULL),
(68, 'Planet 5', 5, 130, 10, NULL),
(69, 'Planet 6', 6, 120, 10, NULL),
(70, 'Planet 7', 7, 110, 10, NULL),
(71, 'Planet 8', 8, 100, 10, NULL),
(72, 'Planet 9', 9, 90, 10, NULL),
(73, 'Planet 10', 10, 80, 10, NULL),
(74, 'Planet 1', 1, 90, 11, 2),
(75, 'Planet 2', 2, 100, 11, NULL),
(76, 'Planet 3', 3, 110, 11, NULL),
(77, 'Planet 4', 4, 120, 11, NULL),
(78, 'Planet 5', 5, 130, 11, NULL),
(79, 'Planet 6', 9, 90, 11, NULL),
(80, 'Planet 7', 10, 80, 11, NULL),
(81, 'Planet 1', 1, 90, 12, NULL),
(82, 'Planet 2', 2, 100, 12, NULL),
(83, 'Planet 3', 3, 110, 12, NULL),
(84, 'Planet 4', 4, 120, 12, NULL),
(85, 'Planet 5', 5, 130, 12, NULL),
(86, 'Planet 6', 6, 120, 12, NULL),
(87, 'Planet 7', 7, 110, 12, NULL),
(88, 'Planet 8', 8, 100, 12, NULL),
(89, 'Planet 9', 9, 90, 12, NULL),
(90, 'Planet 10', 10, 80, 12, NULL),
(91, 'Planet 1', 1, 90, 13, NULL),
(92, 'Planet 2', 2, 100, 13, NULL),
(93, 'Planet 3', 3, 110, 13, NULL),
(94, 'Planet 4', 4, 120, 13, NULL),
(95, 'Planet 5', 6, 120, 13, NULL),
(96, 'Planet 6', 7, 110, 13, NULL),
(97, 'Planet 7', 8, 100, 13, NULL),
(98, 'Planet 1', 1, 90, 14, NULL),
(99, 'Planet 2', 2, 100, 14, NULL),
(100, 'Planet 3', 3, 110, 14, NULL),
(101, 'Planet 4', 4, 120, 14, NULL),
(102, 'Planet 5', 5, 130, 14, NULL),
(103, 'Planet 6', 7, 110, 14, NULL),
(104, 'Planet 7', 8, 100, 14, NULL),
(105, 'Planet 8', 9, 90, 14, NULL),
(106, 'Planet 9', 10, 80, 14, NULL),
(107, 'Planet 1', 3, 110, 15, NULL),
(108, 'Planet 2', 4, 120, 15, NULL),
(109, 'Planet 3', 5, 130, 15, NULL),
(110, 'Planet 4', 6, 120, 15, NULL),
(111, 'Planet 5', 7, 110, 15, NULL),
(112, 'Planet 6', 8, 100, 15, NULL),
(113, 'Planet 7', 9, 90, 15, NULL),
(114, 'Planet 8', 10, 80, 15, NULL),
(115, 'Planet 1', 2, 100, 16, NULL),
(116, 'Planet 2', 7, 110, 16, NULL),
(117, 'Planet 3', 8, 100, 16, NULL),
(118, 'Planet 4', 9, 90, 16, NULL),
(119, 'Planet 5', 10, 80, 16, NULL),
(120, 'Planet 1', 1, 90, 17, NULL),
(121, 'Planet 2', 3, 110, 17, NULL),
(122, 'Planet 3', 4, 120, 17, NULL),
(123, 'Planet 4', 5, 130, 17, NULL),
(124, 'Planet 5', 6, 120, 17, NULL),
(125, 'Planet 1', 1, 90, 18, NULL),
(126, 'Planet 2', 2, 100, 18, NULL),
(127, 'Planet 3', 6, 120, 18, NULL),
(128, 'Planet 4', 7, 110, 18, NULL),
(129, 'Planet 5', 8, 100, 18, NULL),
(130, 'Planet 6', 10, 80, 18, NULL),
(131, 'Planet 1', 1, 90, 19, NULL),
(132, 'Planet 2', 2, 100, 19, NULL),
(133, 'Planet 3', 3, 110, 19, NULL),
(134, 'Planet 4', 4, 120, 19, NULL),
(135, 'Planet 5', 5, 130, 19, NULL),
(136, 'Planet 6', 6, 120, 19, NULL),
(137, 'Planet 7', 7, 110, 19, NULL),
(138, 'Planet 8', 8, 100, 19, NULL),
(139, 'Planet 9', 9, 90, 19, NULL),
(140, 'Planet 1', 1, 90, 20, NULL),
(141, 'Planet 2', 2, 100, 20, NULL),
(142, 'Planet 3', 4, 120, 20, NULL),
(143, 'Planet 4', 5, 130, 20, NULL),
(144, 'Planet 5', 6, 120, 20, NULL),
(145, 'Planet 6', 7, 110, 20, NULL),
(146, 'Planet 7', 8, 100, 20, NULL),
(147, 'Planet 8', 9, 90, 20, NULL),
(148, 'Planet 9', 10, 80, 20, NULL),
(149, 'Planet 1', 1, 90, 21, NULL),
(150, 'Planet 2', 2, 100, 21, NULL),
(151, 'Planet 3', 3, 110, 21, NULL),
(152, 'Planet 4', 4, 120, 21, NULL),
(153, 'Planet 5', 5, 130, 21, NULL),
(154, 'Planet 6', 7, 110, 21, NULL),
(155, 'Planet 7', 8, 100, 21, NULL),
(156, 'Planet 8', 9, 90, 21, NULL),
(157, 'Planet 1', 1, 90, 22, NULL),
(158, 'Planet 2', 2, 100, 22, NULL),
(159, 'Planet 3', 3, 110, 22, NULL),
(160, 'Planet 4', 4, 120, 22, NULL),
(161, 'Planet 5', 5, 130, 22, NULL),
(162, 'Planet 6', 6, 120, 22, NULL),
(163, 'Planet 7', 7, 110, 22, NULL),
(164, 'Planet 8', 8, 100, 22, NULL),
(165, 'Planet 9', 9, 90, 22, NULL),
(166, 'Planet 10', 10, 80, 22, NULL),
(167, 'Planet 1', 1, 90, 23, NULL),
(168, 'Planet 2', 2, 100, 23, NULL),
(169, 'Planet 3', 3, 110, 23, NULL),
(170, 'Planet 4', 5, 130, 23, NULL),
(171, 'Planet 5', 7, 110, 23, NULL),
(172, 'Planet 6', 8, 100, 23, NULL),
(173, 'Planet 7', 9, 90, 23, NULL),
(174, 'Planet 8', 10, 80, 23, NULL),
(175, 'Planet 1', 1, 90, 24, NULL),
(176, 'Planet 2', 3, 110, 24, NULL),
(177, 'Planet 3', 5, 130, 24, NULL),
(178, 'Planet 4', 7, 110, 24, NULL),
(179, 'Planet 5', 8, 100, 24, NULL),
(180, 'Planet 6', 10, 80, 24, NULL),
(181, 'Planet 1', 2, 100, 25, NULL),
(182, 'Planet 2', 3, 110, 25, NULL),
(183, 'Planet 3', 6, 120, 25, NULL),
(184, 'Planet 4', 7, 110, 25, NULL),
(185, 'Planet 5', 10, 80, 25, NULL),
(186, 'Planet 1', 1, 90, 26, NULL),
(187, 'Planet 2', 3, 110, 26, NULL),
(188, 'Planet 3', 4, 120, 26, NULL),
(189, 'Planet 4', 8, 100, 26, NULL),
(190, 'Planet 5', 10, 80, 26, NULL),
(191, 'Planet 1', 1, 90, 27, NULL),
(192, 'Planet 2', 3, 110, 27, NULL),
(193, 'Planet 3', 4, 120, 27, NULL),
(194, 'Planet 4', 5, 130, 27, NULL),
(195, 'Planet 5', 7, 110, 27, NULL),
(196, 'Planet 6', 8, 100, 27, NULL),
(197, 'Planet 7', 9, 90, 27, NULL),
(198, 'Planet 8', 10, 80, 27, NULL),
(199, 'Planet 1', 1, 90, 28, NULL),
(200, 'Planet 2', 2, 100, 28, NULL),
(201, 'Planet 3', 3, 110, 28, NULL),
(202, 'Planet 4', 4, 120, 28, NULL),
(203, 'Planet 5', 5, 130, 28, NULL),
(204, 'Planet 6', 6, 120, 28, NULL),
(205, 'Planet 7', 7, 110, 28, NULL),
(206, 'Planet 8', 8, 100, 28, NULL),
(207, 'Planet 9', 9, 90, 28, NULL),
(208, 'Planet 10', 10, 80, 28, NULL),
(209, 'Planet 1', 2, 100, 29, NULL),
(210, 'Planet 2', 4, 120, 29, NULL),
(211, 'Planet 3', 5, 130, 29, NULL),
(212, 'Planet 4', 6, 120, 29, NULL),
(213, 'Planet 5', 8, 100, 29, NULL),
(214, 'Planet 6', 9, 90, 29, NULL),
(215, 'Planet 7', 10, 80, 29, NULL),
(216, 'Planet 1', 1, 90, 30, NULL),
(217, 'Planet 2', 2, 100, 30, NULL),
(218, 'Planet 3', 3, 110, 30, NULL),
(219, 'Planet 4', 5, 130, 30, NULL),
(220, 'Planet 5', 6, 120, 30, NULL),
(221, 'Planet 6', 8, 100, 30, NULL),
(222, 'Planet 7', 9, 90, 30, NULL),
(223, 'Planet 8', 10, 80, 30, NULL),
(224, 'Planet 1', 2, 100, 31, NULL),
(225, 'Planet 2', 3, 110, 31, NULL),
(226, 'Planet 3', 5, 130, 31, NULL),
(227, 'Planet 4', 6, 120, 31, NULL),
(228, 'Planet 5', 7, 110, 31, NULL),
(229, 'Planet 6', 8, 100, 31, NULL),
(230, 'Planet 7', 9, 90, 31, NULL),
(231, 'Planet 1', 2, 100, 32, NULL),
(232, 'Planet 2', 5, 130, 32, NULL),
(233, 'Planet 3', 6, 120, 32, NULL),
(234, 'Planet 4', 7, 110, 32, NULL),
(235, 'Planet 5', 8, 100, 32, NULL),
(236, 'Planet 6', 9, 90, 32, NULL),
(237, 'Planet 7', 10, 80, 32, NULL),
(238, 'Planet 1', 1, 90, 33, NULL),
(239, 'Planet 2', 2, 100, 33, NULL),
(240, 'Planet 3', 3, 110, 33, NULL),
(241, 'Planet 4', 4, 120, 33, NULL),
(242, 'Planet 5', 5, 130, 33, NULL),
(243, 'Planet 6', 6, 120, 33, NULL),
(244, 'Planet 7', 7, 110, 33, NULL),
(245, 'Planet 8', 10, 80, 33, NULL),
(246, 'Planet 1', 1, 90, 34, NULL),
(247, 'Planet 2', 3, 110, 34, NULL),
(248, 'Planet 3', 4, 120, 34, NULL),
(249, 'Planet 4', 5, 130, 34, NULL),
(250, 'Planet 5', 6, 120, 34, NULL),
(251, 'Planet 6', 7, 110, 34, NULL),
(252, 'Planet 7', 8, 100, 34, NULL),
(253, 'Planet 8', 10, 80, 34, NULL),
(254, 'Planet 1', 1, 90, 35, NULL),
(255, 'Planet 2', 4, 120, 35, NULL),
(256, 'Planet 3', 5, 130, 35, NULL),
(257, 'Planet 4', 6, 120, 35, NULL),
(258, 'Planet 5', 8, 100, 35, NULL),
(259, 'Planet 1', 2, 100, 36, NULL),
(260, 'Planet 2', 3, 110, 36, NULL),
(261, 'Planet 3', 4, 120, 36, NULL),
(262, 'Planet 4', 5, 130, 36, NULL),
(263, 'Planet 5', 6, 120, 36, NULL),
(264, 'Planet 6', 7, 110, 36, NULL),
(265, 'Planet 7', 8, 100, 36, NULL),
(266, 'Planet 8', 9, 90, 36, NULL),
(267, 'Planet 9', 10, 80, 36, NULL),
(268, 'Planet 1', 1, 90, 37, NULL),
(269, 'Planet 2', 2, 100, 37, NULL),
(270, 'Planet 3', 3, 110, 37, NULL),
(271, 'Planet 4', 4, 120, 37, NULL),
(272, 'Planet 5', 5, 130, 37, NULL),
(273, 'Planet 6', 6, 120, 37, NULL),
(274, 'Planet 7', 7, 110, 37, NULL),
(275, 'Planet 8', 8, 100, 37, NULL),
(276, 'Planet 9', 10, 80, 37, NULL),
(277, 'Planet 1', 1, 90, 38, NULL),
(278, 'Planet 2', 2, 100, 38, NULL),
(279, 'Planet 3', 3, 110, 38, NULL),
(280, 'Planet 4', 4, 120, 38, NULL),
(281, 'Planet 5', 5, 130, 38, NULL),
(282, 'Planet 6', 6, 120, 38, NULL),
(283, 'Planet 7', 7, 110, 38, NULL),
(284, 'Planet 8', 8, 100, 38, NULL),
(285, 'Planet 9', 9, 90, 38, NULL),
(286, 'Planet 1', 1, 90, 39, NULL),
(287, 'Planet 2', 2, 100, 39, NULL),
(288, 'Planet 3', 5, 130, 39, NULL),
(289, 'Planet 4', 6, 120, 39, NULL),
(290, 'Planet 5', 7, 110, 39, NULL),
(291, 'Planet 6', 8, 100, 39, NULL),
(292, 'Planet 7', 9, 90, 39, NULL),
(293, 'Planet 8', 10, 80, 39, NULL),
(294, 'Planet 1', 2, 100, 40, NULL),
(295, 'Planet 2', 3, 110, 40, NULL),
(296, 'Planet 3', 4, 120, 40, NULL),
(297, 'Planet 4', 5, 130, 40, NULL),
(298, 'Planet 5', 6, 120, 40, NULL),
(299, 'Planet 6', 8, 100, 40, NULL),
(300, 'Planet 7', 10, 80, 40, NULL),
(301, 'Planet 1', 1, 90, 41, NULL),
(302, 'Planet 2', 2, 100, 41, NULL),
(303, 'Planet 3', 3, 110, 41, NULL),
(304, 'Planet 4', 5, 130, 41, NULL),
(305, 'Planet 5', 6, 120, 41, NULL),
(306, 'Planet 6', 7, 110, 41, NULL),
(307, 'Planet 7', 8, 100, 41, NULL),
(308, 'Planet 8', 9, 90, 41, NULL),
(309, 'Planet 9', 10, 80, 41, NULL),
(310, 'Planet 1', 2, 100, 42, NULL),
(311, 'Planet 2', 4, 120, 42, NULL),
(312, 'Planet 3', 9, 90, 42, NULL),
(313, 'Planet 4', 10, 80, 42, NULL),
(314, 'Planet 1', 1, 90, 43, NULL),
(315, 'Planet 2', 5, 130, 43, NULL),
(316, 'Planet 3', 6, 120, 43, NULL),
(317, 'Planet 4', 7, 110, 43, NULL),
(318, 'Planet 1', 2, 100, 44, NULL),
(319, 'Planet 2', 4, 120, 44, NULL),
(320, 'Planet 3', 5, 130, 44, NULL),
(321, 'Planet 4', 7, 110, 44, NULL),
(322, 'Planet 5', 8, 100, 44, NULL),
(323, 'Planet 6', 10, 80, 44, NULL),
(324, 'Planet 1', 1, 90, 45, NULL),
(325, 'Planet 2', 3, 110, 45, NULL),
(326, 'Planet 3', 5, 130, 45, NULL),
(327, 'Planet 4', 6, 120, 45, NULL),
(328, 'Planet 5', 7, 110, 45, NULL),
(329, 'Planet 6', 8, 100, 45, NULL),
(330, 'Planet 7', 9, 90, 45, NULL),
(331, 'Planet 1', 1, 90, 46, NULL),
(332, 'Planet 2', 3, 110, 46, NULL),
(333, 'Planet 3', 4, 120, 46, NULL),
(334, 'Planet 4', 7, 110, 46, NULL),
(335, 'Planet 5', 10, 80, 46, NULL),
(336, 'Planet 1', 1, 90, 47, NULL),
(337, 'Planet 2', 2, 100, 47, NULL),
(338, 'Planet 3', 3, 110, 47, NULL),
(339, 'Planet 4', 4, 120, 47, NULL),
(340, 'Planet 5', 5, 130, 47, NULL),
(341, 'Planet 6', 6, 120, 47, NULL),
(342, 'Planet 7', 7, 110, 47, NULL),
(343, 'Planet 8', 8, 100, 47, NULL),
(344, 'Planet 9', 10, 80, 47, NULL),
(345, 'Planet 1', 2, 100, 48, NULL),
(346, 'Planet 2', 3, 110, 48, NULL),
(347, 'Planet 3', 4, 120, 48, NULL),
(348, 'Planet 4', 5, 130, 48, NULL),
(349, 'Planet 5', 6, 120, 48, NULL),
(350, 'Planet 6', 7, 110, 48, NULL),
(351, 'Planet 7', 8, 100, 48, NULL),
(352, 'Planet 8', 9, 90, 48, NULL),
(353, 'Planet 9', 10, 80, 48, NULL),
(354, 'Planet 1', 1, 90, 49, NULL),
(355, 'Planet 2', 2, 100, 49, NULL),
(356, 'Planet 3', 4, 120, 49, NULL),
(357, 'Planet 4', 6, 120, 49, NULL),
(358, 'Planet 5', 7, 110, 49, NULL),
(359, 'Planet 6', 9, 90, 49, NULL),
(360, 'Planet 7', 10, 80, 49, NULL),
(361, 'Planet 1', 2, 100, 50, NULL),
(362, 'Planet 2', 3, 110, 50, NULL),
(363, 'Planet 3', 5, 130, 50, NULL),
(364, 'Planet 4', 6, 120, 50, NULL),
(365, 'Planet 5', 7, 110, 50, NULL),
(366, 'Planet 6', 10, 80, 50, NULL),
(367, 'Planet 1', 1, 90, 51, NULL),
(368, 'Planet 2', 2, 100, 51, NULL),
(369, 'Planet 3', 4, 120, 51, 2),
(370, 'Planet 4', 5, 130, 51, NULL),
(371, 'Planet 5', 6, 120, 51, NULL),
(372, 'Planet 6', 7, 110, 51, NULL),
(373, 'Planet 7', 8, 100, 51, NULL),
(374, 'Planet 8', 10, 80, 51, NULL),
(375, 'Planet 1', 1, 90, 52, NULL),
(376, 'Planet 2', 2, 100, 52, NULL),
(377, 'Planet 3', 5, 130, 52, NULL),
(378, 'Planet 4', 10, 80, 52, NULL),
(379, 'Planet 1', 3, 110, 53, NULL),
(380, 'Planet 2', 4, 120, 53, NULL),
(381, 'Planet 3', 7, 110, 53, NULL),
(382, 'Planet 4', 8, 100, 53, NULL),
(383, 'Planet 5', 10, 80, 53, NULL),
(384, 'Planet 1', 5, 130, 54, NULL),
(385, 'Planet 2', 6, 120, 54, NULL),
(386, 'Planet 3', 9, 90, 54, NULL),
(387, 'Planet 4', 10, 80, 54, NULL),
(388, 'Planet 1', 1, 90, 55, NULL),
(389, 'Planet 2', 2, 100, 55, NULL),
(390, 'Planet 3', 3, 110, 55, NULL),
(391, 'Planet 4', 4, 120, 55, NULL),
(392, 'Planet 5', 5, 130, 55, NULL),
(393, 'Planet 6', 6, 120, 55, NULL),
(394, 'Planet 7', 8, 100, 55, NULL),
(395, 'Planet 8', 9, 90, 55, NULL),
(396, 'Planet 1', 4, 120, 56, NULL),
(397, 'Planet 2', 6, 120, 56, NULL),
(398, 'Planet 3', 7, 110, 56, NULL),
(399, 'Planet 4', 9, 90, 56, NULL),
(400, 'Planet 5', 10, 80, 56, NULL),
(401, 'Planet 1', 1, 90, 57, NULL),
(402, 'Planet 2', 2, 100, 57, NULL),
(403, 'Planet 3', 3, 110, 57, NULL),
(404, 'Planet 4', 4, 120, 57, NULL),
(405, 'Planet 5', 5, 130, 57, NULL),
(406, 'Planet 6', 8, 100, 57, NULL),
(407, 'Planet 7', 9, 90, 57, NULL),
(408, 'Planet 1', 4, 120, 58, NULL),
(409, 'Planet 2', 7, 110, 58, NULL),
(410, 'Planet 3', 8, 100, 58, NULL),
(411, 'Planet 4', 9, 90, 58, NULL),
(412, 'Planet 1', 1, 90, 59, NULL),
(413, 'Planet 2', 2, 100, 59, NULL),
(414, 'Planet 3', 3, 110, 59, NULL),
(415, 'Planet 4', 4, 120, 59, NULL),
(416, 'Planet 5', 5, 130, 59, NULL),
(417, 'Planet 6', 6, 120, 59, NULL),
(418, 'Planet 7', 7, 110, 59, NULL),
(419, 'Planet 8', 9, 90, 59, NULL),
(420, 'Planet 9', 10, 80, 59, NULL),
(421, 'Planet 1', 1, 90, 60, NULL),
(422, 'Planet 2', 2, 100, 60, NULL),
(423, 'Planet 3', 3, 110, 60, NULL),
(424, 'Planet 4', 4, 120, 60, NULL),
(425, 'Planet 5', 5, 130, 60, NULL),
(426, 'Planet 6', 6, 120, 60, NULL),
(427, 'Planet 7', 7, 110, 60, NULL),
(428, 'Planet 8', 8, 100, 60, NULL),
(429, 'Planet 9', 9, 90, 60, NULL),
(430, 'Planet 1', 1, 90, 61, NULL),
(431, 'Planet 2', 3, 110, 61, NULL),
(432, 'Planet 3', 7, 110, 61, NULL),
(433, 'Planet 4', 9, 90, 61, NULL),
(434, 'Planet 1', 1, 90, 62, NULL),
(435, 'Planet 2', 2, 100, 62, NULL),
(436, 'Planet 3', 4, 120, 62, NULL),
(437, 'Planet 4', 5, 130, 62, NULL),
(438, 'Planet 5', 6, 120, 62, NULL),
(439, 'Planet 6', 8, 100, 62, NULL),
(440, 'Planet 7', 10, 80, 62, NULL),
(441, 'Planet 1', 2, 100, 63, NULL),
(442, 'Planet 2', 3, 110, 63, NULL),
(443, 'Planet 3', 4, 120, 63, NULL),
(444, 'Planet 4', 5, 130, 63, NULL),
(445, 'Planet 5', 6, 120, 63, NULL),
(446, 'Planet 6', 7, 110, 63, NULL),
(447, 'Planet 7', 8, 100, 63, NULL),
(448, 'Planet 8', 9, 90, 63, NULL),
(449, 'Planet 9', 10, 80, 63, NULL),
(450, 'Planet 1', 1, 90, 64, NULL),
(451, 'Planet 2', 2, 100, 64, NULL),
(452, 'Planet 3', 3, 110, 64, NULL),
(453, 'Planet 4', 4, 120, 64, NULL),
(454, 'Planet 5', 5, 130, 64, NULL),
(455, 'Planet 6', 6, 120, 64, NULL),
(456, 'Planet 7', 9, 90, 64, NULL),
(457, 'Planet 8', 10, 80, 64, NULL),
(458, 'Planet 1', 2, 100, 65, NULL),
(459, 'Planet 2', 4, 120, 65, NULL),
(460, 'Planet 3', 5, 130, 65, NULL),
(461, 'Planet 4', 6, 120, 65, NULL),
(462, 'Planet 5', 7, 110, 65, NULL),
(463, 'Planet 6', 8, 100, 65, NULL),
(464, 'Planet 7', 9, 90, 65, NULL),
(465, 'Planet 8', 10, 80, 65, NULL),
(466, 'Planet 1', 2, 100, 66, NULL),
(467, 'Planet 2', 3, 110, 66, NULL),
(468, 'Planet 3', 5, 130, 66, NULL),
(469, 'Planet 4', 7, 110, 66, NULL),
(470, 'Planet 5', 9, 90, 66, NULL),
(471, 'Planet 6', 10, 80, 66, NULL),
(472, 'Planet 1', 1, 90, 67, NULL),
(473, 'Planet 2', 3, 110, 67, NULL),
(474, 'Planet 3', 4, 120, 67, NULL),
(475, 'Planet 4', 5, 130, 67, NULL),
(476, 'Planet 5', 6, 120, 67, NULL),
(477, 'Planet 6', 7, 110, 67, NULL),
(478, 'Planet 7', 9, 90, 67, NULL),
(479, 'Planet 1', 4, 120, 68, NULL),
(480, 'Planet 2', 5, 130, 68, NULL),
(481, 'Planet 3', 6, 120, 68, NULL),
(482, 'Planet 4', 7, 110, 68, NULL),
(483, 'Planet 5', 8, 100, 68, NULL),
(484, 'Planet 1', 1, 90, 69, NULL),
(485, 'Planet 2', 2, 100, 69, NULL),
(486, 'Planet 3', 3, 110, 69, NULL),
(487, 'Planet 4', 4, 120, 69, NULL),
(488, 'Planet 5', 5, 130, 69, NULL),
(489, 'Planet 6', 6, 120, 69, NULL),
(490, 'Planet 7', 7, 110, 69, NULL),
(491, 'Planet 8', 8, 100, 69, NULL),
(492, 'Planet 9', 9, 90, 69, NULL),
(493, 'Planet 10', 10, 80, 69, NULL),
(494, 'Planet 1', 5, 130, 70, NULL),
(495, 'Planet 2', 6, 120, 70, NULL),
(496, 'Planet 3', 8, 100, 70, NULL),
(497, 'Planet 4', 9, 90, 70, NULL),
(498, 'Planet 5', 10, 80, 70, NULL),
(499, 'Planet 1', 2, 100, 71, NULL),
(500, 'Planet 2', 6, 120, 71, NULL),
(501, 'Planet 3', 7, 110, 71, NULL),
(502, 'Planet 4', 8, 100, 71, NULL),
(503, 'Planet 5', 9, 90, 71, NULL),
(504, 'Planet 1', 1, 90, 72, NULL),
(505, 'Planet 2', 2, 100, 72, NULL),
(506, 'Planet 3', 3, 110, 72, NULL),
(507, 'Planet 4', 6, 120, 72, NULL),
(508, 'Planet 5', 7, 110, 72, NULL),
(509, 'Planet 1', 2, 100, 73, NULL),
(510, 'Planet 2', 3, 110, 73, NULL),
(511, 'Planet 3', 6, 120, 73, NULL),
(512, 'Planet 4', 7, 110, 73, NULL),
(513, 'Planet 5', 8, 100, 73, NULL),
(514, 'Planet 6', 9, 90, 73, NULL),
(515, 'Planet 7', 10, 80, 73, NULL),
(516, 'Planet 1', 1, 90, 74, NULL),
(517, 'Planet 2', 2, 100, 74, NULL),
(518, 'Planet 3', 3, 110, 74, NULL),
(519, 'Planet 4', 4, 120, 74, NULL),
(520, 'Planet 5', 5, 130, 74, NULL),
(521, 'Planet 6', 6, 120, 74, NULL),
(522, 'Planet 7', 7, 110, 74, NULL),
(523, 'Planet 8', 9, 90, 74, NULL),
(524, 'Planet 9', 10, 80, 74, NULL),
(525, 'Planet 1', 1, 90, 75, NULL),
(526, 'Planet 2', 3, 110, 75, NULL),
(527, 'Planet 3', 4, 120, 75, NULL),
(528, 'Planet 4', 5, 130, 75, NULL),
(529, 'Planet 5', 6, 120, 75, NULL),
(530, 'Planet 6', 8, 100, 75, NULL),
(531, 'Planet 7', 9, 90, 75, NULL),
(532, 'Planet 8', 10, 80, 75, NULL),
(533, 'Planet 1', 2, 100, 76, NULL),
(534, 'Planet 2', 3, 110, 76, NULL),
(535, 'Planet 3', 4, 120, 76, NULL),
(536, 'Planet 4', 6, 120, 76, NULL),
(537, 'Planet 1', 1, 90, 77, NULL),
(538, 'Planet 2', 2, 100, 77, NULL),
(539, 'Planet 3', 3, 110, 77, NULL),
(540, 'Planet 4', 4, 120, 77, NULL),
(541, 'Planet 5', 5, 130, 77, NULL),
(542, 'Planet 6', 6, 120, 77, NULL),
(543, 'Planet 7', 7, 110, 77, NULL),
(544, 'Planet 8', 8, 100, 77, NULL),
(545, 'Planet 9', 9, 90, 77, NULL),
(546, 'Planet 10', 10, 80, 77, NULL),
(547, 'Planet 1', 1, 90, 78, NULL),
(548, 'Planet 2', 2, 100, 78, NULL),
(549, 'Planet 3', 3, 110, 78, NULL),
(550, 'Planet 4', 5, 130, 78, NULL),
(551, 'Planet 5', 7, 110, 78, NULL),
(552, 'Planet 6', 8, 100, 78, NULL),
(553, 'Planet 7', 9, 90, 78, NULL),
(554, 'Planet 1', 1, 90, 79, NULL),
(555, 'Planet 2', 2, 100, 79, NULL),
(556, 'Planet 3', 3, 110, 79, NULL),
(557, 'Planet 4', 4, 120, 79, NULL),
(558, 'Planet 5', 5, 130, 79, NULL),
(559, 'Planet 6', 6, 120, 79, NULL),
(560, 'Planet 7', 8, 100, 79, NULL),
(561, 'Planet 8', 9, 90, 79, NULL),
(562, 'Planet 9', 10, 80, 79, NULL),
(563, 'Planet 1', 1, 90, 80, NULL),
(564, 'Planet 2', 2, 100, 80, NULL),
(565, 'Planet 3', 3, 110, 80, NULL),
(566, 'Planet 4', 6, 120, 80, NULL),
(567, 'Planet 5', 8, 100, 80, NULL),
(568, 'Planet 6', 9, 90, 80, NULL),
(569, 'Planet 7', 10, 80, 80, NULL),
(570, 'Planet 1', 1, 90, 81, NULL),
(571, 'Planet 2', 2, 100, 81, NULL),
(572, 'Planet 3', 3, 110, 81, NULL),
(573, 'Planet 4', 4, 120, 81, NULL),
(574, 'Planet 5', 5, 130, 81, NULL),
(575, 'Planet 6', 6, 120, 81, NULL),
(576, 'Planet 7', 7, 110, 81, NULL),
(577, 'Planet 8', 8, 100, 81, NULL),
(578, 'Planet 9', 9, 90, 81, NULL),
(579, 'Planet 1', 2, 100, 82, NULL),
(580, 'Planet 2', 3, 110, 82, NULL),
(581, 'Planet 3', 4, 120, 82, NULL),
(582, 'Planet 4', 5, 130, 82, NULL),
(583, 'Planet 5', 6, 120, 82, NULL),
(584, 'Planet 6', 8, 100, 82, NULL),
(585, 'Planet 7', 9, 90, 82, NULL),
(586, 'Planet 1', 1, 90, 83, NULL),
(587, 'Planet 2', 4, 120, 83, NULL),
(588, 'Planet 3', 5, 130, 83, NULL),
(589, 'Planet 4', 8, 100, 83, NULL),
(590, 'Planet 5', 9, 90, 83, NULL),
(591, 'Planet 6', 10, 80, 83, NULL),
(592, 'Planet 1', 1, 90, 84, NULL),
(593, 'Planet 2', 2, 100, 84, NULL),
(594, 'Planet 3', 3, 110, 84, NULL),
(595, 'Planet 4', 4, 120, 84, NULL),
(596, 'Planet 5', 5, 130, 84, NULL),
(597, 'Planet 6', 6, 120, 84, NULL),
(598, 'Planet 7', 7, 110, 84, NULL),
(599, 'Planet 8', 9, 90, 84, NULL),
(600, 'Planet 9', 10, 80, 84, NULL),
(601, 'Planet 1', 1, 90, 85, NULL),
(602, 'Planet 2', 2, 100, 85, NULL),
(603, 'Planet 3', 3, 110, 85, NULL),
(604, 'Planet 4', 4, 120, 85, NULL),
(605, 'Planet 5', 5, 130, 85, NULL),
(606, 'Planet 6', 6, 120, 85, NULL),
(607, 'Planet 7', 7, 110, 85, NULL),
(608, 'Planet 8', 8, 100, 85, NULL),
(609, 'Planet 9', 9, 90, 85, NULL),
(610, 'Planet 10', 10, 80, 85, NULL),
(611, 'Planet 1', 1, 90, 86, NULL),
(612, 'Planet 2', 2, 100, 86, NULL),
(613, 'Planet 3', 4, 120, 86, NULL),
(614, 'Planet 4', 8, 100, 86, NULL),
(615, 'Planet 5', 10, 80, 86, NULL),
(616, 'Planet 1', 1, 90, 87, NULL),
(617, 'Planet 2', 3, 110, 87, NULL),
(618, 'Planet 3', 5, 130, 87, NULL),
(619, 'Planet 4', 6, 120, 87, NULL),
(620, 'Planet 5', 7, 110, 87, NULL),
(621, 'Planet 1', 1, 90, 88, NULL),
(622, 'Planet 2', 2, 100, 88, NULL),
(623, 'Planet 3', 3, 110, 88, NULL),
(624, 'Planet 4', 4, 120, 88, NULL),
(625, 'Planet 5', 5, 130, 88, NULL),
(626, 'Planet 6', 6, 120, 88, NULL),
(627, 'Planet 7', 7, 110, 88, NULL),
(628, 'Planet 8', 8, 100, 88, NULL),
(629, 'Planet 9', 9, 90, 88, NULL),
(630, 'Planet 10', 10, 80, 88, NULL),
(631, 'Planet 1', 3, 110, 89, NULL),
(632, 'Planet 2', 4, 120, 89, NULL),
(633, 'Planet 3', 7, 110, 89, NULL),
(634, 'Planet 4', 8, 100, 89, NULL),
(635, 'Planet 1', 1, 90, 90, NULL),
(636, 'Planet 2', 2, 100, 90, NULL),
(637, 'Planet 3', 3, 110, 90, NULL),
(638, 'Planet 4', 4, 120, 90, NULL),
(639, 'Planet 1', 1, 90, 91, NULL),
(640, 'Planet 2', 2, 100, 91, NULL),
(641, 'Planet 3', 3, 110, 91, NULL),
(642, 'Planet 4', 4, 120, 91, NULL),
(643, 'Planet 5', 5, 130, 91, NULL),
(644, 'Planet 6', 7, 110, 91, NULL),
(645, 'Planet 7', 8, 100, 91, NULL),
(646, 'Planet 1', 1, 90, 92, NULL),
(647, 'Planet 2', 3, 110, 92, NULL),
(648, 'Planet 3', 4, 120, 92, NULL),
(649, 'Planet 4', 5, 130, 92, NULL),
(650, 'Planet 5', 7, 110, 92, NULL),
(651, 'Planet 6', 8, 100, 92, NULL),
(652, 'Planet 7', 9, 90, 92, NULL),
(653, 'Planet 8', 10, 80, 92, NULL),
(654, 'Planet 1', 1, 90, 93, NULL),
(655, 'Planet 2', 2, 100, 93, NULL),
(656, 'Planet 3', 3, 110, 93, NULL),
(657, 'Planet 4', 5, 130, 93, NULL),
(658, 'Planet 5', 6, 120, 93, NULL),
(659, 'Planet 6', 7, 110, 93, NULL),
(660, 'Planet 7', 8, 100, 93, NULL),
(661, 'Planet 8', 10, 80, 93, NULL),
(662, 'Planet 1', 1, 90, 94, NULL),
(663, 'Planet 2', 5, 130, 94, NULL),
(664, 'Planet 3', 6, 120, 94, NULL),
(665, 'Planet 4', 7, 110, 94, NULL),
(666, 'Planet 5', 9, 90, 94, NULL),
(667, 'Planet 6', 10, 80, 94, NULL),
(668, 'Planet 1', 1, 90, 95, NULL),
(669, 'Planet 2', 2, 100, 95, NULL),
(670, 'Planet 3', 3, 110, 95, NULL),
(671, 'Planet 4', 4, 120, 95, NULL),
(672, 'Planet 5', 6, 120, 95, NULL),
(673, 'Planet 6', 8, 100, 95, NULL),
(674, 'Planet 7', 9, 90, 95, NULL),
(675, 'Planet 8', 10, 80, 95, NULL),
(676, 'Planet 1', 1, 90, 96, NULL),
(677, 'Planet 2', 2, 100, 96, NULL),
(678, 'Planet 3', 3, 110, 96, NULL),
(679, 'Planet 4', 5, 130, 96, NULL),
(680, 'Planet 1', 1, 90, 97, NULL),
(681, 'Planet 2', 2, 100, 97, NULL),
(682, 'Planet 3', 3, 110, 97, NULL),
(683, 'Planet 4', 4, 120, 97, NULL),
(684, 'Planet 5', 5, 130, 97, NULL),
(685, 'Planet 6', 6, 120, 97, NULL),
(686, 'Planet 1', 1, 90, 98, NULL),
(687, 'Planet 2', 6, 120, 98, NULL),
(688, 'Planet 3', 7, 110, 98, NULL),
(689, 'Planet 4', 10, 80, 98, NULL),
(690, 'Planet 1', 1, 90, 99, NULL),
(691, 'Planet 2', 3, 110, 99, NULL),
(692, 'Planet 3', 4, 120, 99, NULL),
(693, 'Planet 4', 5, 130, 99, NULL),
(694, 'Planet 5', 8, 100, 99, NULL),
(695, 'Planet 6', 9, 90, 99, NULL),
(696, 'Planet 1', 1, 90, 100, NULL),
(697, 'Planet 2', 2, 100, 100, NULL),
(698, 'Planet 3', 3, 110, 100, NULL),
(699, 'Planet 4', 5, 130, 100, NULL),
(700, 'Planet 5', 6, 120, 100, NULL),
(701, 'Planet 6', 7, 110, 100, NULL),
(702, 'Planet 7', 8, 100, 100, NULL),
(703, 'Planet 8', 9, 90, 100, NULL),
(704, 'Planet 9', 10, 80, 100, NULL),
(705, 'Planet 1', 2, 100, 101, NULL),
(706, 'Planet 2', 3, 110, 101, NULL),
(707, 'Planet 3', 4, 120, 101, NULL),
(708, 'Planet 4', 5, 130, 101, NULL),
(709, 'Planet 5', 8, 100, 101, NULL),
(710, 'Planet 6', 9, 90, 101, NULL),
(711, 'Planet 7', 10, 80, 101, NULL),
(712, 'Planet 1', 1, 90, 102, NULL),
(713, 'Planet 2', 3, 110, 102, NULL),
(714, 'Planet 3', 5, 130, 102, NULL),
(715, 'Planet 4', 6, 120, 102, NULL),
(716, 'Planet 5', 7, 110, 102, NULL),
(717, 'Planet 6', 9, 90, 102, NULL),
(718, 'Planet 1', 1, 90, 103, NULL),
(719, 'Planet 2', 3, 110, 103, NULL),
(720, 'Planet 3', 6, 120, 103, NULL),
(721, 'Planet 4', 9, 90, 103, NULL),
(722, 'Planet 5', 10, 80, 103, NULL),
(723, 'Planet 1', 1, 90, 104, NULL),
(724, 'Planet 2', 2, 100, 104, NULL),
(725, 'Planet 3', 3, 110, 104, NULL),
(726, 'Planet 4', 4, 120, 104, NULL),
(727, 'Planet 5', 5, 130, 104, NULL),
(728, 'Planet 6', 6, 120, 104, NULL),
(729, 'Planet 7', 7, 110, 104, NULL),
(730, 'Planet 8', 8, 100, 104, NULL),
(731, 'Planet 9', 9, 90, 104, NULL),
(732, 'Planet 10', 10, 80, 104, NULL),
(733, 'Planet 1', 1, 90, 105, NULL),
(734, 'Planet 2', 2, 100, 105, NULL),
(735, 'Planet 3', 4, 120, 105, NULL),
(736, 'Planet 4', 7, 110, 105, NULL),
(737, 'Planet 1', 1, 90, 106, NULL),
(738, 'Planet 2', 3, 110, 106, NULL),
(739, 'Planet 3', 4, 120, 106, NULL),
(740, 'Planet 4', 10, 80, 106, NULL),
(741, 'Planet 1', 1, 90, 107, NULL),
(742, 'Planet 2', 3, 110, 107, NULL),
(743, 'Planet 3', 6, 120, 107, NULL),
(744, 'Planet 4', 7, 110, 107, NULL),
(745, 'Planet 5', 9, 90, 107, NULL),
(746, 'Planet 1', 1, 90, 108, NULL),
(747, 'Planet 2', 2, 100, 108, NULL),
(748, 'Planet 3', 3, 110, 108, NULL),
(749, 'Planet 4', 4, 120, 108, NULL),
(750, 'Planet 5', 5, 130, 108, NULL),
(751, 'Planet 6', 6, 120, 108, NULL),
(752, 'Planet 7', 7, 110, 108, NULL),
(753, 'Planet 8', 8, 100, 108, NULL),
(754, 'Planet 9', 9, 90, 108, NULL),
(755, 'Planet 10', 10, 80, 108, NULL),
(756, 'Planet 1', 1, 90, 109, NULL),
(757, 'Planet 2', 8, 100, 109, NULL),
(758, 'Planet 3', 9, 90, 109, NULL),
(759, 'Planet 4', 10, 80, 109, NULL),
(760, 'Planet 1', 1, 90, 110, NULL),
(761, 'Planet 2', 2, 100, 110, NULL),
(762, 'Planet 3', 6, 120, 110, NULL),
(763, 'Planet 4', 7, 110, 110, NULL),
(764, 'Planet 5', 8, 100, 110, NULL),
(765, 'Planet 6', 9, 90, 110, NULL),
(766, 'Planet 7', 10, 80, 110, NULL),
(767, 'Planet 1', 1, 90, 111, NULL),
(768, 'Planet 2', 2, 100, 111, NULL),
(769, 'Planet 3', 3, 110, 111, NULL),
(770, 'Planet 4', 4, 120, 111, NULL),
(771, 'Planet 5', 5, 130, 111, NULL),
(772, 'Planet 6', 6, 120, 111, NULL),
(773, 'Planet 7', 7, 110, 111, NULL),
(774, 'Planet 8', 8, 100, 111, NULL),
(775, 'Planet 9', 9, 90, 111, NULL),
(776, 'Planet 10', 10, 80, 111, NULL),
(777, 'Planet 1', 1, 90, 112, NULL),
(778, 'Planet 2', 4, 120, 112, NULL),
(779, 'Planet 3', 8, 100, 112, NULL),
(780, 'Planet 4', 10, 80, 112, NULL),
(781, 'Planet 1', 1, 90, 113, NULL),
(782, 'Planet 2', 2, 100, 113, NULL),
(783, 'Planet 3', 3, 110, 113, NULL),
(784, 'Planet 4', 4, 120, 113, NULL),
(785, 'Planet 5', 6, 120, 113, NULL),
(786, 'Planet 6', 7, 110, 113, NULL),
(787, 'Planet 7', 8, 100, 113, NULL),
(788, 'Planet 8', 9, 90, 113, NULL),
(789, 'Planet 9', 10, 80, 113, NULL),
(790, 'Planet 1', 2, 100, 114, NULL),
(791, 'Planet 2', 5, 130, 114, NULL),
(792, 'Planet 3', 7, 110, 114, NULL),
(793, 'Planet 4', 9, 90, 114, NULL),
(794, 'Planet 1', 1, 90, 115, NULL),
(795, 'Planet 2', 2, 100, 115, NULL),
(796, 'Planet 3', 3, 110, 115, NULL),
(797, 'Planet 4', 4, 120, 115, NULL),
(798, 'Planet 5', 5, 130, 115, NULL),
(799, 'Planet 6', 6, 120, 115, NULL),
(800, 'Planet 7', 8, 100, 115, NULL),
(801, 'Planet 8', 9, 90, 115, NULL),
(802, 'Planet 9', 10, 80, 115, NULL),
(803, 'Planet 1', 1, 90, 116, NULL),
(804, 'Planet 2', 3, 110, 116, NULL),
(805, 'Planet 3', 4, 120, 116, NULL),
(806, 'Planet 4', 5, 130, 116, NULL),
(807, 'Planet 5', 6, 120, 116, NULL),
(808, 'Planet 6', 7, 110, 116, NULL),
(809, 'Planet 7', 8, 100, 116, NULL),
(810, 'Planet 8', 9, 90, 116, NULL),
(811, 'Planet 9', 10, 80, 116, NULL),
(812, 'Planet 1', 1, 90, 117, NULL),
(813, 'Planet 2', 2, 100, 117, NULL),
(814, 'Planet 3', 7, 110, 117, NULL),
(815, 'Planet 4', 8, 100, 117, NULL),
(816, 'Planet 5', 9, 90, 117, NULL),
(817, 'Planet 6', 10, 80, 117, NULL),
(818, 'Planet 1', 1, 90, 118, NULL),
(819, 'Planet 2', 2, 100, 118, NULL),
(820, 'Planet 3', 3, 110, 118, NULL),
(821, 'Planet 4', 4, 120, 118, NULL),
(822, 'Planet 5', 5, 130, 118, NULL),
(823, 'Planet 6', 6, 120, 118, NULL),
(824, 'Planet 7', 7, 110, 118, NULL),
(825, 'Planet 8', 8, 100, 118, NULL),
(826, 'Planet 9', 9, 90, 118, NULL),
(827, 'Planet 10', 10, 80, 118, NULL),
(828, 'Planet 1', 1, 90, 119, NULL),
(829, 'Planet 2', 2, 100, 119, NULL),
(830, 'Planet 3', 3, 110, 119, NULL),
(831, 'Planet 4', 4, 120, 119, NULL),
(832, 'Planet 5', 5, 130, 119, NULL),
(833, 'Planet 6', 6, 120, 119, NULL),
(834, 'Planet 7', 7, 110, 119, NULL),
(835, 'Planet 8', 8, 100, 119, NULL),
(836, 'Planet 9', 9, 90, 119, NULL),
(837, 'Planet 1', 1, 90, 120, NULL),
(838, 'Planet 2', 2, 100, 120, NULL),
(839, 'Planet 3', 3, 110, 120, NULL),
(840, 'Planet 4', 4, 120, 120, NULL),
(841, 'Planet 5', 7, 110, 120, NULL),
(842, 'Planet 6', 8, 100, 120, NULL),
(843, 'Planet 7', 9, 90, 120, NULL),
(844, 'Planet 8', 10, 80, 120, NULL),
(845, 'Planet 1', 1, 90, 121, NULL),
(846, 'Planet 2', 2, 100, 121, NULL),
(847, 'Planet 3', 3, 110, 121, NULL),
(848, 'Planet 4', 4, 120, 121, NULL),
(849, 'Planet 5', 5, 130, 121, NULL),
(850, 'Planet 6', 6, 120, 121, NULL),
(851, 'Planet 7', 7, 110, 121, NULL),
(852, 'Planet 8', 8, 100, 121, NULL),
(853, 'Planet 9', 9, 90, 121, NULL),
(854, 'Planet 10', 10, 80, 121, NULL),
(855, 'Planet 1', 1, 90, 122, NULL),
(856, 'Planet 2', 2, 100, 122, NULL),
(857, 'Planet 3', 3, 110, 122, NULL),
(858, 'Planet 4', 4, 120, 122, NULL),
(859, 'Planet 5', 7, 110, 122, NULL),
(860, 'Planet 6', 8, 100, 122, NULL),
(861, 'Planet 7', 9, 90, 122, NULL),
(862, 'Planet 8', 10, 80, 122, NULL),
(863, 'Planet 1', 3, 110, 123, NULL),
(864, 'Planet 2', 4, 120, 123, NULL),
(865, 'Planet 3', 6, 120, 123, NULL),
(866, 'Planet 4', 7, 110, 123, NULL),
(867, 'Planet 5', 8, 100, 123, NULL),
(868, 'Planet 6', 9, 90, 123, NULL),
(869, 'Planet 7', 10, 80, 123, NULL),
(870, 'Planet 1', 2, 100, 124, NULL),
(871, 'Planet 2', 3, 110, 124, NULL),
(872, 'Planet 3', 4, 120, 124, NULL),
(873, 'Planet 4', 5, 130, 124, NULL),
(874, 'Planet 5', 7, 110, 124, NULL),
(875, 'Planet 6', 9, 90, 124, NULL),
(876, 'Planet 7', 10, 80, 124, NULL),
(877, 'Planet 1', 1, 90, 125, NULL),
(878, 'Planet 2', 3, 110, 125, NULL),
(879, 'Planet 3', 4, 120, 125, NULL),
(880, 'Planet 4', 5, 130, 125, NULL),
(881, 'Planet 5', 6, 120, 125, NULL),
(882, 'Planet 6', 7, 110, 125, NULL),
(883, 'Planet 7', 8, 100, 125, NULL),
(884, 'Planet 8', 9, 90, 125, NULL),
(885, 'Planet 1', 2, 100, 126, NULL),
(886, 'Planet 2', 3, 110, 126, NULL),
(887, 'Planet 3', 5, 130, 126, NULL),
(888, 'Planet 4', 7, 110, 126, NULL),
(889, 'Planet 1', 1, 90, 127, NULL),
(890, 'Planet 2', 2, 100, 127, NULL),
(891, 'Planet 3', 3, 110, 127, NULL),
(892, 'Planet 4', 4, 120, 127, NULL),
(893, 'Planet 5', 5, 130, 127, NULL),
(894, 'Planet 6', 6, 120, 127, NULL),
(895, 'Planet 7', 9, 90, 127, NULL),
(896, 'Planet 1', 1, 90, 128, NULL),
(897, 'Planet 2', 2, 100, 128, NULL),
(898, 'Planet 3', 3, 110, 128, NULL),
(899, 'Planet 4', 5, 130, 128, NULL),
(900, 'Planet 5', 6, 120, 128, NULL),
(901, 'Planet 6', 7, 110, 128, NULL),
(902, 'Planet 1', 1, 90, 129, NULL),
(903, 'Planet 2', 2, 100, 129, NULL),
(904, 'Planet 3', 4, 120, 129, NULL),
(905, 'Planet 4', 5, 130, 129, NULL),
(906, 'Planet 5', 6, 120, 129, NULL),
(907, 'Planet 6', 7, 110, 129, NULL),
(908, 'Planet 7', 8, 100, 129, NULL),
(909, 'Planet 8', 9, 90, 129, NULL),
(910, 'Planet 9', 10, 80, 129, NULL),
(911, 'Planet 1', 1, 90, 130, NULL),
(912, 'Planet 2', 4, 120, 130, NULL),
(913, 'Planet 3', 5, 130, 130, NULL),
(914, 'Planet 4', 9, 90, 130, NULL),
(915, 'Planet 5', 10, 80, 130, NULL),
(916, 'Planet 1', 1, 90, 131, NULL),
(917, 'Planet 2', 5, 130, 131, NULL),
(918, 'Planet 3', 6, 120, 131, NULL),
(919, 'Planet 4', 7, 110, 131, NULL),
(920, 'Planet 1', 1, 90, 132, NULL),
(921, 'Planet 2', 3, 110, 132, NULL),
(922, 'Planet 3', 4, 120, 132, NULL),
(923, 'Planet 4', 5, 130, 132, NULL),
(924, 'Planet 5', 8, 100, 132, NULL),
(925, 'Planet 6', 9, 90, 132, NULL),
(926, 'Planet 7', 10, 80, 132, NULL),
(927, 'Planet 1', 2, 100, 133, NULL),
(928, 'Planet 2', 4, 120, 133, NULL),
(929, 'Planet 3', 5, 130, 133, NULL),
(930, 'Planet 4', 6, 120, 133, NULL),
(931, 'Planet 5', 7, 110, 133, NULL),
(932, 'Planet 6', 8, 100, 133, NULL),
(933, 'Planet 7', 10, 80, 133, NULL),
(934, 'Planet 1', 2, 100, 134, NULL),
(935, 'Planet 2', 3, 110, 134, NULL),
(936, 'Planet 3', 6, 120, 134, NULL),
(937, 'Planet 4', 7, 110, 134, NULL),
(938, 'Planet 5', 8, 100, 134, NULL),
(939, 'Planet 6', 10, 80, 134, NULL),
(940, 'Planet 1', 2, 100, 135, NULL),
(941, 'Planet 2', 4, 120, 135, NULL),
(942, 'Planet 3', 5, 130, 135, NULL),
(943, 'Planet 4', 9, 90, 135, NULL),
(944, 'Planet 1', 1, 90, 136, NULL),
(945, 'Planet 2', 2, 100, 136, NULL),
(946, 'Planet 3', 3, 110, 136, NULL),
(947, 'Planet 4', 4, 120, 136, NULL),
(948, 'Planet 5', 5, 130, 136, NULL),
(949, 'Planet 6', 6, 120, 136, NULL),
(950, 'Planet 7', 7, 110, 136, NULL),
(951, 'Planet 8', 8, 100, 136, NULL),
(952, 'Planet 9', 9, 90, 136, NULL),
(953, 'Planet 10', 10, 80, 136, NULL),
(954, 'Planet 1', 1, 90, 137, NULL),
(955, 'Planet 2', 2, 100, 137, NULL),
(956, 'Planet 3', 3, 110, 137, NULL),
(957, 'Planet 4', 4, 120, 137, NULL),
(958, 'Planet 5', 5, 130, 137, NULL),
(959, 'Planet 6', 6, 120, 137, NULL),
(960, 'Planet 7', 7, 110, 137, NULL),
(961, 'Planet 8', 8, 100, 137, NULL),
(962, 'Planet 9', 9, 90, 137, NULL),
(963, 'Planet 1', 3, 110, 138, NULL),
(964, 'Planet 2', 5, 130, 138, NULL),
(965, 'Planet 3', 7, 110, 138, NULL),
(966, 'Planet 4', 10, 80, 138, NULL),
(967, 'Planet 1', 1, 90, 139, NULL),
(968, 'Planet 2', 2, 100, 139, NULL),
(969, 'Planet 3', 3, 110, 139, NULL),
(970, 'Planet 4', 5, 130, 139, NULL),
(971, 'Planet 5', 6, 120, 139, NULL),
(972, 'Planet 6', 8, 100, 139, NULL),
(973, 'Planet 7', 9, 90, 139, NULL),
(974, 'Planet 8', 10, 80, 139, NULL),
(975, 'Planet 1', 1, 90, 140, NULL),
(976, 'Planet 2', 2, 100, 140, NULL),
(977, 'Planet 3', 3, 110, 140, NULL),
(978, 'Planet 4', 4, 120, 140, NULL),
(979, 'Planet 5', 5, 130, 140, NULL),
(980, 'Planet 6', 6, 120, 140, NULL),
(981, 'Planet 7', 7, 110, 140, NULL),
(982, 'Planet 8', 8, 100, 140, NULL),
(983, 'Planet 9', 9, 90, 140, NULL),
(984, 'Planet 10', 10, 80, 140, NULL),
(985, 'Planet 1', 1, 90, 141, NULL),
(986, 'Planet 2', 3, 110, 141, NULL),
(987, 'Planet 3', 6, 120, 141, NULL),
(988, 'Planet 4', 7, 110, 141, NULL),
(989, 'Planet 5', 8, 100, 141, NULL),
(990, 'Planet 6', 9, 90, 141, NULL),
(991, 'Planet 7', 10, 80, 141, NULL),
(992, 'Planet 1', 2, 100, 142, NULL),
(993, 'Planet 2', 6, 120, 142, NULL),
(994, 'Planet 3', 7, 110, 142, NULL),
(995, 'Planet 4', 8, 100, 142, NULL),
(996, 'Planet 5', 9, 90, 142, NULL),
(997, 'Planet 6', 10, 80, 142, NULL),
(998, 'Planet 1', 1, 90, 143, NULL),
(999, 'Planet 2', 2, 100, 143, NULL),
(1000, 'Planet 3', 4, 120, 143, NULL),
(1001, 'Planet 4', 6, 120, 143, NULL),
(1002, 'Planet 5', 7, 110, 143, NULL),
(1003, 'Planet 6', 10, 80, 143, NULL),
(1004, 'Planet 1', 2, 100, 144, NULL),
(1005, 'Planet 2', 3, 110, 144, NULL),
(1006, 'Planet 3', 6, 120, 144, NULL),
(1007, 'Planet 4', 8, 100, 144, NULL),
(1008, 'Planet 1', 1, 90, 145, NULL),
(1009, 'Planet 2', 2, 100, 145, NULL),
(1010, 'Planet 3', 4, 120, 145, NULL),
(1011, 'Planet 4', 5, 130, 145, NULL),
(1012, 'Planet 5', 6, 120, 145, NULL),
(1013, 'Planet 6', 7, 110, 145, NULL),
(1014, 'Planet 7', 9, 90, 145, NULL),
(1015, 'Planet 8', 10, 80, 145, NULL),
(1016, 'Planet 1', 4, 120, 146, NULL),
(1017, 'Planet 2', 5, 130, 146, NULL),
(1018, 'Planet 3', 7, 110, 146, NULL),
(1019, 'Planet 4', 9, 90, 146, NULL),
(1020, 'Planet 1', 1, 90, 147, NULL),
(1021, 'Planet 2', 3, 110, 147, NULL),
(1022, 'Planet 3', 5, 130, 147, NULL),
(1023, 'Planet 4', 6, 120, 147, NULL),
(1024, 'Planet 5', 8, 100, 147, NULL),
(1025, 'Planet 1', 1, 90, 148, NULL),
(1026, 'Planet 2', 2, 100, 148, NULL),
(1027, 'Planet 3', 3, 110, 148, NULL),
(1028, 'Planet 4', 4, 120, 148, NULL),
(1029, 'Planet 5', 5, 130, 148, NULL),
(1030, 'Planet 6', 6, 120, 148, NULL),
(1031, 'Planet 7', 7, 110, 148, NULL),
(1032, 'Planet 8', 8, 100, 148, NULL),
(1033, 'Planet 9', 9, 90, 148, NULL),
(1034, 'Planet 10', 10, 80, 148, NULL),
(1035, 'Planet 1', 1, 90, 149, NULL),
(1036, 'Planet 2', 2, 100, 149, NULL),
(1037, 'Planet 3', 4, 120, 149, NULL),
(1038, 'Planet 4', 5, 130, 149, NULL),
(1039, 'Planet 5', 6, 120, 149, NULL),
(1040, 'Planet 6', 7, 110, 149, NULL),
(1041, 'Planet 7', 8, 100, 149, NULL),
(1042, 'Planet 8', 9, 90, 149, NULL),
(1043, 'Planet 1', 3, 110, 150, NULL),
(1044, 'Planet 2', 4, 120, 150, NULL),
(1045, 'Planet 3', 5, 130, 150, NULL),
(1046, 'Planet 4', 6, 120, 150, NULL),
(1047, 'Planet 5', 7, 110, 150, NULL),
(1048, 'Planet 6', 8, 100, 150, NULL),
(1049, 'Planet 7', 9, 90, 150, NULL),
(1050, 'Planet 8', 10, 80, 150, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `player`
--

INSERT INTO `player` (`id`, `name`, `password`, `mail`) VALUES
(2, 'test', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'benameurcamil@gmail.com'),
(3, 'tobi', 'ac0c5a38a5d9cdac77178c6aba082131f56340a5dad8d3446b9a7d68bb1ec788b13acafc2889d2bdddf8f9f447e08581ed5ab2e594a2ae6be0df0111d90d61ce', 't.wendl28@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `ship`
--

DROP TABLE IF EXISTS `ship`;
CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planet_id` int(11) NOT NULL,
  `archetype_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fleet_id` (`planet_id`),
  KEY `archetype_id` (`archetype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ship`
--

INSERT INTO `ship` (`id`, `planet_id`, `archetype_id`, `amount`) VALUES
(1, 2, 1, 10),
(2, 2, 3, 1),
(3, 2, 4, 1),
(4, 2, 2, 1),
(5, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ship_archetype`
--

DROP TABLE IF EXISTS `ship_archetype`;
CREATE TABLE IF NOT EXISTS `ship_archetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `building_time` int(11) NOT NULL,
  `metal_building_cost` int(11) NOT NULL,
  `deuterium_building_cost` int(11) NOT NULL,
  `defence_value` int(11) NOT NULL,
  `offence_value` int(11) NOT NULL,
  `fret_value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ship_archetype`
--

INSERT INTO `ship_archetype` (`id`, `name`, `building_time`, `metal_building_cost`, `deuterium_building_cost`, `defence_value`, `offence_value`, `fret_value`) VALUES
(1, 'fighter ', 20, 3000, 500, 50, 75, 0),
(2, 'cruiser', 120, 20000, 5000, 150, 400, 0),
(3, 'carrier', 55, 6000, 1500, 50, 0, 100000),
(4, 'colonization ship', 120, 10000, 10000, 50, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `solar_system`
--

DROP TABLE IF EXISTS `solar_system`;
CREATE TABLE IF NOT EXISTS `solar_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `galaxy_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `galaxy_id` (`galaxy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `solar_system`
--

INSERT INTO `solar_system` (`id`, `name`, `galaxy_id`) VALUES
(1, 'Solar System 1', 1),
(2, 'Solar System 2', 1),
(3, 'Solar System 3', 1),
(4, 'Solar System 4', 1),
(5, 'Solar System 5', 1),
(6, 'Solar System 6', 1),
(7, 'Solar System 7', 1),
(8, 'Solar System 8', 1),
(9, 'Solar System 9', 1),
(10, 'Solar System 10', 1),
(11, 'Solar System 1', 2),
(12, 'Solar System 2', 2),
(13, 'Solar System 3', 2),
(14, 'Solar System 4', 2),
(15, 'Solar System 5', 2),
(16, 'Solar System 6', 2),
(17, 'Solar System 7', 2),
(18, 'Solar System 8', 2),
(19, 'Solar System 9', 2),
(20, 'Solar System 10', 2),
(21, 'Solar System 1', 3),
(22, 'Solar System 2', 3),
(23, 'Solar System 3', 3),
(24, 'Solar System 4', 3),
(25, 'Solar System 5', 3),
(26, 'Solar System 6', 3),
(27, 'Solar System 7', 3),
(28, 'Solar System 8', 3),
(29, 'Solar System 9', 3),
(30, 'Solar System 10', 3),
(31, 'Solar System 1', 4),
(32, 'Solar System 2', 4),
(33, 'Solar System 3', 4),
(34, 'Solar System 4', 4),
(35, 'Solar System 5', 4),
(36, 'Solar System 6', 4),
(37, 'Solar System 7', 4),
(38, 'Solar System 8', 4),
(39, 'Solar System 9', 4),
(40, 'Solar System 10', 4),
(41, 'Solar System 1', 5),
(42, 'Solar System 2', 5),
(43, 'Solar System 3', 5),
(44, 'Solar System 4', 5),
(45, 'Solar System 5', 5),
(46, 'Solar System 6', 5),
(47, 'Solar System 7', 5),
(48, 'Solar System 8', 5),
(49, 'Solar System 9', 5),
(50, 'Solar System 10', 5),
(51, 'Solar System 1', 6),
(52, 'Solar System 2', 6),
(53, 'Solar System 3', 6),
(54, 'Solar System 4', 6),
(55, 'Solar System 5', 6),
(56, 'Solar System 6', 6),
(57, 'Solar System 7', 6),
(58, 'Solar System 8', 6),
(59, 'Solar System 9', 6),
(60, 'Solar System 10', 6),
(61, 'Solar System 1', 7),
(62, 'Solar System 2', 7),
(63, 'Solar System 3', 7),
(64, 'Solar System 4', 7),
(65, 'Solar System 5', 7),
(66, 'Solar System 6', 7),
(67, 'Solar System 7', 7),
(68, 'Solar System 8', 7),
(69, 'Solar System 9', 7),
(70, 'Solar System 10', 7),
(71, 'Solar System 1', 8),
(72, 'Solar System 2', 8),
(73, 'Solar System 3', 8),
(74, 'Solar System 4', 8),
(75, 'Solar System 5', 8),
(76, 'Solar System 6', 8),
(77, 'Solar System 7', 8),
(78, 'Solar System 8', 8),
(79, 'Solar System 9', 8),
(80, 'Solar System 10', 8),
(81, 'Solar System 1', 9),
(82, 'Solar System 2', 9),
(83, 'Solar System 3', 9),
(84, 'Solar System 4', 9),
(85, 'Solar System 5', 9),
(86, 'Solar System 6', 9),
(87, 'Solar System 7', 9),
(88, 'Solar System 8', 9),
(89, 'Solar System 9', 9),
(90, 'Solar System 10', 9),
(91, 'Solar System 1', 10),
(92, 'Solar System 2', 10),
(93, 'Solar System 3', 10),
(94, 'Solar System 4', 10),
(95, 'Solar System 5', 10),
(96, 'Solar System 6', 10),
(97, 'Solar System 7', 10),
(98, 'Solar System 8', 10),
(99, 'Solar System 9', 10),
(100, 'Solar System 10', 10),
(101, 'Solar System 1', 11),
(102, 'Solar System 2', 11),
(103, 'Solar System 3', 11),
(104, 'Solar System 4', 11),
(105, 'Solar System 5', 11),
(106, 'Solar System 6', 11),
(107, 'Solar System 7', 11),
(108, 'Solar System 8', 11),
(109, 'Solar System 9', 11),
(110, 'Solar System 10', 11),
(111, 'Solar System 1', 12),
(112, 'Solar System 2', 12),
(113, 'Solar System 3', 12),
(114, 'Solar System 4', 12),
(115, 'Solar System 5', 12),
(116, 'Solar System 6', 12),
(117, 'Solar System 7', 12),
(118, 'Solar System 8', 12),
(119, 'Solar System 9', 12),
(120, 'Solar System 10', 12),
(121, 'Solar System 1', 13),
(122, 'Solar System 2', 13),
(123, 'Solar System 3', 13),
(124, 'Solar System 4', 13),
(125, 'Solar System 5', 13),
(126, 'Solar System 6', 13),
(127, 'Solar System 7', 13),
(128, 'Solar System 8', 13),
(129, 'Solar System 9', 13),
(130, 'Solar System 10', 13),
(131, 'Solar System 1', 14),
(132, 'Solar System 2', 14),
(133, 'Solar System 3', 14),
(134, 'Solar System 4', 14),
(135, 'Solar System 5', 14),
(136, 'Solar System 6', 14),
(137, 'Solar System 7', 14),
(138, 'Solar System 8', 14),
(139, 'Solar System 9', 14),
(140, 'Solar System 10', 14),
(141, 'Solar System 1', 15),
(142, 'Solar System 2', 15),
(143, 'Solar System 3', 15),
(144, 'Solar System 4', 15),
(145, 'Solar System 5', 15),
(146, 'Solar System 6', 15),
(147, 'Solar System 7', 15),
(148, 'Solar System 8', 15),
(149, 'Solar System 9', 15),
(150, 'Solar System 10', 15);

-- --------------------------------------------------------

--
-- Structure de la table `technology`
--

DROP TABLE IF EXISTS `technology`;
CREATE TABLE IF NOT EXISTS `technology` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `planet_id` int(11) NOT NULL,
  `archetype_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `archetype_id` (`archetype_id`),
  KEY `planet_id` (`planet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `technology`
--

INSERT INTO `technology` (`id`, `planet_id`, `archetype_id`, `level`) VALUES
(1, 2, 1, 5),
(2, 2, 5, 5),
(3, 2, 2, 5),
(4, 2, 3, 2),
(5, 2, 4, 1),
(6, 1, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `technology_archetype`
--

DROP TABLE IF EXISTS `technology_archetype`;
CREATE TABLE IF NOT EXISTS `technology_archetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `research_time` int(11) NOT NULL,
  `deuterium_cost` int(11) NOT NULL,
  `metal_cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `technology_archetype`
--

INSERT INTO `technology_archetype` (`id`, `name`, `research_time`, `deuterium_cost`, `metal_cost`) VALUES
(1, 'Energy', 4, 100, 0),
(2, 'Laser', 2, 300, 0),
(3, 'Ion', 8, 500, 0),
(4, 'Shield', 5, 1000, 0),
(5, 'Weaponry', 6, 500, 200);

-- --------------------------------------------------------

--
-- Structure de la table `universe`
--

DROP TABLE IF EXISTS `universe`;
CREATE TABLE IF NOT EXISTS `universe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `universe`
--

INSERT INTO `universe` (`id`, `name`) VALUES
(1, 'Univers de camil'),
(2, 'Univers de tobias'),
(3, 'Universe 1');

-- --------------------------------------------------------

--
-- Structure de la table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `universe_id` int(11) NOT NULL,
  `deuterium` int(11) NOT NULL DEFAULT 1000,
  `metal` int(11) NOT NULL DEFAULT 1000,
  `energy` int(11) NOT NULL DEFAULT 1000,
  PRIMARY KEY (`id`),
  KEY `universe_id` (`universe_id`),
  KEY `player_id` (`player_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `wallet`
--

INSERT INTO `wallet` (`id`, `player_id`, `universe_id`, `deuterium`, `metal`, `energy`) VALUES
(4, 2, 2, 1165, 1844, 6078),
(5, 2, 1, 696, 4710, 7576),
(6, 2, 3, 1000, 1000, 1000),
(7, 3, 1, 1000, 1000, 1000),
(8, 3, 2, 1000, 1000, 1000),
(9, 3, 3, 1000, 1000, 1000);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `galaxy`
--
ALTER TABLE `galaxy`
  ADD CONSTRAINT `galaxy_ibfk_1` FOREIGN KEY (`universe_id`) REFERENCES `universe` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `infrastructure`
--
ALTER TABLE `infrastructure`
  ADD CONSTRAINT `infrastructure_ibfk_1` FOREIGN KEY (`archetype_id`) REFERENCES `infrastructure_archetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `infrastructure_defence`
--
ALTER TABLE `infrastructure_defence`
  ADD CONSTRAINT `infrastructure_defence_ibfk_1` FOREIGN KEY (`id`) REFERENCES `infrastructure_archetype` (`defence_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `infrastructure_facility`
--
ALTER TABLE `infrastructure_facility`
  ADD CONSTRAINT `infrastructure_facility_ibfk_1` FOREIGN KEY (`id`) REFERENCES `infrastructure_archetype` (`facility_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `infrastructure_resources`
--
ALTER TABLE `infrastructure_resources`
  ADD CONSTRAINT `infrastructure_resources_ibfk_1` FOREIGN KEY (`id`) REFERENCES `infrastructure_archetype` (`resource_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `planet`
--
ALTER TABLE `planet`
  ADD CONSTRAINT `planet_ibfk_1` FOREIGN KEY (`solar_system_id`) REFERENCES `solar_system` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `planet_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ship`
--
ALTER TABLE `ship`
  ADD CONSTRAINT `ship_ibfk_1` FOREIGN KEY (`archetype_id`) REFERENCES `ship_archetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ship_ibfk_2` FOREIGN KEY (`planet_id`) REFERENCES `planet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `solar_system`
--
ALTER TABLE `solar_system`
  ADD CONSTRAINT `solar_system_ibfk_1` FOREIGN KEY (`galaxy_id`) REFERENCES `galaxy` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `technology`
--
ALTER TABLE `technology`
  ADD CONSTRAINT `technology_ibfk_1` FOREIGN KEY (`archetype_id`) REFERENCES `technology_archetype` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `technology_ibfk_2` FOREIGN KEY (`planet_id`) REFERENCES `planet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Évènements
--
DROP EVENT IF EXISTS `update_metal_wallet_2_1`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_metal_wallet_2_1` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-06-03 18:08:56' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE wallet
    SET wallet.metal = wallet.metal + '30'
    WHERE wallet.player_id = '2' AND wallet.universe_id = '1'$$

DROP EVENT IF EXISTS `update_deuterium_wallet_2_1`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_deuterium_wallet_2_1` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-06-03 18:08:56' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE wallet
    SET wallet.deuterium = wallet.deuterium + '4'
    WHERE wallet.player_id = '2' AND wallet.universe_id = '1'$$

DROP EVENT IF EXISTS `update_energy_wallet_2_1`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_energy_wallet_2_1` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-06-03 18:08:56' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE wallet
    SET wallet.energy = wallet.energy + '39'
    WHERE wallet.player_id = '2' AND wallet.universe_id = '1'$$

DROP EVENT IF EXISTS `update_metal_wallet_2_2`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_metal_wallet_2_2` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-06-03 18:32:36' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE wallet
    SET wallet.metal = wallet.metal + '10'
    WHERE wallet.player_id = '2' AND wallet.universe_id = '2'$$

DROP EVENT IF EXISTS `update_deuterium_wallet_2_2`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_deuterium_wallet_2_2` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-06-03 18:32:36' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE wallet
    SET wallet.deuterium = wallet.deuterium + '1'
    WHERE wallet.player_id = '2' AND wallet.universe_id = '2'$$

DROP EVENT IF EXISTS `update_energy_wallet_2_2`$$
CREATE DEFINER=`root`@`localhost` EVENT `update_energy_wallet_2_2` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-06-03 18:32:36' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE wallet
    SET wallet.energy = wallet.energy + '28'
    WHERE wallet.player_id = '2' AND wallet.universe_id = '2'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
