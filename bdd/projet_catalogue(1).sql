-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2023 at 01:48 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_catalogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `l_id` int NOT NULL,
  `user_id` int NOT NULL,
  `log_description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `log_pokemon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `log_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`l_id`, `user_id`, `log_description`, `log_pokemon`, `log_date`) VALUES
(37, 8, ' a ajouté le Pokémon ', 'Bulbizarre', '2023-06-14 11:30:44'),
(38, 8, ' a modifié le Pokémon ', 'Bulbizarre', '2023-06-14 11:45:16'),
(39, 8, ' a modifié le Pokémon ', 'Bulbizarre', '2023-06-14 11:45:42'),
(42, 8, ' a ajouté le Pokémon ', 'Dracaufeu', '2023-06-14 12:25:21'),
(43, 8, ' a ajouté le Pokémon ', 'Carapuce', '2023-06-14 12:26:18'),
(44, 8, ' a ajouté le Pokémon ', 'Carabaffe', '2023-06-14 12:26:55'),
(45, 8, ' a ajouté le Pokémon ', 'Tortank', '2023-06-14 12:27:33'),
(46, 8, ' a ajouté le Pokémon ', 'Chenipan', '2023-06-14 12:28:49'),
(47, 8, ' a ajouté le Pokémon ', 'Pikachu', '2023-06-14 12:29:44'),
(48, 8, ' a ajouté le Pokémon ', 'Arbok', '2023-06-14 12:30:38'),
(49, 8, ' a ajouté le Pokémon ', 'Ponyta', '2023-06-14 12:32:05'),
(50, 8, ' a ajouté le Pokémon ', 'Grolem', '2023-06-14 12:33:08'),
(51, 8, ' a modifié le Pokémon ', 'Reptincel', '2023-06-14 12:51:54'),
(52, 10, ' a ajouté le Pokémon ', 'Chrysacier', '2023-06-15 12:56:46'),
(53, 10, ' a ajouté le Pokémon ', 'Papilusion', '2023-06-15 12:56:51'),
(54, 10, ' a ajouté le Pokémon ', 'Aspicot', '2023-06-15 12:56:58'),
(55, 10, ' a ajouté le Pokémon ', 'Coconfort', '2023-06-15 12:57:04'),
(56, 10, ' a ajouté le Pokémon ', 'Dardargnan', '2023-06-15 12:57:09'),
(57, 10, ' a ajouté le Pokémon ', 'Roucool', '2023-06-15 12:57:15'),
(58, 10, ' a ajouté le Pokémon ', 'Roucoups', '2023-06-15 12:57:23'),
(59, 10, ' a ajouté le Pokémon ', 'Roucarnage', '2023-06-15 12:57:29'),
(60, 10, ' a ajouté le Pokémon ', 'Rattata', '2023-06-15 13:08:15'),
(61, 10, ' a ajouté le Pokémon ', 'Rattatac', '2023-06-15 13:08:27'),
(62, 10, ' a ajouté le Pokémon ', 'Piafabec', '2023-06-15 13:08:38'),
(63, 10, ' a ajouté le Pokémon ', 'Rapasdepic', '2023-06-15 13:08:50'),
(64, 10, ' a ajouté le Pokémon ', 'Abo', '2023-06-15 13:09:06'),
(65, 10, ' a ajouté le Pokémon ', 'Raichu', '2023-06-15 13:32:59'),
(66, 10, ' a ajouté le Pokémon ', 'Sabelette', '2023-06-15 13:33:09'),
(67, 10, ' a ajouté le Pokémon ', 'Sablaireau', '2023-06-15 13:33:20'),
(68, 10, ' a ajouté le Pokémon ', 'Nidoran♀', '2023-06-15 13:33:33'),
(69, 10, ' a ajouté le Pokémon ', 'Nidorina', '2023-06-15 13:33:44'),
(70, 10, ' a ajouté le Pokémon ', 'Nidoqueen', '2023-06-15 13:33:50'),
(71, 10, ' a ajouté le Pokémon ', 'Nidoran♂', '2023-06-15 13:34:00'),
(72, 10, ' a ajouté le Pokémon ', 'Nidoking', '2023-06-15 13:34:11'),
(73, 10, ' a ajouté le Pokémon ', 'Mélofée', '2023-06-15 13:34:22'),
(74, 10, ' a ajouté le Pokémon ', 'Mélodelfe', '2023-06-15 13:34:33'),
(75, 10, ' a ajouté le Pokémon ', 'Goupix', '2023-06-15 13:34:50'),
(76, 10, ' a ajouté le Pokémon ', 'Feunard', '2023-06-15 13:35:01'),
(77, 10, ' a ajouté le Pokémon ', 'Rondoudou', '2023-06-15 13:35:07'),
(78, 10, ' a ajouté le Pokémon ', 'Grodoudou', '2023-06-15 13:35:14'),
(79, 10, ' a ajouté le Pokémon ', 'Nosferapti', '2023-06-15 13:35:20'),
(80, 10, ' a ajouté le Pokémon ', 'Nosferalto', '2023-06-15 13:35:27'),
(81, 10, ' a ajouté le Pokémon ', 'Mystherbe', '2023-06-15 13:35:38'),
(82, 10, ' a ajouté le Pokémon ', 'Ortide', '2023-06-15 13:35:50'),
(83, 10, ' a ajouté le Pokémon ', 'Rafflesia', '2023-06-15 13:36:00'),
(84, 10, ' a ajouté le Pokémon ', 'Paras', '2023-06-15 13:36:13'),
(85, 10, ' a ajouté le Pokémon ', 'Parasect', '2023-06-15 13:36:25'),
(86, 10, ' a ajouté le Pokémon ', 'Mimitoss', '2023-06-15 13:36:38'),
(87, 10, ' a ajouté le Pokémon ', 'Aéromite', '2023-06-15 13:36:49'),
(88, 10, ' a ajouté le Pokémon ', 'Triopikeur', '2023-06-15 13:37:07'),
(89, 10, ' a ajouté le Pokémon ', 'Miaouss', '2023-06-15 13:37:24'),
(90, 10, ' a ajouté le Pokémon ', 'Psykokwak', '2023-06-15 13:37:44'),
(91, 10, ' a ajouté le Pokémon ', 'Férosinge', '2023-06-15 13:37:59'),
(92, 10, ' a ajouté le Pokémon ', 'Colossinge', '2023-06-15 13:38:11'),
(93, 10, ' a ajouté le Pokémon ', 'Caninos', '2023-06-15 13:38:22'),
(94, 10, ' a ajouté le Pokémon ', 'Ptitard', '2023-06-15 13:38:41'),
(95, 10, ' a ajouté le Pokémon ', 'Têtarte', '2023-06-15 13:38:55'),
(96, 10, ' a ajouté le Pokémon ', 'Tartard', '2023-06-15 13:39:05'),
(97, 10, ' a ajouté le Pokémon ', 'Abra', '2023-06-15 13:39:16'),
(98, 10, ' a ajouté le Pokémon ', 'Kadabra', '2023-06-15 13:39:27'),
(99, 10, ' a ajouté le Pokémon ', 'Alakazam', '2023-06-15 13:39:38'),
(100, 10, ' a ajouté le Pokémon ', 'Machoc', '2023-06-15 13:39:49'),
(101, 10, ' a ajouté le Pokémon ', 'Machopeur', '2023-06-15 13:39:59'),
(102, 10, ' a ajouté le Pokémon ', 'Mackogneur', '2023-06-15 13:40:11'),
(103, 10, ' a ajouté le Pokémon ', 'Chétiflor', '2023-06-15 13:40:17'),
(104, 10, ' a ajouté le Pokémon ', 'Boustiflor', '2023-06-15 13:40:22'),
(105, 10, ' a ajouté le Pokémon ', 'Empiflor', '2023-06-15 13:40:29'),
(106, 10, ' a ajouté le Pokémon ', 'Tentacool', '2023-06-15 13:40:40'),
(107, 10, ' a ajouté le Pokémon ', 'Tentacruel', '2023-06-15 13:40:50'),
(108, 10, ' a ajouté le Pokémon ', 'Racaillou', '2023-06-15 13:40:58'),
(109, 10, ' a ajouté le Pokémon ', 'Gravalanch', '2023-06-15 13:41:06'),
(110, 10, ' a ajouté le Pokémon ', 'Galopa', '2023-06-15 13:41:40'),
(111, 10, ' a ajouté le Pokémon ', 'Ramoloss', '2023-06-15 13:41:58'),
(112, 10, ' a ajouté le Pokémon ', 'Flagadoss', '2023-06-15 13:42:16'),
(113, 10, ' a ajouté le Pokémon ', 'Magnéti', '2023-06-15 13:42:24'),
(114, 10, ' a ajouté le Pokémon ', 'Magnéton', '2023-06-15 13:42:32'),
(115, 10, ' a ajouté le Pokémon ', 'Canarticho', '2023-06-15 13:42:43'),
(116, 10, ' a ajouté le Pokémon ', 'Doduo', '2023-06-15 13:42:56'),
(117, 10, ' a ajouté le Pokémon ', 'Dodrio', '2023-06-15 13:43:09'),
(118, 10, ' a ajouté le Pokémon ', 'Otaria', '2023-06-15 13:43:27'),
(119, 10, ' a ajouté le Pokémon ', 'Lamantine', '2023-06-15 13:43:40'),
(120, 10, ' a ajouté le Pokémon ', 'Tadmorv', '2023-06-15 13:43:53'),
(121, 10, ' a ajouté le Pokémon ', 'Grotadmorv', '2023-06-15 13:44:06'),
(122, 10, ' a ajouté le Pokémon ', 'Kokiyas', '2023-06-15 13:44:24'),
(123, 10, ' a ajouté le Pokémon ', 'Crustabri', '2023-06-15 13:44:37'),
(124, 10, ' a ajouté le Pokémon ', 'Fantominus', '2023-06-15 13:44:43'),
(125, 10, ' a ajouté le Pokémon ', 'Spectrum', '2023-06-15 13:44:50'),
(126, 10, ' a ajouté le Pokémon ', 'Ectoplasma', '2023-06-15 13:44:57'),
(127, 10, ' a ajouté le Pokémon ', 'Onix', '2023-06-15 13:45:08'),
(128, 10, ' a ajouté le Pokémon ', 'Soporifik', '2023-06-15 13:45:24'),
(129, 10, ' a ajouté le Pokémon ', 'Hypnomade', '2023-06-15 13:45:41'),
(130, 10, ' a ajouté le Pokémon ', 'Krabby', '2023-06-15 13:45:58'),
(131, 10, ' a ajouté le Pokémon ', 'Krabboss', '2023-06-15 13:46:14'),
(132, 10, ' a ajouté le Pokémon ', 'Voltorbe', '2023-06-15 13:46:26'),
(133, 10, ' a ajouté le Pokémon ', 'Électrode', '2023-06-15 13:46:38'),
(134, 10, ' a ajouté le Pokémon ', 'Noeunoeuf', '2023-06-15 13:46:49'),
(135, 10, ' a ajouté le Pokémon ', 'Noadkoko', '2023-06-15 13:47:00'),
(136, 10, ' a ajouté le Pokémon ', 'Osselait', '2023-06-15 13:47:17'),
(137, 10, ' a ajouté le Pokémon ', 'Ossatueur', '2023-06-15 13:47:28'),
(138, 10, ' a ajouté le Pokémon ', 'Kicklee', '2023-06-15 13:47:50'),
(139, 10, ' a ajouté le Pokémon ', 'Tygnon', '2023-06-15 13:48:12'),
(140, 10, ' a ajouté le Pokémon ', 'Excelangue', '2023-06-15 13:48:28'),
(141, 10, ' a ajouté le Pokémon ', 'Smogo', '2023-06-15 13:48:44'),
(142, 10, ' a ajouté le Pokémon ', 'Smogogo', '2023-06-15 13:48:54'),
(143, 10, ' a ajouté le Pokémon ', 'Rhinocorne', '2023-06-15 13:49:01'),
(144, 10, ' a ajouté le Pokémon ', 'Rhinoféros', '2023-06-15 13:49:08'),
(145, 10, ' a ajouté le Pokémon ', 'Leveinard', '2023-06-15 13:49:20'),
(146, 10, ' a ajouté le Pokémon ', 'Saquedeneu', '2023-06-15 13:49:37'),
(147, 10, ' a ajouté le Pokémon ', 'Kangourex', '2023-06-15 13:49:59'),
(148, 10, ' a ajouté le Pokémon ', 'Hypotrempe', '2023-06-15 13:50:11'),
(149, 10, ' a ajouté le Pokémon ', 'Hypocéan', '2023-06-15 13:50:23'),
(150, 10, ' a ajouté le Pokémon ', 'Poissirène', '2023-06-15 13:50:39'),
(151, 10, ' a ajouté le Pokémon ', 'Poissoroy', '2023-06-15 13:50:56'),
(152, 10, ' a ajouté le Pokémon ', 'Stari', '2023-06-15 13:51:11'),
(153, 10, ' a ajouté le Pokémon ', 'Staross', '2023-06-15 13:51:23'),
(154, 10, ' a ajouté le Pokémon ', 'Insécateur', '2023-06-16 11:08:46'),
(155, 10, ' a ajouté le Pokémon ', 'Lippoutou', '2023-06-16 11:08:59'),
(156, 10, ' a ajouté le Pokémon ', 'Élektek', '2023-06-16 11:09:12'),
(157, 10, ' a ajouté le Pokémon ', 'Magmar', '2023-06-16 11:09:25'),
(158, 10, ' a ajouté le Pokémon ', 'Scarabrute', '2023-06-16 11:09:43'),
(159, 10, ' a ajouté le Pokémon ', 'Tauros', '2023-06-16 11:10:01'),
(160, 10, ' a ajouté le Pokémon ', 'Magicarpe', '2023-06-16 11:10:17'),
(161, 10, ' a ajouté le Pokémon ', 'Léviator', '2023-06-16 11:10:30'),
(162, 10, ' a ajouté le Pokémon ', 'Lokhlass', '2023-06-16 11:10:48'),
(163, 10, ' a ajouté le Pokémon ', 'Métamorph', '2023-06-16 11:11:09'),
(164, 10, ' a ajouté le Pokémon ', 'Évoli', '2023-06-16 11:11:29'),
(165, 10, ' a ajouté le Pokémon ', 'Aquali', '2023-06-16 11:11:53'),
(166, 10, ' a ajouté le Pokémon ', 'Voltali', '2023-06-16 11:12:17'),
(167, 10, ' a ajouté le Pokémon ', 'Pyroli', '2023-06-16 11:12:41'),
(168, 10, ' a ajouté le Pokémon ', 'Porygon', '2023-06-16 11:12:53'),
(169, 10, ' a ajouté le Pokémon ', 'Amonita', '2023-06-16 11:13:06'),
(170, 10, ' a ajouté le Pokémon ', 'Amonistar', '2023-06-16 11:13:17'),
(171, 10, ' a ajouté le Pokémon ', 'Kabuto', '2023-06-16 11:13:29'),
(172, 10, ' a ajouté le Pokémon ', 'Kabutops', '2023-06-16 11:13:40'),
(173, 10, ' a ajouté le Pokémon ', 'Ptéra', '2023-06-16 11:13:56'),
(174, 10, ' a ajouté le Pokémon ', 'Ronflex', '2023-06-16 11:14:12'),
(175, 10, ' a ajouté le Pokémon ', 'Artikodin', '2023-06-16 11:14:29'),
(176, 10, ' a ajouté le Pokémon ', 'Électhor', '2023-06-16 11:14:45'),
(177, 10, ' a ajouté le Pokémon ', 'Sulfura', '2023-06-16 11:15:02'),
(178, 10, ' a ajouté le Pokémon ', 'Minidraco', '2023-06-16 11:17:08'),
(179, 10, ' a ajouté le Pokémon ', 'Draco', '2023-06-16 11:17:19'),
(180, 10, ' a ajouté le Pokémon ', 'Dracolosse', '2023-06-16 11:17:24'),
(181, 10, ' a ajouté le Pokémon ', 'Mewtwo', '2023-06-16 11:18:27'),
(182, 10, ' a ajouté le Pokémon ', 'Mew', '2023-06-16 12:38:03'),
(183, 10, ' a ajouté le Pokémon ', 'Germignon', '2023-06-16 12:38:15'),
(184, 10, ' a ajouté le Pokémon ', 'Macronium', '2023-06-16 12:38:28'),
(185, 10, ' a ajouté le Pokémon ', 'Méganium', '2023-06-16 12:38:39'),
(186, 10, ' a ajouté le Pokémon ', 'Héricendre', '2023-06-16 12:38:52'),
(187, 10, ' a ajouté le Pokémon ', 'Feurisson', '2023-06-16 12:39:04'),
(188, 10, ' a ajouté le Pokémon ', 'Typhlosion', '2023-06-16 12:39:11'),
(189, 10, ' a ajouté le Pokémon ', 'Kaiminus', '2023-06-16 12:39:24'),
(190, 10, ' a ajouté le Pokémon ', 'Crocrodil', '2023-06-16 12:39:36'),
(191, 10, ' a ajouté le Pokémon ', 'Aligatueur', '2023-06-16 12:39:48'),
(192, 10, ' a ajouté le Pokémon ', 'Fouinette', '2023-06-16 12:40:03'),
(193, 10, ' a ajouté le Pokémon ', 'Fouinar', '2023-06-16 12:40:21'),
(194, 10, ' a ajouté le Pokémon ', 'Hoothoot', '2023-06-16 12:40:33'),
(195, 10, ' a ajouté le Pokémon ', 'Noarfang', '2023-06-16 12:40:45'),
(196, 10, ' a ajouté le Pokémon ', 'Coxy', '2023-06-16 12:40:56'),
(197, 10, ' a ajouté le Pokémon ', 'Coxyclaque', '2023-06-16 12:41:08'),
(198, 10, ' a ajouté le Pokémon ', 'Mimigal', '2023-06-16 12:41:20'),
(199, 10, ' a ajouté le Pokémon ', 'Migalos', '2023-06-16 12:41:33'),
(200, 10, ' a ajouté le Pokémon ', 'Nostenfer', '2023-06-16 12:41:40'),
(201, 10, ' a ajouté le Pokémon ', 'Loupio', '2023-06-16 12:41:52'),
(202, 10, ' a ajouté le Pokémon ', 'Lanturn', '2023-06-16 12:42:04'),
(203, 10, ' a ajouté le Pokémon ', 'Pichu', '2023-06-16 12:42:16'),
(204, 10, ' a ajouté le Pokémon ', 'Mélo', '2023-06-16 12:42:28'),
(205, 10, ' a ajouté le Pokémon ', 'Toudoudou', '2023-06-16 12:42:36'),
(206, 10, ' a ajouté le Pokémon ', 'Togepi', '2023-06-16 12:42:49'),
(207, 10, ' a ajouté le Pokémon ', 'Togetic', '2023-06-16 12:42:55'),
(208, 10, ' a ajouté le Pokémon ', 'Natu', '2023-06-16 12:43:08'),
(209, 10, ' a ajouté le Pokémon ', 'Xatu', '2023-06-16 12:43:20'),
(210, 10, ' a ajouté le Pokémon ', 'Wattouat', '2023-06-16 12:43:33'),
(211, 10, ' a ajouté le Pokémon ', 'Lainergie', '2023-06-16 12:43:45'),
(212, 10, ' a ajouté le Pokémon ', 'Pharamp', '2023-06-16 12:43:52'),
(213, 10, ' a ajouté le Pokémon ', 'Joliflor', '2023-06-16 12:44:12'),
(214, 10, ' a ajouté le Pokémon ', 'Marill', '2023-06-16 12:44:20'),
(215, 10, ' a ajouté le Pokémon ', 'Azumarill', '2023-06-16 12:44:27'),
(216, 10, ' a ajouté le Pokémon ', 'Simularbre', '2023-06-16 12:44:43'),
(217, 10, ' a ajouté le Pokémon ', 'Tarpaud', '2023-06-16 12:45:00'),
(218, 10, ' a ajouté le Pokémon ', 'Granivol', '2023-06-16 12:45:08'),
(219, 10, ' a ajouté le Pokémon ', 'Floravol', '2023-06-16 12:45:15'),
(220, 10, ' a ajouté le Pokémon ', 'Cotovol', '2023-06-16 12:45:22'),
(221, 10, ' a ajouté le Pokémon ', 'Capumain', '2023-06-16 12:45:39'),
(222, 10, ' a ajouté le Pokémon ', 'Tournegrin', '2023-06-16 12:45:56'),
(223, 10, ' a ajouté le Pokémon ', 'Héliatronc', '2023-06-16 12:46:13'),
(224, 10, ' a ajouté le Pokémon ', 'Yanma', '2023-06-16 12:46:25'),
(225, 10, ' a ajouté le Pokémon ', 'Axoloto', '2023-06-16 12:46:36'),
(226, 10, ' a ajouté le Pokémon ', 'Maraiste', '2023-06-16 12:46:48'),
(227, 10, ' a ajouté le Pokémon ', 'Mentali', '2023-06-16 12:47:10'),
(228, 10, ' a ajouté le Pokémon ', 'Noctali', '2023-06-16 12:47:31'),
(229, 10, ' a ajouté le Pokémon ', 'Cornèbre', '2023-06-16 12:47:43'),
(230, 10, ' a ajouté le Pokémon ', 'Roigada', '2023-06-16 12:48:01'),
(231, 10, ' a ajouté le Pokémon ', 'Feuforêve', '2023-06-16 12:48:18'),
(232, 10, ' a ajouté le Pokémon ', 'Zarbi', '2023-06-16 12:48:40'),
(233, 10, ' a ajouté le Pokémon ', 'Qulbutoké', '2023-06-16 12:48:58'),
(234, 10, ' a ajouté le Pokémon ', 'Girafarig', '2023-06-16 12:49:11'),
(235, 10, ' a ajouté le Pokémon ', 'Pomdepik', '2023-06-16 12:49:28'),
(236, 10, ' a ajouté le Pokémon ', 'Foretress', '2023-06-16 12:49:41'),
(237, 10, ' a ajouté le Pokémon ', 'Insolourdo', '2023-06-16 12:49:58'),
(238, 10, ' a ajouté le Pokémon ', 'Scorplane', '2023-06-16 12:50:11'),
(239, 10, ' a ajouté le Pokémon ', 'Steelix', '2023-06-16 12:50:23'),
(240, 10, ' a ajouté le Pokémon ', 'Snubbull', '2023-06-16 12:50:41'),
(241, 10, ' a ajouté le Pokémon ', 'Granbull', '2023-06-16 12:50:58'),
(242, 10, ' a ajouté le Pokémon ', 'Qwilfish', '2023-06-16 12:51:10'),
(243, 10, ' a ajouté le Pokémon ', 'Cizayox', '2023-06-16 12:51:28'),
(244, 10, ' a ajouté le Pokémon ', 'Caratroc', '2023-06-16 12:51:45'),
(245, 10, ' a ajouté le Pokémon ', 'Scarhino', '2023-06-16 12:52:03'),
(246, 10, ' a ajouté le Pokémon ', 'Farfuret', '2023-06-16 12:52:15'),
(247, 10, ' a ajouté le Pokémon ', 'Teddiursa', '2023-06-16 12:52:27'),
(248, 10, ' a ajouté le Pokémon ', 'Ursaring', '2023-06-16 12:52:39'),
(249, 10, ' a ajouté le Pokémon ', 'Limagma', '2023-06-16 12:52:57'),
(250, 10, ' a ajouté le Pokémon ', 'Volcaropod', '2023-06-16 12:53:10'),
(251, 10, ' a ajouté le Pokémon ', 'Marcacrin', '2023-06-16 12:53:17'),
(252, 10, ' a ajouté le Pokémon ', 'Cochignon', '2023-06-16 12:53:25'),
(253, 10, ' a ajouté le Pokémon ', 'Corayon', '2023-06-16 12:53:37'),
(254, 10, ' a ajouté le Pokémon ', 'Rémoraid', '2023-06-16 12:53:55'),
(255, 10, ' a ajouté le Pokémon ', 'Octillery', '2023-06-16 12:54:13'),
(256, 10, ' a ajouté le Pokémon ', 'Cadoizo', '2023-06-16 12:54:32'),
(257, 10, ' a ajouté le Pokémon ', 'Démanta', '2023-06-16 12:54:46'),
(258, 10, ' a ajouté le Pokémon ', 'Airmure', '2023-06-16 12:55:05'),
(259, 10, ' a ajouté le Pokémon ', 'Malosse', '2023-06-16 12:55:17'),
(260, 10, ' a ajouté le Pokémon ', 'Démolosse', '2023-06-16 12:55:30'),
(261, 10, ' a ajouté le Pokémon ', 'Hyporoi', '2023-06-16 12:55:37'),
(262, 10, ' a ajouté le Pokémon ', 'Phanpy', '2023-06-16 12:55:55'),
(263, 10, ' a ajouté le Pokémon ', 'Donphan', '2023-06-16 12:56:13'),
(264, 10, ' a ajouté le Pokémon ', 'Porygon2', '2023-06-16 12:56:25'),
(265, 10, ' a ajouté le Pokémon ', 'Cerfrousse', '2023-06-16 12:56:42'),
(266, 10, ' a ajouté le Pokémon ', 'Queulorior', '2023-06-16 12:57:03'),
(267, 10, ' a ajouté le Pokémon ', 'Debugant', '2023-06-16 12:57:25'),
(268, 10, ' a ajouté le Pokémon ', 'Kapoera', '2023-06-16 12:57:48'),
(269, 10, ' a ajouté le Pokémon ', 'Lippouti', '2023-06-16 12:58:03'),
(270, 10, ' a ajouté le Pokémon ', 'Élekid', '2023-06-16 12:58:18'),
(271, 10, ' a ajouté le Pokémon ', 'Magby', '2023-06-16 12:58:31'),
(272, 10, ' a ajouté le Pokémon ', 'Écrémeuh', '2023-06-16 12:58:56'),
(273, 10, ' a ajouté le Pokémon ', 'Leuphorie', '2023-06-16 12:59:11'),
(274, 10, ' a ajouté le Pokémon ', 'Raikou', '2023-06-16 12:59:35'),
(275, 10, ' a ajouté le Pokémon ', 'Entei', '2023-06-16 13:00:09'),
(276, 10, ' a ajouté le Pokémon ', 'Suicune', '2023-06-16 13:00:37'),
(277, 10, ' a ajouté le Pokémon ', 'Embrylex', '2023-06-16 13:00:47'),
(278, 10, ' a ajouté le Pokémon ', 'Ymphect', '2023-06-16 13:01:00'),
(279, 10, ' a ajouté le Pokémon ', 'Tyranocif', '2023-06-16 13:01:11'),
(280, 10, ' a ajouté le Pokémon ', 'Lugia', '2023-06-16 13:01:32'),
(281, 10, ' a ajouté le Pokémon ', 'Ho-Oh', '2023-06-16 13:01:53'),
(282, 10, ' a ajouté le Pokémon ', 'Celebi', '2023-06-16 13:02:15'),
(283, 10, ' a ajouté le Pokémon ', 'Arcko', '2023-06-16 13:02:31'),
(284, 10, ' a ajouté le Pokémon ', 'Massko', '2023-06-16 13:02:48'),
(285, 10, ' a ajouté le Pokémon ', 'Jungko', '2023-06-16 13:03:01'),
(286, 10, ' a ajouté le Pokémon ', 'Poussifeu', '2023-06-16 13:03:18'),
(287, 10, ' a ajouté le Pokémon ', 'Galifeu', '2023-06-16 13:03:30'),
(288, 10, ' a ajouté le Pokémon ', 'Braségali', '2023-06-16 13:03:41'),
(289, 10, ' a ajouté le Pokémon ', 'Gobou', '2023-06-16 13:03:57'),
(290, 10, ' a ajouté le Pokémon ', 'Flobio', '2023-06-16 13:04:08'),
(291, 10, ' a ajouté le Pokémon ', 'Laggron', '2023-06-16 13:04:21'),
(292, 10, ' a ajouté le Pokémon ', 'Medhyèna', '2023-06-16 13:04:42'),
(293, 10, ' a ajouté le Pokémon ', 'Grahyèna', '2023-06-16 13:05:03'),
(294, 10, ' a ajouté le Pokémon ', 'Zigzaton', '2023-06-16 13:05:19'),
(295, 10, ' a ajouté le Pokémon ', 'Linéon', '2023-06-16 13:05:34'),
(296, 10, ' a ajouté le Pokémon ', 'Chenipotte', '2023-06-16 13:06:01'),
(297, 10, ' a ajouté le Pokémon ', 'Armulys', '2023-06-16 13:06:26'),
(298, 10, ' a ajouté le Pokémon ', 'Charmillon', '2023-06-16 13:06:47'),
(299, 10, ' a ajouté le Pokémon ', 'Blindalys', '2023-06-16 13:07:14'),
(300, 10, ' a ajouté le Pokémon ', 'Papinox', '2023-06-16 13:07:36'),
(301, 10, ' a ajouté le Pokémon ', 'Lombre', '2023-06-16 13:07:56'),
(302, 10, ' a ajouté le Pokémon ', 'Ludicolo', '2023-06-16 13:08:08'),
(303, 10, ' a ajouté le Pokémon ', 'Grainipiot', '2023-06-16 13:08:23'),
(304, 10, ' a ajouté le Pokémon ', 'Pifeuil', '2023-06-16 13:08:33'),
(305, 10, ' a ajouté le Pokémon ', 'Tengalice', '2023-06-16 13:08:45'),
(306, 10, ' a ajouté le Pokémon ', 'Nirondelle', '2023-06-16 13:09:00'),
(307, 10, ' a ajouté le Pokémon ', 'Hélédelle', '2023-06-16 13:09:15'),
(308, 10, ' a ajouté le Pokémon ', 'Bekipan', '2023-06-16 13:09:40'),
(309, 10, ' a ajouté le Pokémon ', 'Tarsal', '2023-06-16 13:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `pokemon`
--

CREATE TABLE `pokemon` (
  `p_id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `p_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `taille` varchar(255) NOT NULL,
  `p_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `p_type-2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `poids` varchar(255) NOT NULL,
  `evolutions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pokemon`
--

INSERT INTO `pokemon` (`p_id`, `nom`, `numero`, `p_description`, `taille`, `p_type`, `p_type-2`, `poids`, `evolutions`, `created_by`, `created_on`) VALUES
(2, 'Salamèche', '0004', 'Il préfère ce qui est chaud. En cas de pluie, de la vapeur se forme autour de sa queue.\r\n\r\n', '0.6', 'feu', '', '8.5', 'Salamèche,Reptincel,Dracaufeu', '8', '2023-06-05 07:23:32'),
(4, 'Florizarre', '0003', 'Sa plante donne une grosse fleur quand elle absorbe les rayons du soleil. Il est toujours à la recherche des endroits les plus ensoleillés.', '2.0', 'plante', 'poison', '100', 'Herbizarre,Florizarre,', '8', '2023-06-07 07:23:32'),
(11, 'Herbizarre', '0002', 'Son bulbe dorsal est devenu si gros qu’il ne peut plus se tenir sur ses pattes postérieures. ', '1', 'plante', 'poison', '13', 'Herbizarre,Florizarre,', '8', '2023-06-12 09:25:51'),
(26, 'Reptincel', '0005', 'Il est très brutal. En combat, il se sert de ses griffes acérées et de sa queue enflammée pour mettre en pièces ses adversaires. ', '1.1', 'feu', '', '19', 'Salamèche,', '8', '2023-06-13 14:05:50'),
(28, 'Bulbizarre', '0001', 'Il y a une graine sur son dos depuis sa naissance. Elle grossit un peu chaque jour. ', '0.7', 'plante', 'poison', '6.9', 'Bulbizarre,Herbizarre,Florizarre', '8', '2023-06-14 11:30:44'),
(30, 'Dracaufeu', '0006', 'On raconte que plus un Dracaufeu a vécu de combats difficiles, plus sa flamme est brûlante. ', '1.7', 'feu', 'vol', '90.5', 'Salamèche, Reptincel, Dracaufeu', '8', '2023-06-14 12:25:21'),
(31, 'Carapuce', '0007', 'Quand il rentre son cou dans sa carapace, il peut projeter de l’eau à haute pression. ', '0.5', 'eau', '', '9', 'Carapuce,Carabaffe,Tortank', '8', '2023-06-14 12:26:18'),
(32, 'Carabaffe', '0008', 'Il est considéré comme un symbole de longévité. On reconnaît les spécimens les plus âgés à la mousse qui pousse sur leur carapace. ', '1', 'eau', '', '22.5', 'Carapuce,Carabaffe,Tortank', '8', '2023-06-14 12:26:55'),
(33, 'Tortank', '0009', 'Il écrase ses adversaires de tout son poids pour leur faire perdre connaissance. Il rentre dans sa carapace s’il se sent en danger. ', '1.6', 'eau', '', '85.5', 'Carapuce,Carabaffe,Tortank', '8', '2023-06-14 12:27:33'),
(34, 'Chenipan', '0010', 'Pour se protéger, il émet par ses antennes une odeur nauséabonde qui fait fuir ses ennemis. ', '0.3', 'insecte', '', '2.9', 'Chenipan,Chrysacier,Papilusion', '8', '2023-06-14 12:28:49'),
(35, 'Pikachu', '0025', 'Quand il s’énerve, il libère instantanément l’énergie emmagasinée dans les poches de ses joues. ', '0.4', 'electrik', '', '6', 'Pichu,Pikachu,Raichu', '8', '2023-06-14 12:29:44'),
(36, 'Arbok', '0024', 'Des études ont révélé que les marques effrayantes de son corps pouvaient former six motifs différents. ', '3.5', 'poison', '', '65', 'Abo,Arbok', '8', '2023-06-14 12:30:38'),
(37, 'Ponyta', '0077', 'Sa queue et sa crinière de feu splendides poussent une heure à peine après sa naissance. ', '1', 'feu', '', '30', 'Ponyta,Galopa', '8', '2023-06-14 12:32:05'),
(38, 'Grolem', '0076', 'Juste après la mue, son corps est blanc et tendre. Au contact de l’air, sa peau se solidifie et forme une armure. ', '1.4', 'roche', 'sol', '300', 'Racaillou,Gravalanch,Grolem', '8', '2023-06-14 12:33:08'),
(39, 'Chrysacier', '0011', 'En attendant sa prochaine évolution, il ne peut que durcir sa carapace et rester immobile pour éviter de se faire attaquer.', '0,7', 'insecte', '', '9,9', 'Chenipan,Chrysacier,Papilusion', '10', '2023-06-15 12:56:46'),
(40, 'Papilusion', '0012', 'Ce Pokémon raffole du nectar des fleurs. Il est capable de dénicher des champs fleuris même s’ils n’ont qu’une quantité infime de pollen.', '1,1', 'insecte', 'vol', '32,0', 'Chenipan,Chrysacier,Papilusion', '10', '2023-06-15 12:56:51'),
(41, 'Aspicot', '0013', 'L’aiguillon sur son front est très pointu. Il se cache dans les bois et les hautes herbes, où il se gave de feuilles.', '0,3', 'insecte', 'poison', '3,2', 'Aspicot,Coconfort,Dardargnan', '10', '2023-06-15 12:56:58'),
(42, 'Coconfort', '0014', 'Il peut à peine bouger. Quand il est menacé, il sort parfois son aiguillon pour empoisonner ses ennemis.', '0,6', 'insecte', 'poison', '10,0', 'Aspicot,Coconfort,Dardargnan', '10', '2023-06-15 12:57:04'),
(43, 'Dardargnan', '0015', 'Il se sert de ses trois aiguillons empoisonnés situés sur les pattes avant et l’abdomen pour attaquer sans relâche ses adversaires.', '1,0', 'insecte', 'poison', '29,5', 'Aspicot,Coconfort,Dardargnan', '10', '2023-06-15 12:57:09'),
(44, 'Roucool', '0016', 'De nature très docile, il préfère projeter du sable pour se défendre plutôt que contre-attaquer.', '0,3', 'normal', 'vol', '1,8', 'Roucool,Roucoups,Roucarnage', '10', '2023-06-15 12:57:15'),
(45, 'Roucoups', '0017', 'Ce Pokémon est très endurant. Il survole en permanence son territoire pour chasser.', '1,1', 'normal', 'vol', '30,0', 'Roucool,Roucoups,Roucarnage', '10', '2023-06-15 12:57:23'),
(46, 'Roucarnage', '0018', 'Ce Pokémon vole à Mach 2 quand il chasse. Ses grandes serres sont des armes redoutables.', '1,5', 'normal', 'vol', '39,5', 'Roucool,Roucoups,Roucarnage', '10', '2023-06-15 12:57:29'),
(47, 'Rattata', '0019', 'Il peut ronger n’importe quoi avec ses deux dents. Quand on en voit un, il y en a certainement 40 dans le coin.', '0,3', 'normal', '', '3,5', 'Rattata,Rattatac', '10', '2023-06-15 13:08:15'),
(48, 'Rattatac', '0020', 'Ses pattes arrière sont palmées. Il peut donc poursuivre sa proie dans les cours d’eau et les rivières.', '0,7', 'normal', '', '18,5', 'Rattata,Rattatac', '10', '2023-06-15 13:08:27'),
(49, 'Piafabec', '0021', 'Il est incapable de voler à haute altitude. Il se déplace très vite pour protéger son territoire.', '0,3', 'normal', 'vol', '2,0', 'Piafabec,Rapasdepic', '10', '2023-06-15 13:08:38'),
(50, 'Rapasdepic', '0022', 'Un Pokémon très ancien. S’il perçoit un danger, il fuit instantanément à haute altitude.', '1,2', 'normal', 'vol', '38,0', 'Piafabec,Rapasdepic', '10', '2023-06-15 13:08:50'),
(51, 'Abo', '0023', 'Plus il est âgé, plus son corps est long. La nuit, il s’enroule autour de branches d’arbres pour se reposer.', '2,0', 'poison', '', '6,9', 'Abo,Arbok', '10', '2023-06-15 13:09:06'),
(52, 'Raichu', '0026', 'Il se protège des décharges grâce à sa queue, qui dissipe l’électricité dans le sol.', '0,8', 'electrik', '', '30,0', 'Pichu,Pikachu,Raichu', '10', '2023-06-15 13:32:59'),
(53, 'Sabelette', '0027', 'Il aime se rouler dans le sable des zones désertiques pour se débarrasser des traces de terre et d’humidité qui lui collent à la peau.', '0,6', 'sol', '', '12,0', 'Sabelette,Sablaireau', '10', '2023-06-15 13:33:09'),
(54, 'Sablaireau', '0028', 'Plus son habitat est sec, plus ses épines dorsales deviennent dures et lisses.', '1,0', 'sol', '', '29,5', 'Sabelette,Sablaireau', '10', '2023-06-15 13:33:20'),
(55, 'Nidoran♀', '0029', 'Son odorat est plus développé que celui du mâle. Quand Nidoran♀ cherche à manger, il reste dans le sens du vent, qu’il détecte avec ses vibrisses.', '0,4', 'poison', '', '7,0', 'Nidoran♀,Nidorina,Nidoqueen', '10', '2023-06-15 13:33:33'),
(56, 'Nidorina', '0030', 'On pense que sa corne frontale s’est atrophiée pour lui permettre de nourrir ses petits sans les blesser.', '0,8', 'poison', '', '20,0', 'Nidoran♀,Nidorina,Nidoqueen', '10', '2023-06-15 13:33:44'),
(57, 'Nidoqueen', '0031', 'Il est plus doué pour se défendre que pour attaquer. Grâce à son blindage d’écailles, il protège ses petits de toute agression.', '1,3', 'poison', 'sol', '60,0', 'Nidoran♀,Nidorina,Nidoqueen', '10', '2023-06-15 13:33:50'),
(58, 'Nidoran♂', '0032', 'Sa corne frontale contient un puissant poison. Les grandes oreilles de ce Pokémon très prudent sont constamment dressées.', '0,5', 'poison', '', '9,0', 'Nidoran♂,Nidorino,Nidoking', '10', '2023-06-15 13:34:00'),
(59, 'Nidoking', '0034', 'Lorsqu’il s’énerve, il devient incontrôlable, mais il retrouve son calme face à Nidoqueen, sa compagne de longue date.', '1,4', 'poison', 'sol', '62,0', 'Nidoran♂,Nidorino,Nidoking', '10', '2023-06-15 13:34:11'),
(60, 'Mélofée', '0035', 'On dit que ceux qui voient danser un groupe de Mélofée sous la pleine lune connaîtront un grand bonheur.', '0,6', 'fee', '', '7,5', 'Mélo,Mélofée,Mélodelfe', '10', '2023-06-15 13:34:22'),
(61, 'Mélodelfe', '0036', 'Ce Pokémon s’apparente à une petite fée qui n’apparaît que rarement devant les humains. Il court se cacher dès qu’il ressent une présence.', '1,3', 'fee', '', '40,0', 'Mélo,Mélofée,Mélodelfe', '10', '2023-06-15 13:34:33'),
(62, 'Goupix', '0037', 'Quand il est jeune, ce Pokémon a six queues magnifiques. De nouvelles queues apparaissent tout au long de sa croissance.', '0,6', 'feu', '', '9,9', 'Goupix,Feunard', '10', '2023-06-15 13:34:50'),
(63, 'Feunard', '0038', 'On dit qu’il vit 1 000 ans et que chacune de ses queues a un pouvoir magique.', '1,1', 'feu', '', '19,9', 'Goupix,Feunard', '10', '2023-06-15 13:35:01'),
(64, 'Rondoudou', '0039', 'Quand ses grands yeux luisent, il chante une berceuse mystérieuse et agréable qui pousse ses ennemis à s’endormir.', '0,5', 'normal', 'fee', '5,5', 'Toudoudou,Rondoudou,Grodoudou', '10', '2023-06-15 13:35:07'),
(65, 'Grodoudou', '0040', 'Il a une très belle fourrure. Mieux vaut éviter de le mettre en colère, ou il gonflera avant d’attaquer de tout son corps.', '1,0', 'normal', 'fee', '12,0', 'Toudoudou,Rondoudou,Grodoudou', '10', '2023-06-15 13:35:14'),
(66, 'Nosferapti', '0041', 'Il sonde les environs en émettant des ultrasons avec sa bouche, et peut ainsi se frayer un chemin même dans les grottes les plus étroites.', '0,8', 'poison', 'vol', '7,5', 'Nosferapti,Nosferalto,Nostenfer', '10', '2023-06-15 13:35:20'),
(67, 'Nosferalto', '0042', 'Le sang des êtres vivants est son péché mignon. On dit qu’il partage parfois ce précieux breuvage avec ses congénères affamés.', '1,6', 'poison', 'vol', '55,0', 'Nosferapti,Nosferalto,Nostenfer', '10', '2023-06-15 13:35:27'),
(68, 'Mystherbe', '0043', 'Il ne bouge que lorsqu’il est exposé aux rayons de la lune. Il se déplace alors pour disséminer ses graines.', '0,5', 'plante', 'poison', '5,4', 'Mystherbe,Ortide', '10', '2023-06-15 13:35:38'),
(69, 'Ortide', '0044', 'Ses pistils sécrètent une odeur incroyablement fétide qui fait perdre connaissance à ses adversaires jusqu’à 2 km à la ronde.', '0,8', 'plante', 'poison', '8,6', 'Mystherbe,Ortide', '10', '2023-06-15 13:35:50'),
(70, 'Rafflesia', '0045', 'Il possède les plus gros pétales au monde, qui sèment d’épais nuages de pollen toxique à chacun de ses pas.', '1,2', 'plante', 'poison', '18,6', 'Mystherbe,Ortide', '10', '2023-06-15 13:36:00'),
(71, 'Paras', '0046', 'Il s’enfouit pour ronger des racines, mais ce sont les champignons sur son dos qui absorbent presque tous les nutriments.', '0,3', 'insecte', 'plante', '5,4', 'Paras,Parasect', '10', '2023-06-15 13:36:13'),
(72, 'Parasect', '0047', 'À force de voir son énergie aspirée, il semblerait que ce ne soit plus l’insecte qui réfléchisse, mais le champignon sur son dos.', '1,0', 'insecte', 'plante', '29,5', 'Paras,Parasect', '10', '2023-06-15 13:36:25'),
(73, 'Mimitoss', '0048', 'Son corps sécrète un poison redoutable. La nuit, il capture de petits Pokémon Insecte attirés par la lumière.', '1,0', 'insecte', 'poison', '30,0', 'Mimitoss,Aéromite', '10', '2023-06-15 13:36:38'),
(74, 'Aéromite', '0049', 'Ses ailes sont couvertes d’écailles poudreuses. À chaque battement d’ailes, il laisse tomber de la poudre hautement toxique.', '1,5', 'insecte', 'poison', '12,5', 'Mimitoss,Aéromite', '10', '2023-06-15 13:36:49'),
(75, 'Triopikeur', '0051', 'Ses trois têtes pilonnent le sol pour le rendre friable et ainsi faciliter l’excavation.', '0,7', 'sol', '', '33,3', 'Taupiqueur,Triopikeur', '10', '2023-06-15 13:37:07'),
(76, 'Miaouss', '0052', 'Il passe ses journées à dormir. La nuit venue, il patrouille sur son territoire, les yeux brillants.', '0,4', 'normal', '', '4,2', 'Miaouss,Persian', '10', '2023-06-15 13:37:24'),
(77, 'Psykokwak', '0054', 'Ce Pokémon a tout le temps la migraine. Quand la douleur devient trop intense, il se met à utiliser des pouvoirs mystérieux.', '0,8', 'eau', '', '19,6', 'Psykokwak,Akwakwak', '10', '2023-06-15 13:37:44'),
(78, 'Férosinge', '0056', 'Il vit en groupe au sommet des arbres. S’il perd ses congénères de vue, la solitude le rend furieux.', '0,5', 'combat', '', '28,0', 'Férosinge,Colossinge,Courrousinge', '10', '2023-06-15 13:37:59'),
(79, 'Colossinge', '0057', 'Il devient fou furieux s’il se sent observé et pourchasse tout être qui croise son regard.', '1,0', 'combat', '', '32,0', 'Férosinge,Colossinge,Courrousinge', '10', '2023-06-15 13:38:11'),
(80, 'Caninos', '0058', 'Courageux et fidèle, il se dresse vaillamment devant ses ennemis même s’ils sont plus puissants que lui.', '0,7', 'feu', '', '19,0', 'Caninos,Arcanin', '10', '2023-06-15 13:38:22'),
(81, 'Ptitard', '0060', 'Il est plus à l’aise dans l’eau que sur la terre ferme. Le motif de spirale sur son ventre est en fait une partie de ses organes visibles à travers la peau.', '0,6', 'eau', '', '12,4', 'Ptitard,Têtarte', '10', '2023-06-15 13:38:41'),
(82, 'Têtarte', '0061', 'Il suffit de fixer la spirale sur son ventre pour s’assoupir. On se sert parfois de lui à la place d’une berceuse pour endormir les enfants.', '1,0', 'eau', '', '20,0', 'Ptitard,Têtarte', '10', '2023-06-15 13:38:55'),
(83, 'Tartard', '0062', 'Cette véritable montagne de muscles peut se frayer un chemin même dans les eaux glaciales en éclatant la banquise avec ses bras robustes.', '1,3', 'eau', 'combat', '54,0', 'Ptitard,Têtarte', '10', '2023-06-15 13:39:05'),
(84, 'Abra', '0063', 'Le contenu de ses rêves influe sur les pouvoirs psychiques qu’il utilise dans son sommeil.', '0,9', 'psy', '', '19,5', 'Abra,Kadabra,Alakazam', '10', '2023-06-15 13:39:16'),
(85, 'Kadabra', '0064', 'Ses pouvoirs psychiques lui permettent de léviter en dormant. Il utilise alors sa queue très souple comme un oreiller.', '1,3', 'psy', '', '56,5', 'Abra,Kadabra,Alakazam', '10', '2023-06-15 13:39:27'),
(86, 'Alakazam', '0065', 'Doué d’une intelligence hors du commun, ce Pokémon serait capable de conserver tous ses souvenirs, de sa naissance jusqu’à sa mort.', '1,5', 'psy', '', '48,0', 'Abra,Kadabra,Alakazam', '10', '2023-06-15 13:39:37'),
(87, 'Machoc', '0066', 'Son corps est essentiellement composé de muscles. Même s’il fait la taille d’un petit enfant, il peut soulever 100 adultes avec ses bras.', '0,8', 'combat', '', '19,5', 'Machoc,Machopeur,Mackogneur', '10', '2023-06-15 13:39:49'),
(88, 'Machopeur', '0067', 'Son corps est si puissant qu’il lui faut une ceinture pour maîtriser sa force.', '1,5', 'combat', '', '70,5', 'Machoc,Machopeur,Mackogneur', '10', '2023-06-15 13:39:59'),
(89, 'Mackogneur', '0068', 'Ses quatre bras bougent si vite qu’on ne distingue pas leurs mouvements. Il est capable de porter mille coups en deux secondes.', '1,6', 'combat', '', '130,0', 'Machoc,Machopeur,Mackogneur', '10', '2023-06-15 13:40:11'),
(90, 'Chétiflor', '0069', 'Il préfère les endroits chauds et humides. Il capture les Pokémon Insecte avec ses lianes pour les dévorer.', '0,7', 'plante', 'poison', '4,0', 'Chétiflor,Boustiflor,Empiflor', '10', '2023-06-15 13:40:17'),
(91, 'Boustiflor', '0070', 'Quand il a faim, il avale tout ce qui bouge, puis achève ses proies avec de l’acide.', '1,0', 'plante', 'poison', '6,4', 'Chétiflor,Boustiflor,Empiflor', '10', '2023-06-15 13:40:22'),
(92, 'Empiflor', '0071', 'Il attire ses proies avec une odeur de miel et les avale tout entières. Il les digère en un jour seulement, les os y compris.', '1,7', 'plante', 'poison', '15,5', 'Chétiflor,Boustiflor,Empiflor', '10', '2023-06-15 13:40:29'),
(93, 'Tentacool', '0072', 'Peu doué pour la natation, ce Pokémon se contente de flotter à la surface des eaux peu profondes pour chasser ses proies.', '0,9', 'eau', 'poison', '45,5', 'Tentacool,Tentacruel', '10', '2023-06-15 13:40:40'),
(94, 'Tentacruel', '0073', 'Il faut faire attention lorsque les globes rouges sur sa tête se mettent à briller intensément, car c’est qu’il s’apprête à émettre des ultrasons.', '1,6', 'eau', 'poison', '55,0', 'Tentacool,Tentacruel', '10', '2023-06-15 13:40:50'),
(95, 'Racaillou', '0074', 'On en trouve près des sentiers de montagne. Si vous marchez dessus par inadvertance, ils s’énervent et attaquent.', '0,4', 'roche', 'sol', '20,0', 'Racaillou,Gravalanch,Grolem', '10', '2023-06-15 13:40:58'),
(96, 'Gravalanch', '0075', 'Il dévale les sentiers de montagne et traverse les obstacles en les pulvérisant.', '1,0', 'roche', 'sol', '105,0', 'Racaillou,Gravalanch,Grolem', '10', '2023-06-15 13:41:06'),
(97, 'Galopa', '0078', 'Sa vitesse au galop est de 240 km/h. Les flammes de sa crinière brûlent intensément lorsqu’il file comme une flèche.', '1,7', 'feu', '', '95,0', 'Ponyta,Galopa', '10', '2023-06-15 13:41:40'),
(98, 'Ramoloss', '0079', 'Ce Pokémon est très lent et apathique. Il lui faut cinq secondes pour ressentir la douleur provoquée par une attaque.', '1,2', 'eau', 'psy', '36,0', 'Ramoloss', '10', '2023-06-15 13:41:58'),
(99, 'Flagadoss', '0080', 'Un jour, alors qu’un Ramoloss pêchait, un Kokiyas s’est accroché à sa queue et l’a fait évoluer en Flagadoss.', '1,6', 'eau', 'psy', '78,5', 'Ramoloss', '10', '2023-06-15 13:42:16'),
(100, 'Magnéti', '0081', 'Les ondes électromagnétiques émises par ses extrémités lui permettent de défier les lois de la gravité et de flotter.', '0,3', 'electrik', 'acier', '6,0', 'Magnéti,Magnéton,Magnézone', '10', '2023-06-15 13:42:24'),
(101, 'Magnéton', '0082', 'Le lien magnétique qui rattache ces trois Magnéti est si puissant qu’il fait mal aux oreilles si on s’en approche trop.', '1,0', 'electrik', 'acier', '60,0', 'Magnéti,Magnéton,Magnézone', '10', '2023-06-15 13:42:32'),
(102, 'Canarticho', '0083', 'Il ne peut pas vivre sans sa tige, c’est pourquoi il la protège des ennemis au péril de sa vie.', '0,8', 'normal', 'vol', '15,0', 'Canarticho,Palarticho', '10', '2023-06-15 13:42:43'),
(103, 'Doduo', '0084', 'Ses petites ailes ne lui permettent pas de voler, mais grâce à ses puissantes pattes, il peut courir très rapidement.', '1,4', 'normal', 'vol', '39,2', 'Doduo,Dodrio', '10', '2023-06-15 13:42:56'),
(104, 'Dodrio', '0085', 'Quand une des têtes de Doduo se divise, il devient un Dodrio capable de courir à 60 km/h.', '1,8', 'normal', 'vol', '85,2', 'Doduo,Dodrio', '10', '2023-06-15 13:43:09'),
(105, 'Otaria', '0086', 'Il est à l’aise dans les endroits gelés. Il nage avec plaisir dans de l’eau à -10 ºC.', '1,1', 'eau', '', '90,0', 'Otaria,Lamantine', '10', '2023-06-15 13:43:27'),
(106, 'Lamantine', '0087', 'Son corps entier est aussi blanc que la neige. Il résiste bien au froid et peut même nager au milieu des icebergs.', '1,7', 'eau', 'glace', '120,0', 'Otaria,Lamantine', '10', '2023-06-15 13:43:40'),
(107, 'Tadmorv', '0088', 'Torrent de boue devenu Pokémon, il vit dans les lieux les plus insalubres pour que le nombre de microbes qu’il héberge augmente.', '0,9', 'poison', '', '30,0', 'Tadmorv,Grotadmorv', '10', '2023-06-15 13:43:53'),
(108, 'Grotadmorv', '0089', 'Ce Pokémon est recouvert d’une épaisse couche de boue crasseuse. Il est si toxique que même ses traces de pas sont empoisonnées.', '1,2', 'poison', '', '30,0', 'Tadmorv,Grotadmorv', '10', '2023-06-15 13:44:06'),
(109, 'Kokiyas', '0090', 'Une coquille plus dure que le diamant le protège. Il est toutefois étonnamment tendre à l’intérieur.', '0,3', 'eau', '', '4,0', 'Kokiyas,Crustabri', '10', '2023-06-15 13:44:24'),
(110, 'Crustabri', '0091', 'Les Crustabri vivant dans des mers aux courants forts développent des dards particulièrement imposants et aiguisés sur leur coquille.', '1,5', 'eau', 'glace', '132,5', 'Kokiyas,Crustabri', '10', '2023-06-15 13:44:37'),
(111, 'Fantominus', '0092', 'Il enveloppe ses proies dans le nuage de gaz que forme son corps et les empoisonne à travers leur peau afin de les affaiblir petit à petit.', '1,3', 'spectre', 'poison', '0,1', 'Fantominus,Spectrum,Ectoplasma', '10', '2023-06-15 13:44:43'),
(112, 'Spectrum', '0093', 'Il adore se tapir dans l’ombre et faire frissonner ses proies pour l’éternité en leur touchant l’épaule.', '1,6', 'spectre', 'poison', '0,1', 'Fantominus,Spectrum,Ectoplasma', '10', '2023-06-15 13:44:50'),
(113, 'Ectoplasma', '0094', 'Il se cache dans l’ombre de sa victime et attend patiemment le bon moment pour lui voler sa vie.', '1,5', 'spectre', 'poison', '40,5', 'Fantominus,Spectrum,Ectoplasma', '10', '2023-06-15 13:44:57'),
(114, 'Onix', '0095', 'Il absorbe des éléments solides en creusant le sol, ce qui le rend plus robuste.', '8,8', 'roche', 'sol', '210,0', 'Onix,Steelix', '10', '2023-06-15 13:45:08'),
(115, 'Soporifik', '0096', 'Ce Pokémon se souvient de tous les rêves qu’il a avalés. Il mange rarement les songes d’adultes, car ceux des enfants ont meilleur goût.', '1,0', 'psy', '', '32,4', 'Soporifik,Hypnomade', '10', '2023-06-15 13:45:24'),
(116, 'Hypnomade', '0097', 'Lorsqu’il croise le regard de son adversaire, il utilise de nombreux pouvoirs surnaturels comme l’hypnose.', '1,6', 'psy', '', '75,6', 'Soporifik,Hypnomade', '10', '2023-06-15 13:45:41'),
(117, 'Krabby', '0098', 'On trouve ce Pokémon près de la mer. Ses grosses pinces peuvent repousser si elles sont arrachées.', '0,4', 'eau', '', '6,5', 'Krabby,Krabboss', '10', '2023-06-15 13:45:58'),
(118, 'Krabboss', '0099', 'Sa grande pince possède une puissance incommensurable, mais son poids la rend difficile à manier.', '1,3', 'eau', '', '60,0', 'Krabby,Krabboss', '10', '2023-06-15 13:46:14'),
(119, 'Voltorbe', '0100', 'Il se déplace en roulant. Si le sol est cabossé, les chocs le font exploser.', '0,5', 'electrik', '', '10,4', 'Voltorbe,Électrode', '10', '2023-06-15 13:46:26'),
(120, 'Électrode', '0101', 'Plus il accumule de l’énergie de type Électrik, plus il est rapide. Mais il a aussi davantage de chances d’exploser.', '1,2', 'electrik', '', '66,6', 'Voltorbe,Électrode', '10', '2023-06-15 13:46:38'),
(121, 'Noeunoeuf', '0102', 'Même s’il ressemble à un tas d’œufs, il s’agit bien d’un Pokémon. Il paraît qu’ils communiquent entre eux par télépathie.', '0,4', 'plante', 'psy', '2,5', 'Noeunoeuf,Noadkoko', '10', '2023-06-15 13:46:49'),
(122, 'Noadkoko', '0103', 'Chacune de ses trois têtes pense de manière autonome. Elles ne semblent s’intéresser qu’à elles-mêmes.', '2,0', 'plante', 'psy', '120,0', 'Noeunoeuf,Noadkoko', '10', '2023-06-15 13:47:00'),
(123, 'Osselait', '0104', 'Lorsqu’il repense à sa mère défunte, ses sanglots résonnent tristement sous le crâne qu’il porte sur la tête.', '0,4', 'sol', '', '6,5', 'Osselait,Ossatueur', '10', '2023-06-15 13:47:17'),
(124, 'Ossatueur', '0105', 'Il s’est endurci et a évolué depuis qu’il a réussi à surmonter sa peine. Il utilise son os en guise d’arme et affronte ses ennemis avec bravoure.', '1,0', 'sol', '', '45,0', 'Osselait,Ossatueur', '10', '2023-06-15 13:47:28'),
(125, 'Kicklee', '0106', 'Il possède un fantastique sens de l’équilibre, et peut donner des rafales de coups de pied dans toutes les positions.', '1,5', 'combat', '', '49,8', 'Debugant', '10', '2023-06-15 13:47:50'),
(126, 'Tygnon', '0107', 'Ses poings fendent l’air. Ils sont si rapides qu’un simple frôlement peut causer une brûlure.', '1,4', 'combat', '', '50,2', 'Debugant', '10', '2023-06-15 13:48:12'),
(127, 'Excelangue', '0108', 'Si sa salive gluante entre en contact avec la peau et qu’on ne l’essuie pas bien, elle provoque de terribles démangeaisons qui ne s’arrêtent jamais.', '1,2', 'normal', '', '65,5', 'Excelangue,Coudlangue', '10', '2023-06-15 13:48:28'),
(128, 'Smogo', '0109', 'Son corps est gonflé de gaz toxique. Il se rend dans les décharges, attiré par l’odeur des déchets alimentaires en décomposition.', '0,6', 'poison', '', '1,0', 'Smogo,Smogogo', '10', '2023-06-15 13:48:44'),
(129, 'Smogogo', '0110', 'Il grandit en se nourrissant des gaz émis par les détritus. Des spécimens à trois têtes existent, bien qu’ils soient fort rares.', '1,2', 'poison', '', '9,5', 'Smogo,Smogogo', '10', '2023-06-15 13:48:54'),
(130, 'Rhinocorne', '0111', 'Costaud, mais pas très intelligent, ce Pokémon est capable de détruire un immeuble entier en fonçant dessus.', '1,0', 'sol', 'roche', '115,0', 'Rhinocorne,Rhinoféros,Rhinastoc', '10', '2023-06-15 13:49:01'),
(131, 'Rhinoféros', '0112', 'L’évolution a permis à ce Pokémon de marcher sur ses pattes postérieures. Il peut faire des trous dans les rochers en utilisant sa corne.', '1,9', 'sol', 'roche', '120,0', 'Rhinocorne,Rhinoféros,Rhinastoc', '10', '2023-06-15 13:49:08'),
(132, 'Leveinard', '0113', 'Ce Pokémon très serviable distribue ses œufs hautement nutritifs aux êtres humains et aux Pokémon blessés.', '1,1', 'normal', '', '34,6', 'Ptiravi,Leveinard,Leuphorie', '10', '2023-06-15 13:49:20'),
(133, 'Saquedeneu', '0114', 'On ne sait toujours pas ce qui se cache sous ses lianes. Même si on les coupe, elles repoussent à l’infini.', '1,0', 'plante', '', '35,0', 'Saquedeneu,Bouldeneu', '10', '2023-06-15 13:49:37'),
(134, 'Kangourex', '0115', 'Porter son petit dans sa poche ventrale ne l’empêche pas d’avoir un bon jeu de jambes. Ses coups rapides intimident ses ennemis.', '2,2', 'normal', '', '80,0', 'Kangourex', '10', '2023-06-15 13:49:59'),
(135, 'Hypotrempe', '0116', 'Il vit dans les mers calmes. Quand on l’attaque, il crache de l’encre noire et profite de la diversion pour s’enfuir.', '0,4', 'eau', '', '8,0', 'Hypotrempe,Hypocéan,Hyporoi', '10', '2023-06-15 13:50:11'),
(136, 'Hypocéan', '0117', 'Les mâles s’occupent des petits, et tant qu’ils en ont à élever, le venin contenu dans leurs épines dorsales devient beaucoup plus fort.', '1,2', 'eau', '', '25,0', 'Hypotrempe,Hypocéan,Hyporoi', '10', '2023-06-15 13:50:23'),
(137, 'Poissirène', '0118', 'Ses nageoires dorsales, pectorales et caudales ondulent avec élégance. Il est surnommé le « danseur des flots ».', '0,6', 'eau', '', '15,0', 'Poissirène,Poissoroy', '10', '2023-06-15 13:50:39'),
(138, 'Poissoroy', '0119', 'En automne, à la saison des amours, il fait des réserves de graisse et arbore des couleurs chatoyantes.', '1,3', 'eau', '', '39,0', 'Poissirène,Poissoroy', '10', '2023-06-15 13:50:56'),
(139, 'Stari', '0120', 'Lorsqu’on se rend en bord de mer à la fin de l’été, on peut voir des groupes de Stari clignoter à un rythme régulier.', '0,8', 'eau', '', '34,5', 'Stari,Staross', '10', '2023-06-15 13:51:11'),
(140, 'Staross', '0121', 'S’il déchaîne son pouvoir psychique puissant, son organe appelé « cœur » se met à briller de sept couleurs.', '1,1', 'eau', 'psy', '80,0', 'Stari,Staross', '10', '2023-06-15 13:51:23'),
(141, 'Insécateur', '0123', 'Il fauche les herbes avec ses lames acérées. Ses mouvements sont si rapides qu’ils sont imperceptibles à l’œil nu.', '1,5', 'insecte', 'vol', '56,0', 'Insécateur', '10', '2023-06-16 11:08:46'),
(142, 'Lippoutou', '0124', 'Dans une certaine zone de Galar, Lippoutou était craint et vénéré par la population qui l’avait surnommé la « reine des glaces ».', '1,4', 'glace', 'psy', '40,6', 'Lippouti,Lippoutou', '10', '2023-06-16 11:08:59'),
(143, 'Élektek', '0125', 'De nombreuses centrales électriques gardent des Pokémon Sol à proximité afin d’empêcher les Élektek de leur voler de l’électricité.', '1,1', 'electrik', '', '30,0', 'Élekid,Élektek,Élekable', '10', '2023-06-16 11:09:12'),
(144, 'Magmar', '0126', 'Il achève ses proies avec ses flammes, mais il lui arrive de les calciner accidentellement, à son plus grand regret.', '1,3', 'feu', '', '44,5', 'Magby,Magmar,Maganon', '10', '2023-06-16 11:09:25'),
(145, 'Scarabrute', '0127', 'Ses cornes déterminent son rang au sein du groupe. Plus elles sont imposantes, plus les membres du sexe opposé l’apprécient.', '1,5', 'insecte', '', '55,0', 'Scarabrute', '10', '2023-06-16 11:09:43'),
(146, 'Tauros', '0128', 'Une fois qu’il a pris une proie pour cible, il fonce droit dessus. Il est connu pour sa nature violente.', '1,4', 'normal', '', '88,4', 'Tauros', '10', '2023-06-16 11:10:01'),
(147, 'Magicarpe', '0129', 'Un Pokémon tout à fait pathétique. En de très rares occasions, il est capable de sauter haut, mais jamais à plus de deux mètres.', '0,9', 'eau', '', '10,0', 'Magicarpe,Léviator', '10', '2023-06-16 11:10:17'),
(148, 'Léviator', '0130', 'Lorsqu’il apparaît, il saccage tout. Sa fureur ne se calme pas tant qu’il n’a pas tout détruit.', '6,5', 'eau', 'vol', '235,0', 'Magicarpe,Léviator', '10', '2023-06-16 11:10:30'),
(149, 'Lokhlass', '0131', 'Il adore traverser les mers en portant des êtres humains ou des Pokémon sur son dos, et il comprend le langage humain.', '2,5', 'eau', 'glace', '220,0', 'Lokhlass', '10', '2023-06-16 11:10:48'),
(150, 'Métamorph', '0132', 'Il excelle dans l’art de la métamorphose, mais si on le fait rire, il ne pourra rester déguisé.', '0,3', 'normal', '', '4,0', 'Métamorph', '10', '2023-06-16 11:11:09'),
(151, 'Évoli', '0133', 'Ses multiples évolutions lui permettent de s’adapter à tout type de milieu naturel.', '0,3', 'normal', '', '6,5', 'Évoli', '10', '2023-06-16 11:11:29'),
(152, 'Aquali', '0134', 'Il vit au bord de l’eau. Sa queue semblable à celle d’un poisson lui donne l’apparence d’une sirène.', '1,0', 'eau', '', '29,0', 'Évoli', '10', '2023-06-16 11:11:53'),
(153, 'Voltali', '0135', 'Il concentre la faible charge électrique générée par chacune de ses cellules pour projeter de puissants éclairs.', '0,8', 'electrik', '', '24,5', 'Évoli', '10', '2023-06-16 11:12:17'),
(154, 'Pyroli', '0136', 'Sa glande enflammée chauffe l’air qu’il inspire. Il l’exhale ensuite sous forme de flamme atteignant les 1 700 °C.', '0,9', 'feu', '', '25,0', 'Évoli', '10', '2023-06-16 11:12:41'),
(155, 'Porygon', '0137', 'C’est le premier Pokémon au monde à avoir été créé à partir de programmes informatiques, grâce à une technologie de pointe.', '0,8', 'normal', '', '36,5', 'Porygon,Porygon2,Porygon-Z', '10', '2023-06-16 11:12:53'),
(156, 'Amonita', '0138', 'Ce Pokémon commence à poser problème, car certains spécimens se sont enfuis ou ont été relâchés après avoir été ressuscités.', '0,4', 'roche', 'eau', '7,5', 'Amonita,Amonistar', '10', '2023-06-16 11:13:06'),
(157, 'Amonistar', '0139', 'Il se serait éteint à cause de la taille et du poids importants de sa coquille, qui le ralentissait quand il chassait ses proies.', '1,0', 'roche', 'eau', '35,0', 'Amonita,Amonistar', '10', '2023-06-16 11:13:17'),
(158, 'Kabuto', '0140', 'Ce Pokémon au bord de l’extinction mue tous les trois jours et renforce ainsi davantage sa carapace.', '0,5', 'roche', 'eau', '11,5', 'Kabuto,Kabutops', '10', '2023-06-16 11:13:29'),
(159, 'Kabutops', '0141', 'Il lacère sa proie pour boire ses fluides corporels, puis jette son corps en pâture à d’autres Pokémon.', '1,3', 'roche', 'eau', '40,5', 'Kabuto,Kabutops', '10', '2023-06-16 11:13:40'),
(160, 'Ptéra', '0142', 'On raconte qu’aujourd’hui encore, il est impossible de restaurer à la perfection ce Pokémon féroce de l’ère préhistorique.', '1,8', 'roche', 'vol', '59,0', 'Ptéra', '10', '2023-06-16 11:13:56'),
(161, 'Ronflex', '0143', 'Son estomac peut digérer n’importe quel type de nourriture, même si elle est moisie ou pourrie.', '2,1', 'normal', '', '460,0', 'Goinfrex,Ronflex', '10', '2023-06-16 11:14:12'),
(162, 'Artikodin', '0144', 'Ce Pokémon oiseau légendaire peut provoquer des blizzards en gelant l’humidité de l’air.', '1,7', 'glace', 'vol', '55,4', 'Artikodin', '10', '2023-06-16 11:14:29'),
(163, 'Électhor', '0145', 'Un Pokémon légendaire qui vivrait dans les nuages orageux. Il contrôle la foudre.', '1,6', 'electrik', 'vol', '52,6', 'Électhor', '10', '2023-06-16 11:14:45'),
(164, 'Sulfura', '0146', 'L’un des Pokémon oiseaux légendaires. On dit que sa venue annonce l’arrivée du printemps.', '2,0', 'feu', 'vol', '60,0', 'Sulfura', '10', '2023-06-16 11:15:02'),
(165, 'Minidraco', '0147', 'Ce Pokémon grandit en muant à répétition. Lors de ce processus, il s’abrite derrière une puissante cascade.', '1,8', 'dragon', '', '3,3', 'Minidraco,Draco,Dracolosse', '10', '2023-06-16 11:17:08'),
(166, 'Draco', '0148', 'On dit que lorsque tout son corps émet une aura, les conditions climatiques se mettent à changer à vue d’œil.', '4,0', 'dragon', '', '16,5', 'Minidraco,Draco,Dracolosse', '10', '2023-06-16 11:17:19'),
(167, 'Dracolosse', '0149', 'On dit qu’il existe une île quelque part dans l’océan où ces Pokémon se réunissent pour vivre paisiblement.', '2,2', 'dragon', 'vol', '210,0', 'Minidraco,Draco,Dracolosse', '10', '2023-06-16 11:17:24'),
(168, 'Mewtwo', '0150', 'Son ADN est presque le même que celui de Mew, mais sa taille et son caractère sont très différents.', '2,0', 'psy', '', '122,0', 'Mewtwo', '10', '2023-06-16 11:18:27'),
(169, 'Mew', '0151', 'À l’aide d’un microscope, on peut distinguer le pelage extrêmement court, fin et délicat de ce Pokémon.', '0,4', 'psy', '', '4,0', 'Mew', '10', '2023-06-16 12:38:03'),
(170, 'Germignon', '0152', 'Lorsqu’il se bat, Germignon secoue sa feuille pour tenir son ennemi à distance. Un doux parfum s’en dégage également, apaisant les Pokémon qui se battent et créant une atmosphère agréable et amicale.', '0,9', 'plante', '', '6,4', 'Germignon,Macronium,Méganium', '10', '2023-06-16 12:38:15'),
(171, 'Macronium', '0153', 'Le cou de Macronium est entouré de nombreuses feuilles. Dans chacune d’elles se trouve une pousse d’arbre. Le parfum de cette pousse donne la pêche aux personnes qui le sentent.', '1,2', 'plante', '', '15,8', 'Germignon,Macronium,Méganium', '10', '2023-06-16 12:38:28'),
(172, 'Méganium', '0154', 'Le parfum de la fleur de Méganium apaise et calme les esprits. Pendant les combats, ce Pokémon émet son parfum relaxant pour atténuer l’agressivité de l’ennemi.', '1,8', 'plante', '', '100,5', 'Germignon,Macronium,Méganium', '10', '2023-06-16 12:38:39'),
(173, 'Héricendre', '0155', 'Héricendre se protège en faisant jaillir des flammes de son dos. Ces flammes peuvent être violentes si le Pokémon est en colère. Cependant, s’il est fatigué, seules quelques flammèches vacillent laborieusement.', '0,5', 'feu', '', '7,9', 'Héricendre,Feurisson,Typhlosion', '10', '2023-06-16 12:38:52'),
(174, 'Feurisson', '0156', 'Feurisson garde ses ennemis à distance grâce à l’intensité de ses flammes et à des rafales d’air brûlant. Ce Pokémon utilise son incroyable agilité pour éviter les attaques, tout en enflammant ses ennemis.', '0,9', 'feu', '', '19,0', 'Héricendre,Feurisson,Typhlosion', '10', '2023-06-16 12:39:04'),
(175, 'Typhlosion', '0157', 'Ce Pokémon attaque à l’aide de flammes explosives. Il se dissimule derrière la brume produite par la chaleur intense de ses flammes.', '1,7', 'feu', '', '79,5', 'Héricendre,Feurisson,Typhlosion', '10', '2023-06-16 12:39:11'),
(176, 'Kaiminus', '0158', 'Malgré son tout petit corps, la mâchoire de Kaiminus est très puissante. Parfois, ce Pokémon mordille les gens pour jouer, sans se rendre compte que sa morsure peut gravement blesser quelqu’un.', '0,6', 'eau', '', '9,5', 'Kaiminus,Crocrodil,Aligatueur', '10', '2023-06-16 12:39:24'),
(177, 'Crocrodil', '0159', 'Une fois que Crocrodil a refermé sa mâchoire sur son ennemi, il est impossible de le faire lâcher prise. Ses crocs sont recourbés comme des hameçons et ne peuvent pas être retirés une fois enfoncés.', '1,1', 'eau', '', '25,0', 'Kaiminus,Crocrodil,Aligatueur', '10', '2023-06-16 12:39:36'),
(178, 'Aligatueur', '0160', 'Aligatueur impressionne ses ennemis en ouvrant son énorme gueule. Pendant les combats, il piétine le sol de ses puissantes pattes arrière avant de charger ses adversaires à pleine vitesse.', '2,3', 'eau', '', '88,8', 'Kaiminus,Crocrodil,Aligatueur', '10', '2023-06-16 12:39:48'),
(179, 'Fouinette', '0161', 'Lorsqu’un Fouinette dort, un autre monte la garde. La sentinelle réveille les autres au moindre signe de danger. Si un de ces Pokémon est séparé de sa meute, il est incapable de dormir, car il a peur.', '0,8', 'normal', '', '6,0', 'Fouinette,Fouinar', '10', '2023-06-16 12:40:03'),
(180, 'Fouinar', '0162', 'Fouinar est très mince. Lorsqu’il est attaqué, il peut s’enfuir en se faufilant habilement dans les recoins étroits. Malgré ses pattes courtes, ce Pokémon est très agile et rapide.', '1,8', 'normal', '', '32,5', 'Fouinette,Fouinar', '10', '2023-06-16 12:40:21'),
(181, 'Hoothoot', '0163', 'Il se tient toujours sur un pied. Il en change si vite qu’on peut à peine distinguer ce mouvement.', '0,7', 'normal', 'vol', '21,2', 'Hoothoot,Noarfang', '10', '2023-06-16 12:40:33'),
(182, 'Noarfang', '0164', 'Ses yeux à la structure particulière sont capables de voir comme en plein jour même quand il fait très sombre.', '1,6', 'normal', 'vol', '40,8', 'Hoothoot,Noarfang', '10', '2023-06-16 12:40:45'),
(183, 'Coxy', '0165', 'Ce Pokémon très sensible au froid semble revivre lorsqu’il se trouve dans des régions chaudes comme Alola.', '1,0', 'insecte', 'vol', '10,8', 'Coxy,Coxyclaque', '10', '2023-06-16 12:40:56'),
(184, 'Coxyclaque', '0166', 'Le motif qui orne son dos aurait un lien avec les étoiles, mais nul ne sait encore en quoi consiste ce lien.', '1,4', 'insecte', 'vol', '35,6', 'Coxy,Coxyclaque', '10', '2023-06-16 12:41:08'),
(185, 'Mimigal', '0167', 'La toile qu’il tisse avec les fils qu’il sécrète est tellement solide qu’elle peut soutenir une pierre de dix kilos.', '0,5', 'insecte', 'poison', '8,5', 'Mimigal,Migalos', '10', '2023-06-16 12:41:20'),
(186, 'Migalos', '0168', 'Il erre chaque nuit à la recherche d’une proie. Quand il en trouve une, il l’immobilise grâce à ses fils, puis la croque avec ses mandibules.', '1,1', 'insecte', 'poison', '33,5', 'Mimigal,Migalos', '10', '2023-06-16 12:41:33'),
(187, 'Nostenfer', '0169', 'Ses pattes sont devenues des ailes. Il fond sur sa proie furtivement puis plante ses crocs dans sa nuque.', '1,8', 'poison', 'vol', '75,0', 'Nosferapti,Nosferalto,Nostenfer', '10', '2023-06-16 12:41:40'),
(188, 'Loupio', '0170', 'Ses antennes proviennent d’anciennes nageoires et sont chargées d’énergies positive et négative.', '0,5', 'eau', 'electrik', '12,0', 'Loupio,Lanturn', '10', '2023-06-16 12:41:52'),
(189, 'Lanturn', '0171', 'Sa lumière est si intense qu’on peut la voir à la surface de l’eau alors qu’il se trouve à 5 000 mètres de profondeur.', '1,2', 'eau', 'electrik', '22,5', 'Loupio,Lanturn', '10', '2023-06-16 12:42:04'),
(190, 'Pichu', '0172', 'Il ne sait pas encore bien emmagasiner l’électricité. Au moindre choc, il envoie des décharges sans le vouloir.', '0,3', 'electrik', '', '2,0', 'Pichu,Pikachu,Raichu', '10', '2023-06-16 12:42:16'),
(191, 'Mélo', '0173', 'On dit qu’il apparaît souvent là où se sont écrasées des météorites.', '0,3', 'fée', '', '3,0', 'Mélo,Mélofée,Mélodelfe', '10', '2023-06-16 12:42:28'),
(192, 'Toudoudou', '0174', 'Son corps mou dégage un parfum sucré. Quand il commence à rebondir, on ne peut plus l’arrêter.', '0,3', 'normal', 'fée', '1,0', 'Toudoudou,Rondoudou,Grodoudou', '10', '2023-06-16 12:42:36'),
(193, 'Togepi', '0175', 'Sa coquille est remplie de joie. On dit que s’il est bien traité, il porte chance.', '0,3', 'fée', '', '1,5', 'Togepi,Togetic,Togekiss', '10', '2023-06-16 12:42:49'),
(194, 'Togetic', '0176', 'On dit qu’il se montre aux personnes dotées d’un cœur pur pour leur apporter joie et bonheur.', '0,6', 'fée', 'vol', '3,2', 'Togepi,Togetic,Togekiss', '10', '2023-06-16 12:42:55'),
(195, 'Natu', '0177', 'Il est très doué pour grimper aux arbres et ainsi manger les bourgeons dont il raffole.', '0,2', 'psy', 'vol', '2,0', 'Natu,Xatu', '10', '2023-06-16 12:43:08'),
(196, 'Xatu', '0178', 'On dit qu’il reste immobile et silencieux parce qu’il observe simultanément le passé et le futur.', '1,5', 'psy', 'vol', '15,0', 'Natu,Xatu', '10', '2023-06-16 12:43:20'),
(197, 'Wattouat', '0179', 'Quand son corps est chargé d’électricité statique, sa laine double de volume et envoie des décharges lorsqu’on la touche.', '0,6', 'electrik', '', '7,8', 'Wattouat,Lainergie,Pharamp', '10', '2023-06-16 12:43:33'),
(198, 'Lainergie', '0180', 'Il a emmagasiné tellement d’électricité que sa laine ne peut plus repousser à certains endroits de son corps.', '0,8', 'electrik', '', '13,3', 'Wattouat,Lainergie,Pharamp', '10', '2023-06-16 12:43:45'),
(199, 'Pharamp', '0181', 'La lumière vive sur sa queue est visible de loin. Les êtres humains le tiennent en haute estime, car sa lumière les guide depuis les temps anciens.', '1,4', 'electrik', '', '61,5', 'Wattouat,Lainergie,Pharamp', '10', '2023-06-16 12:43:52'),
(200, 'Joliflor', '0182', 'Ce Pokémon vit en nombre dans les tropiques. Quand il danse, ses pétales frottent les uns contre les autres et émettent un son mélodieux.', '0,4', 'plante', '', '5,8', 'Mystherbe,Ortide', '10', '2023-06-16 12:44:12'),
(201, 'Marill', '0183', 'Sa fourrure est imperméable, si bien qu’il reste sec même quand il joue dans l’eau.', '0,4', 'eau', 'fée', '8,5', 'Azurill,Marill,Azumarill', '10', '2023-06-16 12:44:20'),
(202, 'Azumarill', '0184', 'Ses longues oreilles lui permettent d’entendre tout ce qui se passe sous l’eau de manière très distincte.', '0,8', 'eau', 'fée', '28,5', 'Azurill,Marill,Azumarill', '10', '2023-06-16 12:44:27'),
(203, 'Simularbre', '0185', 'Bien qu’il fasse semblant d’être un arbre, par sa composition, il semble plus proche d’un minéral que d’un végétal.', '1,2', 'roche', '', '38,0', 'Manzaï,Simularbre', '10', '2023-06-16 12:44:43'),
(204, 'Tarpaud', '0186', 'Il apparaît sur les rives des étangs à la nuit tombée. Il marque son territoire en poussant des hurlements.', '1,1', 'eau', '', '33,9', 'Ptitard,Têtarte', '10', '2023-06-16 12:45:00'),
(205, 'Granivol', '0187', 'Les Granivol parcourent de grandes distances, emportés par le vent. On ignore d’où viennent ceux qui ont atterri à Paldea.', '0,4', 'plante', 'vol', '0,5', 'Granivol,Floravol,Cotovol', '10', '2023-06-16 12:45:08'),
(206, 'Floravol', '0188', 'On dit que les personnes passionnées de Floravol peuvent déterminer son lieu de naissance rien qu’à l’odeur de la fleur sur sa tête.', '0,6', 'plante', 'vol', '1,0', 'Granivol,Floravol,Cotovol', '10', '2023-06-16 12:45:15'),
(207, 'Cotovol', '0189', 'Il voyage au gré des vents saisonniers. Quand il arrive à court de spores de coton, cela marque la fin de son périple, mais aussi de sa vie.', '0,8', 'plante', 'vol', '3,0', 'Granivol,Floravol,Cotovol', '10', '2023-06-16 12:45:22'),
(208, 'Capumain', '0190', 'À force d’utiliser sa queue à tort et à travers, elle est devenue plus habile que ses mains. Il l’utilise pour faire son nid en haut des arbres.', '0,8', 'normal', '', '11,5', 'Capumain,Capidextre', '10', '2023-06-16 12:45:39'),
(209, 'Tournegrin', '0191', 'Ce Pokémon tombe soudainement du ciel le matin. Conscient de sa faible constitution, il ne fait que se nourrir jusqu’à ce qu’il évolue.', '0,3', 'plante', '', '1,8', 'Tournegrin,Héliatronc', '10', '2023-06-16 12:45:56'),
(210, 'Héliatronc', '0192', 'En journée, il court énergiquement dans tous les sens, mais il s’arrête net dès que la nuit tombe.', '0,8', 'plante', '', '8,5', 'Tournegrin,Héliatronc', '10', '2023-06-16 12:46:13'),
(211, 'Yanma', '0193', 'Yanma a un champ de vision de 360 degrés sans avoir besoin de bouger les yeux. Il vole incroyablement bien et peut faire des figures acrobatiques. Ce Pokémon descend en piqué sur ses proies.', '1,2', 'insecte', 'vol', '38,0', 'Yanma,Yanmega', '10', '2023-06-16 12:46:25'),
(212, 'Axoloto', '0194', 'Ce Pokémon vit en eaux froides. Si la température extérieure est assez basse, il lui arrive de se rendre sur la terre ferme pour se nourrir.', '0,4', 'eau', 'sol', '8,5', 'Axoloto,Maraiste', '10', '2023-06-16 12:46:36'),
(213, 'Maraiste', '0195', 'Il a tendance à se cogner la tête contre la coque des navires et les rochers, mais, imperturbable, il continue de nager comme si de rien n’était.', '1,4', 'eau', 'sol', '75,0', 'Axoloto,Maraiste', '10', '2023-06-16 12:46:48'),
(214, 'Mentali', '0196', 'Quand il prédit la prochaine attaque de son adversaire, l’extrémité fourchue de sa queue frémit.', '0,9', 'psy', '', '26,5', 'Évoli', '10', '2023-06-16 12:47:10'),
(215, 'Noctali', '0197', 'Quand il s’expose aux ondes lunaires, ses anneaux brillent légèrement et il acquiert un mystérieux pouvoir.', '1,0', 'tenebres', '', '27,0', 'Évoli', '10', '2023-06-16 12:47:31'),
(216, 'Cornèbre', '0198', 'Ce Pokémon redouté et peu aimé porterait malheur à quiconque l’aperçoit la nuit.', '0,5', 'tenebres', 'vol', '2,1', 'Cornèbre,Corboss', '10', '2023-06-16 12:47:43'),
(217, 'Roigada', '0199', 'Quand la tête de Ramoloss a été mordue, des toxines l’ont pénétrée et ont éveillé en lui des pouvoirs immenses.', '2,0', 'eau', 'psy', '79,5', 'Ramoloss', '10', '2023-06-16 12:48:01'),
(218, 'Feuforêve', '0200', 'Il fait peur aux gens en pleine nuit et se nourrit de leur frayeur.', '0,7', 'spectre', '', '1,0', 'Feuforêve,Magirêve', '10', '2023-06-16 12:48:18'),
(219, 'Zarbi', '0201', 'Ce Pokémon a la forme d’un caractère d’écriture antique. Personne ne sait si ces écritures antiques sont apparues avant les Zarbi ou le contraire. Des études sont en cours, mais aucun résultat n’a été annoncé.', '0,5', 'psy', '', '5,0', 'Zarbi', '10', '2023-06-16 12:48:40'),
(220, 'Qulbutoké', '0202', 'Il déteste la lumière et les chocs. S’il est attaqué, il se gonfle pour riposter violemment.', '1,3', 'psy', '', '28,5', 'Okéoké,Qulbutoké', '10', '2023-06-16 12:48:58'),
(221, 'Girafarig', '0203', 'Le cerveau de sa queue a beau être très petit, il n’en reste pas moins un organe vital doté d’immenses pouvoirs psychiques.', '1,5', 'normal', 'psy', '41,5', 'Girafarig,Farigiraf', '10', '2023-06-16 12:49:11'),
(222, 'Pomdepik', '0204', 'Ce Pokémon renforce sa carapace en y ajoutant des écorces d’arbre. Il devient alors plus lourd, mais cela ne le dérange pas.', '0,6', 'insecte', '', '7,2', 'Pomdepik,Foretress', '10', '2023-06-16 12:49:28'),
(223, 'Foretress', '0205', 'On le trouve accroché au tronc des gros arbres, d’où il crache des morceaux de sa carapace au moindre mouvement.', '1,2', 'insecte', 'acier', '125,8', 'Pomdepik,Foretress', '10', '2023-06-16 12:49:41'),
(224, 'Insolourdo', '0206', 'Il construit des labyrinthes dans les endroits sombres. Si quelqu’un le repère, il fuit en creusant le sol à l’aide de sa queue.', '1,5', 'normal', '', '14,0', 'Insolourdo,Deusolourdo', '10', '2023-06-16 12:49:58'),
(225, 'Scorplane', '0207', 'Scorplane plane dans les airs sans un bruit, comme s’il glissait. Ce Pokémon s’accroche au visage de son ennemi grâce aux serres de ses pattes arrière et aux pinces de ses pattes avant, et pique avec son dard empoisonné.', '1,1', 'sol', 'vol', '64,8', 'Scorplane,Scorvol', '10', '2023-06-16 12:50:11'),
(226, 'Steelix', '0208', 'On raconte qu’il s’agit d’un Onix de plus de 100 ans dont la structure corporelle s’est rapprochée de celle du diamant.', '9,2', 'acier', 'sol', '400,0', 'Onix,Steelix', '10', '2023-06-16 12:50:23'),
(227, 'Snubbull', '0209', 'Il s’attache très facilement et aime être cajolé. Une telle sensibilité cachée derrière une mine renfrognée fait fondre beaucoup de jeunes gens.', '0,6', 'fée', '', '7,8', 'Snubbull,Granbull', '10', '2023-06-16 12:50:41'),
(228, 'Granbull', '0210', 'Sa mâchoire est étonnamment puissante, mais comme il n’aime pas se battre, il n’a pas souvent l’occasion de s’en servir.', '1,4', 'fée', '', '48,7', 'Snubbull,Granbull', '10', '2023-06-16 12:50:58'),
(229, 'Qwilfish', '0211', 'S’il se met à avaler de l’eau, cela signifie qu’il s’apprête à attaquer en projetant les épines empoisonnées qui poussent sur son corps.', '0,5', 'eau', 'poison', '3,9', 'Qwilfish,Qwilpik', '10', '2023-06-16 12:51:10'),
(230, 'Cizayox', '0212', 'Les pinces de ce Pokémon contiennent de l’acier et peuvent réduire quasiment n’importe quoi en miettes.', '1,8', 'insecte', 'acier', '118,0', 'Insécateur', '10', '2023-06-16 12:51:28'),
(231, 'Caratroc', '0213', 'Il garde des Baies dans sa carapace. Pour éviter de se faire attaquer, il s’immobilise sous un rocher.', '0,6', 'insecte', 'roche', '20,5', 'Caratroc', '10', '2023-06-16 12:51:45'),
(232, 'Scarhino', '0214', 'Il aime tellement la sève qu’il la défend jalousement : à l’aide de son imposante corne, il projette quiconque s’en approche dans les airs.', '1,5', 'insecte', 'combat', '54,0', 'Scarhino', '10', '2023-06-16 12:52:03'),
(233, 'Farfuret', '0215', 'Ce Pokémon rusé se cache dans l’ombre et attend patiemment de fondre sur sa proie.', '0,9', 'tenebres', 'glace', '28,0', 'Farfuret,Dimoret', '10', '2023-06-16 12:52:15'),
(234, 'Teddiursa', '0216', 'Il suit discrètement les Apitrini jusqu’à leur ruche, puis il y plonge ses pattes pour recueillir du miel, qu’il déguste ensuite.', '0,6', 'normal', '', '8,8', 'Teddiursa,Ursaring,Ursaking', '10', '2023-06-16 12:52:27'),
(235, 'Ursaring', '0217', 'Son visage austère s’illumine de joie lorsqu’il savoure du miel, un aliment qu’il adore.', '1,8', 'normal', '', '125,8', 'Teddiursa,Ursaring,Ursaking', '10', '2023-06-16 12:52:39'),
(236, 'Limagma', '0218', 'Du magma en fusion coule dans les veines de Limagma. Si ce Pokémon est refroidi, le magma se solidifie. Son corps devient alors cassant et des morceaux s’en détachent, diminuant ainsi sa taille.', '0,7', 'feu', '', '35,0', 'Limagma,Volcaropod', '10', '2023-06-16 12:52:57'),
(237, 'Volcaropod', '0219', 'La carapace de Volcaropod est en fait constituée de sa peau, qui s’est durcie après un refroidissement. Elle est très cassante et fragile. Il suffit de la toucher pour qu’elle casse. Il reprend sa forme en plongeant dans le magma.', '0,8', 'feu', 'roche', '55,0', 'Limagma,Volcaropod', '10', '2023-06-16 12:53:10'),
(238, 'Marcacrin', '0220', 'Il creuse le sol avec son groin pour y dénicher de la nourriture. Il trouve parfois des sources d’eau chaude.', '0,4', 'glace', 'sol', '6,5', 'Marcacrin,Cochignon,Mammochon', '10', '2023-06-16 12:53:17'),
(239, 'Cochignon', '0221', 'S’il charge un ennemi, les poils de son dos se dressent. Il est très sensible au bruit.', '1,1', 'glace', 'sol', '55,8', 'Marcacrin,Cochignon,Mammochon', '10', '2023-06-16 12:53:25'),
(240, 'Corayon', '0222', 'On en trouve beaucoup dans les mers claires du sud. Il ne peut pas vivre en eaux polluées.', '0,6', 'eau', 'roche', '5,0', 'Corayon,Corayôme', '10', '2023-06-16 12:53:37'),
(241, 'Rémoraid', '0223', 'Son puissant jet d’eau ne manque jamais sa cible, même à 100 m de distance.', '0,6', 'eau', '', '12,0', 'Rémoraid,Octillery', '10', '2023-06-16 12:53:55'),
(242, 'Octillery', '0224', 'Il adore se cacher dans des trous. Il n’hésite pas à s’approprier les trous creusés par d’autres Pokémon pour y dormir.', '0,9', 'eau', '', '28,5', 'Rémoraid,Octillery', '10', '2023-06-16 12:54:13');
INSERT INTO `pokemon` (`p_id`, `nom`, `numero`, `p_description`, `taille`, `p_type`, `p_type-2`, `poids`, `evolutions`, `created_by`, `created_on`) VALUES
(243, 'Cadoizo', '0225', 'Il transporte de la nourriture toute la journée. Ses réserves de vivres auraient sauvé la vie de nombreuses personnes en péril.', '0,9', 'glace', 'vol', '16,0', 'Cadoizo', '10', '2023-06-16 12:54:32'),
(244, 'Démanta', '0226', 'Il peut planer au-dessus des vagues sur plus de 100 m en prenant son élan dans la mer.', '2,1', 'eau', 'vol', '220,0', 'Babimanta,Démanta', '10', '2023-06-16 12:54:46'),
(245, 'Airmure', '0227', 'Ses plumes sont plus tranchantes que des lames. Il se dispute violemment son territoire avec les Corvaillus.', '1,7', 'acier', 'vol', '50,5', 'Airmure', '10', '2023-06-16 12:55:05'),
(246, 'Malosse', '0228', 'Ce Pokémon est rusé. Il chasse en meute en communiquant avec les siens grâce à une variété de cris.', '0,6', 'tenebres', 'feu', '10,8', 'Malosse,Démolosse', '10', '2023-06-16 12:55:17'),
(247, 'Démolosse', '0229', 'Les blessures provoquées par son souffle enflammé sont permanentes, et la douleur ne disparaît jamais.', '1,4', 'tenebres', 'feu', '35,0', 'Malosse,Démolosse', '10', '2023-06-16 12:55:30'),
(248, 'Hyporoi', '0230', 'Il apparaît à la surface de l’océan lorsqu’une tempête arrive. Dès qu’il croise un Dracolosse, un combat féroce s’ensuit.', '1,8', 'eau', 'dragon', '152,0', 'Hypotrempe,Hypocéan,Hyporoi', '10', '2023-06-16 12:55:37'),
(249, 'Phanpy', '0231', 'Les Phanpy vivent dans les trous qu’ils creusent, près des rivières. Après avoir joué dans la boue, ils ont besoin de faire leur toilette pour se calmer.', '0,5', 'sol', '', '33,5', 'Phanpy,Donphan', '10', '2023-06-16 12:55:55'),
(250, 'Donphan', '0232', 'Sa peau est si dure qu’une collision avec une voiture le laisserait indifférent. En revanche, il est extrêmement sensible à la pluie.', '1,1', 'sol', '', '120,0', 'Phanpy,Donphan', '10', '2023-06-16 12:56:13'),
(251, 'Porygon2', '0233', 'Fruit de la mise à jour d’un Porygon avec des données spéciales, il peut apprendre et se développer de manière autonome.', '0,6', 'normal', '', '32,5', 'Porygon,Porygon2,Porygon-Z', '10', '2023-06-16 12:56:25'),
(252, 'Cerfrousse', '0234', 'Il paraît qu’autrefois, il était doté de plus grands pouvoirs psychiques, car il vivait dans un environnement hostile.', '1,4', 'normal', '', '71,2', 'Cerfrousse,Cerbyllin', '10', '2023-06-16 12:56:42'),
(253, 'Queulorior', '0235', 'La teinte du liquide qui coule de sa queue varie en fonction de son humeur.', '1,2', 'normal', '', '58,0', 'Queulorior', '10', '2023-06-16 12:57:03'),
(254, 'Debugant', '0236', 'Ce Pokémon est débordant d’énergie. Même s’il perd encore et encore, il se relève toujours pour devenir plus fort.', '0,7', 'combat', '', '21,0', 'Debugant', '10', '2023-06-16 12:57:25'),
(255, 'Kapoera', '0237', 'Il assène des coups de pied tout en tournant sur lui-même. Il va parfois si vite qu’il commence à s’enfoncer dans le sol.', '1,4', 'combat', '', '48,0', 'Debugant', '10', '2023-06-16 12:57:48'),
(256, 'Lippouti', '0238', 'Quand il s’aperçoit que son visage est sale, il le lave à l’eau, mais la propreté du reste de son corps ne semble pas le préoccuper.', '0,4', 'glace', 'psy', '6,0', 'Lippouti,Lippoutou', '10', '2023-06-16 12:58:03'),
(257, 'Élekid', '0239', 'Il ne tient plus en place quand un orage approche. Lorsqu’il entend le tonnerre gronder, il devient tout excité.', '0,6', 'electrik', '', '23,5', 'Élekid,Élektek,Élekable', '10', '2023-06-16 12:58:18'),
(258, 'Magby', '0240', 'Ce n’est encore qu’un petit Pokémon craintif. Lorsqu’il est excité ou étonné, du feu s’échappe de son nez ou de sa bouche.', '0,7', 'feu', '', '21,4', 'Magby,Magmar,Maganon', '10', '2023-06-16 12:58:31'),
(259, 'Écrémeuh', '0241', 'Grâce à son lait très nutritif, Écrémeuh contribue depuis longtemps au bien-être des humains et des Pokémon.', '1,2', 'normal', '', '75,5', 'Écrémeuh', '10', '2023-06-16 12:58:56'),
(260, 'Leuphorie', '0242', 'Il suffit de manger une bouchée de l’œuf de Leuphorie pour devenir aimable avec tout le monde.', '1,5', 'normal', '', '46,8', 'Ptiravi,Leveinard,Leuphorie', '10', '2023-06-16 12:59:11'),
(261, 'Raikou', '0243', 'Raikou incarne la vitesse de l’éclair. Les rugissements de ce Pokémon libèrent des ondes de choc provenant du ciel et frappant le sol avec la puissance de la foudre.', '1,9', 'electrik', '', '178,0', 'Raikou', '10', '2023-06-16 12:59:35'),
(262, 'Entei', '0244', 'Entei incarne la colère du magma. On pense que ce Pokémon est né suite à l’éruption d’un volcan. Il peut envoyer d’énormes jets de flammes qui calcinent tout ce qu’ils touchent.', '2,1', 'feu', '', '198,0', 'Entei', '10', '2023-06-16 13:00:09'),
(263, 'Suicune', '0245', 'Suicune incarne la tranquillité d’une source d’eau pure. Il parcourt les plaines avec grâce. Ce Pokémon a le pouvoir de purifier l’eau.', '2,0', 'eau', '', '187,0', 'Suicune', '10', '2023-06-16 13:00:37'),
(264, 'Embrylex', '0246', 'Il naît dans les profondeurs terrestres. Après avoir englouti une quantité de terre équivalente à une montagne, il se transforme en chrysalide.', '0,6', 'roche', 'sol', '72,0', 'Embrylex,Ymphect,Tyranocif', '10', '2023-06-16 13:00:47'),
(265, 'Ymphect', '0247', 'Cette chrysalide file comme une fusée en expulsant les gaz sous pression enfermés dans son corps, sans pouvoir contrôler sa trajectoire.', '1,2', 'roche', 'sol', '152,0', 'Embrylex,Ymphect,Tyranocif', '10', '2023-06-16 13:01:00'),
(266, 'Tyranocif', '0248', 'Ce Pokémon est si fort qu’il est capable de modifier la topographie d’un lieu. Il ne se préoccupe pas des autres.', '2,0', 'roche', 'tenebres', '202,0', 'Embrylex,Ymphect,Tyranocif', '10', '2023-06-16 13:01:11'),
(267, 'Lugia', '0249', 'Les ailes de Lugia renferment une puissance dévastatrice. Un simple battement de ses ailes peut détruire de petites maisons. Du coup, ce Pokémon a choisi de vivre loin de tout, dans les profondeurs océaniques.', '5,2', 'psy', 'vol', '216,0', 'Lugia', '10', '2023-06-16 13:01:32'),
(268, 'Ho-Oh', '0250', 'Les plumes de Ho-Oh brillent de sept couleurs selon l’orientation de son corps par rapport à la lumière. On raconte que ces plumes portent bonheur. On dit aussi que ce Pokémon vit au pied d’un arc-en-ciel.', '3,8', 'feu', 'vol', '199,0', 'Ho-Oh', '10', '2023-06-16 13:01:53'),
(269, 'Celebi', '0251', 'Ce Pokémon est venu du futur en voyageant dans le temps. On raconte que quand Celebi apparaît, cela signifie que le futur sera bon et agréable.', '0,6', 'psy', 'plante', '5,0', 'Celebi', '10', '2023-06-16 13:02:15'),
(270, 'Arcko', '0252', 'Arcko est doté de petits crochets sous les pattes, ce qui lui permet de grimper aux murs. Ce Pokémon attaque en frappant ses ennemis avec son épaisse queue.', '0,5', 'plante', '', '5,0', 'Arcko,Massko,Jungko', '10', '2023-06-16 13:02:31'),
(271, 'Massko', '0253', 'Les feuilles qui poussent sur le corps de Massko sont bien pratiques lorsqu’il veut se camoufler dans la forêt. Ce Pokémon est passé maître dans l’art de grimper aux arbres.', '0,9', 'plante', '', '21,6', 'Arcko,Massko,Jungko', '10', '2023-06-16 13:02:48'),
(272, 'Jungko', '0254', 'Les feuilles qui poussent sur le corps de Jungko sont extrêmement tranchantes. Ce Pokémon est très agile. Il bondit de branche en branche avant de sauter sur son ennemi.', '1,7', 'plante', '', '52,2', 'Arcko,Massko,Jungko', '10', '2023-06-16 13:03:01'),
(273, 'Poussifeu', '0255', 'Poussifeu ne lâche pas son Dresseur d’une semelle, marchant maladroitement derrière lui. Ce Pokémon crache des flammes pouvant atteindre 1 000 °C et des boules de feu qui carbonisent l’ennemi.', '0,4', 'feu', '', '2,5', 'Poussifeu,Galifeu,Braségali', '10', '2023-06-16 13:03:18'),
(274, 'Galifeu', '0256', 'Galifeu muscle ses cuisses et ses mollets en courant dans les champs ou dans les montagnes. Les jambes de ce Pokémon sont très puissantes et rapides, capables de donner 10 coups de pied en 1 seconde.', '0,9', 'feu', 'combat', '19,5', 'Poussifeu,Galifeu,Braségali', '10', '2023-06-16 13:03:30'),
(275, 'Braségali', '0257', 'Au combat, Braségali envoie des flammes ardentes de ses poignets. Il fait preuve d’un courage exceptionnel. Plus l’ennemi est puissant, plus les poignets de ce Pokémon sont ardents.', '1,9', 'feu', 'combat', '52,0', 'Poussifeu,Galifeu,Braségali', '10', '2023-06-16 13:03:41'),
(276, 'Gobou', '0258', 'La nageoire sur la tête de Gobou lui sert de radar hypersensible. Il l’utilise pour sentir les mouvements de l’eau et de l’air. Ainsi, ce Pokémon peut savoir ce qui se passe autour de lui sans avoir à se servir de ses yeux.', '0,4', 'eau', '', '7,6', 'Gobou,Flobio,Laggron', '10', '2023-06-16 13:03:57'),
(277, 'Flobio', '0259', 'Le corps de Flobio est enveloppé par un film fin et collant qui lui permet de vivre hors de l’eau. Ce Pokémon joue dans la vase sur les plages lorsque la marée est basse.', '0,7', 'eau', 'sol', '28,0', 'Gobou,Flobio,Laggron', '10', '2023-06-16 13:04:08'),
(278, 'Laggron', '0260', 'Laggron est très fort. Tellement fort qu’il peut aisément tirer un rocher pesant plus d’une tonne. Ce Pokémon est également doté d’une vue si efficace qu’il peut même voir à travers l’eau trouble.', '1,5', 'eau', 'sol', '81,9', 'Gobou,Flobio,Laggron', '10', '2023-06-16 13:04:21'),
(279, 'Medhyèna', '0261', 'Sans se poser de questions, Medhyèna essaie de mordre tout ce qui bouge. Ce Pokémon pourchasse sa proie jusqu’à ce qu’elle s’épuise. Cependant, il se peut qu’il prenne peur et s’enfuie si la proie riposte.', '0,5', 'tenebres', '', '13,6', 'Medhyèna,Grahyèna', '10', '2023-06-16 13:04:42'),
(280, 'Grahyèna', '0262', 'On peut facilement deviner quand Grahyèna se prépare à attaquer. Il grogne et se met à plat ventre. Ce Pokémon mord sauvagement ses ennemis avec ses crocs acérés.', '1,0', 'tenebres', '', '37,0', 'Medhyèna,Grahyèna', '10', '2023-06-16 13:05:03'),
(281, 'Zigzaton', '0263', 'Il marche en zigzaguant et n’a pas son pareil pour dénicher des trésors dans l’herbe ou sous terre.', '0,4', 'normal', '', '17,5', 'Zigzaton,Linéon', '10', '2023-06-16 13:05:19'),
(282, 'Linéon', '0264', 'Il fonce sur sa proie à une vitesse de 100 km/h mais il rate souvent sa cible, car il ne peut courir qu’en ligne droite.', '0,5', 'normal', '', '32,5', 'Zigzaton,Linéon', '10', '2023-06-16 13:05:34'),
(283, 'Chenipotte', '0265', 'À l’aide de ses pointes arrière, Chenipotte déchire l’écorce des arbres et mange la sève qui coule dessus. Les pattes de ce Pokémon sont dotées de coussinets à ventouses pour adhérer aux parois en verre sans en glisser.', '0,3', 'insecte', '', '3,6', 'Chenipotte', '10', '2023-06-16 13:06:01'),
(284, 'Armulys', '0266', 'Armulys s’accroche à une branche d’arbre avec de la soie pour éviter de tomber. Ce Pokémon y reste tranquillement en attendant son évolution. Il regarde l’extérieur à travers deux petits trous dans son cocon de soie.', '0,6', 'insecte', '', '10,0', 'Chenipotte', '10', '2023-06-16 13:06:26'),
(285, 'Charmillon', '0267', 'La nourriture préférée de Charmillon est le pollen sucré des fleurs. Si on veut voir ce Pokémon, il suffit de laisser une fleur en pot sur un rebord de fenêtre. Charmillon viendra sûrement voir s’il y a du pollen.', '1,0', 'insecte', 'vol', '28,4', 'Chenipotte', '10', '2023-06-16 13:06:47'),
(286, 'Blindalys', '0268', 'Blindalys fabrique son cocon protecteur en s’enveloppant dans la soie qui sort de sa bouche. Une fois la soie autour de son corps, elle se met à durcir. Ce Pokémon prépare son évolution à l’intérieur du cocon.', '0,7', 'insecte', '', '11,5', 'Chenipotte', '10', '2023-06-16 13:07:14'),
(287, 'Papinox', '0269', 'Papinox est instinctivement attiré par la lumière. Des nuées de ce Pokémon sont attirées par les réverbères des villes, où il sème la pagaille en grignotant les feuilles des arbres en bordure de route.', '1,2', 'insecte', 'poison', '31,6', 'Chenipotte', '10', '2023-06-16 13:07:36'),
(288, 'Lombre', '0271', 'Ce Pokémon nocturne s’active au crépuscule. Il se nourrit d’algues qui poussent au fond des rivières.', '1,2', 'eau', 'plante', '32,5', 'Nénupiot,Lombre,Ludicolo', '10', '2023-06-16 13:07:56'),
(289, 'Ludicolo', '0272', 'Les cellules de Ludicolo s’activent s’il entend une musique entraînante, le rendant encore plus puissant.', '1,5', 'eau', 'plante', '55,0', 'Nénupiot,Lombre,Ludicolo', '10', '2023-06-16 13:08:08'),
(290, 'Grainipiot', '0273', 'S’il reste immobile, il a l’air d’une Baie. Il adore surprendre les Pokémon qui tentent de le picorer.', '0,5', 'plante', '', '4,0', 'Grainipiot,Pifeuil,Tengalice', '10', '2023-06-16 13:08:23'),
(291, 'Pifeuil', '0274', 'Il vit au plus profond des forêts. Sa flûte faite avec la feuille de sa tête émet un son inquiétant.', '1,0', 'plante', 'tenebres', '28,0', 'Grainipiot,Pifeuil,Tengalice', '10', '2023-06-16 13:08:33'),
(292, 'Tengalice', '0275', 'Ce gardien des forêts inspirait la crainte. Il peut lire les pensées de ses ennemis et agir en conséquence.', '1,3', 'plante', 'tenebres', '59,6', 'Grainipiot,Pifeuil,Tengalice', '10', '2023-06-16 13:08:45'),
(293, 'Nirondelle', '0276', 'Nirondelle défend courageusement son territoire contre ses ennemis, même les plus puissants. Ce vaillant Pokémon est toujours prêt à relever un défi, mais s’il a faim, il se met à pleurer à chaudes larmes.', '0,3', 'normal', 'vol', '2,3', 'Nirondelle,Hélédelle', '10', '2023-06-16 13:09:00'),
(294, 'Hélédelle', '0277', 'Hélédelle vole dans les cieux en dessinant de grands arcs. Ce Pokémon plonge en piqué dès qu’il repère sa proie. Il attrape fermement la malheureuse cible dans ses serres, empêchant toute fuite.', '0,7', 'normal', 'vol', '19,8', 'Nirondelle,Hélédelle', '10', '2023-06-16 13:09:15'),
(295, 'Bekipan', '0279', 'Il transporte de petits Pokémon dans son bec. Quand il a besoin de reposer ses ailes, il se pose sur la mer.', '1,2', 'eau', 'vol', '28,0', 'Goélise,Bekipan', '10', '2023-06-16 13:09:40'),
(296, 'Tarsal', '0280', 'Il perçoit très précisément les émotions humaines grâce aux cornes rouges sur sa tête.', '0,4', 'psy', 'fée', '6,6', 'Tarsal,Kirlia', '10', '2023-06-16 13:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `p_type`
--

CREATE TABLE `p_type` (
  `feu` int NOT NULL DEFAULT '0',
  `eau` int NOT NULL DEFAULT '0',
  `plante` int NOT NULL DEFAULT '0',
  `glace` int NOT NULL DEFAULT '0',
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_role` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `prenom`, `lastname`, `email`, `pass`, `user_role`) VALUES
(8, 'Timothée', 'Caussignac', 't.caussignac@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$M2xpZnF5R3N1WVVqNndQWQ$1OgoIMWJHC5Aw3VFCSnvB/yhA69Mk5Ur24+h3mcMrVQ', 1),
(10, 'Robot', 'Bot', 'jesuisun@bot.fr', '$argon2id$v=19$m=65536,t=4,p=1$ZkdHQ0J4cXU4MlNabjNtNw$qQsBi4r5mCufdU9qXtW2A/rf7ToyWRvnkQJuUNeKPWA', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `p_type`
--
ALTER TABLE `p_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `l_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `p_type`
--
ALTER TABLE `p_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
