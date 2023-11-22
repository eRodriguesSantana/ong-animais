--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancar_despesa_compra`
--

--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancar_despesa_compra`
--

CREATE TABLE `lancar_despesa_compra` (
  `id_compra` int AUTO_INCREMENT NOT NULL,
  `tipo_compra` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `endereco` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_general_ci NOT NULL,
  `telefone` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `cpfcnpj` varchar(100) COLLATE utf8_general_ci,
  `valor_pagar` decimal(15,2) COLLATE utf8_general_ci NOT NULL,
  `forma_pagamento` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `dinheiro` decimal(15,2) COLLATE utf8_general_ci NOT NULL,
  `parcelado` int COLLATE utf8_general_ci NOT NULL,
  `observacao_compra` varchar(50) COLLATE utf8_general_ci,
  `data_compra` varchar(50) COLLATE utf8_general_ci NOT NULL,
  primary key (id_compra)
);

INSERT INTO `lancar_despesa_compra` VALUES (1, 'Alimento','Rua das Racoes, 303, Jd Da Racao','SP','(11) 11111-1111',
'111.111.111-11','100.00', 'dinheiro','100.00',0, "", '10/10/2023 18:18:11');
