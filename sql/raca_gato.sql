--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca_gato`
--

CREATE TABLE raca_gato(
    id_raca_gato int AUTO_INCREMENT NOT NULL,
    nome_raca_gato VARCHAR(100) NOT NULL,
    porte_gato VARCHAR(100) NOT NULL,
    nivel_cuidado_gato VARCHAR(100) NOT NULL,
    primary key (id_raca_gato)
);

INSERT INTO raca_gato (nome_raca_gato, porte_gato, nivel_cuidado_gato) VALUES ("Angora", "Baixo", "Leal, amigo e brincalhao");
INSERT INTO raca_gato (nome_raca_gato, porte_gato, nivel_cuidado_gato) VALUES ("Siames", "Baixo", "Paciente, teimoso e charmoso");
