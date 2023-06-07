--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE animal(
    id_animal int AUTO_INCREMENT NOT NULL,
    nome_animal VARCHAR(50) NOT NULL,
    peso_aproximado int NOT NULL,
    observacao VARCHAR(100) NOT NULL,
    data_entrada VARCHAR(50) NOT NULL,
    image VARCHAR(50) NOT NULL,
    primary key (id_animal)
);
