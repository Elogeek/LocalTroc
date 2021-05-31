-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 31 mai 2021 à 10:13
-- Version du serveur :  8.0.25-0ubuntu0.21.04.1
-- Version de PHP : 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `LocalTroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int UNSIGNED NOT NULL,
  `from_user_fk` int UNSIGNED NOT NULL,
  `user_service_fk` int UNSIGNED NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `from_user_fk`, `user_service_fk`, `content`, `date`) VALUES
(1, 3, 1, 'Bonjour, pourriez-vous me donner un coup de pouce pour ma robe,svp?', '2021-05-15 09:35:08'),
(2, 1, 1, 'Bonjour, oui de soucis.', '2021-05-15 10:00:42');

-- --------------------------------------------------------

--
-- Structure de la table `opinion_service`
--

CREATE TABLE `opinion_service` (
  `id` int UNSIGNED NOT NULL,
  `user_service_fk` int UNSIGNED NOT NULL,
  `author_fk` int UNSIGNED NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `opinion_service`
--

INSERT INTO `opinion_service` (`id`, `user_service_fk`, `author_fk`, `content`, `date`) VALUES
(1, 1, 3, 'John est un super troqueur, service rapide. Il a très vite compris ce que je voulais, je le recommande +++.', '2021-05-16 09:31:18');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `role_fk` int UNSIGNED NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `lastName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role_fk`, `firstname`, `lastName`, `email`, `password`) VALUES
(1, 3, 'John', 'Doe', 'doejohn@gmail.com', 'azerty000'),
(2, 1, 'elodie', 'elogeek', 'elodie@gmail.com', 'azerty007'),
(3, 2, 'jane', 'doe', 'doejane@gmail.com', 'azerty000'),
(7, 1, 'elodie2', 'elogeek2', 'elodie2@gmail.com', 'azerty007');

-- --------------------------------------------------------

--
-- Structure de la table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int UNSIGNED NOT NULL,
  `user_fk` int UNSIGNED NOT NULL,
  `pseudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `code_zip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `more_infos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_fk`, `pseudo`, `avatar`, `birthday`, `city`, `address`, `code_zip`, `country`, `more_infos`, `phone`) VALUES
(1, 1, 'John', NULL, '2000-05-26 09:21:27', 'Chimay', 'Rue du château,13', '6464', 'Belgique', 'Graduat couture, j\'aime la musique et faire les courses', '+324765214'),
(2, 2, 'elogeek', NULL, '1992-05-05 09:23:28', 'Chimay', 'Rue des Ours, 24', '6464', 'Belgique', 'j\'aime la musique et les voyages .', NULL),
(3, 3, 'jane', NULL, '2000-05-26 09:25:35', 'Forges', 'Rue de la ferme,56', '6464', 'Begique', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_service`
--

CREATE TABLE `user_service` (
  `id` int UNSIGNED NOT NULL,
  `user_fk` int UNSIGNED NOT NULL,
  `service_date` datetime DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `user_service`
--

INSERT INTO `user_service` (`id`, `user_fk`, `service_date`, `subject`, `description`) VALUES
(1, 3, '2021-05-15 09:28:40', 'couture', ' J\'ai besoin d\'une personne qui pourrait m\'aider à réaliser le patron de ma robe de mariée. Je suis de Forges, l\'évènement est prévu le 15/mai/2021.'),
(2, 3, '2021-05-05 05:05:05', 'Service test', 'desc test'),
(18, 3, '2021-05-05 05:05:05', 'Service test', 'desc test');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_idx2` (`from_user_fk`),
  ADD KEY `user_service_fk_idx2` (`user_service_fk`);

--
-- Index pour la table `opinion_service`
--
ALTER TABLE `opinion_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_fk_idx` (`author_fk`),
  ADD KEY `user_service_fk_idx` (`user_service_fk`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `role_fk_idx` (`role_fk`);

--
-- Index pour la table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userInfo_fk_idx` (`user_fk`);

--
-- Index pour la table `user_service`
--
ALTER TABLE `user_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_idx` (`user_fk`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `opinion_service`
--
ALTER TABLE `opinion_service`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user_service`
--
ALTER TABLE `user_service`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `user-fk` FOREIGN KEY (`from_user_fk`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_service_fkBis` FOREIGN KEY (`user_service_fk`) REFERENCES `user_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `opinion_service`
--
ALTER TABLE `opinion_service`
  ADD CONSTRAINT `author_fk` FOREIGN KEY (`author_fk`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_service_fk` FOREIGN KEY (`user_service_fk`) REFERENCES `user_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role_fk` FOREIGN KEY (`role_fk`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `userInfo_fk` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_service`
--
ALTER TABLE `user_service`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
