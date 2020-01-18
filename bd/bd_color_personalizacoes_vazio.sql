-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2019 às 23:47
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `codigo` int(10) UNSIGNED NOT NULL COMMENT 'Armazena o código do orçamento.',
  `preco_total` decimal(6,2) UNSIGNED NOT NULL COMMENT 'Armazena o preço total do orçamento.',
  `descricao` text NOT NULL COMMENT 'Armazena a descrição do orçamento.',
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
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código da categoria.';
--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do cliente.';
--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do orçamento.';
--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do produto.';
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Armazena o código do usuário.';
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
