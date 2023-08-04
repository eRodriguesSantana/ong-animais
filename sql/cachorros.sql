--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cachorros`
--

CREATE TABLE `cachorros` (
  `id_cachorro` int NOT NULL AUTO_INCREMENT,
  `nome_animal_cachorro` varchar(50) NOT NULL,
  `sexo_animal_cachorro` varchar(50) NOT NULL,
  `raca_cachorro` varchar(100) NOT NULL,
  `peso_aproximado_cachorro` int NOT NULL,
  `observacao_cachorro` varchar(100) NOT NULL,
  `data_entrada_cachorro` varchar(50) NOT NULL,
  `image_cachorro` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cachorro`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

