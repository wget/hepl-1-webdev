CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `langue` varchar(20) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'connecté'),
(2, 'hors ligne'),
(3, 'supprimé');

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `langue`, `mdp`, `status`) VALUES
(1, 'Thiernesse', 'Cédric', 'profThiernesse', 'Français', '*15A46B366E670272A259FC5BD92FE4CC71D141E0', 1),
(2, 'Sagot', 'Pierre', 'profSagot', 'Anglais', '*3444F21729BCD33A4C6034F93BA0ACDEECFF9280', 2),
(3, 'Madani', 'Mounawar', 'profMadani', 'Français', '*759C3E647B53E0E45D234F84E8F5BFD705257EB6', 3);
COMMIT;
