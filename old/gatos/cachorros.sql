--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cachorros`
--

CREATE TABLE `cachorros` (
  `id_cao` int NOT NULL AUTO_INCREMENT,
  `nome_raca_cao` varchar(50) NOT NULL,
  `nivel_cuidado_cao` varchar(100) NOT NULL,
  PRIMARY KEY (`id_cao`)
);

