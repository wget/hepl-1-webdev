--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'connecté'),
(2, 'hors ligne'),
(3, 'supprimé');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `langue` varchar(20) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `langue`, `mdp`, `status`) VALUES
(1, 'Thiernesse', 'Cédric', 'profThiernesse', 'Français', '*15A46B366E670272A259FC5BD92FE4CC71D141E0', 1),
(2, 'Sagot', 'Pierre', 'profSagot', 'Anglais', '*3444F21729BCD33A4C6034F93BA0ACDEECFF9280', 2),
(3, 'Madani', 'Mounawar', 'profMadani', 'Français', '*759C3E647B53E0E45D234F84E8F5BFD705257EB6', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
