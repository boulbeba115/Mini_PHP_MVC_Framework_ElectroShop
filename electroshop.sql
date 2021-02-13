-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2021 at 08:53 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electroshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `is_owner` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_name`, `password`, `is_owner`) VALUES
(1, 'admin', '$2y$10$qu5GGiI11yEDxDeJE/AzzeOdtj/x/bJsX/1ybrHohO1mD3jaCWo1a', 1),
(2, 'boulbeba', '$2y$10$nQ1NZhZeUjA0yDqW0diy/O6ow3nj.5R2es0/dBd7D7ajY8Z3Fkery', 0),
(3, 'mahdi', '$2y$10$tebAxWzPxxoZo/Wt2XyRWOop//I/7wExtE13ztslJktjA4T0NjpZO', 0),
(4, 'hedi', '$2y$10$WtOFBnFyWkR8We3nJl.qFe87rZh/gu.26VjbXHlj8BtjpOGlcXE12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  `category_description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`) VALUES
(1, 'Computers', 'This category contains all sub category and products related to computers'),
(2, 'Telephony', 'This category contains all sub category and products related to Telephony & Tablet'),
(3, 'Watches', 'This category contains all sub category and products related to Telephony & Tablet'),
(4, 'Storage', 'This category contains all sub category and products related to Storage'),
(5, 'Impression', 'This category contains all sub category and products related to Telephony & Tablet'),
(6, 'TV-Son-Photos', 'This category contains all sub category and products related to TV-Son-Photos');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_refer` varchar(20) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_refer` (`order_refer`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_refer`, `payment_method`, `status`, `customer_id`, `created_at`) VALUES
(1, 'foCe7_client_1', 2, 1, 1, '2021-01-28 01:02:06'),
(2, 'g3rDb_client_1', 1, 1, 1, '2021-01-28 01:02:28'),
(3, 'Dm3kt_client_1', 2, 0, 1, '2021-01-28 08:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders_line`
--

DROP TABLE IF EXISTS `orders_line`;
CREATE TABLE IF NOT EXISTS `orders_line` (
  `prod_ref` varchar(20) NOT NULL,
  `cmd_ref` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`prod_ref`,`cmd_ref`),
  KEY `cmd_ref` (`cmd_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_line`
--

INSERT INTO `orders_line` (`prod_ref`, `cmd_ref`, `quantity`) VALUES
('8VU36EA-16', 'Dm3kt_client_1', 1),
('ALCATEL-3X-BK', 'g3rDb_client_1', 1),
('81Y400UKFG-2Y', 'foCe7_client_1', 1),
('90N90056FE', 'foCe7_client_1', 1),
('81LK01ASFE-2Y', 'foCe7_client_1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodcover`
--

DROP TABLE IF EXISTS `prodcover`;
CREATE TABLE IF NOT EXISTS `prodcover` (
  `cover_id` int(11) NOT NULL AUTO_INCREMENT,
  `cover_href` text NOT NULL,
  `cover_img` varchar(255) NOT NULL,
  `cover_title` varchar(100) NOT NULL,
  `cover_sub_title` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cover_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodcover`
--

INSERT INTO `prodcover` (`cover_id`, `cover_href`, `cover_img`, `cover_title`, `cover_sub_title`, `status`) VALUES
(1, 'http://localhost/ShopMvc/index/catagory/Computers', 'WAderBdUhs_1611818067_aa.jpg', 'shopping', 'Is much easier with us', 1),
(2, 'http://localhost/ShopMvc/', 'x1UGXAIJHs_1611818500_18731149.jpg', 'Black Friday', 'Don&#39;t mess The opportunity', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

DROP TABLE IF EXISTS `productimages`;
CREATE TABLE IF NOT EXISTS `productimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(100) NOT NULL,
  `alt` varchar(100) NOT NULL,
  `prod_ref` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_ref` (`prod_ref`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`id`, `src`, `alt`, `prod_ref`) VALUES
(1, 'gdN8Cy3HbJ_1611421840.jpeg', 'PC PORTABLE LENOVO IDEAPAD L340-15IRH GAMING / I5 9Ã‰ GÃ‰N / 8 GO', '81LK01ASFE-2Y'),
(2, 'WlOz9GE5sD_1611421840.jpeg', 'PC PORTABLE LENOVO IDEAPAD L340-15IRH GAMING / I5 9Ã‰ GÃ‰N / 8 GO', '81LK01ASFE-2Y'),
(3, 'ckyzOnQ0U9_1611421840.jpeg', 'PC PORTABLE LENOVO IDEAPAD L340-15IRH GAMING / I5 9Ã‰ GÃ‰N / 8 GO', '81LK01ASFE-2Y'),
(4, 'U5cjGsyJKh_1611422338.png', 'PC PORTABLE HP PAVILION GAMING 15-EC1000NK / RYZEN 5 / 8 GO', '27Z89EA'),
(5, 'PVk5Zemp5p_1611422338.png', 'PC PORTABLE HP PAVILION GAMING 15-EC1000NK / RYZEN 5 / 8 GO', '27Z89EA'),
(6, 'QPGH8y2YB6_1611422338.png', 'PC PORTABLE HP PAVILION GAMING 15-EC1000NK / RYZEN 5 / 8 GO', '27Z89EA'),
(7, 'lapSNCWj57_1611422551.jpeg', 'PC PORTABLE LENOVO IDEAPAD GAMING 3 15IMH05', '81Y400UKFG-2Y'),
(8, 'SXAKRJStWB_1611422551.jpeg', 'PC PORTABLE LENOVO IDEAPAD GAMING 3 15IMH05', '81Y400UKFG-2Y'),
(9, 'Ne2RXFRpGU_1611422551.png', 'PC PORTABLE LENOVO IDEAPAD GAMING 3 15IMH05', '81Y400UKFG-2Y'),
(10, 'pBq0advCBq_1611447242.png', 'TÃ‰LÃ‰PHONE PORTABLE ALCATEL 3X 2019 / 4G', 'ALCATEL-3X-BK'),
(11, 'IVYLmWAOVf_1611447242.png', 'TÃ‰LÃ‰PHONE PORTABLE ALCATEL 3X 2019 / 4G', 'ALCATEL-3X-BK'),
(12, 's073fDILpL_1611447242.png', 'TÃ‰LÃ‰PHONE PORTABLE ALCATEL 3X 2019 / 4G', 'ALCATEL-3X-BK'),
(13, 'zaoakiNL7W_1611613142.jpeg', 'PC DE BUREAU LENOVO IDEACENTRE G5 14IMB05', '90N90056FE'),
(14, 'NlMTxipNXv_1611613142.jpeg', 'PC DE BUREAU LENOVO IDEACENTRE G5 14IMB05', '90N90056FE'),
(15, 'jRN1UICHpS_1611613142.jpeg', 'PC DE BUREAU LENOVO IDEACENTRE G5 14IMB05', '90N90056FE'),
(16, 'UUvEgL4G0X_1611818832.jpeg', 'CLAVIER USB MACRO K74140 FRANÃ‡AIS / ARABE', 'K74140'),
(17, 'PAdWo4Lazs_1611818981.jpeg', 'CLAVIER QWERTY MÃ‰CANIQUE KB-R01 / NOIR', 'KB-R01'),
(18, 'jlgHqfrCD9_1611818981.jpeg', 'CLAVIER QWERTY MÃ‰CANIQUE KB-R01 / NOIR', 'KB-R01'),
(19, 'klFDuURW4t_1611818981.jpeg', 'CLAVIER QWERTY MÃ‰CANIQUE KB-R01 / NOIR', 'KB-R01'),
(20, 'qpas6R6Gd2_1611819272.jpeg', 'CLAVIER QWERTY BLUETOOTH EVEREST AVEC TOUCHPAD', 'EKW-155'),
(21, 'C0WukHKipX_1611819272.jpeg', 'CLAVIER QWERTY BLUETOOTH EVEREST AVEC TOUCHPAD', 'EKW-155'),
(22, 'Ko2GUKe3SV_1611819272.jpeg', 'CLAVIER QWERTY BLUETOOTH EVEREST AVEC TOUCHPAD', 'EKW-155'),
(23, 'shRNPMuNbr_1611819272.jpeg', 'CLAVIER QWERTY BLUETOOTH EVEREST AVEC TOUCHPAD', 'EKW-155'),
(24, 'XJ1PjtHo4a_1611819497.jpeg', 'PROMATE  GEARPOD-IS2 / BLANC', 'GEARPOD-IS2.WHITE'),
(25, 'hciv578SOR_1611819497.jpeg', 'PROMATE  GEARPOD-IS2 / BLANC', 'GEARPOD-IS2.WHITE'),
(26, 'DQkXlmrSEM_1611819497.jpeg', 'PROMATE  GEARPOD-IS2 / BLANC', 'GEARPOD-IS2.WHITE'),
(27, 'ZnT5XYFKfo_1611819688.jpeg', 'CASQUE-MICRO BLUETOOTH P47 / GRIS & ROUGE', 'P47-RD/GR'),
(28, 'SbiGpzCdAp_1611819688.jpeg', 'CASQUE-MICRO BLUETOOTH P47 / GRIS & ROUGE', 'P47-RD/GR'),
(29, 'FsHWAoJzMG_1611819688.jpeg', 'CASQUE-MICRO BLUETOOTH P47 / GRIS & ROUGE', 'P47-RD/GR'),
(30, 'EoqJt9yJAB_1611819836.jpeg', 'SOURIS GAMING EVEREST RAMPAGE SMX-R9 / 3200DPI', 'SMX-R9'),
(31, 'X1riEh7J4k_1611819836.png', 'SOURIS GAMING EVEREST RAMPAGE SMX-R9 / 3200DPI', 'SMX-R9'),
(32, 'Yo7K2fv5jR_1611819836.png', 'SOURIS GAMING EVEREST RAMPAGE SMX-R9 / 3200DPI', 'SMX-R9'),
(33, '9TPPjdacL7_1611820053.png', 'SOURIS GAMING SPIRIT OF GAMER ELITE M20 / NOIR', 'S-EM20BK'),
(34, '5KD1VseODZ_1611820053.png', 'SOURIS GAMING SPIRIT OF GAMER ELITE M20 / NOIR', 'S-EM20BK'),
(35, 'brUFwaT5xy_1611820053.png', 'SOURIS GAMING SPIRIT OF GAMER ELITE M20 / NOIR', 'S-EM20BK'),
(36, 'pYqmOlLYdv_1611820282.png', 'PC PORTABLE HP PROBOOK 430 G7 / I5 10Ãˆ GÃ‰N / 16 GO', '8VU36EA-16'),
(37, '74iUI55U4Q_1611820282.png', 'PC PORTABLE HP PROBOOK 430 G7 / I5 10Ãˆ GÃ‰N / 16 GO', '8VU36EA-16'),
(38, 'yfXgTX3RJx_1611820283.png', 'PC PORTABLE HP PROBOOK 430 G7 / I5 10Ãˆ GÃ‰N / 16 GO', '8VU36EA-16'),
(39, 'vttIlcIFOY_1611820424.jpeg', 'CÃ‚BLE PLAT REMAX USB VERS MICRO USB / BLEU', 'RC-008M-BL'),
(40, 'rqYlCLWKDO_1611820424.jpeg', 'CÃ‚BLE PLAT REMAX USB VERS MICRO USB / BLEU', 'RC-008M-BL'),
(41, 'wD42w8PqP6_1611820565.png', 'CHARGEUR SECTEUR KINGLEEN C822E 1.5A / BLANC', 'C822E'),
(42, 'seHfxGUCz5_1611820565.png', 'CHARGEUR SECTEUR KINGLEEN C822E 1.5A / BLANC', 'C822E'),
(43, 'WSVKcQ86Dh_1611820565.png', 'CHARGEUR SECTEUR KINGLEEN C822E 1.5A / BLANC', 'C822E'),
(44, 'cmNaay3PTm_1611820662.jpeg', 'TÃ‰LÃ‰PHONE PORTABLE CLEVER C2 / DOUBLE SIM / GRIS', 'C2-GR'),
(45, 'dordlTxidC_1611820921.jpeg', 'TÃ‰LÃ‰PHONE PORTABLE CLEVER C3 / DOUBLE SIM / BLANC', 'CLEVER-C3-WH'),
(46, 'aBRwwqD50T_1611821021.jpeg', 'MONTRE MIXTE SWATCH SIGAN SO28N101', 'SO28N101'),
(47, 'I7QmQyr0P3_1611821021.png', 'MONTRE MIXTE SWATCH SIGAN SO28N101', 'SO28N101'),
(48, 'no3xkGkjji_1611821021.png', 'MONTRE MIXTE SWATCH SIGAN SO28N101', 'SO28N101'),
(49, 'KU4iqt4mDG_1611821120.jpeg', 'DISQUE DUR TEAM GROUP MS30 SSD M.2 2280 / 128 GO', 'TM8PS7128G0C101'),
(50, '5ZoxK7jFap_1611823540.jpeg', 'IMPRIMANTE MULTIFONCTION JET D&#39;ENCRE 3 EN 1 Ã€ RÃ‰SERVOIR INTÃ‰GRÃ‰ HP INK TANK 315', 'Z4B04A'),
(51, 'YZBFfMlERe_1611823540.jpeg', 'IMPRIMANTE MULTIFONCTION JET D&#39;ENCRE 3 EN 1 Ã€ RÃ‰SERVOIR INTÃ‰GRÃ‰ HP INK TANK 315', 'Z4B04A');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_refer` varchar(20) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_short_desc` mediumtext NOT NULL,
  `prod_long_desc` longtext NOT NULL,
  `brand` varchar(50) NOT NULL,
  `qt_stock` float NOT NULL,
  `prod_price` float NOT NULL,
  `is_trend` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sub_cat` int(11) NOT NULL,
  `sub_sub_cat` int(11) NOT NULL,
  PRIMARY KEY (`prod_id`),
  UNIQUE KEY `prod_refer` (`prod_refer`),
  KEY `sub_cat` (`sub_cat`),
  KEY `sub_sub_cat` (`sub_sub_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_refer`, `prod_name`, `prod_short_desc`, `prod_long_desc`, `brand`, `qt_stock`, `prod_price`, `is_trend`, `created_at`, `sub_cat`, `sub_sub_cat`) VALUES
(1, '81LK01ASFE-2Y', 'PC PORTABLE LENOVO IDEAPAD L340-15IRH', 'Ã‰cran 15.6&#34; Full HD IPS - Processeur Intel Core i5-9300H, up to 4.1 Ghz, 8 Mo de cache - MÃ©moire 8 Go - Disque 2 To - Carte graphique Nvidia GeForce GTX 1050, 3 Go de mÃ©moire GDDR5 dÃ©diÃ©e - Wifi - Bluetooth - USB 3.1 Type C - HDMI - RJ45 - Lecteur de cartes - Clavier rÃ©troÃ©clairÃ© - Garantie 2 ans', 'Un portable conÃ§u pour les gamers les plus acharnÃ©sBÃ©nÃ©ficiez de la puissance et des performances dont vous avez besoin pour affronter les meilleurs. Le clavier de taille standard est dotÃ© dâ€™un dispositif de rÃ©troÃ©clairage ambiant. Le design est Ã©lÃ©gant et stylÃ©. Lâ€™IdeaPad L340 Gaming (15&#34;) est un portable conÃ§u de A Ã  Z pour les vrais gamers.Laissez sâ€™exprimer le gamer qui est en vous !Ã‰quipÃ© (au maximum) du processeur IntelÂ® Coreâ„¢ i7 de 9e gÃ©nÃ©ration, lâ€™IdeaPad L340 Gaming vous offre toute la puissance dont vous avez besoin pour vaincre nâ€™importe quel adversaire.La nouvelle superpuissanceLes portables pour gamer avec GeForceÂ® GTX 1650 sont dotÃ©s des performances graphiques rÃ©volutionnaires de lâ€™architecture NVIDIA Turingâ„¢ maintes fois primÃ©e, pour doper vos jeux prÃ©fÃ©rÃ©s.Laissez-vous captiver par le jeuTous les IdeaPad L340 disposent du son Dolby Audioâ„¢. Cette technologie audio Ã©voluÃ©e est conÃ§ue pour vous offrir une expÃ©rience de gaming mobile sans prÃ©cÃ©dent et vous garantir un plaisir optimal.Câ€™est vous qui Ãªtes aux commandes !Lâ€™IdeaPad L340 offre deux modes distincts : le mode Â« rapide Â» pour jouer et le mode Â« silencieux Â» pour travailler. Ã€ chaque mode correspondent une prÃ©sentation et un fonctionnement spÃ©cifiques. Il vous suffit de passer de lâ€™un Ã  lâ€™autre selon vos besoins.Parce que la protection de votre vie privÃ©e est essentielleâ€¦Diffusez facilement des contenus en temps rÃ©el sur lâ€™IdeaPad L340 tout en prÃ©servant la confidentialitÃ© de vos donnÃ©es privÃ©es. Lâ€™obturateur physique de la webcam vous permet dâ€™isoler votre camÃ©ra du monde extÃ©rieur Ã  tout moment.Restez mobile plus longtempsLâ€™IdeaPad L340 peut fonctionner jusquâ€™Ã  9,5 heures sur une seule charge, ce qui est largement suffisant pour une journÃ©e entiÃ¨re dâ€™utilisation, enchaÃ®ner les Ã©pisodes de vos sÃ©ries prÃ©fÃ©rÃ©esâ€¦ Et grÃ¢ce Ã  la technologie RapidCharge, vous pouvez recharger la batterie jusquâ€™Ã  80 % en moins dâ€™une heure et Ã  100 % en moins de deux.', 'LENOVO', 99, 2199000, 1, '2021-01-23 17:10:40', 1, 2),
(2, '27Z89EA', 'PC PORTABLE HP PAVILION GAMING 15-EC1000NK ', 'Ecran 15.6&#34; FULL HD - Processeur AMD Ryzen 5 4600H, up to 4 Ghz, 8 Mo de mÃ©moire cache - MÃ©moire 8 Go - Disque 512 Go SSD PCIe NVMe M.2 - Carte graphique Nvidia GeForce GTX 1050, 3 Go de mÃ©moire GDDR5 dÃ©diÃ©e - Clavier rÃ©troÃ©clairÃ© - Wifi - Bluetooth - USB 3.1 Type C - 1x USB 3.1 - 1x USB 2.0 - HDMI - RJ45 - Windows 10 - Garantie 1 an', 'Processeur pour ordinateurs portables AMD Ryzenâ„¢ 4000 SÃ©rie H avec carte graphique Radeonâ„¢ConÃ§us pour les charges de travail les plus exigeantes en gaming et en crÃ©ation de contenu, les processeurs Ryzenâ„¢ 4000 SÃ©rie H constituent la nouvelle rÃ©fÃ©rence pour les ordinateurs portables innovants, fins et lÃ©gers qui offrent des performances de niveau professionnel.Carte graphique NVIDIAÂ® GeForceÂ® GTX 1050Alimentez une expÃ©rience de jeux vidÃ©o rapide, fluide et Ã©coÃ©nergÃ©tique, qui tire parti des toutes nouvelles fonctionnalitÃ©s de DirectXÂ® 12 et NVIDIAÂ® GeForceÂ® GTX 1050 pour offrir des graphismes en 1080p sur les jeux les plus rÃ©cents.Panneau antirefletsGrÃ¢ce Ã  ce panneau antireflets, vous pouvez profiter du soleil tout en utilisant votre ordinateur. Utilisez votre ordinateur en extÃ©rieur grÃ¢ce Ã  l&#39;Ã©cran antireflet.Wi-Fi 5 (2x2) &amp; BluetoothÂ® 5.0 (802.11a/b/g/n/ac)Ne craignez pas les connexions Internet instables et faibles. Profitez d&#39;une connexion puissante au Wi-Fi et aux accessoires BluetoothÂ® grÃ¢ce au dernier adaptateur Wi-Fi 5 (2 x 2) WLAN et Ã  BluetoothÂ® 5.0.DDR4 RAMConÃ§ue pour sâ€™exÃ©cuter de maniÃ¨re plus efficace et plus fiable Ã  des vitesses Ã©levÃ©es, la mÃ©moire DDR4 est lâ€™avenir de la mÃ©moire RAM. Avec sa bande passante plus Ã©levÃ©e, elle amÃ©liore les performances aussi bien pour le multitÃ¢che que pour les jeux vidÃ©oPort USB Type-CÂ® SuperSpeed, vitesse de transfert de 5 Gbit/sConnectez votre stockage externe grÃ¢ce Ã  ce port USB Type-CÂ® SuperSpeed, offrant une vitesse de transfert de 5 Gbit/s. De plus, il est rÃ©versible et simple Ã  connecter. Vous pouvez donc le brancher indiffÃ©remment dans un sens ou dans lâ€™autre.CamÃ©ra HD HP True VisionParticipez Ã  des conversations vidÃ©o d&#39;une nettetÃ© Ã©clatante, mÃªme par faible luminositÃ©, chaque conversation deviendra une expÃ©rience unique qui vous permettra de communiquer dans de meilleures conditions.Clavier rÃ©troÃ©clairÃ© avec pavÃ© numÃ©rique intÃ©grÃ©Poursuivez vos activitÃ©s, mÃªme dans les piÃ¨ces faiblement Ã©clairÃ©es ou sur les vols de nuit. Avec un clavier rÃ©troÃ©clairÃ© et un pavÃ© numÃ©rique intÃ©grÃ©, vous pouvez rÃ©aliser vos saisies confortablement dans plusieurs environnements.Conception Ã©lÃ©ganteEmportez facilement cet ordinateur plat et lÃ©ger d&#39;une piÃ¨ce Ã  une autre, mais Ã©galement lors de vos dÃ©placements. Lorsque votre PC vous accompagne oÃ¹ que vous alliez, rester productif et s&#39;amuser n&#39;a jamais Ã©tÃ© aussi facile.Une expÃ©rience audio puissanteLes deux haut-parleurs HP, le systÃ¨me HP Audio Boost et une optimisation sonore signÃ©e Bang &amp; Olufsen donneront une autre dimension Ã  vos contenus de divertissement. Mettez vos sens en Ã©veil grÃ¢ce Ã  un systÃ¨me audio proche de la perfection.', 'Hp', 0, 2299000, 1, '2021-01-23 17:18:58', 1, 2),
(3, '81Y400UKFG-2Y', 'PC PORTABLE LENOVO IDEAPAD GAMING 3 15IMH05', 'Ã‰cran 15.6&#34; IPS Full HD 120 Hz - Processeur Intel Core i5-10300H, up to 4.5 Ghz, 8 Mo de cache - MÃ©moire 8 Go - Disque 1 To + 128 Go SSD - Carte graphique Nvidia GTX 1650 Ti, 4 Go de mÃ©moire GDDR6 dÃ©diÃ©e - Wifi - Bluetooth - 1x USB 3.1 Type C - 2x USB 3.1 - HDMI - RJ45  - Clavier RetroÃ©clairÃ© - Couleur Noir - Garantie 2 ans + Souris Gaming Lenovo M100 Offerte', 'fgdf', 'LENOVO', 14, 2499000, 1, '2021-01-23 17:22:31', 1, 2),
(4, 'ALCATEL-3X-BK', 'TÃ‰LÃ‰PHONE PORTABLE ALCATEL 3X 2019 / 4G', 'Ecran 6.52&#34; Full View - RÃ©solution HD+ (720 x 1600px) - Processeur Octa Core MT6763V/V, 4x 2.0 Ghz + 4x 1.5 Ghz - Android 9.0 Pie - RAM 4 Go - MÃ©moire 64 Go Jusqu&#39;Ã  128 Go Via Micro SD - Appareils Photos: ArriÃ¨re: 16MP + 8 MP + 5MP, Frontale: 8MP - Lecteur d&#39;empreintes digitales - 4G - Wifi - Bluetooth - Batterie 4000 mAh - Garantie 1 an', 'Triple appareil photo et Ã©cran Super Full View pour des images plus vraies que natureUn Ã©cran uniqueGrÃ¢ce au grand Ã©cran de l&#39;Alcatel 3X et Ã  ses superbes couleurs, ne manquez plus aucun dÃ©tail. Son Ã©cran Super Full View HD+ de 6,52 pouces rendra les images plus vraies que nature que vous regardiez le dernier blockbuster ou preniez en photo les paysages qui vous entourent. Nous vous promettons un affichage inÃ©galÃ© grÃ¢ce Ã  son rapport Ã©cran/boÃ®tier de 85%*.Des photos Ã©poustouflantesCapturez vos plus beaux moments grÃ¢ce aux trois appareils photo de l&#39;Alcatel 3X. Ne vous laissez plus surprendre grÃ¢ce Ã  son appareil photo de 16 Mpxl avec dÃ©tection de scÃ¨ne par IA, son appareil photo grand angle Ã  118 degrÃ©s de 8 Mpxl et son appareil photo Ã  profondeur de champ de 5 Mpxl. Vous avez maintenant toutes les cartes en main pour cÃ©lÃ©brer la vie et prendre en photo ce superbe profil, ce dÃ©licieux plat ou ce magnifique coucher de soleil.RÃ©glage des paramÃ¨tres photo par IAPrenez des photos parfaites sans mÃªme y penser. La fonction de rÃ©glage photo par IA de l&#39;Alcatel 3X rÃ¨gle automatiquement les paramÃ¨tres de votre appareil photo pour 21 sujets diffÃ©rents : vous n&#39;avez plus qu&#39;Ã  viser et Ã  dÃ©clencher !Super grand anglePrenez des photos en plan large grÃ¢ce Ã  l&#39;objectif super grand angle de l&#39;Alcatel 3X. GrÃ¢ce Ã  son amplitude sur 118 degrÃ©s, vous pourrez prendre tous vos amis en soirÃ©e, les plus beaux paysages urbains, les levers de soleil les plus Ã©clatants et bien plus encore.Des photos avec une plus grande profondeur de champGagnez en dÃ©tails et en profondeur grÃ¢ce Ã  la fonction bokeh en temps rÃ©el. Mettez en avant les Ã©lÃ©ments de votre choix dans vos portraits. Ajoutez des arriÃ¨re-plans floutÃ©s artistiques Ã  vos photos de plats, d&#39;animaux et de nature. Votre imagination est votre seule limite.Enregistrement de vidÃ©o nocturnePlongez dans l&#39;obscuritÃ© grÃ¢ce aux appareils photo Ã  haute sensibilitÃ© de l&#39;Alcatel 3X. Prenez des vidÃ©os de nuit claires, lumineuses et dÃ©taillÃ©es grÃ¢ce Ã  la fonctionnalitÃ© de rÃ©duction du bruit. Que vous preniez les lumiÃ¨res de la ville ou une soirÃ©e entre amis, vous pourrez graver ces souvenirs Ã  tout jamais en haute qualitÃ©.Des performances exceptionnellesPassez au niveau supÃ©rieur avec l&#39;Alcatel 3X. Son processeur huit cÅ“urs, ses 4 Go de RAM et 64 Go de ROM vous donneront la puissance nÃ©cessaire pour pouvoir terminer cet e-mail ou jouer Ã  ce jeu avec une efficacitÃ© maximale. GrÃ¢ce Ã  sa batterie de 4000 mAh, vous n&#39;aurez plus besoin de brancher votre tÃ©lÃ©phone et pourrez rester en mouvement toute la journÃ©e.', 'ALCATEL', 99, 569000, 1, '2021-01-24 00:14:02', 6, 0),
(5, '90N90056FE', 'PC DE BUREAU LENOVO IDEACENTRE G5 14IMB05', 'Processeur Intel Core i5-10400 10Ã¨ GÃ©nÃ©ration, up to 4.3 GHz, 12 Mo de mÃ©moire cache - MÃ©moire 8 Go - Disque 1 To + 256 Go SSD M.2 - Carte graphique Nvidia GeForce GTX 1650 Super, 4 Go de mÃ©moire DDR6 dÃ©diÃ©e - Wifi - Bluetooth - USB - Wifi - Bluetooth - HDMI - VGA - Lecteur de cartes - Clavier et Souris USB - Garantie 1 an', 'FICHE TECHNIQUESystÃ¨me D&#39;exploitationFreeDosProcesseurIntel Core I5RÃ©f ProcesseurIntel Core I5-10400 10Ã¨ GÃ©nÃ©ration, 2.9 GHz Up To 4.3 GHz, 12 Mo De MÃ©moire CacheMÃ©moire8 GoDisque Dur1 To + 256 Go SSDCarte GraphiqueNvidia GeForceRÃ©f Carte GraphiqueNVIDIA GeForce GTX 1650, 4 Go De MÃ©moire GDDR5 DÃ©diÃ©eTaille EcranSansType EcranSansEcran TactileNonLecteurs/GraveursLecteur De CartesSonStÃ©rÃ©oGarantie1 AnSourisUSB , OptiqueClavierUSB , Azerty', 'LENOVO', 12, 2369000, 0, '2021-01-25 22:19:02', 2, 5),
(6, 'K74140', 'CLAVIER USB MACRO K74140 FRANÃ‡AIS / ARABE', 'Clavier USB standard Macro K74140 - FranÃ§ais / Arabe - Interface: USB 2.0 - 104 touches - Hauteur des touches: 5.0mm -  Dimensions:  440 (L) x 140 (W) x 25.5 (H) mm - Poids: 500 g', 'Clavier USB standard Macro K74140 - FranÃ§ais / Arabe - Interface:&nbsp;USB 2.0&nbsp;-&nbsp;104 touches&nbsp;- Hauteur des touches:&nbsp;5.0mm&nbsp;-&nbsp;&nbsp;Dimensions:&nbsp;&nbsp;440 (L) x 140 (W) x 25.5 (H) mm&nbsp;- Poids: 500 g', 'MACRO', 100, 8100, 1, '2021-01-28 07:27:12', 4, 9),
(7, 'KB-R01', 'CLAVIER QWERTY MÃ‰CANIQUE KB-R01 / NOIR', 'Clavier Qwerty Rampage KB-R01 - Type: Filaire - 109 Touches - Nombre de touches Macro: 5 - Longueur de cÃ¢ble: 140 cm - Couleur: Noir', 'Clavier Qwerty Rampage KB-R01 - Type: Filaire - 109 Touches - Nombre de touches Macro: 5 - Longueur de cÃ¢ble: 140 cm - Couleur: Noir', 'Rampage', 32, 25000, 0, '2021-01-28 07:29:41', 4, 9),
(8, 'EKW-155', 'CLAVIER QWERTY BLUETOOTH EVEREST AVEC TOUCHPAD', 'Clavier Qwerty Bluetooth Everest avec TouchPad Sans Fil - Compatible avec PC / Smart TV / Console Jeux - Connexion Bluetooth - Distance de fonctionnement Maxi: 10m - Facile Ã  Installer et Utiliser - Design Slim - Garantie 1 an', 'Clavier Qwerty Bluetooth Everest avec TouchPad Sans Fil - Compatible avec PC / Smart TV / Console Jeux - Connexion Bluetooth - Distance de fonctionnement Maxi: 10m - Facile Ã  Installer et Utiliser - Design Slim - Garantie 1 an', 'Everest', 64, 59000, 1, '2021-01-28 07:34:32', 4, 9),
(9, 'GEARPOD-IS2.WHITE', 'PROMATE  GEARPOD-IS2 / BLANC', 'Ã‰couteurs stÃ©rÃ©o avec micro - Taille 14.2mm - Gamme de frÃ©quence: 20Hz-20KHz - SensibilitÃ©: 115dB Â± 3dB - ImpÃ©dance 32Î© Â± 15% - Longueur de cÃ¢ble: 120 Â± 3 cm - Jack 3.5mm - Couleur Blanc', 'Ã‰couteurs stÃ©rÃ©o avec micro - Taille 14.2mm - Gamme de frÃ©quence: 20Hz-20KHz - SensibilitÃ©: 115dB Â± 3dB - ImpÃ©dance 32Î© Â± 15% - Longueur de cÃ¢ble: 120 Â± 3 cm - Jack 3.5mm - Couleur&nbsp;Blanc', 'PROMATE', 120, 15500, 1, '2021-01-28 07:38:17', 4, 7),
(10, 'P47-RD/GR', 'CASQUE-MICRO BLUETOOTH P47 / GRIS & ROUGE', 'Casque Bluetooth P47 avec Micro - Bluetooth 4.1 - DiamÃ¨tre 40mm - PortÃ©e: 10 mÃ¨tres - FrÃ©quence: 50HZ-20KHz - Temps de charge: 2 heures - Autonomie: Jusqu&#39;Ã  15 heures - Technologie de rÃ©duction du bruit - Prend en charge le basculement automatique vers la fonction d&#39;appel entrant - Bandeau Pliable - Support carte mÃ©moire - Couleur: Gris et Rouge - Garantie 1 an', 'Casque Bluetooth P47 avec Micro - Bluetooth 4.1 - DiamÃ¨tre 40mm - PortÃ©e: 10 mÃ¨tres - FrÃ©quence: 50HZ-20KHz - Temps de charge: 2 heures - Autonomie: Jusqu&#39;Ã  15 heures - Technologie de rÃ©duction du bruit - Prend en charge le basculement automatique vers la fonction d&#39;appel entrant - Bandeau Pliable - Support carte mÃ©moire - Couleur: Gris et Rouge - Garantie 1 an', 'Sbox', 21, 21900, 0, '2021-01-28 07:41:28', 4, 7),
(11, 'SMX-R9', 'SOURIS GAMING EVEREST RAMPAGE SMX-R9 / 3200DPI', 'Souris Gaming Everest Rampage SMX-R9 - RÃ©solution 3200 dpi - Capteur SUNPLUS 180A - 7x Boutons - Bouton DPI - DPI RÃ©glable - RÃ©troÃ©clairage LED 16.8 Million de couleurs - Design ergonomique - Garantie 1 an', 'Souris Gaming Everest Rampage SMX-R9 - RÃ©solution 3200 dpi -&nbsp;Capteur&nbsp;SUNPLUS 180A&nbsp;-&nbsp;7x Boutons - Bouton DPI - DPI RÃ©glable - RÃ©troÃ©clairage LED 16.8 Million de couleurs - Design ergonomique - Garantie 1 an', 'EVEREST', 25000, 32, 1, '2021-01-28 07:43:56', 4, 8),
(12, 'S-EM20BK', 'SOURIS GAMING SPIRIT OF GAMER ELITE M20 / NOIR', 'Souris filaire pour Gamer - Conception ergonomique pour droitier - 7 boutons programmables - Capteur Optique Haute DÃ©finition AVAGO A3050 - RÃ©solution maximale 4000 DPI / 6600 FPS - AccÃ©lÃ©ration 20G - RÃ©tro-Ã©clairage LED personnalisable RGB - Molette de dÃ©filement avec grip control - CÃ¢ble nylon tressÃ© anti-enchevÃªtrement: 1.8 m - Couleur Noir - Garantie 1 an', 'Souris filaire pour Gamer - Conception ergonomique pour droitier - 7 boutons programmables - Capteur Optique Haute DÃ©finition AVAGO A3050 - RÃ©solution maximale 4000 DPI / 6600 FPS - AccÃ©lÃ©ration 20G - RÃ©tro-Ã©clairage LED personnalisable RGB - Molette de dÃ©filement avec grip control - CÃ¢ble nylon tressÃ© anti-enchevÃªtrement: 1.8 m - Couleur Noir - Garantie 1 an', 'SPIRIT OF GAMER', 21, 70000, 0, '2021-01-28 07:47:33', 4, 8),
(13, '8VU36EA-16', 'PC PORTABLE HP PROBOOK 430 G7 / I5 10Ãˆ GÃ‰N / 16 GO', 'Ecran 13.3&#34; HD - Processeur Intel Core i5-10210U, 10Ã¨ GÃ©nÃ©ration, jusqu&#39;Ã  4.2 GHz, 6 Mo de mÃ©moire cache - MÃ©moire 16 Go - Disque 256 Go SSD - Carte graphique Intel UHD 620 - Wifi - Bluetooth - 1x USB 3.1 Type-C - 2x USB 3.1 - 1x HDMI 1.4 - 1x RJ45 - Lecteur de cartes - Webcam HD avec micro - Couleur Silver - Garantie 1 an', 'Un design ultrafin abordable et Ã©lÃ©gantLe HP ProBook 430 offre un design Ã©lÃ©gant Ã  toutes les entreprises. Un chÃ¢ssis ultrafin aux lignes nettes, aux angles bien dÃ©finis et Ã  la finition argent naturel raffinÃ©e encadre un Ã©cran bord-Ã -bord quasiment sans bordures qui sâ€™ouvre Ã  180Â°, afin de faciliter le partage de contenus.SÃ©curitÃ©, robustesse, connectivitÃ©La croissance de votre entreprise nÃ©cessite un ordinateur aux fonctionnalitÃ©s de niveau professionnel. Le HP ProBook 430 sÃ©curisÃ© est complÃ©tÃ© par une gamme de fonctionnalitÃ©s de sÃ©curitÃ© et conÃ§u avec un chÃ¢ssis robuste et des options de connectivitÃ© que vous pouvez personnaliser pour les adapter au mieux Ã  vos besoins spÃ©cifiques.Un traitement puissantRespectez tous vos dÃ©lais mÃªme lors des journÃ©es les plus chargÃ©es grÃ¢ce au HP ProBook 430, disponible en version Ã©quipÃ©e du dernier processeur quadricÅ“ur IntelÂ® Coreâ„¢ de 8e gÃ©nÃ©ration en option et dâ€™une batterie Ã  la longue autonomie.Faites face Ã  n&#39;importe quelle situationSoyez productif en toutes circonstances. DÃ©couvrez les nouvelles fonctionnalitÃ©s de Windows 10 Professionnel sur le HP ProBook 430 lÃ©ger, ultrafin et tactile en option.Design ultra-plat Ã©lÃ©gant et rÃ©sistantLe HP ProBook 430 offre le design, la qualitÃ© et la robustesse Ã  toutes les entreprises. Un chÃ¢ssis ultrafin Ã  la nouvelle finition argent naturel raffinÃ©e qui comprend un plateau de clavier en aluminium forgÃ© en 3D et un capot supÃ©rieur durable en aluminium estampÃ©.Travaillez sans interruptionOptimisez la productivitÃ© et rÃ©duisez les temps morts avec lâ€™automatisation au niveau du micrologiciel HP BIOSphere de 4e gÃ©nÃ©ration. Vos ordinateurs bÃ©nÃ©ficient dâ€™une protection supplÃ©mentaire grÃ¢ce Ã  des mises Ã  jour et des contrÃ´les de sÃ©curitÃ© automatiques.', 'HP', 14, 2158000, 1, '2021-01-28 07:51:22', 1, 3),
(14, 'RC-008M-BL', 'CÃ‚BLE PLAT REMAX USB VERS MICRO USB / BLEU', 'CÃ¢ble Plat Remax USB vers Micro USB pour Smartphone - Longueur 1M - CÃ¢ble de charge et de synchronisation: peut Ãªtre utilisÃ© pour charger les batteries de smartphone et transfÃ©rer des donnÃ©es - Couleur Bleu', 'CÃ¢ble Plat Remax USB vers Micro USB pour Smartphone - Longueur 1M - CÃ¢ble de charge et de synchronisation: peut Ãªtre utilisÃ© pour charger les batteries de smartphone et transfÃ©rer des donnÃ©es - Couleur&nbsp;Bleu', 'Remax', 150, 4900, 1, '2021-01-28 07:53:44', 7, 0),
(15, 'C822E', 'CHARGEUR SECTEUR KINGLEEN C822E 1.5A / BLANC', 'Chargeur Secteur KINGLEEN C822E - EntrÃ©e: AC 100V-240V ~ 50/60Hz - Sortie: DC5V / 1.5A - Couleur: Blanc', 'Chargeur Secteur KINGLEEN C822E&nbsp;- EntrÃ©e: AC 100V-240V ~ 50/60Hz - Sortie: DC5V / 1.5A - Couleur: Blanc', 'KINGLEEN', 14, 10900, 0, '2021-01-28 07:56:05', 7, 0),
(16, 'C2-GR', 'TÃ‰LÃ‰PHONE PORTABLE CLEVER C2 / DOUBLE SIM / GRIS', 'Double SIM - Display 1.77&#34; - Wap - FM Radio - Torche - Batterie: 600 mAh - Mp3 - MÃ©moire Extensible - Couleur: Gris - Garantie 1 an', 'Double SIM - Display 1.77&#34;&nbsp;- Wap - FM Radio - Torche - Batterie: 600 mAh - Mp3 - MÃ©moire Extensible - Couleur:&nbsp;Gris - Garantie 1 an', 'CLEVER', 40, 35000, 0, '2021-01-28 07:57:42', 5, 0),
(17, 'CLEVER-C3-WH', 'TÃ‰LÃ‰PHONE PORTABLE CLEVER C3 / DOUBLE SIM / BLANC', 'Double SIM - Ecran couleur - CamÃ©ra arriÃ¨re VGA - MÃ©moire extensible - Lecteur MP3 - Radio FM - Torche - Couleur Blanc - Garantie 1 an', 'Double SIM - Ecran couleur - CamÃ©ra arriÃ¨re VGA - MÃ©moire extensible - Lecteur MP3 - Radio FM - Torche - Couleur Blanc - Garantie 1 an', 'CLEVER', 45, 39000, 0, '2021-01-28 08:02:01', 5, 0),
(18, 'SO28N101', 'MONTRE MIXTE SWATCH SIGAN SO28N101', 'Montre Mixte Swatch Sigan SO28N101 - Mouvement Quartz - Etanche 30 mÃ¨tres - Fermoir, Bracelet et BoÃ®tier en MatÃ©riau biosourcÃ© - Fermoir Boucle - Couleur Bleu - Cadran Blanc - Fermoir Rond - Garantie 2 ans', 'Montre Mixte Swatch Sigan SO28N101 -&nbsp;Mouvement Quartz - Etanche 30 mÃ¨tres - Fermoir, Bracelet et BoÃ®tier en MatÃ©riau biosourcÃ© - Fermoir Boucle - Couleur Bleu - Cadran Blanc - Fermoir Rond - Garantie 2 ans', 'SWATCH', 12, 205000, 1, '2021-01-28 08:03:41', 8, 0),
(19, 'TM8PS7128G0C101', 'DISQUE DUR TEAM GROUP MS30 SSD M.2 2280 / 128 GO', 'Disque Dur Interne SSD M.2 2280 - CapacitÃ© 128 Go - Interface SATA III TLC - Vitesse de Lecture Jusqu&#39;Ã  550 Mb/s - Vitesse d&#39;Ã©criture Jusqu&#39;Ã  470 Mb/s - RÃ©sistant aux chocs - Dimensions: 80 x 22 x 3.5 mm - Poids: 10 g - Garantie 1 an', 'Disque Dur Interne SSD M.2 2280 - CapacitÃ©&nbsp;128 Go - Interface SATA&nbsp;III&nbsp;TLC - Vitesse de Lecture Jusqu&#39;Ã  550 Mb/s - Vitesse d&#39;Ã©criture Jusqu&#39;Ã  470&nbsp;Mb/s -&nbsp;RÃ©sistant aux chocs - Dimensions: 80 x 22 x&nbsp;3.5 mm - Poids: 10 g - Garantie 1 an', 'TEAM GROUP', 120, 55000, 1, '2021-01-28 08:05:20', 12, 0),
(20, 'Z4B04A', 'IMPRIMANTE MULTIFONCTION JET D&#39;ENCRE 3 EN 1 Ã€ RÃ‰SERVOIR INTÃ‰GRÃ‰ HP INK TANK 315', 'Imprimante Multifonction Jet d&#39;encre 3 en 1 Ã  rÃ©servoir intÃ©grÃ© - Impression, numÃ©risation, copie - RÃ©solution d&#39;impression: Jusqu&#39;Ã  4800 x 1200 dpi - Vitesse d&#39;impression noir/couleur: Jusqu&#39;Ã  19 ppm / 16 ppm - RÃ©solution du scanner: 1200 x 1200 dpi - Format A4 - Interface USB - Bac d&#39;alimentation de 60 feuilles - Dimensions: 525 x 310 x 158 mm - Garantie 2 ans + 5 Bouteilles SupplÃ©mentaires', 'Imprimez facilement de grands volumes pour un coÃ»t par page extrÃªmement faible,3 grÃ¢ce Ã  un systÃ¨me de rÃ©servoir dâ€™encre fiable et sans Ã©claboussures.4 Imprimez jusqu&#39;Ã  8 000 pages couleur ou 15 000 pages noir et blanc,2 et obtenez une qualitÃ© exceptionnelle.&nbsp;CaractÃ©ristiquesPlus pour moins cherImprimez des milliers de pages grÃ¢ce au systÃ¨me de rÃ©servoir d&#39;encre grande capacitÃ©.Imprimez jusquâ€™Ã  8 000 pages avec un ensemble de bouteilles dâ€™encre couleur HP ou jusquâ€™Ã  15 000 pages avec 2 bouteilles dâ€™encre noire HP.Imprimez des volumes Ã©levÃ©s Ã  un coÃ»t par page extrÃªmement bas grÃ¢ce Ã  ce systÃ¨me de rÃ©servoir d&#39;encre grande capacitÃ©.Pas de saletÃ©s. Pas de gaspillage.Rechargez facilement votre rÃ©servoir dâ€™encre avec des bouteilles refermables et sans Ã©claboussures.Surveillez facilement les niveaux dâ€™encre et renouvelez lâ€™encre conÃ§ue par HP quand vous le souhaitez.Les rÃ©servoirs dâ€™encre transparents vous permettent dâ€™imprimer en toute confiance.QualitÃ© HP exceptionnelleVous pouvez compter sur un texte plus noir, plus net, tirage aprÃ¨s tirage.Vous pouvez compter sur les encres authentiques HP pour des photos qui durent jusqu&#39;Ã  22 fois plus longtemps.CrÃ©ez des brochures, des dÃ©pliants, des photos sans bordures, ainsi que dâ€™autres documents qui ont fiÃ¨re allure, directement dans votre bureau.Obtenez les fonctionnalitÃ©s dont vous avez besoin pour le travail et d&#39;autres tÃ¢ches grÃ¢ce aux fonctionnalitÃ©s de copie et de numÃ©risation.', 'Hp', 120, 389000, 0, '2021-01-28 08:45:40', 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(40) NOT NULL,
  `id_cat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_category_name` (`sub_category_name`),
  KEY `id_cat` (`id_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `sub_category_name`, `id_cat`) VALUES
(1, 'Laptop', 1),
(2, 'Desktop pc', 1),
(3, 'Accessories', 1),
(4, 'Composant Informatique', 1),
(5, 'Cellphone', 2),
(6, 'Smartphone', 2),
(7, 'Phone Accessories', 2),
(8, 'Swatch', 3),
(9, 'Tissot', 3),
(10, 'Calvin Klein', 3),
(11, 'Casio', 3),
(12, 'Internal hard drive', 4),
(13, 'External hard drive', 4),
(14, 'Usb flash', 4),
(15, 'Memory card', 4),
(16, 'Storage Accessories', 4),
(17, 'Printers', 5),
(18, 'Photocopiers', 5),
(19, 'Paper', 5),
(20, 'Consumables', 5),
(21, 'Video projectors', 6),
(22, 'Televisions', 6),
(23, 'Consoles & Games', 6),
(24, 'Sound', 6);

-- --------------------------------------------------------

--
-- Table structure for table `subsubcategories`
--

DROP TABLE IF EXISTS `subsubcategories`;
CREATE TABLE IF NOT EXISTS `subsubcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_sub_category_name` varchar(40) NOT NULL,
  `id_sub_cat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_sub_category_name` (`sub_sub_category_name`),
  KEY `id_sub_cat` (`id_sub_cat`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subsubcategories`
--

INSERT INTO `subsubcategories` (`id`, `sub_sub_category_name`, `id_sub_cat`) VALUES
(1, 'laptop pc', 1),
(2, 'gaming laptop', 1),
(3, 'pro laptop', 1),
(4, 'Screen', 2),
(5, 'Gamer Pc', 2),
(6, 'All in one', 2),
(7, 'Headphones & Earphones', 4),
(8, 'Mouse', 4),
(9, 'KeyBoard', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `cin` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adress` varchar(150) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cin` (`cin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `cin`, `email`, `adress`, `phone_number`, `password`, `status`) VALUES
(1, 'boulbeba', 'bouaziz', 11068779, 'boulbebazz@yahoo.fr', 'city el habib sfax', 23180613, '$2y$10$VEjrnFWzZwuXxQJsSvLHouSZ4JnmP/MzljZeHp5ZLuphzY0w6ODYK', 0),
(2, 'boulbeba', 'bouaziz', 11068795, 'boulbeba115@gmail.com', 'city el habib sfax', 55180612, '$2y$10$cO7cS.VeaXEY/4G/wGTJ9.Is1a47CNUhmxSdJre801lfPeeeMXnza', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
