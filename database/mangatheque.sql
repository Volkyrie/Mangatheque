-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 25 juil. 2025 à 12:54
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mangatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`author_id`, `name`) VALUES
(1, 'TurtleMe'),
(6, 'Huan Yu');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'webtoon'),
(2, 'anime');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `user_id` int NOT NULL,
  `manga_id` int NOT NULL,
  UNIQUE KEY `USER_ID` (`user_id`),
  UNIQUE KEY `MANGA_ID` (`user_id`,`manga_id`),
  KEY `manga_id_2` (`manga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`user_id`, `manga_id`) VALUES
(5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `manga`
--

DROP TABLE IF EXISTS `manga`;
CREATE TABLE IF NOT EXISTS `manga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cover` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `synopsis` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `published_at` date NOT NULL,
  `author_id` int NOT NULL,
  `nb_tomes` int NOT NULL,
  `likes` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `AUTHOR` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `manga`
--

INSERT INTO `manga` (`id`, `cover`, `name`, `synopsis`, `rating`, `published_at`, `author_id`, `nb_tomes`, `likes`) VALUES
(1, 'TheBeginningAfterTheEnd', 'The Beginning After the End', 'Le roi Grey a une force, une richesse et un prestige inégalés. Cependant, la solitude persiste étroitement derrière ceux qui ont un grand pouvoir. Sous l\'extérieur glamour d\'un roi puissant se cache la coquille de l\'homme, sans but ni volonté.\r\n\r\nRéincarné dans un nouveau monde rempli de magie et de monstres, le roi a une seconde chance de revivre sa vie en tant qu\'Arthur Leywin, premier fils d\'un modeste couple d\'aventuriers pratiquant la magie.\r\n\r\nCorriger les erreurs de son passé ne sera cependant pas son seul défi. Sous la paix et la prospérité du nouveau monde se cache un courant sous-jacent qui menace de détruire tout ce pour quoi il a travaillé, remettant en question son rôle et la raison de sa nouvelle naissance.', 2, '2021-12-31', 1, 11, 1),
(2, 'umamusume.jpg', 'Umamusume: Pretty Derby', 'In a world similar to Earth, great racehorses of the past have the chance to be reborn as kemonomimi. Being reborn as a horse girl allows them to keep their former speed and endurance. The best of these horse girls goes to train at Tokyo\'s Tracen Academy, hopefully moving on to fame and fortune as both racers and idols.', 0, '2018-05-08', 6, 13, 0);

-- --------------------------------------------------------

--
-- Structure de la table `mangas_categories`
--

DROP TABLE IF EXISTS `mangas_categories`;
CREATE TABLE IF NOT EXISTS `mangas_categories` (
  `manga_id` int NOT NULL,
  `category_id` int NOT NULL,
  KEY `MANGA_ID` (`manga_id`),
  KEY `CATEGORY_ID` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mangas_categories`
--

INSERT INTO `mangas_categories` (`manga_id`, `category_id`) VALUES
(1, 1),
(2, 2),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `created_at`) VALUES
(4, 'test', 'test@test.com', '$2y$10$Qg2P308wJIONd/QRtx0WaOQGbZLU6pacTMifGp3oxKh.EJVuDsMXq', '2025-07-10 11:55:05'),
(5, 'test2', 'test@test.fr', '$2y$10$kHOAUyvZe5IqyylKSsvtKuGTwksCFn0T6bxGAq6mO05.sUwgZsaDy', '2025-07-10 12:38:35');

-- --------------------------------------------------------

--
-- Structure de la table `users_comments`
--

DROP TABLE IF EXISTS `users_comments`;
CREATE TABLE IF NOT EXISTS `users_comments` (
  `user_id` int NOT NULL,
  `manga_id` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  KEY `USER_COMMENT` (`user_id`),
  KEY `MANGA_COMMENT` (`manga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users_ratings`
--

DROP TABLE IF EXISTS `users_ratings`;
CREATE TABLE IF NOT EXISTS `users_ratings` (
  `user_id` int NOT NULL,
  `manga_id` int NOT NULL,
  `rating` int NOT NULL,
  KEY `USER_RATING` (`user_id`),
  KEY `MANGA_RATING` (`manga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users_ratings`
--

INSERT INTO `users_ratings` (`user_id`, `manga_id`, `rating`) VALUES
(5, 1, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`),
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `manga`
--
ALTER TABLE `manga`
  ADD CONSTRAINT `manga_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mangas_categories`
--
ALTER TABLE `mangas_categories`
  ADD CONSTRAINT `mangas_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `mangas_categories_ibfk_3` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`);

--
-- Contraintes pour la table `users_comments`
--
ALTER TABLE `users_comments`
  ADD CONSTRAINT `users_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `users_comments_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`);

--
-- Contraintes pour la table `users_ratings`
--
ALTER TABLE `users_ratings`
  ADD CONSTRAINT `users_ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `users_ratings_ibfk_2` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
