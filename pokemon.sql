-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2023 at 11:48 AM
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
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `description` varchar(255) NOT NULL,
  `taille` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `type-2` varchar(255) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `evolutions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pokemon`
--

INSERT INTO `pokemon` (`id`, `nom`, `numero`, `img`, `description`, `taille`, `type`, `type-2`, `poids`, `evolutions`) VALUES
(1, 'Bulbizarre', '0001', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png', 'Il y a une graine sur son dos depuis sa naissance.\r\nElle grossit un peu chaque jour.', '0.7', 'plante', 'poison', '6.9', 'Bulbizarre,Herbizarre,Florizarre'),
(2, 'Salamèche', '0004', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png', 'Il préfère ce qui est chaud. En cas de pluie, de la vapeur se forme autour de sa queue.\r\n\r\n', '0.6', 'feu', '', '8.5', 'Salamèche,Reptincel,Dracaufeu'),
(3, 'Herbizarre', '0002', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/002.png', 'Son bulbe dorsal est devenu si gros qu’il ne peut plus se tenir sur ses pattes postérieures.', '1.0', 'plante', 'poison', '13.0', 'Bulbizarre,Herbizarre,Florizarre'),
(4, 'Florizarre', '0003', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/003.png', 'Sa plante donne une grosse fleur quand elle absorbe les rayons du soleil. Il est toujours à la recherche des endroits les plus ensoleillés.', '2.0', 'plante', 'poison', '100', 'Bulbizarre,Herbizarre,Florizarre'),
(5, 'Reptincel', '0005', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/005.png', 'Il est très brutal. En combat, il se sert de ses griffes acérées et de sa queue enflammée pour mettre en pièces ses adversaires.', '1.1', 'feu', '', '19.0', 'Salamèche,Reptincel,Dracaufeu'),
(6, 'Dracaufeu', '0006', 'https://assets.pokemon.com/assets/cms2/img/pokedex/full/006.png', 'On raconte que plus un Dracaufeu a vécu de combats difficiles, plus sa flamme est brûlante.', '1.7', 'feu', 'vol', '90.5', 'Salamèche,Reptincel,Dracaufeu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
