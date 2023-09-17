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
    cor_animal VARCHAR(50) NOT NULL,
    porte_animal VARCHAR(50) NOT NULL,
    sexo_animal VARCHAR(50) NOT NULL,
    tipo_animal VARCHAR(50) NOT NULL,
    raca_gato int NOT NULL,
    raca_cao int NOT NULL,
    peso_aproximado int NOT NULL,
    observacao VARCHAR(100) NOT NULL,
    data_entrada VARCHAR(50) NOT NULL,
    imagem VARCHAR(50) NOT NULL,
    CONSTRAINT pk_animal PRIMARY KEY (id_animal)
);

ALTER TABLE `ong`.`animal` 
CHANGE COLUMN `situacao` `situacao` INT NOT NULL ;

ALTER TABLE `ong`.`animal` 
ADD CONSTRAINT `f_raca_cao_id`
  FOREIGN KEY (`raca_cao`)
  REFERENCES `ong`.`raca_cao` (`id_raca_cao`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `f_raca_gato_id`
  FOREIGN KEY (`raca_gato`)
  REFERENCES `ong`.`raca_gato` (`id_raca_gato`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
ADD CONSTRAINT `f_adocao_id`
  FOREIGN KEY (`situacao`)
  REFERENCES `ong`.`adocao` (`id_adocao`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

INSERT INTO animal (nome_animal, cor_animal, porte_animal, sexo_animal, tipo_animal, raca_gato, raca_cao, peso_aproximado, observacao, data_entrada, imagem, situacao)
VALUES ('Poli', 'Pardo', 'Médio', 'Femêa', 'Cao', 0, 2, 10, 'Amor da minha vida', '14/06/2023 00:56:43', 'Minha linda', 1);

INSERT INTO animal (nome_animal, cor_animal, porte_animal, sexo_animal, tipo_animal, raca_gato, raca_cao, peso_aproximado, observacao, data_entrada, imagem, situacao)
VALUES ('Mili', 'Preto', 'Médio', 'Femêa', 'Gato', 1, 0, 10, 'Amor da minha vida', '14/06/2023 00:56:43', 'Minha linda', 0);