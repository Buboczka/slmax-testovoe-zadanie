-- Adminer 4.8.1 MySQL 5.7.39 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `slmax_test_task` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `slmax_test_task`;

DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '0',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `people` (`id`, `first_name`, `last_name`, `date_of_birth`, `sex`, `city`) VALUES
(1,	'1',	'1',	'2023-05-07',	0,	'1'),
(2,	'2',	'2',	'2022-07-05',	1,	'2'),
(3,	'3',	'3',	'2023-05-07',	0,	'1'),
(4,	'4',	'4',	'2022-07-05',	1,	'2'),
(5,	'5',	'5',	'2023-05-10',	1,	'5');

-- 2023-05-10 13:13:56
