-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 17:02
-- Version du serveur :  5.5.57-0+deb8u1
-- Version de PHP :  5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `Private content`
--

-- --------------------------------------------------------

--
-- Structure de la table `jokes`
--

CREATE TABLE IF NOT EXISTS `jokes` (
`joke_ID` int(11) NOT NULL,
  `joke_content` text NOT NULL,
  `joke_audience` varchar(200) NOT NULL,
  `joke_tagType` varchar(200) NOT NULL,
  `joke_dateCreation` datetime NOT NULL,
  `joke_dateLastEdit` datetime DEFAULT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jokes`
--

INSERT INTO `jokes` (`joke_ID`, `joke_content`, `joke_audience`, `joke_tagType`, `joke_dateCreation`, `joke_dateLastEdit`, `user_ID`) VALUES
(1, 'Pour que ça marche en PHP, il faut avoir des echo logiques hein !', 'all', 'header', '2017-08-25 17:22:27', NULL, 1),
(2, 'Les requêtes SQL, on appelle ça un cercle vicelard', 'all', 'header', '2017-08-25 17:23:00', NULL, 1),
(3, 'Bonjour Macha, mon mari encule mon chat ... est-ce que mon chat est normal ?', 'adult', 'header', '2017-08-25 17:23:47', NULL, 1),
(4, 'Un concentré n''est pas forcément un imbécile qui se trouve au milieu d''un cercle', 'all', 'header', '2017-08-25 17:24:05', NULL, 1),
(5, 'Aujourd''hui qui c''est qui nous apprend Silex ??? ... Bah c''est Pierre !', 'all', 'header', '2017-08-25 17:25:43', NULL, 1),
(6, 'Là on se fait Angular, jeudi on se fera encular', 'adult', 'header', '2017-08-25 17:26:22', NULL, 1),
(7, 'J''avais une faille, je me suis mal préparé, il me l''a mis dans le SQL', 'adult', 'header', '2017-08-25 17:27:10', NULL, 1),
(8, 'Y''a pas de gênes, là où il y a de l''ADN !', 'all', 'header', '2017-08-25 17:28:44', NULL, 1),
(9, 'Ne confondez pas "eau des WC" et "eau de vaisselle"', 'all', 'header', '2017-08-25 17:29:11', NULL, 1),
(10, 'Les radis c''est pas pour les radins !', 'all', 'header', '2017-08-25 17:30:39', NULL, 1),
(11, 'L''amour c''est comme le pognon, ça va ça vient et quand ça vient ça va !', 'all', 'header', '2017-08-25 17:37:23', NULL, 1),
(12, 'Si tu suis le chemin qui s''appelle "plus tard", tu arriveras à la place qui s''appelle "jamais"', 'all', 'header', '2017-08-25 17:38:12', NULL, 1),
(13, 'Avant Linux, mon ordi plantait tout le temps, je n’avais pas de vie sociale, les filles me fuyaient... maintenant, mon ordi ne plante plus !', 'all', 'paragraph', '2017-08-25 17:39:48', NULL, 1),
(14, 'Les mots de passe sont comme les sous-vêtements. On ne devrait pas les laisser traîner là où des personnes pourraient les voir. On devrait en changer régulièrement. On ne devrait pas les prêter à des inconnus', 'all', 'paragraph', '2017-08-25 17:51:55', NULL, 1),
(15, 'C''est l''histoire d''un pingouin qui respire par les fesses. Un jour il s’assoit et il meurt.', 'adult', 'header', '2017-08-27 10:18:41', '2017-09-04 15:09:30', 3),
(16, 'C''est l''histoire d''un poil. Avant il était bien maintenant il est pubien !', 'adult', 'header', '2017-08-27 10:20:12', '2017-09-04 15:00:16', 3),
(17, 'Certains hommes n''ont que ce qu''ils méritent : les autres sont célibataires.', 'all', 'header', '2017-08-27 10:21:29', NULL, 3),
(18, 'Je ne sais pas ce qui est possible ou non alors j''agis comme si tout est possible. Car est-on certain à 100% que l''on ne peut pas y arriver ? La réponse est non ! La question est donc de savoir si nous sommes ouverts à la possibilité que les choses soient totalement possibles ?', 'all', 'paragraph', '2017-08-29 08:26:47', '2017-09-19 16:25:52', 3),
(19, 'Ne prends pas la suite de ce texte comme une leçon de morale mais comme une question importante que j''ai à te poser et à laquelle je te demande surtout de ne pas me répondre... Est-ce que tu veux aller bien dans la vie ?', 'all', 'paragraph', '2017-08-29 08:30:34', '2017-10-26 15:44:18', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_ID` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_dateCreation` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

-- Private content

--
-- Index pour les tables exportées
--

--
-- Index pour la table `jokes`
--
ALTER TABLE `jokes`
 ADD PRIMARY KEY (`joke_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `jokes`
--
ALTER TABLE `jokes`
MODIFY `joke_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
