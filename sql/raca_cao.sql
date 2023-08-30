--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca_cao`
--

CREATE TABLE raca_cao(
    id_raca_cao int AUTO_INCREMENT NOT NULL,
    nome_raca_cao VARCHAR(100) NOT NULL,
    nivel_cuidado_cao VARCHAR(100) NOT NULL,
    primary key (id_raca_cao)
);

INSERT INTO raca_cao (nome_raca_cao, nivel_cuidado_cao) VALUES ("Poodle", "Leal, amigo e brincalhao");
INSERT INTO raca_cao (nome_raca_cao, nivel_cuidado_cao) VALUES ("Viralata", "Paciente, teimoso e charmoso");
