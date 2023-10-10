--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico animal`
--

CREATE TABLE historico_animal (
    id_historico_animal int AUTO_INCREMENT NOT NULL,
    data_entrada VARCHAR(100),
    data_saida VARCHAR(100),
    motivo_cancelamento VARCHAR(255) NOT NULL,
    adotante_id int,
    animal_id int NOT NULL,
    PRIMARY KEY (id_historico_animal),
    CONSTRAINT fk_adotante FOREIGN KEY (adotante_id)
        REFERENCES ong.pessoas (id_pessoa),
    CONSTRAINT fk_animal FOREIGN KEY (animal_id)
        REFERENCES ong.animal (id_animal)
);
