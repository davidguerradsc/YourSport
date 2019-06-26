-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 26 Juin 2019 à 11:54
-- Version du serveur :  5.6.37
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `yoursport`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement` int(50) NOT NULL,
  `lieu` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `membre_id`, `sport_id`, `titre`, `slug`, `ville`, `departement`, `lieu`, `adresse`, `details`, `date`, `heure`) VALUES
(5, 2, 5, 'Glisse dans la rue', 'glisse-dans-la-rue', 'elancourt', 78, 'skatepark', '3e arbre à gauche', 'Prévoir les bibines', '2019-05-10 00:00:00', '15:00:00'),
(6, 2, 4, 'surf chez Moonshutle', 'surf-chez-moonshutle', 'paris', 75, 'dans l''eau', 'rue de lourmel', 'a voir', '2019-05-23 00:00:00', '15:05:00');

-- --------------------------------------------------------

--
-- Structure de la table `evenement_membre`
--

CREATE TABLE IF NOT EXISTS `evenement_membre` (
  `evenement_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `evenement_membre`
--

INSERT INTO `evenement_membre` (`evenement_id`, `membre_id`) VALUES
(5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_naissance` datetime NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement` int(50) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `pseudo`, `email`, `password`, `date_de_naissance`, `ville`, `departement`, `date_inscription`, `roles`) VALUES
(2, 'Guerra', 'david', 'dave', 'david@gmail.com', '$2y$13$pGZEMuST223uYFRe9HSyrO2T86y3zwdo.056R9E3urA9ugAHw8zfe', '1979-09-08 00:00:00', 'trappes', 78, '2019-05-07 08:53:25', 'a:2:{i:0;s:11:"ROLE_MEMBRE";i:1;s:10:"ROLE_ADMIN";}'),
(4, 'Guerra', 'David', 'dave', 'david.guerradsc@gmail.com', '$2y$13$zKRhvLjpdwnu/hg5sPFDOuv5bnSj5B.oUVCozMbHjMJ/cxIxaAeqW', '1999-12-21 00:00:00', 'elancourt', 78, '2019-06-24 21:11:15', 'a:1:{i:0;s:11:"ROLE_MEMBRE";}'),
(9, 'admin', 'admin', 'admin', 'admintest@admin.test', '$2y$13$mOKQ1bJ7Om/NdigD/wY82OBZKpgknw0vhy4N9Zz0zcaJJSWA7KaEi', '1987-05-23 00:00:00', 'elancourt', 78, '2019-06-26 08:58:38', 'a:1:{i:0;s:9:"ROLE_USER";}'),
(12, 'admin', 'admin', 'admin', 'admin@admin.admin', '$2y$13$0y90RDELJ/fNUstVR4xrZ.105TvMGlqGwQMnxOn7522nDDcCjjg1u', '1999-12-12 00:00:00', 'admin', 75, '2019-06-26 11:45:46', 'a:2:{i:0;s:9:"ROLE_USER";i:1;s:10:"ROLE_ADMIN";}');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190426100919', '2019-04-26 10:09:30'),
('20190506095832', '2019-05-06 09:59:15'),
('20190510082422', '2019-06-24 20:00:03');

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
  `id` int(11) NOT NULL,
  `nom` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `sports`
--

INSERT INTO `sports` (`id`, `nom`, `slug`, `image`) VALUES
(1, 'Football', 'football', 'YourSport_Default_Foot.webp'),
(2, 'Basketball', 'basketball', 'YourSport_Default_BasketBall.webp'),
(3, 'Vélo', 'velo', 'YourSport_Default_Cycle.webp'),
(4, 'Surf', 'surf', 'YourSport_Default_SurfBoard.webp'),
(5, 'Glisse urbaine', 'glisse_urbaine', 'YourSport_Default_SkateBoard.webp');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B26681E6A99F74A` (`membre_id`),
  ADD KEY `IDX_B26681EAC78BCF8` (`sport_id`);

--
-- Index pour la table `evenement_membre`
--
ALTER TABLE `evenement_membre`
  ADD PRIMARY KEY (`evenement_id`,`membre_id`),
  ADD KEY `IDX_45412BABFD02F13` (`evenement_id`),
  ADD KEY `IDX_45412BAB6A99F74A` (`membre_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_B26681E6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_B26681EAC78BCF8` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`);

--
-- Contraintes pour la table `evenement_membre`
--
ALTER TABLE `evenement_membre`
  ADD CONSTRAINT `FK_45412BAB6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_45412BABFD02F13` FOREIGN KEY (`evenement_id`) REFERENCES `evenement` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
