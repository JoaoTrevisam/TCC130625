-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/05/2025 às 16:53
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `heman`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` char(11) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `frequencia` int(11) DEFAULT NULL,
  `objetivo` varchar(255) DEFAULT NULL,
  `data_matricula` date DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `nome_aluno` varchar(255) DEFAULT NULL,
  `categoria_aula` varchar(255) DEFAULT NULL,
  `dia_semana` varchar(20) DEFAULT NULL,
  `horario_inicio` time DEFAULT NULL,
  `professor` varchar(255) DEFAULT NULL,
  `local_aula` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `criar_aula`
--

CREATE TABLE `criar_aula` (
  `id` int(11) NOT NULL,
  `nome_aula` varchar(100) NOT NULL,
  `dia_aula` varchar(100) NOT NULL,
  `horario_aula` time NOT NULL,
  `professor_aula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `criar_aula`
--

INSERT INTO `criar_aula` (`id`, `nome_aula`, `dia_aula`, `horario_aula`, `professor_aula`) VALUES
(3, 'Zumba', 'segunda', '17:30:00', 'João Vitor'),
(4, 'Corrida', 'quarta', '14:20:00', 'João Vitor'),
(5, 'Treino', 'segunda', '19:30:00', 'João Vitor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicio`
--

CREATE TABLE `exercicio` (
  `nome` varchar(255) NOT NULL,
  `tipo_exercicio` varchar(255) NOT NULL,
  `grupo_muscular` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exercicio`
--

INSERT INTO `exercicio` (`nome`, `tipo_exercicio`, `grupo_muscular`, `id`) VALUES
('SUPINOaaaa', 'cardio', 'DORSAL', 1),
('TRICEPISSSSSSSSSSS', 'cardio', 'ABDÔMEN', 4),
('BICPES', 'Musculação', 'membros interiores', 5),
('OMBRO', 'Musculação', 'abdômen', 6),
('PEITO', 'Musculação', 'abdômen', 7),
('Chuva', 'musculacao', 'ABDÔMEN', 8),
('aaa', 'musculacao', 'CARDIO', 9),
('Chuvaaaaaa', 'musculacao', 'ABDÔMEN', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha`
--

CREATE TABLE `ficha` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dia_treino` varchar(335) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha`
--

INSERT INTO `ficha` (`id`, `aluno_id`, `nome`, `dia_treino`) VALUES
(1, 0, 'DIA A', 'SEGUNDA'),
(2, 7, 'SEMANA TODA', 'SEGUNDA'),
(3, 11, 'DIA A', 'SEGUNDA'),
(4, 11, 'DIA A', 'SEGUNDA'),
(5, 12, 'AHASIHAISSS', 'SEGUNDA'),
(6, 0, '123', 'TERCA'),
(7, 0, 'DIA Z', 'QUARTA'),
(8, 11, '2', 'TERCA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_exercicio`
--

CREATE TABLE `ficha_exercicio` (
  `id` int(11) NOT NULL,
  `ficha_id` int(11) DEFAULT NULL,
  `exercicio_id` int(11) DEFAULT NULL,
  `num_series` int(11) DEFAULT NULL,
  `num_repeticoes` int(11) DEFAULT NULL,
  `tempo_descanso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha_exercicio`
--

INSERT INTO `ficha_exercicio` (`id`, `ficha_id`, `exercicio_id`, `num_series`, `num_repeticoes`, `tempo_descanso`) VALUES
(1, 1, 5, 10, 4, 10),
(2, 1, 4, 10, 4, 10),
(3, 2, 5, 10, 10, 10),
(4, 2, 6, 10, 10, 10),
(5, 2, 7, 10, 10, 10),
(6, 2, 1, 10, 10, 10),
(7, 2, 4, 10, 10, 10),
(9, 3, 6, 5, 5, 5),
(11, 3, 4, 5, 5, 5),
(17, NULL, 9, 2, 2, 2),
(18, NULL, 9, 2, 2, 2),
(19, NULL, 9, 2, 2, 2),
(21, 8, 5, 1, 1, 1),
(23, 4, 5, 1, 1, 1),
(24, 5, 5, 2, 2, 2),
(25, 5, 1, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `turno_disponivel` varchar(255) DEFAULT NULL,
  `data_matricula` date NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `cpf` varchar(11) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `data_nascimento`, `telefone`, `endereco`, `turno_disponivel`, `data_matricula`, `ativo`, `cpf`) VALUES
(33, 'João Vitor', '2001-03-19', '44997011869', 'Avenida Guiomar Gas', 'Manhã', '2025-05-16', 1, '07687987890');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_unico` (`cpf`) USING BTREE;

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `criar_aula`
--
ALTER TABLE `criar_aula`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `exercicio`
--
ALTER TABLE `exercicio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ficha_exercicio`
--
ALTER TABLE `ficha_exercicio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_unico_funcionario` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `criar_aula`
--
ALTER TABLE `criar_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `exercicio`
--
ALTER TABLE `exercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `ficha_exercicio`
--
ALTER TABLE `ficha_exercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
