-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2019 às 23:12
-- Versão do servidor: 5.7.11-log
-- Versão do PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_color_personalizacoes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código da categoria.',
  `nome` varchar(25) NOT NULL COMMENT 'Armazena o nome da categoria.',
  `descricao` text COMMENT 'Armazena a descrição da categoria.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazenar as informações das categorias.';

--
-- Fazendo dump de dados para tabela `categorias`
--

INSERT INTO `categorias` (`codigo`, `nome`, `descricao`) VALUES
(1, 'Vestuário', 'Produtos de vestuário personalizados'),
(2, 'Ecológico', 'Produtos ecológicos personalizados'),
(3, 'Escritório', 'Produtos de escritório personalizados'),
(4, 'Festa', 'Produtos de festa personalizados');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do cliente.',
  `nome` varchar(40) NOT NULL COMMENT 'Armazena o nome do cliente.',
  `cpf_cnpj` bigint(14) NOT NULL COMMENT 'Armazena o CPF ou CNPJ do cliente.',
  `cep` int(10) UNSIGNED DEFAULT NULL COMMENT 'Armazena o CEP do cliente.',
  `estado` char(2) NOT NULL COMMENT 'Armazena o estado do cliente.',
  `cidade` varchar(45) NOT NULL COMMENT 'Armazena a cidade do cliente.',
  `bairro` varchar(45) NOT NULL COMMENT 'Armazena o bairro do local da entrega do cliente.',
  `rua` varchar(45) NOT NULL COMMENT 'Armazena a rua do local da entrega do cliente.',
  `complemento` varchar(45) NOT NULL COMMENT 'Armazena o número do local da entrega do cliente.',
  `inscricao_estadual` bigint(15) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Armazena a inscrição estadual da empresa do cliente.',
  `telefone_1` bigint(12) UNSIGNED NOT NULL COMMENT 'Armazena o número de telefone do cliente.',
  `telefone_2` bigint(12) UNSIGNED DEFAULT NULL COMMENT 'Armazena o número de telefone do cliente.',
  `email` varchar(80) DEFAULT NULL COMMENT 'Armazena o e-mail do cliente.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as informações dos clientes.';

--
-- Fazendo dump de dados para tabela `clientes`
--

