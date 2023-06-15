-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2023 at 11:28 AM
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
(38, 'Grolem', '0076', 'Juste après la mue, son corps est blanc et tendre. Au contact de l’air, sa peau se solidifie et forme une armure. ', '1.4', 'roche', 'sol', '300', 'Racaillou,Gravalanch,Grolem', '8', '2023-06-14 12:33:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
