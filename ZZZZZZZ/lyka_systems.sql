-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 07-Abr-2021 às 18:32
-- Versão do servidor: 10.3.23-MariaDB-0+deb10u1
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lyka_systems`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `idAdmin` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `genero` enum('F','M') NOT NULL,
  `email` varchar(255) NOT NULL,
  `dataNasc` date NOT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `telefone1` int(11) NOT NULL,
  `telefone2` int(11) DEFAULT NULL,
  `superAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`idAdmin`, `nome`, `apelido`, `genero`, `email`, `dataNasc`, `fotografia`, `telefone1`, `telefone2`, `superAdmin`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Senhor', 'Administrador', 'M', 'admin@test.com', '2000-01-01', NULL, 912345678, NULL, 1, 'senhor-administrador', '2020-02-12 00:00:00', '2020-02-12 00:00:00'),
(2, 'José', 'Areia', 'M', 'jose.apareia@gmail.com', '2000-12-11', NULL, 965887768, NULL, 1, 'jose-areia', '2020-11-18 20:12:10', '2020-11-18 20:12:10'),
(3, 'Carla', 'Gaspar', 'F', 'carla.gaspar@estudarportugal.com', '1977-01-16', NULL, 918456031, 961326370, 1, 'carla-gaspar', '2021-02-25 14:49:00', '2021-02-25 14:49:00'),
(4, 'Linda', 'Sousa', 'F', 'linda.sousa@estudarportugal.com', '1970-09-18', NULL, 917804598, 917766116, 1, 'linda-sousa', '2021-03-22 14:07:52', '2021-03-22 14:07:52'),
(5, 'Linda Carreira', 'Sousa', 'F', 'linda.carreira.sousa@gmail.com', '1970-09-18', NULL, 917804598, 917766116, 1, 'linda-carreira-sousa', '2021-03-22 14:08:43', '2021-03-22 14:08:43'),
(6, 'Filipe', 'Pinto', 'M', 'fmp.filipe@gmail.com', '1970-05-17', NULL, 917766116, 917766116, 1, 'filipe-pinto', '2021-04-07 08:57:38', '2021-04-07 08:57:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(191) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  `cor` varchar(7) NOT NULL,
  `visibilidade` tinyint(1) NOT NULL DEFAULT 0,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idUniversidade` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `titulo`, `descricao`, `data_inicio`, `data_fim`, `cor`, `visibilidade`, `idUser`, `idUniversidade`, `created_at`, `updated_at`) VALUES
(2, 'REUNIÓN CON EL COLEGIO SAN FELIPE NERI DE LA CIUDAD DE RIOBAMBA-  ECUADOR', 'Martes 16 de marzo a las 08:00 AM (Ecuador)\r\nPSICÓLOGA ENCARGADA DEL DECE: \r\nAMAROOM MOLINA GRANDA. \r\nSON 160 ESTUDIANTES DE TERCERO DE BACHILLERATO.', '2021-03-16 00:00:00', '2021-03-18 00:00:00', '#4e73df', 0, 1, NULL, '2021-01-14 10:10:40', '2021-01-14 10:10:40'),
(3, 'REUNIÓN CON EL COLEGIO SAN FELIPE NERI DE LA CIUDAD DE RIOBAMBA-  ECUADOR', 'EL GRUPO SERÁ DIVIDIDO EN 2, CADA UNA DEBE DURAR SOLO 45 MINUTOS.ESTA ES LA PÁGINA WEB DEL COLEGIO: https://www.sfelipeneri.edu.ec/myindex.php', '2021-03-18 00:00:00', '2021-03-19 00:00:00', '#4e73df', 0, 1, NULL, '2021-01-14 10:17:47', '2021-01-14 10:17:47'),
(4, 'Apresentações Colégio ANAI - Guayaquil', 'Charla 3.º Bachillerato de Ciências às 8h', '2021-01-20 00:00:00', '2021-01-21 00:00:00', '#4e73df', 1, 1, NULL, '2021-01-18 15:06:58', '2021-01-18 15:06:58'),
(5, 'Apresentações Colégio ANAI - Guayaquil', 'Charla 3.º Bachillerato de Informática e Contabilidade às 9h', '2021-01-20 00:00:00', '2021-01-21 00:00:00', '#4e73df', 1, 1, NULL, '2021-01-18 15:07:38', '2021-01-18 15:07:38'),
(6, 'Apresentações Colégio ANAI - Guayaquil', 'Charla 3.º Bachillerato de Ciências às 14h', '2021-01-20 00:00:00', '2021-01-21 00:00:00', '#4e73df', 1, 1, NULL, '2021-01-18 15:08:11', '2021-01-18 15:08:11'),
(7, 'Apresentações Colégio ANAI - Guayaquil', 'Charla 3.º Bachillerato de Informática e Contabilidade às 15h', '2021-01-20 00:00:00', '2021-01-21 00:00:00', '#4e73df', 1, 1, NULL, '2021-01-18 15:08:48', '2021-01-18 15:08:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agente`
--

CREATE TABLE `agente` (
  `idAgente` bigint(20) UNSIGNED NOT NULL,
  `idAgenteAssociado` bigint(20) UNSIGNED DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `genero` enum('F','M') NOT NULL,
  `tipo` enum('Agente','Subagente') NOT NULL,
  `exepcao` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `dataNasc` date NOT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `morada` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `NIF` varchar(255) NOT NULL,
  `num_doc` varchar(255) NOT NULL,
  `img_doc` varchar(255) DEFAULT NULL,
  `telefone1` varchar(255) NOT NULL,
  `telefone2` varchar(255) DEFAULT NULL,
  `IBAN` varchar(255) DEFAULT NULL,
  `observacoes` longtext DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `agente`
--

INSERT INTO `agente` (`idAgente`, `idAgenteAssociado`, `nome`, `apelido`, `genero`, `tipo`, `exepcao`, `email`, `dataNasc`, `fotografia`, `morada`, `pais`, `NIF`, `num_doc`, `img_doc`, `telefone1`, `telefone2`, `IBAN`, `observacoes`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Silvana', 'Garces', 'F', 'Agente', 0, 'silvana.garces@estudarportugal.com', '1970-01-01', '1.PNG', 'Guayquil', 'Equador', '111222333', '111222333', NULL, '+593 96 254 1214', NULL, NULL, 'Guayaquil', 'silvana-garces', '2020-12-02 11:25:26', '2020-12-02 11:25:26', NULL),
(2, NULL, 'Interno', 'EPPE', 'M', 'Agente', 0, 'estudarportugal@gmail.com', '1970-05-17', NULL, 'Leiria', 'Portugal', '208832700', '208832700', NULL, '917 7804598', NULL, NULL, NULL, 'interno-eppe', '2020-12-02 14:28:53', '2021-03-29 07:46:18', NULL),
(3, NULL, 'Irene', 'Medranda', 'F', 'Agente', 0, 'Irenita17ismm@hotmail.com', '1970-01-01', NULL, 'Manta', 'Equador', '111111111', '111111111', NULL, '+593 99 441 3328', NULL, NULL, NULL, 'irene-medranda', '2020-12-12 17:44:52', '2021-02-05 11:13:15', NULL),
(4, NULL, 'Gonzalo', 'Davalos', 'M', 'Agente', 0, 'godach@hotmail.com', '1970-01-01', NULL, 'Equador', 'Equador', '987654321', '123456789', NULL, '+593 999667722', NULL, NULL, NULL, 'gonzalo-davalos', '2021-03-23 17:48:30', '2021-03-23 17:48:30', NULL),
(5, NULL, 'Lezly', 'Garcia', 'F', 'Agente', 0, 'mexico@estudarportugal.com', '1970-01-01', NULL, 'Cidade do Mexico', 'México', '123456789', 'GAGL760328IX5', NULL, '+52 55 3668 7643', NULL, NULL, NULL, 'lezly-garcia', '2021-03-26 16:25:54', '2021-03-26 16:25:54', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca`
--

CREATE TABLE `biblioteca` (
  `idBiblioteca` bigint(20) UNSIGNED NOT NULL,
  `acesso` enum('Privado','Público') NOT NULL DEFAULT 'Privado',
  `descricao` varchar(255) NOT NULL,
  `link` text DEFAULT NULL,
  `ficheiro` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `tamanho` varchar(255) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `biblioteca`
--

INSERT INTO `biblioteca` (`idBiblioteca`, `acesso`, `descricao`, `link`, `ficheiro`, `tipo`, `tamanho`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Privado', 'Planos Custos Equador', NULL, 'ENIDH-Plano-cus(1).pdf', 'application/pdf', '104.25 KB', 'planos-custos-equador', '2021-01-06 13:53:58', '2021-01-06 13:53:58'),
(2, 'Privado', 'Planos Custos Equador', NULL, 'ISCTE-Plano-cus(2).pdf', 'application/pdf', '101.3 KB', 'planos-custos-equador-1', '2021-01-06 13:54:17', '2021-01-06 13:54:17'),
(3, 'Privado', 'Planos Custos Equador', NULL, 'UALG-Plano-cust(3).pdf', 'application/pdf', '93.87 KB', 'planos-custos-equador-2', '2021-01-06 13:54:32', '2021-01-06 13:54:32'),
(4, 'Privado', 'Planos Custos Equador', NULL, 'UBI-Plano-custo(4).pdf', 'application/pdf', '92.06 KB', 'planos-custos-equador-3', '2021-01-06 13:54:45', '2021-01-06 13:54:45'),
(5, 'Privado', 'Plano Custos Mexico', NULL, 'ENIDH-Plano-Cus(5).pdf', 'application/pdf', '104.85 KB', 'plano-custos-mexico', '2021-01-06 13:55:00', '2021-01-06 13:55:00'),
(6, 'Privado', 'Plano Custos Mexico', NULL, 'ISCTEPlano-Cust(6).pdf', 'application/pdf', '101.41 KB', 'plano-custos-mexico-1', '2021-01-06 13:55:15', '2021-01-06 13:55:15'),
(7, 'Privado', 'Plano Custos Mexico', NULL, 'UALGPlano-Custo(7).pdf', 'application/pdf', '94.56 KB', 'plano-custos-mexico-2', '2021-01-06 13:55:32', '2021-01-06 13:55:32'),
(8, 'Privado', 'Plano Custos Mexico', NULL, 'UBI-Plano-custo(8).pdf', 'application/pdf', '92.57 KB', 'plano-custos-mexico-3', '2021-01-06 13:55:49', '2021-01-06 13:55:49'),
(9, 'Privado', 'Doc. para Abertura conta UALG e pedido passe', NULL, 'PASSESub23Edita(9).pdf', 'application/pdf', '321.09 KB', 'doc-para-abertura-conta-ualg-e-pedido-passe', '2021-01-11 10:02:29', '2021-01-11 10:02:29'),
(10, 'Privado', 'Formulário Inscrição', NULL, 'Formulrio-de-Re(10).pdf', 'application/pdf', '431.92 KB', 'formulario-inscricao', '2021-01-12 17:16:47', '2021-01-12 17:16:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` bigint(20) UNSIGNED NOT NULL,
  `idAgente` bigint(20) UNSIGNED DEFAULT NULL,
  `idSubAgente` bigint(20) UNSIGNED DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `genero` enum('F','M') NOT NULL DEFAULT 'M',
  `email` varchar(255) DEFAULT NULL,
  `telefone1` varchar(255) DEFAULT NULL,
  `telefone2` varchar(255) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `paisNaturalidade` varchar(255) DEFAULT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `moradaResidencia` varchar(255) DEFAULT NULL,
  `nomePai` varchar(255) DEFAULT NULL,
  `telefonePai` varchar(255) DEFAULT NULL,
  `emailPai` varchar(255) DEFAULT NULL,
  `nomeMae` varchar(255) DEFAULT NULL,
  `telefoneMae` varchar(255) DEFAULT NULL,
  `emailMae` varchar(255) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `NIF` varchar(255) DEFAULT NULL,
  `IBAN` varchar(255) DEFAULT NULL,
  `nivEstudoAtual` enum('Secundário Incompleto','Secundário Completo','Curso Tecnológico','Estuda na Universidade','Licenciado','Mestrado') DEFAULT NULL,
  `exame` tinyint(1) DEFAULT NULL,
  `universidade1` varchar(255) DEFAULT NULL,
  `universidade2` varchar(255) DEFAULT NULL,
  `curso1` varchar(255) DEFAULT NULL,
  `curso2` varchar(255) DEFAULT NULL,
  `curso3` varchar(255) DEFAULT NULL,
  `nomeInstituicaoOrigem` varchar(255) DEFAULT NULL,
  `cidadeInstituicaoOrigem` varchar(255) DEFAULT NULL,
  `num_docOficial` varchar(255) DEFAULT NULL,
  `validade_docOficial` longtext DEFAULT NULL,
  `numPassaporte` longtext DEFAULT NULL,
  `refCliente` longtext DEFAULT NULL,
  `obsPessoais` longtext DEFAULT NULL,
  `obsFinanceiras` longtext DEFAULT NULL,
  `obsAcademicas` longtext DEFAULT NULL,
  `obsAgente` longtext DEFAULT NULL,
  `estado` enum('Inativo','Ativo','Proponente') NOT NULL DEFAULT 'Inativo',
  `editavel` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `idAgente`, `idSubAgente`, `nome`, `apelido`, `genero`, `email`, `telefone1`, `telefone2`, `dataNasc`, `paisNaturalidade`, `morada`, `cidade`, `moradaResidencia`, `nomePai`, `telefonePai`, `emailPai`, `nomeMae`, `telefoneMae`, `emailMae`, `fotografia`, `NIF`, `IBAN`, `nivEstudoAtual`, `exame`, `universidade1`, `universidade2`, `curso1`, `curso2`, `curso3`, `nomeInstituicaoOrigem`, `cidadeInstituicaoOrigem`, `num_docOficial`, `validade_docOficial`, `numPassaporte`, `refCliente`, `obsPessoais`, `obsFinanceiras`, `obsAcademicas`, `obsAgente`, `estado`, `editavel`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 'Francisco Josue', 'Ayala Davila', 'M', 'ayalafranjr4@gmail.com', '+593968849220', NULL, '2003-01-28', 'Equador', 'Calixto Miranda 2-24 y Rafael Larrea', 'Ibarra', NULL, 'Arturo Francisco Ayala Carrera', '0994283843', 'ayalafran@yahoo.com', 'Erika Paulina Davila Pantoja', '0994912208', 'paulyd1305@hotmail.com', '1.PNG', NULL, NULL, 'Secundário Completo', NULL, 'UALG', 'UBI', 'Engenharia Informática', NULL, NULL, 'U E Intern. Pensionado \"atahualpa\"', 'Ibarra', '1004426373', NULL, '1004426373', '001.EC.21.001', 'Estudante para Pré Universitário\r\n---------------- Licenciatura em Eng. Informática UALG', NULL, NULL, NULL, 'Ativo', 1, 'francisco-josue-ayala-davila', '2020-12-02 11:46:28', '2021-03-02 16:30:55', NULL),
(2, 2, NULL, 'Domenica Anabel', 'Guacho Guaman', 'F', NULL, NULL, NULL, '2000-10-30', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.PNG', NULL, NULL, 'Secundário Completo', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0104892625', '002.EC.21.002', 'Cliente Redes sociais----------------------------\r\nEstudante para Pré universitário ----------------\r\nLicenciatura em Gestão UALG', NULL, NULL, NULL, 'Proponente', 1, 'domenica-anabel-guacho-guaman', '2020-12-02 14:39:09', '2021-03-29 13:53:14', NULL),
(3, 1, NULL, 'Simon', 'Sarmiento Mora', 'M', 'simonsm07@gmail.com', '+593989679536', NULL, '2001-07-11', 'Equador', 'Gonzalo Cordero 2-59, Edif. Jacaranda, Dpto. 301', 'Cuenca', NULL, 'Simon Sarmiento Penã', '0991506790', 'nomonsi@gmail.com', 'Daniela Mora Crespo', '0989879558', 'mora.dany@hotmail.com', '3.PNG', NULL, NULL, 'Secundário Completo', NULL, 'UBI', NULL, 'Desenho Multimédia', NULL, NULL, 'U E Particular \"santana\"', 'Cuenca', NULL, NULL, '0105193502', '003.EC.21.003', 'Estudante de Pré Universitário -----------------\r\nLicenciatura em design Multimédia UBI', NULL, NULL, 'Licenciatura em design Multimédia', 'Ativo', 1, 'simon-sarmiento-mora', '2020-12-09 17:51:03', '2021-03-02 16:35:18', NULL),
(4, 1, NULL, 'Emely Cecilia', 'Ordoñez Lam', 'F', NULL, NULL, NULL, '2002-10-06', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.PNG', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', NULL, 'Gestão', NULL, NULL, 'U E Particular Bil.\"marcelo Laniado De Wind\"', 'Machala', NULL, NULL, '0750218414', '004.EC.21.004', 'Estudante para Pré Universitário ----------------\r\nLicenciatura em Gestão', NULL, NULL, NULL, 'Ativo', 1, 'emely-cecilia-ordonez-lam', '2020-12-09 18:17:20', '2021-03-02 16:37:13', NULL),
(5, 3, NULL, 'Valentina', 'Avila', 'F', NULL, NULL, NULL, NULL, 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UALG', 'UBI', 'Biologia Marinha', 'Desenho Gráfico', NULL, NULL, NULL, NULL, NULL, NULL, '005.EC.21.005', 'Estudante para pré Universitário ----------------\r\nLicenciatura em Biologia Marinha', NULL, NULL, NULL, 'Ativo', 1, 'valentina-avila', '2020-12-12 18:38:47', '2021-03-02 16:40:10', NULL),
(6, 1, NULL, 'Julio Andre', 'Rivadeneira Salazar', 'M', NULL, NULL, NULL, '2000-06-02', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UBI', NULL, 'Ciências Biomédicas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '006.EC.21.006', 'Estudante para Pré Universitário ------------------------\r\nLicenciatura em Ciências Biomédicas UBI', NULL, NULL, NULL, 'Ativo', 1, 'julio-andre-rivadeneira-salazar', '2020-12-12 18:41:01', '2021-03-02 16:43:00', NULL),
(7, 1, NULL, 'Albita Crystina', 'Ordoñez Serpa', 'F', NULL, NULL, NULL, '2004-04-05', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.JPG', NULL, NULL, 'Secundário Incompleto', 1, 'Évora', 'UBI', 'Biotecnologia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '007.EC.21.007', 'Redes Sociais\r\nAngariada por Filipe------------------\r\nEstudante para Licenciatura Biotecnologia UBI', NULL, NULL, NULL, 'Ativo', 1, 'albita-crystina-ordonez-serpa', '2020-12-12 18:43:41', '2021-04-07 08:54:21', NULL),
(8, 1, NULL, 'Joel Sebastian', 'Leiva Tapia', 'M', NULL, NULL, NULL, '2004-02-06', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', 'UBI', 'Engenharia Informática', NULL, NULL, NULL, NULL, NULL, NULL, '1722265160', '008.EC.21.008', 'Estudante para Licenciatura - Eng. Informática --------- UBI ou UALG', NULL, NULL, 'Estudante do ciclo serra. Só virá para licenciatura.', 'Ativo', 1, 'joel-sebastian-leiva-tapia', '2021-01-13 14:53:00', '2021-03-02 16:59:33', NULL),
(9, 1, NULL, 'David Josue', 'Quimis Proaño', 'M', 'davidjosue0407@outlook.com', '+593042070723', '+593960101047', '2003-04-07', 'Equador', 'Urbanizacion La Joya Etapa Onix MZ 1 Villa 7', 'Guayaquil', NULL, 'Luis Carlos Leon Franco', '+593981774915', 'repregal10@outlook.es', 'Dora Isabel Juliana Proaño', '+593981774915', NULL, '9.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UBI', NULL, 'Ciências Biomédicas', 'Arquitetura', NULL, 'Anai', 'Guayaquil', NULL, NULL, '0931054993', '009.EC.21.009', 'Estudante para Pré universitário ------------------------------\r\nLicenciatura em Ciências Biomédicas - UBI', NULL, NULL, NULL, 'Ativo', 1, 'david-josue-quimis-proano', '2021-01-13 15:02:52', '2021-03-02 17:01:51', NULL),
(10, 1, NULL, 'Carlos Erick', 'Lopez Gomez', 'M', NULL, '0935020306', '0981318355', '2003-07-28', 'Equador', 'Alborada Novena Etapa MZ. \"CH\" Villa 6', 'Guayaquil', 'Guayquil', 'Juan Carlos Lopez Romero', '0994375112', NULL, 'Tatiana Roxana Gomez Limones', '0994375112', 'roxana_2002@hotmail.com', '10.JPG', NULL, NULL, 'Secundário Incompleto', 0, 'UALG', 'UBI', 'Engenharia Civil', NULL, NULL, NULL, NULL, NULL, NULL, '0930244660', '010.EC.21.010', 'Estudante para Pré Universitário ----------------------------------\r\nLicenciatura em Eng. Civil - UBI ou UALG', NULL, NULL, NULL, 'Ativo', 1, 'carlos-erick-lopez-gomez', '2021-01-13 15:14:53', '2021-03-29 07:54:46', NULL),
(11, 1, NULL, 'Damian Sebastian', 'Serrano Cardenas', 'M', NULL, NULL, NULL, '2000-11-01', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Secundário Completo', 1, 'Évora', NULL, 'Turismo', NULL, NULL, NULL, NULL, NULL, NULL, '0706365046', '011.EC.21.011', 'Estudante para Pré Universitário ---------------------------------\r\nLicenciatura Psicologia - Algarve', NULL, NULL, NULL, 'Ativo', 1, 'damian-sebastian-serrano-cardenas', '2021-01-13 15:19:18', '2021-03-29 07:55:36', NULL),
(12, 1, NULL, 'Juliana Antonella', 'Yepez Toscano', 'F', NULL, NULL, NULL, '2002-11-20', 'Equador', 'Buena Fé', 'Buena fé', NULL, 'Julio Cesar Yepez Espinoza', '0997460940', 'julioyepezes@hotmail.com', 'Marlene Toscano Mendoza', NULL, 'marlenetscanomendoza@hotmail.es', '12.JPG', NULL, NULL, 'Secundário Completo', 0, 'UALG', 'UBI', 'Imagem Medica e radioterapia', 'Dietética e Nutrição', NULL, NULL, NULL, NULL, NULL, '1206883785', '012.EC.21.012', 'Estudante para Pré Universitário ---------------------------------\r\nLicenciatura em ----------------------------------------------------------\r\n1.ª opção: Ciências Biomédicas ------------------------------------------\r\n2.ª opção: Dietética e Nutrição', NULL, NULL, NULL, 'Proponente', 1, 'juliana-antonella-yepez-toscano', '2021-01-13 15:28:07', '2021-03-29 13:53:38', NULL),
(13, 1, NULL, 'Domenica Melissa', 'Cedeño Serrano', 'F', NULL, NULL, NULL, '2002-04-22', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13.JPG', NULL, NULL, '', 0, 'UALG', 'Évora', 'Sociologia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '013.EC.21.013', 'Estudante para Pré Universitário -----------------------------\r\nLicenciatura Sociologia - Algarve', NULL, NULL, NULL, 'Ativo', 1, 'domenica-melissa-cedeno-serrano', '2021-01-22 15:47:47', '2021-03-24 17:27:57', NULL),
(14, 1, NULL, 'Carlos David', 'Carvajal Romero', 'M', NULL, NULL, NULL, '2003-03-18', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '14.JPG', NULL, NULL, 'Secundário Completo', 0, 'UBI', 'UALG', 'Engenharia Civil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '014.EC.21.014', 'Licenciatura - Eng. Civil - Algarve', NULL, NULL, NULL, 'Ativo', 1, 'carlos-david-carvajal-romero', '2021-01-22 15:57:01', '2021-03-29 07:53:55', NULL),
(15, 2, NULL, 'Leslie Franchesca', 'Velasquez Quiteros', 'F', NULL, '0963839651', NULL, '2002-05-04', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15.JPG', NULL, NULL, '', 1, 'Évora', 'UALG', 'Biotecnologia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '015.EC.21.015', 'Licenciatura Biotecnologia -----------------------------------------------\r\nUBI / UALG', NULL, NULL, NULL, 'Ativo', 1, 'leslie-franchesca-velasquez-quiteros', '2021-01-22 16:18:00', '2021-03-29 07:57:18', NULL),
(16, 1, NULL, 'Leonel Ridley', 'Ronquillo Peña', 'M', 'leo.ronquillo2003@gmail.com', '0980145038', NULL, '2003-07-29', 'Equador', 'La Joya- Daule', 'Guayaquil', NULL, 'Leonel Efrain Ronquillo', '0991968304', 'leonelronquillo@gmail.com', 'Yanina Mireya Peña Correa', '0994376501', 'leonela.yanina09@gmail.com', '16.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', 'UBI', 'Ciências Biomédicas', NULL, NULL, 'U E \"americano\"', 'Guayaquil', NULL, NULL, NULL, '016.EC.21.016', 'Licenciatura Ciências Biomédicas -------------------------', NULL, NULL, NULL, 'Ativo', 1, 'leonel-ridley-ronquillo-pena', '2021-01-25 16:22:50', '2021-03-02 18:25:16', NULL),
(17, 1, NULL, 'Emilly Lisbeth', 'Nicola Alfonso', 'F', NULL, NULL, NULL, '2002-01-07', 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17.JPG', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '017.EC.21.017', 'Estudante para Pré Universitário ------------------------------------------\r\nLicenciatura Ciências Politicas - ISCTE', NULL, NULL, NULL, 'Ativo', 1, 'emilly-lisbeth-nicola-alfonso', '2021-01-25 16:53:41', '2021-01-26 14:57:54', NULL),
(18, 2, NULL, 'Jose Paul', 'Yerovi Mantilla', 'M', 'yerovijose2003@hotmail.com', '0983353008', '2918453', '2003-07-26', 'Equador', 'Av. Quito 6 esquinas frente al hospital san vicente de paul', 'Pasaje', NULL, 'Jose Aniceto Yerovi Usinia', '+593995505630', 'dr.joseyerovi@gmail.com', 'Sandra Tamara Mantilla Azuero', '+593983244300', 'sandramantilla@live.com', '18.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UBI', 'ISCTE', 'Ciências da Comunicação', 'Marketing', NULL, 'Colégio Militar \"heroes Del 41\"', 'Pasaje', NULL, NULL, NULL, '018.EC.21.018', 'Estudante para Pré Universitário-------------------------------------\r\nLicenciatura 1.ª opção: Ciências da Comunicação  /  2.ª opção: Marketing -              \r\n1.º - UBI   /   2.º ISCTE', NULL, NULL, NULL, 'Ativo', 1, 'jose-paul-yerovi-mantilla', '2021-01-27 17:04:35', '2021-03-03 10:47:31', NULL),
(19, 1, NULL, 'Emilia Alejandra', 'Haro Ayala', 'F', 'emya-2003@hotmail.com', '0968091695', NULL, '2003-02-28', 'Equador', 'Av. Luis Enrique Cisneros #8-88 y Panamericana', 'Otavalo', NULL, 'Pablo Gabriel Haro Ruiz', '0994621519', NULL, 'Aurora Elizabeth Ayala Orellana', '0979702312', 'ely_ayala11@hotmail.com', '19.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UALG', NULL, 'Gestão Hoteleira', NULL, NULL, 'U E \"santa Juana De Chantal\"', 'Otavalo', NULL, NULL, NULL, '019.EC.21.019', 'Estudante para Pré Universitário ---------------------------------------\r\nLicenciatura Gestão Hoteleira-------------------------------------------\r\nUALG ou UBI', NULL, NULL, NULL, 'Ativo', 1, 'emilia-alejandra-haro-ayala', '2021-01-27 17:16:30', '2021-03-03 10:52:50', NULL),
(20, 1, NULL, 'Luis Fernando', 'Andrade Ponce', 'M', NULL, '0992388962', NULL, '2002-11-09', 'Equador', 'Metropolis 2 etapa H - Guayas', 'Guayaquil', NULL, 'Luis Fernando Andrade Molina', '0984886868', 'intiparu@gmail.com', 'Victoria Lorena Ponce Ojeda', '0992197868', 'vponce81.psicologa@gmail.com', '20.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UBI', NULL, 'CPRI', NULL, NULL, 'U E Particular \"logos\"', 'Guayaquil', NULL, NULL, NULL, '020.EC.21.020', 'Licenciatura Ciências Politicas e Relações Internacionais  -  UBI', NULL, NULL, NULL, 'Ativo', 1, 'luis-fernando-andrade-ponce', '2021-01-28 15:54:21', '2021-03-03 10:54:55', NULL),
(21, 1, NULL, 'Sebastian Alberto', 'Hidalgo Kon', 'M', 'sebashidalgokon@gmail.com', '0990450561', NULL, '2003-04-26', 'Equador', 'El Condor 0e4-177', 'Quito', NULL, 'Charles Hidalgo', '0992062392', 'chm_hidalgo@yahoo.com', 'Rosita Kon', '0997656431', 'rosykon@yahoo.es', '21.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UALG', 'UBI', 'Biotecnologia', NULL, NULL, 'Colegio \"san Gabriel\"', 'Quito', NULL, NULL, NULL, '021.EC.21.021', 'Licenciatura Biotecnologia  - Algarve', NULL, NULL, NULL, 'Ativo', 1, 'sebastian-alberto-hidalgo-kon', '2021-01-28 16:11:00', '2021-03-03 10:59:08', NULL),
(22, 1, NULL, 'Kevin Leonardo', 'Bermudez Llulluna', 'M', 'kevinbermudez303@gmail.com', '0931270342', NULL, '2001-03-15', 'Equador', 'Av. de la Marina Base Naval Sur, Bloque  Dep.', 'Guayaquil', NULL, 'Washington Miguel Bermudez Moreira', '0983826778', 'wbermudez79@gmail.com', 'Lilian Yaneth llulluna Patron', NULL, NULL, NULL, NULL, NULL, 'Secundário Completo', NULL, 'UBI', 'UALG', 'Engenharia Aeronautica', 'Electromecânica', NULL, NULL, NULL, NULL, NULL, NULL, '022.EC.21.022', 'Estudante para Pré Universitário ---------------------------------\r\nLicenciatura Eng.ª Aeronáutica - UBI', NULL, NULL, NULL, 'Ativo', 1, 'kevin-leonardo-bermudez-llulluna', '2021-01-28 16:20:42', '2021-03-03 14:42:34', NULL),
(23, 1, NULL, 'Isabella Victoria', 'Coronel Coronel', 'F', 'isabella.coronel@gmail.com', '0995083004', NULL, '2002-11-14', 'Equador', 'urdesa norte, av. 5ta #114 - Guayas', 'Guayaquil', NULL, 'Juan Eduardo Coronel Madriñan', '0994402108', 'juane30@hotmail.com', 'Fabiola Coronel Pareja', '0994491697', 'fabiola.coronel@hotmail.com', '23.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', 'UBI', 'Sociologia', NULL, NULL, 'U E Bil. \"liceo Los Andes\"', 'Guayaquil', NULL, NULL, NULL, '023.EC.21.023', 'Licenciatura Sociologia - Algarve', NULL, NULL, NULL, 'Ativo', 1, 'isabella-victoria-coronel-coronel', '2021-01-28 16:28:53', '2021-03-03 14:44:56', NULL),
(24, 1, NULL, 'Paulo Cesar', 'Toledo Romero', 'M', 'paulotoledoromero@gmail.com', '+5930992974801', NULL, '2003-01-20', 'Equador', 'Mucho Lote 1 - Etapa 5 Mz.2638 villa 23', 'Guayaquil', NULL, 'Paulo Cesar Toledo Castro', '0980199628', 'paultole@outlook.com', 'Sofia Jacqueline Romero Vinces', '0993987154', 'sofia.romerov76@gmail.com', '24.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UBI', 'UALG', 'Biotecnologia', NULL, NULL, 'Anai', 'Guayaquil', NULL, NULL, NULL, '024.EC.21.024', 'Estudante para Pré Universitário -----------------------------------------\r\nLicenciatura Biotecnologia - UBI', NULL, NULL, NULL, 'Ativo', 1, 'paulo-cesar-toledo-romero', '2021-01-28 16:52:26', '2021-03-03 14:46:40', NULL),
(25, 1, NULL, 'Nikolas Josue', 'Maldonado Herrera', 'M', 'nikovan34@gmail.com', '+5932873046', '0995791966', '2003-07-19', 'Equador', 'Madroños Y Orquideas 390 (Club los Chillos)', 'Quito', NULL, 'Patricio Maldonado', '0994020326', 'patricio.maldonado@hotmail.com', 'Susana Herrera', '0983245652', 'sumaldonado@yahoo.com', '25.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', NULL, 'Ciências Biomédicas', NULL, NULL, 'U E Apch (angel Polivio Chaves)', 'Quito', NULL, NULL, NULL, '025.EC.21.025', 'Licenciatura Ciências Biomédicas - Algarve', NULL, NULL, NULL, 'Ativo', 1, 'nikolas-josue-maldonado-herrera', '2021-01-29 15:18:54', '2021-03-03 14:48:05', NULL),
(26, 1, NULL, 'Nahir Dominic', 'Salgado Pérez', 'F', 'nahirsp.1218@gmail.com', '593 989505862', NULL, '2004-05-09', 'Equador', 'Urb. Capelo, Manuela Saenz 447 y Aurora Ramirez- San Rafaela', 'Quito', 'Quito', 'Bayardo Fabian Salgado Proaño', '593 999008217', 'bayardo_salgado@hotmail.com', 'Ana Lucia Perez Suasnavas', '593 999039382', 'anilupss@gmail.com', '26.png', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', 'UBI', 'Psicologia', NULL, NULL, 'U E Particular Los Llinizas', 'Quito', NULL, NULL, NULL, '026.EC.21.026', 'Estudante Licenciatura Psicologia - UALG (1ª opção)', NULL, NULL, NULL, 'Ativo', 1, 'nahir-dominic-salgado-perez', '2021-02-03 16:41:08', '2021-03-03 14:49:23', NULL),
(27, 1, NULL, 'Julio Jose', 'Veliz Zambrano', 'M', NULL, '+593991241936', NULL, '2002-04-23', 'Equador', NULL, NULL, NULL, 'Jose fabian Veliz Parraga', '+593985099417', 'jfveliz@hotmail.com', 'Elim Marianela Zambrano Martillo', '+593997501237', 'elim232719@hotmail.com', '27.png', NULL, NULL, 'Secundário Incompleto', NULL, 'UBI', NULL, 'Arquitetura', NULL, NULL, 'U E Arco Iris', 'Portoviejo', NULL, NULL, '1313181339', '027.EC.21.027', NULL, NULL, NULL, NULL, 'Ativo', 1, 'julio-jose-veliz-zambrano', '2021-02-25 11:12:36', '2021-03-03 14:51:16', NULL),
(28, 1, NULL, 'Valeria Alejandra', 'Brainard Muñoz', 'F', 'vale_brainard@hotmail.com', '+593989452860', NULL, '2003-05-09', 'Equador', 'Mutualista Benalcazar, calle ceibos casa 337', 'Santo Domingo de los Colorados', NULL, NULL, NULL, NULL, 'Diana Muñoz Carrillo', '+593994271905', 'dianaemunoz13@hotmail.com', '28.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', 'UBI', 'Comercio Exterior', 'Engenharia Energias renovaveis', 'Engenharia Agricola', NULL, NULL, '172117984-2', '2027-01-20', NULL, '028.EC.21.028', 'Pre Universitário    -------------------------------------------\r\nLicenciatura UALG -', NULL, NULL, NULL, 'Ativo', 1, 'valeria-alejandra-brainard-munoz', '2021-03-03 14:59:41', '2021-03-03 15:01:28', NULL),
(29, 1, NULL, 'Esteban Nicolás', 'Montenegro Orozco', 'M', 'nico.montenegro.orozco@gmail.com', '+593980316478', NULL, '2003-11-06', 'Equador', 'Montecristi Golf Club & Villas, Casa #9 (Kilometro 2 1/2 via MAnta - Montecristi', 'Manta', NULL, 'Saúl Montenegro López', '+593959417719', 'spmontenegro@hotmail.com', 'Andrea Orozco Ugalde', '+593998769767', 'andreaorozcougalde@hotmail.com', '29.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UBI', NULL, 'Marketing', NULL, NULL, 'U E Leonardo Da Vinci', 'Manta', NULL, NULL, '0604511964', '029.EC.21.029', 'Licenciatura UBI - Marketing', NULL, NULL, NULL, 'Ativo', 1, 'esteban-nicolas-montenegro-orozco', '2021-03-03 15:26:45', '2021-03-03 15:26:45', NULL),
(30, 1, NULL, 'Daniela', 'Charchabal Duran', 'F', 'danicharchabal@gmail.com', '+593983394517', NULL, '2003-04-15', 'Equador', 'Av. Universitaria entre 10 de agosto y José Eguiguren, 21-30', 'Loja', NULL, 'Danilo Perez Charchabal', '+593983851493', 'charchabaldanilo@hotmail.com', 'Ada Niurys Duran Perez', '+593979352649', 'adortana.2013@gmail.com', '30.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UBI', NULL, 'Optometria', NULL, NULL, 'U E Particular \"cordillera\"', 'Loja', '015164250-1', '2026-12-09', 'I751546', '030.EC.21.030', 'Licenciatura - UBI - Optometria', NULL, NULL, NULL, 'Ativo', 1, 'daniela-charchabal-duran', '2021-03-03 15:42:47', '2021-03-03 15:42:47', NULL),
(31, 1, NULL, 'Gabriel Emilio', 'Flores Gaona', 'M', 'gabrielflores6115@gmail.com', '0925653370', NULL, '2003-07-19', 'Equador', 'Urb. Rio Guayas Club Mz E. V3', 'Guayaquil', NULL, 'Jaime Arturo Flores Bermeo', '+593999489309', 'jaimeflores_67@hotmail.com', 'Zoraida Cecilia Gaona Peralta', '+593994106700', 'zorygp71@hotmail.com', '31.JPG', NULL, NULL, 'Secundário Completo', NULL, 'UALG', 'UBI', 'Engenharia dos Alimentos', 'Biotecnologia', NULL, 'U E Bil. \"liceo Los Andes\"', 'Guayaquil', NULL, NULL, '0925653370', '031.EC.21.031', NULL, NULL, NULL, NULL, 'Ativo', 1, 'gabriel-emilio-flores-gaona', '2021-03-03 18:14:44', '2021-03-03 18:14:44', NULL),
(32, 1, NULL, 'Emilia Alejandra', 'Salgueiro Proaño', 'F', 'emi.salgueiro2003@gmail.com', '+5932268885', '+593988415601', '2003-02-22', 'Equador', 'Pasaje E 17 a Casa 2 y Ricardo Saenz', 'Quito', NULL, 'Santiago Salguero', '+593980290884', 'santiagosalguero@hotmail.com', 'Mahira Proaño', '+593998566463', 'mahirahipatia@hotmail.com', '32.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UALG', 'U. Aveiro', 'Biotecnologia', NULL, NULL, 'Colegio Johannes Kepler', 'Quito', NULL, NULL, 'A3798383', '032.EC.21.032', 'Licenciatura UALG ou Aveiro - Biotecnologia', NULL, NULL, NULL, 'Ativo', 1, 'emilia-alejandra-salgueiro-proano', '2021-03-03 18:26:46', '2021-03-03 18:26:46', NULL),
(33, 1, NULL, 'Luis Francisco', 'Alvear Morales', 'M', 'luisfranciscoalvearmorales@gmail.com', '+593969098709', NULL, '2003-11-23', 'Equador', 'Av. Isabel La Católica y Av. Gaspar de Villarroel', 'Cuenca', NULL, NULL, NULL, NULL, 'Janneth Morales Astudillo', '+593998331486', 'janilf52@gmail.com', '33.JPG', NULL, NULL, 'Secundário Incompleto', NULL, 'UBI', 'Evora', 'Arquitetura', NULL, NULL, 'U E Borja', 'Cuenca', '010674675-3', '2029-08-14', NULL, '033.EC.21.033', NULL, NULL, NULL, NULL, 'Ativo', 1, 'luis-francisco-alvear-morales', '2021-03-03 18:42:31', '2021-03-03 18:42:31', NULL),
(34, 1, NULL, 'Maria Dolores', 'Guzman Landin', 'F', NULL, NULL, NULL, NULL, 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 'UALG', NULL, 'Ciências da Comunicação', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '034.EC.21.034', NULL, NULL, NULL, NULL, 'Ativo', 1, 'maria-dolores-guzman-landin', '2021-03-23 17:30:15', '2021-03-29 07:59:24', NULL),
(35, 1, NULL, 'Pablo Andrés', 'Toscano Calderón', 'M', 'pablotoscano07@gmail.com', '+593 987188803', NULL, '2003-10-07', 'Equador', 'Juan Bernardo de Leon 14-11 y Loja', 'Riobamba', NULL, 'Juan Carlos Toscano', '+593 999783819', 'gruaschimborazo@hotmail.com', 'Rocio Calderón', '+593 995017817', 'fannyrcb@hotmail.com', '35.JPG', NULL, NULL, 'Secundário Incompleto', 1, 'UALG', 'UBI', 'Engenharia Mecânica', NULL, NULL, NULL, NULL, NULL, NULL, '0604520866', '035.EC.21.035', 'Pre - Universitario', NULL, NULL, NULL, 'Ativo', 1, 'pablo-andres-toscano-calderon', '2021-03-23 17:39:24', '2021-03-23 17:40:04', NULL),
(36, 4, NULL, 'Joaquin Esteban', 'Juarez Moreno', 'M', 'joaquinejmo@gmail.com', '+593 979307689', NULL, '2002-05-28', 'Equador', 'Diario Hoy 3-10 y El Constitucional, Urb La Prensa', 'cuenca', NULL, 'Esteban Fabian Juarez Segarra', '+ 593 983387100', 'econjuarez@hotmail.com', 'Lupe Jacqueline Gonzalez Coronel', '+593 999601491', 'jjms7@yahoo.com', '36.JPG', NULL, NULL, 'Secundário Incompleto', 1, 'UALG', 'UBI', 'Imagem Animada', 'Design Multimedia', NULL, 'U. E. La Alborada', 'Cuenca', NULL, NULL, '0150586394', '036.EC.21.036', NULL, NULL, NULL, NULL, 'Ativo', 1, 'joaquin-esteban-juarez-moreno', '2021-03-23 17:52:34', '2021-03-23 17:56:06', NULL),
(37, 1, NULL, 'Ariana Berenice', 'Durango Bayas', 'F', 'durango.ariana@gmail.com', '0988525496', NULL, '2002-05-04', 'Equador', 'Chimborzo y 9 de Octubre', 'Jipijapa', NULL, 'Manuel Ramon Cornejo Macias', '0939340268', 'macias336@hotmail.com', 'Berenica Adriana Bayas Perdomo', '0980033968', 'bbayas@hotmail.com', '37.JPG', NULL, NULL, 'Secundário Completo', 0, 'Evora', NULL, 'Enfermagem', NULL, NULL, 'U E. Fiscal Quince De Octubre', 'Jipijapa', NULL, NULL, '0925682601', '037.EC.21.037', NULL, NULL, NULL, NULL, 'Ativo', 1, 'ariana-berenice-durango-bayas', '2021-03-24 16:55:20', '2021-03-24 16:55:20', NULL),
(38, 4, NULL, 'Cesar Humberto', 'Verdugo Barahona', 'M', NULL, NULL, NULL, NULL, 'Equador', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '038.EC.21.038', NULL, NULL, NULL, NULL, 'Proponente', 1, 'cesar-humberto-verdugo-barahona', '2021-03-24 17:16:07', '2021-03-24 17:16:07', NULL),
(39, 1, NULL, 'Arella Salome', 'Garcia Macias', 'F', 'arellagarcia@hotmail.com', '+593 992916292', NULL, '2002-03-10', 'Equador', 'Av. 12, Calle 18 cas n.º 613', 'Manta', NULL, 'Enrique Garcia', '0991780305', 'egarciabcs@gmail.com', 'Jessica Macias', '0991780449', 'jessicainvenstments@gmail.com', '39.JPG', NULL, NULL, 'Secundário Completo', 0, 'Evora', NULL, 'Psicologia', NULL, NULL, 'U E Stella Maris', 'Manta', NULL, NULL, '1316948916', '039.EC.21.039', NULL, NULL, NULL, NULL, 'Ativo', 1, 'arella-salome-garcia-macias', '2021-03-24 17:21:31', '2021-03-24 17:23:17', NULL),
(40, 5, NULL, 'Mariana', 'Moreyra Campuzano', 'F', 'marianamoreyracamp@gmail.com', '5511076011', '5561178622', '2002-04-08', 'México', 'Pitágoras 828, Col. Vertiz Narvame 03020', 'Ciudad de México', NULL, 'Antonio Moreyra Castillo', '554510715', 'amoreyra@gmail.com', 'Rosa Maria Campuzano Iñigo', '5585372657', 'rmcampuzano@gmail.com', '40.JPG', NULL, NULL, 'Secundário Incompleto', 1, 'UALG', 'UBI', 'Artes Visuais', 'Cinema', 'Imagem Animada', 'Escuela Mexicana Americana', 'Ciudad De México', NULL, NULL, 'G22164847', '040.MX.21.001', NULL, NULL, NULL, NULL, 'Ativo', 1, 'mariana-moreyra-campuzano', '2021-03-26 16:35:11', '2021-03-26 16:35:11', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente_observacoes`
--

CREATE TABLE `cliente_observacoes` (
  `idObservacao` bigint(20) UNSIGNED NOT NULL,
  `idCliente` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` longtext NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente_observacoes`
--

INSERT INTO `cliente_observacoes` (`idObservacao`, `idCliente`, `titulo`, `texto`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pagamentos', 'A 02/11/2020 é efetuado o 1.º pag. à EP, no valor de 250,00€', 'pagamentos', '2021-03-18 16:35:27', '2021-03-18 16:35:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE `conta` (
  `idConta` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `instituicao` varchar(255) NOT NULL,
  `titular` varchar(255) NOT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `numConta` bigint(20) NOT NULL,
  `IBAN` varchar(255) NOT NULL,
  `SWIFT` varchar(255) NOT NULL,
  `contacto` varchar(191) NOT NULL,
  `obsConta` longtext DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`idConta`, `descricao`, `instituicao`, `titular`, `morada`, `numConta`, `IBAN`, `SWIFT`, `contacto`, `obsConta`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Conta Cliente', 'Credito Crédito de Leiria', 'EPPE - Estudar Portugal, Lda', NULL, 121219, 'PT50 5180 0001 00000121219 52', 'CDCTPTP2XXX', '244 848 000', NULL, 'conta-cliente', '2020-12-03 16:05:56', '2020-12-03 16:05:56', NULL),
(2, 'Conta Exploração', 'EuroBic', 'EPPE - Estudar Portugal, Lda', 'Leiria', 79, 'PT50 0079 0000 7976 5647 1017 2', 'BPNPPTPL', '244 848 280', NULL, 'conta-exploracao', '2020-12-03 16:08:23', '2020-12-03 16:08:23', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED DEFAULT NULL,
  `idUniversidade` bigint(20) UNSIGNED DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `telefone1` varchar(255) DEFAULT NULL,
  `telefone2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `observacao` longtext DEFAULT NULL,
  `favorito` tinyint(1) NOT NULL DEFAULT 0,
  `visibilidade` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contacto`
--

INSERT INTO `contacto` (`idContacto`, `idUser`, `idUniversidade`, `nome`, `fotografia`, `telefone1`, `telefone2`, `email`, `fax`, `observacao`, `favorito`, `visibilidade`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Jorge Madeira', NULL, '275 320 690 | Ext: 1096', NULL, 'jhsm@ubi.pt', NULL, NULL, 1, 0, 'jorge-madeira', '2020-12-02 11:31:13', '2020-12-02 11:31:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_academico`
--

CREATE TABLE `doc_academico` (
  `idDocAcademico` bigint(20) UNSIGNED NOT NULL,
  `idCliente` varchar(255) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `info` longtext DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verificacao` tinyint(1) NOT NULL DEFAULT 0,
  `idFase` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `doc_academico`
--

INSERT INTO `doc_academico` (`idDocAcademico`, `idCliente`, `nome`, `tipo`, `imagem`, `info`, `slug`, `created_at`, `updated_at`, `verificacao`, `idFase`) VALUES
(1, '1', 'Titulo', 'Titulo Termino Secundário', 'cliente_1_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario', '2020-12-02 11:52:13', '2020-12-02 11:52:13', 1, NULL),
(2, '2', 'Titulo', 'Titulo Termino Secundário', 'cliente_2_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-1', '2020-12-02 14:43:13', '2020-12-02 14:43:13', 1, NULL),
(3, '2', 'notas', 'notas 3.º Bachiller', 'cliente_2_documento_academico_notas3_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-3o-bachiller', '2020-12-02 14:48:24', '2020-12-02 14:48:24', 1, NULL),
(4, '2', 'Ser Bachiller', 'Ser Bachiller', 'cliente_2_documento_academico_SerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller', '2021-01-13 14:33:49', '2021-01-13 14:33:49', 1, NULL),
(5, '1', 'Acta', 'Acta de Grado', 'cliente_1_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado', '2021-01-13 14:38:53', '2021-01-13 14:38:53', 1, NULL),
(6, '1', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_1_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller', '2021-01-18 16:07:25', '2021-01-18 16:07:25', 1, NULL),
(7, '3', 'Acta', 'Acta de Grado', 'cliente_3_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado-1', '2021-01-18 16:10:17', '2021-01-18 16:10:17', 1, NULL),
(8, '3', 'Titulo', 'Titulo Termino Secundário', 'cliente_3_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-2', '2021-01-18 16:10:58', '2021-01-18 16:10:58', 1, NULL),
(9, '12', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_12_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-1', '2021-01-19 14:02:30', '2021-01-19 14:02:30', 1, NULL),
(10, '12', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_12_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-2', '2021-01-19 14:02:47', '2021-01-19 14:02:47', 1, NULL),
(11, '12', 'Acta', 'Acta de Grado', 'cliente_12_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado-2', '2021-01-19 14:06:25', '2021-01-19 14:06:25', 1, NULL),
(12, '12', 'Titulo', 'Titulo Termino Secundário', 'cliente_12_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-3', '2021-01-19 14:08:01', '2021-01-19 14:08:01', 1, NULL),
(13, '6', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_6_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-3', '2021-01-19 14:59:13', '2021-01-19 14:59:13', 1, NULL),
(14, '6', 'Acta', 'Acta de Grado', 'cliente_6_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado-3', '2021-01-19 14:59:36', '2021-01-19 14:59:36', 1, NULL),
(15, '6', 'Titulo', 'Titulo Termino Secundário', 'cliente_6_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-4', '2021-01-19 14:59:57', '2021-01-19 14:59:57', 1, NULL),
(16, '11', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_11_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-4', '2021-01-22 15:34:07', '2021-01-22 15:34:07', 1, NULL),
(17, '11', 'Acta', 'Acta de Grado', 'cliente_11_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado-4', '2021-01-22 15:34:38', '2021-01-22 15:34:38', 1, NULL),
(18, '11', 'Titulo', 'Titulo Termino Secundário', 'cliente_11_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-5', '2021-01-22 15:35:01', '2021-01-22 15:35:01', 1, NULL),
(19, '13', 'Acta', 'Acta de Grado', 'cliente_13_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado-5', '2021-01-22 15:50:39', '2021-01-22 15:50:39', 1, NULL),
(20, '13', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_13_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-5', '2021-01-22 15:51:02', '2021-01-22 15:51:02', 1, NULL),
(21, '13', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_13_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-6', '2021-01-22 15:51:15', '2021-01-22 15:51:15', 1, NULL),
(22, '13', 'Titulo', 'Titulo Termino Secundário', 'cliente_13_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-6', '2021-01-22 15:51:36', '2021-01-22 15:51:36', 1, NULL),
(23, '13', 'Certificado', 'Certificado Idioma', 'cliente_13_documento_academico_CertificadoIdioma.pdf', '{\"Certificado Idioma\":\"0\"}', 'certificado-idioma', '2021-01-22 15:52:27', '2021-01-22 15:52:27', 1, NULL),
(24, '15', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_15_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-7', '2021-01-25 15:38:41', '2021-01-25 15:38:41', 1, NULL),
(25, '15', 'Titulo', 'Titulo Termino Secundário', 'cliente_15_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-7', '2021-01-25 15:39:12', '2021-01-25 15:39:12', 1, NULL),
(26, '18', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_18_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-8', '2021-01-27 17:12:13', '2021-01-27 17:12:13', 1, NULL),
(27, '18', 'Titulo', 'Titulo Termino Secundário', 'cliente_18_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-8', '2021-01-27 17:12:42', '2021-01-27 17:12:42', 1, NULL),
(28, '19', 'Acta', 'Acta de Grado', 'cliente_19_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado-6', '2021-01-27 17:22:20', '2021-01-27 17:22:20', 1, NULL),
(29, '19', 'Titulo', 'Titulo Termino Secundário', 'cliente_19_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-9', '2021-01-27 17:22:40', '2021-01-27 17:22:40', 1, NULL),
(30, '22', 'Acta', 'Acta de Grado', 'cliente_22_documento_academico_ActadeGrado.pdf', '{\"de Grado\":\"0\"}', 'acta-de-grado-7', '2021-01-28 16:24:37', '2021-01-28 16:24:37', 1, NULL),
(31, '22', 'Titulo', 'Titulo Termino Secundário', 'cliente_22_documento_academico_TituloTerminoSecundário.pdf', '{\"Secund\\u00e1rio\":\"0\"}', 'titulo-termino-secundario-10', '2021-01-28 16:24:59', '2021-01-28 16:24:59', 1, NULL),
(32, '22', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_22_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-9', '2021-01-28 16:25:17', '2021-01-28 16:25:17', 1, NULL),
(33, '22', 'Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_22_documento_academico_SerBachillerSerBachiller.pdf', '{\"Bachiller\":\"0\"}', 'ser-bachiller-ser-bachiller-10', '2021-01-28 16:25:32', '2021-01-28 16:25:32', 1, NULL),
(34, '26', 'comprovativo matricula', 'Comprovativo de matricula', 'cliente_26_documento_academico_Comprovativodematricula.pdf', '{\"comprovativo matricula\":\"0\"}', 'comprovativo-de-matricula', '2021-02-03 16:54:52', '2021-02-03 16:54:52', 1, NULL),
(35, '3', 'notas', 'notas 3.º Bachiller', 'cliente_3_documento_academico_notas3_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-3o-bachiller-1', '2021-02-24 15:51:36', '2021-02-24 15:51:36', 1, NULL),
(36, '4', 'Notas 1.º Bachiller Notas', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'cliente_4_documento_academico_Notas1_ºBachillerNotas1_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-1o-bachiller-notas-1o-bachiller', '2021-02-24 16:25:57', '2021-02-24 16:25:57', 1, NULL),
(37, '4', 'Notas 2.º Bachillerato', 'Notas 2.º Bachiller', 'cliente_4_documento_academico_Notas2_ºBachiller.pdf', '{\"Notas 2.\\u00ba Bachillerato\":\"0\"}', 'notas-2o-bachiller', '2021-02-24 16:28:25', '2021-02-24 16:28:25', 1, NULL),
(38, '28', 'Certificado matricula', 'Certificado matricula 3.º Bachillerato', 'cliente_28_documento_academico_Certificadomatricula3_ºBachillerato.pdf', '{\"Bachillerato\":\"0\"}', 'certificado-matricula-3o-bachillerato', '2021-03-03 15:05:35', '2021-03-03 15:05:35', 1, NULL),
(39, '28', 'Notas 1.º Bachiller Notas', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'cliente_28_documento_academico_Notas1_ºBachillerNotas1_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-1o-bachiller-notas-1o-bachiller-1', '2021-03-03 15:06:32', '2021-03-03 15:06:32', 1, NULL),
(40, '28', 'Notas', 'Notas 2.º Bachiller', 'cliente_28_documento_academico_Notas2_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-2o-bachiller-1', '2021-03-03 15:07:02', '2021-03-03 15:07:02', 1, NULL),
(41, '28', 'Cartão', 'Cartão Universitário_Ano Zero', 'cliente_28_documento_academico_CartãoUniversitário_AnoZero.pdf', '{\"Zero\":\"0\"}', 'cartao-universitario-ano-zero', '2021-03-03 15:10:29', '2021-03-03 15:10:29', 1, NULL),
(42, '28', 'Unidades Curriculares', 'Unidades Curriculares Ano Zero', 'cliente_28_documento_academico_UnidadesCurricularesAnoZero.pdf', '{\"Unidades Curriculares\":\"0\"}', 'unidades-curriculares-ano-zero', '2021-03-03 15:11:44', '2021-03-03 15:11:44', 1, NULL),
(43, '28', 'Inscrição Ano Zero', 'Insc. Ano Zero', 'cliente_28_documento_academico_Insc_AnoZero.pdf', '{\"Inscri\\u00e7\\u00e3o Ano Zero\":\"0\"}', 'insc-ano-zero', '2021-03-03 15:12:52', '2021-03-03 15:12:52', 1, NULL),
(44, '29', 'Certificado matricula', 'Certificado matricula 3.º Bachillerato', 'cliente_29_documento_academico_Certificadomatricula3_ºBachillerato.pdf', '{\"Bachillerato\":\"0\"}', 'certificado-matricula-3o-bachillerato-1', '2021-03-03 15:29:11', '2021-03-03 15:29:11', 1, NULL),
(45, '29', 'notas', 'notas 3.º Bachiller', 'cliente_29_documento_academico_notas3_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-3o-bachiller-2', '2021-03-03 15:31:05', '2021-03-03 15:31:05', 1, NULL),
(46, '29', 'Notas 2.º Bachillerato', 'Notas 2.º Bachiller', 'cliente_29_documento_academico_Notas2_ºBachiller.pdf', '{\"Notas 2.\\u00ba Bachillerato\":\"0\"}', 'notas-2o-bachiller-2', '2021-03-03 15:32:09', '2021-03-03 15:32:09', 1, NULL),
(47, '30', 'Notas 1.º Bachiller Notas', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'cliente_30_documento_academico_Notas1_ºBachillerNotas1_ºBachiller.jpg', '{\"Bachiller\":\"0\"}', 'notas-1o-bachiller-notas-1o-bachiller-2', '2021-03-03 15:44:27', '2021-03-03 15:44:27', 1, NULL),
(48, '30', 'Notas 2.º Bachillerato Notas', 'Notas 2.º Bachiller', 'cliente_30_documento_academico_Notas2_ºBachiller.jpg', '{\"Bachillerato\":\"0\"}', 'notas-2o-bachiller-3', '2021-03-03 15:44:47', '2021-03-03 15:44:47', 1, NULL),
(49, '30', 'notas', 'notas 3.º Bachiller', 'cliente_30_documento_academico_notas3_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-3o-bachiller-3', '2021-03-03 15:45:12', '2021-03-03 15:45:12', 1, NULL),
(50, '30', 'Certificado matricula', 'Certificado matricula 3.º Bachillerato', 'cliente_30_documento_academico_Certificadomatricula3_ºBachillerato.jpg', '{\"Bachillerato\":\"0\"}', 'certificado-matricula-3o-bachillerato-2', '2021-03-03 15:45:58', '2021-03-03 15:45:58', 1, NULL),
(51, '30', 'Diploma', 'Diploma Merito', 'cliente_30_documento_academico_DiplomaMerito.jpg', '{\"Merito\":\"0\"}', 'diploma-merito', '2021-03-03 15:46:51', '2021-03-03 15:46:51', 1, NULL),
(52, '31', 'Notas 1.º Bachiller Notas', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'cliente_31_documento_academico_Notas1_ºBachillerNotas1_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-1o-bachiller-notas-1o-bachiller-3', '2021-03-03 18:17:09', '2021-03-03 18:17:09', 1, NULL),
(53, '31', 'Notas 2.º Bachillerato Notas', 'Notas 2.º Bachiller', 'cliente_31_documento_academico_Notas2_ºBachiller.pdf', '{\"Bachillerato\":\"0\"}', 'notas-2o-bachiller-4', '2021-03-03 18:17:30', '2021-03-03 18:17:30', 1, NULL),
(54, '31', 'notas', 'notas 3.º Bachiller', 'cliente_31_documento_academico_notas3_ºBachiller.PDF', '{\"Bachiller\":\"0\"}', 'notas-3o-bachiller-4', '2021-03-03 18:17:52', '2021-03-03 18:17:52', 1, NULL),
(55, '32', 'Notas 1.º Bachiller Notas', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'cliente_32_documento_academico_Notas1_ºBachillerNotas1_ºBachiller.pdf', '{\"Bachiller\":\"0\"}', 'notas-1o-bachiller-notas-1o-bachiller-4', '2021-03-03 18:31:37', '2021-03-03 18:31:37', 1, NULL),
(56, '32', 'Notas 2.º Bachillerato Notas', 'Notas 2.º Bachiller', 'cliente_32_documento_academico_Notas2_ºBachiller.pdf', '{\"Bachillerato\":\"0\"}', 'notas-2o-bachiller-5', '2021-03-03 18:32:02', '2021-03-03 18:32:02', 1, NULL),
(57, '33', 'Certificado', 'Certificado matricula', 'cliente_33_documento_academico_Certificadomatricula.pdf', '{\"matricula\":\"0\"}', 'certificado-matricula', '2021-03-03 18:45:29', '2021-03-03 18:45:29', 1, NULL),
(58, '33', 'Notas 1.º Bachiller Notas', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'cliente_33_documento_academico_Notas1_ºBachillerNotas1_ºBachiller.jpeg', '{\"Bachiller\":\"0\"}', 'notas-1o-bachiller-notas-1o-bachiller-5', '2021-03-03 18:45:54', '2021-03-03 18:45:54', 1, NULL),
(59, '33', 'Notas 2.º Bachillerato Notas', 'Notas 2.º Bachiller', 'cliente_33_documento_academico_Notas2_ºBachiller.jpeg', '{\"Bachillerato\":\"0\"}', 'notas-2o-bachiller-6', '2021-03-03 18:46:15', '2021-03-03 18:46:15', 1, NULL),
(60, '35', 'Comprovativo Matricula', 'Comprovativo Matricula', 'cliente_35_documento_academico_ComprovativoMatricula.pdf', '{\"Comprovativo Matricula\":null}', 'comprovativo-matricula', '2021-03-23 17:43:45', '2021-03-23 17:43:45', 1, NULL),
(61, '35', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'Notas 1.º Bachiller Notas 1.º Bachiller', 'cliente_35_documento_academico_Notas1_ºBachillerNotas1_ºBachiller.pdf', '{\"Notas 1.\\u00ba Bachiller Notas 1.\\u00ba Bachiller\":null}', 'notas-1o-bachiller-notas-1o-bachiller-6', '2021-03-23 17:44:13', '2021-03-23 17:44:13', 1, NULL),
(62, '37', 'Acta de Grado', 'Acta de Grado', 'cliente_37_documento_academico_ActadeGrado.pdf', '{\"Acta de Grado\":null}', 'acta-de-grado-8', '2021-03-24 17:12:47', '2021-03-24 17:12:47', 1, NULL),
(63, '37', 'Ser Bachiller Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_37_documento_academico_SerBachillerSerBachiller.pdf', '{\"Ser Bachiller Ser Bachiller\":null}', 'ser-bachiller-ser-bachiller-11', '2021-03-24 17:13:31', '2021-03-24 17:13:31', 1, NULL),
(64, '37', 'Ser Bachiller 2', 'Ser Bachiller 2', 'cliente_37_documento_academico_SerBachiller2.pdf', '{\"Ser Bachiller 2\":null}', 'ser-bachiller-2', '2021-03-24 17:14:17', '2021-03-24 17:14:17', 1, NULL),
(65, '39', 'Acta de Grado', 'Acta de Grado', 'cliente_39_documento_academico_ActadeGrado.jpeg', '{\"Acta de Grado\":null}', 'acta-de-grado-9', '2021-03-24 17:24:57', '2021-03-24 17:24:57', 1, NULL),
(66, '39', 'Ser Bachiller Ser Bachiller', 'Ser Bachiller Ser Bachiller', 'cliente_39_documento_academico_SerBachillerSerBachiller.pdf', '{\"Ser Bachiller Ser Bachiller\":null}', 'ser-bachiller-ser-bachiller-12', '2021-03-24 17:25:22', '2021-03-24 17:25:22', 1, NULL),
(67, '39', 'Ser Bachiller 2', 'Ser Bachiller 2', 'cliente_39_documento_academico_SerBachiller2.pdf', '{\"Ser Bachiller 2\":null}', 'ser-bachiller-2-1', '2021-03-24 17:25:39', '2021-03-24 17:25:39', 1, NULL),
(68, '39', 'Titulo Bachiller', 'Titulo Bachiller', 'cliente_39_documento_academico_TituloBachiller.jpeg', '{\"Titulo Bachiller\":null}', 'titulo-bachiller', '2021-03-24 17:26:02', '2021-03-24 17:26:02', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_necessario`
--

CREATE TABLE `doc_necessario` (
  `idDocNecessario` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('Pessoal','Academico') NOT NULL,
  `tipoDocumento` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idFase` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `doc_necessario`
--

INSERT INTO `doc_necessario` (`idDocNecessario`, `tipo`, `tipoDocumento`, `created_at`, `updated_at`, `idFase`, `deleted_at`) VALUES
(1, 'Pessoal', 'Passaporte', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 1, NULL),
(2, 'Academico', 'Record Académico', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 1, NULL),
(3, 'Academico', 'Titulo Bachiller', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 1, NULL),
(4, 'Pessoal', 'Comprobante Pago', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 1, NULL),
(5, 'Pessoal', 'Ficha de Inscription', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 1, NULL),
(6, 'Academico', 'Servicios Gestion Matricula', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 2, NULL),
(7, 'Academico', '1er pago Preuniversitario + 2do pago Servicios EP', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 2, NULL),
(8, 'Academico', '2do pago Preuniversitario', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 3, NULL),
(9, 'Pessoal', 'Certificado Seguro', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 4, NULL),
(10, 'Pessoal', 'Pago Seguro', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 4, NULL),
(11, 'Academico', 'Ultimo pago PreUniversitario + Ultimo Pago EP', '2020-12-03 15:51:51', '2020-12-03 15:51:51', 5, NULL),
(12, 'Pessoal', 'Passaporte', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 6, NULL),
(13, 'Academico', 'Record Académico', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 6, NULL),
(14, 'Academico', 'Titulo Bachiller', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 6, NULL),
(15, 'Pessoal', 'Comprobante Pago', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 6, NULL),
(16, 'Pessoal', 'Ficha de Inscription', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 6, NULL),
(17, 'Academico', 'Servicios Gestion Matricula', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 7, NULL),
(18, 'Academico', '1er pago Preuniversitario + 2do pago Servicios EP', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 7, NULL),
(19, 'Academico', '2do pago Preuniversitario', '2020-12-09 17:45:12', '2020-12-09 17:45:12', 8, NULL),
(20, 'Pessoal', 'Certificado Seguro', '2020-12-09 17:45:13', '2020-12-09 17:45:13', 9, NULL),
(21, 'Pessoal', 'Pago Seguro', '2020-12-09 17:45:13', '2020-12-09 17:45:13', 9, NULL),
(22, 'Academico', 'Ultimo pago PreUniversitario + Ultimo Pago EP', '2020-12-09 17:45:13', '2020-12-09 17:45:13', 10, NULL),
(23, 'Pessoal', 'Passaporte', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 11, NULL),
(24, 'Academico', 'Record Académico', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 11, NULL),
(25, 'Academico', 'Titulo Bachiller', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 11, NULL),
(26, 'Pessoal', 'Comprobante Pago', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 11, NULL),
(27, 'Pessoal', 'Ficha de Inscription', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 11, NULL),
(28, 'Academico', 'Servicios Gestion Matricula', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 12, NULL),
(29, 'Academico', '1er pago Preuniversitario + 2do pago Servicios EP', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 12, NULL),
(30, 'Academico', '2do pago Preuniversitario', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 13, NULL),
(31, 'Pessoal', 'Certificado Seguro', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 14, NULL),
(32, 'Pessoal', 'Pago Seguro', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 14, NULL),
(33, 'Academico', 'Ultimo pago PreUniversitario + Ultimo Pago EP', '2020-12-09 17:58:21', '2020-12-09 17:58:21', 15, NULL),
(34, 'Pessoal', 'Passaporte', '2020-12-09 18:29:41', '2020-12-09 18:29:41', 16, NULL),
(35, 'Academico', 'Record Académico', '2020-12-09 18:29:41', '2020-12-09 18:29:41', 16, NULL),
(36, 'Academico', 'Titulo Bachiller', '2020-12-09 18:29:41', '2020-12-09 18:29:41', 16, NULL),
(37, 'Pessoal', 'Comprobante Pago', '2020-12-09 18:29:41', '2020-12-09 18:29:41', 16, NULL),
(38, 'Pessoal', 'Ficha de Inscription', '2020-12-09 18:29:41', '2020-12-09 18:29:41', 16, NULL),
(39, 'Academico', 'Servicios Gestion Matricula', '2020-12-09 18:29:41', '2020-12-09 18:29:41', 17, NULL),
(40, 'Academico', '1er pago Preuniversitario + 2do pago Servicios EP', '2020-12-09 18:29:41', '2020-12-09 18:29:41', 17, NULL),
(41, 'Academico', '2do pago Preuniversitario', '2020-12-09 18:29:42', '2020-12-09 18:29:42', 18, NULL),
(42, 'Pessoal', 'Certificado Seguro', '2020-12-09 18:29:42', '2020-12-09 18:29:42', 19, NULL),
(43, 'Pessoal', 'Pago Seguro', '2020-12-09 18:29:42', '2020-12-09 18:29:42', 19, NULL),
(44, 'Academico', 'Ultimo pago PreUniversitario + Ultimo Pago EP', '2020-12-09 18:29:42', '2020-12-09 18:29:42', 20, NULL),
(45, 'Pessoal', 'Passaporte', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 79, NULL),
(46, 'Academico', 'Record Académico', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 79, NULL),
(47, 'Academico', 'Titulo Bachiller', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 79, NULL),
(48, 'Pessoal', 'Comprobante Pago', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 79, NULL),
(49, 'Pessoal', 'Ficha de Inscription', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 79, NULL),
(50, 'Academico', 'Servicios Gestion Matricula', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 80, NULL),
(51, 'Academico', '1er pago Preuniversitario + 2do pago Servicios EP', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 80, NULL),
(52, 'Academico', '2do pago Preuniversitario', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 81, NULL),
(53, 'Pessoal', 'Certificado Seguro', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 82, NULL),
(54, 'Pessoal', 'Pago Seguro', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 82, NULL),
(55, 'Academico', 'Ultimo pago PreUniversitario + Ultimo Pago EP', '2021-02-23 17:33:35', '2021-02-23 17:33:35', 83, NULL),
(56, 'Pessoal', 'Passaporte', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 97, NULL),
(57, 'Academico', 'Record Académico', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 97, NULL),
(58, 'Academico', 'Titulo Bachiller', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 97, NULL),
(59, 'Pessoal', 'Comprobante Pago', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 97, NULL),
(60, 'Pessoal', 'Ficha de Inscription', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 97, NULL),
(61, 'Academico', 'Servicios Gestion Matricula', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 98, NULL),
(62, 'Academico', '1er pago Preuniversitario + 2do pago Servicios EP', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 98, NULL),
(63, 'Academico', '2do pago Preuniversitario', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 99, NULL),
(64, 'Pessoal', 'Certificado Seguro', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 100, NULL),
(65, 'Pessoal', 'Pago Seguro', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 100, NULL),
(66, 'Academico', 'Ultimo pago PreUniversitario + Ultimo Pago EP', '2021-02-24 15:40:23', '2021-02-24 15:40:23', 101, NULL),
(67, 'Pessoal', 'Passaporte', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 106, NULL),
(68, 'Academico', 'Record Académico', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 106, NULL),
(69, 'Academico', 'Titulo Bachiller', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 106, NULL),
(70, 'Pessoal', 'Comprobante Pago', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 106, NULL),
(71, 'Pessoal', 'Ficha de Inscription', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 106, NULL),
(72, 'Academico', 'Servicios Gestion Matricula', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 107, NULL),
(73, 'Academico', '1er pago Preuniversitario + 2do pago Servicios EP', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 107, NULL),
(74, 'Academico', '2do pago Preuniversitario', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 108, NULL),
(75, 'Pessoal', 'Certificado Seguro', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 109, NULL),
(76, 'Pessoal', 'Pago Seguro', '2021-02-24 16:17:25', '2021-02-24 16:17:25', 109, NULL),
(77, 'Academico', 'Ultimo pago PreUniversitario + Ultimo Pago EP', '2021-02-24 16:17:26', '2021-02-24 16:17:26', 110, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_pessoal`
--

CREATE TABLE `doc_pessoal` (
  `idDocPessoal` bigint(20) UNSIGNED NOT NULL,
  `idCliente` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `info` longtext DEFAULT NULL,
  `dataValidade` date DEFAULT NULL,
  `verificacao` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idFase` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `doc_pessoal`
--

INSERT INTO `doc_pessoal` (`idDocPessoal`, `idCliente`, `tipo`, `imagem`, `info`, `dataValidade`, `verificacao`, `slug`, `created_at`, `updated_at`, `idFase`) VALUES
(1, '1', 'Passaporte', 'cliente_1_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"1004426373\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte', '2020-12-02 11:46:28', '2021-01-13 18:15:24', NULL),
(2, '2', 'Passaporte', 'cliente_2_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"0104892625\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-1', '2020-12-02 14:39:09', '2021-01-13 18:13:45', NULL),
(3, '2', 'Titulo Termino Secundário', 'cliente_2_documento_pessoal_TituloTerminoSecundário.pdf', '{\"Titulo Termino Secund\\u00e1rio\":\"0\"}', '2100-01-01', 1, 'titulo-termino-secundario', '2020-12-02 14:42:06', '2020-12-02 14:42:06', NULL),
(4, '2', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial', '2020-12-02 14:57:46', '2020-12-02 14:57:46', NULL),
(5, '1', 'Doc. Oficial', NULL, '{\"numDoc\":\"1004426373\"}', NULL, 1, 'doc-oficial-1', '2020-12-02 15:00:33', '2021-03-02 16:30:55', NULL),
(6, '3', 'Passaporte', 'cliente_3_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"0105193502\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-2', '2020-12-09 17:51:03', '2021-01-13 18:15:15', NULL),
(8, '4', 'Passaporte', 'cliente_4_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"0750218414\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-3', '2020-12-09 18:17:35', '2021-01-13 18:14:59', NULL),
(9, '8', 'Passaporte', 'cliente_8_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"1722265160\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-4', '2021-01-13 14:53:00', '2021-01-13 22:49:17', NULL),
(10, '9', 'Passaporte', 'cliente_9_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"0931054993\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-5', '2021-01-13 15:02:52', '2021-01-13 18:15:55', NULL),
(11, '10', 'Passaporte', 'cliente_10_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"0930244660\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-6', '2021-01-13 15:14:53', '2021-01-13 22:50:17', NULL),
(12, '11', 'Passaporte', 'cliente_11_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"0706365046\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-7', '2021-01-13 15:19:18', '2021-01-13 22:50:47', NULL),
(13, '12', 'Passaporte', 'cliente_12_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"1206883785\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-8', '2021-01-13 15:28:07', '2021-01-13 22:49:38', NULL),
(14, '7', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-3', '2021-01-13 17:20:54', '2021-01-13 17:20:54', NULL),
(15, '7', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-9', '2021-01-13 17:20:54', '2021-01-13 17:20:54', NULL),
(17, '6', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-5', '2021-01-13 18:15:32', '2021-01-13 18:15:32', NULL),
(18, '6', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 0, 'passaporte-10', '2021-01-13 18:15:32', '2021-03-02 16:42:44', NULL),
(19, '5', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-6', '2021-01-13 18:15:40', '2021-01-13 18:15:40', NULL),
(20, '5', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-11', '2021-01-13 18:15:40', '2021-01-13 18:15:40', NULL),
(21, '9', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-7', '2021-01-13 18:15:55', '2021-01-13 18:15:55', NULL),
(22, '8', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-8', '2021-01-13 22:49:17', '2021-01-13 22:49:17', NULL),
(23, '12', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-9', '2021-01-13 22:49:38', '2021-01-13 22:49:38', NULL),
(24, '10', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-10', '2021-01-13 22:50:17', '2021-01-13 22:50:17', NULL),
(25, '11', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-11', '2021-01-13 22:50:47', '2021-01-13 22:50:47', NULL),
(26, '1', 'email de adjudicação pre', 'cliente_1_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre', '2021-01-18 16:03:46', '2021-01-18 16:03:46', NULL),
(27, '3', 'email de adjudicação pre', 'cliente_3_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-1', '2021-01-18 16:14:01', '2021-01-18 16:14:01', NULL),
(29, '5', 'Passaporte', 'cliente_5_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 1, 'passaporte-13', '2021-01-18 16:43:55', '2021-02-05 11:14:55', NULL),
(30, '12', 'email de adjudicação pre', 'cliente_12_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-2', '2021-01-19 14:03:53', '2021-01-19 14:03:53', NULL),
(31, '12', 'Ficha de Inscrição', 'cliente_12_documento_pessoal_FichadeInscrição.pdf', '{\"Ficha de Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'ficha-de-inscricao', '2021-01-19 14:04:33', '2021-01-19 14:04:33', NULL),
(32, '12', 'Pagamento 1.ª Quota', 'cliente_12_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamentos\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota', '2021-01-19 14:05:28', '2021-01-19 14:05:28', NULL),
(33, '6', 'Cedula', 'cliente_6_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2028-09-10', 1, 'cedula', '2021-01-19 14:57:42', '2021-01-19 14:57:42', NULL),
(34, '6', 'email de adjudicação pre', 'cliente_6_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-3', '2021-01-19 14:58:14', '2021-01-19 14:58:14', NULL),
(35, '6', 'Pagamento 1.ª Quota', 'cliente_6_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-1', '2021-01-19 14:58:51', '2021-01-19 14:58:51', NULL),
(36, '3', 'Pagamento 1.ª Quota', 'cliente_3_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-2', '2021-01-20 18:01:55', '2021-01-20 18:01:55', NULL),
(37, '7', 'Passaporte', 'cliente_7_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 1, 'passaporte-14', '2021-01-20 18:24:22', '2021-02-03 17:05:20', NULL),
(38, '8', 'email de adjudicação Licenciatura', 'cliente_8_documento_pessoal_emaildeadjudicaçãoLicenciatura.pdf', '{\"email de adjudica\\u00e7\\u00e3o Licenciatura\":\"o\"}', '2100-01-01', 1, 'email-de-adjudicacao-licenciatura', '2021-01-20 18:29:36', '2021-01-20 18:29:36', NULL),
(39, '8', 'Pagamento 1.ª Quota', 'cliente_8_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-3', '2021-01-20 18:30:07', '2021-01-20 18:30:07', NULL),
(40, '9', 'email de adjudicação pre', 'cliente_9_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-4', '2021-01-20 19:01:59', '2021-01-20 19:01:59', NULL),
(41, '9', 'Ficha de Inscription', 'cliente_9_documento_pessoal_FichadeInscription.pdf', '{\"Ficha de Inscription\":\"0\"}', '2100-01-01', 1, 'ficha-de-inscription', '2021-01-20 19:03:00', '2021-01-20 19:03:00', NULL),
(42, '9', 'Plano de pagamentos ANAI', 'cliente_9_documento_pessoal_PlanodepagamentosANAI.pdf', '{\"Plano de pagamentos ANAI\":\"0\"}', '2100-01-01', 1, 'plano-de-pagamentos-anai', '2021-01-20 19:04:02', '2021-01-20 19:04:02', NULL),
(43, '10', 'email de adjudicação pre', 'cliente_10_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-5', '2021-01-22 11:26:47', '2021-01-22 11:26:47', NULL),
(44, '10', 'Ficha de Inscrição', 'cliente_10_documento_pessoal_FichadeInscrição.pdf', '{\"Ficha de Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'ficha-de-inscricao-1', '2021-01-22 11:27:30', '2021-01-22 11:27:30', NULL),
(45, '10', 'Plano de pagamentos ANAI', 'cliente_10_documento_pessoal_PlanodepagamentosANAI.pdf', '{\"Plano de pagamentos ANAI\":\"0\"}', '2100-01-01', 1, 'plano-de-pagamentos-anai-1', '2021-01-22 11:27:58', '2021-01-22 11:27:58', NULL),
(46, '11', 'email de adjudicação pre', 'cliente_11_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2021-01-01', 1, 'email-de-adjudicacao-pre-6', '2021-01-22 15:30:18', '2021-01-22 15:30:18', NULL),
(47, '11', 'Pagamento 1.ª Quota', 'cliente_11_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2021-01-01', 1, 'pagamento-1a-quota-4', '2021-01-22 15:31:07', '2021-01-22 15:31:07', NULL),
(48, '13', 'email de adjudicação pre', 'cliente_13_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-7', '2021-01-22 15:48:38', '2021-01-22 15:48:38', NULL),
(49, '13', 'Pagamento 1.ª Quota', 'cliente_13_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-5', '2021-01-22 15:49:10', '2021-01-22 15:49:10', NULL),
(50, '13', 'Cedula', 'cliente_13_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2030-07-06', 1, 'cedula-1', '2021-01-22 15:50:19', '2021-01-22 15:50:19', NULL),
(51, '14', 'email de adjudicação pre', 'cliente_14_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o Licenciatura\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-8', '2021-01-22 15:57:50', '2021-01-22 15:57:50', NULL),
(52, '14', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-12', '2021-01-22 15:59:00', '2021-01-22 15:59:00', NULL),
(53, '14', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-15', '2021-01-22 15:59:00', '2021-01-22 15:59:00', NULL),
(54, '14', 'Pagamento 1.ª Quota', 'cliente_14_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-6', '2021-01-22 15:59:39', '2021-01-22 15:59:39', NULL),
(55, '14', 'notas 1.º Bachiller', 'cliente_14_documento_pessoal_notas1_ºBachiller.pdf', '{\"notas 1.\\u00ba Bachiller\":\"0\"}', '2100-01-01', 1, 'notas-1o-bachiller', '2021-01-22 16:00:17', '2021-01-22 16:00:17', NULL),
(56, '14', 'notas 2.º Bachiller', 'cliente_14_documento_pessoal_notas2_ºBachiller.pdf', '{\"notas 2.\\u00ba Bachiller\":\"0\"}', '2100-01-01', 1, 'notas-2o-bachiller', '2021-01-22 16:00:53', '2021-01-22 16:00:53', NULL),
(57, '14', 'Certificado matricula 3.º Bachillerato', 'cliente_14_documento_pessoal_Certificadomatricula3_ºBachillerato.pdf', '{\"Certificado matricula 3.\\u00ba Bachillerato\":\"0\"}', '2100-01-01', 1, 'certificado-matricula-3o-bachillerato', '2021-01-22 16:02:24', '2021-01-22 16:02:24', NULL),
(58, '15', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-13', '2021-01-22 16:18:10', '2021-01-22 16:18:10', NULL),
(59, '15', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-16', '2021-01-22 16:18:11', '2021-01-22 16:18:11', NULL),
(60, '15', 'Carta Boas-vindas', 'cliente_15_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas', '2021-01-25 14:49:30', '2021-01-25 14:49:30', NULL),
(61, '15', '1.º Comprobante de pago_ enviado pais', 'cliente_15_documento_pessoal_1_ºComprobantedepago_enviadopais.pdf', '{\"1.\\u00ba Comprobante de pago_ enviado pais\":\"0\"}', '2100-01-01', 1, '1o-comprobante-de-pago-enviado-pais', '2021-01-25 14:52:30', '2021-01-25 14:52:30', NULL),
(62, '15', 'Passaporte', 'cliente_15_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 1, 'passaporte-17', '2021-01-25 15:41:19', '2021-02-02 12:13:32', NULL),
(63, '16', 'Carta Boas-vindas', 'cliente_16_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-1', '2021-01-25 16:37:36', '2021-01-25 16:37:36', NULL),
(64, '16', 'Carta Boas-vindas', 'cliente_16_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-2', '2021-01-25 16:37:43', '2021-01-25 16:37:43', NULL),
(65, '17', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-14', '2021-01-26 14:57:55', '2021-01-26 14:57:55', NULL),
(66, '17', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-18', '2021-01-26 14:57:55', '2021-01-26 14:57:55', NULL),
(67, '17', 'Passaporte', 'cliente_17_documento_pessoal_Passaporte.pdf', '{\"Passaporte\":\"0\"}', NULL, 1, 'passaporte-19', '2021-01-27 16:38:55', '2021-01-27 16:38:55', NULL),
(68, '18', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-15', '2021-01-27 17:05:07', '2021-01-27 17:05:07', NULL),
(69, '18', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-20', '2021-01-27 17:05:07', '2021-01-27 17:05:07', NULL),
(70, '18', 'Carta Boas-vindas', 'cliente_18_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-3', '2021-01-27 17:07:25', '2021-01-27 17:07:25', NULL),
(71, '18', 'Comprobante Pago', 'cliente_18_documento_pessoal_ComprobantePago.pdf', '{\"Comprobante Pago\":\"0\"}', '2100-01-01', 1, 'comprobante-pago', '2021-01-27 17:09:15', '2021-01-27 17:09:15', NULL),
(72, '18', 'Carta Convite EP', 'cliente_18_documento_pessoal_CartaConviteEP.pdf', '{\"Carta Convite EP\":\"0\"}', '2100-01-01', 1, 'carta-convite-ep', '2021-01-27 17:10:14', '2021-01-27 17:10:14', NULL),
(73, '18', 'Cedula', 'cliente_18_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2100-01-01', 1, 'cedula-2', '2021-01-27 17:10:57', '2021-01-27 17:10:57', NULL),
(74, '18', 'Cedula', 'cliente_18_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2100-01-01', 1, 'cedula-3', '2021-01-27 17:11:18', '2021-01-27 17:11:18', NULL),
(75, '18', 'Ficha de Inscription', 'cliente_18_documento_pessoal_FichadeInscription.pdf', '{\"Ficha de Inscription\":\"0\"}', '2100-01-01', 1, 'ficha-de-inscription-1', '2021-01-27 17:11:52', '2021-01-27 17:11:52', NULL),
(76, '19', 'Carta Boas-vindas', 'cliente_19_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-4', '2021-01-27 17:17:50', '2021-01-27 17:17:50', NULL),
(77, '19', 'Comprobante Pago', 'cliente_19_documento_pessoal_ComprobantePago.pdf', '{\"Comprobante Pago\":\"0\"}', '2100-01-01', 1, 'comprobante-pago-1', '2021-01-27 17:18:21', '2021-01-27 17:18:21', NULL),
(78, '19', 'Ficha de Inscrição', 'cliente_19_documento_pessoal_FichadeInscrição.pdf', '{\"Ficha de Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'ficha-de-inscricao-2', '2021-01-27 17:19:12', '2021-01-27 17:19:12', NULL),
(79, '19', 'Plano pagos PRE', 'cliente_19_documento_pessoal_PlanopagosPRE.pdf', '{\"Plano pagos PRE\":\"0\"}', '2100-01-01', 1, 'plano-pagos-pre', '2021-01-27 17:20:13', '2021-01-27 17:20:13', NULL),
(80, '19', 'Carta Convite EP', 'cliente_19_documento_pessoal_CartaConviteEP.pdf', '{\"Carta Convite EP\":\"0\"}', '2100-01-01', 1, 'carta-convite-ep-1', '2021-01-27 17:20:57', '2021-01-27 17:20:57', NULL),
(81, '19', 'Pagamento 1.ª Quota', 'cliente_19_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-7', '2021-01-27 17:21:26', '2021-01-27 17:21:26', NULL),
(82, '20', 'Carta Boas-vindas', 'cliente_20_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-5', '2021-01-28 15:55:15', '2021-01-28 15:55:15', NULL),
(83, '20', 'Comprobante Pago', 'cliente_20_documento_pessoal_ComprobantePago.pdf', '{\"Comprobante Pago\":\"0\"}', '2100-01-01', 1, 'comprobante-pago-2', '2021-01-28 15:55:45', '2021-01-28 15:55:45', NULL),
(84, '20', 'email de adjudicação Licenciatura', 'cliente_20_documento_pessoal_emaildeadjudicaçãoLicenciatura.pdf', '{\"email de adjudica\\u00e7\\u00e3o Licenciatura\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-licenciatura-1', '2021-01-28 15:56:21', '2021-01-28 15:56:21', NULL),
(85, '20', 'Formulário Inscrição', 'cliente_20_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao', '2021-01-28 15:57:10', '2021-01-28 15:57:10', NULL),
(86, '20', 'Pagamento 1.ª Quota', 'cliente_20_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-8', '2021-01-28 15:57:50', '2021-01-28 15:57:50', NULL),
(87, '20', 'Cedula', 'cliente_20_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2100-01-01', 1, 'cedula-4', '2021-01-28 15:58:16', '2021-01-28 15:58:16', NULL),
(88, '20', 'Cedula', 'cliente_20_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2100-01-01', 1, 'cedula-5', '2021-01-28 15:58:54', '2021-01-28 15:58:54', NULL),
(89, '20', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-16', '2021-01-28 16:06:31', '2021-01-28 16:06:31', NULL),
(90, '20', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":null}', NULL, 0, 'passaporte-21', '2021-01-28 16:06:31', '2021-01-28 16:06:31', NULL),
(91, '21', 'email de adjudicação Licenciatura', 'cliente_21_documento_pessoal_emaildeadjudicaçãoLicenciatura.pdf', '{\"email de adjudica\\u00e7\\u00e3o Licenciatura\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-licenciatura-2', '2021-01-28 16:11:58', '2021-01-28 16:11:58', NULL),
(92, '21', 'Carta Boas-vindas', 'cliente_21_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-6', '2021-01-28 16:12:31', '2021-01-28 16:12:31', NULL),
(93, '21', 'Comprobante Pago', 'cliente_21_documento_pessoal_ComprobantePago.pdf', '{\"Comprobante Pago\":\"0\"}', '2100-01-01', 1, 'comprobante-pago-3', '2021-01-28 16:13:08', '2021-01-28 16:13:08', NULL),
(94, '21', 'Pagamento 1.ª Quota', 'cliente_21_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-9', '2021-01-28 16:13:30', '2021-01-28 16:13:30', NULL),
(95, '22', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-17', '2021-01-28 16:21:04', '2021-01-28 16:21:04', NULL),
(96, '22', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":null}', NULL, 0, 'passaporte-22', '2021-01-28 16:21:04', '2021-03-03 11:02:21', NULL),
(97, '22', 'Carta Convite EP', 'cliente_22_documento_pessoal_CartaConviteEP.pdf', '{\"Carta Convite EP\":\"0\"}', '2100-01-01', 1, 'carta-convite-ep-2', '2021-01-28 16:22:01', '2021-01-28 16:22:01', NULL),
(98, '22', 'Carta Boas-vindas', 'cliente_22_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-7', '2021-01-28 16:22:40', '2021-01-28 16:22:40', NULL),
(99, '22', 'Comprobante Pago', 'cliente_22_documento_pessoal_ComprobantePago.pdf', '{\"Comprobante Pago\":\"0\"}', '2100-01-01', 1, 'comprobante-pago-4', '2021-01-28 16:23:04', '2021-01-28 16:23:04', NULL),
(100, '22', 'Pagamento 1.ª Quota', 'cliente_22_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-10', '2021-01-28 16:23:42', '2021-01-28 16:23:42', NULL),
(101, '22', 'Cedula', 'cliente_22_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2100-01-01', 1, 'cedula-6', '2021-01-28 16:24:16', '2021-01-28 16:24:16', NULL),
(102, '22', 'Pagamento 2.ª fase', 'cliente_22_documento_pessoal_Pagamento2_ªfase.jpeg', '{\"Pagamento 2.\\u00aa fase\":\"0\"}', '2100-01-01', 1, 'pagamento-2a-fase', '2021-01-28 16:26:34', '2021-01-28 16:26:34', NULL),
(103, '23', 'Carta Boas-vindas', 'cliente_23_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-8', '2021-01-28 16:29:41', '2021-01-28 16:29:41', NULL),
(104, '23', 'Comprobante Pago', 'cliente_23_documento_pessoal_ComprobantePago.pdf', '{\"Comprobante Pago\":\"0\"}', '2100-01-01', 1, 'comprobante-pago-5', '2021-01-28 16:30:55', '2021-01-28 16:30:55', NULL),
(105, '23', 'Pagamento 1.ª Quota', 'cliente_23_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-11', '2021-01-28 16:31:27', '2021-01-28 16:31:27', NULL),
(106, '23', 'Conhecimento de custos', 'cliente_23_documento_pessoal_Conhecimentodecustos.pdf', '{\"Conhecimento de custos\":\"0\"}', '2100-01-01', 1, 'conhecimento-de-custos', '2021-01-28 16:37:07', '2021-01-28 16:37:07', NULL),
(107, '23', 'Conhecimento de custos UBI', 'cliente_23_documento_pessoal_ConhecimentodecustosUBI.pdf', '{\"Conhecimento de custos UBI\":\"0\"}', '2100-01-01', 1, 'conhecimento-de-custos-ubi', '2021-01-28 16:37:47', '2021-01-28 16:37:47', NULL),
(108, '23', 'email de adjudicação Licenciatura', 'cliente_23_documento_pessoal_emaildeadjudicaçãoLicenciatura.pdf', '{\"email de adjudica\\u00e7\\u00e3o Licenciatura\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-licenciatura-3', '2021-01-28 16:38:26', '2021-01-28 16:38:26', NULL),
(109, '23', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-18', '2021-01-28 16:45:41', '2021-01-28 16:45:41', NULL),
(110, '23', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":null}', NULL, 0, 'passaporte-23', '2021-01-28 16:45:41', '2021-01-28 16:45:41', NULL),
(111, '24', 'Carta Boas-vindas', 'cliente_24_documento_pessoal_CartaBoas-vindas.pdf', '{\"Carta Boas-vindas\":\"0\"}', '2100-01-01', 1, 'carta-boas-vindas-9', '2021-01-29 11:57:46', '2021-01-29 11:57:46', NULL),
(112, '24', 'Comprobante Pago', 'cliente_24_documento_pessoal_ComprobantePago.pdf', '{\"Comprobante Pago\":\"0\"}', '2100-01-01', 1, 'comprobante-pago-6', '2021-01-29 11:58:15', '2021-01-29 11:58:15', NULL),
(113, '24', 'Carta Convite EP', 'cliente_24_documento_pessoal_CartaConviteEP.pdf', '{\"Carta Convite EP\":\"0\"}', '2100-01-01', 1, 'carta-convite-ep-3', '2021-01-29 11:58:44', '2021-01-29 11:58:44', NULL),
(114, '24', 'Formulário Inscrição', 'cliente_24_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-1', '2021-01-29 11:59:11', '2021-01-29 11:59:11', NULL),
(115, '24', 'Conhecimento de custos', 'cliente_24_documento_pessoal_Conhecimentodecustos.pdf', '{\"Conhecimento de custos\":\"0\"}', '2100-01-01', 1, 'conhecimento-de-custos-1', '2021-01-29 11:59:39', '2021-01-29 11:59:39', NULL),
(116, '24', 'email de adjudicação pre', 'cliente_24_documento_pessoal_emaildeadjudicaçãopre.pdf', '{\"email de adjudica\\u00e7\\u00e3o pre\":\"0\"}', '2100-01-01', 1, 'email-de-adjudicacao-pre-9', '2021-01-29 12:00:08', '2021-01-29 12:00:08', NULL),
(117, '24', 'Pagamento 1.ª Quota', 'cliente_24_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-12', '2021-01-29 12:00:29', '2021-01-29 12:00:29', NULL),
(118, '24', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-19', '2021-01-29 12:09:58', '2021-01-29 12:09:58', NULL),
(119, '24', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":null}', NULL, 0, 'passaporte-24', '2021-01-29 12:09:58', '2021-01-29 12:09:58', NULL),
(120, '25', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-20', '2021-01-29 16:09:12', '2021-01-29 16:09:12', NULL),
(121, '25', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-25', '2021-01-29 16:09:12', '2021-01-29 16:09:12', NULL),
(122, '26', 'Cedula', 'cliente_26_documento_pessoal_Cedula.pdf', '{\"Cedula\":\"0\"}', '2100-01-01', 1, 'cedula-7', '2021-02-03 16:45:42', '2021-02-03 16:45:42', NULL),
(123, '26', 'Formulário de  inscrição', 'cliente_26_documento_pessoal_Formuláriodeinscrição.pdf', '{\"Formul\\u00e1rio\":\"0\"}', '2100-01-01', 1, 'formulario-de-inscricao', '2021-02-03 16:46:58', '2021-02-03 16:46:58', NULL),
(124, '26', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-21', '2021-02-03 17:03:24', '2021-02-03 17:03:24', NULL),
(125, '26', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-26', '2021-02-03 17:03:24', '2021-02-03 17:03:24', NULL),
(126, '3', 'Pagamento 2.ª fase', 'cliente_3_documento_pessoal_Pagamento2_ªfase.jpeg', '{\"Pagamento 2.\\u00aa fase\":\"0\"}', '2100-01-01', 1, 'pagamento-2a-fase-1', '2021-02-24 15:48:53', '2021-02-24 15:48:53', NULL),
(127, '3', 'Declaração recebimento 1.º pag.', 'cliente_3_documento_pessoal_Declaraçãorecebimento1_ºpag_.pdf', '{\"Declara\\u00e7\\u00e3o recebimento 1.\\u00ba pag.\":\"0\"}', '2100-01-01', 1, 'declaracao-recebimento-1o-pag', '2021-02-24 15:50:05', '2021-02-24 15:50:05', NULL),
(128, '3', 'Declaração recebimento 2.º pag.', 'cliente_3_documento_pessoal_Declaraçãorecebimento2_ºpag_.pdf', '{\"Declara\\u00e7\\u00e3o recebimento 2.\\u00ba pag.\":\"0\"}', '2100-01-01', 1, 'declaracao-recebimento-2o-pag', '2021-02-24 15:50:36', '2021-02-24 15:50:36', NULL),
(129, '4', 'Formulário Inscrição', 'cliente_4_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-2', '2021-02-24 16:09:28', '2021-02-24 16:09:28', NULL),
(130, '4', 'Pagamento 1.ª Quota', 'cliente_4_documento_pessoal_Pagamento1_ªQuota.pdf', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-13', '2021-02-24 16:10:07', '2021-02-24 16:10:07', NULL),
(131, '4', 'Pagamento 2.ª fase', 'cliente_4_documento_pessoal_Pagamento2_ªfase.jpeg', '{\"Pagamento 2.\\u00aa fase\":\"0\"}', '2100-01-01', 1, 'pagamento-2a-fase-2', '2021-02-24 16:10:34', '2021-02-24 16:10:34', NULL),
(132, '4', 'Declaração recebimento 1.º pag.', 'cliente_4_documento_pessoal_Declaraçãorecebimento1_ºpag_.pdf', '{\"Declara\\u00e7\\u00e3o recebimento 1.\\u00ba pag.\":\"0\"}', '2100-01-01', 1, 'declaracao-recebimento-1o-pag-1', '2021-02-24 16:11:13', '2021-02-24 16:11:13', NULL),
(133, '4', 'Declaração recebimento 2.º pag.', 'cliente_4_documento_pessoal_Declaraçãorecebimento2_ºpag_.pdf', '{\"Declara\\u00e7\\u00e3o recebimento 2.\\u00ba pag.\":\"0\"}', '2100-01-01', 1, 'declaracao-recebimento-2o-pag-1', '2021-02-24 16:11:43', '2021-02-24 16:11:43', NULL),
(134, '27', 'Doc. Oficial', 'cliente_27_documento_pessoal_Doc_Oficial.pdf', '{\"numDoc\":null}', NULL, 1, 'doc-oficial-2', '2021-02-25 11:12:36', '2021-02-25 11:12:36', NULL),
(135, '27', 'Passaporte', 'cliente_27_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"1313181339\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":null}', NULL, 1, 'passaporte-12', '2021-02-25 11:12:36', '2021-03-03 14:51:16', NULL),
(136, '3', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-4', '2021-03-02 16:35:18', '2021-03-02 16:35:18', NULL),
(137, '4', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-22', '2021-03-02 16:37:13', '2021-03-02 16:37:13', NULL),
(138, '13', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-23', '2021-03-02 17:10:14', '2021-03-02 17:10:14', NULL),
(139, '13', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-27', '2021-03-02 17:10:14', '2021-03-02 17:10:14', NULL),
(140, '16', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-24', '2021-03-02 18:25:16', '2021-03-02 18:25:16', NULL),
(141, '16', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":null}', NULL, 0, 'passaporte-28', '2021-03-02 18:25:16', '2021-03-02 18:25:16', NULL),
(142, '19', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-25', '2021-03-03 10:52:50', '2021-03-03 10:52:50', NULL),
(143, '19', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-29', '2021-03-03 10:52:51', '2021-03-03 10:52:51', NULL),
(144, '21', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-26', '2021-03-03 10:59:08', '2021-03-03 10:59:08', NULL),
(145, '21', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-30', '2021-03-03 10:59:08', '2021-03-03 10:59:08', NULL),
(146, '28', 'Doc. Oficial', 'cliente_28_documento_pessoal_Doc_Oficial.pdf', '{\"numDoc\":\"172117984-2\"}', '2027-01-20', 1, 'doc-oficial-27', '2021-03-03 15:01:28', '2021-03-03 15:01:28', NULL),
(147, '28', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', '2027-01-20', 0, 'passaporte-31', '2021-03-03 15:01:28', '2021-03-03 15:01:28', NULL),
(148, '28', 'Formulário Inscrição', 'cliente_28_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-3', '2021-03-03 15:03:04', '2021-03-03 15:03:04', NULL),
(149, '28', 'Pagamento 1.ª Quota', 'cliente_28_documento_pessoal_Pagamento1_ªQuota.jpeg', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-14', '2021-03-03 15:03:47', '2021-03-03 15:03:47', NULL),
(150, '28', 'Pagamento 2.ª fase', 'cliente_28_documento_pessoal_Pagamento2_ªfase.jpeg', '{\"Pagamento 2.\\u00aa fase\":\"0\"}', '2100-01-01', 1, 'pagamento-2a-fase-3', '2021-03-03 15:04:16', '2021-03-03 15:04:16', NULL),
(151, '28', 'Guia Pagemento Insc Ano Zero', 'cliente_28_documento_pessoal_GuiaPagementoInscAnoZero.pdf', '{\"Guia Pagemento Insc Ano Zero\":\"0\"}', '2100-01-01', 1, 'guia-pagemento-insc-ano-zero', '2021-03-03 15:14:09', '2021-03-03 15:14:09', NULL),
(152, '28', 'Pag. Inscrição Ano zero', 'cliente_28_documento_pessoal_Pag_InscriçãoAnozero.pdf', '{\"Pag. Inscri\\u00e7\\u00e3o Ano zero\":\"0\"}', '2100-01-01', 1, 'pag-inscricao-ano-zero', '2021-03-03 15:15:07', '2021-03-03 15:15:07', NULL),
(153, '28', 'Guia Pagamento Matricula Ano Zero', 'cliente_28_documento_pessoal_GuiaPagamentoMatriculaAnoZero.pdf', '{\"Guia Pagamento Matricula Ano Zero\":\"0\"}', '2100-01-01', 1, 'guia-pagamento-matricula-ano-zero', '2021-03-03 15:15:52', '2021-03-03 15:15:52', NULL),
(154, '28', 'Pagamento Matricula Ano Zero', 'cliente_28_documento_pessoal_PagamentoMatriculaAnoZero.pdf', '{\"Pagamento Matricula\":\"0\"}', '2100-01-01', 1, 'pagamento-matricula-ano-zero', '2021-03-03 15:17:13', '2021-03-03 15:17:13', NULL),
(155, '29', 'Passaporte', 'cliente_29_documento_pessoal_Passaporte.jpeg', '{\"numPassaporte\":\"0604511964\",\"dataValidPP\":\"2021-06-05\",\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', '2021-06-05', 1, 'passaporte-32', '2021-03-03 15:26:46', '2021-03-03 15:26:46', NULL),
(156, '29', 'Formulário Inscrição', 'cliente_29_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-4', '2021-03-03 15:27:29', '2021-03-03 15:27:29', NULL),
(157, '29', 'Pagamento 1.ª Quota', 'cliente_29_documento_pessoal_Pagamento1_ªQuota.jpeg', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-15', '2021-03-03 15:28:21', '2021-03-03 15:28:21', NULL),
(158, '30', 'Doc. Oficial', 'cliente_30_documento_pessoal_Doc_Oficial.jpg', '{\"numDoc\":\"015164250-1\"}', '2026-12-09', 1, 'doc-oficial-28', '2021-03-03 15:42:47', '2021-03-03 15:42:47', NULL),
(159, '30', 'Passaporte', 'cliente_30_documento_pessoal_Passaporte.JPG', '{\"numPassaporte\":\"I751546\",\"dataValidPP\":\"2021-09-05\",\"passaportPaisEmi\":\"Cuba\",\"localEmissaoPP\":\"Cuba\"}', '2021-09-05', 1, 'passaporte-33', '2021-03-03 15:42:47', '2021-03-03 15:42:47', NULL),
(160, '30', 'Formulário Inscrição', 'cliente_30_documento_pessoal_FormulárioInscrição.jpg', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-5', '2021-03-03 15:43:31', '2021-03-03 15:43:31', NULL),
(161, '30', 'Pagamento 1.ª Quota', 'cliente_30_documento_pessoal_Pagamento1_ªQuota.jpeg', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-16', '2021-03-03 15:43:58', '2021-03-03 15:43:58', NULL),
(162, '31', 'Passaporte', 'cliente_31_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"0925653370\",\"dataValidPP\":\"2022-09-22\",\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', '2022-09-22', 1, 'passaporte-34', '2021-03-03 18:14:44', '2021-03-03 18:14:44', NULL),
(163, '31', 'Formulário Inscrição', 'cliente_31_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-6', '2021-03-03 18:16:15', '2021-03-03 18:16:15', NULL),
(164, '31', 'Pagamento 1.ª Quota', 'cliente_31_documento_pessoal_Pagamento1_ªQuota.jpeg', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-17', '2021-03-03 18:16:49', '2021-03-03 18:16:49', NULL),
(165, '32', 'Passaporte', 'cliente_32_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"A3798383\",\"dataValidPP\":\"2026-09-29\",\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', '2026-09-29', 1, 'passaporte-35', '2021-03-03 18:26:46', '2021-03-03 18:26:46', NULL),
(166, '32', 'Formulário Inscrição', 'cliente_32_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-7', '2021-03-03 18:27:24', '2021-03-03 18:27:24', NULL),
(167, '32', 'Pagamento 1.ª Quota', 'cliente_32_documento_pessoal_Pagamento1_ªQuota.jpeg', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-18', '2021-03-03 18:27:54', '2021-03-03 18:27:54', NULL),
(168, '33', 'Doc. Oficial', 'cliente_33_documento_pessoal_Doc_Oficial.jpeg', '{\"numDoc\":\"010674675-3\"}', '2029-08-14', 1, 'doc-oficial-29', '2021-03-03 18:42:31', '2021-03-03 18:42:31', NULL),
(169, '33', 'Cedula2', 'cliente_33_documento_pessoal_Cedula2.jpeg', '{\"Cedula\":\"0\"}', '2029-08-14', 1, 'cedula2', '2021-03-03 18:43:43', '2021-03-03 18:43:43', NULL),
(170, '33', 'Formulário Inscrição', 'cliente_33_documento_pessoal_FormulárioInscrição.pdf', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-8', '2021-03-03 18:44:23', '2021-03-03 18:44:23', NULL),
(171, '33', 'Pagamento 1.ª Quota', 'cliente_33_documento_pessoal_Pagamento1_ªQuota.jpeg', '{\"Pagamento 1.\\u00aa Quota\":\"0\"}', '2100-01-01', 1, 'pagamento-1a-quota-19', '2021-03-03 18:44:47', '2021-03-03 18:44:47', NULL),
(172, '35', 'Passaporte', 'cliente_35_documento_pessoal_Passaporte.jpeg', '{\"numPassaporte\":\"0604520866\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-36', '2021-03-23 17:39:24', '2021-03-23 17:40:04', NULL),
(173, '35', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-30', '2021-03-23 17:40:04', '2021-03-23 17:40:04', NULL),
(174, '35', 'Formulário Inscrição', 'cliente_35_documento_pessoal_FormulárioInscrição.jpeg', '{\"Formul\\u00e1rio Inscri\\u00e7\\u00e3o\":\"0\"}', '2100-01-01', 1, 'formulario-inscricao-9', '2021-03-23 17:41:21', '2021-03-23 17:41:21', NULL),
(175, '35', 'Pagamento 1.ª Quota', 'cliente_35_documento_pessoal_Pagamento1_ªQuota.jpeg', NULL, '2100-01-01', 1, 'pagamento-1a-quota-20', '2021-03-23 17:42:00', '2021-03-23 17:42:00', NULL),
(176, '35', 'Pag. Gestão Matricula + Exame', 'cliente_35_documento_pessoal_Pag_GestãoMatricula+Exame.jpeg', NULL, '2100-01-01', 1, 'pag-gestao-matricula-exame', '2021-03-23 17:42:34', '2021-03-23 17:42:34', NULL),
(177, '36', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-31', '2021-03-23 17:56:06', '2021-03-23 17:56:06', NULL),
(178, '36', 'Passaporte', NULL, '{\"numPassaporte\":\"0150586394\",\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-37', '2021-03-23 17:56:06', '2021-03-23 17:56:06', NULL),
(179, '37', 'Passaporte', 'cliente_37_documento_pessoal_Passaporte.jpeg', '{\"numPassaporte\":\"0925682601\",\"dataValidPP\":\"2024-07-12\",\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', '2024-07-12', 1, 'passaporte-38', '2021-03-24 16:55:20', '2021-03-24 16:55:20', NULL),
(180, '37', 'Formulário Inscrição', 'cliente_37_documento_pessoal_FormulárioInscrição.pdf', NULL, '2100-01-01', 1, 'formulario-inscricao-10', '2021-03-24 16:56:20', '2021-03-24 16:56:20', NULL),
(181, '37', 'Pagamento 1.ª Quota', 'cliente_37_documento_pessoal_Pagamento1_ªQuota.pdf', NULL, '2100-01-01', 1, 'pagamento-1a-quota-21', '2021-03-24 16:56:55', '2021-03-24 16:56:55', NULL),
(182, '39', 'Passaporte', 'cliente_39_documento_pessoal_Passaporte.jpg', '{\"numPassaporte\":\"1316948916\",\"dataValidPP\":null,\"passaportPaisEmi\":\"Equador\",\"localEmissaoPP\":\"Equador\"}', NULL, 1, 'passaporte-39', '2021-03-24 17:21:31', '2021-03-24 17:23:17', NULL),
(183, '39', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-32', '2021-03-24 17:23:17', '2021-03-24 17:23:17', NULL),
(184, '39', 'Pagamento 1.ª Quota', 'cliente_39_documento_pessoal_Pagamento1_ªQuota.jpeg', NULL, '2100-01-01', 1, 'pagamento-1a-quota-22', '2021-03-24 17:23:48', '2021-03-24 17:23:48', NULL),
(185, '39', 'Formulário Inscrição', 'cliente_39_documento_pessoal_FormulárioInscrição.pdf', NULL, '2100-01-01', 1, 'formulario-inscricao-11', '2021-03-24 17:24:05', '2021-03-24 17:24:05', NULL),
(186, '40', 'Passaporte', 'cliente_40_documento_pessoal_Passaporte.pdf', '{\"numPassaporte\":\"G22164847\",\"dataValidPP\":\"2022-08-17\",\"passaportPaisEmi\":\"M\\u00e9xico\",\"localEmissaoPP\":\"M\\u00e9xico\"}', '2022-08-17', 1, 'passaporte-40', '2021-03-26 16:35:11', '2021-03-26 16:35:11', NULL),
(187, '34', 'Doc. Oficial', NULL, '{\"numDoc\":null}', NULL, 0, 'doc-oficial-33', '2021-03-29 07:59:24', '2021-03-29 07:59:24', NULL),
(188, '34', 'Passaporte', NULL, '{\"numPassaporte\":null,\"dataValidPP\":null,\"passaportPaisEmi\":null,\"localEmissaoPP\":null}', NULL, 0, 'passaporte-41', '2021-03-29 07:59:24', '2021-03-29 07:59:24', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_stock`
--

CREATE TABLE `doc_stock` (
  `idDocStock` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('Pessoal','Academico') NOT NULL,
  `tipoDocumento` varchar(255) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `idFaseStock` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_transacao`
--

CREATE TABLE `doc_transacao` (
  `idDocTransacao` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valorRecebido` decimal(18,2) NOT NULL DEFAULT 0.00,
  `tipoPagamento` enum('Multibanco','Paypal','Outro') NOT NULL,
  `dataOperacao` date NOT NULL,
  `dataRecebido` date DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `comprovativoPagamento` varchar(255) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `idConta` bigint(20) UNSIGNED NOT NULL,
  `idFase` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `doc_transacao`
--

INSERT INTO `doc_transacao` (`idDocTransacao`, `descricao`, `valorRecebido`, `tipoPagamento`, `dataOperacao`, `dataRecebido`, `observacoes`, `comprovativoPagamento`, `slug`, `idConta`, `idFase`, `created_at`, `updated_at`) VALUES
(1, 'Cobrança da 1.ª Etapa - Inscription y apertura del proceso', '250.00', 'Outro', '2020-11-02', '2020-12-03', NULL, 'cobranca-da-1-etapa-inscription-y-apertura-del-proceso-comprovativo-1.PNG', 'cobranca-da-1a-etapa-inscription-y-apertura-del-proceso', 1, 1, '2020-12-03 16:09:06', '2020-12-03 16:09:06'),
(2, 'Cobrança da 1.ª Etapa - Inscription y apertura del proceso', '250.00', 'Outro', '2020-10-30', '2020-11-02', NULL, 'cobranca-da-1-etapa-inscription-y-apertura-del-proceso-comprovativo-2.pdf', 'cobranca-da-1a-etapa-inscription-y-apertura-del-proceso-1', 1, 6, '2020-12-09 17:55:47', '2020-12-09 17:55:47'),
(3, 'Cobrança da 1.ª Etapa - Inscription y apertura del proceso', '250.00', 'Outro', '2020-11-03', '2020-11-04', NULL, 'cobranca-da-1-etapa-inscription-y-apertura-del-proceso-comprovativo-3.pdf', 'cobranca-da-1a-etapa-inscription-y-apertura-del-proceso-2', 1, 11, '2020-12-09 18:00:02', '2020-12-09 18:00:02'),
(4, 'Cobrança da 1.ª Etapa - Inscription y apertura del proceso', '250.00', 'Outro', '2020-11-05', '2020-11-06', NULL, 'cobranca-da-1-etapa-inscription-y-apertura-del-proceso-comprovativo-4.pdf', 'cobranca-da-1a-etapa-inscription-y-apertura-del-proceso-3', 1, 16, '2020-12-09 18:31:14', '2020-12-09 18:31:14'),
(5, 'Cobrança da 1 fase - Registro programa', '250.00', 'Multibanco', '2020-11-02', '2020-11-02', NULL, 'cobranca-da-1-fase-registro-programa-comprovativo-5.jpeg', 'cobranca-da-1-fase-registro-programa', 1, 21, '2021-01-19 17:21:21', '2021-01-19 17:21:21'),
(6, 'Cobrança da 1 fase - Registro programa', '250.00', 'Multibanco', '2020-11-02', '2020-11-02', NULL, 'cobranca-da-1-fase-registro-programa-comprovativo-6.pdf', 'cobranca-da-1-fase-registro-programa-1', 1, 33, '2021-01-19 17:45:37', '2021-01-19 17:45:37'),
(7, 'Cobrança da 1 fase - Registro programa', '250.00', 'Multibanco', '2020-11-03', '2020-11-04', NULL, 'cobranca-da-1-fase-registro-programa-comprovativo-7.pdf', 'cobranca-da-1-fase-registro-programa-2', 1, 40, '2021-01-20 18:04:15', '2021-01-20 18:04:15'),
(8, 'Cobrança da 1.ª fase - Registro Programa', '250.00', 'Multibanco', '2020-11-24', '2020-11-26', NULL, 'cobranca-da-1-fase-registro-programa-comprovativo-8.pdf', 'cobranca-da-1a-fase-registro-programa', 1, 57, '2021-01-20 18:57:01', '2021-01-20 18:57:01'),
(9, 'Cobrança da 1.ª fase - Registo Programa', '250.00', 'Outro', '2020-10-30', '2020-11-02', NULL, 'cobranca-da-1-fase-registo-programa-comprovativo-9.pdf', 'cobranca-da-1a-fase-registo-programa', 1, 76, '2021-02-23 17:47:06', '2021-02-23 17:47:06'),
(10, 'Cobrança da 2.ª fase - Confirmação de Vaga', '500.00', 'Outro', '2021-01-27', '2021-01-29', NULL, 'cobranca-da-2-fase-confirmacao-de-vaga-comprovativo-10.jpeg', 'cobranca-da-2a-fase-confirmacao-de-vaga', 1, 77, '2021-02-23 17:48:03', '2021-02-23 17:48:03'),
(11, 'Cobrança da 2.ª fase - Confirmação de Vaga', '500.00', 'Outro', '2021-01-27', '2021-01-29', NULL, 'cobranca-da-2-fase-confirmacao-de-vaga-comprovativo-11.jpeg', 'cobranca-da-2a-fase-confirmacao-de-vaga-1', 1, 77, '2021-02-23 17:48:22', '2021-02-23 17:48:22'),
(12, 'Cobrança da 1.ª Etapa -1.º Pagamento Programa Pré Universitário', '400.00', 'Outro', '2021-01-27', '2021-01-29', NULL, 'cobranca-da-1-etapa-1-pagamento-programa-pre-universitario-comprovativo-12.jpeg', 'cobranca-da-1a-etapa-1o-pagamento-programa-pre-universitario', 1, 79, '2021-02-23 17:49:15', '2021-02-23 17:49:15'),
(13, 'Cobrança da 2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '900.00', 'Outro', '2021-01-29', '2021-01-29', NULL, 'cobranca-da-2-fase-1-pag-pre-2-pag-ep-comprovativo-13.jpeg', 'cobranca-da-2a-fase-1o-pag-pre-2o-pag-ep', 1, 131, '2021-04-06 14:48:43', '2021-04-06 14:48:43'),
(14, 'Cobrança da 1.ª Fase - Registo Programa - 1.º Pag. EP', '250.00', 'Outro', '2020-11-01', '2020-11-02', NULL, 'cobranca-da-1-fase-registo-programa-1-pag-ep-comprovativo-14.pdf', 'cobranca-da-1a-fase-registo-programa-1o-pag-ep', 1, 130, '2021-04-06 14:49:23', '2021-04-06 14:49:23'),
(15, 'Cobrança da 3.ª Fase - Pag. Gestão Matricula', '650.00', 'Outro', '2021-02-24', '2021-02-24', NULL, 'cobranca-da-3-fase-pag-gestao-matricula-comprovativo-15.jpeg', 'cobranca-da-3a-fase-pag-gestao-matricula', 1, 132, '2021-04-06 14:50:21', '2021-04-06 14:50:21'),
(16, 'Cobrança da 1.ª Fase - Registo Programa - 1.º Pag. EP', '250.00', 'Outro', '2020-11-04', '2020-11-04', NULL, 'cobranca-da-1-fase-registo-programa-1-pag-ep-comprovativo-16.pdf', 'cobranca-da-1a-fase-registo-programa-1o-pag-ep-1', 1, 139, '2021-04-07 10:01:23', '2021-04-07 10:01:23'),
(17, 'Cobrança da 2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '900.00', 'Outro', '2020-02-03', '2020-02-03', NULL, 'cobranca-da-2-fase-1-pag-pre-2-pag-ep-comprovativo-17.jpeg', 'cobranca-da-2a-fase-1o-pag-pre-2o-pag-ep-1', 1, 140, '2021-04-07 10:02:00', '2021-04-07 10:02:00'),
(18, 'Cobrança da 1.ª Fase - Registo Programa - 1.º Pag. EP', '250.00', 'Outro', '2020-11-06', '2020-11-06', NULL, 'cobranca-da-1-fase-registo-programa-1-pag-ep-comprovativo-18.pdf', 'cobranca-da-1a-fase-registo-programa-1o-pag-ep-2', 1, 148, '2021-04-07 12:44:16', '2021-04-07 12:44:16'),
(19, 'Cobrança da 2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '900.00', 'Outro', '2021-02-22', '2021-02-22', NULL, 'cobranca-da-2-fase-1-pag-pre-2-pag-ep-comprovativo-19.jpeg', 'cobranca-da-2a-fase-1o-pag-pre-2o-pag-ep-2', 1, 149, '2021-04-07 12:44:54', '2021-04-07 12:44:54'),
(20, 'Cobrança da 3.ª Fase - Pag. Gestão Matricula + Exame', '710.00', 'Outro', '2021-03-16', '2021-03-16', '650,00€ - Gestão de Matricula\r\n60,00€ - Exame UALG', NULL, 'cobranca-da-3a-fase-pag-gestao-matricula-exame', 1, 150, '2021-04-07 12:46:25', '2021-04-07 12:46:25'),
(21, 'Cobrança da 1.ª Fase - Registo Programa - 1.º Pag. EP', '250.00', 'Outro', '2020-11-10', '2020-11-10', NULL, NULL, 'cobranca-da-1a-fase-registo-programa-1o-pag-ep-3', 1, 157, '2021-04-07 13:04:52', '2021-04-07 13:04:52'),
(22, 'Cobrança da 2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '900.00', 'Outro', '2021-02-04', '2021-02-04', NULL, NULL, 'cobranca-da-2a-fase-1o-pag-pre-2o-pag-ep-3', 1, 158, '2021-04-07 13:05:36', '2021-04-07 13:05:36'),
(23, 'Cobrança da 3.ª Fase - Pag. Gestão Matricula', '650.00', 'Outro', '2021-03-19', '2021-03-19', NULL, NULL, 'cobranca-da-3a-fase-pag-gestao-matricula-1', 1, 159, '2021-04-07 13:05:56', '2021-04-07 13:05:56'),
(24, 'Cobrança da 1.ª Fase - Registo Programa - 1.º Pag. EP', '250.00', 'Outro', '2020-12-11', '2020-12-11', NULL, 'cobranca-da-1-fase-registo-programa-1-pag-ep-comprovativo-24.pdf', 'cobranca-da-1a-fase-registo-programa-1o-pag-ep-4', 1, 166, '2021-04-07 13:24:37', '2021-04-07 13:24:37'),
(25, 'Cobrança da 2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '900.00', 'Outro', '2021-02-04', '2021-02-04', NULL, 'cobranca-da-2-fase-1-pag-pre-2-pag-ep-comprovativo-25.jpeg', 'cobranca-da-2a-fase-1o-pag-pre-2o-pag-ep-4', 1, 167, '2021-04-07 13:25:06', '2021-04-07 13:25:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fase`
--

CREATE TABLE `fase` (
  `idFase` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `dataVencimento` datetime NOT NULL,
  `valorFase` decimal(18,2) NOT NULL,
  `verificacaoPago` tinyint(1) NOT NULL DEFAULT 0,
  `estado` enum('Pendente','Pago','Dívida','Crédito') NOT NULL DEFAULT 'Pendente',
  `slug` varchar(191) DEFAULT NULL,
  `idProduto` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fase`
--

INSERT INTO `fase` (`idFase`, `descricao`, `dataVencimento`, `valorFase`, `verificacaoPago`, `estado`, `slug`, `idProduto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1.ª Etapa - Inscription y apertura del proceso', '2020-12-03 00:00:00', '250.00', 1, 'Pago', '1a-etapa-inscription-y-apertura-del-proceso', 1, '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(2, '2 etapa: Confirmación de Cupo', '2020-12-15 00:00:00', '1550.00', 0, 'Dívida', '2-etapa-confirmacion-de-cupo', 1, '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(3, '3.ª Etapa - Emision carta aceptacion y admission', '2020-12-31 00:00:00', '1250.00', 0, 'Dívida', '3a-etapa-emision-carta-aceptacion-y-admission', 1, '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(4, '4.ª Etapa - Seguro', '2020-12-20 00:00:00', '450.00', 0, 'Dívida', '4a-etapa-seguro', 1, '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(5, '5.ª Etapa - Conclusion de pagos (hasta 1 semana antes viajar)', '2021-02-20 00:00:00', '1225.00', 0, 'Pendente', '5a-etapa-conclusion-de-pagos-hasta-1-semana-antes-viajar', 1, '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(6, '1.ª Etapa - Inscription y apertura del proceso', '2020-11-02 00:00:00', '250.00', 1, 'Pago', '1a-etapa-inscription-y-apertura-del-proceso-1', 2, '2020-12-09 17:45:12', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(7, '2 etapa: Confirmación de Cupo', '2020-12-20 00:00:00', '1550.00', 0, 'Dívida', '2-etapa-confirmacion-de-cupo-1', 2, '2020-12-09 17:45:12', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(8, '3.ª Etapa - Emision carta aceptacion y admission', '2021-01-15 00:00:00', '1250.00', 0, 'Dívida', '3a-etapa-emision-carta-aceptacion-y-admission-1', 2, '2020-12-09 17:45:12', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(9, '4.ª Etapa - Seguro', '2021-01-01 00:00:00', '450.00', 0, 'Dívida', '4a-etapa-seguro-1', 2, '2020-12-09 17:45:13', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(10, '5.ª Etapa - Conclusion de pagos (hasta 1 semana antes viajar)', '2021-03-20 00:00:00', '1225.00', 0, 'Pendente', '5a-etapa-conclusion-de-pagos-hasta-1-semana-antes-viajar-1', 2, '2020-12-09 17:45:13', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(11, '1.ª Etapa - Inscription y apertura del proceso', '2020-12-09 00:00:00', '250.00', 1, 'Pago', '1a-etapa-inscription-y-apertura-del-proceso-2', 3, '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(12, '2 etapa: Confirmación de Cupo', '2021-01-10 00:00:00', '1550.00', 0, 'Dívida', '2-etapa-confirmacion-de-cupo-2', 3, '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(13, '3.ª Etapa - Emision carta aceptacion y admission', '2021-01-15 00:00:00', '1250.00', 0, 'Dívida', '3a-etapa-emision-carta-aceptacion-y-admission-2', 3, '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(14, '4.ª Etapa - Seguro', '2021-01-10 00:00:00', '450.00', 0, 'Dívida', '4a-etapa-seguro-2', 3, '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(15, '5.ª Etapa - Conclusion de pagos (hasta 1 semana antes viajar)', '2021-03-20 00:00:00', '1225.00', 0, 'Pendente', '5a-etapa-conclusion-de-pagos-hasta-1-semana-antes-viajar-2', 3, '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(16, '1.ª Etapa - Inscription y apertura del proceso', '2020-12-08 00:00:00', '250.00', 1, 'Pago', '1a-etapa-inscription-y-apertura-del-proceso-3', 4, '2020-12-09 18:29:41', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(17, '2 etapa: Confirmación de Cupo', '2021-01-10 00:00:00', '1550.00', 0, 'Dívida', '2-etapa-confirmacion-de-cupo-3', 4, '2020-12-09 18:29:41', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(18, '3.ª Etapa - Emision carta aceptacion y admission', '2021-01-15 00:00:00', '1250.00', 0, 'Dívida', '3a-etapa-emision-carta-aceptacion-y-admission-3', 4, '2020-12-09 18:29:42', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(19, '4.ª Etapa - Seguro', '2021-01-15 00:00:00', '450.00', 0, 'Dívida', '4a-etapa-seguro-3', 4, '2020-12-09 18:29:42', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(20, '5.ª Etapa - Conclusion de pagos (hasta 1 semana antes viajar)', '2021-03-20 00:00:00', '1225.00', 0, 'Pendente', '5a-etapa-conclusion-de-pagos-hasta-1-semana-antes-viajar-3', 4, '2020-12-09 18:29:42', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(21, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1-fase-registro-programa', 5, '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(22, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-31 00:00:00', '900.00', 0, 'Dívida', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep', 5, '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(23, '3.ª fase - Exame + Gestión de matricula', '2021-02-22 00:00:00', '750.00', 0, 'Dívida', '3a-fase-exame-gestion-de-matricula', 5, '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(24, '4.ª fase - 2do pagamento Pré Universitário', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '4a-fase-2do-pagamento-pre-universitario', 5, '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(25, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-04-01 00:00:00', '1045.00', 0, 'Pendente', '5a-fase-3er-pago-pre-3er-pago-ep', 5, '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(26, 'Pagamento Seguro', '2021-02-15 00:00:00', '450.00', 0, 'Dívida', 'pagamento-seguro', 6, '2021-01-19 17:15:42', '2021-02-22 18:44:29', '2021-02-22 18:44:29'),
(27, '1.ª fase - 1er pago colegiatura', '2021-04-30 00:00:00', '525.00', 0, 'Pendente', '1a-fase-1er-pago-colegiatura', 7, '2021-01-19 17:16:41', '2021-02-22 18:44:25', '2021-02-22 18:44:25'),
(28, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1-fase-registro-programa-1', 8, '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(29, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-31 00:00:00', '900.00', 0, 'Pendente', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep-1', 8, '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(30, '3.ª fase - Exame + Gestión de matricula', '2021-02-22 00:00:00', '750.00', 0, 'Pendente', '3a-fase-exame-gestion-de-matricula-1', 8, '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(31, '4.ª fase - 2do pagamento Pré Universitário', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '4a-fase-2do-pagamento-pre-universitario-1', 8, '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(32, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-04-01 00:00:00', '1045.00', 0, 'Pendente', '5a-fase-3er-pago-pre-3er-pago-ep-1', 8, '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(33, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1-fase-registro-programa-2', 9, '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(34, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-31 00:00:00', '900.00', 0, 'Dívida', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep-2', 9, '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(35, '3.ª fase - Exame + Gestión de matricula', '2021-02-22 00:00:00', '750.00', 0, 'Dívida', '3a-fase-exame-gestion-de-matricula-2', 9, '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(36, '4.ª fase - 2do pagamento Pré Universitário', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '4a-fase-2do-pagamento-pre-universitario-2', 9, '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(37, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-04-01 00:00:00', '1045.00', 0, 'Pendente', '5a-fase-3er-pago-pre-3er-pago-ep-2', 9, '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(38, '1.ª fase - 1er pago colegiatura', '2021-04-30 00:00:00', '525.00', 0, 'Pendente', '1a-fase-1er-pago-colegiatura-1', 10, '2021-01-19 17:43:11', '2021-02-22 18:37:43', '2021-02-22 18:37:43'),
(39, 'Pagamento Seguro', '2021-02-15 00:00:00', '450.00', 0, 'Dívida', 'pagamento-seguro-1', 11, '2021-01-19 17:43:52', '2021-02-22 18:37:39', '2021-02-22 18:37:39'),
(40, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1-fase-registro-programa-3', 12, '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(41, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-31 00:00:00', '900.00', 0, 'Dívida', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep-3', 12, '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(42, '3.ª fase - Exame + Gestión de matricula', '2021-02-22 00:00:00', '750.00', 0, 'Dívida', '3a-fase-exame-gestion-de-matricula-3', 12, '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(43, '4.ª fase - 2do pagamento Pré Universitário', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '4a-fase-2do-pagamento-pre-universitario-3', 12, '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(44, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-04-01 00:00:00', '1045.00', 0, 'Pendente', '5a-fase-3er-pago-pre-3er-pago-ep-3', 12, '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(45, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1-fase-registro-programa-4', 13, '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(46, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-19 00:00:00', '200.00', 0, 'Dívida', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep-4', 13, '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(47, '3.ª fase - Exame + Gestión de matricula', '2021-01-19 00:00:00', '200.00', 0, 'Dívida', '3a-fase-exame-gestion-de-matricula-4', 13, '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(48, '4.ª fase - 2do pagamento Pré Universitário', '2021-01-19 00:00:00', '200.00', 0, 'Dívida', '4a-fase-2do-pagamento-pre-universitario-4', 13, '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(49, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-01-19 00:00:00', '200.00', 0, 'Dívida', '5a-fase-3er-pago-pre-3er-pago-ep-4', 13, '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(50, 'Pagamento Seguro', '2021-02-15 00:00:00', '450.00', 0, 'Dívida', 'pagamento-seguro-2', 14, '2021-01-20 18:05:24', '2021-02-22 18:44:57', '2021-02-22 18:44:57'),
(51, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1-fase-registro-programa-5', 15, '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(52, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-31 00:00:00', '900.00', 0, 'Dívida', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep-5', 15, '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(53, '3.ª fase - Exame + Gestión de matricula', '2021-02-22 00:00:00', '750.00', 0, 'Dívida', '3a-fase-exame-gestion-de-matricula-5', 15, '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(54, '4.ª fase - 2do pagamento Pré Universitário', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '4a-fase-2do-pagamento-pre-universitario-5', 15, '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(55, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-04-01 00:00:00', '1045.00', 0, 'Pendente', '5a-fase-3er-pago-pre-3er-pago-ep-5', 15, '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(56, 'Pagamento Seguro', '2021-02-15 00:00:00', '450.00', 0, 'Dívida', 'pagamento-seguro-3', 16, '2021-01-20 18:18:22', '2021-02-22 18:45:31', '2021-02-22 18:45:31'),
(57, '1.ª fase - Registro Programa', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1a-fase-registro-programa', 17, '2021-01-20 18:54:21', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(58, '2.ª fase - Exame + Gestão matricula', '2021-02-22 00:00:00', '750.00', 0, 'Dívida', '2a-fase-exame-gestao-matricula', 17, '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(59, '3.ª fase - 1er pago colegiatura + 2do pago EP', '2021-04-01 00:00:00', '1275.00', 0, 'Pendente', '3a-fase-1er-pago-colegiatura-2do-pago-ep', 17, '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(60, '4.ª fase - 1er pago alojamento', '2021-06-01 00:00:00', '750.00', 0, 'Pendente', '4a-fase-1er-pago-alojamento', 17, '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(61, '5.ª fase - 2do pago alojamento', '2021-07-01 00:00:00', '750.00', 0, 'Pendente', '5a-fase-2do-pago-alojamento', 17, '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(62, '6.ª fase - Ultimo pago alojamento + 3ero pago EP', '2021-08-01 00:00:00', '735.00', 0, 'Pendente', '6a-fase-ultimo-pago-alojamento-3ero-pago-ep', 17, '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(63, 'Pagamento Seguro', '2021-07-01 00:00:00', '450.00', 0, 'Pendente', 'pagamento-seguro-4', 18, '2021-01-20 18:55:39', '2021-02-22 18:45:55', '2021-02-22 18:45:55'),
(64, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1-fase-registro-programa-6', 19, '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(65, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-31 00:00:00', '545.00', 0, 'Dívida', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep-6', 19, '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(66, '3.ª fase - Exame + Gestión de matricula', '2021-02-22 00:00:00', '0.00', 0, 'Dívida', '3a-fase-exame-gestion-de-matricula-6', 19, '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(67, '4.ª fase - 2do pagamento Pré Universitário', '2021-04-01 00:00:00', '0.00', 0, 'Pendente', '4a-fase-2do-pagamento-pre-universitario-6', 19, '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(68, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-04-01 00:00:00', '500.00', 0, 'Pendente', '5a-fase-3er-pago-pre-3er-pago-ep-6', 19, '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(69, 'Pagamento Seguro', '2021-02-15 00:00:00', '450.00', 0, 'Dívida', 'pagamento-seguro-5', 20, '2021-01-20 19:13:44', '2021-02-22 18:46:11', '2021-02-22 18:46:11'),
(70, '1 fase - Registro programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1-fase-registro-programa-7', 21, '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(71, '2.ª fase - Confirmación Cupo - 1er pago pre + 2do pago EP', '2021-01-31 00:00:00', '545.00', 0, 'Dívida', '2a-fase-confirmacion-cupo-1er-pago-pre-2do-pago-ep-7', 21, '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(72, '3.ª fase - Exame + Gestión de matricula', '2021-01-22 00:00:00', '0.00', 0, 'Dívida', '3a-fase-exame-gestion-de-matricula-7', 21, '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(73, '4.ª fase - 2do pagamento Pré Universitário', '2021-01-22 00:00:00', '0.00', 0, 'Dívida', '4a-fase-2do-pagamento-pre-universitario-7', 21, '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(74, '5.ª fase - 3er pago Pré + 3er pago EP', '2021-04-01 00:00:00', '500.00', 0, 'Pendente', '5a-fase-3er-pago-pre-3er-pago-ep-7', 21, '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(75, 'Pagamento Seguro', '2021-02-15 00:00:00', '450.00', 0, 'Dívida', 'pagamento-seguro-6', 22, '2021-01-22 11:39:36', '2021-02-22 18:46:26', '2021-02-22 18:46:26'),
(76, '1.ª fase - Registo Programa', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1a-fase-registo-programa', 23, '2021-02-23 17:24:07', '2021-03-24 17:34:32', '2021-03-24 17:34:32'),
(77, '2.ª fase - Confirmação de Vaga', '2021-01-31 00:00:00', '500.00', 1, 'Pago', '2a-fase-confirmacao-de-vaga', 23, '2021-02-23 17:24:07', '2021-03-24 17:34:32', '2021-03-24 17:34:32'),
(78, '3.ª Fase - Conclusão de pagamentos EP', '2021-03-15 00:00:00', '500.00', 0, 'Dívida', '3a-fase-conclusao-de-pagamentos-ep', 23, '2021-02-23 17:24:07', '2021-03-24 17:34:32', '2021-03-24 17:34:32'),
(79, '1.ª Etapa -1.º Pagamento Programa Pré Universitário', '2021-02-23 00:00:00', '400.00', 1, 'Pago', '1a-etapa-1o-pagamento-programa-pre-universitario', 24, '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(80, '2 etapa -2.º Pagamento Programa Pré Universitário - Carta Aceitação', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '2-etapa-2o-pagamento-programa-pre-universitario-carta-aceitacao', 24, '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(81, '3.ª Etapa - 3.º Pagamento Programa Pré Unversitário', '2021-04-01 00:00:00', '545.00', 0, 'Pendente', '3a-etapa-3o-pagamento-programa-pre-unversitario', 24, '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(82, 'Eliminar', '2021-02-23 00:00:00', '0.00', 0, 'Dívida', 'eliminar', 24, '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(83, 'Eliminar', '2021-02-23 00:00:00', '0.00', 0, 'Dívida', 'eliminar-1', 24, '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(84, 'Pagamento Seguro', '2021-04-30 00:00:00', '450.00', 0, 'Pendente', 'pagamento-seguro-7', 25, '2021-02-23 17:36:55', '2021-03-24 17:34:28', '2021-03-24 17:34:28'),
(85, '1.ª fase - Registo Programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1a-fase-registo-programa-1', 26, '2021-02-24 14:59:13', '2021-03-24 17:34:10', '2021-03-24 17:34:10'),
(86, '2.ª fase - Confirmação de Vaga', '2021-04-01 00:00:00', '750.00', 0, 'Pendente', '2a-fase-confirmacao-de-vaga-1', 26, '2021-02-24 14:59:13', '2021-03-24 17:34:10', '2021-03-24 17:34:10'),
(87, '3.ª Fase - Conclusão de pagamentos EP', '2021-08-31 00:00:00', '250.00', 0, 'Pendente', '3a-fase-conclusao-de-pagamentos-ep-1', 26, '2021-02-24 14:59:13', '2021-03-24 17:34:10', '2021-03-24 17:34:10'),
(88, 'Pagamento Seguro', '2021-08-01 00:00:00', '450.00', 0, 'Pendente', 'pagamento-seguro-8', 27, '2021-02-24 15:00:21', '2021-03-24 17:34:07', '2021-03-24 17:34:07'),
(89, 'Fase 1 - Gestão Matricula', '2021-03-07 00:00:00', '650.00', 0, 'Dívida', 'fase-1-gestao-matricula', 28, '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(90, 'Fase 2 - Pagamento 1.ª Quota Propinas', '2021-04-30 00:00:00', '500.00', 0, 'Pendente', 'fase-2-pagamento-1a-quota-propinas', 28, '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(91, 'Fase 3 - 1.º Pagamento Alojamento', '2021-06-30 00:00:00', '750.00', 0, 'Pendente', 'fase-3-1o-pagamento-alojamento', 28, '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(92, 'Fase 4 - 2.º Pagamento Alojamento', '2021-07-31 00:00:00', '750.00', 0, 'Pendente', 'fase-4-2o-pagamento-alojamento', 28, '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(93, 'Fase 5 - 3.º Pagamento Alojamento', '2021-09-01 00:00:00', '485.00', 0, 'Pendente', 'fase-5-3o-pagamento-alojamento', 28, '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(94, '1.ª fase - Registo Programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1a-fase-registo-programa-2', 29, '2021-02-24 15:35:56', '2021-03-24 17:33:51', '2021-03-24 17:33:51'),
(95, '2.ª fase - Confirmação de Vaga', '2021-01-31 00:00:00', '500.00', 0, 'Dívida', '2a-fase-confirmacao-de-vaga-2', 29, '2021-02-24 15:35:56', '2021-03-24 17:33:51', '2021-03-24 17:33:51'),
(96, '3.ª Fase - Conclusão de pagamentos EP', '2021-04-01 00:00:00', '500.00', 0, 'Pendente', '3a-fase-conclusao-de-pagamentos-ep-2', 29, '2021-02-24 15:35:56', '2021-03-24 17:33:51', '2021-03-24 17:33:51'),
(97, '1.ª Etapa -1.º Pagamento Programa Pré Universitário', '2021-01-31 00:00:00', '400.00', 0, 'Dívida', '1a-etapa-1o-pagamento-programa-pre-universitario-1', 30, '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(98, '2 etapa -2.º Pagamento Programa Pré Universitário - Carta Aceitação', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '2-etapa-2o-pagamento-programa-pre-universitario-carta-aceitacao-1', 30, '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(99, '3.ª Etapa - 3.º Pagamento Programa Pré Unversitário', '2021-04-01 00:00:00', '545.00', 0, 'Pendente', '3a-etapa-3o-pagamento-programa-pre-unversitario-1', 30, '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(100, 'Eliminar', '2021-02-24 00:00:00', '0.00', 0, 'Dívida', 'eliminar-2', 30, '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(101, 'Eliminar', '2021-02-24 00:00:00', '0.00', 0, 'Dívida', 'eliminar-3', 30, '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(102, 'Pagamento Seguro', '2021-04-30 00:00:00', '450.00', 0, 'Pendente', 'pagamento-seguro-9', 31, '2021-02-24 15:41:09', '2021-03-24 17:33:48', '2021-03-24 17:33:48'),
(103, '1.ª fase - Registo Programa', '2021-01-17 00:00:00', '250.00', 0, 'Dívida', '1a-fase-registo-programa-3', 32, '2021-02-24 16:15:34', '2021-03-24 17:33:32', '2021-03-24 17:33:32'),
(104, '2.ª fase - Confirmação de Vaga', '2021-01-31 00:00:00', '500.00', 0, 'Dívida', '2a-fase-confirmacao-de-vaga-3', 32, '2021-02-24 16:15:34', '2021-03-24 17:33:32', '2021-03-24 17:33:32'),
(105, '3.ª Fase - Conclusão de pagamentos EP', '2021-04-01 00:00:00', '500.00', 0, 'Pendente', '3a-fase-conclusao-de-pagamentos-ep-3', 32, '2021-02-24 16:15:34', '2021-03-24 17:33:32', '2021-03-24 17:33:32'),
(106, '1.ª Etapa -1.º Pagamento Programa Pré Universitário', '2021-01-31 00:00:00', '400.00', 0, 'Dívida', '1a-etapa-1o-pagamento-programa-pre-universitario-2', 33, '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(107, '2 etapa -2.º Pagamento Programa Pré Universitário - Carta Aceitação', '2021-03-10 00:00:00', '1250.00', 0, 'Pendente', '2-etapa-2o-pagamento-programa-pre-universitario-carta-aceitacao-2', 33, '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(108, '3.ª Etapa - 3.º Pagamento Programa Pré Unversitário', '2021-04-01 00:00:00', '545.00', 0, 'Pendente', '3a-etapa-3o-pagamento-programa-pre-unversitario-2', 33, '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(109, 'Eliminar', '2021-02-24 00:00:00', '0.00', 0, 'Dívida', 'eliminar-4', 33, '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(110, 'Eliminar', '2021-02-24 00:00:00', '0.00', 0, 'Dívida', 'eliminar-5', 33, '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(111, 'Pagamento Seguro', '2021-04-30 00:00:00', '450.00', 0, 'Pendente', 'pagamento-seguro-10', 34, '2021-02-24 16:18:03', '2021-03-24 17:33:28', '2021-03-24 17:33:28'),
(112, '1.ª fase - 1.º pagamento programa pré universitário', '2021-01-31 00:00:00', '400.00', 0, 'Dívida', '1a-fase-1o-pagamento-programa-pre-universitario', 35, '2021-03-09 10:47:38', '2021-03-24 17:34:24', '2021-03-24 17:34:24'),
(113, '2.ª fase - Ultimo pagamento programa pré universitário', '2021-04-01 00:00:00', '795.00', 0, 'Pendente', '2a-fase-ultimo-pagamento-programa-pre-universitario', 35, '2021-03-09 10:47:38', '2021-03-24 17:34:24', '2021-03-24 17:34:24'),
(114, 'Fase 1 - Gestão Matricula', '2021-03-07 00:00:00', '650.00', 0, 'Dívida', 'fase-1-gestao-matricula-1', 36, '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(115, 'Fase 2 - Pagamento 1.ª Quota Propinas', '2021-04-30 00:00:00', '500.00', 0, 'Pendente', 'fase-2-pagamento-1a-quota-propinas-1', 36, '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(116, 'Fase 3 - 1.º Pagamento Alojamento', '2021-06-30 00:00:00', '750.00', 0, 'Pendente', 'fase-3-1o-pagamento-alojamento-1', 36, '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(117, 'Fase 4 - 2.º Pagamento Alojamento', '2021-04-30 00:00:00', '750.00', 0, 'Pendente', 'fase-4-2o-pagamento-alojamento-1', 36, '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(118, 'Fase 5 - 3.º Pagamento Alojamento', '2021-09-01 00:00:00', '485.00', 0, 'Pendente', 'fase-5-3o-pagamento-alojamento-1', 36, '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(119, '1.ª fase - 1.º pagamento programa pré universitário', '2021-01-31 00:00:00', '400.00', 0, 'Dívida', '1a-fase-1o-pagamento-programa-pre-universitario-1', 37, '2021-03-09 11:19:54', '2021-03-24 17:33:44', '2021-03-24 17:33:44'),
(120, '2.ª fase - Ultimo pagamento programa pré universitário', '2021-04-01 00:00:00', '795.00', 0, 'Pendente', '2a-fase-ultimo-pagamento-programa-pre-universitario-1', 37, '2021-03-09 11:19:54', '2021-03-24 17:33:44', '2021-03-24 17:33:44'),
(121, '1.ª fase - Gestão matricula', '2021-03-07 00:00:00', '650.00', 0, 'Dívida', '1a-fase-gestao-matricula', 38, '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(122, '2.ª fase - Pagamento Propinas', '2021-05-15 00:00:00', '600.00', 0, 'Pendente', '2a-fase-pagamento-propinas', 38, '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(123, '3.ª fase - 1.º pagamento alojamento', '2021-06-30 00:00:00', '750.00', 0, 'Pendente', '3a-fase-1o-pagamento-alojamento', 38, '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(124, '4.ª fase - 2.º pagamento alojamento', '2021-07-31 00:00:00', '750.00', 0, 'Pendente', '4a-fase-2o-pagamento-alojamento', 38, '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(125, '5.ª fase - ultimo pagamento alojamento', '2021-09-01 00:00:00', '250.00', 0, 'Pendente', '5a-fase-ultimo-pagamento-alojamento', 38, '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(126, '1.ª fase - 1.º pagamento programa pré universitário', '2021-01-31 00:00:00', '400.00', 0, 'Dívida', '1a-fase-1o-pagamento-programa-pre-universitario-2', 39, '2021-03-09 11:40:22', '2021-03-24 17:33:25', '2021-03-24 17:33:25'),
(127, '2.ª fase - Ultimo pagamento programa pré universitário', '2021-04-01 00:00:00', '795.00', 0, 'Pendente', '2a-fase-ultimo-pagamento-programa-pre-universitario-2', 39, '2021-03-09 11:40:22', '2021-03-24 17:33:25', '2021-03-24 17:33:25'),
(128, '1.ª fase - 1.º pagamento programa pré universitário', '2021-03-30 00:00:00', '100.00', 0, 'Dívida', '1a-fase-1o-pagamento-programa-pre-universitario-3', 40, '2021-03-30 15:11:42', '2021-03-30 15:12:04', '2021-03-30 15:12:04'),
(129, '2.ª fase - Ultimo pagamento programa pré universitário', '2021-04-30 00:00:00', '100.00', 0, 'Pendente', '2a-fase-ultimo-pagamento-programa-pre-universitario-3', 40, '2021-03-30 15:11:42', '2021-03-30 15:12:04', '2021-03-30 15:12:04'),
(130, '1.ª Fase - Registo Programa - 1.º Pag. EP', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1a-fase-registo-programa-1o-pag-ep', 41, '2021-04-06 14:44:39', '2021-04-06 14:49:23', NULL),
(131, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2021-01-31 00:00:00', '900.00', 1, 'Pago', '2a-fase-1o-pag-pre-2o-pag-ep', 41, '2021-04-06 14:44:39', '2021-04-06 14:48:43', NULL),
(132, '3.ª Fase - Pag. Gestão Matricula', '2021-03-07 00:00:00', '650.00', 1, 'Pago', '3a-fase-pag-gestao-matricula', 41, '2021-04-06 14:44:39', '2021-04-06 14:50:21', NULL),
(133, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '2021-04-01 00:00:00', '795.00', 0, 'Dívida', '4a-fase-ultimo-pagamento-pre-universitario', 41, '2021-04-06 14:44:39', '2021-04-06 14:45:01', NULL),
(134, '5.ª Fase - 1.º Pagamento Colegiatura UALG', '2021-04-30 00:00:00', '500.00', 0, 'Pendente', '5a-fase-1o-pagamento-colegiatura-ualg', 41, '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(135, '6.ª Fase - 1.ª Quota Alojamento', '2021-06-15 00:00:00', '750.00', 0, 'Pendente', '6a-fase-1a-quota-alojamento', 41, '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(136, '7.ª Fase - 2.ª Quota Alojamento', '2021-07-15 00:00:00', '750.00', 0, 'Pendente', '7a-fase-2a-quota-alojamento', 41, '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(137, '8.ª Fase - Seguro + ultima quota EP', '2021-08-15 00:00:00', '950.00', 0, 'Pendente', '8a-fase-seguro-ultima-quota-ep', 41, '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(138, '9.ª Fase - 3.ª e Ultima quota alojamento', '2021-09-01 00:00:00', '485.00', 0, 'Pendente', '9a-fase-3a-e-ultima-quota-alojamento', 41, '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(139, '1.ª Fase - Registo Programa - 1.º Pag. EP', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1a-fase-registo-programa-1o-pag-ep-1', 42, '2021-04-07 09:57:01', '2021-04-07 10:01:23', NULL),
(140, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2021-01-31 00:00:00', '900.00', 1, 'Pago', '2a-fase-1o-pag-pre-2o-pag-ep-1', 42, '2021-04-07 09:57:01', '2021-04-07 10:02:00', NULL),
(141, '3.ª Fase - Pag. Gestão Matricula + Exame', '2021-04-07 00:00:00', '710.00', 0, 'Dívida', '3a-fase-pag-gestao-matricula-exame', 42, '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(142, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '2021-04-07 00:00:00', '795.00', 0, 'Dívida', '4a-fase-ultimo-pagamento-pre-universitario-1', 42, '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(143, '5.ª Fase - 1.º Pagamento Colegiatura UBI', '2021-05-15 00:00:00', '600.00', 0, 'Pendente', '5a-fase-1o-pagamento-colegiatura-ubi', 42, '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(144, '6.ª Fase - 1.ª Quota Alojamento', '2021-06-15 00:00:00', '750.00', 0, 'Pendente', '6a-fase-1a-quota-alojamento-1', 42, '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(145, '7.ª Fase - 2.ª Quota Alojamento', '2021-07-15 00:00:00', '750.00', 0, 'Pendente', '7a-fase-2a-quota-alojamento-1', 42, '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(146, '8.ª Fase - Seguro + ultima quota EP', '2021-08-15 00:00:00', '950.00', 0, 'Pendente', '8a-fase-seguro-ultima-quota-ep-1', 42, '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(147, '9.ª Fase - 3.ª e Ultima quota alojamento', '2021-09-01 00:00:00', '250.00', 0, 'Pendente', '9a-fase-3a-e-ultima-quota-alojamento-1', 42, '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(148, '1.ª Fase - Registo Programa - 1.º Pag. EP', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1a-fase-registo-programa-1o-pag-ep-2', 43, '2021-04-07 12:42:50', '2021-04-07 12:44:16', NULL),
(149, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2021-01-31 00:00:00', '900.00', 1, 'Pago', '2a-fase-1o-pag-pre-2o-pag-ep-2', 43, '2021-04-07 12:42:50', '2021-04-07 12:44:54', NULL),
(150, '3.ª Fase - Pag. Gestão Matricula + Exame', '2021-03-07 00:00:00', '710.00', 1, 'Pago', '3a-fase-pag-gestao-matricula-exame-1', 43, '2021-04-07 12:42:50', '2021-04-07 12:46:25', NULL),
(151, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '2021-04-01 00:00:00', '795.00', 0, 'Dívida', '4a-fase-ultimo-pagamento-pre-universitario-2', 43, '2021-04-07 12:42:50', '2021-04-07 12:43:01', NULL),
(152, '5.ª Fase - 1.º Pagamento Colegiatura UALG', '2021-04-30 00:00:00', '500.00', 0, 'Pendente', '5a-fase-1o-pagamento-colegiatura-ualg-1', 43, '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(153, '6.ª Fase - 1.ª Quota Alojamento', '2021-06-15 00:00:00', '750.00', 0, 'Pendente', '6a-fase-1a-quota-alojamento-2', 43, '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(154, '7.ª Fase - 2.ª Quota Alojamento', '2021-07-15 00:00:00', '750.00', 0, 'Pendente', '7a-fase-2a-quota-alojamento-2', 43, '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(155, '8.ª Fase - Seguro + ultima quota EP', '2021-08-15 00:00:00', '950.00', 0, 'Pendente', '8a-fase-seguro-ultima-quota-ep-2', 43, '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(156, '9.ª Fase - 3.ª e Ultima quota alojamento', '2021-09-01 00:00:00', '485.00', 0, 'Pendente', '9a-fase-3a-e-ultima-quota-alojamento-2', 43, '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(157, '1.ª Fase - Registo Programa - 1.º Pag. EP', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1a-fase-registo-programa-1o-pag-ep-3', 44, '2021-04-07 13:03:42', '2021-04-07 13:04:52', NULL),
(158, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2021-01-31 00:00:00', '900.00', 1, 'Pago', '2a-fase-1o-pag-pre-2o-pag-ep-3', 44, '2021-04-07 13:03:43', '2021-04-07 13:05:36', NULL),
(159, '3.ª Fase - Pag. Gestão Matricula', '2021-03-07 00:00:00', '650.00', 1, 'Pago', '3a-fase-pag-gestao-matricula-1', 44, '2021-04-07 13:03:43', '2021-04-07 13:05:56', NULL),
(160, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '2021-04-01 00:00:00', '795.00', 0, 'Dívida', '4a-fase-ultimo-pagamento-pre-universitario-3', 44, '2021-04-07 13:03:43', '2021-04-07 13:04:01', NULL),
(161, '5.ª Fase - 1.º Pagamento Colegiatura UALG', '2021-04-30 00:00:00', '500.00', 0, 'Pendente', '5a-fase-1o-pagamento-colegiatura-ualg-2', 44, '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(162, '6.ª Fase - 1.ª Quota Alojamento', '2021-06-15 00:00:00', '750.00', 0, 'Pendente', '6a-fase-1a-quota-alojamento-3', 44, '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(163, '7.ª Fase - 2.ª Quota Alojamento', '2021-07-15 00:00:00', '750.00', 0, 'Pendente', '7a-fase-2a-quota-alojamento-3', 44, '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(164, '8.ª Fase - Seguro + ultima quota EP', '2021-08-15 00:00:00', '950.00', 0, 'Pendente', '8a-fase-seguro-ultima-quota-ep-3', 44, '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(165, '9.ª Fase - 3.ª e Ultima quota alojamento', '2021-09-01 00:00:00', '485.00', 0, 'Pendente', '9a-fase-3a-e-ultima-quota-alojamento-3', 44, '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(166, '1.ª Fase - Registo Programa - 1.º Pag. EP', '2021-01-17 00:00:00', '250.00', 1, 'Pago', '1a-fase-registo-programa-1o-pag-ep-4', 45, '2021-04-07 13:20:06', '2021-04-07 13:24:37', NULL),
(167, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2021-01-31 00:00:00', '900.00', 1, 'Pago', '2a-fase-1o-pag-pre-2o-pag-ep-4', 45, '2021-04-07 13:20:06', '2021-04-07 13:25:06', NULL),
(168, '3.ª Fase - Pag. Gestão Matricula', '2021-03-07 00:00:00', '650.00', 0, 'Dívida', '3a-fase-pag-gestao-matricula-2', 45, '2021-04-07 13:20:06', '2021-04-07 13:21:02', NULL),
(169, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '2021-04-01 00:00:00', '795.00', 0, 'Dívida', '4a-fase-ultimo-pagamento-pre-universitario-4', 45, '2021-04-07 13:20:06', '2021-04-07 13:21:02', NULL),
(170, '5.ª Fase - 1.º Pagamento Colegiatura UBI', '2021-05-15 00:00:00', '600.00', 0, 'Pendente', '5a-fase-1o-pagamento-colegiatura-ubi-1', 45, '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(171, '6.ª Fase - 1.ª Quota Alojamento', '2021-06-15 00:00:00', '750.00', 0, 'Pendente', '6a-fase-1a-quota-alojamento-4', 45, '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(172, '7.ª Fase - 2.ª Quota Alojamento', '2021-04-07 00:00:00', '750.00', 0, 'Dívida', '7a-fase-2a-quota-alojamento-4', 45, '2021-04-07 13:20:06', '2021-04-07 13:21:02', NULL),
(173, '8.ª Fase - Seguro + ultima quota EP', '2021-08-15 00:00:00', '950.00', 0, 'Pendente', '8a-fase-seguro-ultima-quota-ep-4', 45, '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(174, '9.ª Fase - 3.ª e Ultima quota alojamento', '2021-09-01 00:00:00', '250.00', 0, 'Pendente', '9a-fase-3a-e-ultima-quota-alojamento-4', 45, '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fase_stock`
--

CREATE TABLE `fase_stock` (
  `idFaseStock` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `idProdutoStock` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fase_stock`
--

INSERT INTO `fase_stock` (`idFaseStock`, `descricao`, `slug`, `idProdutoStock`, `created_at`, `updated_at`) VALUES
(22, '1.ª fase - Registo Programa', '1a-fase-registo-programa', 10, '2021-02-23 17:04:35', '2021-02-23 17:04:35'),
(23, '2.ª fase - Confirmação de Vaga', '2a-fase-confirmacao-de-vaga', 10, '2021-02-23 17:06:11', '2021-02-23 17:06:11'),
(24, '3.ª Fase - Conclusão de pagamentos EP', '3a-fase-conclusao-de-pagamentos-ep', 10, '2021-02-23 17:07:59', '2021-02-23 17:07:59'),
(25, 'Pagamento Seguro', 'pagamento-seguro', 11, '2021-02-23 17:08:41', '2021-02-23 17:08:41'),
(26, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep-6', 12, '2021-02-24 15:12:51', '2021-04-06 14:23:09'),
(27, '2.ª Fase - Pag. Gestão Matricula', '2a-fase-pag-gestao-matricula', 12, '2021-02-24 15:13:23', '2021-04-06 14:23:35'),
(28, '3.ª Fase - 1.º Pagamento Colegiatura UALG', '3a-fase-1o-pagamento-colegiatura-ualg-1', 12, '2021-02-24 15:13:43', '2021-04-06 14:24:42'),
(29, '4.ª Fase - 1.ª Quota Alojamento', '4a-fase-1a-quota-alojamento-2', 12, '2021-02-24 15:14:03', '2021-04-06 14:25:00'),
(30, '5.ª Fase - 2.ª Quota Alojamento', '5a-fase-2a-quota-alojamento-2', 12, '2021-02-24 15:14:22', '2021-04-06 14:25:08'),
(33, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep-7', 14, '2021-03-09 11:26:35', '2021-04-06 14:25:55'),
(34, '2.ª Fase - Pag. Gestão Matricula', '2a-fase-pag-gestao-matricula-1', 14, '2021-03-09 11:27:25', '2021-04-06 14:26:13'),
(35, '3.ª Fase - 1.º Pagamento Colegiatura UBI', '3a-fase-1o-pagamento-colegiatura-ubi-1', 14, '2021-03-09 11:29:11', '2021-04-06 14:26:28'),
(36, '4.ª Fase - 1.ª Quota Alojamento', '4a-fase-1a-quota-alojamento-3', 14, '2021-03-09 11:29:32', '2021-04-06 14:26:39'),
(37, '5.ª Fase - 2.ª Quota Alojamento', '5a-fase-2a-quota-alojamento-3', 14, '2021-03-09 11:29:54', '2021-04-06 14:26:48'),
(38, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep', 15, '2021-04-06 13:56:23', '2021-04-06 14:05:48'),
(39, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2a-fase-1o-pag-pre-2o-pag-ep', 15, '2021-04-06 13:58:50', '2021-04-06 14:05:32'),
(40, '3.ª Fase - Pag. Gestão Matricula + Exame', '3a-fase-pag-gestao-matricula-exame', 15, '2021-04-06 13:59:41', '2021-04-06 14:01:18'),
(41, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '4a-fase-ultimo-pagamento-pre-universitario', 15, '2021-04-06 14:02:32', '2021-04-06 14:02:32'),
(42, '5.ª Fase - 1.º Pagamento Colegiatura UBI', '5a-fase-1o-pagamento-colegiatura-ubi', 15, '2021-04-06 14:03:01', '2021-04-06 14:03:37'),
(45, '6.ª Fase - 1.ª Quota Alojamento', '6a-fase-1a-quota-alojamento', 15, '2021-04-06 14:04:02', '2021-04-06 14:04:02'),
(46, '7.ª Fase - 2.ª Quota Alojamento', '7a-fase-2a-quota-alojamento', 15, '2021-04-06 14:04:24', '2021-04-06 14:04:24'),
(47, '8.ª Fase - Seguro + ultima quota EP', '8a-fase-seguro-ultima-quota-ep', 15, '2021-04-06 14:05:14', '2021-04-06 14:05:14'),
(48, '9.ª Fase - 3.ª e Ultima quota alojamento', '9a-fase-3a-e-ultima-quota-alojamento', 15, '2021-04-06 14:06:36', '2021-04-06 14:06:36'),
(49, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep-1', 16, '2021-04-06 14:08:01', '2021-04-06 14:08:01'),
(50, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2a-fase-1o-pag-pre-2o-pag-ep-1', 16, '2021-04-06 14:08:19', '2021-04-06 14:08:19'),
(51, '3.ª Fase - Pag. Gestão Matricula + Exame', '3a-fase-pag-gestao-matricula-exame-1', 16, '2021-04-06 14:08:34', '2021-04-06 14:08:34'),
(52, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '4a-fase-ultimo-pagamento-pre-universitario-1', 16, '2021-04-06 14:08:48', '2021-04-06 14:08:48'),
(53, '5.ª Fase - 1.º Pagamento Colegiatura UALG', '5a-fase-1o-pagamento-colegiatura-ualg', 16, '2021-04-06 14:09:04', '2021-04-06 14:09:04'),
(54, '6.ª Fase - 1.ª Quota Alojamento', '6a-fase-1a-quota-alojamento-1', 16, '2021-04-06 14:09:18', '2021-04-06 14:09:18'),
(55, '7.ª Fase - 2.ª Quota Alojamento', '7a-fase-2a-quota-alojamento-1', 16, '2021-04-06 14:09:32', '2021-04-06 14:09:32'),
(56, '8.ª Fase - Seguro + ultima quota EP', '8a-fase-seguro-ultima-quota-ep-1', 16, '2021-04-06 14:09:46', '2021-04-06 14:09:46'),
(57, '9.ª Fase - 3.ª e Ultima quota alojamento', '9a-fase-3a-e-ultima-quota-alojamento-1', 16, '2021-04-06 14:09:54', '2021-04-06 14:09:54'),
(58, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep-2', 17, '2021-04-06 14:11:31', '2021-04-06 14:11:31'),
(59, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2a-fase-1o-pag-pre-2o-pag-ep-2', 17, '2021-04-06 14:12:18', '2021-04-06 14:12:18'),
(60, '3.ª Fase - Pag. Gestão Matricula', '3a-fase-pag-gestao-matricula', 17, '2021-04-06 14:12:36', '2021-04-06 14:12:36'),
(61, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '4a-fase-ultimo-pagamento-pre-universitario-2', 17, '2021-04-06 14:12:55', '2021-04-06 14:12:55'),
(62, '5.ª Fase - 1.º Pagamento Colegiatura UBI', '5a-fase-1o-pagamento-colegiatura-ubi-1', 17, '2021-04-06 14:13:14', '2021-04-06 14:13:14'),
(63, '6.ª Fase - 1.ª Quota Alojamento', '6a-fase-1a-quota-alojamento-2', 17, '2021-04-06 14:13:25', '2021-04-06 14:13:25'),
(64, '7.ª Fase - 2.ª Quota Alojamento', '7a-fase-2a-quota-alojamento-2', 17, '2021-04-06 14:13:31', '2021-04-06 14:13:31'),
(65, '8.ª Fase - Seguro + ultima quota EP', '8a-fase-seguro-ultima-quota-ep-2', 17, '2021-04-06 14:13:41', '2021-04-06 14:13:41'),
(66, '9.ª Fase - 3.ª e Ultima quota alojamento', '9a-fase-3a-e-ultima-quota-alojamento-2', 17, '2021-04-06 14:13:47', '2021-04-06 14:13:47'),
(67, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep-3', 18, '2021-04-06 14:14:48', '2021-04-06 14:14:48'),
(68, '2.ª Fase - 1.º Pag Pre + 2.º Pag EP', '2a-fase-1o-pag-pre-2o-pag-ep-3', 18, '2021-04-06 14:14:54', '2021-04-06 14:14:54'),
(69, '3.ª Fase - Pag. Gestão Matricula', '3a-fase-pag-gestao-matricula-1', 18, '2021-04-06 14:15:07', '2021-04-06 14:15:07'),
(70, '4.ª Fase - Ultimo Pagamento Pré - Universitário', '4a-fase-ultimo-pagamento-pre-universitario-3', 18, '2021-04-06 14:15:15', '2021-04-06 14:15:15'),
(71, '5.ª Fase - 1.º Pagamento Colegiatura UALG', '5a-fase-1o-pagamento-colegiatura-ualg-1', 18, '2021-04-06 14:15:23', '2021-04-06 14:15:23'),
(72, '6.ª Fase - 1.ª Quota Alojamento', '6a-fase-1a-quota-alojamento-3', 18, '2021-04-06 14:15:47', '2021-04-06 14:15:47'),
(73, '7.ª Fase - 2.ª Quota Alojamento', '7a-fase-2a-quota-alojamento-3', 18, '2021-04-06 14:15:54', '2021-04-06 14:15:54'),
(74, '8.ª Fase - Seguro + ultima quota EP', '8a-fase-seguro-ultima-quota-ep-3', 18, '2021-04-06 14:15:59', '2021-04-06 14:15:59'),
(75, '9.ª Fase - 3.ª e Ultima quota alojamento', '9a-fase-3a-e-ultima-quota-alojamento-3', 18, '2021-04-06 14:16:04', '2021-04-06 14:16:04'),
(76, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep-4', 19, '2021-04-06 14:17:11', '2021-04-06 14:17:11'),
(77, '2.ª Fase - Pag. Gestão Matricula + Exame', '2a-fase-pag-gestao-matricula-exame', 19, '2021-04-06 14:17:39', '2021-04-06 14:17:39'),
(78, '3.ª Fase - 1.º Pagamento Colegiatura UBI', '3a-fase-1o-pagamento-colegiatura-ubi', 19, '2021-04-06 14:18:08', '2021-04-06 14:18:08'),
(79, '4.ª Fase - 1.ª Quota Alojamento', '4a-fase-1a-quota-alojamento', 19, '2021-04-06 14:18:27', '2021-04-06 14:18:27'),
(80, '5.ª Fase - 2.ª Quota Alojamento', '5a-fase-2a-quota-alojamento', 19, '2021-04-06 14:18:42', '2021-04-06 14:18:42'),
(81, '6.ª Fase - Seguro + ultima quota EP', '6a-fase-seguro-ultima-quota-ep', 19, '2021-04-06 14:18:56', '2021-04-06 14:18:56'),
(82, '7.ª Fase - 3.ª e Ultima quota alojamento', '7a-fase-3a-e-ultima-quota-alojamento', 19, '2021-04-06 14:19:13', '2021-04-06 14:19:13'),
(83, '1.ª Fase - Registo Programa - 1.º Pag. EP', '1a-fase-registo-programa-1o-pag-ep-5', 20, '2021-04-06 14:20:04', '2021-04-06 14:20:04'),
(84, '2.ª Fase - Pag. Gestão Matricula + Exame', '2a-fase-pag-gestao-matricula-exame-1', 20, '2021-04-06 14:20:20', '2021-04-06 14:20:20'),
(85, '3.ª Fase - 1.º Pagamento Colegiatura UALG', '3a-fase-1o-pagamento-colegiatura-ualg', 20, '2021-04-06 14:20:42', '2021-04-06 14:20:42'),
(86, '4.ª Fase - 1.ª Quota Alojamento', '4a-fase-1a-quota-alojamento-1', 20, '2021-04-06 14:20:51', '2021-04-06 14:20:51'),
(87, '5.ª Fase - 2.ª Quota Alojamento', '5a-fase-2a-quota-alojamento-1', 20, '2021-04-06 14:20:58', '2021-04-06 14:20:58'),
(88, '6.ª Fase - Seguro + ultima quota EP', '6a-fase-seguro-ultima-quota-ep-1', 20, '2021-04-06 14:21:05', '2021-04-06 14:21:05'),
(89, '7.ª Fase - 3.ª e Ultima quota alojamento', '7a-fase-3a-e-ultima-quota-alojamento-1', 20, '2021-04-06 14:21:11', '2021-04-06 14:21:11'),
(90, '6.ª Fase - Seguro + ultima quota EP', '6a-fase-seguro-ultima-quota-ep-2', 12, '2021-04-06 14:25:18', '2021-04-06 14:25:18'),
(91, '7.ª Fase - 3.ª e Ultima quota alojamento', '7a-fase-3a-e-ultima-quota-alojamento-2', 12, '2021-04-06 14:25:26', '2021-04-06 14:25:26'),
(92, '6.ª Fase - Seguro + ultima quota EP', '6a-fase-seguro-ultima-quota-ep-3', 14, '2021-04-06 14:26:58', '2021-04-06 14:26:58'),
(93, '7.ª Fase - 3.ª e Ultima quota alojamento', '7a-fase-3a-e-ultima-quota-alojamento-3', 14, '2021-04-06 14:27:04', '2021-04-06 14:27:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idFornecedor` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `contacto` varchar(191) NOT NULL,
  `descricao` text NOT NULL,
  `observacoes` text DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idFornecedor`, `nome`, `morada`, `contacto`, `descricao`, `observacoes`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gaspar  Costa Lda', 'Meirinhas', '919354374', 'Seguros', NULL, 'seguros', '2021-01-18 15:17:06', '2021-01-18 15:17:06', NULL),
(2, 'Sasualg', 'Dra Graça Rafael - Pessoal', '966341032', 'Residências Universitárias Algarve', 'Dª Fernanda Viegas - 289 89 59 50', 'residencias-universitarias-algarve', '2021-01-18 15:19:53', '2021-01-18 15:19:53', NULL),
(3, 'SASUBI', 'Covilhã', 'Eduardo Alves - 964652809', 'Residências Universitárias Covilhã', 'eduardo.alves@ubi.pt', 'residencias-universitarias-covilha', '2021-01-18 15:21:08', '2021-01-18 15:21:08', NULL),
(4, 'António Pinto', 'Faro', '9', 'Taxista Algarve', NULL, 'taxista-algarve', '2021-01-18 15:22:09', '2021-01-18 15:22:09', NULL),
(5, 'Estudar Portugal', 'Lisboa', '918456031', 'Consultora Académica', NULL, 'consultora-academica', '2021-01-19 15:11:16', '2021-01-19 15:11:16', NULL),
(6, 'Exame de acesso', 'Lisboa', '918456031', 'Universidade', NULL, 'universidade', '2021-01-19 17:29:13', '2021-01-19 17:29:13', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_03_06_001_administrador', 1),
(2, '2020_03_06_002_agente', 1),
(3, '2020_03_06_003_biblioteca', 1),
(4, '2020_03_06_004_cliente', 1),
(5, '2020_03_06_005_conta', 1),
(6, '2020_03_06_006_fornecedor', 1),
(7, '2020_03_06_007_produto_stock', 1),
(8, '2020_03_06_008_fase_stock', 1),
(9, '2020_03_06_009_doc_stock', 1),
(10, '2020_03_06_010_universidade', 1),
(11, '2020_03_06_011_user', 1),
(12, '2020_03_06_012_contacto', 1),
(13, '2020_03_06_013_agenda', 1),
(14, '2020_03_06_014_notificacao', 1),
(15, '2020_03_06_015_produto', 1),
(16, '2020_03_06_016_fase', 1),
(17, '2020_03_06_017_responsabilidade', 1),
(18, '2020_03_06_018_doc_necessario', 1),
(19, '2020_03_06_019_doc_academico', 1),
(20, '2020_03_06_020_doc_pessoal', 1),
(21, '2020_03_06_021_doc_transacao', 1),
(22, '2020_03_06_022_pago_responsabilidade', 1),
(23, '2020_03_06_023_rel_forn_resp', 1),
(24, '2020_04_17_132641_relatorio_problema', 1),
(25, '2020_05_05_083555_create_jobs_table', 1),
(26, '2021_01_06_184028_add_collum_id_sub_agente_to_cliente', 2),
(27, '2021_02_19_171022_add_nullable_info', 3),
(28, '2021_02_22_191253_change_enum', 4),
(29, '2021_02_24_155451_change_enum', 5),
(30, '2021_03_02_104504_add_collums', 6),
(31, '2021_03_09_121251_add_exam_to_enum', 7),
(32, '2021_03_09_121442_add_exam_to_enum_produto', 7),
(33, '2021_03_13_180611_delete_subagente_uni2', 8),
(34, '2021_03_15_111749_add_bool_exame', 9),
(35, '2021_03_15_143440_cliente_observacoes', 10),
(36, '2021_03_29_102904_add_enum_to_tipo_produto', 11),
(37, '2021_03_29_102924_add_enum_to_tipo_produtos', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('06f911e3-199e-4628-b26c-d4ef181bddd8', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_2\",\"urgencia\":false,\"dataComeco\":\"2020-12-09\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Domenica Anabel Guacho Guaman -> 15\\/12\\/2020\"}', '2020-12-28 15:51:30', '2020-12-09 17:35:08', '2020-12-28 15:51:30'),
('efd05095-e0e6-4bbf-978f-d740b782caac', 'App\\Notifications\\Atraso', 'App\\User', 2, '{\"code\":\"2_atraso_2_1\",\"urgencia\":true,\"dataComeco\":\"2020-12-14\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Domenica Anabel Guacho Guaman -> 15\\/12\\/2020\\\\n - Francisco Josue Ayala Davila -> 20\\/12\\/2020\"}', '2021-01-10 18:30:47', '2020-12-14 08:02:06', '2021-01-10 18:30:47'),
('2f4df012-3f68-40ac-8f83-ea43237f0c94', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_2_1\",\"urgencia\":true,\"dataComeco\":\"2020-12-28\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Domenica Anabel Guacho Guaman -> 15\\/12\\/2020\\\\n - Francisco Josue Ayala Davila -> 20\\/12\\/2020\"}', '2021-01-06 13:38:37', '2020-12-28 15:51:30', '2021-01-06 13:38:37'),
('9b86a934-5c35-4159-ad3d-aa0120b8ea21', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_2_1_3_4\",\"urgencia\":true,\"dataComeco\":\"2021-01-06\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Domenica Anabel Guacho Guaman -> 15\\/12\\/2020\\\\n - Francisco Josue Ayala Davila -> 20\\/12\\/2020\\\\n - Simon Sarmiento Mora -> 10\\/01\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\"}', '2021-01-19 17:36:49', '2021-01-06 13:38:37', '2021-01-19 17:36:49'),
('4ca071f6-1f15-4b1a-b4a8-4f74341cd65d', 'App\\Notifications\\Atraso', 'App\\User', 2, '{\"code\":\"2_atraso_2_1_3_4\",\"urgencia\":true,\"dataComeco\":\"2021-01-10\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Domenica Anabel Guacho Guaman -> 15\\/12\\/2020\\\\n - Francisco Josue Ayala Davila -> 20\\/12\\/2020\\\\n - Simon Sarmiento Mora -> 10\\/01\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\"}', '2021-02-18 14:39:18', '2021-01-10 18:30:47', '2021-02-18 14:39:18'),
('cf065f9e-3a4b-4777-9237-25b6f87c00e1', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_3_4_1\",\"urgencia\":true,\"dataComeco\":\"2021-01-19\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Simon Sarmiento Mora -> 10\\/01\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Francisco Josue Ayala Davila -> 17\\/01\\/2021\"}', '2021-01-19 21:50:04', '2021-01-19 17:36:49', '2021-01-19 21:50:04'),
('d1556170-4a0c-412a-ab4b-85cfaec52639', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4_3_1\",\"urgencia\":true,\"dataComeco\":\"2021-01-19\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\\\\n - Francisco Josue Ayala Davila -> 17\\/01\\/2021\"}', '2021-01-20 17:25:31', '2021-01-19 21:50:04', '2021-01-20 17:25:31'),
('4970e28e-8047-4a61-8972-ff689972ac0b', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4_3\",\"urgencia\":true,\"dataComeco\":\"2021-01-20\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\"}', '2021-01-20 18:06:00', '2021-01-20 17:25:31', '2021-01-20 18:06:00'),
('8b3d9539-447b-4be1-8656-a4aeba75fdb5', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4\",\"urgencia\":true,\"dataComeco\":\"2021-01-20\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\"}', '2021-01-20 18:24:35', '2021-01-20 18:06:00', '2021-01-20 18:24:35'),
('81fe2bf1-8b09-4bf9-a15e-c0854ebc2325', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4_6\",\"urgencia\":true,\"dataComeco\":\"2021-01-20\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Julio Andre Rivadeneira Salazar -> 17\\/01\\/2021\"}', '2021-01-21 10:13:18', '2021-01-20 18:24:35', '2021-01-21 10:13:18'),
('5c9b506a-8347-4b2a-a4f1-508dd62f7ca9', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4_6_9\",\"urgencia\":true,\"dataComeco\":\"2021-01-21\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Julio Andre Rivadeneira Salazar -> 17\\/01\\/2021\\\\n - David Josue Quimis Proa\\u00f1o -> 17\\/01\\/2021\"}', '2021-01-22 11:36:10', '2021-01-21 10:13:18', '2021-01-22 11:36:10'),
('5d238f9a-a229-4f3c-9bf8-3787e5b3853c', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4_6_9_10\",\"urgencia\":true,\"dataComeco\":\"2021-01-22\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Julio Andre Rivadeneira Salazar -> 17\\/01\\/2021\\\\n - David Josue Quimis Proa\\u00f1o -> 17\\/01\\/2021\\\\n - Carlos Erick Lopez Gomez -> 17\\/01\\/2021\"}', '2021-01-25 14:17:16', '2021-01-22 11:36:10', '2021-01-25 14:17:16'),
('d43bba67-e2a2-4d5b-aa75-258037f1cf50', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4_2_1_3_6_9_10\",\"urgencia\":true,\"dataComeco\":\"2021-01-25\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 31\\/01\\/2021\\\\n - Francisco Josue Ayala Davila -> 31\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 31\\/01\\/2021\\\\n - Julio Andre Rivadeneira Salazar -> 17\\/01\\/2021\\\\n - David Josue Quimis Proa\\u00f1o -> 17\\/01\\/2021\\\\n - Carlos Erick Lopez Gomez -> 17\\/01\\/2021\"}', '2021-02-16 12:33:22', '2021-01-25 14:17:16', '2021-02-16 12:33:22'),
('f4dccf71-8ac0-4bed-9390-565ca96e4c63', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_4_2_1_3_6_8_9_10\",\"urgencia\":true,\"dataComeco\":\"2021-02-16\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 31\\/01\\/2021\\\\n - Francisco Josue Ayala Davila -> 31\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 31\\/01\\/2021\\\\n - Julio Andre Rivadeneira Salazar -> 17\\/01\\/2021\\\\n - Joel Sebastian Leiva Tapia -> 22\\/02\\/2021\\\\n - David Josue Quimis Proa\\u00f1o -> 17\\/01\\/2021\\\\n - Carlos Erick Lopez Gomez -> 17\\/01\\/2021\"}', '2021-02-23 17:43:45', '2021-02-16 12:33:22', '2021-02-23 17:43:45'),
('c77af612-7198-4dfe-afad-15a580cfb9a9', 'App\\Notifications\\Atraso', 'App\\User', 2, '{\"code\":\"2_atraso_4_2_1_3_6_8_9_10\",\"urgencia\":true,\"dataComeco\":\"2021-02-18\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 10\\/01\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 31\\/01\\/2021\\\\n - Francisco Josue Ayala Davila -> 31\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 31\\/01\\/2021\\\\n - Julio Andre Rivadeneira Salazar -> 17\\/01\\/2021\\\\n - Joel Sebastian Leiva Tapia -> 22\\/02\\/2021\\\\n - David Josue Quimis Proa\\u00f1o -> 17\\/01\\/2021\\\\n - Carlos Erick Lopez Gomez -> 17\\/01\\/2021\"}', '2021-02-23 18:41:45', '2021-02-18 14:39:18', '2021-02-23 18:41:45'),
('905cd223-40da-421f-9bdd-3babbf919199', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_1\",\"urgencia\":true,\"dataComeco\":\"2021-02-23\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\"}', '2021-02-24 15:23:48', '2021-02-23 17:43:45', '2021-02-24 15:23:48'),
('ce27433e-5f09-4f4d-a4d0-17004a22616f', 'App\\Notifications\\Atraso', 'App\\User', 2, '{\"code\":\"2_atraso_1\",\"urgencia\":true,\"dataComeco\":\"2021-02-23\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\"}', '2021-02-24 15:41:24', '2021-02-23 18:41:45', '2021-02-24 15:41:24'),
('4c7670a5-c0cf-4a0e-b9c5-89a01bcc6126', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_1_2\",\"urgencia\":true,\"dataComeco\":\"2021-02-24\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 17\\/01\\/2021\"}', '2021-02-24 15:41:36', '2021-02-24 15:23:48', '2021-02-24 15:41:36'),
('084779cf-704a-481d-bc23-5075f5c968d5', 'App\\Notifications\\Atraso', 'App\\User', 2, '{\"code\":\"2_atraso_1_2_3\",\"urgencia\":true,\"dataComeco\":\"2021-02-24\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 17\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\"}', '2021-02-24 17:16:56', '2021-02-24 15:41:24', '2021-02-24 17:16:56'),
('ea3f3e46-55cd-4b5f-b6c9-49a8c1d71d24', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_1_2_3\",\"urgencia\":true,\"dataComeco\":\"2021-02-24\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 17\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\"}', '2021-02-24 16:19:13', '2021-02-24 15:41:36', '2021-02-24 16:19:13'),
('c08fddf3-00dc-4f71-97e6-932f09f061c8', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_1_2_3_4\",\"urgencia\":true,\"dataComeco\":\"2021-02-24\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 17\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 17\\/01\\/2021\"}', '2021-04-07 08:53:46', '2021-02-24 16:19:13', '2021-04-07 08:53:46'),
('d09ecf65-5231-40c7-9010-fbc2252a328c', 'App\\Notifications\\Atraso', 'App\\User', 2, '{\"code\":\"2_atraso_1_2_3_4\",\"urgencia\":true,\"dataComeco\":\"2021-02-24\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 17\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 17\\/01\\/2021\"}', NULL, '2021-02-24 17:16:56', '2021-02-24 17:16:56'),
('ea93511e-e7da-43c2-ba99-58d2c50f4710', 'App\\Notifications\\Atraso', 'App\\User', 6, '{\"code\":\"6_atraso_1_2_3_4\",\"urgencia\":true,\"dataComeco\":\"2021-02-25\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 23\\/02\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 17\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 17\\/01\\/2021\"}', '2021-04-07 09:23:41', '2021-02-25 16:00:42', '2021-04-07 09:23:41'),
('08465d22-104e-4873-9a73-d1cd4d7c53c9', 'App\\Notifications\\Atraso', 'App\\User', 7, '{\"code\":\"7_atraso_1_2_3_4\",\"urgencia\":true,\"dataComeco\":\"2021-03-22\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 15\\/03\\/2021\\\\n - Domenica Anabel Guacho Guaman -> 17\\/01\\/2021\\\\n - Simon Sarmiento Mora -> 17\\/01\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 17\\/01\\/2021\"}', NULL, '2021-03-22 14:13:57', '2021-03-22 14:13:57'),
('85ffe21c-92a5-4caf-9749-1e5f1977cdbc', 'App\\Notifications\\Atraso', 'App\\User', 1, '{\"code\":\"1_atraso_1\",\"urgencia\":true,\"dataComeco\":\"2021-04-07\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 01\\/04\\/2021\"}', NULL, '2021-04-07 08:53:46', '2021-04-07 08:53:46'),
('1a86001c-e620-4db9-ba97-637061004ca8', 'App\\Notifications\\Atraso', 'App\\User', 6, '{\"code\":\"6_atraso_1\",\"urgencia\":true,\"dataComeco\":\"2021-04-07\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 01\\/04\\/2021\"}', '2021-04-07 12:34:05', '2021-04-07 09:23:41', '2021-04-07 12:34:05'),
('4d8bb9b9-5786-40d9-9d38-ff0ebc690633', 'App\\Notifications\\Atraso', 'App\\User', 6, '{\"code\":\"6_atraso_1_3\",\"urgencia\":true,\"dataComeco\":\"2021-04-07\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 01\\/04\\/2021\\\\n - Simon Sarmiento Mora -> 07\\/04\\/2021\"}', '2021-04-07 12:50:14', '2021-04-07 12:34:05', '2021-04-07 12:50:14'),
('77850e63-3eed-431e-85d2-5b955a5f3e21', 'App\\Notifications\\Atraso', 'App\\User', 6, '{\"code\":\"6_atraso_1_3_4\",\"urgencia\":true,\"dataComeco\":\"2021-04-07\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 01\\/04\\/2021\\\\n - Simon Sarmiento Mora -> 07\\/04\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 01\\/04\\/2021\"}', '2021-04-07 13:26:13', '2021-04-07 12:50:14', '2021-04-07 13:26:13'),
('2d4efc70-796d-44bc-babf-80582bf408db', 'App\\Notifications\\Atraso', 'App\\User', 6, '{\"code\":\"6_atraso_1_3_4_5_6\",\"urgencia\":true,\"dataComeco\":\"2021-04-07\",\"tipo\":\"Atraso\",\"dataInicio\":null,\"dataFim\":null,\"assunto\":\"Clientes com documentos ou pagamentos em atraso!\",\"descricao\":\"Clientes: \\\\n - Francisco Josue Ayala Davila -> 01\\/04\\/2021\\\\n - Simon Sarmiento Mora -> 07\\/04\\/2021\\\\n - Emely Cecilia Ordo\\u00f1ez Lam -> 01\\/04\\/2021\\\\n - Valentina Avila -> 01\\/04\\/2021\\\\n - Julio Andre Rivadeneira Salazar -> 07\\/03\\/2021\"}', NULL, '2021-04-07 13:26:13', '2021-04-07 13:26:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pago_responsabilidade`
--

CREATE TABLE `pago_responsabilidade` (
  `idPagoResp` bigint(20) UNSIGNED NOT NULL,
  `beneficiario` varchar(255) NOT NULL,
  `tipo_beneficiario` enum('Cliente','Agente','Subagente','UniPrincipal','UniSecundaria','Fornecedor') NOT NULL,
  `valorPago` decimal(18,2) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `dataPagamento` date NOT NULL,
  `comprovativoPagamento` varchar(255) DEFAULT NULL,
  `idResponsabilidade` bigint(20) UNSIGNED NOT NULL,
  `idConta` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pago_responsabilidade`
--

INSERT INTO `pago_responsabilidade` (`idPagoResp`, `beneficiario`, `tipo_beneficiario`, `valorPago`, `descricao`, `observacoes`, `dataPagamento`, `comprovativoPagamento`, `idResponsabilidade`, `idConta`, `created_at`, `updated_at`) VALUES
(1, 'Universidade da Beira Interior', 'UniPrincipal', '0.00', 'Pagamento a universidade Universidade da Beira Interior.', 'pagamento teste', '2020-12-28', NULL, 1, 2, '2020-12-28 17:18:36', '2020-12-28 17:19:54'),
(2, 'Silvana Garces', 'Agente', '100.00', 'Pagamento ao agente Silvana Garces.', 'Javier Fat.120 (100€ de 500€)', '2021-01-13', 'pagamento-silvana-1-fase-registo-programa-comprovativo-76.pdf', 76, 1, '2021-02-23 17:54:30', '2021-02-23 17:54:30'),
(3, 'Universidade da Beira Interior', 'UniPrincipal', '15.00', 'Pagamento a universidade Universidade da Beira Interior.', 'Pag. Inscrição no Ano Zero UBI', '2021-02-16', 'pagamento-universidade-da-beira-interior-1-fase-registo-programa-comprovativo-76.pdf', 76, 1, '2021-02-23 17:58:38', '2021-02-23 17:58:38'),
(4, 'Universidade da Beira Interior', 'UniPrincipal', '25.00', 'Pagamento Matricula Ano Zero', NULL, '2021-02-19', 'pagamento-universidade-da-beira-interior-1-fase-registo-programa-comprovativo-76.pdf', 76, 1, '2021-02-23 18:01:28', '2021-02-23 18:01:28'),
(5, 'Universidade da Beira Interior', 'UniPrincipal', '40.00', 'Pag. Insc. no Ano Zero UBI - 15,00€ + Pag. Matricula Ano Zero - 25,00€', 'Pag. Insc. no Ano Zero UBI - 15,00€ + Pag. Matricula Ano Zero - 25,00€', '2021-02-19', NULL, 76, 1, '2021-02-23 18:04:14', '2021-02-23 18:04:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipo` enum('Licenciatura','Mestrado','Doutoramento','Curso de Verão','Estágio Profissional','Transferência de Curso','Curso Indiomas','Erasmus','Pré-Universitário','Seguro','Serviços Estudar Portugal','Exames','Pré+Exame+Licenciatura','Pré+Licenciatura','Exame+Licenciatura') NOT NULL,
  `anoAcademico` varchar(255) NOT NULL,
  `valorTotal` decimal(18,2) NOT NULL,
  `valorTotalAgente` decimal(18,2) NOT NULL,
  `valorTotalSubAgente` decimal(18,2) DEFAULT NULL,
  `estado` enum('Pendente','Pago','Dívida','Crédito') NOT NULL DEFAULT 'Pendente',
  `slug` varchar(191) DEFAULT NULL,
  `idAgente` bigint(20) UNSIGNED NOT NULL,
  `idSubAgente` bigint(20) UNSIGNED DEFAULT NULL,
  `idCliente` bigint(20) UNSIGNED NOT NULL,
  `idUniversidade1` bigint(20) UNSIGNED NOT NULL,
  `idUniversidade2` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `descricao`, `tipo`, `anoAcademico`, `valorTotal`, `valorTotalAgente`, `valorTotalSubAgente`, `estado`, `slug`, `idAgente`, `idSubAgente`, `idCliente`, `idUniversidade1`, `idUniversidade2`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pré-Universitário UBI', 'Pré-Universitário', '2021/2022', '4725.00', '100.00', NULL, 'Dívida', 'pre-universitario-ubi', 2, NULL, 2, 1, NULL, '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(2, 'Pré-Universitário UBI', 'Pré-Universitário', '2021/2022', '4725.00', '100.00', NULL, 'Dívida', 'pre-universitario-ubi-1', 1, NULL, 1, 1, NULL, '2020-12-09 17:45:12', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(3, 'Pré-Universitário UBI', 'Pré-Universitário', '2021/2022', '4725.00', '0.00', NULL, 'Dívida', 'pre-universitario-ubi-2', 1, NULL, 3, 1, NULL, '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(4, 'Pré-Universitário UBI', 'Pré-Universitário', '2021/2022', '4725.00', '100.00', NULL, 'Dívida', 'pre-universitario-ubi-3', 1, NULL, 4, 1, NULL, '2020-12-09 18:29:41', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(5, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '4195.00', '0.00', NULL, 'Dívida', 'pre-universitario-licenciatura', 1, NULL, 2, 1, 2, '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(6, 'Seguro Anual', 'Licenciatura', '2021/2022', '450.00', '0.00', NULL, 'Dívida', 'seguro-anual', 1, NULL, 2, 1, NULL, '2021-01-19 17:15:42', '2021-02-22 18:44:29', '2021-02-22 18:44:29'),
(7, 'Licenciatura UALG', 'Licenciatura', '2021/2022', '525.00', '0.00', NULL, 'Pendente', 'licenciatura-ualg', 1, NULL, 2, 2, NULL, '2021-01-19 17:16:41', '2021-02-22 18:44:25', '2021-02-22 18:44:25'),
(8, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '4195.00', '400.00', NULL, 'Dívida', 'pre-universitario-licenciatura-1', 1, NULL, 1, 1, 2, '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(9, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '4195.00', '400.00', NULL, 'Dívida', 'pre-universitario-licenciatura-2', 1, NULL, 1, 1, 2, '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(10, 'Licenciatura UALG', 'Licenciatura', '2021/2022', '525.00', '0.00', NULL, 'Pendente', 'licenciatura-ualg-1', 1, NULL, 1, 2, NULL, '2021-01-19 17:43:11', '2021-02-22 18:37:43', '2021-02-22 18:37:43'),
(11, 'Seguro Anual', 'Licenciatura', '2021/2022', '450.00', '0.00', NULL, 'Dívida', 'seguro-anual-1', 1, NULL, 1, 2, NULL, '2021-01-19 17:43:52', '2021-02-22 18:37:39', '2021-02-22 18:37:39'),
(12, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '4195.00', '400.00', NULL, 'Dívida', 'pre-universitario-licenciatura-3', 1, NULL, 3, 1, NULL, '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(13, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '1050.00', '100.00', NULL, 'Dívida', 'pre-universitario-licenciatura-4', 1, NULL, 1, 2, NULL, '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(14, 'Seguro Anual', 'Licenciatura', '2021/2022', '450.00', '0.00', NULL, 'Dívida', 'seguro-anual-2', 1, NULL, 3, 1, NULL, '2021-01-20 18:05:24', '2021-02-22 18:44:57', '2021-02-22 18:44:57'),
(15, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '4195.00', '400.00', NULL, 'Dívida', 'pre-universitario-licenciatura-5', 1, NULL, 6, 1, NULL, '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(16, 'Seguro Anual', 'Licenciatura', '2021/2022', '450.00', '0.00', NULL, 'Dívida', 'seguro-anual-3', 1, NULL, 6, 1, NULL, '2021-01-20 18:18:22', '2021-02-22 18:45:31', '2021-02-22 18:45:31'),
(17, 'Licenciatura UALG - completa', 'Licenciatura', '2021/2022', '4510.00', '300.00', NULL, 'Dívida', 'licenciatura-ualg-completa', 1, NULL, 8, 2, 1, '2021-01-20 18:54:21', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(18, 'Seguro Anual', 'Licenciatura', '2021/2022', '450.00', '0.00', NULL, 'Pendente', 'seguro-anual-4', 1, NULL, 8, 2, NULL, '2021-01-20 18:55:39', '2021-02-22 18:45:55', '2021-02-22 18:45:55'),
(19, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '1295.00', '0.00', NULL, 'Dívida', 'pre-universitario-licenciatura-6', 1, NULL, 9, 1, NULL, '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(20, 'Seguro Anual', 'Licenciatura', '2021/2022', '450.00', '0.00', NULL, 'Dívida', 'seguro-anual-5', 1, NULL, 9, 1, NULL, '2021-01-20 19:13:44', '2021-02-22 18:46:11', '2021-02-22 18:46:11'),
(21, 'Pré Universitário + Licenciatura', 'Pré-Universitário', '2021/2022', '1295.00', '0.00', NULL, 'Dívida', 'pre-universitario-licenciatura-7', 1, NULL, 10, 1, NULL, '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(22, 'Seguro Anual', 'Licenciatura', '2021/2022', '450.00', '0.00', NULL, 'Dívida', 'seguro-anual-6', 1, NULL, 10, 1, NULL, '2021-01-22 11:39:36', '2021-02-22 18:46:26', '2021-02-22 18:46:26'),
(23, 'Serviços Estudar Portugal', 'Serviços Estudar Portugal', '2021/2022', '1250.00', '400.00', NULL, 'Dívida', 'servicos-estudar-portugal', 1, NULL, 1, 1, NULL, '2021-02-23 17:24:07', '2021-03-24 17:34:32', '2021-03-24 17:34:32'),
(24, 'Pré-Universitário UBI', 'Pré-Universitário', '2021/2022', '2195.00', '0.00', NULL, 'Dívida', 'pre-universitario-ubi-4', 1, NULL, 1, 1, NULL, '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(25, 'Seguro', 'Seguro', '2021/2022', '450.00', '0.00', NULL, 'Pendente', 'seguro', 1, NULL, 1, 1, NULL, '2021-02-23 17:36:55', '2021-03-24 17:34:28', '2021-03-24 17:34:28'),
(26, 'Serviços Estudar Portugal', 'Serviços Estudar Portugal', '2021/2022', '1250.00', '400.00', NULL, 'Dívida', 'servicos-estudar-portugal-1', 1, NULL, 2, 2, NULL, '2021-02-24 14:59:13', '2021-03-24 17:34:10', '2021-03-24 17:34:10'),
(27, 'Seguro', 'Seguro', '2021/2022', '450.00', '0.00', NULL, 'Pendente', 'seguro-1', 1, NULL, 2, 2, NULL, '2021-02-24 15:00:21', '2021-03-24 17:34:07', '2021-03-24 17:34:07'),
(28, 'Licenciatura UALG', 'Licenciatura', '2021/2022', '3135.00', '0.00', NULL, 'Dívida', 'licenciatura-ualg-2', 1, NULL, 2, 2, NULL, '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(29, 'Serviços Estudar Portugal', 'Serviços Estudar Portugal', '2021/2022', '1250.00', '400.00', NULL, 'Dívida', 'servicos-estudar-portugal-2', 1, NULL, 3, 1, NULL, '2021-02-24 15:35:56', '2021-03-24 17:33:51', '2021-03-24 17:33:51'),
(30, 'Pré-Universitário UBI', 'Pré-Universitário', '2021/2022', '2195.00', '0.00', NULL, 'Dívida', 'pre-universitario-ubi-5', 1, NULL, 3, 1, NULL, '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(31, 'Seguro', 'Seguro', '2021/2022', '450.00', '0.00', NULL, 'Pendente', 'seguro-2', 1, NULL, 3, 1, NULL, '2021-02-24 15:41:09', '2021-03-24 17:33:48', '2021-03-24 17:33:48'),
(32, 'Serviços Estudar Portugal', 'Serviços Estudar Portugal', '2021/2022', '1250.00', '400.00', NULL, 'Dívida', 'servicos-estudar-portugal-3', 1, NULL, 4, 1, NULL, '2021-02-24 16:15:34', '2021-03-24 17:33:32', '2021-03-24 17:33:32'),
(33, 'Pré-Universitário UBI', 'Pré-Universitário', '2021/2022', '2195.00', '0.00', NULL, 'Dívida', 'pre-universitario-ubi-6', 1, NULL, 4, 1, NULL, '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(34, 'Seguro', 'Seguro', '2021/2022', '450.00', '0.00', NULL, 'Pendente', 'seguro-3', 1, NULL, 4, 1, NULL, '2021-02-24 16:18:03', '2021-03-24 17:33:28', '2021-03-24 17:33:28'),
(35, 'Pré-Universitário UBI - Online', 'Pré-Universitário', '2021/2022', '1195.00', '0.00', NULL, 'Dívida', 'pre-universitario-ubi-online', 1, NULL, 1, 1, NULL, '2021-03-09 10:47:38', '2021-03-24 17:34:24', '2021-03-24 17:34:24'),
(36, 'Licenciatura UALG', 'Licenciatura', '2021/2022', '3135.00', '0.00', NULL, 'Dívida', 'licenciatura-ualg-3', 1, NULL, 1, 2, NULL, '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(37, 'Pré-Universitário UBI - Online', 'Pré-Universitário', '2021/2022', '1195.00', '0.00', NULL, 'Dívida', 'pre-universitario-ubi-online-1', 1, NULL, 3, 1, NULL, '2021-03-09 11:19:54', '2021-03-24 17:33:44', '2021-03-24 17:33:44'),
(38, 'Licenciatura UBI', 'Licenciatura', '2021/2022', '3000.00', '0.00', NULL, 'Dívida', 'licenciatura-ubi', 1, NULL, 3, 1, NULL, '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(39, 'Pré-Universitário UBI - Online', 'Pré-Universitário', '2021/2022', '1195.00', '0.00', NULL, 'Dívida', 'pre-universitario-ubi-online-2', 1, NULL, 4, 1, NULL, '2021-03-09 11:40:22', '2021-03-24 17:33:25', '2021-03-24 17:33:25'),
(40, 'Pré-Universitário UBI - Online', 'Pré-Universitário', '2021/2022', '200.00', '110.00', NULL, 'Dívida', 'pre-universitario-ubi-online-3', 1, NULL, 1, 1, NULL, '2021-03-30 15:11:42', '2021-03-30 15:12:04', '2021-03-30 15:12:04'),
(41, 'Pré + Licenciatura - UALG', 'Pré+Licenciatura', '2021/2022', '6030.00', '500.00', NULL, 'Pendente', 'pre-licenciatura-ualg', 1, NULL, 1, 2, NULL, '2021-04-06 14:44:39', '2021-04-06 14:50:21', NULL),
(42, 'Pré + Exame + Licenciatura - UBI', 'Pré+Exame+Licenciatura', '2021/2022', '5955.00', '500.00', NULL, 'Pendente', 'pre-exame-licenciatura-ubi', 1, NULL, 3, 1, NULL, '2021-04-07 09:57:01', '2021-04-07 10:02:00', NULL),
(43, 'Pré + Exame + Licenciatura - UALG', 'Pré+Exame+Licenciatura', '2021/2022', '6090.00', '500.00', NULL, 'Pendente', 'pre-exame-licenciatura-ualg', 1, NULL, 4, 2, NULL, '2021-04-07 12:42:50', '2021-04-07 12:46:25', NULL),
(44, 'Pré + Licenciatura - UALG', 'Pré+Licenciatura', '2021/2022', '6030.00', '500.00', NULL, 'Pendente', 'pre-licenciatura-ualg-1', 3, NULL, 5, 2, NULL, '2021-04-07 13:03:42', '2021-04-07 13:05:56', NULL),
(45, 'Pré + Licenciatura - UBI', 'Pré+Licenciatura', '2021/2022', '5895.00', '500.00', NULL, 'Pendente', 'pre-licenciatura-ubi', 1, NULL, 6, 1, NULL, '2021-04-07 13:20:06', '2021-04-07 13:25:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_stock`
--

CREATE TABLE `produto_stock` (
  `idProdutoStock` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipoProduto` enum('Licenciatura','Mestrado','Doutoramento','Curso de Verão','Estágio Profissional','Transferência de Curso','Curso Indiomas','Erasmus','Pré-Universitário','Seguro','Serviços Estudar Portugal','Exames','Pré+Exame+Licenciatura','Pré+Licenciatura','Exame+Licenciatura') NOT NULL,
  `anoAcademico` varchar(255) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto_stock`
--

INSERT INTO `produto_stock` (`idProdutoStock`, `descricao`, `tipoProduto`, `anoAcademico`, `slug`, `created_at`, `updated_at`) VALUES
(10, 'Serviços Estudar Portugal', 'Serviços Estudar Portugal', '2021/2022', 'servicos-estudar-portugal', '2021-02-23 17:03:38', '2021-02-23 17:03:38'),
(11, 'Seguro', 'Seguro', '2021/2022', 'seguro', '2021-02-23 17:03:57', '2021-02-23 17:03:57'),
(12, 'Licenciatura UALG', 'Licenciatura', '2021/2022', 'licenciatura-ualg', '2021-02-24 15:01:00', '2021-02-24 15:01:00'),
(14, 'Licenciatura UBI', 'Licenciatura', '2021/2022', 'licenciatura-ubi', '2021-03-09 11:24:07', '2021-03-09 11:24:07'),
(15, 'Pré + Exame + Licenciatura - UBI', 'Pré+Exame+Licenciatura', '2021/2022', 'pre-exame-licenciatura-ubi', '2021-04-06 13:55:34', '2021-04-06 13:58:05'),
(16, 'Pré + Exame + Licenciatura - UALG', 'Pré+Exame+Licenciatura', '2021/2022', 'pre-exame-licenciatura-ualg', '2021-04-06 14:07:40', '2021-04-06 14:07:40'),
(17, 'Pré + Licenciatura - UBI', 'Pré+Licenciatura', '2021/2022', 'pre-licenciatura-ubi', '2021-04-06 14:10:52', '2021-04-06 14:14:05'),
(18, 'Pré + Licenciatura - UALG', 'Pré+Licenciatura', '2021/2022', 'pre-licenciatura-ualg', '2021-04-06 14:14:36', '2021-04-06 14:14:36'),
(19, 'Exame + Licenciatura - UBI', 'Exame+Licenciatura', '2021/2022', 'exame-licenciatura-ubi', '2021-04-06 14:16:39', '2021-04-06 14:16:39'),
(20, 'Exame + Licenciatura - UALG', 'Exame+Licenciatura', '2021/2022', 'exame-licenciatura-ualg', '2021-04-06 14:19:52', '2021-04-06 14:19:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorio_problema`
--

CREATE TABLE `relatorio_problema` (
  `idRelatorioProblema` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `telemovel` int(11) DEFAULT NULL,
  `screenshot` varchar(191) DEFAULT NULL,
  `relatorio` text NOT NULL,
  `estado` enum('Pendente','Em curso','Resolvido') NOT NULL DEFAULT 'Pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rel_forn_resp`
--

CREATE TABLE `rel_forn_resp` (
  `idRelacao` bigint(20) UNSIGNED NOT NULL,
  `valor` decimal(18,2) NOT NULL,
  `verificacaoPago` tinyint(1) NOT NULL DEFAULT 0,
  `estado` enum('Pendente','Pago','Dívida') NOT NULL DEFAULT 'Pendente',
  `dataVencimento` datetime DEFAULT NULL,
  `idResponsabilidade` bigint(20) UNSIGNED NOT NULL,
  `idFornecedor` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rel_forn_resp`
--

INSERT INTO `rel_forn_resp` (`idRelacao`, `valor`, `verificacaoPago`, `estado`, `dataVencimento`, `idResponsabilidade`, `idFornecedor`, `created_at`, `updated_at`) VALUES
(1, '450.00', 0, 'Dívida', '2021-02-20 00:00:00', 26, 1, '2021-01-19 17:15:42', '2021-04-06 23:00:01'),
(2, '492.00', 0, 'Pendente', '2021-04-10 00:00:00', 30, 5, '2021-01-19 17:28:05', '2021-01-19 17:28:05'),
(3, '450.00', 0, 'Pendente', '2021-04-30 00:00:00', 32, 3, '2021-01-19 17:28:05', '2021-01-19 17:28:05'),
(4, '492.00', 0, 'Pendente', '2021-04-10 00:00:00', 35, 5, '2021-01-19 17:42:22', '2021-01-19 17:42:22'),
(5, '58.00', 0, 'Dívida', '2021-03-30 00:00:00', 35, 6, '2021-01-19 17:42:22', '2021-04-06 23:00:01'),
(6, '450.00', 0, 'Pendente', '2021-04-30 00:00:00', 37, 3, '2021-01-19 17:42:22', '2021-01-19 17:42:22'),
(7, '450.00', 0, 'Dívida', '2021-02-20 00:00:00', 39, 1, '2021-01-19 17:43:52', '2021-04-06 23:00:01'),
(8, '492.00', 0, 'Pendente', '2021-04-10 00:00:00', 42, 5, '2021-01-19 17:50:54', '2021-01-19 17:50:54'),
(9, '58.00', 0, 'Dívida', '2021-03-30 00:00:00', 42, 6, '2021-01-19 17:50:54', '2021-04-06 23:00:01'),
(10, '450.00', 0, 'Pendente', '2021-04-30 00:00:00', 44, 3, '2021-01-19 17:50:54', '2021-01-19 17:50:54'),
(11, '450.00', 0, 'Dívida', '2021-02-20 00:00:00', 50, 1, '2021-01-20 18:05:24', '2021-04-06 23:00:01'),
(12, '492.00', 0, 'Pendente', '2021-04-10 00:00:00', 53, 5, '2021-01-20 18:17:46', '2021-01-20 18:17:46'),
(13, '58.00', 0, 'Dívida', '2021-03-30 00:00:00', 53, 6, '2021-01-20 18:17:46', '2021-04-06 23:00:01'),
(14, '450.00', 0, 'Pendente', '2021-04-30 00:00:00', 55, 3, '2021-01-20 18:17:46', '2021-01-20 18:17:46'),
(15, '450.00', 0, 'Dívida', '2021-02-20 00:00:00', 56, 1, '2021-01-20 18:18:22', '2021-04-06 23:00:01'),
(16, '100.00', 0, 'Dívida', '2021-03-01 00:00:00', 58, 6, '2021-01-20 18:54:22', '2021-04-06 23:00:01'),
(17, '750.00', 0, 'Pendente', '2021-08-01 00:00:00', 60, 2, '2021-01-20 18:54:22', '2021-01-20 18:54:22'),
(18, '630.00', 0, 'Pendente', '2021-08-01 00:00:00', 61, 2, '2021-01-20 18:54:22', '2021-01-20 18:54:22'),
(19, '492.00', 0, 'Pendente', '2021-09-15 00:00:00', 62, 5, '2021-01-20 18:54:22', '2021-01-20 18:54:22'),
(20, '450.00', 0, 'Pendente', '2021-08-01 00:00:00', 63, 1, '2021-01-20 18:55:39', '2021-01-20 18:55:39'),
(21, '195.00', 0, 'Dívida', '2021-01-31 00:00:00', 64, 5, '2021-01-20 19:11:19', '2021-04-06 23:00:01'),
(22, '145.00', 0, 'Dívida', '2021-02-15 00:00:00', 65, 5, '2021-01-20 19:11:19', '2021-04-06 23:00:01'),
(23, '500.00', 0, 'Dívida', '2021-04-01 00:00:00', 68, 5, '2021-01-20 19:11:19', '2021-04-06 23:00:01'),
(24, '450.00', 0, 'Dívida', '2021-02-20 00:00:00', 69, 1, '2021-01-20 19:13:44', '2021-04-06 23:00:01'),
(25, '195.00', 0, 'Dívida', '2021-01-17 00:00:00', 70, 5, '2021-01-22 11:31:50', '2021-04-06 23:00:01'),
(26, '145.00', 0, 'Dívida', '2021-01-31 00:00:00', 71, 5, '2021-01-22 11:31:50', '2021-04-06 23:00:01'),
(27, '500.00', 0, 'Dívida', '2021-04-01 00:00:00', 74, 5, '2021-01-22 11:31:50', '2021-04-06 23:00:01'),
(28, '450.00', 0, 'Dívida', '2021-02-20 00:00:00', 75, 1, '2021-01-22 11:39:36', '2021-04-06 23:00:01'),
(30, '230.00', 0, 'Pendente', '2021-04-30 00:00:00', 84, 1, '2021-02-23 17:36:55', '2021-02-23 17:36:55'),
(31, '230.00', 0, 'Pendente', '2021-08-01 00:00:00', 88, 1, '2021-02-24 15:00:21', '2021-02-24 15:00:21'),
(32, '615.00', 0, 'Dívida', '2021-03-10 00:00:00', 98, 5, '2021-02-24 15:40:23', '2021-04-06 23:00:01'),
(33, '450.00', 0, 'Pendente', '2021-04-30 00:00:00', 99, 3, '2021-02-24 15:40:23', '2021-02-24 15:40:23'),
(34, '230.00', 0, 'Pendente', '2021-05-15 00:00:00', 102, 1, '2021-02-24 15:41:09', '2021-02-24 15:41:09'),
(36, '450.00', 0, 'Pendente', NULL, 81, 3, '2021-02-24 16:02:03', '2021-02-24 16:02:03'),
(37, '615.00', 0, 'Dívida', '2021-03-10 00:00:00', 107, 5, '2021-02-24 16:17:25', '2021-04-06 23:00:01'),
(38, '450.00', 0, 'Pendente', '2021-04-30 00:00:00', 108, 3, '2021-02-24 16:17:25', '2021-02-24 16:17:25'),
(39, '230.00', 0, 'Pendente', '2021-05-15 00:00:00', 111, 1, '2021-02-24 16:18:03', '2021-02-24 16:18:03'),
(40, '750.00', 0, 'Pendente', '2021-10-01 00:00:00', 116, 2, '2021-03-09 11:09:47', '2021-03-09 11:09:47'),
(41, '490.00', 0, 'Pendente', '2021-10-01 00:00:00', 117, 2, '2021-03-09 11:09:47', '2021-03-09 11:09:47'),
(42, '750.00', 0, 'Pendente', '2021-10-01 00:00:00', 123, 3, '2021-03-09 11:36:40', '2021-03-09 11:36:40'),
(43, '261.00', 0, 'Pendente', '2021-10-01 00:00:00', 124, 3, '2021-03-09 11:36:40', '2021-03-09 11:36:40'),
(44, '615.00', 0, 'Dívida', '2021-02-22 00:00:00', 132, 5, '2021-04-06 14:44:39', '2021-04-06 23:00:01'),
(45, '750.00', 0, 'Pendente', '2021-06-20 00:00:00', 135, 2, '2021-04-06 14:44:39', '2021-04-06 14:44:39'),
(46, '230.00', 0, 'Pendente', '2021-08-15 00:00:00', 137, 1, '2021-04-06 14:44:39', '2021-04-06 14:44:39'),
(47, '485.00', 0, 'Pendente', '2021-10-10 00:00:00', 138, 2, '2021-04-06 14:44:39', '2021-04-06 14:44:39'),
(48, '615.00', 0, 'Pendente', '2021-02-22 00:00:00', 141, 5, '2021-04-07 09:57:01', '2021-04-07 09:57:01'),
(49, '750.00', 0, 'Pendente', '2021-10-01 00:00:00', 144, 3, '2021-04-07 09:57:01', '2021-04-07 09:57:01'),
(50, '125.00', 0, 'Pendente', '2021-10-01 00:00:00', 145, 3, '2021-04-07 09:57:01', '2021-04-07 09:57:01'),
(51, '230.00', 0, 'Pendente', '2021-08-30 00:00:00', 146, 1, '2021-04-07 09:57:01', '2021-04-07 09:57:01'),
(52, '250.00', 0, 'Pendente', '2021-10-01 00:00:00', 147, 3, '2021-04-07 09:57:01', '2021-04-07 09:57:01'),
(53, '615.00', 0, 'Pendente', '2021-02-22 00:00:00', 150, 5, '2021-04-07 12:42:50', '2021-04-07 12:42:50'),
(54, '750.00', 0, 'Pendente', '2021-10-01 00:00:00', 153, 2, '2021-04-07 12:42:50', '2021-04-07 12:42:50'),
(55, '230.00', 0, 'Pendente', '2021-08-15 00:00:00', 155, 1, '2021-04-07 12:42:50', '2021-04-07 12:42:50'),
(56, '485.00', 0, 'Pendente', '2021-10-01 00:00:00', 156, 2, '2021-04-07 12:42:50', '2021-04-07 12:42:50'),
(57, '615.00', 0, 'Pendente', '2021-02-22 00:00:00', 159, 5, '2021-04-07 13:03:43', '2021-04-07 13:03:43'),
(58, '750.00', 0, 'Pendente', '2021-10-01 00:00:00', 162, 2, '2021-04-07 13:03:43', '2021-04-07 13:03:43'),
(59, '230.00', 0, 'Pendente', '2021-08-15 00:00:00', 164, 1, '2021-04-07 13:03:43', '2021-04-07 13:03:43'),
(60, '485.00', 0, 'Pendente', '2021-10-01 00:00:00', 165, 2, '2021-04-07 13:03:43', '2021-04-07 13:03:43'),
(61, '615.00', 0, 'Pendente', '2021-02-22 00:00:00', 168, 5, '2021-04-07 13:20:06', '2021-04-07 13:20:06'),
(62, '750.00', 0, 'Pendente', '2021-10-01 00:00:00', 171, 3, '2021-04-07 13:20:06', '2021-04-07 13:20:06'),
(63, '125.00', 0, 'Pendente', '2021-10-01 00:00:00', 172, 3, '2021-04-07 13:20:06', '2021-04-07 13:20:06'),
(64, '230.00', 0, 'Pendente', '2021-08-15 00:00:00', 173, 1, '2021-04-07 13:20:06', '2021-04-07 13:20:06'),
(65, '250.00', 0, 'Pendente', '2021-10-01 00:00:00', 174, 3, '2021-04-07 13:20:06', '2021-04-07 13:20:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsabilidade`
--

CREATE TABLE `responsabilidade` (
  `idResponsabilidade` bigint(20) UNSIGNED NOT NULL,
  `valorCliente` decimal(18,2) DEFAULT NULL,
  `valorAgente` decimal(18,2) DEFAULT NULL,
  `valorUniversidade1` decimal(18,2) DEFAULT NULL,
  `dataVencimentoCliente` datetime DEFAULT NULL,
  `dataVencimentoAgente` datetime DEFAULT NULL,
  `dataVencimentoUni1` datetime DEFAULT NULL,
  `verificacaoPagoCliente` tinyint(1) NOT NULL DEFAULT 0,
  `verificacaoPagoAgente` tinyint(1) NOT NULL DEFAULT 0,
  `verificacaoPagoUni1` tinyint(1) NOT NULL DEFAULT 0,
  `idCliente` bigint(20) UNSIGNED NOT NULL,
  `idAgente` bigint(20) UNSIGNED NOT NULL,
  `idUniversidade1` bigint(20) UNSIGNED NOT NULL,
  `idFase` bigint(20) UNSIGNED NOT NULL,
  `estado` enum('Pendente','Pago','Dívida') NOT NULL DEFAULT 'Pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `responsabilidade`
--

INSERT INTO `responsabilidade` (`idResponsabilidade`, `valorCliente`, `valorAgente`, `valorUniversidade1`, `dataVencimentoCliente`, `dataVencimentoAgente`, `dataVencimentoUni1`, `verificacaoPagoCliente`, `verificacaoPagoAgente`, `verificacaoPagoUni1`, `idCliente`, `idAgente`, `idUniversidade1`, `idFase`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '95.00', '100.00', '55.00', '2020-12-03 00:00:00', '2020-12-03 00:00:00', '2021-01-02 00:00:00', 0, 0, 1, 2, 2, 1, 1, 'Dívida', '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(2, '650.00', NULL, '900.00', '2020-12-20 00:00:00', NULL, '2021-01-15 00:00:00', 0, 0, 0, 2, 2, 1, 2, 'Dívida', '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(3, '1250.00', NULL, NULL, '2020-12-31 00:00:00', NULL, NULL, 0, 0, 0, 2, 2, 1, 3, 'Dívida', '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(4, '450.00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 1, 4, 'Pendente', '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(5, '1225.00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 2, 2, 1, 5, 'Pendente', '2020-12-03 15:51:51', '2021-01-19 16:58:35', '2021-01-19 16:58:35'),
(6, '95.00', '100.00', '55.00', '2020-11-02 00:00:00', '2020-11-02 00:00:00', '2021-01-15 00:00:00', 0, 0, 0, 1, 1, 1, 6, 'Dívida', '2020-12-09 17:45:12', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(7, '1550.00', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 1, 7, 'Pendente', '2020-12-09 17:45:12', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(8, '350.00', NULL, '900.00', '2021-01-15 00:00:00', NULL, '2021-01-15 00:00:00', 0, 0, 0, 1, 1, 1, 8, 'Dívida', '2020-12-09 17:45:12', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 1, 9, 'Pendente', '2020-12-09 17:45:13', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(10, '275.00', NULL, '950.00', '2021-03-20 00:00:00', NULL, '2021-04-30 00:00:00', 0, 0, 0, 1, 1, 1, 10, 'Pendente', '2020-12-09 17:45:13', '2021-01-19 17:22:39', '2021-01-19 17:22:39'),
(11, '95.00', NULL, '55.00', '2020-12-09 00:00:00', NULL, '2021-01-15 00:00:00', 0, 0, 0, 3, 1, 1, 11, 'Dívida', '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 12, 'Pendente', '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 13, 'Pendente', '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 14, 'Pendente', '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 15, 'Pendente', '2020-12-09 17:58:21', '2021-01-19 17:46:19', '2021-01-19 17:46:19'),
(16, '95.00', '100.00', '55.00', '2020-12-09 00:00:00', '2020-12-09 00:00:00', '2021-01-15 00:00:00', 0, 0, 0, 4, 1, 1, 16, 'Dívida', '2020-12-09 18:29:41', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 1, 17, 'Pendente', '2020-12-09 18:29:41', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(18, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 1, 18, 'Pendente', '2020-12-09 18:29:42', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(19, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 1, 19, 'Pendente', '2020-12-09 18:29:42', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 1, 20, 'Pendente', '2020-12-09 18:29:42', '2021-02-22 18:45:12', '2021-02-22 18:45:12'),
(21, '95.00', NULL, NULL, '2021-04-07 00:00:00', NULL, NULL, 0, 0, 0, 2, 1, 1, 21, 'Pendente', '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(22, '500.00', NULL, NULL, '2021-04-30 00:00:00', NULL, NULL, 0, 0, 0, 2, 1, 1, 22, 'Pendente', '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(23, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 2, 1, 1, 23, 'Pendente', '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(24, '1150.00', NULL, NULL, '2021-06-30 00:00:00', NULL, NULL, 0, 0, 0, 2, 1, 1, 24, 'Pendente', '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(25, '595.00', NULL, NULL, '2021-08-31 00:00:00', NULL, NULL, 0, 0, 0, 2, 1, 1, 25, 'Pendente', '2021-01-19 17:13:58', '2021-02-22 18:44:39', '2021-02-22 18:44:39'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 2, 1, 1, 26, 'Pendente', '2021-01-19 17:15:42', '2021-02-22 18:44:29', '2021-02-22 18:44:29'),
(27, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 2, 1, 2, 27, 'Pendente', '2021-01-19 17:16:41', '2021-02-22 18:44:25', '2021-02-22 18:44:25'),
(28, '95.00', '100.00', '55.00', '2021-04-07 00:00:00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', 0, 0, 0, 1, 1, 1, 28, 'Pendente', '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(29, '500.00', NULL, '400.00', '2021-04-30 00:00:00', NULL, '2021-02-15 00:00:00', 0, 0, 0, 1, 1, 1, 29, 'Pendente', '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(30, NULL, '200.00', NULL, NULL, '2021-03-10 00:00:00', NULL, 0, 0, 0, 1, 1, 1, 30, 'Pendente', '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(31, '1150.00', '100.00', NULL, '2021-06-30 00:00:00', '2021-04-10 00:00:00', NULL, 0, 0, 0, 1, 1, 1, 31, 'Pendente', '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(32, '595.00', NULL, NULL, '2021-08-31 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 1, 32, 'Pendente', '2021-01-19 17:28:05', '2021-01-19 17:37:34', '2021-01-19 17:37:34'),
(33, '95.00', '100.00', '55.00', '2021-04-07 00:00:00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', 0, 0, 0, 1, 1, 1, 33, 'Dívida', '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(34, '500.00', NULL, '400.00', '2021-04-30 00:00:00', NULL, '2021-02-15 00:00:00', 0, 0, 0, 1, 1, 1, 34, 'Dívida', '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(35, NULL, '200.00', NULL, NULL, '2021-03-10 00:00:00', NULL, 0, 0, 0, 1, 1, 1, 35, 'Pendente', '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(36, '1150.00', '100.00', NULL, '2021-06-30 00:00:00', '2021-04-10 00:00:00', NULL, 0, 0, 0, 1, 1, 1, 36, 'Pendente', '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(37, '595.00', NULL, NULL, '2021-08-31 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 1, 37, 'Pendente', '2021-01-19 17:42:22', '2021-02-22 18:37:53', '2021-02-22 18:37:53'),
(38, NULL, NULL, '525.00', NULL, NULL, '2021-04-30 00:00:00', 0, 0, 0, 1, 1, 2, 38, 'Pendente', '2021-01-19 17:43:11', '2021-02-22 18:37:43', '2021-02-22 18:37:43'),
(39, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 39, 'Pendente', '2021-01-19 17:43:52', '2021-02-22 18:37:39', '2021-02-22 18:37:39'),
(40, '95.00', '100.00', '55.00', '2021-04-07 00:00:00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', 0, 0, 0, 3, 1, 1, 40, 'Dívida', '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(41, '500.00', NULL, '400.00', '2021-04-30 00:00:00', NULL, '2021-02-15 00:00:00', 0, 0, 0, 3, 1, 1, 41, 'Dívida', '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(42, NULL, '200.00', NULL, NULL, '2021-03-10 00:00:00', NULL, 0, 0, 0, 3, 1, 1, 42, 'Pendente', '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(43, '1150.00', '100.00', NULL, '2021-06-30 00:00:00', '2012-04-10 00:00:00', NULL, 0, 0, 0, 3, 1, 1, 43, 'Dívida', '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(44, '595.00', NULL, NULL, '2021-08-31 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 44, 'Pendente', '2021-01-19 17:50:54', '2021-02-22 18:45:01', '2021-02-22 18:45:01'),
(45, '95.00', '100.00', '55.00', '2021-04-07 00:00:00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', 0, 0, 0, 1, 1, 2, 45, 'Pendente', '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(46, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 46, 'Pendente', '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(47, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 47, 'Pendente', '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(48, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 48, 'Pendente', '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(49, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 49, 'Pendente', '2021-01-19 21:46:44', '2021-01-19 21:54:03', '2021-01-19 21:54:03'),
(50, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 50, 'Pendente', '2021-01-20 18:05:24', '2021-02-22 18:44:57', '2021-02-22 18:44:57'),
(51, '95.00', '100.00', '55.00', '2021-04-07 00:00:00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', 0, 0, 0, 6, 1, 1, 51, 'Dívida', '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(52, '500.00', NULL, '400.00', '2021-04-30 00:00:00', NULL, '2021-02-15 00:00:00', 0, 0, 0, 6, 1, 1, 52, 'Dívida', '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(53, NULL, '200.00', NULL, NULL, '2021-03-10 00:00:00', NULL, 0, 0, 0, 6, 1, 1, 53, 'Pendente', '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(54, '1150.00', '100.00', NULL, '2021-06-30 00:00:00', '2021-04-10 00:00:00', NULL, 0, 0, 0, 6, 1, 1, 54, 'Pendente', '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(55, '595.00', NULL, NULL, '2021-08-31 00:00:00', NULL, NULL, 0, 0, 0, 6, 1, 1, 55, 'Pendente', '2021-01-20 18:17:46', '2021-02-22 18:45:35', '2021-02-22 18:45:35'),
(56, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 6, 1, 1, 56, 'Pendente', '2021-01-20 18:18:22', '2021-02-22 18:45:31', '2021-02-22 18:45:31'),
(57, '100.00', '100.00', '50.00', '2021-09-30 00:00:00', '2021-01-31 00:00:00', '2021-03-30 00:00:00', 0, 0, 0, 8, 1, 2, 57, 'Dívida', '2021-01-20 18:54:21', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(58, '650.00', NULL, NULL, '2021-09-30 00:00:00', NULL, NULL, 0, 0, 0, 8, 1, 2, 58, 'Pendente', '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(59, '550.00', '200.00', '525.00', '2021-09-30 00:00:00', '2021-04-30 00:00:00', '2021-04-15 00:00:00', 0, 0, 0, 8, 1, 2, 59, 'Pendente', '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(60, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 8, 1, 2, 60, 'Pendente', '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(61, '120.00', NULL, NULL, '2021-09-30 00:00:00', NULL, NULL, 0, 0, 0, 8, 1, 2, 61, 'Pendente', '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(62, '243.00', NULL, NULL, '2021-09-30 00:00:00', NULL, NULL, 0, 0, 0, 8, 1, 2, 62, 'Pendente', '2021-01-20 18:54:22', '2021-02-22 18:46:01', '2021-02-22 18:46:01'),
(63, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 8, 1, 2, 63, 'Pendente', '2021-01-20 18:55:39', '2021-02-22 18:45:55', '2021-02-22 18:45:55'),
(64, NULL, NULL, '55.00', NULL, NULL, '2021-01-31 00:00:00', 0, 0, 0, 9, 1, 1, 64, 'Dívida', '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(65, NULL, NULL, '400.00', NULL, NULL, '2021-02-15 00:00:00', 0, 0, 0, 9, 1, 1, 65, 'Dívida', '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(66, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 9, 1, 1, 66, 'Pendente', '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(67, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 9, 1, 1, 67, 'Pendente', '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(68, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 9, 1, 1, 68, 'Pendente', '2021-01-20 19:11:19', '2021-02-22 18:46:15', '2021-02-22 18:46:15'),
(69, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 9, 1, 1, 69, 'Pendente', '2021-01-20 19:13:44', '2021-02-22 18:46:11', '2021-02-22 18:46:11'),
(70, NULL, NULL, '55.00', NULL, NULL, '2021-01-31 00:00:00', 0, 0, 0, 10, 1, 1, 70, 'Dívida', '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(71, NULL, NULL, '400.00', NULL, NULL, '2021-02-15 00:00:00', 0, 0, 0, 10, 1, 1, 71, 'Dívida', '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(72, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 10, 1, 1, 72, 'Pendente', '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(73, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 10, 1, 1, 73, 'Pendente', '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(74, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 10, 1, 1, 74, 'Pendente', '2021-01-22 11:31:50', '2021-02-22 18:46:29', '2021-02-22 18:46:29'),
(75, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 10, 1, 1, 75, 'Pendente', '2021-01-22 11:39:36', '2021-02-22 18:46:26', '2021-02-22 18:46:26'),
(76, '110.00', '100.00', '40.00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', '2021-02-15 00:00:00', 0, 0, 0, 1, 1, 1, 76, 'Dívida', '2021-02-23 17:24:07', '2021-03-24 17:34:32', '2021-03-24 17:34:32'),
(77, '300.00', '200.00', NULL, '2021-01-31 00:00:00', '2021-01-31 00:00:00', '2021-03-15 00:00:00', 0, 0, 0, 1, 1, 1, 77, 'Dívida', '2021-02-23 17:24:07', '2021-03-24 17:34:32', '2021-03-24 17:34:32'),
(78, '400.00', '100.00', NULL, '2021-03-15 00:00:00', '2021-03-15 00:00:00', NULL, 0, 0, 0, 1, 1, 1, 78, 'Dívida', '2021-02-23 17:24:07', '2021-03-24 17:34:32', '2021-03-24 17:34:32'),
(79, NULL, NULL, '400.00', NULL, NULL, '2021-03-15 00:00:00', 0, 0, 0, 1, 1, 1, 79, 'Pendente', '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(80, '635.00', NULL, NULL, '2021-03-10 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 1, 80, 'Pendente', '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(81, '95.00', NULL, NULL, '2021-04-01 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 1, 81, 'Pendente', '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(82, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 1, 82, 'Pendente', '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(83, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 1, 83, 'Pendente', '2021-02-23 17:33:35', '2021-03-09 10:37:25', '2021-03-09 10:37:25'),
(84, '220.00', NULL, NULL, '2021-04-30 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 1, 84, 'Pendente', '2021-02-23 17:36:55', '2021-03-24 17:34:28', '2021-03-24 17:34:28'),
(85, '150.00', '100.00', NULL, '2020-11-02 00:00:00', '2020-11-02 00:00:00', NULL, 0, 0, 0, 2, 1, 2, 85, 'Dívida', '2021-02-24 14:59:13', '2021-03-24 17:34:10', '2021-03-24 17:34:10'),
(86, '550.00', '200.00', NULL, '2021-04-01 00:00:00', '2021-04-01 00:00:00', NULL, 0, 0, 0, 2, 1, 2, 86, 'Pendente', '2021-02-24 14:59:13', '2021-03-24 17:34:10', '2021-03-24 17:34:10'),
(87, '150.00', '100.00', NULL, '2021-08-31 00:00:00', '2021-08-31 00:00:00', NULL, 0, 0, 0, 2, 1, 2, 87, 'Pendente', '2021-02-24 14:59:13', '2021-03-24 17:34:10', '2021-03-24 17:34:10'),
(88, '220.00', NULL, NULL, '2021-08-01 00:00:00', NULL, NULL, 0, 0, 0, 2, 1, 2, 88, 'Pendente', '2021-02-24 15:00:21', '2021-03-24 17:34:07', '2021-03-24 17:34:07'),
(89, '575.00', NULL, '75.00', '2021-04-20 00:00:00', NULL, '2021-04-20 00:00:00', 0, 0, 0, 2, 1, 2, 89, 'Dívida', '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(90, NULL, NULL, '500.00', NULL, NULL, '2021-05-08 00:00:00', 0, 0, 0, 2, 1, 2, 90, 'Pendente', '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(91, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 2, 1, 2, 91, 'Pendente', '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(92, '260.00', NULL, NULL, '2021-10-01 00:00:00', NULL, NULL, 0, 0, 0, 2, 1, 2, 92, 'Pendente', '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(93, '485.00', NULL, NULL, '2021-09-15 00:00:00', NULL, NULL, 0, 0, 0, 2, 1, 2, 93, 'Pendente', '2021-02-24 15:18:34', '2021-03-24 17:34:01', '2021-03-24 17:34:01'),
(94, '110.00', '100.00', '40.00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', 0, 0, 0, 3, 1, 1, 94, 'Dívida', '2021-02-24 15:35:56', '2021-03-24 17:33:51', '2021-03-24 17:33:51'),
(95, '300.00', '200.00', NULL, '2021-01-31 00:00:00', '2021-01-31 00:00:00', NULL, 0, 0, 0, 3, 1, 1, 95, 'Dívida', '2021-02-24 15:35:56', '2021-03-24 17:33:51', '2021-03-24 17:33:51'),
(96, '400.00', '100.00', NULL, '2021-04-01 00:00:00', '2021-04-01 00:00:00', NULL, 0, 0, 0, 3, 1, 1, 96, 'Pendente', '2021-02-24 15:35:56', '2021-03-24 17:33:51', '2021-03-24 17:33:51'),
(97, NULL, NULL, '400.00', NULL, NULL, '2021-01-31 00:00:00', 0, 0, 0, 3, 1, 1, 97, 'Dívida', '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(98, '635.00', NULL, NULL, '2021-03-10 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 98, 'Pendente', '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(99, '95.00', NULL, NULL, '2021-04-30 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 99, 'Pendente', '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(100, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 100, 'Pendente', '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(101, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 101, 'Pendente', '2021-02-24 15:40:23', '2021-03-09 11:18:40', '2021-03-09 11:18:40'),
(102, '220.00', NULL, NULL, '2021-04-30 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 102, 'Pendente', '2021-02-24 15:41:09', '2021-03-24 17:33:48', '2021-03-24 17:33:48'),
(103, '110.00', '100.00', '40.00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', '2021-02-15 00:00:00', 0, 0, 0, 4, 1, 1, 103, 'Dívida', '2021-02-24 16:15:34', '2021-03-24 17:33:32', '2021-03-24 17:33:32'),
(104, '300.00', '200.00', NULL, '2021-01-31 00:00:00', '2021-01-31 00:00:00', NULL, 0, 0, 0, 4, 1, 1, 104, 'Dívida', '2021-02-24 16:15:34', '2021-03-24 17:33:32', '2021-03-24 17:33:32'),
(105, '400.00', '100.00', NULL, '2021-04-01 00:00:00', '2021-04-01 00:00:00', NULL, 0, 0, 0, 4, 1, 1, 105, 'Pendente', '2021-02-24 16:15:34', '2021-03-24 17:33:32', '2021-03-24 17:33:32'),
(106, NULL, NULL, '400.00', NULL, NULL, '2021-03-15 00:00:00', 0, 0, 0, 4, 1, 1, 106, 'Pendente', '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(107, '635.00', NULL, NULL, '2021-03-10 00:00:00', NULL, NULL, 0, 0, 0, 4, 1, 1, 107, 'Pendente', '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(108, '95.00', NULL, NULL, '2021-04-01 00:00:00', NULL, NULL, 0, 0, 0, 4, 1, 1, 108, 'Pendente', '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(109, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 1, 109, 'Pendente', '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(110, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 1, 110, 'Pendente', '2021-02-24 16:17:25', '2021-03-09 11:39:18', '2021-03-09 11:39:18'),
(111, '220.00', NULL, NULL, '2021-04-30 00:00:00', NULL, NULL, 0, 0, 0, 4, 1, 1, 111, 'Pendente', '2021-02-24 16:18:03', '2021-03-24 17:33:28', '2021-03-24 17:33:28'),
(112, NULL, NULL, '400.00', NULL, NULL, '2021-04-10 00:00:00', 0, 0, 0, 1, 1, 1, 112, 'Pendente', '2021-03-09 10:47:38', '2021-03-24 17:34:24', '2021-03-24 17:34:24'),
(113, '795.00', NULL, NULL, '2021-04-01 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 1, 113, 'Pendente', '2021-03-09 10:47:38', '2021-03-24 17:34:24', '2021-03-24 17:34:24'),
(114, '575.00', NULL, '75.00', '2021-03-07 00:00:00', NULL, '2021-04-20 00:00:00', 0, 0, 0, 1, 1, 2, 114, 'Dívida', '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(115, NULL, NULL, '500.00', NULL, NULL, '2021-05-08 00:00:00', 0, 0, 0, 1, 1, 2, 115, 'Pendente', '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(116, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 116, 'Pendente', '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(117, '260.00', NULL, NULL, '2021-10-01 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 2, 117, 'Pendente', '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(118, '485.00', NULL, NULL, '2021-09-01 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 2, 118, 'Pendente', '2021-03-09 11:09:47', '2021-03-24 17:34:21', '2021-03-24 17:34:21'),
(119, NULL, NULL, '400.00', NULL, NULL, '2021-04-10 00:00:00', 0, 0, 0, 3, 1, 1, 119, 'Pendente', '2021-03-09 11:19:54', '2021-03-24 17:33:44', '2021-03-24 17:33:44'),
(120, '795.00', NULL, NULL, '2021-04-15 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 120, 'Pendente', '2021-03-09 11:19:54', '2021-03-24 17:33:44', '2021-03-24 17:33:44'),
(121, '595.00', NULL, '55.00', '2021-05-10 00:00:00', NULL, '2021-05-10 00:00:00', 0, 0, 0, 3, 1, 1, 121, 'Pendente', '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(122, NULL, NULL, '600.00', NULL, NULL, '2021-05-20 00:00:00', 0, 0, 0, 3, 1, 1, 122, 'Pendente', '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(123, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 123, 'Pendente', '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(124, '489.00', NULL, NULL, '2021-10-01 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 124, 'Pendente', '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(125, '250.00', NULL, NULL, '2021-10-01 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 125, 'Pendente', '2021-03-09 11:36:40', '2021-03-24 17:33:40', '2021-03-24 17:33:40'),
(126, NULL, NULL, '400.00', NULL, NULL, '2021-04-10 00:00:00', 0, 0, 0, 4, 1, 1, 126, 'Pendente', '2021-03-09 11:40:22', '2021-03-24 17:33:25', '2021-03-24 17:33:25'),
(127, '795.00', NULL, NULL, '2021-04-10 00:00:00', NULL, NULL, 0, 0, 0, 4, 1, 1, 127, 'Pendente', '2021-03-09 11:40:22', '2021-03-24 17:33:25', '2021-03-24 17:33:25'),
(128, '10.00', '10.00', '80.00', '2021-04-10 00:00:00', '2021-04-10 00:00:00', '2021-04-15 00:00:00', 0, 0, 0, 1, 1, 1, 128, 'Pendente', '2021-03-30 15:11:42', '2021-03-30 15:12:04', '2021-03-30 15:12:04'),
(129, NULL, '100.00', NULL, NULL, '2021-04-30 00:00:00', NULL, 0, 0, 0, 1, 1, 1, 129, 'Pendente', '2021-03-30 15:11:42', '2021-03-30 15:12:04', '2021-03-30 15:12:04'),
(130, '89.00', '100.00', '40.00', '2021-04-08 00:00:00', '2021-04-08 00:00:00', '2021-02-22 00:00:00', 0, 0, 0, 1, 1, 2, 130, 'Dívida', '2021-04-06 14:44:39', '2021-04-06 23:00:01', NULL),
(131, '300.00', '200.00', '400.00', '2021-04-08 00:00:00', '2021-04-08 00:00:00', '2021-04-11 00:00:00', 0, 0, 0, 1, 1, 2, 131, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(132, '35.00', NULL, NULL, '2021-04-08 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 2, 132, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(133, '795.00', NULL, NULL, '2021-04-08 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 2, 133, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(134, NULL, NULL, '500.00', NULL, NULL, '2021-05-10 00:00:00', 0, 0, 0, 1, 1, 2, 134, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(135, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 135, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(136, '750.00', NULL, NULL, '2021-09-01 00:00:00', NULL, NULL, 0, 0, 0, 1, 1, 2, 136, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(137, '520.00', '200.00', NULL, '2021-08-15 00:00:00', '2021-08-15 00:00:00', NULL, 0, 0, 0, 1, 1, 2, 137, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(138, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, 2, 138, 'Pendente', '2021-04-06 14:44:39', '2021-04-06 14:44:39', NULL),
(139, '110.00', '100.00', '40.00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', '2021-02-22 00:00:00', 0, 0, 0, 3, 1, 1, 139, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(140, '300.00', '200.00', '400.00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', '2021-04-15 00:00:00', 0, 0, 0, 3, 1, 1, 140, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(141, '35.00', NULL, '60.00', '2021-04-07 00:00:00', NULL, '2021-04-12 00:00:00', 0, 0, 0, 3, 1, 1, 141, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(142, '795.00', NULL, NULL, '2021-04-18 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 142, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(143, NULL, NULL, '600.00', NULL, NULL, '2021-05-15 00:00:00', 0, 0, 0, 3, 1, 1, 143, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(144, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 144, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(145, '625.00', NULL, NULL, '2021-09-15 00:00:00', NULL, NULL, 0, 0, 0, 3, 1, 1, 145, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(146, '520.00', '200.00', NULL, '2021-01-10 00:00:00', '2021-09-01 00:00:00', NULL, 0, 0, 0, 3, 1, 1, 146, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(147, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, 1, 147, 'Pendente', '2021-04-07 09:57:01', '2021-04-07 09:57:01', NULL),
(148, '110.00', '100.00', '40.00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', '2021-02-22 00:00:00', 0, 0, 0, 4, 1, 2, 148, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(149, '300.00', '200.00', '400.00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', '2021-04-10 00:00:00', 0, 0, 0, 4, 1, 2, 149, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(150, '35.00', NULL, '60.00', '2021-03-07 00:00:00', NULL, '2021-04-17 00:00:00', 0, 0, 0, 4, 1, 2, 150, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(151, '795.00', NULL, NULL, '2021-05-01 00:00:00', NULL, NULL, 0, 0, 0, 4, 1, 2, 151, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(152, NULL, NULL, '500.00', NULL, NULL, '2021-05-08 00:00:00', 0, 0, 0, 4, 1, 2, 152, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(153, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 2, 153, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(154, '750.00', NULL, NULL, '2021-07-01 00:00:00', NULL, NULL, 0, 0, 0, 4, 1, 2, 154, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(155, '520.00', '200.00', NULL, '2021-09-01 00:00:00', '2021-09-01 00:00:00', NULL, 0, 0, 0, 4, 1, 2, 155, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(156, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, 2, 156, 'Pendente', '2021-04-07 12:42:50', '2021-04-07 12:42:50', NULL),
(157, '110.00', '100.00', '40.00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', '2021-02-22 00:00:00', 0, 0, 0, 5, 3, 2, 157, 'Pendente', '2021-04-07 13:03:42', '2021-04-07 13:03:42', NULL),
(158, '300.00', '200.00', '400.00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', '2021-04-10 00:00:00', 0, 0, 0, 5, 3, 2, 158, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(159, '35.00', NULL, NULL, '2021-03-07 00:00:00', NULL, NULL, 0, 0, 0, 5, 3, 2, 159, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(160, '795.00', NULL, NULL, '2021-05-01 00:00:00', NULL, NULL, 0, 0, 0, 5, 3, 2, 160, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(161, NULL, NULL, '500.00', NULL, NULL, '2021-05-08 00:00:00', 0, 0, 0, 5, 3, 2, 161, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(162, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 5, 3, 2, 162, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(163, '750.00', NULL, NULL, '2021-08-01 00:00:00', NULL, NULL, 0, 0, 0, 5, 3, 2, 163, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(164, '520.00', '200.00', NULL, '2021-10-01 00:00:00', '2021-09-01 00:00:00', NULL, 0, 0, 0, 5, 3, 2, 164, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(165, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 5, 3, 2, 165, 'Pendente', '2021-04-07 13:03:43', '2021-04-07 13:03:43', NULL),
(166, '110.00', '100.00', '40.00', '2021-01-17 00:00:00', '2021-01-17 00:00:00', '2021-02-22 00:00:00', 0, 0, 0, 6, 1, 1, 166, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(167, '300.00', '200.00', '400.00', '2021-01-31 00:00:00', '2021-01-31 00:00:00', '2021-04-10 00:00:00', 0, 0, 0, 6, 1, 1, 167, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(168, '35.00', NULL, NULL, '2021-03-07 00:00:00', NULL, NULL, 0, 0, 0, 6, 1, 1, 168, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(169, '795.00', NULL, NULL, '2021-05-01 00:00:00', NULL, NULL, 0, 0, 0, 6, 1, 1, 169, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(170, NULL, NULL, '600.00', NULL, NULL, '2021-05-20 00:00:00', 0, 0, 0, 6, 1, 1, 170, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(171, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 6, 1, 1, 171, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(172, '625.00', NULL, NULL, '2021-08-01 00:00:00', NULL, NULL, 0, 0, 0, 6, 1, 1, 172, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(173, '520.00', '200.00', NULL, '2021-10-01 00:00:00', '2021-09-01 00:00:00', NULL, 0, 0, 0, 6, 1, 1, 173, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL),
(174, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 6, 1, 1, 174, 'Pendente', '2021-04-07 13:20:06', '2021-04-07 13:20:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `universidade`
--

CREATE TABLE `universidade` (
  `idUniversidade` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `NIF` varchar(255) NOT NULL,
  `IBAN` varchar(255) DEFAULT NULL,
  `observacoes` longtext DEFAULT NULL,
  `obsCursos` longtext DEFAULT NULL,
  `obsCandidaturas` longtext DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `universidade`
--

INSERT INTO `universidade` (`idUniversidade`, `nome`, `morada`, `telefone`, `email`, `NIF`, `IBAN`, `observacoes`, `obsCursos`, `obsCandidaturas`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Universidade da Beira Interior', 'R. Marquês de Ávila e Bolama, 6201-001 Covilhã', '351 275 319 700', 'geral@ubi.pt', '502083514', NULL, NULL, NULL, NULL, 'universidade-da-beira-interior', '2020-12-02 11:29:52', '2020-12-02 11:31:42', NULL),
(2, 'UALG - Universidade do Algarve', 'Campus de Gambelas, Edifício 1, Piso 2 8005-139 FARO', '289 800100/900', 'info@ualg.pt', '505387271', NULL, NULL, NULL, NULL, 'ualg-universidade-do-algarve', '2021-01-18 15:12:46', '2021-01-18 15:12:46', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` enum('admin','agente','cliente') NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `auth_key` varchar(5) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(191) DEFAULT NULL,
  `idAdmin` bigint(20) UNSIGNED DEFAULT NULL,
  `idAgente` bigint(20) UNSIGNED DEFAULT NULL,
  `idCliente` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`idUser`, `email`, `tipo`, `password`, `auth_key`, `estado`, `slug`, `idAdmin`, `idAgente`, `idCliente`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@test.com', 'admin', '$2y$10$VhRZNIoV/O6uzmXTD99j6OCDcbxo9oW9kj9PbHc80gx5gxN6KV2hO', 'CAJVN', 1, 'senhor-administrador', 1, NULL, NULL, '2020-02-12 00:00:00', '2020-02-12 00:00:00', NULL),
(2, 'jose.apareia@gmail.com', 'admin', '$2y$10$GFe0f1Wld5rHA01zErLPp.o/5hdp7U7woFbpkpfM6RVEEVr.MCJl.', 'VNSN1', 1, 'jose-areia', 2, NULL, NULL, '2020-11-18 20:12:10', '2020-11-18 20:12:52', NULL),
(3, 'silvana.garces@estudarportugal.com', 'agente', '$2y$10$gHiDNTIWcli39ndkimQNDuBjFM6Of/szyv.GaAzeWzGwm32QbXdN2', NULL, 0, 'silvana-garces', NULL, 1, NULL, '2020-12-02 11:25:26', '2021-04-06 23:00:01', NULL),
(4, 'estudarportugal@gmail.com', 'agente', '$2y$10$RRM2THiOsGMaJ341ZJscR.PveCVXy/4YHEhTF6MBCYlcJWmRAWBwC', NULL, 0, 'filipe-pinto', NULL, 2, NULL, '2020-12-02 14:28:53', '2021-04-06 23:00:01', NULL),
(5, 'Irenita17ismm@hotmail.com', 'agente', '$2y$10$5R0PBmGaKTKoVD3Ti1SReOLCjf7pLX94SGWZojHkNIgKiXgsU8Spy', NULL, 0, 'irene-medranda', NULL, 3, NULL, '2020-12-12 17:44:52', '2021-04-06 23:00:01', NULL),
(6, 'carla.gaspar@estudarportugal.com', 'admin', '$2y$10$kEX2zAeOab5awGCK8nlaLO/5xTUg0xst4Ws5lBMh4Oddw47QdL3gC', 'E2NLS', 1, 'carla-gaspar', 3, NULL, NULL, '2021-02-25 14:49:00', '2021-02-25 16:00:23', NULL),
(7, 'linda.sousa@estudarportugal.com', 'admin', '$2y$10$ndaGRq6UVGGumZfM4gHdiejaAI2DpPVZ8kq818yPuHNAQQIz3Fng.', 'SBEK9', 1, 'linda-sousa', 4, NULL, NULL, '2021-03-22 14:07:52', '2021-03-22 14:13:41', NULL),
(8, 'linda.carreira.sousa@gmail.com', 'admin', '$2y$10$2j6hYZcg9O0i2i0BZcmSM.jqPyNiPzluNMOg/mf5vuHV67u4EIF2e', 'AISOB', 0, 'linda-carreira-sousa', 5, NULL, NULL, '2021-03-22 14:08:43', '2021-03-22 14:08:43', NULL),
(9, 'godach@hotmail.com', 'agente', '$2y$10$PPffBv0ZN2HKqG9kc6u7PORulzwdNuL9b7qeoCNn1VyzNHWz9qi66', 'BQLX0', 0, 'gonzalo-davalos', NULL, 4, NULL, '2021-03-23 17:48:31', '2021-03-23 17:48:31', NULL),
(10, 'mexico@estudarportugal.com', 'agente', '$2y$10$bOb0uqWRZkY79Iy4EjPGHeDlwDCsRqG8jMZZG2lbR8W6d56/.NiBu', 'PHILC', 0, 'lezly-garcia', NULL, 5, NULL, '2021-03-26 16:25:54', '2021-03-26 16:25:54', NULL),
(11, 'fmp.filipe@gmail.com', 'admin', '$2y$10$9dNfSy0RfeH7He/mIIIxHOv6k.3GJxYWXp9wfWzWUWKPTenQ5uHua', 'OKK3Z', 0, 'filipe-pinto', 6, NULL, NULL, '2021-04-07 08:57:38', '2021-04-07 08:57:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `administrador_email_unique` (`email`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `agenda_iduser_foreign` (`idUser`),
  ADD KEY `agenda_iduniversidade_foreign` (`idUniversidade`);

--
-- Indexes for table `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`idAgente`),
  ADD UNIQUE KEY `agente_email_unique` (`email`),
  ADD UNIQUE KEY `agente_nif_unique` (`NIF`),
  ADD UNIQUE KEY `agente_num_doc_unique` (`num_doc`),
  ADD KEY `agente_idagenteassociado_foreign` (`idAgenteAssociado`);

--
-- Indexes for table `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`idBiblioteca`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `cliente_email_unique` (`email`),
  ADD UNIQUE KEY `cliente_nif_unique` (`NIF`),
  ADD UNIQUE KEY `cliente_num_docoficial_unique` (`num_docOficial`);

--
-- Indexes for table `cliente_observacoes`
--
ALTER TABLE `cliente_observacoes`
  ADD PRIMARY KEY (`idObservacao`),
  ADD KEY `cliente_observacoes_idcliente_foreign` (`idCliente`);

--
-- Indexes for table `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`idConta`),
  ADD UNIQUE KEY `conta_numconta_unique` (`numConta`),
  ADD UNIQUE KEY `conta_iban_unique` (`IBAN`),
  ADD UNIQUE KEY `conta_swift_unique` (`SWIFT`);

--
-- Indexes for table `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idContacto`),
  ADD KEY `contacto_iduser_foreign` (`idUser`),
  ADD KEY `contacto_iduniversidade_foreign` (`idUniversidade`);

--
-- Indexes for table `doc_academico`
--
ALTER TABLE `doc_academico`
  ADD PRIMARY KEY (`idDocAcademico`),
  ADD KEY `doc_academico_idfase_foreign` (`idFase`);

--
-- Indexes for table `doc_necessario`
--
ALTER TABLE `doc_necessario`
  ADD PRIMARY KEY (`idDocNecessario`),
  ADD KEY `doc_necessario_idfase_foreign` (`idFase`);

--
-- Indexes for table `doc_pessoal`
--
ALTER TABLE `doc_pessoal`
  ADD PRIMARY KEY (`idDocPessoal`),
  ADD KEY `doc_pessoal_idfase_foreign` (`idFase`);

--
-- Indexes for table `doc_stock`
--
ALTER TABLE `doc_stock`
  ADD PRIMARY KEY (`idDocStock`),
  ADD KEY `doc_stock_idfasestock_foreign` (`idFaseStock`);

--
-- Indexes for table `doc_transacao`
--
ALTER TABLE `doc_transacao`
  ADD PRIMARY KEY (`idDocTransacao`),
  ADD KEY `doc_transacao_idconta_foreign` (`idConta`),
  ADD KEY `doc_transacao_idfase_foreign` (`idFase`);

--
-- Indexes for table `fase`
--
ALTER TABLE `fase`
  ADD PRIMARY KEY (`idFase`),
  ADD KEY `fase_idproduto_foreign` (`idProduto`);

--
-- Indexes for table `fase_stock`
--
ALTER TABLE `fase_stock`
  ADD PRIMARY KEY (`idFaseStock`),
  ADD KEY `fase_stock_idprodutostock_foreign` (`idProdutoStock`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `pago_responsabilidade`
--
ALTER TABLE `pago_responsabilidade`
  ADD PRIMARY KEY (`idPagoResp`),
  ADD KEY `pago_responsabilidade_idresponsabilidade_foreign` (`idResponsabilidade`),
  ADD KEY `pago_responsabilidade_idconta_foreign` (`idConta`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `produto_idagente_foreign` (`idAgente`),
  ADD KEY `produto_idsubagente_foreign` (`idSubAgente`),
  ADD KEY `produto_idcliente_foreign` (`idCliente`),
  ADD KEY `produto_iduniversidade1_foreign` (`idUniversidade1`),
  ADD KEY `produto_iduniversidade2_foreign` (`idUniversidade2`);

--
-- Indexes for table `produto_stock`
--
ALTER TABLE `produto_stock`
  ADD PRIMARY KEY (`idProdutoStock`);

--
-- Indexes for table `relatorio_problema`
--
ALTER TABLE `relatorio_problema`
  ADD PRIMARY KEY (`idRelatorioProblema`);

--
-- Indexes for table `rel_forn_resp`
--
ALTER TABLE `rel_forn_resp`
  ADD PRIMARY KEY (`idRelacao`),
  ADD KEY `rel_forn_resp_idresponsabilidade_foreign` (`idResponsabilidade`),
  ADD KEY `rel_forn_resp_idfornecedor_foreign` (`idFornecedor`);

--
-- Indexes for table `responsabilidade`
--
ALTER TABLE `responsabilidade`
  ADD PRIMARY KEY (`idResponsabilidade`),
  ADD KEY `responsabilidade_idcliente_foreign` (`idCliente`),
  ADD KEY `responsabilidade_idagente_foreign` (`idAgente`),
  ADD KEY `responsabilidade_iduniversidade1_foreign` (`idUniversidade1`),
  ADD KEY `responsabilidade_idfase_foreign` (`idFase`);

--
-- Indexes for table `universidade`
--
ALTER TABLE `universidade`
  ADD PRIMARY KEY (`idUniversidade`),
  ADD UNIQUE KEY `universidade_nif_unique` (`NIF`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `user_email_unique` (`email`),
  ADD KEY `user_idadmin_foreign` (`idAdmin`),
  ADD KEY `user_idagente_foreign` (`idAgente`),
  ADD KEY `user_idcliente_foreign` (`idCliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdmin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `agente`
--
ALTER TABLE `agente`
  MODIFY `idAgente` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `idBiblioteca` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `cliente_observacoes`
--
ALTER TABLE `cliente_observacoes`
  MODIFY `idObservacao` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `conta`
--
ALTER TABLE `conta`
  MODIFY `idConta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idContacto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `doc_academico`
--
ALTER TABLE `doc_academico`
  MODIFY `idDocAcademico` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `doc_necessario`
--
ALTER TABLE `doc_necessario`
  MODIFY `idDocNecessario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `doc_pessoal`
--
ALTER TABLE `doc_pessoal`
  MODIFY `idDocPessoal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;
--
-- AUTO_INCREMENT for table `doc_stock`
--
ALTER TABLE `doc_stock`
  MODIFY `idDocStock` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `doc_transacao`
--
ALTER TABLE `doc_transacao`
  MODIFY `idDocTransacao` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `fase`
--
ALTER TABLE `fase`
  MODIFY `idFase` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `fase_stock`
--
ALTER TABLE `fase_stock`
  MODIFY `idFaseStock` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idFornecedor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `pago_responsabilidade`
--
ALTER TABLE `pago_responsabilidade`
  MODIFY `idPagoResp` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `produto_stock`
--
ALTER TABLE `produto_stock`
  MODIFY `idProdutoStock` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `relatorio_problema`
--
ALTER TABLE `relatorio_problema`
  MODIFY `idRelatorioProblema` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rel_forn_resp`
--
ALTER TABLE `rel_forn_resp`
  MODIFY `idRelacao` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `responsabilidade`
--
ALTER TABLE `responsabilidade`
  MODIFY `idResponsabilidade` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `universidade`
--
ALTER TABLE `universidade`
  MODIFY `idUniversidade` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_iduniversidade_foreign` FOREIGN KEY (`idUniversidade`) REFERENCES `universidade` (`idUniversidade`),
  ADD CONSTRAINT `agenda_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Limitadores para a tabela `agente`
--
ALTER TABLE `agente`
  ADD CONSTRAINT `agente_idagenteassociado_foreign` FOREIGN KEY (`idAgenteAssociado`) REFERENCES `agente` (`idAgente`);

--
-- Limitadores para a tabela `cliente_observacoes`
--
ALTER TABLE `cliente_observacoes`
  ADD CONSTRAINT `cliente_observacoes_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);

--
-- Limitadores para a tabela `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_iduniversidade_foreign` FOREIGN KEY (`idUniversidade`) REFERENCES `universidade` (`idUniversidade`),
  ADD CONSTRAINT `contacto_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Limitadores para a tabela `doc_academico`
--
ALTER TABLE `doc_academico`
  ADD CONSTRAINT `doc_academico_idfase_foreign` FOREIGN KEY (`idFase`) REFERENCES `fase` (`idFase`);

--
-- Limitadores para a tabela `doc_necessario`
--
ALTER TABLE `doc_necessario`
  ADD CONSTRAINT `doc_necessario_idfase_foreign` FOREIGN KEY (`idFase`) REFERENCES `fase` (`idFase`);

--
-- Limitadores para a tabela `doc_pessoal`
--
ALTER TABLE `doc_pessoal`
  ADD CONSTRAINT `doc_pessoal_idfase_foreign` FOREIGN KEY (`idFase`) REFERENCES `fase` (`idFase`);

--
-- Limitadores para a tabela `doc_stock`
--
ALTER TABLE `doc_stock`
  ADD CONSTRAINT `doc_stock_idfasestock_foreign` FOREIGN KEY (`idFaseStock`) REFERENCES `fase_stock` (`idFaseStock`);

--
-- Limitadores para a tabela `doc_transacao`
--
ALTER TABLE `doc_transacao`
  ADD CONSTRAINT `doc_transacao_idconta_foreign` FOREIGN KEY (`idConta`) REFERENCES `conta` (`idConta`),
  ADD CONSTRAINT `doc_transacao_idfase_foreign` FOREIGN KEY (`idFase`) REFERENCES `fase` (`idFase`);

--
-- Limitadores para a tabela `fase`
--
ALTER TABLE `fase`
  ADD CONSTRAINT `fase_idproduto_foreign` FOREIGN KEY (`idProduto`) REFERENCES `produto` (`idProduto`);

--
-- Limitadores para a tabela `fase_stock`
--
ALTER TABLE `fase_stock`
  ADD CONSTRAINT `fase_stock_idprodutostock_foreign` FOREIGN KEY (`idProdutoStock`) REFERENCES `produto_stock` (`idProdutoStock`);

--
-- Limitadores para a tabela `pago_responsabilidade`
--
ALTER TABLE `pago_responsabilidade`
  ADD CONSTRAINT `pago_responsabilidade_idconta_foreign` FOREIGN KEY (`idConta`) REFERENCES `conta` (`idConta`),
  ADD CONSTRAINT `pago_responsabilidade_idresponsabilidade_foreign` FOREIGN KEY (`idResponsabilidade`) REFERENCES `responsabilidade` (`idResponsabilidade`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_idagente_foreign` FOREIGN KEY (`idAgente`) REFERENCES `agente` (`idAgente`),
  ADD CONSTRAINT `produto_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `produto_idsubagente_foreign` FOREIGN KEY (`idSubAgente`) REFERENCES `agente` (`idAgente`),
  ADD CONSTRAINT `produto_iduniversidade1_foreign` FOREIGN KEY (`idUniversidade1`) REFERENCES `universidade` (`idUniversidade`),
  ADD CONSTRAINT `produto_iduniversidade2_foreign` FOREIGN KEY (`idUniversidade2`) REFERENCES `universidade` (`idUniversidade`);

--
-- Limitadores para a tabela `rel_forn_resp`
--
ALTER TABLE `rel_forn_resp`
  ADD CONSTRAINT `rel_forn_resp_idfornecedor_foreign` FOREIGN KEY (`idFornecedor`) REFERENCES `fornecedor` (`idFornecedor`),
  ADD CONSTRAINT `rel_forn_resp_idresponsabilidade_foreign` FOREIGN KEY (`idResponsabilidade`) REFERENCES `responsabilidade` (`idResponsabilidade`);

--
-- Limitadores para a tabela `responsabilidade`
--
ALTER TABLE `responsabilidade`
  ADD CONSTRAINT `responsabilidade_idagente_foreign` FOREIGN KEY (`idAgente`) REFERENCES `agente` (`idAgente`),
  ADD CONSTRAINT `responsabilidade_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `responsabilidade_idfase_foreign` FOREIGN KEY (`idFase`) REFERENCES `fase` (`idFase`),
  ADD CONSTRAINT `responsabilidade_iduniversidade1_foreign` FOREIGN KEY (`idUniversidade1`) REFERENCES `universidade` (`idUniversidade`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_idadmin_foreign` FOREIGN KEY (`idAdmin`) REFERENCES `administrador` (`idAdmin`),
  ADD CONSTRAINT `user_idagente_foreign` FOREIGN KEY (`idAgente`) REFERENCES `agente` (`idAgente`),
  ADD CONSTRAINT `user_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
