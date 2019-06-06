-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2019 at 05:34 PM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id286113_datedemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `anos`
--

CREATE TABLE `anos` (
  `id_ano` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `bissexto` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anos`
--

INSERT INTO `anos` (`id_ano`, `ano`, `bissexto`) VALUES
(1, 2015, 0),
(2, 2016, 0),
(3, 2017, 0),
(4, 2018, 0),
(5, 2019, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `id_dias` varchar(11) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `horario` varchar(85) NOT NULL,
  `turno` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `descricao` mediumtext NOT NULL,
  `tipo` varchar(85) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_final` date NOT NULL,
  `carga_h` varchar(11) NOT NULL,
  `preco` varchar(50) NOT NULL,
  `plano` varchar(50) NOT NULL,
  `capa` varchar(50) NOT NULL,
  `qtd_min_alun` int(11) NOT NULL,
  `qtd_max_alun` int(11) NOT NULL,
  `alun_matriculado` int(11) NOT NULL,
  `turma_cancelada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id_curso`, `id_professor`, `id_dias`, `nome`, `horario`, `turno`, `status`, `descricao`, `tipo`, `data_inicio`, `data_final`, `carga_h`, `preco`, `plano`, `capa`, `qtd_min_alun`, `qtd_max_alun`, `alun_matriculado`, `turma_cancelada`) VALUES
