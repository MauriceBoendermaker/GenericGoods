-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 sep 2021 om 00:51
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genericlaptop`
--
CREATE DATABASE IF NOT EXISTS `genericlaptop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `genericlaptop`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cpu` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `cores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gpu` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `vram` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `laptop` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `identifier` varchar(32) DEFAULT NULL,
  `brand` int(11) NOT NULL,
  `cpu` int(11) NOT NULL,
  `gpu` int(11) NOT NULL,
  `resolution` int(11) NOT NULL,
  `refreshrate` int(11) DEFAULT NULL,
  `diagonal` decimal(4,2) DEFAULT NULL,
  `ram` varchar(45) DEFAULT NULL,
  `storagetype` varchar(4) DEFAULT NULL,
  `storagesize` varchar(45) DEFAULT NULL,
  `thumbnail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `resolution` (
  `id` int(11) NOT NULL,
  `resolution` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Lenovo'),
(2, 'Asus'),
(3, 'Acer'),
(4, 'HP'),
(5, 'Dell'),
(6, 'Gigabyte');

INSERT INTO `cpu` (`id`, `name`, `cores`) VALUES
(1, 'Intel Core i3', 4),
(2, 'Intel Core i5', 6),
(3, 'Intel Core i7', 6),
(4, 'Intel Core i9', 8),
(5, 'AMD Ryzen 5', 6);

INSERT INTO `gpu` (`id`, `name`, `vram`) VALUES
(1, 'NVIDIA GeForce GTX 1650', 4),
(2, 'NVIDIA GeForce GTX 1660 ti', 6),
(3, 'NVIDIA GeForce RTX 2060', 6),
(4, 'NVIDIA GeForce RTX 2080 Super', 8),
(5, 'NVIDIA GeForce RTX 3070', 8),
(6, 'NVIDIA GeForce RTX 3080', 10);

INSERT INTO `laptop` (`id`, `name`, `price`, `identifier`, `brand`, `cpu`, `gpu`, `resolution`, `refreshrate`, `diagonal`, `ram`, `storagetype`, `storagesize`, `thumbnail`) VALUES
(1, '31007', '1261.99', 'b4452e13ff734a57b1318988c3d93e2e', 6, 5, 6, 3, 144, '15.6', '4GB', 'SSD', '1TB', '00000001.png'),
(2, '0355', '1051.99', '7abae77b084a404481d401cf1389a1ac', 4, 2, 1, 1, 120, '12.5', '4GB', 'SSD', '1TB', '00000002.png'),
(3, '47006', '1509.99', 'cb2802dd755c46ddba4fa0b19205976e', 5, 2, 5, 1, 144, '17.3', '8GB', 'SSD', '1TB', '00000003.png'),
(4, '3261', '614.99', '4847d3afa0c24428a2c076e9d98bb04d', 1, 5, 3, 2, 144, '15.6', '16GB', 'SSD', '1TB', '00000004.png'),
(5, 'JE-474', '1199.99', '3480bd14ed4049988fe7f7f4988894ef', 2, 2, 1, 1, 120, '12.5', '4GB', 'SHDD', '1TB', '00000005.png'),
(6, 'PD12WC', '763.99', 'fad7b75e98ff42889c31775d5bc58080', 3, 4, 1, 1, 144, '12.5', '16GB', 'HDD', '1TB', '00000006.png'),
(7, '20002', '729.99', 'e9f8c35e65ff47369cbd5e9346678ad2', 5, 1, 1, 2, 120, '11.6', '33GB', 'SSD', '1TB', '00000007.png'),
(8, '5417', '1822.99', '43acc1840e414f0ab20c2a54b42ed616', 4, 5, 4, 1, 120, '13.3', '33GB', 'SSD', '1TB', '00000008.png'),
(9, '41003', '1737.99', '416f0b6382154db681ecc1f065875155', 5, 2, 1, 2, 120, '17.3', '33GB', 'HDD', '1TB', '00000009.png'),
(10, '61000', '1571.99', '6abbfa4610cb450a8aa7e8d5a189f1f0', 6, 5, 2, 3, 60, '14', '16GB', 'SHDD', '2TB', '00000010.png'),
(11, '54002', '1299.99', 'fea77b97204242ed92f9f5f7fbf57981', 6, 1, 6, 1, 144, '12.5', '16GB', 'SHDD', '500GB', '00000011.png'),
(12, 'LL-084', '858.99', '96565e27409e4017a5bf0b3d44896121', 2, 1, 6, 2, 60, '13.3', '8GB', 'SSD', '1TB', '00000012.png'),
(13, '6854', '1795.99', 'ed1c1d0c81ed4d24830a381a87b483d9', 1, 2, 6, 3, 120, '17.3', '33GB', 'HDD', '1TB', '00000013.png'),
(14, '32004', '755.99', '8bf9a1316a3f495d9fa4152fdc721163', 5, 5, 6, 1, 60, '12.5', '4GB', 'HDD', '1TB', '00000014.png'),
(15, '80003', '1734.99', 'ac9d008b490f4bc99f791ad39c5291ce', 5, 3, 1, 2, 60, '15.6', '4GB', 'SHDD', '1TB', '00000015.png'),
(16, '56003', '671.99', '5099bf4868654a0cb9e3d87dc042c719', 5, 3, 5, 3, 120, '17.3', '16GB', 'SSD', '2TB', '00000016.png'),
(17, 'KT-043', '875.99', '9a3c9b7331c1464787be91a740e88b7d', 2, 4, 4, 1, 60, '14', '33GB', 'HDD', '4TB', '00000017.png'),
(18, 'HY-653', '1043.99', '54c2f8d8aa994e43ad0592209fa0adfe', 2, 1, 1, 3, 144, '17.3', '16GB', 'SSD', '500GB', '00000018.png'),
(19, 'YO-545', '1951.99', '8da948c1ce1f4979a9119a6872b55481', 2, 1, 6, 2, 120, '12.5', '16GB', 'HDD', '500GB', '00000019.png'),
(20, 'MU-316', '1625.99', '8cefd95688b64fc6b8f5b49a9d2b1d57', 2, 3, 6, 2, 144, '13.3', '4GB', 'SSD', '1TB', '00000020.png'),
(21, '5732', '1051.99', '287d976b7c684003aed2fe6fe0efb5bd', 4, 1, 6, 1, 60, '15.6', '4GB', 'SHDD', '1TB', '00000021.png'),
(22, '47007', '691.99', '27d2cf79da85480e88b5bae08785ca03', 5, 2, 3, 3, 60, '14', '4GB', 'SSD', '1TB', '00000022.png'),
(23, '15001', '667.99', '6cff5d2431d2419b9f94f580b3a54c7a', 6, 1, 4, 3, 60, '15.6', '8GB', 'SSD', '500GB', '00000023.png'),
(24, 'EY41WS', '1253.99', 'b75aa988cb6844c1862c53712a690ea3', 3, 2, 6, 2, 60, '11.6', '16GB', 'HDD', '500GB', '00000024.png'),
(25, '1844', '1924.99', '94fc3966aeb54349872e6efaa40340df', 4, 2, 3, 3, 144, '13.3', '16GB', 'SSD', '500GB', '00000025.png'),
(26, 'TX-041', '1513.99', '2eda17d74f984e45be5fbd7fb44998c7', 2, 1, 1, 3, 144, '11.6', '8GB', 'SSD', '2TB', '00000026.png'),
(27, '46004', '784.99', '743b2ccf38a6404a95d32701e1a0605e', 6, 3, 5, 3, 120, '13.3', '16GB', 'SSD', '500GB', '00000027.png'),
(28, '7631', '1405.99', '912f09c1bedc438c8497232cc6799541', 4, 3, 3, 1, 60, '15.6', '16GB', 'HDD', '4TB', '00000028.png'),
(29, '3526', '1056.99', 'ab6a2df6d333438493bbdb4fe6147ba9', 4, 1, 1, 1, 120, '14', '8GB', 'HDD', '4TB', '00000029.png'),
(30, '5304', '1356.99', 'a8f0f78448264a869adf708a725791f7', 1, 1, 1, 3, 120, '11.6', '33GB', 'HDD', '2TB', '00000030.png'),
(31, '14008', '991.99', '227cf0b17d56496ba2e6350c2e7399de', 6, 5, 4, 3, 144, '12.5', '4GB', 'SHDD', '1TB', '00000031.png'),
(32, '8284', '665.99', 'dbe2e85db0fc4f4c928bd5e50ef217b1', 4, 1, 1, 1, 120, '11.6', '16GB', 'SSD', '1TB', '00000032.png'),
(33, 'OM43FV', '1616.99', '2461c7d5f25f482793cb779629a9614b', 3, 2, 4, 1, 60, '13.3', '8GB', 'SSD', '2TB', '00000033.png'),
(34, 'SC-647', '1662.99', 'e8f4f7dc2ef9480ba5ce6db3a30e4c9f', 2, 4, 1, 1, 120, '12.5', '16GB', 'HDD', '1TB', '00000034.png'),
(35, '25008', '784.99', '2f6b71a10a454129a12168ed4e22e0ca', 6, 1, 6, 1, 144, '17.3', '8GB', 'SHDD', '1TB', '00000035.png'),
(36, 'DL-406', '1395.99', 'd980885228f24e458cf30b430e628bce', 2, 4, 4, 2, 120, '12.5', '8GB', 'SHDD', '2TB', '00000036.png'),
(37, '54000', '1266.99', '663ca1ca033948d9963034011dc4d5c3', 5, 2, 6, 3, 120, '14', '33GB', 'SSD', '1TB', '00000037.png'),
(38, 'BU-103', '1542.99', '2dbe69b987ad448bb693c646ed0e71b5', 2, 5, 6, 3, 144, '15.6', '16GB', 'SHDD', '1TB', '00000038.png'),
(39, 'TS-655', '1588.99', 'ef322cd5a780405c9e8d04b373071826', 2, 3, 2, 1, 60, '11.6', '16GB', 'SSD', '1TB', '00000039.png'),
(40, '30001', '1644.99', '421113a4429c4ca388320a7c32bcfb79', 6, 2, 4, 2, 144, '17.3', '8GB', 'HDD', '1TB', '00000040.png'),
(41, '3654', '877.99', 'c98158e4dfb3440099462f92e1aecdfc', 4, 2, 2, 1, 144, '15.6', '16GB', 'SSD', '1TB', '00000041.png'),
(42, '83004', '1053.99', 'dcac849fc6cc4dd789da50ae7ab84a90', 5, 2, 6, 1, 144, '13.3', '33GB', 'SSD', '1TB', '00000042.png');

INSERT INTO `resolution` (`id`, `resolution`) VALUES
(1, 'Full HD (1080p)'),
(2, 'Quad HD (1440p)'),
(3, '4K (UHD)');

ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

ALTER TABLE `gpu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_laptop_gpu_idx` (`gpu`),
  ADD KEY `fk_laptop_brand1_idx` (`brand`),
  ADD KEY `fk_laptop_cpu1_idx` (`cpu`),
  ADD KEY `fk_laptop_resolution1_idx` (`resolution`);

ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `cpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `gpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `resolution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `laptop`
  ADD CONSTRAINT `fk_laptop_brand1` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_laptop_cpu1` FOREIGN KEY (`cpu`) REFERENCES `cpu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_laptop_gpu` FOREIGN KEY (`gpu`) REFERENCES `gpu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_laptop_resolution1` FOREIGN KEY (`resolution`) REFERENCES `resolution` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;