INSERT INTO `clientes` (`codigo`, `nome`, `cpf_cnpj`, `cep`, `estado`, `cidade`, `bairro`, `rua`, `complemento`, `inscricao_estadual`, `telefone_1`, `telefone_2`, `email`) VALUES
(1, 'Sarah Strey', 15817010976, 89220021, 'SC', 'Joinville', 'Costa e silva', 'Das andorinhas', '855 apto 201', NULL, 47997597152, 4738010833, 'streysarah@gmail.com'),
(2, 'Ana Júlia Bilk', 12492036944, NULL, 'SC', 'Joinville', 'Costa e silva', 'Pardal', '271', NULL, 47997385979, NULL, 'ana@gmail.com'),
(3, 'Lucas Cruz', 18745327188, NULL, 'SC', 'Joinville', 'Bom Retiro', 'Leão XIII', '678', NULL, 47988145321, NULL, NULL),
(4, 'Wagner Ribas', 10422266901, NULL, 'SC', 'Joinville', 'Santo ântonio', 'Costureiras', '871', NULL, 47997922841, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do orçamento.',
  `preco_total` decimal(6,2) UNSIGNED NOT NULL COMMENT 'Armazena o preço total do orçamento.',
  `data_emissao` date NOT NULL COMMENT 'Armazena data de emissão do orçamento.',
  `desconto` decimal(6,2) UNSIGNED DEFAULT NULL COMMENT 'Armazena o desconto do orçamento.',
  `rua` varchar(45) NOT NULL COMMENT 'Armazena a rua do local de entrega do orçamento.',
  `parcelamento` tinyint(2) UNSIGNED DEFAULT NULL COMMENT 'Armazena o parcelamento do orçamento.',
  `bairro` varchar(45) NOT NULL COMMENT 'Armazena o bairro do local de entrega do orçamento.',
  `cidade` varchar(45) NOT NULL COMMENT 'Armazena a cidade do local de entrega do orçamento.',
  `estado` char(2) NOT NULL COMMENT 'Armazena o estado do local de entrega do orçamento.',
  `complemento` varchar(45) NOT NULL COMMENT 'Armazena o complemento do local de entrega do orçamento.',
  `cep` int(10) UNSIGNED DEFAULT NULL COMMENT 'Armazena o cep do local de entrega do orçamento.',
  `usuarios_codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do usuário.',
  `clientes_codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do cliente.',
  `status` tinyint(1) NOT NULL COMMENT 'Adiciona o status do orçamento.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as informações dos orçamentos.';

--
-- Fazendo dump de dados para tabela `orcamentos`
--

INSERT INTO `orcamentos` (`codigo`, `preco_total`, `data_emissao`, `desconto`, `rua`, `parcelamento`, `bairro`, `cidade`, `estado`, `complemento`, `cep`, `usuarios_codigo`, `clientes_codigo`, `status`) VALUES
(1, '22.00', '2019-11-27', '10.00', 'Das andorinhas', 2, 'Costa e silva', 'Joinville', 'SC', '855 apto 201', NULL, 2, 1, 2),
(2, '28.00', '2019-11-27', NULL, 'Pardal', 1, 'Costa e silva', 'Joinville', 'SC', '271', NULL, 2, 2, 2),
(3, '16.00', '2019-11-27', '5.00', 'Leão XII', 1, 'Bom retiro', 'Joinville', 'SC', '678', NULL, 2, 3, 3),
(4, '34.00', '2019-11-28', '20.00', 'Costureiras', 1, 'Santo ântonio', 'Joinville', 'SC', '871', NULL, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos_has_produtos`
--

CREATE TABLE `orcamentos_has_produtos` (
  `orcamentos_codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do orçamento.',
  `produtos_codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do produto.',
  `descricao` text COMMENT 'Armazena a descrição do pedido do cliente.',
  `qtde` int(5) UNSIGNED NOT NULL COMMENT 'Armazena a quantidade do pedido do cliente.',
  `preco_atual` decimal(6,2) UNSIGNED NOT NULL COMMENT 'Armazena preço atual do pedido do cliente.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as informações dos pedidos.';

--
-- Fazendo dump de dados para tabela `orcamentos_has_produtos`
--

INSERT INTO `orcamentos_has_produtos` (`orcamentos_codigo`, `produtos_codigo`, `descricao`, `qtde`, `preco_atual`) VALUES
(1, 1, 'Com estampa da mulher maravilha', 1, '12.00'),
(1, 2, 'Com foto', 2, '5.00'),
(2, 5, 'Com estampa dos minions', 2, '14.00'),
(3, 4, 'Com estampa de árvores', 1, '10.00'),
(3, 6, 'Com estampa de super homem', 2, '3.00'),
(4, 4, '', 2, '10.00'),
(4, 5, '', 1, '14.00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordens_de_servicos`
--

CREATE TABLE `ordens_de_servicos` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código da ordem de serviço.',
  `data_entrega` date NOT NULL COMMENT 'Armazena a data de entrega da ordem de serviço.',
  `data_geracao` date NOT NULL COMMENT 'Armazena a data de geração da ordem de serviço.',
  `status` tinyint(1) NOT NULL COMMENT 'Armazena o status da ordem de serviço.',
  `orcamentos_codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do orçamento.',
  `usuarios_codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do usuário.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as informações das ordens de serviço.';

--
-- Fazendo dump de dados para tabela `ordens_de_servicos`
--

INSERT INTO `ordens_de_servicos` (`codigo`, `data_entrega`, `data_geracao`, `status`, `orcamentos_codigo`, `usuarios_codigo`) VALUES
(1, '2019-12-06', '2019-11-27', 1, 1, 3),
(2, '2019-12-09', '2019-11-27', 1, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do produto.',
  `nome` varchar(25) NOT NULL COMMENT 'Armazena o nome do produto.',
  `imagem` varchar(255) DEFAULT NULL COMMENT 'Armazena o caminho da imagem do produto.',
  `preco_unitario` decimal(6,2) UNSIGNED NOT NULL COMMENT 'Armazena o preço unitário do produto.',
  `categorias_codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código da categoria.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela para armazenar as informações dos produtos.';

--
-- Fazendo dump de dados para tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `nome`, `imagem`, `preco_unitario`, `categorias_codigo`) VALUES
(1, 'Camisa', '15747960275ddd7afb47937.jpg', '12.00', 1),
(2, 'Caneca', '15747960545ddd7b16e2548.jpg', '5.00', 3),
(3, 'Taça', '15747960715ddd7b2738baa.jpg', '3.00', 4),
(4, 'Caderno', '15747960855ddd7b35498ce.jpg', '10.00', 2),
(5, 'Camisa Polo', '15748937775ddef8d1f3f57.jpg', '14.00', 1),
(6, 'Lápis', '15748938275ddef90353402.jpg', '3.00', 2),
(7, 'Topper de bolo', '15748938585ddef922acf39.jpg', '5.00', 4),
(8, 'Caneta', '15748939055ddef951e346e.jpg', '2.00', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do usuário.',
  `nivel` tinyint(1) NOT NULL COMMENT 'Armazena o nível do usuário.',
  `email` varchar(80) NOT NULL COMMENT 'Armazena o e-mail do usuário.',
  `senha` char(32) NOT NULL COMMENT 'Armazena a senha do usuário.',
  `nome` varchar(45) NOT NULL COMMENT 'Armazena o nome do usuário.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena as informações dos usuários.';

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `nivel`, `email`, `senha`, `nome`) VALUES
(1, 1, 'gerente@color.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Gerente'),
(2, 2, 'atendente@color.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Atendente'),
(3, 3, 'operario@color.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Operário');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_orcamentos_usuarios1_idx` (`usuarios_codigo`),
  ADD KEY `fk_orcamentos_clientes1_idx` (`clientes_codigo`);

--
-- Índices de tabela `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD PRIMARY KEY (`orcamentos_codigo`,`produtos_codigo`),
  ADD KEY `fk_orcamentos_has_produtos1_produtos1_idx` (`produtos_codigo`),
  ADD KEY `fk_orcamentos_has_produtos1_orcamentos1_idx` (`orcamentos_codigo`);

--
-- Índices de tabela `ordens_de_servicos`
--
ALTER TABLE `ordens_de_servicos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_ordens_de_servicos_orcamentos1_idx` (`orcamentos_codigo`),
  ADD KEY `fk_ordens_de_servicos_usuarios1_idx` (`usuarios_codigo`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_produtos_categorias_idx` (`categorias_codigo`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código da categoria.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do cliente.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do orçamento.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do produto.', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do usuário.', AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD CONSTRAINT `fk_orcamentos_clientes1` FOREIGN KEY (`clientes_codigo`) REFERENCES `clientes` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_usuarios1` FOREIGN KEY (`usuarios_codigo`) REFERENCES `usuarios` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `orcamentos_has_produtos`
--
ALTER TABLE `orcamentos_has_produtos`
  ADD CONSTRAINT `fk_orcamentos_has_produtos1_orcamentos1` FOREIGN KEY (`orcamentos_codigo`) REFERENCES `orcamentos` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orcamentos_has_produtos1_produtos1` FOREIGN KEY (`produtos_codigo`) REFERENCES `produtos` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `ordens_de_servicos`
--
ALTER TABLE `ordens_de_servicos`
  ADD CONSTRAINT `fk_ordens_de_servicos_orcamentos1` FOREIGN KEY (`orcamentos_codigo`) REFERENCES `orcamentos` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ordens_de_servicos_usuarios1` FOREIGN KEY (`usuarios_codigo`) REFERENCES `usuarios` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias` FOREIGN KEY (`categorias_codigo`) REFERENCES `categorias` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
