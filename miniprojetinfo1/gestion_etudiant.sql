-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 14 mars 2022 à 13:41
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_etudiant`
--

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `date`, `nom`, `prenom`, `login`, `pass`) VALUES
(1, '2022-03-12 15:58:08', 'Saad', 'Walid', 'walid.saadd@gmail.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `cin` int(8) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cpassword` varchar(40) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `Classe` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`cin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Structure de la table `classe`
--
CREATE TABLE 'classe' (
  `id` int(10) UNSIGNED NOT NULL,
  `semaine` varchar(7) NOT NULL,
  `groupe_name` varchar(7) NOT NULL,
  `module` varchar(24) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- FOREIGN KEY pour la table `classe`
--
ALTER TABLE classe
ADD FOREIGN KEY (enseignant_id)
REFERENCES enseignant (id);
--
-- Structure de la table `absence`
--
CREATE TABLE 'absence' (
  `id` int(10) UNSIGNED NOT NULL,
  `day_name` varchar(10) NOT NULL,
  `session_date` DATE NOT NULL,
  'am_seesion' NUMBER(1) NOT NULL DEFAULT 0, -- 0 or 1
  'pm_seesion' NUMBER(1) NOT NULL DEFAULT 0, -- 0 or 1
  'justified' NUMBER(1) NOT NULL DEFAULT 0, -- 0 or 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour la table `absenses`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour la table `absenses`
--
ALTER TABLE `absence`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- FOREIGN KEY pour la table `absence`
--
ALTER TABLE absence
ADD FOREIGN KEY (etudiant_id)
REFERENCES etudiant (id);

ALTER TABLE absence
ADD FOREIGN KEY (classe_id)
REFERENCES classe (id);

COMMIT;


--
-- Create a new class session
-- 
INSERT INTO `classe` (`id`, `semaine`, `groupe_name`, `module`, 'enseignant_id') VALUES
(1, '17/2022', '1-INFOA', 'Tech. Web', 1);

INSERT INTO `absence` (`id`, `day_name`, `session_date`, 'etudiant_id', 'classe_id') VALUES
(1, 'Lundi', '07-03-2022', 1, 1);

--
-- Fill form query
--
SELECT semaine, groupe_name, module FROM `classe`
WHERE semaine = '17/2022' AND module = 'Tech. Web' AND groupe_name = '1-INFOA'; -- get class details

SELECT a.day_name as 'day_name', a.session_date as 'session_date', a.am_seesion as 'am_seesion', a.pm_seesion as 'pm_seesion', concat(e.nom, e.prenom) as 'nom_etudiant'
FROM `absence` as a, 'classe' as c, 'etudiant' as e
WHERE a.classe_id = c.id AND c.semaine = '17/2022' AND c.module = 'Tech. Web' AND c.groupe_name = '1-INFOA'
GROUP BY concat(e.nom, e.prenom); -- get class absences

--
-- Get group absence status
--
SELECT concat(e.nom, e.prenom) as 'nom_etudiant', sum(a.justified) as 'justified', count(*) - sum(a.justified) as 'non_justified', count(*) as 'total'
FROM `absence` as a, 'classe' as c, 'etudiant' as e
WHERE a.session_date < '01-03-2022' AND a.session_date > '30-03-2022' AND c.groupe_name = '1-INFOA' AND a.classe_id = c.id AND a.etudiant_id = e.id;
GROUP BY concat(e.nom, e.prenom);