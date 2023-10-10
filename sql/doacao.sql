--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `doacao`
--

CREATE TABLE `doacao` (
  `id_doacao` int AUTO_INCREMENT NOT NULL,
  `doador` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `telefone` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `cpf` varchar(100) COLLATE utf8_general_ci,
  `tipo_doacao` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `dinheiro` decimal(15,2) COLLATE utf8_general_ci NOT NULL,
  `produto` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `quantidade` int COLLATE utf8_general_ci NOT NULL,
  `observacao` varchar(50) COLLATE utf8_general_ci,
  `data_doacao` varchar(50) COLLATE utf8_general_ci NOT NULL,
  primary key (id_doacao)
);

INSERT INTO `doacao` VALUES ('Edu','(33) 33333-3333','333.333.333-33','dinheiro','3.00','','0','','10/10/2023 18:18:11');
