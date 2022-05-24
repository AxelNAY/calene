-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 05 Janvier 2021 à 17:49
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `Projet_BTS`
--

-- --------------------------------------------------------

--
-- Structure de la table `vehicule 1`
--

CREATE TABLE IF NOT EXISTS `vehicule 1` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Speed` float NOT NULL,
  `Volt` float NOT NULL,
  `Amp` float NOT NULL,
  `Long` double NOT NULL,
  `Lat` double NOT NULL,
  `Time` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `voiture 2`
--

CREATE TABLE IF NOT EXISTS `voiture 2` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Speed` float NOT NULL,
  `Volt` float NOT NULL,
  `Amp` float NOT NULL,
  `Long` double NOT NULL,
  `Lat` double NOT NULL,
  `Time` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
