-- Adminer 4.5.0 MySQL dump

CREATE DATABASE IF NOT EXISTS `php-login-system`;
USE `php-login-system`;

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `register_date`, `last_login_date`) VALUES
  (1,	'admin',	'demo@localhost.com',	'$2y$12$S0/B5fgdfoe.yRZw1i02W.tk.eMayWNLfqaygn5un3xJWUmrnYOzG',	'2018-06-23 20:51:28',	'2018-06-23 20:51:28'),
  (2,	'niki',	'demo@demo.com',	'$2y$12$1ZpE7s3cfC5fQdRXgaLuoeu2rTLqztIYlLEjC6jTuDSErg7jSqP8C',	'2018-06-23 21:08:09',	'2018-06-23 21:08:09'),
  (3,	'demo',	'demo@demo.com',	'$2y$12$56lsv0gtQE5hMwWFDjqde.wkpDP5udvVzQ3qylR7WXOsfgX302gry',	'2018-06-23 22:04:19',	'2018-06-23 22:04:19');

-- 2018-06-24 15:35:01