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
    raca_gato VARCHAR(50) NOT NULL,
    raca_cao VARCHAR(50) NOT NULL,
    peso_aproximado int NOT NULL,
    observacao VARCHAR(100) NOT NULL,
    data_entrada VARCHAR(50) NOT NULL,
    imagem VARCHAR(50) NOT NULL,
    primary key (id_animal)
);

INSERT INTO animal (nome_animal, cor_animal, porte_animal, sexo_animal, tipo_animal, raca_gato, raca_cao, peso_aproximado, observacao, data_entrada, imagem)
VALUES ('Poli', 'Pardo', 'Médio', 'Femêa', 'Cao', 'Não', 'Viralata', 10, 'Amor da minha vida', '14/06/2023 00:56:43', 'Minha linda')

INSERT INTO animal (nome_animal, cor_animal, porte_animal, sexo_animal, tipo_animal, raca_gato, raca_cao, peso_aproximado, observacao, data_entrada, imagem)
VALUES ('Mili', 'Preto', 'Médio', 'Femêa', 'Cao', 'Não', 'Viralata', 10, 'Amor da minha vida', '14/06/2023 00:56:43', 'Minha linda')