(121, 11, '3', 'Técnico Comunicação', '123', 1, 1, '                        123                    ', '1', '2017-07-27', '2017-07-27', '123', '123', '0.03567500 1497898875.docx', '0.15127600 1497898763.jpg', 2, 22, 0, 0),
(122, 11, '2', 'Técnico em Web Design', '123', 1, 1, '                        123                    ', '1', '2017-06-12', '2017-06-22', '123', '12', '0.62726200 1497899584.docx', '0.41212100 1497898795.jpg', 2, 22, 0, 0),
(123, 11, '4', 'Técnico em Término', 'asd', 2, 2, '                        asd                                                            ', '1', '2017-01-11', '0000-00-00', '123', '1123', '', '0.10044800 1497898836.png', 2, 22, 0, 0),
(124, 11, '4', 'Aperfeiçoamento em feruquímica', 'asd', 2, 1, '                                                asd                                                                                ', '6', '2017-01-11', '2017-06-30', '123', '1123', 'Pesquisa0.36335400 1497915382.docx', '0.10044800 1497898836.png', 2, 22, 0, 0),
(125, 1, '12345', 'Concept Art - Animais', '08H às 9H', 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.', '2', '2019-03-01', '2019-04-05', '200H', 'R$ 500,00', 'PLANO 1551724231.docx', 'thoma1551724230.jpg', 5, 10, 10, 0),
(126, 1, '12345', 'Concept Art - Animais II', '09H às 10H', 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.', '2', '2019-03-29', '2019-04-26', '200H', 'R$ 500,00', 'PLANO 1551724231.docx', 'thoma1551724230.jpg', 5, 10, 0, 1),
(127, 1, '12345', 'Técnico em Design Sitemico - I', '13H às 15H', 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.', '1', '2019-04-19', '2019-06-21', '300H', 'R$ 5000,00', 'PLANO 1551725509.docx', '1_BxG1551725509.png', 10, 40, 0, 0),
(128, 1, '12345', 'Técnico em Design Sitemico - II', '18H às 20H', 3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.', '1', '2019-08-02', '2020-01-03', '300H', 'R$ 3000,00', 'PLANO 1551725598.docx', '1_BxG1551725597.png', 10, 40, 0, 0),
(129, 1, '135', 'Introdução a desenho de personagens - I', '18H às 20H', 3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.', '4', '2019-02-01', '2019-05-24', '100H', 'R$ 500,00', 'PLANO 1551725692.docx', 'russe1551725692.jpg', 5, 35, 5, 0),
(130, 1, '135', 'Introdução a desenho de personagens - II', '13H às 15H', 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.', '4', '2019-05-10', '2019-07-26', '200h', 'R$ 500,00', 'PLANO 1551725753.docx', 'russe1551725753.jpg', 20, 30, 0, 0),
(131, 1, '123456', 'Ilustração Digital', '08H às 9H', 1, 1, '                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.                    ', '6', '2019-02-01', '2019-04-05', '100H', 'R$ 500,00', 'PLANO 1551725806.docx', 'joshu1551725805.jpg', 20, 30, 21, 0),
(132, 1, '12345', 'Ilustração Digital - II', '09H às 10H', 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec justo dui, efficitur ut lorem vitae, viverra pulvinar mauris. Etiam sit amet odio ac mi pellentesque condimentum. Vestibulum eu magna tincidunt, consectetur neque quis, laoreet elit. Praesent dui sapien, consequat vel congue vitae, pharetra sit amet mi. Ut lacinia, mauris id bibendum dignissim, augue justo rhoncus erat, non commodo sem elit et augue. Phasellus dui nibh, lacinia quis rhoncus nec, vestibulum blandit felis. Fusce rhoncus aliquet augue sed semper. Phasellus ac mi ac est convallis fermentum at eu elit. Curabitur ullamcorper purus sem, eu rhoncus massa imperdiet malesuada. Phasellus tincidunt, ligula id tristique ultrices, lectus odio maximus nibh, non vehicula nunc quam vitae turpis. Integer convallis sapien nec pretium suscipit. Aliquam purus justo, consectetur quis orci ac, gravida congue odio. Aenean vehicula cursus ligula ac bibendum. Donec quis quam non libero feugiat suscipit quis eget turpis. Integer eu nisi leo.', '6', '2019-05-24', '2019-09-27', '300H', 'R$ 500,00', 'PLANO 1551725861.docx', 'joshu1551725861.jpg', 10, 20, 0, 1),
(133, 1, '12345', 'Ilustração de Cenários', '08H às 9H', 1, 1, 'Fusce volutpat arcu lorem, in molestie est aliquet sit amet. Cras imperdiet pulvinar tristique. Aliquam placerat nulla eu ipsum ornare ornare. Nulla facilisi. In egestas diam ut enim fermentum iaculis. Morbi vel pulvinar nulla, et bibendum nibh. Vivamus ipsum odio, luctus id orci vitae, varius accumsan metus. Nulla rutrum felis at tempus porttitor.', '2', '2019-03-29', '2019-04-26', '100H', 'R$ 500,00', 'PLANO 1551726479.docx', 'tianh1551726479.jpg', 5, 15, 0, 0),
(134, 11, '3', 'Técnico Comunicação', '123', 1, 1, '                        123                    ', '1', '2018-09-21', '2019-01-11', '123', '123', '0.03567500 1497898875.docx', '0.15127600 1497898763.jpg', 2, 22, 0, 0),
(135, 20, '', 'Design de Personagem', '', 0, 3, 'Praesent facilisis tincidunt accumsan. Maecenas facilisis auctor urna, ac posuere tellus tincidunt tempus. Cras bibendum lorem enim, id pulvinar ipsum convallis vitae. Aliquam dolor ipsum, elementum nec mauris eu, fringilla accumsan dolor. Integer suscipit quam vitae justo tempus, eu convallis tellus posuere. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc eget scelerisque turpis. Nam accumsan egestas lacus, eget congue neque vulputate non. Nunc porttitor enim efficitur turpis euismod, id consectetur eros hendrerit. Integer et dolor in lacus sodales tempus ut sit amet ligula.', '5', '2019-02-01', '0000-00-00', '300H', '', 'PLANO 1551733514.docx', 'joshu1551733514.jpg', 0, 0, 0, 0),
(136, 20, '', 'Design de Personagem II', '', 0, 3, 'Praesent facilisis tincidunt accumsan. Maecenas facilisis auctor urna, ac posuere tellus tincidunt tempus. Cras bibendum lorem enim, id pulvinar ipsum convallis vitae. Aliquam dolor ipsum, elementum nec mauris eu, fringilla accumsan dolor. Integer suscipit quam vitae justo tempus, eu convallis tellus posuere. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc eget scelerisque turpis. Nam accumsan egestas lacus, eget congue neque vulputate non. Nunc porttitor enim efficitur turpis euismod, id consectetur eros hendrerit. Integer et dolor in lacus sodales tempus ut sit amet ligula.', '4', '2019-05-24', '0000-00-00', '300H', '', 'PLANO 1551733655.docx', 'joshu1551733655.jpg', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dias`
--

CREATE TABLE `dias` (
  `iddia` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `nome` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meses`
--

CREATE TABLE `meses` (
  `id_mes` int(11) NOT NULL,
  `mes` varchar(50) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meses`
--

INSERT INTO `meses` (`id_mes`, `mes`, `dias`) VALUES
(1, 'Janeiro', 31),
(2, 'Fevereiro', 28),
(3, 'Março', 31),
(4, 'Abril', 30),
(5, 'Maio', 31),
(6, 'Junho', 30),
(7, 'Julho', 31),
(8, 'Agosto', 31),
(9, 'Setembro', 30),
(10, 'Outubro', 31),
(11, 'Novembro', 30),
(12, 'Dezembro', 31);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(1, 'gmail@gmail.com'),
(2, 'kel@gmail.com'),
(3, 'gg@gmail.com'),
(4, 'joao@gmail.com'),
(5, 'kk@gmail.com'),
(6, 'brono@gmail.com'),
(7, 'uu@gmail.com'),
(8, 'kel@gmail.com'),
(9, 'kelvin.toy96@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(155) NOT NULL,
  `unidade` varchar(50) NOT NULL,
  `data_nasc` date NOT NULL,
  `CEP` varchar(50) NOT NULL,
  `CPF` varchar(50) NOT NULL,
  `formacao` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `desligado` int(1) NOT NULL,
  `permicao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nome`, `email`, `senha`, `unidade`, `data_nasc`, `CEP`, `CPF`, `formacao`, `foto`, `desligado`, `permicao`) VALUES
(1, 'Kelvin Castro', 'kelvin@gmail.com', '202cb962ac59075b964b07152d234b70', 'CECOTEG', '2017-01-04', '12345-000', '123.123.123-00', 'Designer Gráfico', '0.00207900 1497818425.png', 0, 1),
(11, 'profess', 'prof@gmail.com', '202cb962ac59075b964b07152d234b70', 'CECOTEG', '2016-11-16', '', '', 'Designer', '0.10990300 1497816114.jpg', 0, 2),
(12, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'CECOTEG', '2016-11-16', '', '', '123', '0.42541100 1488843724.JPG', 0, 1),
(18, 'secretaria', 'secretaria@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '2017-02-10', '', '', '123', '0.40861800 1488836979.jpg', 0, 3),
(19, 'Exlcuido2', 'secretaria@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '2017-02-10', '', '', '123', '0.99621000 1497817150.jpg', 1, 3),
(20, 'Professor', 'prof@gmail.com', 'd450c5dbcc10db0749277efc32f15f9f', 'CECOTEG', '1993-07-15', '', '', 'Bacharelado História da Arte', 'fa1f41551726811.jpg', 0, 2),
(21, 'Administrador', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'CECOTEG', '1994-03-03', '', '', 'Bacharelado Gerência de Negócios', 'kisspng-management-woman-pro1551733786.35560310152', 0, 1),
(22, 'Secretaria', 'secret@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'CECOTEG', '1999-03-04', '', '', 'Bacharelado Analista de Telecomunicação', 'dia-d1551726975.jpg', 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anos`
--
ALTER TABLE `anos`
  ADD PRIMARY KEY (`id_ano`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_user` (`id_professor`);

--
-- Indexes for table `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`iddia`),
  ADD KEY `idcurso` (`idcurso`);

--
-- Indexes for table `meses`
--
ALTER TABLE `meses`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anos`
--
ALTER TABLE `anos`
  MODIFY `id_ano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `dias`
--
ALTER TABLE `dias`
  MODIFY `iddia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meses`
--
ALTER TABLE `meses`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`id_professor`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dias`
--
ALTER TABLE `dias`
  ADD CONSTRAINT `dias_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
