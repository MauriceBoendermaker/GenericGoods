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
  `description` varchar(1000) DEFAULT NULL,
  `brand` int(11) NOT NULL,
  `cpu` int(11) NOT NULL,
  `gpu` int(11) NOT NULL,
  `resolution` int(11) NOT NULL,
  `refreshrate` int(11) DEFAULT NULL,
  `diagonal` decimal(4,1) DEFAULT NULL,
  `ram` varchar(45) DEFAULT NULL,
  `storagetype` varchar(4) DEFAULT NULL,
  `storagesize` varchar(45) DEFAULT NULL,
  `thumbnail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `resolution` (
  `id` int(11) NOT NULL,
  `resolution` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;