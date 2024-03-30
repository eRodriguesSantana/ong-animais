--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_general_ci,
  `cpf` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `endereco` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `telefone` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `nivelUsuario` varchar(45) COLLATE utf8_general_ci NOT NULL,
  `matriculausuario` varchar(45) COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(45) COLLATE utf8_general_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_general_ci NOT NULL,
  primary key (id_pessoa)
);

INSERT INTO `pessoas` VALUES (1,'Edlamar','sem_email@sm.com','11111111111','Rod. Assis Chateaubriand, 36000, Pirapozinho - SP, 19200-000','18981364672','Voluntario','001',SHA1('12345'),'Ativo');