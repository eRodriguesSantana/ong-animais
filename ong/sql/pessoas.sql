--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id_pessoa` int(11) UNSIGNED NOT NULL,
  `nome_completo` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_general_ci,
  `cpf` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `endereco` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `telefone` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `nivelUsuario` varchar(45) COLLATE utf8_general_ci NOT NULL,
  `matriculausuario` varchar(45) COLLATE utf8_general_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id_pessoa` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;