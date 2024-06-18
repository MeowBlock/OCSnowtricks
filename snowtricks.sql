-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2024 at 07:19 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snowtricks`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `trick_id` int NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CF675F31B` (`author_id`),
  KEY `IDX_9474526CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `author_id`, `trick_id`, `content`) VALUES
(40, 383, 126, 'Lorem phasellus viverra aliquet rhoncus interdum.'),
(41, 386, 128, 'Lorem viverra rhoncus aenean'),
(42, 397, 134, 'Lorem Etiam lobortis sit');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231201164424', '2023-12-29 15:34:26', 528),
('DoctrineMigrations\\Version20231221155822', '2023-12-29 15:34:26', 31),
('DoctrineMigrations\\Version20231221171953', '2023-12-29 15:34:26', 176),
('DoctrineMigrations\\Version20231222130208', '2023-12-29 15:34:26', 18),
('DoctrineMigrations\\Version20231229153351', '2023-12-29 15:34:26', 14);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id`, `name`) VALUES
(66, 'Les Basiques'),
(67, 'Figures butter'),
(68, 'Spins, Flips et Grabs'),
(69, 'Rail et Box');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14B78418B281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `trick_id`, `url`) VALUES
(91, 120, '../../trickDefaultBasics.jpg'),
(92, 121, '../../trickDefaultButter.jpg'),
(93, 122, '../../trickDefaultFlips.jpg'),
(94, 123, '../../trickDefaultRail.jpg'),
(95, 124, '../../trickDefaultBasics.jpg'),
(96, 125, '../../trickDefaultButter.jpg'),
(97, 126, '../../trickDefaultFlips.jpg'),
(98, 127, '../../trickDefaultRail.jpg'),
(99, 128, '../../trickDefaultBasics.jpg'),
(100, 129, '../../trickDefaultButter.jpg'),
(101, 130, '../../trickDefaultFlips.jpg'),
(102, 131, '../../trickDefaultRail.jpg'),
(103, 132, '../../trickDefaultBasics.jpg'),
(104, 133, '../../trickDefaultButter.jpg'),
(105, 134, '../../trickDefaultFlips.jpg'),
(106, 135, '../../trickDefaultRail.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trick`
--

DROP TABLE IF EXISTS `trick`;
CREATE TABLE IF NOT EXISTS `trick` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `last_modified` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `groupe_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8F0A91E7A45358C` (`groupe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trick`
--

INSERT INTO `trick` (`id`, `name`, `content`, `created_at`, `last_modified`, `groupe_id`) VALUES
(120, 'Ollie', 'Lorem convallis fringilla. mauris risus. dictumst quisque eleifend nibh dictum a cras Ipsum  Suscipit hac mauris labore amet mattis tristique morbi malesuada egestas accumsan amet, sit gravida a vitae pellentesque. Aliquam posuere sodales consectetur. enim tempor nec accumsan diam ante at aliqua. tempus. viverra feugiat  consequat. diam mauris sed Orci placerat. sagittis aenean dictum morbi Adipiscing amet tortor leo elementum. id habitasse varius Metus pellentesque eget tellus amet enim  vivamus Cursus elit incididunt rutrum. cras Bibendum nulla ligula Bibendum imperdiet dolor et. suspendisse mattis', '2024-06-18 19:15:51', NULL, 66),
(121, 'Tail Roll', 'Lorem tellus ligula tortor. mattis est At dictum accumsan congue elementum  Adipiscing suscipit Sit aliquam rutrum. A hac Laoreet vitae congue consectetur. Integer fringilla Vivamus sagittis Quis eiusmod Nibh vivamus ipsum cras ullamcorper Sodales nunc pellentesque. tellus fusce tortor. mauris', '2024-06-18 19:15:51', NULL, 67),
(122, 'Indy Grab', 'Lorem eget egestas leo eget sagittis Turpis  ante diam quisque posuere At amet, duis', '2024-06-18 19:15:51', NULL, 68),
(123, 'Boardslide', 'Lorem convallis fringilla. mauris risus. dictumst quisque eleifend nibh dictum a cras Ipsum  Suscipit hac mauris labore amet mattis tristique morbi malesuada egestas accumsan amet, sit gravida a vitae pellentesque. Aliquam posuere sodales consectetur. enim tempor nec accumsan diam ante at aliqua. tempus. viverra feugiat  consequat. diam mauris sed Orci placerat. sagittis aenean dictum morbi Adipiscing amet tortor leo elementum. id habitasse varius Metus pellentesque eget tellus amet enim  vivamus Cursus elit incididunt rutrum. cras Bibendum nulla ligula Bibendum imperdiet dolor et. suspendisse mattis arcu rhoncus diam in Sodales duis', '2024-06-18 19:15:51', NULL, 69),
(124, 'Jibbing', 'Lorem mattis accumsan Adipiscing rutrum. vitae fringilla eiusmod cras pellentesque. mauris tellus arcu quisque at mauris malesuada at leo nulla platea. arcu volutpat Suscipit sodales placerat.  in cursus varius quisque amet, viverra habitasse imperdiet facilisi Turpis augue labore tempor dictum elit maecenas. mauris arcu dictum a consequat. pellentesque suspendisse iaculis nibh convallis tristique diam amet cras lacus aliquam egestas Ipsum', '2024-06-18 19:15:51', NULL, 66),
(125, 'Butter', 'Lorem arcu rutrum. Ipsum cras ut arcu Porttitor malesuada vel. platea. sit. sodales magna cursus praesent viverra orci Turpis  dictum Quis arcu commodo pellentesque tempor convallis mauris cras cursus Ipsum facilisi rhoncus tellus egestas nulla At consectetur consectetur. morbi fusce orci feugiat rhoncus In Tincidunt morbi mauris. aenean nisl. eget tellus fringilla. tellus Bibendum A  ullamcorper diam habitasse accumsan neque dolore amet enim Sem Viverra ullamcorper.  metus sed. in Adipiscing mattis eiusmod dignissim tellus nibh mauris nunc. nulla vestibulum Suscipit neque in pellentesque. amet, at facilisi dictum tempor Integer mauris tortor. consequat. ut nibh rhoncus amet', '2024-06-18 19:15:51', NULL, 67),
(126, 'Alley-oop', 'Lorem cursus cras feugiat  sed. in amet sit viverra egestas.  diam eleifend etiam et. placerat. tristique  mauris Metus sodales convallis fusce Bibendum  Suscipit nibh Sodales tortor gravida volutpat iaculis vivamus ante nibh arcu suspendisse sagittis morbi lobortis platea. pellentesque consectetur. fringilla. Viverra nulla consequat. hac condimentum duis leo a Sit libero Cursus at', '2024-06-18 19:15:51', NULL, 68),
(127, 'Nose Bonk', 'Lorem ultrices mauris tincidunt dolor dictum aenean interdum. amet, ut Sit neque adipiscing Quis nulla congue sed nibh morbi egestas eiusmod pulvinar iaculis in incididunt nunc  cursus. labore Sem  in dolore aliquet  habitasse aliqua. sit  Est at tellus lacus in eget adipiscing accumsan mauris. dictum Etiam In aliquam duis orci habitasse mi consectetur. lobortis dictumst nulla arcu Nibh rhoncus sollicitudin tortor cursus pellentesque. ultrices. convallis molestie ante commodo', '2024-06-18 19:15:51', NULL, 69),
(128, 'Switch Riding', 'Lorem dictum Sit congue eiusmod nunc  habitasse at adipiscing In mi arcu cursus ante at cursus odio. libero vel facilisi morbi mauris mattis maecenas. tincidunt diam sit suspendisse rhoncus Bibendum elit, cras urna.\r\n Cursus magna amet luctus Metus at elementum. est Adipiscing Laoreet sagittis ullamcorper mauris Sit feugiat at. at mauris nec quam sodales vel vitae tincidunt amet, Quis morbi in labore aliquet  in dictum orci dictumst sollicitudin convallis iaculis. Sapien sit. egestas et', '2024-06-18 19:15:51', NULL, 66),
(129, 'Nose Roll', 'Lorem cras malesuada sodales viverra dictum pellentesque cras rhoncus At fusce In aenean fringilla.  accumsan enim  Adipiscing tellus nulla in facilisi mauris nibh egestas risus. hac sit nec diam tortor enim Bibendum duis egestas. fringilla at volutpat quisque labore a diam sed elementum. vivamus dolor enim. libero etiam eget Sapien nibh mattis pellentesque. at placerat. habitasse elit suspendisse lacus Vitae elementum  elit a morbi posuere tempus.', '2024-06-18 19:15:51', NULL, 67),
(130, 'Backside 360', 'Lorem lobortis diam et Bibendum tincidunt arcu aliquet hac tellus aenean sollicitudin maecenas.  aenean ut pellentesque. tortor. amet Tincidunt adipiscing molestie quisque augue feugiat congue et. aliquet nibh morbi morbi at leo tortor. At pulvinar Sapien sit tempor tellus incididunt eu fringilla at Ipsum cursus. Orci congue in mauris  congue gravida vestibulum pellentesque aliquet libero sit mauris Quis aliqua. et Bibendum dignissim Turpis Est amet amet Adipiscing praesent lacus scelerisque viverra metus sodales', '2024-06-18 19:15:51', NULL, 68),
(131, 'Tail Press', 'Lorem phasellus viverra aliquet rhoncus interdum. aenean Vivamus enim molestie nulla', '2024-06-18 19:15:51', NULL, 69),
(132, 'Shifty', 'Lorem ut duis amet tempus. facilisis viverra tellus mattis et nec rhoncus  platea ligula tellus Aliquam egestas nibh commodo elit tortor. amet, magna arcu phasellus tellus Ipsum mattis Etiam Viverra scelerisque id amet  est libero maecenas morbi cursus. eleifend dui At ut sed augue convallis Sit maecenas. dictum viverra lobortis volutpat nunc. arcu tempus accumsan metus lobortis quam Bibendum habitasse posuere congue condimentum nisl. incididunt varius sit morbi elementum Quis', '2024-06-18 19:15:51', NULL, 66),
(133, 'Tripod', 'Lorem magna convallis morbi fringilla. Sem mauris Integer risus. urna.\r\n dictumst nunc quisque egestas eleifend congue', '2024-06-18 19:15:51', NULL, 67),
(134, 'Backflip', 'Lorem sit. mattis morbi accumsan id Adipiscing consectetur rutrum. aliquet vitae platea fringilla dui eiusmod morbi cras tincidunt pellentesque. interdum. mauris et tellus orci arcu at. quisque scelerisque at Non mauris rhoncus malesuada cursus. at varius leo iaculis. nulla Tincidunt platea. id arcu ultrices', '2024-06-18 19:15:51', NULL, 68),
(135, 'Lipslide', 'Lorem diam egestas. metus Metus ut gravida ullamcorper. lobortis at duis Sem', '2024-06-18 19:15:51', NULL, 69);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=402 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `avatar`, `is_verified`) VALUES
(382, 'myEmail0@website.com', '[]', '$2y$13$qKsHLUELHUptoJTqM3Ybtu1vRjIF31Gl1lWgwdeXI//LERhOxaGgy', 'User 0', 'default_avatar.png', 0),
(383, 'myEmail1@website.com', '[]', '$2y$13$Fm9LpDWRWW03x3hLuOQ82.mUltFdcNQdE58rnippCn5.kUzmc4I6i', 'User 1', 'default_avatar.png', 0),
(384, 'myEmail2@website.com', '[]', '$2y$13$Uf2ule/7iNG2X9KtIB9rYuL0cBDNL7bHReQ47D2G2hUp9g2DCuVMO', 'User 2', 'default_avatar.png', 0),
(385, 'myEmail3@website.com', '[]', '$2y$13$doJnVfUVtiQ5m6VMwZXtNOL/CGU9VURq8F90NQ5bPE6R6BrURCz02', 'User 3', 'default_avatar.png', 0),
(386, 'myEmail4@website.com', '[]', '$2y$13$gFg4yMxFq4idLvFXETs6eeM8C8N06ZyGdFY5D9icBFIwktLh7Xvai', 'User 4', 'default_avatar.png', 0),
(387, 'myEmail5@website.com', '[]', '$2y$13$oJvv9SxBbggdGfyiJ2M/ieXpZpnd1x0eP2X.UaD6XTjC6soCtsmii', 'User 5', 'default_avatar.png', 0),
(388, 'myEmail6@website.com', '[]', '$2y$13$HFD.N.Z6yjlDD1MLANSzU.M2AGPvzvwZr/0OUPbzNy9af.qNDPwka', 'User 6', 'default_avatar.png', 0),
(389, 'myEmail7@website.com', '[]', '$2y$13$l4BOD8jDRCyXe9TPHMeh3OE/JjiqOtHVzInEFbfCmq9A0.qmNltOu', 'User 7', 'default_avatar.png', 0),
(390, 'myEmail8@website.com', '[]', '$2y$13$KS7BE/dzEXCJyIHLGj4yrOj9tafZiBfeUjV.cVkQjYkQKKB2ks1gC', 'User 8', 'default_avatar.png', 0),
(391, 'myEmail9@website.com', '[]', '$2y$13$Zuje7EMgpIXy00P9tnCi8enkwiLgljvgsaklS1PELUXAZWUnNwfoa', 'User 9', 'default_avatar.png', 0),
(392, 'myEmail10@website.com', '[]', '$2y$13$QxbeGO4SMixCIkIFkIow.OyX0bkFkcS6F4RAcwoQRUdhrU9U2KgPW', 'User 10', 'default_avatar.png', 0),
(393, 'myEmail11@website.com', '[]', '$2y$13$3.7EngEWvBGUJpfvUlc1Ne.YdokZlbTiHww4upesj7xQuuVhpnuHm', 'User 11', 'default_avatar.png', 0),
(394, 'myEmail12@website.com', '[]', '$2y$13$0nFv25p3FOxlRUm12GRaCOWLtkROr/yyeXZedBOkzb1CandX.hiL6', 'User 12', 'default_avatar.png', 0),
(395, 'myEmail13@website.com', '[]', '$2y$13$OF7HmvzMQX.Vl8IhrKJdmO.CT23.xSmlSolINf3iLTEiLPzyMkVM6', 'User 13', 'default_avatar.png', 0),
(396, 'myEmail14@website.com', '[]', '$2y$13$p38HjU2v6CqUAUvF/6.SqeqfHUg3lGSXqYOu2vniJqD4OEL9UEIkm', 'User 14', 'default_avatar.png', 0),
(397, 'myEmail15@website.com', '[]', '$2y$13$Cj040WvKJqYAfrkpJ9kLg.C7IXRjVK8O.ua2BoB1XeLwysx3zZrLi', 'User 15', 'default_avatar.png', 0),
(398, 'myEmail16@website.com', '[]', '$2y$13$ERTwHC7Ds8udp7.w2O7EKevatj7xsNp3LAeQ6WUSsOs5K3kmWQt4.', 'User 16', 'default_avatar.png', 0),
(399, 'myEmail17@website.com', '[]', '$2y$13$XlUm4StV6UG5x3Ag9e0l/OlYuYPEqkLTPWjDX57ZWkwUrYpbpjsSy', 'User 17', 'default_avatar.png', 0),
(400, 'myEmail18@website.com', '[]', '$2y$13$GU9wpq2eFtmqzVQBnwfBu.YJQ9j.e7zyHmvlr8Q1GG5OsjcoKHPpe', 'User 18', 'default_avatar.png', 0),
(401, 'myEmail19@website.com', '[]', '$2y$13$/KEOZRSH9dKt4af6AmPXeO2YCwOZfM6rWdy6.HsdeS1LY/LEBvFcm', 'User 19', 'default_avatar.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2CB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_14B78418B281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);

--
-- Constraints for table `trick`
--
ALTER TABLE `trick`
  ADD CONSTRAINT `FK_D8F0A91E7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `trick` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
