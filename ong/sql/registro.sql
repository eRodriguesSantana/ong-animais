--
-- Banco de dados: `user`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro`
--

CREATE TABLE `registro` (
  `iduser` int(11) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `inicio_expediente` datetime NOT NULL,
  `inicio_almoco` datetime NOT NULL,
  `fim_almoco` datetime NOT NULL,
  `fim_expediente` datetime NOT NULL,
  `descricao` text COLLATE utf8_roman_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- �ndices para tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `userid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;