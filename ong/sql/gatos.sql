--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `gatos`
--

CREATE TABLE `gatos` (
  `id_gato` int NOT NULL AUTO_INCREMENT,
  `nome_animal` varchar(50) NOT NULL,
  `sexo_animal` varchar(50) NOT NULL,
  `raca` varchar(100) NOT NULL,
  `peso_aproximado` int NOT NULL,
  `observacao` varchar(100) NOT NULL,
  `data_entrada` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id_gato`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

