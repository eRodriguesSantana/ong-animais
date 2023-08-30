--
-- Banco de dados: `ong`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adocao`
--

CREATE TABLE adocao(
    id_adocao int AUTO_INCREMENT NOT NULL,
    id_animal int NOT NULL,
    id_adotante int NOT NULL,
    CONSTRAINT pk_adocao PRIMARY KEY (id_adocao)
);

ALTER TABLE `ong`.`adocao` 
ADD CONSTRAINT `f_animal_id`
  FOREIGN KEY (`id_animal`)
  REFERENCES `ong`.`animal` (`id_animal`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `f_adotante_id`
  FOREIGN KEY (`id_adotante`)
  REFERENCES `ong`.`pessoas` (`id_pessoa`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

INSERT INTO adocao (id_animal, id_adotante)
VALUES (1, 9);

INSERT INTO adocao (id_animal, id_adotante)
VALUES (2, 10);