-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 01-Set-2024 às 23:56
-- Versão do servidor: 8.0.36
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hypertechpc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `id_user_fk` int NOT NULL,
  `name_user_order` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barth_user_order` date DEFAULT NULL,
  `adress_user_order` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_order` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_prod_order` int NOT NULL,
  `total_price_order` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id_order`, `id_user_fk`, `name_user_order`, `barth_user_order`, `adress_user_order`, `products_order`, `quantity_prod_order`, `total_price_order`) VALUES
(4, 2, 'Wilma Santos', '1994-10-10', 'Rua Silva Brinco 123', 'Workstation 2, Mouse Gamer', 3, '600'),
(6, 2, 'Carla Santos', '2005-10-02', 'Rua Silva Brinco 123', 'Gabinete Gamer 2, Teclado Gamer', 3, '800');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id_product` int NOT NULL,
  `name_product` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_product` int NOT NULL,
  `price_product` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_product` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_product` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `quantity_product`, `price_product`, `category_product`, `image_product`) VALUES
(1, 'Gabinete Gamer 1', 0, '300', 'pc_gamer', 'imagens/produtos/pcgamer/gabinete1.jpg'),
(2, 'Gabinete Gamer 2', 3, '400', 'pc_gamer', 'imagens\\produtos\\pcgamer\\gabinete2.jpg'),
(3, 'Gabinete Gamer 3', 4, '500', 'pc_gamer', 'imagens\\produtos\\pcgamer\\gabinete3.avif'),
(4, 'Gabinete Gamer 4', 2, '600', 'pc_gamer', 'imagens/produtos/pcgamer/gabinete4.jpeg'),
(5, 'Workstation 1', 5, '300', 'workstation', 'imagens\\produtos\\workstation\\gabinete1.avif'),
(6, 'Workstation 2', 2, '400', 'workstation', 'imagens\\produtos\\workstation\\gabinete2.jpg'),
(7, 'Workstation 3', 2, '500', 'workstation', 'imagens\\produtos\\workstation\\gabinete3.jpg'),
(8, 'Workstation 4', 4, '600', 'workstation', 'imagens\\produtos\\workstation\\gabinete4.avif'),
(9, 'Monitor Gamer', 2, '1000', 'pecas', 'imagens\\produtos\\pecas\\monitor.jpg'),
(10, 'Fone Gamer', 5, '150', 'pecas', 'imagens\\produtos\\pecas\\fone.jpg'),
(11, 'Teclado Gamer', 5, '200', 'pecas', 'imagens\\produtos\\pecas\\teclado.jpg'),
(16, 'Mouse Gamer', 3, '100', 'pecas', 'imagens/produtos/pecas/mouse.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `name_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm_pass_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `last_name_user`, `email_user`, `pass_user`, `confirm_pass_user`, `type_user`) VALUES
(1, 'Jane', 'Doe', 'janedoe@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', '827ccb0eea8a706c4c34a16891f84e7b', 'administrador'),
(2, 'Wilma', 'Santos', 'wilmasantos@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'utilizador'),
(4, 'Gilbert', 'Martins', 'gilbertgg@gmail.com', 'f06dda3e12bfd72e7e7444b53751c30e', 'f06dda3e12bfd72e7e7444b53751c30e', 'utilizador');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user_fk` (`id_user_fk`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
