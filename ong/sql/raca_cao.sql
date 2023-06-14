--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca_cao`
--

CREATE TABLE raca_cao(
    id_raca int AUTO_INCREMENT NOT NULL,
    nome_raca VARCHAR(100) NOT NULL,
    porte VARCHAR(100) NOT NULL,
    nivel_cuidado VARCHAR(100) NOT NULL,
    primary key (id_raca)
);

ALTER TABLE `raca_cao` 
CHANGE COLUMN `id_raca` `id_raca_cao` INT NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `nome_raca` `nome_raca_cao` VARCHAR(100) NOT NULL ,
CHANGE COLUMN `porte` `porte_cao` VARCHAR(100) NOT NULL ,
CHANGE COLUMN `nivel_cuidado` `nivel_cuidado_cao` VARCHAR(100) NOT NULL ;

INSERT INTO raca_cao (nome_raca_cao, porte_cao, nivel_cuidado_cao) VALUES ("Poodle", "Medio", "Leal, amigo e brincalhao");
INSERT INTO raca_cao (nome_raca_cao, porte_cao, nivel_cuidado_cao) VALUES ("Viralata", "Alto", "Paciente, teimoso e charmoso");
