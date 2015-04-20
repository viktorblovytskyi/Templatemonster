-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 20 2015 г., 13:10
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `banadmin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(52) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `dateofstart` date DEFAULT NULL,
  `dateofend` date DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`id`, `user_id`, `name`, `status`, `width`, `height`, `dateofstart`, `dateofend`, `content`) VALUES
(1, 1, 'updateBanner', 0, 150, 150, '2015-05-12', '2015-05-13', 'welfwejf lkwef'),
(3, 1, 'banner2', 1, 100, 100, '2015-04-21', '2015-04-30', 'mclkdncvlknv'),
(4, 1, 'banner2', 1, 100, 100, '2015-04-20', '2015-04-30', 'enwfjkbeskjflb ew'),
(92, 2, 'banner', 1, 100, 100, '0000-00-00', '0000-00-00', 'sjvnbsjkdbvjsdbvksjd'),
(93, 2, 'newbanner', 1, 10, 10, '0000-00-00', '0000-00-00', 'sdvnsdkvn'),
(97, 1, 'banner3', 1, 100, 100, '2015-04-17', '2015-04-30', 'sfjsdokfjnskdf\r\n  " " fsdf''safad.dsad.L:');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `link` text NOT NULL,
  `visits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `banner_id`, `link`, `visits`) VALUES
(1, 1, 'http://banadmin.com/', 0),
(3, 3, 'http://banadmin.com/', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`) VALUES
(1, 'user', '123456'),
(2, 'user2', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
