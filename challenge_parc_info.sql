-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 23 fév. 2022 à 14:41
-- Version du serveur : 10.3.31-MariaDB
-- Version de PHP : 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bxxxecxn_challenge_parc_info`
--

-- --------------------------------------------------------

--
-- Structure de la table `chopin_user`
--

CREATE TABLE `chopin_user` (
  `FIRSTNAME` char(32) NOT NULL,
  `LASTNAME` char(32) NOT NULL,
  `ROLE` char(255) NOT NULL,
  `EMAIL` char(255) NOT NULL,
  `PASSWORD` char(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chopin_user`
--

INSERT INTO `chopin_user` (`FIRSTNAME`, `LASTNAME`, `ROLE`, `EMAIL`, `PASSWORD`) VALUES
('Admin', 'Doe', 'admin', 'admin@outlook.fr', '$2y$10$s39HpFnB4hkubtuz/yxn7eYvvC23EhbPnsLVp2p5YNjyFw9RIep9K'),
('Prof', 'Doe', 'professor', 'professor@outlook.fr', '$2y$10$seffl.3p3FHQeig4x3wWo.Bz8DBp/SjjK3Zp1jf.8rR.PU7.Hh9aS'),
('Student', 'Doe', 'student', 'student@outlook.fr', '$2y$10$AoTs292Gjv09EbPa1Txpu.KBRXw58UqX8MOWFAIFQE1i2rfXFUjsG'),
('Ugo', 'Zanzi', 'student', 'ugo.zanzi@gmail.com', '$2y$12$zok/x7scZctwbwjssqWt6uSSIMUIyxiMB4uLLznsQYVj9QErWukI.'),
('Lucie', 'Roulier', 'student', 'roulier.lucie@outlook.fr', '$2y$12$u1670KAGB0f3I..4qHaPvejmL5NZVsWOjqFSbX5MGUP1flFdu61ja'),
('Jean-franÃ§ois', 'zanzi', 'student', 'jeanfrancois.zanzi@gmail.fr', '$2y$12$ZdNDfLYE.sedc6eTLg2kjOQxaP63OBYcCb36fLBmimZjUqGsrgx/G'),
('Jean', 'GrandEst', 'grandest', 'grandest@outlook.fr', '$2y$10$xu/UzDjlaXcWsJ3ZA6ZN8eHBe2Dw84l0BfYzUOW3S0xAyRfNO.wMS'),
('test', 'test', 'student', 'test@test.test', '$2y$12$uR7vp1hK6tXEn2.0T0zbouHnUJ40l5yrrIZPZ4p/MsgsKBXC3TxZi'),
('Lucie', 'Roulier', 'student', 'testaa@outlook.fr', '$2y$12$Ha0G9GKhL9dmAB76PzoOA.M/MqAlX0v.pCb6pf1K7wCtQZ.vqCsVe'),
('Oui', 'Non', 'student', 'oui@gmail.com', '$2y$12$skkd3oczbeNtfKlxP4uZke3YQxyUj8sNftOY6IK8IV0oOWIOsrWgq');

-- --------------------------------------------------------

--
-- Structure de la table `desktop`
--

