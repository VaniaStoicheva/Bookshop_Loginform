-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 
-- Версия на сървъра: 5.5.16
-- Версия на PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данни: `books_login`
--

-- --------------------------------------------------------

--
-- Структура на таблица `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Ссхема на данните от таблица `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(2, 'Тери Пратчет'),
(3, 'Толкин'),
(4, 'Д.Димов');

-- --------------------------------------------------------

--
-- Структура на таблица `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(250) NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Ссхема на данните от таблица `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `counter`) VALUES
(1, 'Цветът на магията', 0),
(2, 'Властелинът на пръстените', 0),
(3, 'Добри поличби', 0),
(4, 'Битката на петте армии', 0),
(5, 'Тютюн', 0),
(6, 'Фантазия', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `books_authors`
--

CREATE TABLE IF NOT EXISTS `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Ссхема на данните от таблица `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
(0, 2),
(1, 2),
(2, 3),
(3, 2),
(4, 3),
(5, 4),
(6, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Структура на таблица `books_users`
--

CREATE TABLE IF NOT EXISTS `books_users` (
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Ссхема на данните от таблица `books_users`
--

INSERT INTO `books_users` (`book_id`, `user_id`) VALUES
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(1, 1),
(5, 1),
(4, 1),
(4, 1),
(4, 1),
(4, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `comment` text NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`comments_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Ссхема на данните от таблица `comments`
--

INSERT INTO `comments` (`user_id`, `book_id`, `comments_id`, `date_time`, `comment`, `counter`) VALUES
(6, 1, 1, '2016-10-15 12:35:35', 'цветът на магията', 1),
(6, 1, 2, '2016-10-15 12:36:10', 'цветът', 1),
(6, 2, 3, '2016-10-15 12:36:33', 'властелина', 0),
(6, 3, 4, '2016-10-15 12:36:47', 'добри поличби', 1),
(6, 3, 5, '2016-10-15 12:44:35', 'добри поличби', 1),
(1, 4, 10, '0000-00-00 00:00:00', 'фантазия', 0),
(1, 5, 11, '0000-00-00 00:00:00', 'истории', 0),
(1, 6, 12, '0000-00-00 00:00:00', 'приказки', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Ссхема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`) VALUES
(1, 'vania', '123'),
(6, 'vivas', '123'),
(3, 'wanias', '0'),
(4, 'cecostoi4ev', 'адсФГФДХГ'),
(5, 'vanina133', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
