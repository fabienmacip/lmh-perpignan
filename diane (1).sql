
CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom`, `prenom`, `mail`, `date_creation`, `mot_de_passe`) VALUES
(21, 'Macip', 'Fabien', 'fabien.macip@gmail.com', '2021-09-19', '$2y$10$Y6aXByINTa8ApOoWmUpGMOw2B6IW/ikcji4Beyux4pWFdGmqz3U8u'),
(2, 'Macip', 'Jean-Paul', 'diane-lespignanaise@orange.fr', '2020-12-25', '$2y$10$/GVDAzzPjpHrSj8LxLdH8.KOm0Y0i2V/55ACEOUquZf3yBBnledPm');

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `animaux`
--

INSERT INTO `animaux` (`id`, `nom`, `actif`) VALUES
(1, 'PERDREAU', 0);

-- --------------------------------------------------------

--
-- Structure de la table `chasseurs`
--

CREATE TABLE `chasseurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `actif` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chasseurs`
--

INSERT INTO `chasseurs` (`id`, `nom`, `prenom`, `actif`) VALUES
(1, 'MACIP', 'Jean-Paul', 1),
(2, 'ABBAD', 'François', 1),
(3, 'AFFRE', 'Jacques', 1),
(4, 'ALBAGNAC', 'Gilles', 1),
(7, 'ALBANESE', 'Christian', 1),
(8, 'ALBERT', 'Alain', 1),
(9, 'ALBERT', 'Brice', 1),
(10, 'ALBERT', 'Damien', 1),
(11, 'ALBERT', 'Régis', 1),
(12, 'ALBERT', 'Robin', 1),
(13, 'ALIGNAN', 'Jacques', 1),


-- --------------------------------------------------------

--
-- Structure de la table `dates`
--

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `actif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dates`
--

INSERT INTO `dates` (`id`, `date`, `actif`) VALUES
(1, '2023-05-21', 1),
(2, '2023-06-04', 1),
(8, '2023-04-02', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chasseurs`
--
ALTER TABLE `chasseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `chasseurs`
--
ALTER TABLE `chasseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT pour la table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
