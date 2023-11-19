--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cor`
--

CREATE TABLE cor_animal(
    id_cor int AUTO_INCREMENT NOT NULL,
    nome_cor VARCHAR(100) NOT NULL,
    primary key (id_cor)
);

INSERT INTO cor_animal (nome_cor) VALUES ("Preto");
INSERT INTO cor_animal (nome_cor) VALUES ("Branco");
