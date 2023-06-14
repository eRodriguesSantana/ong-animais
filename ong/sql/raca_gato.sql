--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca_gato`
--

CREATE TABLE raca_gato(
    id_raca int AUTO_INCREMENT NOT NULL,
    nome_raca VARCHAR(100) NOT NULL,
    porte VARCHAR(100) NOT NULL,
    nivel_cuidado VARCHAR(100) NOT NULL,
    primary key (id_raca)
);

ALTER TABLE `ong`.`raca_gato` 
CHANGE COLUMN `id_raca` `id_raca_gato` INT NOT NULL AUTO_INCREMENT ;
CHANGE COLUMN `nome_raca` `nome_raca_gato` VARCHAR(100) NOT NULL ,
CHANGE COLUMN `porte` `porte_gato` VARCHAR(100) NOT NULL ,
CHANGE COLUMN `nivel_cuidado` `nivel_cuidado_gato` VARCHAR(100) NOT NULL ;

INSERT INTO raca_gato (nome_raca_gato, porte_gato, nivel_cuidado_gato) VALUES ("Angora", "Baixo", "Leal, amigo e brincalhao");
INSERT INTO raca_gato (nome_raca_gato, porte_gato, nivel_cuidado_gato) VALUES ("Siames", "Baixo", "Paciente, teimoso e charmoso");