CREATE TABLE `desktop` (
  `MAC_ADDRESS` char(32) NOT NULL,
  `INE_NUMBER` char(32) NOT NULL,
  `RAM` bigint(4) DEFAULT NULL,
  `BRAND` char(32) NOT NULL,
  `OPERATING_SYSTEM` char(32) DEFAULT NULL,
  `STORAGE` bigint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `desktop`
--

INSERT INTO `desktop` (`MAC_ADDRESS`, `INE_NUMBER`, `RAM`, `BRAND`, `OPERATING_SYSTEM`, `STORAGE`) VALUES
('2525', '15151515', 16, 'HP', 'Windows', 2000),
('00:37:6C:E2:EB:62', '4584235468455', 8, 'martÃ©riel.net', 'Windows', 1000),
('ggg', '12', 16, 'HP', 'Windows', 2555);

-- --------------------------------------------------------

--
-- Structure de la table `laptop`
--

CREATE TABLE `laptop` (
  `MAC_ADDRESS` char(32) NOT NULL,
  `INE_NUMBER` char(32) NOT NULL,
  `RAM` bigint(4) DEFAULT NULL,
  `GRAND_EST` char(32) NOT NULL,
  `BRAND` char(32) NOT NULL,
  `OPERATING_SYSTEM` char(32) DEFAULT NULL,
  `STORAGE` bigint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `laptop`
--

INSERT INTO `laptop` (`MAC_ADDRESS`, `INE_NUMBER`, `RAM`, `GRAND_EST`, `BRAND`, `OPERATING_SYSTEM`, `STORAGE`) VALUES
('00:37:6C:E2:EB:62', '071065745EE', 8, 'Oui', 'HP', 'Windows', 128),
('12', '15151515', 16, 'Oui', 'HP', 'Windows', 250),
('32', '717184', 8, 'Non', 'HP', 'Linux', 128);

-- --------------------------------------------------------

--
-- Structure de la table `professor`
--

CREATE TABLE `professor` (
  `INE_NUMBER` char(32) NOT NULL,
  `EMAIL` char(255) NOT NULL,
  `SIO` tinyint(1) DEFAULT NULL,
  `ECT` tinyint(1) DEFAULT NULL,
  `AP` tinyint(1) DEFAULT NULL,
  `SAM` tinyint(1) DEFAULT NULL,
  `CI` tinyint(1) DEFAULT NULL,
  `MCO` tinyint(1) DEFAULT NULL,
  `NDRC` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professor`
--

INSERT INTO `professor` (`INE_NUMBER`, `EMAIL`, `SIO`, `ECT`, `AP`, `SAM`, `CI`, `MCO`, `NDRC`) VALUES
('00001', 'professor@outlook.fr', 1, 1, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `smartphone`
--

CREATE TABLE `smartphone` (
  `PHONE_NUMBER` char(10) NOT NULL,
  `INE_NUMBER` char(32) NOT NULL,
  `BRAND` char(32) NOT NULL,
  `OPERATING_SYSTEM` char(32) DEFAULT NULL,
  `STORAGE` bigint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `smartphone`
--

INSERT INTO `smartphone` (`PHONE_NUMBER`, `INE_NUMBER`, `BRAND`, `OPERATING_SYSTEM`, `STORAGE`) VALUES
('0679551648', '15151515', 'XIAOMI', 'ANDROID', 128),
('0651006913', '071065745EE', 'Redmi', 'Android', 128);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `INE_NUMBER` char(32) NOT NULL,
  `PHONE_PROVIDER` char(32) DEFAULT NULL,
  `EMAIL` char(255) NOT NULL,
  `INTERNET_PROVIDER` char(32) DEFAULT NULL,
  `BIRTHDAY` date NOT NULL,
  `CLASS` char(32) NOT NULL,
  `CREATION_DATE` datetime NOT NULL,
  `MODIFICATION_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPLOAD` tinyint(1) DEFAULT NULL,
  `DOWNLOAD` tinyint(1) DEFAULT NULL,
  `HEADPHONES` tinyint(1) DEFAULT NULL,
  `MICROPHONE` tinyint(1) DEFAULT NULL,
  `WEBCAM` tinyint(1) DEFAULT NULL,
  `DATA` varchar(128) DEFAULT NULL,
  `TOKEN` varchar(60) DEFAULT NULL,
  `CONFIRMED_AT` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`INE_NUMBER`, `PHONE_PROVIDER`, `EMAIL`, `INTERNET_PROVIDER`, `BIRTHDAY`, `CLASS`, `CREATION_DATE`, `MODIFICATION_DATE`, `UPLOAD`, `DOWNLOAD`, `HEADPHONES`, `MICROPHONE`, `WEBCAM`, `DATA`, `TOKEN`, `CONFIRMED_AT`) VALUES
('4584235468455', NULL, 'student@outlook.fr', 'FREE', '1997-10-02', 'SIO', '2021-12-14 00:00:00', '2021-12-13 23:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('15151515', 'Free', 'roulier.lucie@outlook.fr', 'Free', '1997-10-02', 'SIO', '2021-12-16 09:10:09', '2021-12-23 20:11:19', 100, 100, 1, 0, 1, NULL, NULL, NULL),
('123465789EE', NULL, 'jeanfrancois.zanzi@gmail.fr', NULL, '2002-06-13', 'SIO', '2021-12-16 09:41:08', '2021-12-16 08:41:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('071065745EE', 'Free', 'ugo.zanzi@gmail.com', 'Orange', '2002-06-13', 'SIO', '2021-12-16 13:27:04', '2021-12-17 12:29:38', NULL, NULL, 0, 0, 0, NULL, 'G8Yzzz7PqNYZCqgY0ulLH7nhdLhRQ6lFQoX5vDzw6WsAbvodbhtoYMZSAKTZ', NULL),
('717184', NULL, 'oui@gmail.com', NULL, '2021-12-17', 'SAM', '2021-12-17 17:47:02', '2021-12-17 16:47:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('test', NULL, 'test@test.test', NULL, '2021-12-15', 'ECT', '2021-12-17 14:19:25', '2021-12-17 13:19:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('12', NULL, 'testaa@outlook.fr', NULL, '1997-10-02', 'MCO', '2021-12-17 14:35:48', '2021-12-17 13:35:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tablet`
--

CREATE TABLE `tablet` (
  `MAC_ADDRESS` char(32) NOT NULL,
  `INE_NUMBER` char(32) NOT NULL,
  `BRAND` char(32) NOT NULL,
  `OPERATING_SYSTEM` char(32) DEFAULT NULL,
  `STORAGE` bigint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tablet`
--

INSERT INTO `tablet` (`MAC_ADDRESS`, `INE_NUMBER`, `BRAND`, `OPERATING_SYSTEM`, `STORAGE`) VALUES
('00:37:6C:E2:EB:62', '071065745EE', 'Apple', 'IOS', 256),
('Z', '12', 'HP', 'Android', 128),
('a', '15151515', 'Samsung', 'Android', 128);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chopin_user`
--
ALTER TABLE `chopin_user`
  ADD PRIMARY KEY (`EMAIL`);

--
-- Index pour la table `desktop`
--
ALTER TABLE `desktop`
  ADD PRIMARY KEY (`MAC_ADDRESS`),
  ADD KEY `I_FK_DESKTOP_STUDENT` (`INE_NUMBER`);

--
-- Index pour la table `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`MAC_ADDRESS`),
  ADD KEY `I_FK_LAPTOP_STUDENT` (`INE_NUMBER`);

--
-- Index pour la table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`INE_NUMBER`),
  ADD UNIQUE KEY `I_FK_PROFESSOR_CHOPIN_USER` (`EMAIL`);

--
-- Index pour la table `smartphone`
--
ALTER TABLE `smartphone`
  ADD PRIMARY KEY (`PHONE_NUMBER`),
  ADD KEY `I_FK_SMARTPHONE_STUDENT` (`INE_NUMBER`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`INE_NUMBER`),
  ADD UNIQUE KEY `I_FK_STUDENT_CHOPIN_USER` (`EMAIL`),
  ADD KEY `I_FK_STUDENT_PHONE_PROVIDER` (`PHONE_PROVIDER`),
  ADD KEY `I_FK_STUDENT_HOME_PROVIDER` (`INTERNET_PROVIDER`),
  ADD KEY `PHONE_PROVIDER` (`PHONE_PROVIDER`),
  ADD KEY `PHONE_PROVIDER_2` (`PHONE_PROVIDER`,`INTERNET_PROVIDER`);

--
-- Index pour la table `tablet`
--
ALTER TABLE `tablet`
  ADD PRIMARY KEY (`MAC_ADDRESS`),
  ADD KEY `I_FK_TABLET_STUDENT` (`INE_NUMBER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
