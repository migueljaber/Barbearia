-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/10/2024 às 10:23
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
-- Banco de dados: `barbearia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) UNSIGNED NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `barbeiro` varchar(250) NOT NULL,
  `servico_id` int(11) UNSIGNED NOT NULL,
  `dia` varchar(250) NOT NULL,
  `horario` time NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `status` varchar(50) NOT NULL DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `usuario_id`, `barbeiro`, `servico_id`, `dia`, `horario`, `quantidade`, `status`) VALUES
(15, 2, 'Gabriel', 4, '2024-10-30', '15:00:00', 1, 'Concluído'),
(16, 2, 'Gabriel', 4, '2024-10-30', '15:30:00', 1, 'Concluído'),
(17, 2, 'Patrick', 5, '2024-12-23', '11:00:00', 1, 'Concluído'),
(18, 2, 'Patrick', 5, '2024-12-23', '11:30:00', 1, 'Concluído'),
(19, 2, 'Patrick', 5, '2024-12-23', '12:00:00', 1, 'Concluído'),
(20, 2, 'Patrick', 5, '2024-12-23', '12:30:00', 1, 'Concluído'),
(21, 2, 'Jean', 5, '2025-01-07', '16:30:00', 1, 'Concluído'),
(22, 3, 'André', 5, '2024-10-30', '13:00:00', 1, 'Concluído'),
(23, 3, 'André', 5, '2024-10-30', '13:30:00', 1, 'Concluído'),
(26, 2, 'Jean', 2, '2024-12-18', '10:30:00', 1, 'Concluído'),
(28, 2, 'Jean', 2, '2024-12-18', '11:30:00', 1, 'Concluído'),
(29, 2, 'Jean', 6, '2025-03-26', '11:30:00', 1, 'Concluído'),
(30, 2, 'Jean', 6, '2025-03-26', '12:00:00', 1, 'Concluído'),
(31, 2, 'Jean', 6, '2025-03-26', '12:30:00', 1, 'Concluído'),
(32, 2, 'Jean', 6, '2025-03-26', '13:00:00', 1, 'Concluído'),
(33, 2, 'Jean', 6, '2025-03-26', '13:30:00', 1, 'Concluído'),
(34, 2, 'Patrick', 2, '2025-02-14', '19:00:00', 1, 'Concluído'),
(37, 2, 'Gabriel', 6, '2024-10-30', '11:30:00', 1, 'Pendente'),
(38, 2, 'Gabriel', 6, '2024-10-30', '12:00:00', 1, 'Concluído'),
(39, 2, 'Gabriel', 6, '2024-10-30', '12:30:00', 1, 'Concluído'),
(40, 2, 'Jean', 5, '2024-10-30', '11:30:00', 1, 'Pendente'),
(41, 2, 'Jean', 5, '2024-10-30', '12:00:00', 1, 'Concluído'),
(42, 2, 'Jean', 5, '2024-10-30', '12:30:00', 1, 'Concluído'),
(43, 2, 'Jean', 5, '2024-10-30', '13:00:00', 1, 'Concluído'),
(44, 2, 'Jean', 5, '2024-10-30', '13:30:00', 1, 'Concluído'),
(45, 2, 'André', 2, '2025-03-11', '14:00:00', 1, 'Concluído'),
(46, 2, 'André', 2, '2025-03-11', '14:30:00', 1, 'Concluído'),
(49, 2, 'Gabriel', 4, '2024-10-29', '10:30:00', 1, 'Pendente'),
(51, 2, 'André', 4, '2024-11-23', '17:30:00', 1, 'Pendente'),
(52, 2, 'Jean', 2, '2024-11-09', '17:00:00', 1, 'Pendente'),
(53, 2, 'Jean', 2, '2024-11-09', '17:30:00', 1, 'Pendente'),
(54, 2, 'Jean', 1, '2024-11-07', '16:00:00', 1, 'Pendente'),
(55, 2, 'Jean', 1, '2024-11-07', '16:30:00', 1, 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `nome`, `preco`) VALUES
(1, 'Máquina', 22.00),
(2, 'Tesoura', 30.00),
(3, 'Barba', 22.00),
(4, 'Corte navalhado', 30.00),
(5, 'Cabelo e Barba', 50.00),
(6, 'Platinado', 80.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nivel` varchar(10) NOT NULL DEFAULT 'cliente',
  `nome` varchar(250) NOT NULL,
  `cpf` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `numero` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nivel`, `nome`, `cpf`, `email`, `numero`, `senha`) VALUES
(1, 'adm', 'Miguel Jaber', '129.364.976-71', 'migueljabermacedo@gmail.com', '(21) 98295-7001', 'abcde'),
(2, 'cliente', 'Carlos Silva', '347.280.925-79', 'carlos@gmail.com', '(21) 94902-7733', 'abcde'),
(3, 'cliente', 'Cleiton', '798.395.689-43', 'cleitonbernardo@gmail.com', '(21) 97544-4654', '1234');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `servico_id` (`servico_id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `fk_servico_id` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`),
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
